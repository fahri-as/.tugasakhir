<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\Pelamar;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SMARTCalculationService
{
    /**
     * Calculate scores using SMART method for a specific job, week, and period
     *
     * @param string $jobId
     * @param int $week
     * @param string|null $periodeId
     * @return array
     */
    public function calculateScores($jobId, $week, $periodeId = null)
    {
        // Step 1: Get criteria and their weights for this job
        $criteria = Criteria::where('job_id', $jobId)->get();

        if ($criteria->isEmpty()) {
            Log::warning("No criteria found for job ID: $jobId");
            return [];
        }

        // Create a map of criteria ID to weight for easier access
        $criteriaWeights = [];
        foreach ($criteria as $criterion) {
            $criteriaWeights[$criterion->criteria_id] = $criterion->weight;
        }

        // Step 2: Get all magang (internships) for this job and period
        $magangQuery = Magang::whereHas('pelamar', function($query) use ($jobId, $periodeId) {
            $query->where('job_id', $jobId);
            if ($periodeId) {
                $query->where('periode_id', $periodeId);
            }
        });

        $internships = $magangQuery->get();

        if ($internships->isEmpty()) {
            Log::info("No internships found for job ID: $jobId and period ID: $periodeId");
            return [];
        }

        // Step 3: Get all evaluations for the specified week
        $evaluations = EvaluasiMingguanMagang::whereIn('magang_id', $internships->pluck('magang_id'))
            ->where('minggu_ke', $week)
            ->with(['criteria', 'ratingScale'])
            ->get();

        // Group evaluations by magang_id
        $evaluationsByIntern = [];
        foreach ($evaluations as $eval) {
            if (!isset($evaluationsByIntern[$eval->magang_id])) {
                $evaluationsByIntern[$eval->magang_id] = [];
            }
            $evaluationsByIntern[$eval->magang_id][] = $eval;
        }

        // Step 4: Find min and max values for each criterion (for normalization)
        $minValues = [];
        $maxValues = [];

        foreach ($evaluations as $eval) {
            if (!$eval->criteria_id) continue;

            $criteriaId = $eval->criteria_id;
            $value = $eval->skor_minggu;

            if (!isset($minValues[$criteriaId]) || $value < $minValues[$criteriaId]) {
                $minValues[$criteriaId] = $value;
            }

            if (!isset($maxValues[$criteriaId]) || $value > $maxValues[$criteriaId]) {
                $maxValues[$criteriaId] = $value;
            }
        }

        // Step 5: Calculate SMART scores for each intern
        $results = [];

        foreach ($internships as $internship) {
            $magangId = $internship->magang_id;
            $totalWeightedScore = 0;
            $scoreDetails = [];

            // If this intern has evaluations for this week
            if (isset($evaluationsByIntern[$magangId])) {
                $internEvals = $evaluationsByIntern[$magangId];

                // Calculate score for each criterion
                foreach ($internEvals as $eval) {
                    // Skip if no criteria associated (general evaluation)
                    if (!$eval->criteria_id) continue;

                    $criteriaId = $eval->criteria_id;
                    $criteriaName = $eval->criteria->name ?? 'Unknown';
                    $criteriaCode = $eval->criteria->code ?? '';
                    $rawValue = $eval->skor_minggu;

                    // Get the weight for this criterion
                    $weight = $criteriaWeights[$criteriaId] ?? 0;

                    // Normalize the score (if min != max)
                    $utilityValue = 0;
                    if (isset($minValues[$criteriaId]) && isset($maxValues[$criteriaId]) &&
                        $maxValues[$criteriaId] > $minValues[$criteriaId]) {
                        $utilityValue = ($rawValue - $minValues[$criteriaId]) /
                                        ($maxValues[$criteriaId] - $minValues[$criteriaId]);
                    } else {
                        // If min = max, then all values are the same, so normalized value is 1
                        $utilityValue = 1;
                    }

                    // Calculate weighted score
                    $weightedScore = $utilityValue * $weight;

                    // Add to total
                    $totalWeightedScore += $weightedScore;

                    // Store details for this criterion
                    $scoreDetails[] = [
                        'criteria_id' => $criteriaId,
                        'criteria_name' => $criteriaName,
                        'criteria_code' => $criteriaCode,
                        'raw_value' => $rawValue,
                        'normalized_value' => $utilityValue,
                        'weight' => $weight,
                        'weighted_score' => $weightedScore
                    ];
                }
            }

            // Add this intern's results
            $results[] = [
                'magang_id' => $magangId,
                'pelamar_nama' => $internship->pelamar->nama ?? 'Unknown',
                'total_score' => $totalWeightedScore,
                'score_details' => $scoreDetails,
                'week' => $week
            ];
        }

        // Sort results by total score (descending)
        usort($results, function($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        // Add rank
        $rank = 1;
        foreach ($results as &$result) {
            $result['rank'] = $rank++;
        }

        return $results;
    }

    /**
     * Update total scores for all interns in a job using SMART method
     *
     * @param string $jobId
     * @param string|null $periodeId
     * @return bool
     */
    public function updateTotalScores($jobId, $periodeId = null)
    {
        try {
            // Get all interns for this job
            $magangQuery = Magang::whereHas('pelamar', function($query) use ($jobId, $periodeId) {
                $query->where('job_id', $jobId);
                if ($periodeId) {
                    $query->where('periode_id', $periodeId);
                }
            });

            $internships = $magangQuery->get();

            if ($internships->isEmpty()) {
                Log::info("No internships found for job ID: $jobId and period ID: $periodeId");
                return true;
            }

            // Get the period information to determine number of weeks
            $periode = null;
            if ($periodeId) {
                $periode = Periode::find($periodeId);
            }

            // Default to 4 weeks if no period specified or no duration set
            $weekCount = $periode ? ($periode->durasi_minggu_magang ?? 4) : 4;

            // Get all criteria for this job
            $criteria = Criteria::where('job_id', $jobId)->get();

            if ($criteria->isEmpty()) {
                Log::warning("No criteria found for job ID: $jobId");
                return false;
            }

            // Calculate and accumulate scores for each week
            $finalScores = [];
            $weeklyRanks = [];
            $scoreDetails = [];

            for ($week = 1; $week <= $weekCount; $week++) {
                $weeklyScores = $this->calculateScores($jobId, $week, $periodeId);

                // Store ranks and details for this week
                foreach ($weeklyScores as $score) {
                    $magangId = $score['magang_id'];

                    // Initialize arrays if needed
                    if (!isset($weeklyRanks[$magangId])) {
                        $weeklyRanks[$magangId] = [];
                    }

                    if (!isset($scoreDetails[$magangId])) {
                        $scoreDetails[$magangId] = [];
                    }

                    if (!isset($finalScores[$magangId])) {
                        $finalScores[$magangId] = 0;
                    }

                    // Store rank for this week
                    $weeklyRanks[$magangId][$week] = $score['rank'];

                    // Store score details for this week
                    $scoreDetails[$magangId][$week] = $score['score_details'];

                    // Accumulate weekly scores for final score
                    // We can implement weighted weeks here if needed
                    $weekWeight = $week / array_sum(range(1, $weekCount)); // Progressive weight
                    $finalScores[$magangId] += $score['total_score'] * $weekWeight;
                }
            }

            // Sort interns by final score
            arsort($finalScores);

            // Update scores and ranks in database
            DB::beginTransaction();

            $rank = 1;
            foreach ($finalScores as $magangId => $score) {
                // Convert to 0-5 scale (assuming final score is 0-1)
                $normalizedScore = $score * 5;

                // Ensure score is within 0-5 range
                $finalScore = max(0, min(5, $normalizedScore));

                Magang::where('magang_id', $magangId)->update([
                    'total_skor' => $finalScore,
                    'rank' => $rank++
                ]);

                // Store score details in cache
                $this->storeScoreDetails($magangId, $scoreDetails[$magangId], $weeklyRanks[$magangId]);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating scores: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Store score details for later retrieval
     * Using cache system
     *
     * @param string $magangId
     * @param array $details
     * @param array $ranks
     */
    private function storeScoreDetails($magangId, $details, $ranks)
    {
        // Store in cache for 24 hours
        $key = "smart_details_{$magangId}";
        $data = [
            'details' => $details,
            'ranks' => $ranks,
            'timestamp' => now()->timestamp
        ];

        Cache::put($key, $data, now()->addHours(24));
    }

    /**
     * Get stored score details for an intern
     *
     * @param string $magangId
     * @return array
     */
    public function getScoreDetails($magangId)
    {
        $key = "smart_details_{$magangId}";
        $data = Cache::get($key);

        if (!$data) {
            // If no cached data, calculate it on the fly
            $magang = Magang::with('pelamar')->find($magangId);

            if (!$magang || !$magang->pelamar) {
                return [];
            }

            $jobId = $magang->pelamar->job_id;
            $periodeId = $magang->pelamar->periode_id;

            if (!$jobId) {
                return [];
            }

            // Get the period to determine weeks
            $periode = null;
            if ($periodeId) {
                $periode = Periode::find($periodeId);
            }

            // Default to 4 weeks if no period specified or no duration set
            $weekCount = $periode ? ($periode->durasi_minggu_magang ?? 4) : 4;

            $details = [];
            $ranks = [];

            // Calculate scores for each week
            for ($week = 1; $week <= $weekCount; $week++) {
                $weeklyScores = $this->calculateScores($jobId, $week, $periodeId);

                foreach ($weeklyScores as $score) {
                    if ($score['magang_id'] === $magangId) {
                        $details[$week] = $score['score_details'];
                        $ranks[$week] = $score['rank'];
                        break;
                    }
                }
            }

            $data = [
                'details' => $details,
                'ranks' => $ranks,
                'timestamp' => now()->timestamp
            ];

            // Cache the calculated data
            Cache::put($key, $data, now()->addHours(24));
        }

        return $data;
    }

    /**
     * Get weekly scores for visualization
     *
     * @param string $magangId
     * @return array
     */
    public function getWeeklyScores($magangId)
    {
        $data = $this->getScoreDetails($magangId);
        $weeklyScores = [];

        if (!empty($data['details'])) {
            foreach ($data['details'] as $week => $details) {
                $totalScore = 0;
                $criteriaScores = [];

                foreach ($details as $criterion) {
                    $totalScore += $criterion['weighted_score'];
                    $criteriaScores[$criterion['criteria_name']] = $criterion['weighted_score'];
                }

                $weeklyScores[$week] = [
                    'total' => $totalScore,
                    'criteria' => $criteriaScores,
                    'rank' => $data['ranks'][$week] ?? null
                ];
            }
        }

        return $weeklyScores;
    }

    /**
     * Get criteria contribution chart data
     *
     * @param string $magangId
     * @return array
     */
    public function getCriteriaContribution($magangId)
    {
        $data = $this->getScoreDetails($magangId);
        $contribution = [];

        if (!empty($data['details'])) {
            $criteriaTotal = [];
            $weekCount = count($data['details']);

            // Sum up contributions across weeks
            foreach ($data['details'] as $week => $details) {
                foreach ($details as $criterion) {
                    $name = $criterion['criteria_name'];

                    if (!isset($criteriaTotal[$name])) {
                        $criteriaTotal[$name] = [
                            'total' => 0,
                            'weight' => $criterion['weight'],
                            'code' => $criterion['criteria_code']
                        ];
                    }

                    $criteriaTotal[$name]['total'] += $criterion['weighted_score'];
                }
            }

            // Calculate averages
            foreach ($criteriaTotal as $name => $data) {
                $contribution[] = [
                    'name' => $name,
                    'code' => $data['code'],
                    'weight' => $data['weight'],
                    'average_contribution' => $data['total'] / $weekCount,
                    'percentage' => 0 // Will calculate after summing all
                ];
            }

            // Calculate percentages
            $totalContribution = array_sum(array_column($contribution, 'average_contribution'));
            if ($totalContribution > 0) {
                foreach ($contribution as &$item) {
                    $item['percentage'] = ($item['average_contribution'] / $totalContribution) * 100;
                }
            }
        }

        return $contribution;
    }

    /**
     * Invalidate cached SMART details for an intern
     *
     * @param string $magangId
     * @return void
     */
    public function invalidateCache($magangId)
    {
        $key = "smart_details_{$magangId}";
        Cache::forget($key);
        Log::info("Invalidated SMART cache for magang_id: $magangId");
    }
}
