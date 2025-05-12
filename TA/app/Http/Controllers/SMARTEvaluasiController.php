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
     * Display SMART ranking for a specific job, week, and period
     */
    public function index(Request $request)
    {
        $jobs = Job::all();
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
        $job = Job::findOrFail($jobId);
        $criteria = Criteria::where('job_id', $jobId)->get();

        return view('smart.criteria-weights', compact('job', 'criteria'));
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
        $job = Job::findOrFail($jobId);
        $periodes = Periode::orderBy('tanggal_mulai', 'desc')->get();

        // Get selected period
        $selectedPeriodeId = $request->periode_id;

        // Update total scores using SMART
        $success = $this->smartService->updateTotalScores($jobId, $selectedPeriodeId);

        // Get updated intern rankings
        $internsQuery = Magang::whereHas('pelamar', function($query) use ($jobId, $selectedPeriodeId) {
            $query->where('job_id', $jobId);
            if ($selectedPeriodeId) {
                $query->where('periode_id', $selectedPeriodeId);
            }
        })
        ->with(['pelamar', 'pelamar.job', 'pelamar.periode', 'evaluasiMingguan'])
        ->orderBy('rank')
        ->orderByDesc('total_skor');

        $interns = $internsQuery->get();

        return view('smart.rankings', compact('job', 'periodes', 'interns', 'selectedPeriodeId'));
    }

    /**
     * Show detailed evaluation breakdown for an intern
     */
    public function showInternDetail($jobId, $magangId)
    {
        $job = Job::findOrFail($jobId);
        $magang = Magang::with(['pelamar', 'pelamar.job', 'pelamar.periode', 'evaluasiMingguan'])->findOrFail($magangId);

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

        return view('smart.intern-detail', compact(
            'job',
            'magang',
            'periode',
            'criteria',
            'weeklyScores'
        ));
    }
}
