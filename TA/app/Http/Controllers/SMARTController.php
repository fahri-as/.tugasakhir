<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Job;
use App\Models\Pelamar;
use App\Models\Interview;
use App\Models\TesKemampuan;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SMARTController extends Controller
{
    /**
     * Display the SMART ranking page.
     */
    public function index($job_id = null)
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

        // Get applicants for this job
        $applicants = Pelamar::where('job_id', $job_id)
            ->with(['interview', 'tesKemampuan'])
            ->get();

        // Calculate SMART ranking if we have applicants
        $rankings = [];
        if ($applicants->count() > 0 && $hasCalculatedWeights) {
            $rankings = $this->calculateSMARTRanking($applicants, $criteria, $job_id);
        }

        return view('smart.index', compact('job', 'criteria', 'hasCalculatedWeights', 'applicants', 'rankings'));
    }

    /**
     * Calculate the SMART ranking for applicants.
     */
    private function calculateSMARTRanking($applicants, $criteria, $job_id)
    {
        $rankings = [];
        $utilityValues = [];

        // Get minimum and maximum values for each criterion to normalize
        $mins = [];
        $maxs = [];

        // Prepare criteria data
        $criteriaData = [];
        foreach ($criteria as $c) {
            $criteriaData[$c->criteria_id] = [
                'code' => $c->code,
                'name' => $c->name,
                'weight' => $c->weight
            ];
        }

        // Determine criteria values for each applicant
        foreach ($applicants as $applicant) {
            $values = [];

            // K1: Basic Cooking/Pastry Skills - from TesKemampuan
            if ($applicant->tesKemampuan) {
                $values['K1'] = $applicant->tesKemampuan->skor;
                $mins['K1'] = isset($mins['K1']) ? min($mins['K1'], $values['K1']) : $values['K1'];
                $maxs['K1'] = isset($maxs['K1']) ? max($maxs['K1'], $values['K1']) : $values['K1'];
            } else {
                $values['K1'] = 0;
            }

            // K2: Cooking/Pastry Quality - derived from TesKemampuan
            if ($applicant->tesKemampuan) {
                $values['K2'] = $applicant->tesKemampuan->skor * 0.85; // Quality as a percentage of skill test
                $mins['K2'] = isset($mins['K2']) ? min($mins['K2'], $values['K2']) : $values['K2'];
                $maxs['K2'] = isset($maxs['K2']) ? max($maxs['K2'], $values['K2']) : $values['K2'];
            } else {
                $values['K2'] = 0;
            }

            // K3: Cleanliness and Safety - from Interview
            if ($applicant->interview) {
                $values['K3'] = $applicant->interview->kualifikasi_skor * 20; // Convert 1-5 scale to 0-100
                $mins['K3'] = isset($mins['K3']) ? min($mins['K3'], $values['K3']) : $values['K3'];
                $maxs['K3'] = isset($maxs['K3']) ? max($maxs['K3'], $values['K3']) : $values['K3'];
            } else {
                $values['K3'] = 0;
            }

            // K4: Consistency & Precision - derived from TesKemampuan
            if ($applicant->tesKemampuan) {
                $values['K4'] = $applicant->tesKemampuan->skor * 0.75; // Consistency as a percentage of skill test
                $mins['K4'] = isset($mins['K4']) ? min($mins['K4'], $values['K4']) : $values['K4'];
                $maxs['K4'] = isset($maxs['K4']) ? max($maxs['K4'], $values['K4']) : $values['K4'];
            } else {
                $values['K4'] = 0;
            }

            // K5: Teamwork Ability - from Interview
            if ($applicant->interview) {
                $values['K5'] = $applicant->interview->komunikasi_skor * 20; // Convert 1-5 scale to 0-100
                $mins['K5'] = isset($mins['K5']) ? min($mins['K5'], $values['K5']) : $values['K5'];
                $maxs['K5'] = isset($maxs['K5']) ? max($maxs['K5'], $values['K5']) : $values['K5'];
            } else {
                $values['K5'] = 0;
            }

            $utilityValues[$applicant->pelamar_id] = $values;
        }

        // Calculate utility (normalized) values for each applicant and criterion
        foreach ($utilityValues as $applicantId => $values) {
            $score = 0;
            $utilityDetails = [];

            foreach ($values as $code => $value) {
                $weight = 0;
                $criteriaName = '';

                // Find the criteria weight
                foreach ($criteriaData as $cid => $c) {
                    if ($c['code'] === $code) {
                        $weight = $c['weight'];
                        $criteriaName = $c['name'];
                        break;
                    }
                }

                // Calculate normalized utility (0-1)
                $utility = 0;
                if (isset($maxs[$code]) && isset($mins[$code]) && $maxs[$code] > $mins[$code]) {
                    $utility = ($value - $mins[$code]) / ($maxs[$code] - $mins[$code]);
                }

                // Calculate weighted utility
                $weightedUtility = $utility * $weight;
                $score += $weightedUtility;

                $utilityDetails[$code] = [
                    'name' => $criteriaName,
                    'raw_value' => $value,
                    'utility' => $utility,
                    'weight' => $weight,
                    'weighted_utility' => $weightedUtility
                ];
            }

            $applicant = $applicants->where('pelamar_id', $applicantId)->first();

            $rankings[] = [
                'applicant_id' => $applicantId,
                'applicant_name' => $applicant->nama,
                'score' => $score,
                'details' => $utilityDetails
            ];
        }

        // Sort by score descending
        usort($rankings, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Add ranking position
        $rank = 1;
        foreach ($rankings as &$ranking) {
            $ranking['rank'] = $rank++;
        }

        return $rankings;
    }

    /**
     * Apply SMART ranking results to internship status.
     */
    public function applyRanking(Request $request, $job_id)
    {
        // Validate request
        $request->validate([
            'apply_count' => 'required|integer|min:1',
            'applicant_ids' => 'required|array',
            'applicant_ids.*' => 'required|string|exists:pelamar,pelamar_id',
        ]);

        // Only allow Cook (JOB001) or Pastry Chef (JOB004) jobs
        if (!in_array($job_id, ['JOB001', 'JOB004'])) {
            return redirect()->route('dashboard')->with('error', 'Decision support system is only available for Cook and Pastry Chef positions.');
        }

        $applyCount = $request->apply_count;
        $applicantIds = $request->applicant_ids;

        // Start a transaction
        DB::beginTransaction();

        try {
            // Update magang table for selected applicants
            foreach ($applicantIds as $index => $applicantId) {
                $status = ($index < $applyCount) ? 'Lulus' : 'Tidak Lulus';

                // Check if magang record exists
                $magang = Magang::where('pelamar_id', $applicantId)->first();

                if ($magang) {
                    // Update existing record
                    $magang->status_seleksi = $status;
                    $magang->rank = $index + 1;
                    $magang->save();
                } else {
                    // Create new record
                    Magang::create([
                        'magang_id' => 'MAG' . Str::random(8),
                        'pelamar_id' => $applicantId,
                        'user_id' => auth()->id(),
                        'status_seleksi' => $status,
                        'rank' => $index + 1,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('smart.index', $job_id)->with('success', 'Internship status has been updated based on SMART ranking');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating internship status: ' . $e->getMessage());
        }
    }
}
