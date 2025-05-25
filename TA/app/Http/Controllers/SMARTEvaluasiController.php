<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Magang;
use App\Models\Periode;
use App\Models\Criteria;
use App\Models\EvaluasiMingguanMagang;
use App\Services\AHPCalculationService;
use App\Services\SMARTCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SMARTEvaluasiController extends Controller
{
    protected $ahpService;
    protected $smartService;

    public function __construct(AHPCalculationService $ahpService, SMARTCalculationService $smartService)
    {
        $this->ahpService = $ahpService;
        $this->smartService = $smartService;
    }

    /**
     * Filter jobs based on user role
     */
    private function filterJobsByRole($jobs)
    {
        if (Auth::user()->role === 'admin') {
            return $jobs;
        }

        if (Auth::user()->role === 'cook') {
            return $jobs->filter(function($job) {
                return str_contains(strtolower($job->nama_job), 'cook');
            });
        }

        if (Auth::user()->role === 'pastry') {
            return $jobs->filter(function($job) {
                return str_contains(strtolower($job->nama_job), 'pastry');
            });
        }

        return $jobs;
    }

    /**
     * Filter magang/interns based on user role
     */
    private function filterMagangByRole($query)
    {
        if (Auth::user()->role === 'admin') {
            return $query;
        }

        if (Auth::user()->role === 'cook') {
            return $query->whereHas('pelamar', function($q) {
                $q->whereHas('job', function($jobQuery) {
                    $jobQuery->where('nama_job', 'like', '%cook%');
                });
            });
        }

        if (Auth::user()->role === 'pastry') {
            return $query->whereHas('pelamar', function($q) {
                $q->whereHas('job', function($jobQuery) {
                    $jobQuery->where('nama_job', 'like', '%pastry%');
                });
            });
        }

        return $query;
    }

    /**
     * Display SMART ranking for a specific job, week, and period
     */
    public function index(Request $request)
    {
        $jobs = $this->filterJobsByRole(Job::all());
        $periodes = Periode::orderBy('tanggal_mulai', 'desc')->get();

        // Get selected job, period and week
        $selectedJobId = $request->job_id;
        $selectedPeriodeId = $request->periode_id;
        $selectedWeek = $request->week ?? 1;

        $criteria = collect();
        $smartRankings = [];
        $maxWeek = 1;

        // If job is selected, get criteria and SMART rankings
        if ($selectedJobId) {
            $job = Job::findOrFail($selectedJobId);
            $criteria = Criteria::where('job_id', $selectedJobId)->get();

            // Get max week number from periode if selected
            if ($selectedPeriodeId) {
                $periode = Periode::find($selectedPeriodeId);
                if ($periode) {
                    $maxWeek = $periode->durasi_minggu_magang;
                }
            }

            // Only proceed if criteria exist and have weights
            if ($criteria->isNotEmpty() && $criteria->where('weight', '>', 0)->count() > 0) {
                $smartRankings = $this->smartService->calculateScores(
                    $selectedJobId,
                    $selectedWeek,
                    $selectedPeriodeId
                );
            }
        }

        return view('smart.evaluasi-index', compact(
            'jobs',
            'periodes',
            'criteria',
            'selectedJobId',
            'selectedPeriodeId',
            'selectedWeek',
            'smartRankings',
            'maxWeek'
        ));
    }

    /**
     * Show all criteria and their weights for AHP
     */
    public function showCriteriaWeights($jobId)
    {
        // Check if user has access to this job
        if (Auth::user()->role !== 'admin') {
            $job = Job::find($jobId);
            if (!$job) {
                abort(404, 'Job not found');
            }

            if ((Auth::user()->role === 'cook' && !str_contains(strtolower($job->nama_job), 'cook')) ||
                (Auth::user()->role === 'pastry' && !str_contains(strtolower($job->nama_job), 'pastry'))) {
                abort(403, 'Unauthorized access');
            }
        }

        $criteria = Criteria::where('job_id', $jobId)->orderBy('priority')->get();

        return view('smart.evaluasi.criteria', [
            'job' => Job::find($jobId),
            'criteria' => $criteria
        ]);
    }

    /**
     * Calculate or recalculate AHP weights for criteria
     */
    public function calculateWeights(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        // Calculate weights using AHP service
        $weights = $this->ahpService->calculateWeights($jobId);

        if ($weights) {
            return redirect()->route('smart.criteria', $jobId)
                ->with('success', 'Criteria weights have been calculated successfully using AHP.');
        } else {
            return redirect()->back()
                ->with('error', 'Error calculating criteria weights. Please check if criteria comparisons are complete.');
        }
    }

    /**
     * Show SMART ranking results for a specific job
     */
    public function showRankings(Request $request, $jobId)
    {
        // Check if user has access to this job
        if (Auth::user()->role !== 'admin') {
            $job = Job::find($jobId);
            if (!$job) {
                abort(404, 'Job not found');
            }

            if ((Auth::user()->role === 'cook' && !str_contains(strtolower($job->nama_job), 'cook')) ||
                (Auth::user()->role === 'pastry' && !str_contains(strtolower($job->nama_job), 'pastry'))) {
                abort(403, 'Unauthorized access');
            }
        }

        $criteria = Criteria::where('job_id', $jobId)->get();

        $magangQuery = Magang::with(['pelamar' => function($query) use ($jobId) {
            $query->where('job_id', $jobId);
        }])->whereHas('pelamar', function($query) use ($jobId) {
            $query->where('job_id', $jobId);
        });

        // Filter interns based on user role
        $interns = $this->filterMagangByRole($magangQuery)->get();

        return view('smart.evaluasi.rankings', [
            'job' => Job::find($jobId),
            'interns' => $interns,
            'criteria' => $criteria
        ]);
    }

    /**
     * Show detailed evaluation breakdown for an intern
     */
    public function showInternDetail($jobId, $magangId)
    {
        $magang = Magang::with('pelamar')->findOrFail($magangId);

        // Check if user has access to this intern
        if (Auth::user()->role !== 'admin') {
            $job = Job::find($jobId);
            if (!$job) {
                abort(404, 'Job not found');
            }

            if ((Auth::user()->role === 'cook' && !str_contains(strtolower($job->nama_job), 'cook')) ||
                (Auth::user()->role === 'pastry' && !str_contains(strtolower($job->nama_job), 'pastry'))) {
                abort(403, 'Unauthorized access');
            }

            // Double-check the intern's job also matches user's role
            $internJobName = $magang->pelamar->job->nama_job ?? '';
            if ((Auth::user()->role === 'cook' && !str_contains(strtolower($internJobName), 'cook')) ||
                (Auth::user()->role === 'pastry' && !str_contains(strtolower($internJobName), 'pastry'))) {
                abort(403, 'Unauthorized access');
            }
        }

        // Get periode details
        $periode = null;
        if ($magang->pelamar && $magang->pelamar->periode_id) {
            $periode = Periode::find($magang->pelamar->periode_id);
        }

        // Only proceed if periode exists
        if (!$periode) {
            return redirect()->back()->with('error', 'Cannot find period information for this intern.');
        }

        $criteria = Criteria::where('job_id', $jobId)->get();
        $weeklyScores = [];

        // Calculate scores for each week
        for ($week = 1; $week <= $periode->durasi_minggu_magang; $week++) {
            $weekScores = $this->smartService->calculateScores($jobId, $week, $periode->periode_id);
            $internScore = collect($weekScores)->firstWhere('magang_id', $magangId);

            if ($internScore) {
                $weeklyScores[$week] = $internScore;
            }
        }

        return view('smart.evaluasi.intern-detail', [
            'job' => Job::find($jobId),
            'intern' => $magang,
            'periode' => $periode,
            'criteria' => $criteria,
            'weeklyScores' => $weeklyScores
        ]);
    }
}
