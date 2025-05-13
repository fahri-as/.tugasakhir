<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\RatingScale;
use App\Models\Periode;
use App\Models\Criteria;
use App\Models\Job;
use App\Services\SMARTCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvaluasiMingguanMagangController extends Controller
{
    protected $smartService;

    public function __construct(SMARTCalculationService $smartService)
    {
        $this->smartService = $smartService;
    }

    /**
     * Display a listing of the evaluations.
     */
    public function index(Request $request)
    {
        // Get the selected period or default to the latest period
        $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
        $selectedPeriodeId = $request->periode_id ?? ($latestPeriode ? $latestPeriode->periode_id : null);

        // Get all periods for dropdown
        $periods = Periode::orderBy('tanggal_mulai', 'desc')->get();

        // Initialize variables
        $evaluationsByWeek = collect();
        $weekCount = 0;

        if ($selectedPeriodeId) {
            $periode = Periode::find($selectedPeriodeId);
            if ($periode) {
                $weekCount = $periode->durasi_minggu_magang ?? 1;

                // Get evaluations for this period
                $evaluationsByWeek = $this->getEvaluationsByWeek($selectedPeriodeId, $weekCount);
            }
        }

        return view('evaluasi.index', compact(
            'periods',
            'selectedPeriodeId',
            'evaluationsByWeek',
            'weekCount'
        ));
    }

    /**
     * Helper method to get evaluations grouped by week
     */
    private function getEvaluationsByWeek($periodeId, $weekCount)
    {
        $evaluationsByWeek = collect();

        for ($week = 1; $week <= $weekCount; $week++) {
            $evaluations = EvaluasiMingguanMagang::whereHas('magang', function($query) use ($periodeId) {
                $query->whereHas('pelamar', function($q) use ($periodeId) {
                    $q->where('periode_id', $periodeId);
                });
            })
            ->where('minggu_ke', $week)
            ->with(['magang', 'magang.pelamar', 'magang.pelamar.job', 'criteria', 'ratingScale'])
            ->get();

            // Group by magang_id
            $groupedByMagang = $evaluations->groupBy('magang_id');

            $evaluationsByWeek[$week] = $groupedByMagang;
        }

        return $evaluationsByWeek;
    }

    /**
     * API endpoint to get evaluations by week
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

            // Group evaluations by job and calculate SMART scores
            $smartResults = [];
            $groupedByJob = $evaluations->groupBy(function($eval) {
                return $eval->magang->pelamar->job_id ?? 'unknown';
            });

            // Calculate SMART scores for Cook and Pastry Chef positions
            foreach ($groupedByJob as $jobId => $evalGroup) {
                if ($jobId !== 'unknown' && in_array($jobId, ['JOB001', 'JOB004'])) {
                    $smartResults[$jobId] = $this->smartService->calculateScores(
                        $jobId,
                        $week,
                        $periodeId
                    );
                }
            }

            return response()->json([
                'evaluations' => $evaluations,
                'smart_results' => $smartResults
            ]);
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

    /**
     * Show the form for creating a new evaluation.
     */
    public function create(Request $request)
    {
        // Pre-select period and week if provided in the query parameters
        $selectedPeriodeId = $request->periode_id;
        $selectedWeek = $request->week;
        $selectedMagangId = $request->magang_id;

        // Get interns who are currently active (status_seleksi = 'Sedang Berjalan')
        $magang = Magang::where('status_seleksi', 'Sedang Berjalan')
            ->with(['pelamar', 'pelamar.job'])
            ->when($selectedPeriodeId, function($query) use ($selectedPeriodeId) {
                return $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                    $q->where('periode_id', $selectedPeriodeId);
                });
            })
            ->get();

        // Get available rating scales
        $ratingScales = RatingScale::orderBy('value')->get();

        // Get criteria based on the selected intern's job
        $criteria = collect();

        // If magang_id is provided, filter criteria by job
        if ($selectedMagangId) {
            $selectedMagang = $magang->firstWhere('magang_id', $selectedMagangId);
            if ($selectedMagang && $selectedMagang->pelamar && $selectedMagang->pelamar->job_id) {
                $criteria = Criteria::where('job_id', $selectedMagang->pelamar->job_id)->get();
            }
        } else {
            // Get all criteria (will be filtered by JavaScript on the frontend)
            $criteria = Criteria::all();
        }

        // Get periods for dropdown
        $periods = Periode::orderBy('tanggal_mulai', 'desc')->get();

        return view('evaluasi.create', compact(
            'magang',
            'ratingScales',
            'criteria',
            'periods',
            'selectedPeriodeId',
            'selectedWeek',
            'selectedMagangId'
        ));
    }

    /**
     * Store a newly created evaluation in storage.
     */
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

            // Get the magang to determine the job
            $magang = Magang::with('pelamar')->findOrFail($request->magang_id);
            $jobId = $magang->pelamar->job_id ?? null;
            $periodeId = $magang->pelamar->periode_id ?? null;

            // Update scores using SMART method if job is Cook or Pastry Chef
            if ($jobId && in_array($jobId, ['JOB001', 'JOB004'])) {
                $this->smartService->updateTotalScores($jobId, $periodeId);
                Log::info("Updated scores using SMART method for job: $jobId, period: $periodeId");

                // Invalidate cache for this magang
                $this->smartService->invalidateCache($request->magang_id);
            } else {
                Log::info("SMART method not applied for job: $jobId - Only used for Cook and Pastry Chef");
            }

            DB::commit();

            // Get the period ID to redirect back to the same period view
            $periodeId = $magang->pelamar->periode_id ?? null;
            $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];

            return redirect()->route('evaluasi.index', $redirectParams)
                ->with('success', 'Evaluation created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error creating evaluation: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Error creating evaluation: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified evaluation with SMART details.
     */
    public function show(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->load(['magang', 'magang.pelamar', 'magang.pelamar.job', 'ratingScale', 'criteria']);

        // Get SMART details for this evaluation
        $smartDetails = null;
        $criteriaContribution = null;

        if ($evaluasi->magang && $evaluasi->magang->pelamar &&
            $evaluasi->magang->pelamar->job_id &&
            in_array($evaluasi->magang->pelamar->job_id, ['JOB001', 'JOB004'])) {

            $jobId = $evaluasi->magang->pelamar->job_id;
            $periodeId = $evaluasi->magang->pelamar->periode_id;
            $magangId = $evaluasi->magang_id;
            $week = $evaluasi->minggu_ke;

            // Calculate SMART scores for this week
            $smartScores = $this->smartService->calculateScores($jobId, $week, $periodeId);

            // Find this intern's details
            foreach ($smartScores as $score) {
                if ($score['magang_id'] === $magangId) {
                    $smartDetails = $score;
                    break;
                }
            }

            // Get criteria contribution chart data
            $criteriaContribution = $this->smartService->getCriteriaContribution($magangId);
        }

        return view('evaluasi.show', compact('evaluasi', 'smartDetails', 'criteriaContribution'));
    }

    /**
     * Show the form for editing the specified evaluation.
     */
    public function edit(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->load(['magang', 'magang.pelamar', 'magang.pelamar.job']);

        // Get all interns for dropdown
        $magang = Magang::with(['pelamar', 'pelamar.job'])->get();

        // Get rating scales
        $ratingScales = RatingScale::orderBy('value')->get();

        // Get criteria based on the intern's job
        $jobId = $evaluasi->magang->pelamar->job_id ?? null;

        if ($jobId) {
            $criteria = Criteria::where('job_id', $jobId)->get();
        } else {
            // If no job ID, get all criteria
            $criteria = Criteria::all();
        }

        return view('evaluasi.edit', compact('evaluasi', 'magang', 'ratingScales', 'criteria'));
    }

    /**
     * Update the specified evaluation in storage.
     */
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

            // Get the magang to determine the job
            $magang = Magang::with('pelamar')->findOrFail($request->magang_id);
            $jobId = $magang->pelamar->job_id ?? null;
            $periodeId = $magang->pelamar->periode_id ?? null;

            // Update scores using SMART method if job is Cook or Pastry Chef
            if ($jobId && in_array($jobId, ['JOB001', 'JOB004'])) {
                $this->smartService->updateTotalScores($jobId, $periodeId);
                Log::info("Updated scores using SMART method for job: $jobId, period: $periodeId");

                // Invalidate cache for this magang
                $this->smartService->invalidateCache($request->magang_id);
            }

            // If magang_id changed, update the old magang's scores too
            if ($originalMagangId !== $request->magang_id) {
                // Get the original magang to determine its job
                $originalMagang = Magang::with('pelamar')->find($originalMagangId);
                if ($originalMagang && $originalMagang->pelamar &&
                    $originalMagang->pelamar->job_id &&
                    in_array($originalMagang->pelamar->job_id, ['JOB001', 'JOB004'])) {

                    $originalJobId = $originalMagang->pelamar->job_id;
                    $originalPeriodeId = $originalMagang->pelamar->periode_id;

                    // Update scores for original job
                    $this->smartService->updateTotalScores($originalJobId, $originalPeriodeId);
                    Log::info("Updated scores using SMART method for original job: $originalJobId");

                    // Invalidate cache for original magang
                    $this->smartService->invalidateCache($originalMagangId);
                }
            }

            DB::commit();

            // Get the period ID to redirect back to the same period view
            $periodeId = $magang->pelamar->periode_id ?? null;
            $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];

            return redirect()->route('evaluasi.index', $redirectParams)
                ->with('success', 'Evaluation updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating evaluation: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Error updating evaluation: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified evaluation from storage.
     */
    public function destroy(EvaluasiMingguanMagang $evaluasi)
    {
        // Get job and period IDs before deletion
        $jobId = null;
        $periodeId = null;
        $magangId = $evaluasi->magang_id;

        if ($evaluasi->magang && $evaluasi->magang->pelamar) {
            $jobId = $evaluasi->magang->pelamar->job_id;
            $periodeId = $evaluasi->magang->pelamar->periode_id;
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            $evaluasi->delete();

            // If job is Cook or Pastry Chef, update scores using SMART method
            if ($jobId && in_array($jobId, ['JOB001', 'JOB004'])) {
                $this->smartService->updateTotalScores($jobId, $periodeId);
                Log::info("Updated scores using SMART method after deletion for job: $jobId");

                // Invalidate cache for this magang
                $this->smartService->invalidateCache($magangId);
            }

            DB::commit();

            $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];
            return redirect()->route('evaluasi.index', $redirectParams)
                ->with('success', 'Evaluation deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error deleting evaluation: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Error deleting evaluation: ' . $e->getMessage());
        }
    }

    /**
     * Show SMART calculation dashboard for a specific job and period
     */
    public function smartDashboard(Request $request)
    {
        // Get job ID or default to Cook (JOB001)
        $jobId = $request->job_id ?? 'JOB001';

        // Validate that job ID is Cook or Pastry Chef
        if (!in_array($jobId, ['JOB001', 'JOB004'])) {
            return redirect()->route('evaluasi.index')
                ->with('error', 'SMART calculation is only available for Cook and Pastry Chef positions');
        }

        // Get period ID or default to latest
        $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
        $selectedPeriodeId = $request->periode_id ?? ($latestPeriode ? $latestPeriode->periode_id : null);

        // Get available jobs (only Cook and Pastry Chef)
        $jobs = Job::whereIn('job_id', ['JOB001', 'JOB004'])->orderBy('nama_job')->get();

        // Get available periods
        $periods = Periode::orderBy('tanggal_mulai', 'desc')->get();

        // Get criteria for the selected job
        $criteria = Criteria::where('job_id', $jobId)->orderBy('code')->get();

        // If no criteria found, show a message
        if ($criteria->isEmpty()) {
            return view('evaluasi.smart-dashboard', compact('jobs', 'periods', 'jobId', 'selectedPeriodeId'))
                ->with('error', 'No criteria found for this job');
        }

        // Get current period to determine weeks
        $currentPeriode = Periode::find($selectedPeriodeId);
        $weekCount = $currentPeriode ? ($currentPeriode->durasi_minggu_magang ?? 1) : 1;

        // Get all active interns for this job and period
        $interns = Magang::whereHas('pelamar', function($query) use ($jobId, $selectedPeriodeId) {
            $query->where('job_id', $jobId);
            if ($selectedPeriodeId) {
                $query->where('periode_id', $selectedPeriodeId);
            }
        })
        ->with(['pelamar'])
        ->get();

        // Get SMART rankings for each week
        $weeklyRankings = [];
        for ($week = 1; $week <= $weekCount; $week++) {
            $weeklyRankings[$week] = $this->smartService->calculateScores($jobId, $week, $selectedPeriodeId);
        }

        return view('evaluasi.smart-dashboard', compact(
            'jobs',
            'periods',
            'jobId',
            'selectedPeriodeId',
            'criteria',
            'interns',
            'weekCount',
            'weeklyRankings'
        ));
    }
}
