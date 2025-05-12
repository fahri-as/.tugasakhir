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
     * Calculate weights for criteria using AHP method - exacty matching the existing implementation
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

            // Update criteria weights in database
            foreach ($weights as $criteriaId => $weight) {
                Criteria::where('criteria_id', $criteriaId)
                    ->update(['weight' => $weight]);
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
            Log::error('AHP weight calculation error: ' . $e->getMessage());
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
            $weightedSum = 0;

            // Multiply each value by the corresponding weight
            foreach ($row as $colId => $value) {
                $weightedSum += $value * $weights[$colId];
            }

            $weightedSums[$rowId] = $weightedSum;

            // Calculate lambda for this row
            $lambdas[$rowId] = $weightedSum / $weights[$rowId];
        }

        // Lambda max is the average of all lambdas
        return array_sum($lambdas) / count($lambdas);
    }
}
