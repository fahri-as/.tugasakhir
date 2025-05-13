<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Pelamar;
use App\Models\User;
use App\Models\TesKemampuan;
use App\Models\EvaluasiMingguanMagang;
use App\Models\RatingScale;
use App\Models\Criteria;
use App\Models\Job;
use App\Models\Periode;
use App\Services\SMARTCalculationService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\InternshipScheduled;

class MagangController extends Controller
{
    protected $smartService;

    public function __construct(SMARTCalculationService $smartService)
    {
        $this->smartService = $smartService;
    }

    /**
     * Display a listing of magang records with filtering and sorting options.
     */
    public function index(Request $request)
    {
        // Start with base query
        $query = Magang::with(['pelamar', 'pelamar.job', 'pelamar.periode', 'user', 'evaluasiMingguan']);

        // Check if we need to filter by period
        if ($request->filled('periode_id')) {
            // If a specific period is selected, filter by it
            $query->whereHas('pelamar', function($q) use ($request) {
                $q->where('periode_id', $request->periode_id);
            });
        } else if (!$request->has('periode_id')) {
            // First page load - default to most recent period
            $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
            if ($latestPeriode) {
                $query->whereHas('pelamar', function($q) use ($latestPeriode) {
                    $q->where('periode_id', $latestPeriode->periode_id);
                });
            }
        }

        // Filter by selected jobs if jobs filter is applied
        if ($request->filled('jobs') && is_array($request->jobs)) {
            $query->whereHas('pelamar', function($q) use ($request) {
                $q->whereIn('job_id', $request->jobs);
            });
        }

        // Handle sorting
        $sortBy = $request->input('sort_by', 'total_skor');
        $sortDir = $request->input('sort_dir', 'desc');

        // Allowed sort columns
        $allowedSortColumns = [
            'magang_id', 'total_skor', 'rank', 'status_seleksi', 'jadwal_mulai'
        ];

        // Sort by direct columns
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDir);
        }
        // Sort by relationships
        else if ($sortBy === 'pelamar_nama') {
            $query->join('pelamar', 'magang.pelamar_id', '=', 'pelamar.pelamar_id')
                  ->orderBy('pelamar.nama', $sortDir)
                  ->select('magang.*');
        }
        else if ($sortBy === 'job_nama') {
            $query->join('pelamar', 'magang.pelamar_id', '=', 'pelamar.pelamar_id')
                  ->join('job', 'pelamar.job_id', '=', 'job.job_id')
                  ->orderBy('job.nama_job', $sortDir)
                  ->select('magang.*');
        }
        else if ($sortBy === 'periode_nama') {
            $query->join('pelamar', 'magang.pelamar_id', '=', 'pelamar.pelamar_id')
                  ->join('periode', 'pelamar.periode_id', '=', 'periode.periode_id')
                  ->orderBy('periode.nama_periode', $sortDir)
                  ->select('magang.*');
        }
        // Default sort by total_skor descending if none specified
        else {
            $query->orderBy('total_skor', 'desc');
        }

        $magang = $query->get();

        // Get all available periods
        $periods = Periode::orderBy('tanggal_mulai', 'desc')->get();

        // Get all available jobs
        $jobs = Job::orderBy('nama_job')->get();

        // Prepare SMART visualization data for Cook and Pastry Chef positions
        $smartData = [];

        // Group magang by job for SMART visualization
        $byJob = $magang->groupBy(function($item) {
            return $item->pelamar->job_id ?? 'unknown';
        });

        foreach ($byJob as $jobId => $magangGroup) {
            if ($jobId !== 'unknown' && in_array($jobId, ['JOB001', 'JOB004'])) {
                // Get all interns' magang_id for this job
                $magangIds = $magangGroup->pluck('magang_id')->toArray();

                // Prepare visualization data
                $smartData[$jobId] = [
                    'job_name' => $magangGroup->first()->pelamar->job->nama_job ?? 'Unknown Job',
                    'interns' => []
                ];

                // Get SMART details for each intern
                foreach ($magangGroup as $m) {
                    $smartDetails = $this->smartService->getScoreDetails($m->magang_id);
                    $weeklyScores = $this->smartService->getWeeklyScores($m->magang_id);

                    $smartData[$jobId]['interns'][] = [
                        'magang_id' => $m->magang_id,
                        'name' => $m->pelamar->nama,
                        'total_score' => $m->total_skor,
                        'rank' => $m->rank,
                        'weekly_scores' => $weeklyScores
                    ];
                }
            }
        }

        return view('magang.index', compact(
            'magang',
            'periods',
            'jobs',
            'smartData',
            'sortBy',
            'sortDir'
        ));
    }


    /**
     * Schedule the start date for an internship.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TesKemampuan  $tesKemampuan
     * @return \Illuminate\Http\Response
     */
    public function scheduleStart(Request $request, TesKemampuan $tesKemampuan)
    {
        $request->validate([
            'jadwal_tanggal' => 'required|date',
            'jadwal_waktu' => 'required',
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
        ]);

        // Combine date and time
        $jadwalMulai = $request->jadwal_tanggal . ' ' . $request->jadwal_waktu . ':00';

        // Check if datetime is in the future
        $scheduledTime = \Carbon\Carbon::parse($jadwalMulai);
        $now = \Carbon\Carbon::now();

        if ($scheduledTime <= $now) {
            return redirect()->back()->with('error', 'Internship start time must be in the future.');
        }

        // Start a transaction
        DB::beginTransaction();

        try {
            // Find existing magang record or create a new one
            $magang = Magang::where('pelamar_id', $request->pelamar_id)->first();

            if (!$magang) {
                // Generate a unique ID for the new magang record
                try {
                    // Find the highest ID numerically by extracting the number part
                    $maxMagangId = Magang::selectRaw('CAST(SUBSTRING(magang_id, 4) AS UNSIGNED) as id_num')
                        ->orderBy('id_num', 'desc')
                        ->first();

                    $nextMagangId = $maxMagangId ? $maxMagangId->id_num + 1 : 1;
                    $magangId = 'MAG' . str_pad($nextMagangId, 3, '0', STR_PAD_LEFT);

                    // Double-check that this ID doesn't already exist
                    while (Magang::where('magang_id', $magangId)->exists()) {
                        $nextMagangId++;
                        $magangId = 'MAG' . str_pad($nextMagangId, 3, '0', STR_PAD_LEFT);
                    }
                } catch (\Exception $e) {
                    // Fallback if there's an issue
                    $magangId = 'MAG' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);
                }

                // Create new magang record
                $magang = new Magang();
                $magang->magang_id = $magangId;
                $magang->pelamar_id = $request->pelamar_id;
                $magang->user_id = $request->user_id;
                $magang->status_seleksi = 'Sedang Berjalan';
                $magang->total_skor = 0;
            } else {
                // Update existing record
                $magang->status_seleksi = 'Sedang Berjalan';
            }

            // Set the start date
            $magang->jadwal_mulai = $jadwalMulai;
            $magang->save();

            // Update the applicant status
            $pelamar = Pelamar::findOrFail($request->pelamar_id);
            $pelamar->status_seleksi = 'Sedang Berjalan';
            $pelamar->save();

            // Update test status
            $tesKemampuan->status_seleksi = 'Magang';
            $tesKemampuan->save();

            // Create weekly evaluations based on the period's duration
            if ($pelamar->periode) {
                $weekCount = $pelamar->periode->durasi_minggu_magang;

                // Get applicable criteria if available
                $jobId = $pelamar->job_id;
                $criteriaList = Criteria::where('job_id', $jobId)->get();

                // Get default rating (middle rating)
                $defaultRating = RatingScale::orderBy('value')->get()->filter(function($item, $key) {
                    return $key == 2; // Get the middle item (typically "Cukup" or "Average")
                })->first();

                if (!$defaultRating) {
                    // Fallback to first rating if no middle rating found
                    $defaultRating = RatingScale::first();
                }

                // If this is a Cook or Pastry Chef position, create default evaluations
                if (in_array($jobId, ['JOB001', 'JOB004'])) {
                    $this->createDefaultEvaluations($magang);
                }
            }

            // Send email notification if requested
            $successMessage = 'Internship scheduled successfully. Weekly evaluations have been created.';

            if ($request->has('send_email') && $request->send_email == '1') {
                $emailSent = true;
                try {
                    Mail::to($pelamar->email)->send(new InternshipScheduled($pelamar, $magang, $tesKemampuan));
                } catch (\Exception $e) {
                    Log::error('Failed to send internship schedule email: ' . $e->getMessage());
                    $emailSent = false;
                }

                if ($emailSent) {
                    $successMessage .= ' Email notification has been sent to ' . $pelamar->email;
                } else {
                    $successMessage .= ' Email notification could not be sent.';
                }
            }

            DB::commit();

            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('success', $successMessage);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error scheduling internship: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new magang record.
     */
    public function create()
    {
        $pelamar = Pelamar::doesntHave('magang')->get();
        $users = User::all();
        return view('magang.create', compact('pelamar', 'users'));
    }

    /**
     * Store a newly created magang record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'total_skor' => 'nullable|numeric|between:0,5',
            'rank' => 'nullable|integer|min:1',
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan',
            'jadwal_tanggal' => 'nullable|date',
            'jadwal_waktu' => 'nullable|required_with:jadwal_tanggal',
        ]);

        // Generate a unique ID with improved logic
        try {
            // Find the highest ID numerically by extracting the number part
            $maxId = Magang::selectRaw('CAST(SUBSTRING(magang_id, 4) AS UNSIGNED) as id_num')
                ->orderBy('id_num', 'desc')
                ->first();

            $nextId = $maxId ? $maxId->id_num + 1 : 1;
            $magangId = 'MAG' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Double-check that this ID doesn't already exist
            while (Magang::where('magang_id', $magangId)->exists()) {
                $nextId++;
                $magangId = 'MAG' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }
        } catch (\Exception $e) {
            // Fallback to UUID if there's any issue with the sequence
            $magangId = 'MAG' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);

            // Ensure uniqueness
            while (Magang::where('magang_id', $magangId)->exists()) {
                $magangId = 'MAG' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);
            }
        }

        // Start a transaction
        DB::beginTransaction();

        try {
            $magang = new Magang();
            $magang->magang_id = $magangId;
            $magang->pelamar_id = $request->pelamar_id;
            $magang->user_id = $request->user_id;
            $magang->total_skor = $request->total_skor ?? 0;
            $magang->rank = $request->rank;
            $magang->status_seleksi = $request->status_seleksi;

            // Process jadwal_mulai if date and time are provided
            if ($request->filled('jadwal_tanggal') && $request->filled('jadwal_waktu')) {
                $jadwalMulai = $request->jadwal_tanggal . ' ' . $request->jadwal_waktu . ':00';
                $magang->jadwal_mulai = $jadwalMulai;
            }

            $magang->save();

            // Update pelamar status if the status is "Sedang Berjalan"
            if ($request->status_seleksi === 'Sedang Berjalan') {
                $pelamar = Pelamar::findOrFail($request->pelamar_id);
                $pelamar->status_seleksi = 'Sedang Berjalan';
                $pelamar->save();
            }

            // Update tes_kemampuan status if exists
            $tesKemampuan = TesKemampuan::where('pelamar_id', $request->pelamar_id)->first();
            if ($tesKemampuan && $request->status_seleksi === 'Sedang Berjalan') {
                $tesKemampuan->status_seleksi = 'Magang';
                $tesKemampuan->save();
            }

            // Check if this is a Cook or Pastry Chef position
            $pelamar = Pelamar::find($request->pelamar_id);
            if ($pelamar && in_array($pelamar->job_id, ['JOB001', 'JOB004'])) {
                // If it's a new intern with Sedang Berjalan status, create default evaluations
                if ($request->status_seleksi === 'Sedang Berjalan') {
                    $this->createDefaultEvaluations($magang);
                }

                // Update SMART scores
                $this->smartService->updateTotalScores($pelamar->job_id, $pelamar->periode_id);
            }

            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Internship record created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error creating magang record: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('magang.create')
                ->with('error', 'Error creating internship record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Helper method to create default evaluations for a new intern
     */
    private function createDefaultEvaluations(Magang $magang)
    {
        if (!$magang->pelamar || !$magang->pelamar->periode) {
            return;
        }

        $weekCount = $magang->pelamar->periode->durasi_minggu_magang ?? 4;
        $jobId = $magang->pelamar->job_id;

        // Only proceed for Cook or Pastry Chef
        if (!in_array($jobId, ['JOB001', 'JOB004'])) {
            return;
        }

        // Get criteria for this job
        $criteriaList = Criteria::where('job_id', $jobId)->get();

        if ($criteriaList->isEmpty()) {
            return;
        }

        // Create evaluations for each week and criterion with NULL rating
        for ($week = 1; $week <= $weekCount; $week++) {
            foreach ($criteriaList as $criteria) {
                $evaluasi = new EvaluasiMingguanMagang();
                $evaluasi->evaluasi_id = Str::uuid()->toString();
                $evaluasi->magang_id = $magang->magang_id;
                $evaluasi->rating_id = null; // Set to null instead of default value
                $evaluasi->criteria_id = $criteria->criteria_id;
                $evaluasi->minggu_ke = $week;
                $evaluasi->skor_minggu = 0; // Set initial score to 0
                $evaluasi->save();
            }
        }
    }

    /**
     * Display the specified magang record with SMART details.
     */
    public function show(Magang $magang)
    {
        // Load relationships
        $magang->load(['pelamar', 'pelamar.job', 'user', 'evaluasiMingguan.criteria', 'evaluasiMingguan.ratingScale']);

        // Get SMART details for visualization
        $smartDetails = null;
        $weeklyScores = null;
        $criteriaContribution = null;
        $weeklyTotalScores = null;

        // Only get SMART details if the intern has a job that is Cook or Pastry Chef
        if ($magang->pelamar &&
            $magang->pelamar->job_id &&
            in_array($magang->pelamar->job_id, ['JOB001', 'JOB004'])) {

            // Get SMART calculation details
            $smartDetails = $this->smartService->getScoreDetails($magang->magang_id);

            // Get weekly scores for chart
            $weeklyScores = $this->smartService->getWeeklyScores($magang->magang_id);

            // Get criteria contribution breakdown
            $criteriaContribution = $this->smartService->getCriteriaContribution($magang->magang_id);

            // Get weekly total scores from the database
            $weeklyTotalScores = $this->smartService->getWeeklyTotalScores($magang->magang_id);
        }

        // Group evaluations by week for easier display
        $evaluationsByWeek = $magang->evaluasiMingguan->groupBy('minggu_ke');

        return view('magang.show', compact(
            'magang',
            'evaluationsByWeek',
            'smartDetails',
            'weeklyScores',
            'criteriaContribution',
            'weeklyTotalScores'
        ));
    }

    /**
     * Display weekly total scores for an intern.
     */
    public function weeklyTotalScores(Magang $magang)
    {
        // Get weekly total scores from the database
        $weeklyTotalScores = $this->smartService->getWeeklyTotalScores($magang->magang_id);

        // Get magang details with relationships
        $magang->load(['pelamar', 'pelamar.job', 'user']);

        return view('magang.weekly-scores', compact('magang', 'weeklyTotalScores'));
    }

    /**
     * Show the form for editing the specified magang record.
     */
    public function edit(Magang $magang)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('magang.edit', compact('magang', 'pelamar', 'users'));
    }

    /**
     * Update the specified magang record in storage.
     */
    public function update(Request $request, Magang $magang)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'total_skor' => 'nullable|numeric|between:0,5',
            'rank' => 'nullable|integer|min:1',
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan',
            'jadwal_tanggal' => 'nullable|date',
            'jadwal_waktu' => 'nullable|required_with:jadwal_tanggal',
        ]);

        // Start a transaction
        DB::beginTransaction();

        try {
            // Store the previous status for comparison
            $previousStatus = $magang->status_seleksi;
            $previousPelamarId = $magang->pelamar_id;

            $magang->pelamar_id = $request->pelamar_id;
            $magang->user_id = $request->user_id;
            $magang->total_skor = $request->total_skor ?? $magang->total_skor;
            $magang->rank = $request->rank;
            $magang->status_seleksi = $request->status_seleksi;

            // Process jadwal_mulai if date and time are provided
            if ($request->filled('jadwal_tanggal') && $request->filled('jadwal_waktu')) {
                $jadwalMulai = $request->jadwal_tanggal . ' ' . $request->jadwal_waktu . ':00';
                $magang->jadwal_mulai = $jadwalMulai;
            } else if ($request->has('jadwal_mulai_clear') && $request->jadwal_mulai_clear) {
                // Allow clearing the date if requested
                $magang->jadwal_mulai = null;
            }

            $magang->save();

            // Handle pelamar status updates
            // If the pelamar has changed, reset the old pelamar's status
            if ($previousPelamarId !== $request->pelamar_id) {
                $oldPelamar = Pelamar::find($previousPelamarId);
                if ($oldPelamar && $oldPelamar->status_seleksi === 'Sedang Berjalan') {
                    $oldPelamar->status_seleksi = 'Pending';
                    $oldPelamar->save();

                    // Also reset the old pelamar's tes_kemampuan status
                    $oldTesKemampuan = TesKemampuan::where('pelamar_id', $previousPelamarId)->first();
                    if ($oldTesKemampuan && $oldTesKemampuan->status_seleksi === 'Magang') {
                        $oldTesKemampuan->status_seleksi = 'Pending';
                        $oldTesKemampuan->save();
                    }
                }
            }

            // Update the current pelamar's status
            $pelamar = Pelamar::findOrFail($request->pelamar_id);
            if ($request->status_seleksi === 'Sedang Berjalan' && $pelamar->status_seleksi !== 'Sedang Berjalan') {
                $pelamar->status_seleksi = 'Sedang Berjalan';
                $pelamar->save();

                // Update tes_kemampuan status if exists
                $tesKemampuan = TesKemampuan::where('pelamar_id', $request->pelamar_id)->first();
                if ($tesKemampuan) {
                    $tesKemampuan->status_seleksi = 'Magang';
                    $tesKemampuan->save();
                }

                // If status changed to Sedang Berjalan and it's a Cook or Pastry Chef, create default evaluations
                if ($previousStatus !== 'Sedang Berjalan' &&
                    in_array($pelamar->job_id, ['JOB001', 'JOB004'])) {
                    $this->createDefaultEvaluations($magang);
                }
            }

            // Update scores using SMART method if applicable
            // Only if the pelamar has changed, score/rank is being directly modified, or status changed
            if ($previousPelamarId !== $request->pelamar_id ||
                $request->filled('total_skor') ||
                $request->filled('rank') ||
                $previousStatus !== $request->status_seleksi) {

                // Check if new pelamar is Cook or Pastry Chef
                if (in_array($pelamar->job_id, ['JOB001', 'JOB004'])) {
                    $this->smartService->updateTotalScores($pelamar->job_id, $pelamar->periode_id);
                    Log::info("Updated SMART scores for job: {$pelamar->job_id}");

                    // Invalidate cache for this magang
                    $this->smartService->invalidateCache($magang->magang_id);
                }

                // If pelamar changed, also update old pelamar's job scores if it was Cook or Pastry Chef
                if ($previousPelamarId !== $request->pelamar_id) {
                    $oldPelamar = Pelamar::find($previousPelamarId);
                    if ($oldPelamar && in_array($oldPelamar->job_id, ['JOB001', 'JOB004'])) {
                        $this->smartService->updateTotalScores($oldPelamar->job_id, $oldPelamar->periode_id);
                        Log::info("Updated SMART scores for previous job: {$oldPelamar->job_id}");
                    }
                }
            }

            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Internship record updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating magang record: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('magang.edit', $magang)
                ->with('error', 'Error updating internship record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified magang record from storage and reset related statuses.
     */
    public function destroy(Magang $magang)
    {
        // Start a transaction to ensure all updates happen together
        DB::beginTransaction();

        try {
            // Store the pelamar_id and job_id before deleting
            $pelamarId = $magang->pelamar_id;
            $jobId = null;
            $periodeId = null;
            $magangId = $magang->magang_id;

            if ($magang->pelamar) {
                $jobId = $magang->pelamar->job_id;
                $periodeId = $magang->pelamar->periode_id;
            }

            // Delete all associated evaluations first
            EvaluasiMingguanMagang::where('magang_id', $magang->magang_id)->delete();

            // Log the deletion of evaluations
            Log::info("Deleted all evaluations for magang_id: {$magang->magang_id}");

            // Delete the magang record
            $magang->delete();
            Log::info("Deleted magang record with ID: {$magang->magang_id}");

            // Reset pelamar status
            $pelamar = Pelamar::find($pelamarId);
            if ($pelamar) {
                if ($pelamar->status_seleksi === 'Sedang Berjalan') {
                    $pelamar->status_seleksi = 'Pending';
                    $pelamar->save();
                    Log::info("Reset pelamar status for ID: {$pelamarId}");
                }
            }

            // Reset the status of the related skill test record
            $tesKemampuan = TesKemampuan::where('pelamar_id', $pelamarId)->first();
            if ($tesKemampuan) {
                // If the status was 'Magang', revert it to 'Pending'
                if ($tesKemampuan->status_seleksi === 'Magang') {
                    $tesKemampuan->status_seleksi = 'Pending';
                    $tesKemampuan->save();
                    Log::info("Reset tesKemampuan status for pelamar ID: {$pelamarId}");
                }
            }

            // Update SMART scores for other interns in the same job if it was Cook or Pastry Chef
            if ($jobId && in_array($jobId, ['JOB001', 'JOB004'])) {
                $this->smartService->updateTotalScores($jobId, $periodeId);
                Log::info("Updated SMART scores after deletion for job: $jobId");

                // Invalidate related caches
                Cache::forget("smart_details_{$magangId}");
            }

            // Commit all the changes
            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Internship deleted successfully. Related statuses have been reset.');
        } catch (\Exception $e) {
            // If anything goes wrong, rollback all changes
            DB::rollBack();
            Log::error("Error deleting magang record: " . $e->getMessage());

            return redirect()->route('magang.index')
                ->with('error', 'An error occurred while deleting: ' . $e->getMessage());
        }
    }

    /**
     * Update the status of a magang record.
     */
    public function updateStatus(Request $request, Magang $magang)
    {
        $request->validate([
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan'
        ]);

        // Start a transaction
        DB::beginTransaction();

        try {
            $previousStatus = $magang->status_seleksi;
            $magang->status_seleksi = $request->status_seleksi;

            // If status is changing to "Sedang Berjalan" and no start date is set, set it to now
            if ($request->status_seleksi === 'Sedang Berjalan' && $previousStatus !== 'Sedang Berjalan' && !$magang->jadwal_mulai) {
                $magang->jadwal_mulai = now();
            }

            $magang->save();

            // Update pelamar status if needed
            if ($request->status_seleksi === 'Sedang Berjalan' && $magang->pelamar->status_seleksi !== 'Sedang Berjalan') {
                $magang->pelamar->status_seleksi = 'Sedang Berjalan';
                $magang->pelamar->save();

                // Update tes_kemampuan status if exists
                $tesKemampuan = TesKemampuan::where('pelamar_id', $magang->pelamar_id)->first();
                if ($tesKemampuan) {
                    $tesKemampuan->status_seleksi = 'Magang';
                    $tesKemampuan->save();
                }

                // If status changing to Sedang Berjalan and it's a Cook or Pastry Chef, create default evaluations
                if ($previousStatus !== 'Sedang Berjalan' &&
                    $magang->pelamar->job_id &&
                    in_array($magang->pelamar->job_id, ['JOB001', 'JOB004'])) {
                    $this->createDefaultEvaluations($magang);
                }
            }

            // If status is changing FROM "Sedang Berjalan" to something else, update related records
            if ($previousStatus === 'Sedang Berjalan' && $request->status_seleksi !== 'Sedang Berjalan') {
                // For example, if internship is completed (Lulus) or failed (Tidak Lulus)
                // You might want to update the pelamar status accordingly
                if ($request->status_seleksi === 'Lulus' || $request->status_seleksi === 'Tidak Lulus') {
                    $magang->pelamar->status_seleksi = $request->status_seleksi;
                    $magang->pelamar->save();
                }
            }

            // If job is Cook or Pastry Chef, update SMART scores
            if ($magang->pelamar &&
                $magang->pelamar->job_id &&
                in_array($magang->pelamar->job_id, ['JOB001', 'JOB004'])) {

                $jobId = $magang->pelamar->job_id;
                $periodeId = $magang->pelamar->periode_id;

                $this->smartService->updateTotalScores($jobId, $periodeId);
                Log::info("Updated SMART scores after status change for job: $jobId");

                // Invalidate cache for this magang
                $this->smartService->invalidateCache($magang->magang_id);
            }

            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating status: " . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('magang.index')
                ->with('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    /**
     * Show SMART ranking dashboard for Cook and Pastry Chef positions
     */
    public function smartDashboard(Request $request)
    {
        // Get selected job or default to Cook (JOB001)
        $jobId = $request->job_id ?? 'JOB001';

        // Validate that job ID is Cook or Pastry Chef
        if (!in_array($jobId, ['JOB001', 'JOB004'])) {
            return redirect()->route('magang.index')
                ->with('error', 'SMART dashboard is only available for Cook and Pastry Chef positions');
        }

        // Get selected period or default to latest
        $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
        $selectedPeriodeId = $request->periode_id ?? ($latestPeriode ? $latestPeriode->periode_id : null);

        // Get jobs (only Cook and Pastry Chef) for dropdown
        $jobs = Job::whereIn('job_id', ['JOB001', 'JOB004'])->orderBy('nama_job')->get();

        // Get the selected job for the title
        $job = Job::find($jobId);
        if (!$job) {
            return redirect()->route('magang.index')
                ->with('error', 'Job not found');
        }

        // Get periods for dropdown
        $periods = Periode::orderBy('tanggal_mulai', 'desc')->get();

        // Get interns for this job and period
        $interns = Magang::whereHas('pelamar', function($query) use ($jobId, $selectedPeriodeId) {
            $query->where('job_id', $jobId);
            if ($selectedPeriodeId) {
                $query->where('periode_id', $selectedPeriodeId);
            }
        })
        ->with(['pelamar'])
        ->orderBy('rank')
        ->orderByDesc('total_skor')
        ->get();

        // Get criteria for this job
        $criteria = Criteria::where('job_id', $jobId)->orderBy('code')->get();

        // Get period info to determine weeks
        $periode = null;
        $weekCount = 1;

        if ($selectedPeriodeId) {
            $periode = Periode::find($selectedPeriodeId);
            if ($periode) {
                $weekCount = $periode->durasi_minggu_magang ?? 1;
            }
        }

        // Get SMART rankings for each week
        $weeklyRankings = [];
        for ($week = 1; $week <= $weekCount; $week++) {
            $weeklyRankings[$week] = $this->smartService->calculateScores($jobId, $week, $selectedPeriodeId);
        }

        // Update all interns' total scores for this job
        $this->smartService->updateTotalScores($jobId, $selectedPeriodeId);

        // Get interns again after updating scores
        $interns = Magang::whereHas('pelamar', function($query) use ($jobId, $selectedPeriodeId) {
            $query->where('job_id', $jobId);
            if ($selectedPeriodeId) {
                $query->where('periode_id', $selectedPeriodeId);
            }
        })
        ->with(['pelamar'])
        ->orderBy('rank')
        ->orderByDesc('total_skor')
        ->get();

        // Get contribution percentages for each criterion
        $criteriaContributions = [];

        foreach ($interns as $intern) {
            $contribution = $this->smartService->getCriteriaContribution($intern->magang_id);
            $criteriaContributions[$intern->magang_id] = $contribution;
        }

        return view('magang.smart-dashboard', compact(
            'job',
            'jobs',
            'periods',
            'jobId',
            'selectedPeriodeId',
            'interns',
            'criteria',
            'weekCount',
            'weeklyRankings',
            'criteriaContributions'
        ));
    }
}
