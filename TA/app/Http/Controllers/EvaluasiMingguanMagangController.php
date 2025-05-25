<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\RatingScale;
use App\Models\Periode;
use App\Models\Criteria;
use App\Models\Job;
use App\Services\SMARTCalculationService;
use App\Services\ActualCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CriteriaRatingScale;
use Illuminate\Support\Facades\Auth;

class EvaluasiMingguanMagangController extends Controller
{
    protected $smartService;
    protected $actualCalculationService;

    public function __construct(
        SMARTCalculationService $smartService,
        ActualCalculationService $actualCalculationService
    ) {
        $this->smartService = $smartService;
        $this->actualCalculationService = $actualCalculationService;
    }

    /**
     * Filter query based on user role
     */
    private function filterByUserRole($query)
    {
        // If user is admin, no filtering needed
        if (Auth::user()->role === 'admin') {
            return $query;
        }

        // For cook, only show cook job related data
        if (Auth::user()->role === 'cook') {
            return $query->whereHas('magang.pelamar', function ($q) {
                $q->whereHas('job', function ($jobQuery) {
                    $jobQuery->where('nama_job', 'like', '%cook%');
                });
            });
        }

        // For pastry, only show pastry job related data
        if (Auth::user()->role === 'pastry') {
            return $query->whereHas('magang.pelamar', function ($q) {
                $q->whereHas('job', function ($jobQuery) {
                    $jobQuery->where('nama_job', 'like', '%pastry%');
                });
            });
        }

        return $query;
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
        $allInterns = collect();
        $evaluationStatus = collect();
        $totalScores = collect();

        if ($selectedPeriodeId) {
            $periode = Periode::find($selectedPeriodeId);
            if ($periode) {
                $weekCount = $periode->durasi_minggu_magang ?? 1;

                // Get evaluations for this period
                $evaluationsByWeek = $this->getEvaluationsByWeek($selectedPeriodeId, $weekCount);

                // Get all criteria evaluations in one flat collection
                $evaluationsByCriteria = EvaluasiMingguanMagang::whereHas('magang', function($query) use ($selectedPeriodeId) {
                    $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                        $q->where('periode_id', $selectedPeriodeId);
                    });
                })
                ->with(['criteria'])
                ->get();

                // Get all interns for the selected period
                $allInterns = Magang::whereHas('pelamar', function($query) use ($selectedPeriodeId) {
                    $query->where('periode_id', $selectedPeriodeId);
                })
                ->with(['pelamar', 'pelamar.job'])
                ->get();

                // Get all evaluations for the selected period grouped by magang_id and minggu_ke
                $allEvaluations = EvaluasiMingguanMagang::whereIn('magang_id', $allInterns->pluck('magang_id'))
                    ->select('magang_id', 'minggu_ke', DB::raw('count(*) as count'))
                    ->groupBy('magang_id', 'minggu_ke')
                    ->get()
                    ->groupBy(['magang_id', 'minggu_ke']);

                // Get total scores for each intern for each week
                $totalScoresRaw = DB::table('total_skor_minggu_magang')
                    ->whereIn('magang_id', $allInterns->pluck('magang_id'))
                    ->select('magang_id', 'minggu_ke', 'total_skor')
                    ->get();

                // Restructure the data for easier access in the view
                $totalScores = collect();
                foreach ($totalScoresRaw as $score) {
                    if (!$totalScores->has($score->magang_id)) {
                        $totalScores[$score->magang_id] = collect();
                    }
                    $totalScores[$score->magang_id][$score->minggu_ke] = $score;
                }

                // Log scores for debugging
                Log::info('Total scores data in controller:', [
                    'count' => $totalScores->count(),
                    'sample' => $totalScores->take(2)->toArray()
                ]);

                // Prepare evaluation status data
                $evaluationStatus = $allEvaluations;
            }
        }

        return view('evaluasi.index', compact(
            'periods',
            'selectedPeriodeId',
            'evaluationsByWeek',
            'weekCount',
            'evaluationsByCriteria',
            'allInterns',
            'evaluationStatus',
            'totalScores'
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
            ->with(['magang', 'magang.pelamar', 'magang.pelamar.job', 'criteria', 'criteriaRatingScale'])
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
            'week' => 'nullable|integer|min:1',
            'magang_id' => 'nullable|exists:magang,magang_id',
        ]);

        $periodeId = $request->periode_id;
        $week = $request->week;
        $magangId = $request->magang_id;

        try {
            // Log request parameters for debugging
            Log::info('getByWeek request', [
                'periode_id' => $periodeId,
                'week' => $week,
                'magang_id' => $magangId
            ]);

            // Build the query
            $query = EvaluasiMingguanMagang::with([
                'magang',
                'magang.pelamar',
                'magang.pelamar.job',
                'criteriaRatingScale',
                'criteria'
            ])
            ->whereHas('magang', function($query) use ($periodeId) {
                $query->whereHas('pelamar', function($q) use ($periodeId) {
                    $q->where('periode_id', $periodeId);
                });
            });

            // Filter by week if provided
            if ($week) {
                $query->where('minggu_ke', $week);
            }

            // Filter by magang_id if provided
            if ($magangId) {
                $query->where('magang_id', $magangId);
            }

            // Apply role-based filtering
            $evaluations = $this->filterByUserRole($query)->get();

            // Get total scores for each magang for this week or all weeks
            $totalScoresQuery = DB::table('total_skor_minggu_magang')
                ->whereIn('magang_id', $evaluations->pluck('magang_id')->unique());

            if ($week) {
                // If specific week, get scores for just that week
                $totalScoresQuery->where('minggu_ke', $week);
                $totalScores = $totalScoresQuery->pluck('total_skor', 'magang_id');
            } else {
                // If all weeks, restructure for easier access
                $totalScoresRaw = $totalScoresQuery
                    ->select('magang_id', 'minggu_ke', 'total_skor')
                    ->get();

                $totalScores = collect();
                foreach ($totalScoresRaw as $score) {
                    if (!$totalScores->has($score->magang_id)) {
                        $totalScores[$score->magang_id] = collect();
                    }
                    $totalScores[$score->magang_id][$score->minggu_ke] = $score->total_skor;
                }
            }

            // Append total scores to each evaluation
            foreach ($evaluations as $evaluation) {
                if ($week) {
                    $evaluation->total_score = $totalScores[$evaluation->magang_id] ?? 0;
                    // Add evaluation status flag based on total score
                    $evaluation->is_fully_evaluated = $evaluation->total_score > 0;
                } else {
                    $magangScores = $totalScores[$evaluation->magang_id] ?? collect();
                    $evaluation->total_score = $magangScores[$evaluation->minggu_ke] ?? 0;
                    // Add evaluation status flag based on total score
                    $evaluation->is_fully_evaluated = $evaluation->total_score > 0;
                }
            }

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

        // Filter magang based on user role
        $magangs = $this->filterByUserRole(Magang::query())
            ->with('pelamar')
            ->when($selectedPeriodeId, function($query) use ($selectedPeriodeId) {
                return $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                    $q->where('periode_id', $selectedPeriodeId);
                });
            })
            ->get();

        // Get all criteria
        $criteria = Criteria::with('job')->get();

        // Get default criteria rating scales
        // Note: In the view, we'll use JavaScript to fetch specific scales for selected criteria
        $criteriaRatingScales = CriteriaRatingScale::orderBy('rating_level')->limit(1)->get();

        return view('evaluasi.create', compact('magangs', 'criteria', 'criteriaRatingScales', 'selectedWeek', 'selectedMagangId'));
    }

    /**
     * Store a newly created evaluation in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'magang_id' => 'required|exists:magang,magang_id',
            'criteria_rating_id' => 'nullable|exists:criteria_rating_scales,id',
            'criteria_id' => 'required|exists:criteria,criteria_id',
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
            // Create the evaluation
            $evaluasi = new EvaluasiMingguanMagang();
            $evaluasi->evaluasi_id = Str::uuid()->toString();
            $evaluasi->magang_id = $request->magang_id;
            $evaluasi->criteria_rating_id = $request->criteria_rating_id;
            $evaluasi->criteria_id = $request->criteria_id;
            $evaluasi->minggu_ke = $request->minggu_ke;
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
        // Check if the current user has access to this evaluation based on role
        if (Auth::user()->role !== 'admin') {
            $jobName = $evaluasi->magang->pelamar->job->nama_job ?? '';

            if ((Auth::user()->role === 'cook' && !str_contains(strtolower($jobName), 'cook')) ||
                (Auth::user()->role === 'pastry' && !str_contains(strtolower($jobName), 'pastry'))) {
                abort(403, 'You are not authorized to view this evaluation');
            }
        }

        $evaluasi->load(['magang', 'magang.pelamar', 'magang.pelamar.job', 'criteriaRatingScale', 'criteria']);

        // Get all evaluations for this intern for the same week
        $evaluasiList = EvaluasiMingguanMagang::where('magang_id', $evaluasi->magang_id)
            ->where('minggu_ke', $evaluasi->minggu_ke)
            ->with(['criteria', 'criteriaRatingScale'])
            ->get();

        // Get SMART details for this evaluation
        $smartDetails = null;
        $criteriaContribution = null;
        $actualCalculation = null;

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

            // Get actual calculation data with detailed steps
            $actualCalculation = $this->actualCalculationService->getActualCalculation($evaluasi);
        }

        return view('evaluasi.show', compact('evaluasi', 'evaluasiList', 'smartDetails', 'criteriaContribution', 'actualCalculation'));
    }

    /**
     * Show the form for editing the specified evaluation.
     */
    public function edit(EvaluasiMingguanMagang $evaluasi)
    {
        try {
            // Load the evaluation with related data
            $evaluasi->load(['magang', 'magang.pelamar', 'magang.pelamar.job', 'magang.pelamar.periode', 'criteria', 'criteriaRatingScale']);

            // Get the job ID from the intern's data
            $jobId = $evaluasi->magang->pelamar->job->job_id ?? null;

            if (!$jobId) {
                return redirect()->route('evaluasi.index')
                    ->with('error', 'Cannot edit this evaluation: Job ID not found for the intern.');
            }

            // Get all criteria for this job
            $criteria = Criteria::where('job_id', $jobId)
                ->orderBy('code')
                ->get();

            // Get all rating scales for these criteria
            $criteriaIds = $criteria->pluck('criteria_id')->toArray();
            $criteriaRatingScales = CriteriaRatingScale::whereIn('criteria_id', $criteriaIds)
                ->orderBy('rating_level')
                ->get();

            // Get all evaluations for this intern for the specified week
            $allEvaluations = EvaluasiMingguanMagang::where('magang_id', $evaluasi->magang_id)
                ->where('minggu_ke', $evaluasi->minggu_ke)
                ->with(['criteria', 'criteriaRatingScale'])
                ->get();

            // Get all available interns (magang)
            $magangList = Magang::with(['pelamar', 'pelamar.job', 'pelamar.periode'])
                ->whereHas('pelamar', function($query) use ($evaluasi) {
                    // Filter interns in the same period as the current evaluation
                    $periodeId = $evaluasi->magang->pelamar->periode_id ?? null;
                    if ($periodeId) {
                        $query->where('periode_id', $periodeId);
                    }
                })
                ->get();

            return view('evaluasi.edit', compact(
                'evaluasi',
                'criteria',
                'criteriaRatingScales',
                'allEvaluations',
                'magangList'
            ));
        } catch (\Exception $e) {
            Log::error("Error in edit method: " . $e->getMessage(), [
                'exception' => $e,
                'evaluasi_id' => $evaluasi->evaluasi_id
            ]);

            // Default values in case of error
            $criteria = collect();
            $criteriaRatingScales = collect();
            $allEvaluations = collect();
            $magangList = collect();

            // Load minimal data to avoid further errors
            if (!$evaluasi->relationLoaded('magang')) {
                $evaluasi->load(['magang', 'magang.pelamar']);
            }

            // Get all interns as fallback
            $magangList = Magang::with(['pelamar', 'pelamar.job', 'pelamar.periode'])->get();

            return view('evaluasi.edit', compact(
                'evaluasi',
                'criteria',
                'criteriaRatingScales',
                'allEvaluations',
                'magangList'
            ))->with('error', 'Error loading evaluation data: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified evaluation in storage.
     */
    public function update(Request $request, EvaluasiMingguanMagang $evaluasi)
    {
        $request->validate([
            'magang_id' => 'required|exists:magang,magang_id',
            'minggu_ke' => 'required|integer|min:1',
            'ratings' => 'sometimes|array',
            'ratings.*' => 'nullable|exists:criteria_rating_scales,id',
        ]);

        // Log the request parameters for debugging
        Log::info('Evaluation update request parameters:', [
            'request_data' => $request->all(),
            'current_evaluasi' => [
                'id' => $evaluasi->evaluasi_id,
                'magang_id' => $evaluasi->magang_id,
                'minggu_ke' => $evaluasi->minggu_ke
            ]
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Store the original magang_id and week for updating scores
            $originalMagangId = $evaluasi->magang_id;
            $originalWeek = $evaluasi->minggu_ke;

            // Get the magang to determine the job
            $magang = Magang::with('pelamar')->findOrFail($request->magang_id);
            $jobId = $magang->pelamar->job_id ?? null;
            $periodeId = $magang->pelamar->periode_id ?? null;

            // If either magang_id or week changed, we need to handle all evaluations for this intern/week
            $magangIdChanged = $request->magang_id != $originalMagangId;
            $weekChanged = $request->minggu_ke != $originalWeek;

            if ($magangIdChanged || $weekChanged) {
                // Get all evaluations for the original intern/week
                $allEvaluations = EvaluasiMingguanMagang::where('magang_id', $originalMagangId)
                    ->where('minggu_ke', $originalWeek)
                    ->get();

                // Update magang_id and week for all evaluations
                foreach ($allEvaluations as $eval) {
                    $eval->magang_id = $request->magang_id;
                    $eval->minggu_ke = $request->minggu_ke;
                    $eval->save();
                }
            }

            // Process the ratings from the form
            if ($request->has('ratings') && is_array($request->ratings)) {
                foreach ($request->ratings as $criteriaId => $ratingId) {
                    // Find or create an evaluation for this criteria
                    $evalForCriteria = EvaluasiMingguanMagang::firstOrNew([
                        'magang_id' => $request->magang_id,
                        'criteria_id' => $criteriaId,
                        'minggu_ke' => $request->minggu_ke,
                    ]);

                    // If this is a new evaluation, set the ID
                    if (!$evalForCriteria->exists) {
                        $evalForCriteria->evaluasi_id = Str::uuid()->toString();
                    }

                    // Update the rating
                    $evalForCriteria->criteria_rating_id = $ratingId ?: null;
                    $evalForCriteria->save();
                }
            }

            // Update scores using SMART method if job is Cook or Pastry Chef
            if ($jobId && in_array($jobId, ['JOB001', 'JOB004'])) {
                $this->smartService->updateTotalScores($jobId, $periodeId);
                Log::info("Updated scores using SMART method for job: $jobId, period: $periodeId");

                // Invalidate cache for this magang
                $this->smartService->invalidateCache($request->magang_id);
            }

            // If magang_id changed, update the old magang's scores too
            if ($magangIdChanged) {
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
            Log::error("Error updating evaluation: " . $e->getMessage(), [
                'exception' => $e,
                'evaluasi_id' => $evaluasi->evaluasi_id,
                'request_data' => $request->all()
            ]);
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
        $jobs = Job::all();

        // Filter jobs based on user role
        if (Auth::user()->role === 'cook') {
            $jobs = $jobs->filter(function($job) {
                return str_contains(strtolower($job->nama_job), 'cook');
            });
        } elseif (Auth::user()->role === 'pastry') {
            $jobs = $jobs->filter(function($job) {
                return str_contains(strtolower($job->nama_job), 'pastry');
            });
        }

        $jobId = $request->input('job_id', optional($jobs->first())->job_id);

        // If no jobs available based on role restrictions, show empty data
        if (!$jobId) {
            return view('evaluasi.smart-dashboard', [
                'jobs' => $jobs,
                'periods' => collect([]),
                'jobId' => null,
                'selectedPeriodeId' => null,
                'criteria' => collect([]),
                'interns' => collect([]),
                'weekCount' => 0,
                'weeklyRankings' => collect([])
            ]);
        }

        try {
            // Get period ID or default to latest
            $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
            $selectedPeriodeId = $request->periode_id ?? ($latestPeriode ? $latestPeriode->periode_id : null);

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
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error in smartDashboard method: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            // Redirect with error message
            return redirect()->route('evaluasi.index')
                ->with('error', 'Error loading SMART dashboard: ' . $e->getMessage());
        }
    }

    /**
     * API endpoint to update an evaluation rating via AJAX
     */
    public function updateRating(Request $request)
    {
        try {
            $validated = $request->validate([
                'evaluation_id' => 'required|exists:evaluasi_mingguan_magang,evaluasi_id',
                'criteria_rating_id' => 'nullable|exists:criteria_rating_scales,id',
                'preview_only' => 'sometimes|boolean',
            ]);

            // Start a transaction
            DB::beginTransaction();

            // Find the evaluation
            $evaluasi = EvaluasiMingguanMagang::findOrFail($request->evaluation_id);

            // Check if this is a preview-only request
            $isPreview = $request->has('preview_only') && $request->preview_only === true;

            if (!$isPreview) {
                // Update rating in the database if not in preview mode
                $evaluasi->criteria_rating_id = $request->criteria_rating_id;
                $evaluasi->save();
            } else {
                // For preview, just update the model temporarily without saving
                $evaluasi->criteria_rating_id = $request->criteria_rating_id;
            }

            // Get the magang to determine the job
            $magang = Magang::with('pelamar')->findOrFail($evaluasi->magang_id);
            $jobId = $magang->pelamar->job_id ?? null;
            $periodeId = $magang->pelamar->periode_id ?? null;

            // Fetch the current rating value if a rating is provided
            $ratingValue = null;
            if ($request->criteria_rating_id) {
                $criteriaRating = CriteriaRatingScale::findOrFail($request->criteria_rating_id);
                $ratingValue = $criteriaRating->rating_level;
                Log::info("Rating value for evaluasi {$evaluasi->evaluasi_id}: {$ratingValue} (from rating level {$criteriaRating->rating_level})");
            }

            // Update scores using SMART method if job is Cook or Pastry Chef
            if ($jobId && in_array($jobId, ['JOB001', 'JOB004'])) {
                if (!$isPreview) {
                    // Only update database in non-preview mode
                    $this->smartService->updateTotalScores($jobId, $periodeId);

                    // Invalidate cache for this magang
                    $this->smartService->invalidateCache($evaluasi->magang_id);
                }
            }

            // Get total score from the total_skor_minggu table
            $totalScore = DB::table('total_skor_minggu_magang')
                ->where('magang_id', $evaluasi->magang_id)
                ->where('minggu_ke', $evaluasi->minggu_ke)
                ->value('total_skor');

            // If no score was found in the database, return 0
            if ($totalScore === null) {
                $totalScore = 0;
                Log::warning("No total score found for magang_id: {$evaluasi->magang_id}, minggu_ke: {$evaluasi->minggu_ke}");
            }

            if (!$isPreview) {
                // Commit database changes in non-preview mode
                DB::commit();
            } else {
                // Rollback in preview mode - no database changes
                DB::rollBack();
            }

            // Return success response with updated data
            return response()->json([
                'success' => true,
                'message' => $isPreview ? 'Rating preview generated' : 'Rating updated successfully',
                'is_preview' => $isPreview,
                'evaluation' => [
                    'evaluasi_id' => $evaluasi->evaluasi_id,
                    'criteria_rating_id' => $evaluasi->criteria_rating_id,
                    'criteria_rating_scale' => $evaluasi->criteriaRatingScale,
                    'rating_value' => $ratingValue ?? 0
                ],
                'total_score' => (float)$totalScore, // Cast to float to ensure it's a number
                'originalRatingLevel' => $request->criteria_rating_id ? $criteriaRating->rating_level : null
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error("Validation error updating rating: " . json_encode($e->errors()));

            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', array_map(function ($errors) {
                    return implode(', ', $errors);
                }, $e->errors())),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating rating: " . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error updating rating: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API endpoint to get ratings for a specific criterion
     */
    public function getCriteriaRatings(Request $request)
    {
        try {
            // Log the incoming request for debugging
            Log::info('Criteria Ratings Request:', [
                'criteria_id' => $request->criteria_id,
                'all_parameters' => $request->all()
            ]);

            // Check if the criteria_id is in the format 'K1', 'K2', etc.
            if (preg_match('/^K\d+$/', $request->criteria_id)) {
                // This is a code, not an ID - let's try to find the criteria by code
                $criteria = Criteria::where('code', $request->criteria_id)->first();

                if ($criteria) {
                    Log::info('Found criteria by code', ['code' => $request->criteria_id, 'criteria_id' => $criteria->criteria_id]);
                    // Use the actual criteria_id instead of the code
                    $ratings = CriteriaRatingScale::where('criteria_id', $criteria->criteria_id)
                        ->orderBy('rating_level')
                        ->get();
                } else {
                    Log::warning('Criteria not found by code', ['code' => $request->criteria_id]);
                    // Return empty ratings instead of 404 error
                    return response()->json([
                        'success' => true,
                        'ratings' => [],
                        'message' => 'No criteria found with code: ' . $request->criteria_id
                    ]);
                }
            } else {
                // Regular validation for direct criteria_id lookup
                $validated = $request->validate([
                    'criteria_id' => 'required|exists:criteria,criteria_id',
                ]);

                // Get all rating scales for this specific criterion
                $ratings = CriteriaRatingScale::where('criteria_id', $request->criteria_id)
                    ->orderBy('rating_level')
                    ->get();
            }

            Log::info('Returning ratings', ['count' => $ratings->count()]);

            return response()->json([
                'success' => true,
                'ratings' => $ratings
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching criteria ratings: " . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error fetching ratings: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get evaluation data for a specific intern and week
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEvaluationData(Request $request)
    {
        $request->validate([
            'magang_id' => 'required|exists:magang,magang_id',
            'minggu_ke' => 'required|integer|min:1',
        ]);

        $magangId = $request->magang_id;
        $mingguKe = $request->minggu_ke;

        try {
            // First check if there's already an evaluation for this intern and week
            $evaluasi = EvaluasiMingguanMagang::where('magang_id', $magangId)
                ->where('minggu_ke', $mingguKe)
                ->first();

            if ($evaluasi) {
                // Return the existing evaluation ID
                return response()->json([
                    'status' => 'success',
                    'evaluasi_id' => $evaluasi->evaluasi_id,
                    'message' => 'Existing evaluation found',
                    'found' => true
                ]);
            }

            // If no evaluation exists, create one
            $magang = Magang::with('pelamar')->findOrFail($magangId);
            $jobId = $magang->pelamar->job_id ?? null;

            if (!$jobId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Job ID not found for the intern',
                    'found' => false
                ], 404);
            }

            // Get the first criteria for this job to create an initial evaluation
            $criteria = Criteria::where('job_id', $jobId)->first();

            if (!$criteria) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No criteria found for this job',
                    'found' => false
                ], 404);
            }

            // Create a new evaluation
            $newEvaluasi = new EvaluasiMingguanMagang();
            $newEvaluasi->evaluasi_id = Str::uuid()->toString();
            $newEvaluasi->magang_id = $magangId;
            $newEvaluasi->minggu_ke = $mingguKe;
            $newEvaluasi->criteria_id = $criteria->criteria_id;
            $newEvaluasi->save();

            return response()->json([
                'status' => 'success',
                'evaluasi_id' => $newEvaluasi->evaluasi_id,
                'message' => 'New evaluation created',
                'found' => false
            ]);
        } catch (\Exception $e) {
            Log::error("Error getting evaluation data: " . $e->getMessage(), [
                'exception' => $e,
                'magang_id' => $magangId,
                'minggu_ke' => $mingguKe
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Error getting evaluation data: ' . $e->getMessage(),
                'found' => false
            ], 500);
        }
    }
}
