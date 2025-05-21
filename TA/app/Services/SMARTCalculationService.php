<?php

namespace App\Services;

use App\Models\Criteria;
use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\Pelamar;
use App\Models\Periode;
use App\Models\TotalSkorMingguMagang;
use App\Models\CriteriaRatingScale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

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
        // Step 1: Get AHP-calculated weights for criteria
        $criteriaWeights = $this->getCriteriaWeights($jobId);

        // Step 2: Get all interns for this job and period
        $magangQuery = Magang::whereHas('pelamar', function($query) use ($jobId, $periodeId) {
            $query->where('job_id', $jobId);
            if ($periodeId) {
                $query->where('periode_id', $periodeId);
            }
        })
        ->with(['pelamar']);

        $internships = $magangQuery->get();

        if ($internships->isEmpty()) {
            Log::info("No internships found for job ID: $jobId and period ID: $periodeId");
            return [];
        }

        // Step 3: Get all evaluations for the specified week
        $evaluations = EvaluasiMingguanMagang::whereIn('magang_id', $internships->pluck('magang_id'))
            ->where('minggu_ke', $week)
            ->with(['criteria', 'criteriaRatingScale'])
            ->get();

        // Group evaluations by magang_id
        $evaluationsByIntern = [];
        foreach ($evaluations as $eval) {
            if (!isset($evaluationsByIntern[$eval->magang_id])) {
                $evaluationsByIntern[$eval->magang_id] = [];
            }
            $evaluationsByIntern[$eval->magang_id][] = $eval;
        }

        // Step 4: Get all criteria for this job
        $allCriteria = Criteria::where('job_id', $jobId)->get();

        // Step 5: Get min and max values from criteria_rating_scales for each criterion
        $minValues = [];
        $maxValues = [];

        foreach ($allCriteria as $criterion) {
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

        // Step 6: Calculate SMART scores for each intern
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
                    // Skip if no criteria associated (general evaluation) or no rating
                    if (!$eval->criteria_id || !$eval->criteriaRatingScale) continue;

                    $criteriaId = $eval->criteria_id;
                    $criteriaName = $eval->criteria->name ?? 'Unknown';
                    $criteriaCode = $eval->criteria->code ?? '';
                    // Get raw value from criteriaRatingScale
                    $rawValue = $eval->criteriaRatingScale->rating_level;

                    // Get the weight for this criterion
                    $weight = $criteriaWeights[$criteriaId] ?? 0;

                    // Calculate utility using the updated SMART formula from the PDF
                    // Utility value = (x - xmin) / (xmax - xmin)
                    $utilityValue = 0;
                    if (isset($minValues[$criteriaId]) && isset($maxValues[$criteriaId]) &&
                        $maxValues[$criteriaId] > $minValues[$criteriaId]) {
                        $utilityValue = ($rawValue - $minValues[$criteriaId]) /
                                        ($maxValues[$criteriaId] - $minValues[$criteriaId]);
                    } else {
                        // If min = max, then all values are the same, so normalized value is 1
                        $utilityValue = 1;
                    }

                    // Calculate weighted score: V(a) = ∑ wj * vi(a)
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
                        'weighted_score' => $weightedScore,
                        'min_value' => $minValues[$criteriaId] ?? 1,
                        'max_value' => $maxValues[$criteriaId] ?? 5
                    ];
                }

                // Store the weekly total score in the new table
                $this->updateWeeklyTotalScore($magangId, $week, $totalWeightedScore);
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
     * Store or update the weekly total score for an intern
     *
     * @param string $magangId
     * @param int $week
     * @param float $totalScore
     * @return void
     */
    private function updateWeeklyTotalScore($magangId, $week, $totalScore)
    {
        try {
            // Use the updateOrCreateScore method from the model
            TotalSkorMingguMagang::updateOrCreateScore($magangId, $week, $totalScore);

            Log::info("Updated weekly total score for magang_id: {$magangId}, week: {$week}, score: {$totalScore}");
        } catch (\Exception $e) {
            Log::error("Error updating weekly total score: " . $e->getMessage(), ['exception' => $e]);
        }
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

            // Calculate week weights according to the PDF formula
            // Calculate sum of week numbers for normalization
            $sumOfWeeks = array_sum(range(1, $weekCount));

            // Pre-calculate the week weights
            $weekWeights = [];
            for ($week = 1; $week <= $weekCount; $week++) {
                // Progressive weight formula: wi = i / ∑i
                // This gives more weight to later weeks which is appropriate for showing progress
                $weekWeights[$week] = $week / $sumOfWeeks;
            }

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

                    // Apply weighted score for this week according to our progressive weight formula
                    $finalScores[$magangId] += $score['total_score'] * $weekWeights[$week];
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

                // Update the database with the final score and rank
                Magang::where('magang_id', $magangId)->update([
                    'total_skor' => $finalScore,
                    'rank' => $rank++
                ]);

                // Cache the score details for faster access
                $this->storeScoreDetails(
                    $magangId,
                    $scoreDetails[$magangId] ?? [],
                    $weeklyRanks[$magangId] ?? []
                );
            }

            DB::commit();
            Log::info("Updated SMART scores for job ID: $jobId, period ID: $periodeId");
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating SMART scores: " . $e->getMessage(), ['exception' => $e]);
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
     * Get criteria contribution to SMART score
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
            $weekSum = array_sum(range(1, $weekCount));

            // Sum up contributions across weeks, with progressive weighting
            foreach ($data['details'] as $week => $details) {
                // Calculate the week weight based on the PDF formula: wi = i / ∑i
                $weekWeight = $week / $weekSum;

                foreach ($details as $criterion) {
                    $name = $criterion['criteria_name'];

                    if (!isset($criteriaTotal[$name])) {
                        $criteriaTotal[$name] = [
                            'total' => 0,
                            'weight' => $criterion['weight'],
                            'code' => $criterion['criteria_code'],
                            'weekly_contributions' => []
                        ];
                    }

                    // Store the weighted contribution for this week
                    $weeklyContribution = $criterion['weighted_score'] * $weekWeight;
                    $criteriaTotal[$name]['weekly_contributions'][$week] = $weeklyContribution;

                    // Add to total contribution
                    $criteriaTotal[$name]['total'] += $weeklyContribution;
                }
            }

            // Prepare the final contribution data
            foreach ($criteriaTotal as $name => $data) {
                $contribution[] = [
                    'name' => $name,
                    'code' => $data['code'],
                    'weight' => $data['weight'],
                    'total_contribution' => $data['total'],
                    'weekly_contributions' => $data['weekly_contributions'],
                    'percentage' => 0 // Will calculate after summing all
                ];
            }

            // Calculate percentages based on total contribution
            $totalContribution = array_sum(array_column($contribution, 'total_contribution'));
            if ($totalContribution > 0) {
                foreach ($contribution as &$item) {
                    $item['percentage'] = ($item['total_contribution'] / $totalContribution) * 100;
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

    /**
     * Get weekly total scores for an intern from the database
     *
     * @param string $magangId
     * @return array
     */
    public function getWeeklyTotalScores($magangId)
    {
        $weeklyScores = TotalSkorMingguMagang::where('magang_id', $magangId)
            ->orderBy('minggu_ke')
            ->get()
            ->pluck('total_skor', 'minggu_ke')
            ->toArray();

        return $weeklyScores;
    }

    /**
     * Get criteria weights for a job using the most recent AHP calculations
     *
     * @param string $jobId
     * @return array
     */
    private function getCriteriaWeights($jobId)
    {
        // Get criteria for this job
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

        return $criteriaWeights;
    }
}