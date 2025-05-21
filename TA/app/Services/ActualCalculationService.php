<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\CriteriaRatingScale;
use Illuminate\Support\Facades\Log;

class ActualCalculationService
{
    /**
     * Get actual calculation details for a specific evaluation
     *
     * @param EvaluasiMingguanMagang $evaluasi
     * @return array
     */
    public function getActualCalculation(EvaluasiMingguanMagang $evaluasi)
    {
        try {
            // Initialize the result
            $result = [
                'has_data' => false,
                'criteria' => [],
                'min_values' => [],
                'max_values' => [],
                'calculation' => [],
                'total_score' => 0,
                'total_scaled' => 0,
            ];

            // Check if this evaluation is eligible for SMART calculation
            if (!$evaluasi->magang || !$evaluasi->magang->pelamar ||
                !$evaluasi->magang->pelamar->job_id ||
                !in_array($evaluasi->magang->pelamar->job_id, ['JOB001', 'JOB004'])) {
                return $result;
            }

            $jobId = $evaluasi->magang->pelamar->job_id;
            $periodeId = $evaluasi->magang->pelamar->periode_id;
            $magangId = $evaluasi->magang_id;
            $week = $evaluasi->minggu_ke;

            // Get all criteria for this job
            $criteria = Criteria::where('job_id', $jobId)->get();
            if ($criteria->isEmpty()) {
                return $result;
            }

            // Get all evaluations for this intern and week
            $evaluations = EvaluasiMingguanMagang::where('magang_id', $magangId)
                ->where('minggu_ke', $week)
                ->with(['criteria', 'criteriaRatingScale'])
                ->get();

            if ($evaluations->isEmpty()) {
                return $result;
            }

            // Get the actual min and max values from the criteria_rating_scales table for each criterion
            $minValues = [];
            $maxValues = [];

            foreach ($criteria as $criterion) {
                // Get the min and max rating scales for this criterion
                $ratingScales = CriteriaRatingScale::where('criteria_id', $criterion->criteria_id)
                    ->orderBy('rating_level')
                    ->get();

                if ($ratingScales->isNotEmpty()) {
                    $minValues[$criterion->criteria_id] = $ratingScales->min('rating_level');
                    $maxValues[$criterion->criteria_id] = $ratingScales->max('rating_level');
                } else {
                    // Default fallback if no rating scales found
                    $minValues[$criterion->criteria_id] = 1;
                    $maxValues[$criterion->criteria_id] = 5;
                }
            }

            // Calculate normalized and weighted scores
            $criteriaData = [];
            $totalWeightedScore = 0;

            foreach ($evaluations as $eval) {
                if (!$eval->criteria_id || !$eval->criteriaRatingScale) continue;

                $criteriaId = $eval->criteria_id;
                $criteriaObj = $criteria->firstWhere('criteria_id', $criteriaId);

                if (!$criteriaObj) continue;

                $criteriaName = $criteriaObj->name;
                $criteriaCode = $criteriaObj->code;
                $weight = $criteriaObj->weight;
                $rawValue = $eval->criteriaRatingScale->rating_level;

                // Calculate normalized value using the actual min/max from rating scales
                $normalizedValue = 0;
                if (isset($minValues[$criteriaId]) && isset($maxValues[$criteriaId]) &&
                    $maxValues[$criteriaId] > $minValues[$criteriaId]) {
                    $normalizedValue = ($rawValue - $minValues[$criteriaId]) /
                                    ($maxValues[$criteriaId] - $minValues[$criteriaId]);
                } else {
                    $normalizedValue = 1; // If min = max
                }

                // Calculate weighted score
                $weightedScore = $normalizedValue * $weight;
                $totalWeightedScore += $weightedScore;

                // Add to criteria data
                $criteriaData[] = [
                    'criteria_id' => $criteriaId,
                    'criteria_name' => $criteriaName,
                    'criteria_code' => $criteriaCode,
                    'weight' => $weight,
                    'raw_score' => $rawValue,
                    'min_value' => $minValues[$criteriaId] ?? 1,
                    'max_value' => $maxValues[$criteriaId] ?? 5,
                    'normalized' => $normalizedValue,
                    'calculation' => "({$rawValue} - " . ($minValues[$criteriaId] ?? 1) . ") / (" .
                                    ($maxValues[$criteriaId] ?? 5) . " - " . ($minValues[$criteriaId] ?? 1) . ")",
                    'weighted_calculation' => "{$normalizedValue} × {$weight}",
                    'weighted' => $weightedScore
                ];
            }

            // Calculate scaled score (0-5)
            $scaledScore = $totalWeightedScore * 5;

            // Prepare final result
            $result = [
                'has_data' => true,
                'criteria' => $criteriaData,
                'min_values' => $minValues,
                'max_values' => $maxValues,
                'total_score' => $totalWeightedScore,
                'total_scaled' => $scaledScore,
                'full_calculation' => $this->formatFullCalculation($criteriaData)
            ];

            return $result;
        } catch (\Exception $e) {
            Log::error("Error generating actual calculation: " . $e->getMessage(), [
                'exception' => $e,
                'evaluasi_id' => $evaluasi->evaluasi_id ?? 'unknown'
            ]);
            return [
                'has_data' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Format the full calculation as a string for display
     *
     * @param array $criteriaData
     * @return string
     */
    private function formatFullCalculation($criteriaData)
    {
        $parts = [];
        foreach ($criteriaData as $criteria) {
            $parts[] = number_format($criteria['weighted'], 4);
        }

        return implode(' + ', $parts) . ' = ' . number_format(
            array_sum(array_column($criteriaData, 'weighted')),
            4
        );
    }
}
