<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use App\Models\Job;
use App\Models\User;
use App\Services\AHPCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AHPController extends Controller
{
    // AHP comparison scale
    const AHP_SCALE = [
        1 => 'Equal importance',
        2 => 'Weak or slight importance',
        3 => 'Moderate importance',
        4 => 'Moderate plus importance',
        5 => 'Strong importance',
        6 => 'Strong plus importance',
        7 => 'Very strong importance',
        8 => 'Very, very strong importance',
        9 => 'Extreme importance',
    ];

    protected $ahpService;

    /**
     * Create a new controller instance
     *
     * @param AHPCalculationService $ahpService
     */
    public function __construct(AHPCalculationService $ahpService)
    {
        $this->ahpService = $ahpService;
    }

    /**
     * Display the AHP weighting form.
     */
    public function index($job_id = null)
    {
        // Only allow Cook (JOB001) or Pastry Chef (JOB004) jobs
        if (!in_array($job_id, ['JOB001', 'JOB004'])) {
            return redirect()->route('dashboard')->with('error', 'Decision support system is only available for Cook and Pastry Chef positions.');
        }

        $job = Job::findOrFail($job_id);
        $criteria = Criteria::where('job_id', $job_id)->get();

        // If criteria weights are already calculated, fetch them
        $hasCalculatedWeights = $criteria->filter(function($c) {
            return $c->weight > 0;
        })->count() > 0;

        // Get comparison values if they exist
        $comparisons = DB::table('criteria_comparisons')
            ->join('criteria as c1', 'criteria_comparisons.criteria_column_id', '=', 'c1.criteria_id')
            ->join('criteria as c2', 'criteria_comparisons.criteria_row_id', '=', 'c2.criteria_id')
            ->where('c1.job_id', $job_id)
            ->where('c2.job_id', $job_id)
            ->select('criteria_comparisons.*')
            ->get()
            ->keyBy(function($item) {
                return $item->criteria_row_id . '_' . $item->criteria_column_id;
            });

        // Log comparisons for debugging if needed
        Log::info('AHP comparisons loaded for form: ' . $comparisons->count());

        return view('ahp.index', compact('job', 'criteria', 'hasCalculatedWeights', 'comparisons'));
    }

    /**
     * Save the pairwise comparisons and calculate weights.
     */
    public function saveComparisons(Request $request, $job_id)
    {
        // Validate request
        $request->validate([
            'comparison' => 'required|array',
        ]);

        // Only allow Cook (JOB001) or Pastry Chef (JOB004) jobs
        if (!in_array($job_id, ['JOB001', 'JOB004'])) {
            return redirect()->route('dashboard')->with('error', 'Decision support system is only available for Cook and Pastry Chef positions.');
        }

        $criteria = Criteria::where('job_id', $job_id)->get();

        // Start a transaction
        DB::beginTransaction();

        try {
            // Log raw comparison data from form for debugging
            Log::info('Raw comparison data from form: ', $request->comparison);

            // Clear existing comparisons
            DB::table('criteria_comparisons')
                ->whereIn('criteria_column_id', $criteria->pluck('criteria_id'))
                ->whereIn('criteria_row_id', $criteria->pluck('criteria_id'))
                ->delete();

            // Insert comparisons
            foreach ($request->comparison as $rowId => $columns) {
                foreach ($columns as $colId => $value) {
                    // Only insert if we have a value (not comparing criteria with itself)
                    if (!empty($value)) {
                        // Debug log
                        Log::info("Processing comparison: Row $rowId to Column $colId with value $value");

                        // Convert to numeric value
                        $numericValue = floatval($value);

                        // Validate value
                        if ($numericValue <= 0) {
                            Log::warning("WARNING: Invalid value $value (converted to $numericValue) for $rowId-$colId");
                            $numericValue = 1.0; // Default to equal importance if value is invalid
                        } else {
                            Log::info("Valid value $numericValue will be saved");
                        }

                        $comparisonId = Str::uuid()->toString();

                        DB::table('criteria_comparisons')->insert([
                            'comparisons_id' => $comparisonId,
                            'criteria_row_id' => $rowId,
                            'criteria_column_id' => $colId,
                            'value' => $numericValue,
                            'created_at' => now()->format('Y-m-d H:i:s'),
                            'updated_at' => now(),
                        ]);

                        // Verify saved value
                        $savedRecord = DB::table('criteria_comparisons')
                            ->where('criteria_row_id', $rowId)
                            ->where('criteria_column_id', $colId)
                            ->first();

                        if ($savedRecord) {
                            Log::info("Saved comparison record: Row $rowId, Column $colId, Value " . $savedRecord->value);
                        } else {
                            Log::warning("Failed to save comparison: Row $rowId, Column $colId");
                        }

                        // Insert the reciprocal value
                        if ($rowId != $colId) {
                            $reciprocalId = Str::uuid()->toString();

                            // Calculate reciprocal with high precision
                            $reciprocalValue = 1.0 / $numericValue;

                            // Debug log
                            Log::info("Calculating reciprocal: 1.0 / $numericValue = $reciprocalValue");

                            DB::table('criteria_comparisons')->insert([
                                'comparisons_id' => $reciprocalId,
                                'criteria_row_id' => $colId,
                                'criteria_column_id' => $rowId,
                                'value' => $reciprocalValue,
                                'created_at' => now()->format('Y-m-d H:i:s'),
                                'updated_at' => now(),
                            ]);

                            // Verify saved reciprocal value
                            $savedReciprocal = DB::table('criteria_comparisons')
                                ->where('criteria_row_id', $colId)
                                ->where('criteria_column_id', $rowId)
                                ->first();

                            if ($savedReciprocal) {
                                Log::info("Saved reciprocal: Row $colId, Column $rowId, Value " . $savedReciprocal->value);
                            } else {
                                Log::warning("Failed to save reciprocal: Row $colId, Column $rowId");
                            }
                        }
                    }
                }
            }

            // Final verification - check for any zero or invalid values in the database
            $invalidValues = DB::table('criteria_comparisons')
                ->whereIn('criteria_column_id', $criteria->pluck('criteria_id'))
                ->whereIn('criteria_row_id', $criteria->pluck('criteria_id'))
                ->where(function($query) {
                    $query->where('value', '<=', 0)
                          ->orWhereNull('value');
                })
                ->get();

            if ($invalidValues->count() > 0) {
                Log::warning('Found ' . $invalidValues->count() . ' invalid comparison values. Fixing...');

                foreach ($invalidValues as $invalid) {
                    // Fix invalid values
                    DB::table('criteria_comparisons')
                        ->where('comparisons_id', $invalid->comparisons_id)
                        ->update(['value' => 1.0]);

                    Log::info("Fixed invalid value for Row {$invalid->criteria_row_id}, Column {$invalid->criteria_column_id}");
                }
            }

            // Calculate weights using AHP service
            Log::info("Starting AHP weight calculation for job $job_id");
            $weights = $this->ahpService->calculateWeights($job_id);

            if (!$weights) {
                throw new \Exception('Failed to calculate weights');
            }

            // Log calculated weights
            Log::info("Calculated weights: ", $weights);

            DB::commit();
            return redirect()->route('ahp.results', $job_id)->with('success', 'Criteria comparisons and weights have been updated');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('AHP save comparisons error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Error updating weights: ' . $e->getMessage());
        }
    }

    /**
     * Display the AHP results and calculation details.
     */
    public function results($job_id)
    {
        // Only allow Cook (JOB001) or Pastry Chef (JOB004) jobs
        if (!in_array($job_id, ['JOB001', 'JOB004'])) {
            return redirect()->route('dashboard')->with('error', 'Decision support system is only available for Cook and Pastry Chef positions.');
        }

        $job = Job::findOrFail($job_id);
        $criteria = Criteria::where('job_id', $job_id)->get();

        // Check if weights have been calculated
        $hasCalculatedWeights = $criteria->filter(function($c) {
            return $c->weight > 0;
        })->count() > 0;

        if (!$hasCalculatedWeights) {
            return redirect()->route('ahp.index', $job_id)->with('error', 'Please calculate weights first.');
        }

        // Get all comparisons for the job
        $comparisons = CriteriaComparison::whereIn('criteria_row_id', $criteria->pluck('criteria_id'))
            ->whereIn('criteria_column_id', $criteria->pluck('criteria_id'))
            ->get();

        // Create comparison map for easy access
        $comparisonMap = [];
        foreach ($comparisons as $comparison) {
            $key = $comparison->criteria_row_id . '_' . $comparison->criteria_column_id;
            $comparisonMap[$key] = $comparison;
        }

        // Log loaded comparisons for debugging
        Log::info("Loaded " . $comparisons->count() . " comparison records for results page");

        // Build the comparison matrix with proper reciprocal values
        $matrix = [];
        foreach ($criteria as $row) {
            foreach ($criteria as $col) {
                if ($row->criteria_id === $col->criteria_id) {
                    // Diagonal always 1
                    $matrix[$row->criteria_id][$col->criteria_id] = 1.0;
                } else {
                    $key = $row->criteria_id . '_' . $col->criteria_id;

                    if (isset($comparisonMap[$key])) {
                        // Use existing comparison
                        $value = floatval($comparisonMap[$key]->value);
                        // Ensure it's not 0
                        $matrix[$row->criteria_id][$col->criteria_id] = ($value > 0) ? $value : 1.0;
                    } else {
                        // Try to find reciprocal
                        $reverseKey = $col->criteria_id . '_' . $row->criteria_id;

                        if (isset($comparisonMap[$reverseKey])) {
                            $reverseValue = floatval($comparisonMap[$reverseKey]->value);
                            // Prevent division by zero
                            if ($reverseValue > 0) {
                                $matrix[$row->criteria_id][$col->criteria_id] = 1.0 / $reverseValue;
                            } else {
                                $matrix[$row->criteria_id][$col->criteria_id] = 1.0;
                            }
                        } else {
                            // Default to 1 if no value found
                            $matrix[$row->criteria_id][$col->criteria_id] = 1.0;
                        }
                    }
                }

                // Log matrix values
                Log::info("Matrix[{$row->criteria_id}][{$col->criteria_id}] = {$matrix[$row->criteria_id][$col->criteria_id]}");
            }
        }

        // Calculate column sums
        $colSums = [];
        foreach ($criteria as $col) {
            $sum = 0.0;
            foreach ($criteria as $row) {
                $sum += $matrix[$row->criteria_id][$col->criteria_id];
            }
            $colSums[$col->criteria_id] = $sum;
            Log::info("Column sum for {$col->criteria_id} = $sum");
        }

        // Calculate normalized matrix
        $normalizedMatrix = [];
        foreach ($criteria as $row) {
            foreach ($criteria as $col) {
                if ($colSums[$col->criteria_id] != 0) {
                    $normalizedMatrix[$row->criteria_id][$col->criteria_id] =
                        $matrix[$row->criteria_id][$col->criteria_id] / $colSums[$col->criteria_id];
                } else {
                    $normalizedMatrix[$row->criteria_id][$col->criteria_id] = 0.0;
                    Log::warning("Division by zero prevented in normalized matrix: {$row->criteria_id}-{$col->criteria_id}");
                }
            }
        }

        // Calculate consistency measures
        $n = $criteria->count();
        $lambdaMax = $this->calculateLambdaMax($matrix, $criteria->pluck('weight', 'criteria_id')->toArray());
        $ci = ($n > 1) ? ($lambdaMax - $n) / ($n - 1) : 0;

        // Get Random Index (RI) value for n criteria
        $riValues = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $ri = $n <= count($riValues) ? $riValues[$n - 1] : 1.49;

        // Calculate Consistency Ratio
        $cr = ($n > 1 && $ri > 0) ? $ci / $ri : 0;

        // Log consistency measures
        Log::info("Consistency measures: Lambda Max = $lambdaMax, CI = $ci, CR = $cr");

        return view('ahp.results', compact(
            'job',
            'criteria',
            'matrix',
            'colSums',
            'normalizedMatrix',
            'lambdaMax',
            'ci',
            'ri',
            'cr'
        ));
    }

    /**
     * Helper method to calculate λmax for consistency check
     */
    private function calculateLambdaMax($matrix, $weights)
    {
        $weightedSums = [];
        $lambdas = [];

        // For each row in the matrix
        foreach ($matrix as $rowId => $row) {
            $weightedSum = 0.0;

            // Multiply each value by the corresponding weight
            foreach ($row as $colId => $value) {
                $weightedSum += floatval($value) * floatval($weights[$colId]);
            }

            $weightedSums[$rowId] = $weightedSum;

            // Calculate lambda for this row
            if (isset($weights[$rowId]) && floatval($weights[$rowId]) > 0) {
                $lambdas[$rowId] = $weightedSum / floatval($weights[$rowId]);
            } else {
                Log::warning("Division by zero prevented in lambda calculation for row $rowId");
                $lambdas[$rowId] = 0;
            }
        }

        // Lambda max is the average of all lambdas
        return array_sum($lambdas) / count($lambdas);
    }

    /**
     * Get the available scale options for AHP.
     */
    public function getAhpScale()
    {
        return self::AHP_SCALE;
    }
}
