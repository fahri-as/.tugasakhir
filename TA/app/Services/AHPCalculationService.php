<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AHPCalculationService
{
    // AHP comparison scale (untuk referensi)
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

    // Random Index values (untuk consistency ratio)
    const RI_VALUES = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];

    /**
     * Calculate weights for criteria using AHP method
     *
     * @param string $job_id
     * @return array|null Array of weights indexed by criteria_id, or null if error
     */
    public function calculateWeights(string $job_id)
    {
        try {
            DB::beginTransaction();

            // Get criteria for the job
            $criteria = Criteria::where('job_id', $job_id)->get();

            if ($criteria->isEmpty()) {
                throw new \Exception('No criteria found for this job');
            }

            // Create the pairwise comparison matrix
            $matrix = [];
            $n = count($criteria);

            // Step 1: Get all comparisons from database
            $comparisons = DB::table('criteria_comparisons')
                ->whereIn('criteria_column_id', $criteria->pluck('criteria_id'))
                ->whereIn('criteria_row_id', $criteria->pluck('criteria_id'))
                ->get();

            // Log loaded comparisons
            Log::info("Loaded " . $comparisons->count() . " comparison records for calculation");

            // Create a map for easier access
            $comparisonMap = [];
            foreach ($comparisons as $comparison) {
                $key = $comparison->criteria_row_id . '_' . $comparison->criteria_column_id;
                $comparisonMap[$key] = $comparison;

                // Log each comparison
                Log::info("Comparison: Row " . $comparison->criteria_row_id .
                          ", Column " . $comparison->criteria_column_id .
                          ", Value " . $comparison->value);
            }

            // Step 2: Fill the matrix with proper precision
            foreach ($criteria as $row) {
                foreach ($criteria as $col) {
                    if ($row->criteria_id === $col->criteria_id) {
                        // Diagonal values are always 1
                        $matrix[$row->criteria_id][$col->criteria_id] = 1.0;
                    } else {
                        // Look for the comparison in the database map
                        $key = $row->criteria_id . '_' . $col->criteria_id;

                        if (isset($comparisonMap[$key])) {
                            // Use the exact value from database with float casting
                            $value = floatval($comparisonMap[$key]->value);

                            // Handle zero or negative values
                            if ($value <= 0) {
                                Log::warning("Invalid comparison value: $value for $key, defaulting to 1");
                                $value = 1.0;
                            }

                            $matrix[$row->criteria_id][$col->criteria_id] = $value;
                        } else {
                            // Calculate reciprocal with high precision
                            $reverseKey = $col->criteria_id . '_' . $row->criteria_id;

                            if (isset($comparisonMap[$reverseKey])) {
                                $reverseValue = floatval($comparisonMap[$reverseKey]->value);

                                // Handle zero values in reverse
                                if ($reverseValue <= 0) {
                                    Log::warning("Invalid reverse comparison value: $reverseValue for $reverseKey, defaulting to 1");
                                    $matrix[$row->criteria_id][$col->criteria_id] = 1.0;
                                } else {
                                    $matrix[$row->criteria_id][$col->criteria_id] = 1.0 / $reverseValue;
                                }
                            } else {
                                // Default to 1 if no comparison found
                                Log::warning("No comparison found for $key or $reverseKey, defaulting to 1");
                                $matrix[$row->criteria_id][$col->criteria_id] = 1.0;
                            }
                        }
                    }

                    // Log matrix value
                    Log::info("Matrix[" . $row->criteria_id . "][" . $col->criteria_id . "] = " .
                             $matrix[$row->criteria_id][$col->criteria_id]);
                }
            }

            // Step 3: Calculate column sums with high precision
            $colSums = [];
            foreach ($criteria as $col) {
                $sum = 0.0;
                foreach ($criteria as $row) {
                    $sum += $matrix[$row->criteria_id][$col->criteria_id];
                }
                $colSums[$col->criteria_id] = $sum;

                // Log column sum
                Log::info("Column sum for " . $col->criteria_id . " = " . $sum);
            }

            // Step 4: Normalize matrix with high precision
            $normalizedMatrix = [];
            foreach ($criteria as $row) {
                foreach ($criteria as $col) {
                    if ($colSums[$col->criteria_id] != 0) {
                        $normalizedMatrix[$row->criteria_id][$col->criteria_id] =
                            $matrix[$row->criteria_id][$col->criteria_id] / $colSums[$col->criteria_id];
                    } else {
                        $normalizedMatrix[$row->criteria_id][$col->criteria_id] = 0.0;
                        Log::warning("Division by zero prevented in normalization for " .
                                    $row->criteria_id . "-" . $col->criteria_id);
                    }

                    // Log normalized value
                    Log::info("Normalized[" . $row->criteria_id . "][" . $col->criteria_id . "] = " .
                             $normalizedMatrix[$row->criteria_id][$col->criteria_id]);
                }
            }

            // Step 5: Calculate weights as row averages
            $weights = [];
            foreach ($criteria as $row) {
                $sum = 0.0;
                foreach ($criteria as $col) {
                    $sum += $normalizedMatrix[$row->criteria_id][$col->criteria_id];
                }
                $weights[$row->criteria_id] = $sum / $n;

                // Log weight calculation
                Log::info("Weight for " . $row->criteria_id . " (row sum: $sum / $n) = " . ($sum / $n));
            }

            // Update criteria weights in database
            foreach ($weights as $criteriaId => $weight) {
                Criteria::where('criteria_id', $criteriaId)
                    ->update(['weight' => $weight]);

                // Log weight update
                Log::info("Updated weight in database: Criteria " . $criteriaId . " = " . $weight);
            }

            // Calculate consistency measures if needed
            if ($n > 1) {
                // Calculate λmax (lambda max)
                $lambdaMax = $this->calculateLambdaMax($matrix, $weights);

                // Calculate Consistency Index (CI)
                $ci = ($lambdaMax - $n) / ($n - 1);

                // Get Random Index (RI) for n criteria
                $ri = self::RI_VALUES[$n - 1] ?? 1.49;

                // Calculate Consistency Ratio (CR)
                $cr = $ci / $ri;

                // If CR > 0.1, the comparisons are not consistent
                if ($n > 2 && $cr > 0.1) {
                    Log::warning("AHP comparisons for job $job_id are not consistent. CR = $cr");
                }

                // Log the consistency measures
                Log::info("AHP calculation for job $job_id: Lambda Max = $lambdaMax, CI = $ci, CR = $cr");
            }

            DB::commit();
            return $weights;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('AHP weight calculation error: ' . $e->getMessage(), ['exception' => $e]);
            return null;
        }
    }

    /**
     * Calculate λmax (lambda max) for consistency check
     *
     * @param array $matrix
     * @param array $weights
     * @return float
     */
    private function calculateLambdaMax($matrix, $weights)
    {
        $weightedSums = [];
        $lambdas = [];

        // For each row in the original matrix
        foreach ($matrix as $rowId => $row) {
            $weightedSum = 0.0;

            // Multiply each value by the corresponding weight
            foreach ($row as $colId => $value) {
                $weightedSum += floatval($value) * floatval($weights[$colId]);
            }

            $weightedSums[$rowId] = $weightedSum;

            // Log weighted sum
            Log::info("WeightedSum for row $rowId = $weightedSum");

            // Calculate lambda for this row with defensive division
            if (isset($weights[$rowId]) && floatval($weights[$rowId]) > 0) {
                $lambdas[$rowId] = $weightedSum / floatval($weights[$rowId]);
                Log::info("Lambda for row $rowId = " . $lambdas[$rowId]);
            } else {
                Log::warning("Division by zero prevented in lambda calculation for row $rowId");
                $lambdas[$rowId] = 0;
            }
        }

        // Lambda max is the average of all lambdas
        $lambdaMax = array_sum($lambdas) / count($lambdas);
        Log::info("Lambda Max calculated: " . $lambdaMax);

        return $lambdaMax;
    }
}
