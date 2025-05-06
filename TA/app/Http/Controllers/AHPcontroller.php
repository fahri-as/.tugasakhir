<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                        DB::table('criteria_comparisons')->insert([
                            'comparisons_id' => Str::uuid()->toString(),
                            'criteria_row_id' => $rowId,
                            'criteria_column_id' => $colId,
                            'value' => $value,
                            'created_at' => now()->format('Y-m-d H:i:s'),
                            'updated_at' => now(),
                        ]);

                        // Insert the reciprocal value
                        if ($rowId != $colId) {
                            DB::table('criteria_comparisons')->insert([
                                'comparisons_id' => Str::uuid()->toString(),
                                'criteria_row_id' => $colId,
                                'criteria_column_id' => $rowId,
                                'value' => 1 / (float)$value,
                                'created_at' => now()->format('Y-m-d H:i:s'),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }

            // Calculate weights using AHP
            $weights = $this->calculateAHPWeights($criteria, $job_id);

            // Update criteria weights
            foreach ($weights as $criteriaId => $weight) {
                Criteria::where('criteria_id', $criteriaId)
                    ->update(['weight' => $weight]);
            }

            DB::commit();
            return redirect()->route('ahp.index', $job_id)->with('success', 'Criteria comparisons and weights have been updated');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating weights: ' . $e->getMessage());
        }
    }

    /**
     * Calculate criteria weights using AHP method.
     */
    private function calculateAHPWeights($criteria, $job_id)
    {
        // Create the pairwise comparison matrix
        $matrix = [];
        $n = count($criteria);

        // Initialize matrix with 1s on diagonal
        foreach ($criteria as $row) {
            foreach ($criteria as $col) {
                if ($row->criteria_id === $col->criteria_id) {
                    $matrix[$row->criteria_id][$col->criteria_id] = 1;
                } else {
                    $matrix[$row->criteria_id][$col->criteria_id] = null;
                }
            }
        }

        // Fill the matrix with comparison values
        $comparisons = DB::table('criteria_comparisons')
            ->whereIn('criteria_column_id', $criteria->pluck('criteria_id'))
            ->whereIn('criteria_row_id', $criteria->pluck('criteria_id'))
            ->get();

        foreach ($comparisons as $comparison) {
            $matrix[$comparison->criteria_row_id][$comparison->criteria_column_id] = $comparison->value;
        }

        // Calculate column sums
        $colSums = [];
        foreach ($criteria as $col) {
            $sum = 0;
            foreach ($criteria as $row) {
                $sum += $matrix[$row->criteria_id][$col->criteria_id];
            }
            $colSums[$col->criteria_id] = $sum;
        }

        // Normalize the matrix
        $normalizedMatrix = [];
        foreach ($criteria as $row) {
            foreach ($criteria as $col) {
                $normalizedMatrix[$row->criteria_id][$col->criteria_id] =
                    $matrix[$row->criteria_id][$col->criteria_id] / $colSums[$col->criteria_id];
            }
        }

        // Calculate the weights (row averages of normalized matrix)
        $weights = [];
        foreach ($criteria as $row) {
            $sum = 0;
            foreach ($criteria as $col) {
                $sum += $normalizedMatrix[$row->criteria_id][$col->criteria_id];
            }
            $weights[$row->criteria_id] = $sum / $n;
        }

        // Calculate consistency measures if needed
        // (This is a simplified implementation that doesn't check for consistency ratio)

        return $weights;
    }

    /**
     * Get the available scale options for AHP.
     */
    public function getAhpScale()
    {
        return self::AHP_SCALE;
    }
}
