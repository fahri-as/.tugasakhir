<?php

namespace App\Services;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\Criteria;
use App\Models\RatingScale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SMARTCalculationService
{
    /**
     * Calculate intern scores using SMART method
     *
     * @param string $job_id
     * @param int $minggu_ke Week number for evaluation
     * @param string|null $periode_id Optional period filter
     * @return array Array of interns with their scores
     */
    public function calculateScores(string $job_id, int $minggu_ke, ?string $periode_id = null)
    {
        try {
            // Get criteria for the job with their weights from AHP
            $criteria = Criteria::where('job_id', $job_id)->get();

            if ($criteria->isEmpty()) {
                Log::warning("No criteria found for job_id: $job_id");
                return [];
            }

            // Get interns for the job (optionally filtered by period)
            $internsQuery = Magang::whereHas('pelamar', function($query) use ($job_id, $periode_id) {
                $query->where('job_id', $job_id);
                if ($periode_id) {
                    $query->where('periode_id', $periode_id);
                }
            });

            $interns = $internsQuery->get();

            if ($interns->isEmpty()) {
                Log::info("No interns found for job_id: $job_id" . ($periode_id ? ", periode_id: $periode_id" : ""));
                return [];
            }

            // Get all evaluations for these interns for the specified week
            $evaluations = EvaluasiMingguanMagang::whereIn('magang_id', $interns->pluck('magang_id'))
                ->where('minggu_ke', $minggu_ke)
                ->with(['ratingScale', 'criteria'])
                ->get();

            if ($evaluations->isEmpty()) {
                Log::info("No evaluations found for week: $minggu_ke");
                return [];
            }

            // Get min/max values for each criteria for normalization
            $minMaxValues = $this->getMinMaxValues($job_id, $minggu_ke, $periode_id);

            // Calculate normalized and weighted scores for each intern
            $results = [];

            foreach ($interns as $intern) {
                $internEvals = $evaluations->where('magang_id', $intern->magang_id);

                if ($internEvals->isEmpty()) {
                    continue;
                }

                $totalScore = 0;
                $evaluationDetails = [];

                // Process each evaluation for this intern
                foreach ($internEvals as $eval) {
                    $criteriaId = $eval->criteria_id;

                    // Skip if not tied to a criteria
                    if (!$criteriaId) {
                        continue;
                    }

                    $criteriaObj = $criteria->firstWhere('criteria_id', $criteriaId);

                    // Skip if criteria doesn't exist or has no weight
                    if (!$criteriaObj || !$criteriaObj->weight) {
                        continue;
                    }

                    $rawValue = $eval->skor_minggu;

                    // Get min/max for this criteria
                    $min = $minMaxValues[$criteriaId]['min'] ?? $rawValue;
                    $max = $minMaxValues[$criteriaId]['max'] ?? $rawValue;

                    // Normalize value using SMART method: (Value - Min) / (Max - Min)
                    $normalizedValue = ($max > $min) ? ($rawValue - $min) / ($max - $min) : 1;

                    // Apply weight from AHP
                    $weightedValue = $normalizedValue * $criteriaObj->weight;

                    // Add to total score
                    $totalScore += $weightedValue;

                    // Store details for this evaluation
                    $evaluationDetails[] = [
                        'evaluation_id' => $eval->evaluasi_id,
                        'criteria_id' => $criteriaId,
                        'criteria_name' => $criteriaObj->name,
                        'criteria_code' => $criteriaObj->code,
                        'criteria_weight' => $criteriaObj->weight,
                        'raw_value' => $rawValue,
                        'min_value' => $min,
                        'max_value' => $max,
                        'normalized_value' => $normalizedValue,
                        'weighted_value' => $weightedValue
                    ];
                }

                // Store result for this intern
                $results[] = [
                    'magang_id' => $intern->magang_id,
                    'pelamar_id' => $intern->pelamar_id,
                    'nama' => $intern->pelamar->nama,
                    'job' => $intern->pelamar->job->nama_job ?? 'Unknown',
                    'total_score' => $totalScore,
                    'evaluation_details' => $evaluationDetails
                ];
            }

            // Sort results by total score in descending order
            usort($results, function($a, $b) {
                return $b['total_score'] <=> $a['total_score'];
            });

            // Add ranking
            $rank = 1;
            foreach ($results as &$result) {
                $result['rank'] = $rank++;
            }

            return $results;
        } catch (\Exception $e) {
            Log::error('SMART calculation error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get min and max values for each criteria in specified evaluations
     *
     * @param string $job_id
     * @param int $minggu_ke
     * @param string|null $periode_id
     * @return array
     */
    private function getMinMaxValues(string $job_id, int $minggu_ke, ?string $periode_id = null)
    {
        // Get criteria for this job
        $criteria = Criteria::where('job_id', $job_id)->pluck('criteria_id');

        // Build query to get interns for this job/period
        $internsQuery = Magang::whereHas('pelamar', function($query) use ($job_id, $periode_id) {
            $query->where('job_id', $job_id);
            if ($periode_id) {
                $query->where('periode_id', $periode_id);
            }
        });

        $interns = $internsQuery->pluck('magang_id');

        // Get all relevant evaluations
        $evaluations = EvaluasiMingguanMagang::whereIn('magang_id', $interns)
            ->where('minggu_ke', $minggu_ke)
            ->whereIn('criteria_id', $criteria)
            ->get();

        // Calculate min/max for each criteria
        $result = [];
        foreach ($criteria as $criteriaId) {
            $criteriaEvals = $evaluations->where('criteria_id', $criteriaId);

            if ($criteriaEvals->isNotEmpty()) {
                $result[$criteriaId] = [
                    'min' => $criteriaEvals->min('skor_minggu'),
                    'max' => $criteriaEvals->max('skor_minggu')
                ];
            }
        }

        return $result;
    }

    /**
     * Update magang total_skor based on weighted evaluations
     *
     * @param string $job_id
     * @param string|null $periode_id
     * @return bool
     */
    public function updateTotalScores(string $job_id, ?string $periode_id = null)
    {
        try {
            // Get interns for the job (optionally filtered by period)
            $internsQuery = Magang::whereHas('pelamar', function($query) use ($job_id, $periode_id) {
                $query->where('job_id', $job_id);
                if ($periode_id) {
                    $query->where('periode_id', $periode_id);
                }
            });

            $interns = $internsQuery->get();

            if ($interns->isEmpty()) {
                return false;
            }

            // Get periode with max week duration
            $periodeDurasi = 0;
            if ($periode_id) {
                $periode = \App\Models\Periode::find($periode_id);
                if ($periode) {
                    $periodeDurasi = $periode->durasi_minggu_magang;
                }
            }

            DB::beginTransaction();

            // For each intern, calculate total score across all weeks
            foreach ($interns as $intern) {
                $totalScore = 0;

                // Calculate for each week
                for ($minggu = 1; $minggu <= $periodeDurasi; $minggu++) {
                    $weekResults = $this->calculateScores($job_id, $minggu, $periode_id);

                    // Find this intern in results
                    $internResult = collect($weekResults)->firstWhere('magang_id', $intern->magang_id);

                    if ($internResult) {
                        $totalScore += $internResult['total_score'];
                    }
                }

                // Update magang total_skor
                $intern->total_skor = $totalScore;
                $intern->save();
            }

            // Sort interns by total_skor and assign ranks
            $sortedInterns = $interns->sortByDesc('total_skor');
            $rank = 1;

            foreach ($sortedInterns as $intern) {
                $intern->rank = $rank++;
                $intern->save();
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('SMART total score update error: ' . $e->getMessage());
            return false;
        }
    }
}
