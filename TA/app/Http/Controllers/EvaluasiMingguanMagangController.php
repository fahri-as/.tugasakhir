<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\RatingScale;
use App\Models\Periode;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class EvaluasiMingguanMagangController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected period or default to the latest period
        $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
        $selectedPeriodeId = $request->periode_id ?? ($latestPeriode ? $latestPeriode->periode_id : null);

        // If a period is selected, we don't need to load all evaluations right away
        // We'll load them via AJAX when a week is selected
        $evaluasi = collect(); // Empty collection by default

        return view('evaluasi.index', compact('evaluasi'));
    }


    private function updateMagangScore($magangId)
{
    // Get all evaluations for this magang
    $evaluations = EvaluasiMingguanMagang::where('magang_id', $magangId)->get();

    if ($evaluations->isEmpty()) {
        // No evaluations, set score to 0
        Magang::where('magang_id', $magangId)->update(['total_skor' => 0]);
        Log::info("No evaluations found for magang_id: $magangId, setting total_skor to 0");
        return;
    }

    // Group evaluations by week
    $weeklyEvaluations = $evaluations->groupBy('minggu_ke');

    // Calculate average score for each week
    $weeklyScores = [];
    foreach ($weeklyEvaluations as $week => $evals) {
        $weekScore = $evals->sum('skor_minggu');
        $weeklyScores[$week] = $weekScore;
    }

    // Calculate the overall total score (sum of weekly scores)
    $totalScore = array_sum($weeklyScores);

    // Log the calculation
    Log::info("Updating magang_id: $magangId score", [
        'evaluation_count' => $evaluations->count(),
        'weeks' => count($weeklyScores),
        'weekly_scores' => $weeklyScores,
        'total_score' => $totalScore
    ]);

    // Update the magang record
    $updated = Magang::where('magang_id', $magangId)->update(['total_skor' => $totalScore]);

    Log::info("Update result for magang_id: $magangId: " . ($updated ? 'success' : 'failed'));
}

    /**
     * API endpoint to get evaluations by week
     * This is called via AJAX from the frontend
     */
    public function getByWeek(Request $request)
{
    $request->validate([
        'periode_id' => 'required|exists:periode,periode_id',
        'week' => 'required|integer|min:1',
    ]);

    $periodeId = $request->periode_id;
    $week = $request->week;

    try {
        // Get all evaluations for this week in the selected period
        $evaluations = EvaluasiMingguanMagang::with([
                'magang',
                'magang.pelamar',
                'magang.pelamar.job',
                'ratingScale',
                'criteria'
            ])
            ->whereHas('magang', function($query) use ($periodeId) {
                $query->whereHas('pelamar', function($q) use ($periodeId) {
                    $q->where('periode_id', $periodeId);
                });
            })
            ->where('minggu_ke', $week)
            ->get();

        // Log the query result for debugging
        Log::info('Evaluations query result:', [
            'period_id' => $periodeId,
            'week' => $week,
            'count' => $evaluations->count()
        ]);

        return response()->json($evaluations);
    } catch (\Exception $e) {
        Log::error('Error in getByWeek method: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'error' => 'Failed to fetch evaluations',
            'message' => $e->getMessage()
        ], 500);
    }
}
    public function create(Request $request)
    {
        // Pre-select period and week if provided in the query parameters
        $selectedPeriodeId = $request->periode_id;
        $selectedWeek = $request->week;

        // Get interns who are currently active (status_seleksi = 'Sedang Berjalan')
        $magang = Magang::where('status_seleksi', 'Sedang Berjalan')
            ->with('pelamar')
            ->when($selectedPeriodeId, function($query) use ($selectedPeriodeId) {
                return $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                    $q->where('periode_id', $selectedPeriodeId);
                });
            })
            ->get();

        $ratingScales = RatingScale::all();

        // Get available criteria for selection
        $criteria = Criteria::all();

        return view('evaluasi.create', compact('magang', 'ratingScales', 'criteria', 'selectedPeriodeId', 'selectedWeek'));
    }

    public function store(Request $request)
{
    $request->validate([
        'magang_id' => 'required|exists:magang,magang_id',
        'rating_id' => 'required|exists:rating_scales,rating_id',
        'criteria_id' => 'nullable|exists:criteria,criteria_id', // Make criteria optional
        'minggu_ke' => 'required|integer|min:1',
    ]);

    // Check if evaluation already exists for this magang, criteria and week
    $exists = EvaluasiMingguanMagang::where('magang_id', $request->magang_id)
        ->where('minggu_ke', $request->minggu_ke)
        ->where('criteria_id', $request->criteria_id)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Evaluation for this intern, criteria and week already exists');
    }

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Get the rating value to calculate score
        $rating = RatingScale::findOrFail($request->rating_id);

        // Create the evaluation
        $evaluasi = new EvaluasiMingguanMagang();
        $evaluasi->evaluasi_id = Str::uuid()->toString();
        $evaluasi->magang_id = $request->magang_id;
        $evaluasi->rating_id = $request->rating_id;
        $evaluasi->criteria_id = $request->criteria_id; // Set criteria_id if provided
        $evaluasi->minggu_ke = $request->minggu_ke;
        $evaluasi->skor_minggu = $rating->value / 10; // Convert to 0-5 scale
        $evaluasi->save();

        // Update the magang total_skor with the new average
        $this->updateMagangScore($request->magang_id);

        DB::commit();

        // Get the period ID to redirect back to the same period view
        $periodeId = Magang::with('pelamar')->findOrFail($request->magang_id)->pelamar->periode_id ?? null;
        $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];

        return redirect()->route('evaluasi.index', $redirectParams)->with('success', 'Evaluation created successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error creating evaluation: ' . $e->getMessage());
    }
}

    public function show(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->load(['magang', 'magang.pelamar', 'magang.pelamar.job', 'ratingScale', 'criteria']);
        return view('evaluasi.show', compact('evaluasi'));
    }

    public function edit(EvaluasiMingguanMagang $evaluasi)
    {
        $magang = Magang::with('pelamar')->get();
        $ratingScales = RatingScale::all();
        $criteria = Criteria::all();

        return view('evaluasi.edit', compact('evaluasi', 'magang', 'ratingScales', 'criteria'));
    }

    public function update(Request $request, EvaluasiMingguanMagang $evaluasi)
{
    $request->validate([
        'magang_id' => 'required|exists:magang,magang_id',
        'rating_id' => 'required|exists:rating_scales,rating_id',
        'criteria_id' => 'nullable|exists:criteria,criteria_id', // Make criteria optional
        'minggu_ke' => 'required|integer|min:1',
    ]);

    // Check if evaluation already exists for this magang, criteria and week (excluding current record)
    $exists = EvaluasiMingguanMagang::where('magang_id', $request->magang_id)
        ->where('minggu_ke', $request->minggu_ke)
        ->where('criteria_id', $request->criteria_id)
        ->where('evaluasi_id', '!=', $evaluasi->evaluasi_id)
        ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'Evaluation for this intern, criteria and week already exists');
    }

    // Start a database transaction
    DB::beginTransaction();

    try {
        // Get the rating value to calculate score
        $rating = RatingScale::findOrFail($request->rating_id);

        // Store the original magang_id for updating scores
        $originalMagangId = $evaluasi->magang_id;

        // Update the evaluation
        $evaluasi->magang_id = $request->magang_id;
        $evaluasi->rating_id = $request->rating_id;
        $evaluasi->criteria_id = $request->criteria_id; // Update criteria_id
        $evaluasi->minggu_ke = $request->minggu_ke;
        $evaluasi->skor_minggu = $rating->value / 10; // Convert to 0-5 scale
        $evaluasi->save();

        // Update the magang total_skor with the new average
        $this->updateMagangScore($request->magang_id);

        // If magang_id changed, update the old magang's score too
        if ($originalMagangId !== $request->magang_id) {
            $this->updateMagangScore($originalMagangId);
        }

        DB::commit();

        // Get the period ID to redirect back to the same period view
        $periodeId = Magang::with('pelamar')->findOrFail($request->magang_id)->pelamar->periode_id ?? null;
        $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];

        return redirect()->route('evaluasi.index', $redirectParams)->with('success', 'Evaluation updated successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error updating evaluation: ' . $e->getMessage());
    }
}

    public function destroy(EvaluasiMingguanMagang $evaluasi)
{
    // Get the period ID before deletion for redirecting back to the same period view
    $periodeId = $evaluasi->magang->pelamar->periode_id ?? null;
    $magangId = $evaluasi->magang_id;

    // Start a database transaction
    DB::beginTransaction();

    try {
        $evaluasi->delete();

        // Update the magang total_skor after deletion
        $this->updateMagangScore($magangId);

        DB::commit();

        $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];
        return redirect()->route('evaluasi.index', $redirectParams)->with('success', 'Evaluation deleted successfully');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error deleting evaluation: ' . $e->getMessage());
    }
}


    /**
     * Create weekly evaluations for all weeks of an internship.
     *
     * @param  \App\Models\Magang  $magang
     * @param  int  $weekCount
     * @return bool
     */
    public static function createWeeklyEvaluations(Magang $magang, int $weekCount)
    {
        try {
            // Begin transaction to ensure all evaluations are created successfully
            DB::beginTransaction();

            // Default to "Cukup" (Average) rating
            $defaultRating = RatingScale::where('singkatan', 'C')->first();

            if (!$defaultRating) {
                // Fallback to middle rating if "Cukup" not found
                $defaultRating = RatingScale::orderBy('value')->get()->filter(function($item, $key) {
                    return $key == 2; // Middle item
                })->first();

                if (!$defaultRating) {
                    // Fallback to first rating if no middle rating found
                    $defaultRating = RatingScale::first();

                    if (!$defaultRating) {
                        throw new \Exception('No rating scales found in the database');
                    }
                }
            }

            // Get applicable criteria if available (based on job position)
            $jobId = $magang->pelamar->job_id ?? null;
            $criteriaList = $jobId ? Criteria::where('job_id', $jobId)->get() : collect();

            // Create evaluations for each week
            for ($week = 1; $week <= $weekCount; $week++) {
                if ($criteriaList->isEmpty()) {
                    // If no criteria, create a single evaluation per week
                    self::createOrUpdateEvaluation($magang, $defaultRating, null, $week);
                } else {
                    // Create one evaluation per criteria for each week
                    foreach ($criteriaList as $criteria) {
                        self::createOrUpdateEvaluation($magang, $defaultRating, $criteria->criteria_id, $week);
                    }
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error or handle it as needed
            return false;
        }
    }

    /**
     * Create or update a weekly evaluation.
     *
     * @param  \App\Models\Magang  $magang
     * @param  \App\Models\RatingScale  $rating
     * @param  string|null  $criteriaId
     * @param  int  $week
     * @return void
     */
    private static function createOrUpdateEvaluation(Magang $magang, RatingScale $rating, ?string $criteriaId, int $week)
    {
        // Check if evaluation for this week, magang, and criteria already exists
        $existingEval = EvaluasiMingguanMagang::where('magang_id', $magang->magang_id)
            ->where('minggu_ke', $week)
            ->where('criteria_id', $criteriaId)
            ->first();

        if (!$existingEval) {
            $evaluasi = new EvaluasiMingguanMagang();
            $evaluasi->evaluasi_id = Str::uuid()->toString();
            $evaluasi->magang_id = $magang->magang_id;
            $evaluasi->rating_id = $rating->rating_id;
            $evaluasi->criteria_id = $criteriaId;
            $evaluasi->minggu_ke = $week;
            $evaluasi->skor_minggu = $rating->value / 10; // Convert to 0-5 scale
            $evaluasi->save();
        }
    }
}