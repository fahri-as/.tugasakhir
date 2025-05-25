<?php

namespace App\Http\Controllers;

use App\Models\TesKemampuan;
use App\Models\Pelamar;
use App\Models\User;
use App\Models\Magang;
use App\Models\Interview;
use App\Models\Periode;
use App\Models\Job;
use App\Models\TesKemampuanCriteria;
use App\Models\TesKemampuanRatingScale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SkillTestScheduled;
use App\Mail\SkillTestPassed;
use App\Mail\SkillTestFailed;
use App\Mail\MagangInvitation;

class TesKemampuanController extends Controller
{
    public function index(Request $request)
    {
        // Start with base query
        $query = TesKemampuan::with(['pelamar', 'pelamar.job', 'pelamar.periode', 'user', 'criteria']);

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

        // Check if we need to filter by job positions
        if ($request->filled('jobs')) {
            $jobIds = (array) $request->jobs;
            if (count($jobIds) > 0) {
                $query->whereHas('pelamar', function($q) use ($jobIds) {
                    $q->whereIn('job_id', $jobIds);
                });
            }
        }

        // Handle sorting
        $sortBy = $request->input('sort_by', 'skor');
        $sortDir = $request->input('sort_dir', 'desc');

        // Allowed sort columns
        $allowedSortColumns = [
            'tes_id', 'jadwal', 'skor', 'status_seleksi'
        ];

        // Sort by direct columns
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDir);
        }
        // Sort by relationships
        else if ($sortBy === 'pelamar_nama') {
            $query->join('pelamar', 'tes_kemampuan.pelamar_id', '=', 'pelamar.pelamar_id')
                  ->orderBy('pelamar.nama', $sortDir)
                  ->select('tes_kemampuan.*');
        }
        else if ($sortBy === 'job_nama') {
            $query->join('pelamar', 'tes_kemampuan.pelamar_id', '=', 'pelamar.pelamar_id')
                  ->join('job', 'pelamar.job_id', '=', 'job.job_id')
                  ->orderBy('job.nama_job', $sortDir)
                  ->select('tes_kemampuan.*');
        }
        else if ($sortBy === 'periode_nama') {
            $query->join('pelamar', 'tes_kemampuan.pelamar_id', '=', 'pelamar.pelamar_id')
                  ->join('periode', 'pelamar.periode_id', '=', 'periode.periode_id')
                  ->orderBy('periode.nama_periode', $sortDir)
                  ->select('tes_kemampuan.*');
        }
        // Default sort by score descending if none specified
        else {
            $query->orderBy('skor', 'desc');
        }

        $tesKemampuan = $query->get();

        // Get rating levels and descriptions for each test
        foreach ($tesKemampuan as $tes) {
            $tes->rating_level = $tes->getRatingLevel();
            $tes->rating_description = $tes->getRatingDescription();
        }

        return view('tes-kemampuan.index', compact('tesKemampuan'));
    }

    public function create()
    {
        $pelamar = Pelamar::whereHas('interview', function($query) {
            $query->where('status_seleksi', 'Tes Kemampuan');
        })->orWhere(function($query) {
            $query->whereDoesntHave('tesKemampuan')
                  ->whereHas('interview');
        })->get();

        $users = User::all();

        // Load all available job criteria
        $jobCriteria = [];
        $jobs = Job::all();

        foreach ($jobs as $job) {
            $criteria = TesKemampuanCriteria::where('job_id', $job->job_id)->get();
            if ($criteria->count() > 0) {
                $jobCriteria[$job->job_id] = $criteria;
            }
        }

        return view('tes-kemampuan.create', compact('pelamar', 'users', 'jobCriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'skor' => 'required|integer|between:0,100',
            'catatan' => 'nullable',
            'jadwal_tanggal' => 'required|date',
            'jadwal_waktu' => 'required',
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Lulus,Magang',
            'criteria_id' => 'nullable|exists:tes_kemampuan_criteria,criteria_id'
        ]);

        // Combine date and time into a single datetime field
        $jadwalDateTime = $request->jadwal_tanggal . ' ' . $request->jadwal_waktu . ':00';

        // Generate a unique ID using a more robust approach
        try {
            // Find the highest ID numerically by extracting the number part
            $maxId = TesKemampuan::selectRaw('CAST(SUBSTRING(tes_id, 4) AS UNSIGNED) as id_num')
                ->orderBy('id_num', 'desc')
                ->first();

            $nextId = $maxId ? $maxId->id_num + 1 : 1;
            $tesId = 'TES' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Double-check that this ID doesn't already exist
            while (TesKemampuan::where('tes_id', $tesId)->exists()) {
                $nextId++;
                $tesId = 'TES' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }
        } catch (\Exception $e) {
            // Fallback to a UUID-based approach if there's an issue
            $tesId = 'TES' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);

            // Ensure this UUID-based ID is unique
            while (TesKemampuan::where('tes_id', $tesId)->exists()) {
                $tesId = 'TES' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);
            }
        }

        // Get the pelamar's job and find appropriate criteria if not provided
        $pelamar = Pelamar::with('job')->findOrFail($request->pelamar_id);

        // If no criteria ID is provided, try to find the default one for this job
        $criteriaId = $request->criteria_id;

        if (!$criteriaId && $pelamar->job_id) {
            $defaultCriteria = TesKemampuanCriteria::where('job_id', $pelamar->job_id)
                ->where('name', 'Kemampuan Teknis')
                ->first();

            if ($defaultCriteria) {
                $criteriaId = $defaultCriteria->criteria_id;
            }
        }

        $tesKemampuan = new TesKemampuan();
        $tesKemampuan->tes_id = $tesId;
        $tesKemampuan->pelamar_id = $request->pelamar_id;
        $tesKemampuan->user_id = $request->user_id;
        $tesKemampuan->skor = $request->skor;
        $tesKemampuan->catatan = $request->catatan;
        $tesKemampuan->jadwal = $jadwalDateTime;
        $tesKemampuan->status_seleksi = $request->status_seleksi;
        $tesKemampuan->criteria_id = $criteriaId;
        $tesKemampuan->save();

        // Update the pelamar status to "Tes Kemampuan"
        $pelamar->status_seleksi = 'Tes Kemampuan';
        $pelamar->save();

        if ($request->has('update_interview_status') && $request->update_interview_status === 'yes') {
            // Find and update the interview for this applicant
            $interview = Interview::where('pelamar_id', $request->pelamar_id)->first();
            if ($interview) {
                $interview->status_seleksi = 'Tes Kemampuan';
                $interview->save();
            }
        }

        // Send email notification if requested
        $successMessage = 'Skill test scheduled successfully';

        if ($request->has('send_email') && $request->send_email == '1') {
            $pelamar = Pelamar::findOrFail($request->pelamar_id);

            $emailSent = true;
            try {
                Mail::to($pelamar->email)->send(new SkillTestScheduled($pelamar, $tesKemampuan));
            } catch (\Exception $e) {
                Log::error('Failed to send skill test email: ' . $e->getMessage());
                $emailSent = false;
            }

            if ($emailSent) {
                $successMessage .= '. Email notification has been sent to ' . $pelamar->email;
            } else {
                $successMessage .= '. Email notification could not be sent.';
            }
        }

        return redirect()->route('tes-kemampuan.index')
            ->with('success', $successMessage);
    }

    public function show(TesKemampuan $tesKemampuan)
    {
        $tesKemampuan->load(['pelamar', 'pelamar.job', 'pelamar.periode', 'user', 'criteria']);

        // Get rating information
        $ratingScale = $tesKemampuan->getRatingScale();
        $ratingLevel = $tesKemampuan->getRatingLevel();
        $ratingDescription = $tesKemampuan->getRatingDescription();

        return view('tes-kemampuan.show', compact('tesKemampuan', 'ratingScale', 'ratingLevel', 'ratingDescription'));
    }

    public function edit(TesKemampuan $tesKemampuan)
    {
        $pelamar = Pelamar::all();
        $users = User::all();

        // Load the test with related data
        $tesKemampuan->load(['pelamar', 'pelamar.job', 'criteria']);

        // Get all criteria for the pelamar's job
        $jobId = $tesKemampuan->pelamar->job_id;
        $allCriteria = TesKemampuanCriteria::where('job_id', $jobId)->get();

        // Log untuk debugging
        Log::info('Edit TesKemampuan: ', [
            'tes_id' => $tesKemampuan->tes_id,
            'criteria_id' => $tesKemampuan->criteria_id,
            'job_id' => $jobId,
            'criteria_count' => count($allCriteria)
        ]);

        // If no criteria is set, try to set a default one
        if (!$tesKemampuan->criteria_id && count($allCriteria) > 0) {
            // Find a criteria with rating scales
            foreach ($allCriteria as $criteria) {
                $hasRatingScales = TesKemampuanRatingScale::where('criteria_id', $criteria->criteria_id)->exists();
                if ($hasRatingScales) {
                    $tesKemampuan->criteria_id = $criteria->criteria_id;
                    Log::info('Found criteria with rating scales', ['criteria_id' => $criteria->criteria_id]);
                    break;
                }
            }

            // If no criteria with rating scales found, just use the first one
            if (!$tesKemampuan->criteria_id && count($allCriteria) > 0) {
                $tesKemampuan->criteria_id = $allCriteria->first()->criteria_id;
                Log::info('Using first criteria', ['criteria_id' => $tesKemampuan->criteria_id]);
            }
        }

        // Get all rating scales for the current criteria
        $ratingScales = [];
        if ($tesKemampuan->criteria_id) {
            $ratingScales = TesKemampuanRatingScale::where('criteria_id', $tesKemampuan->criteria_id)
                ->orderBy('rating_level')
                ->get();
            Log::info('Found rating scales', ['count' => count($ratingScales)]);
        } else {
            // Jika tidak ada criteria_id, ambil rating scales dari criteria pertama
            if (count($allCriteria) > 0) {
                $firstCriteria = $allCriteria->first();
                $tesKemampuan->criteria_id = $firstCriteria->criteria_id;
                $ratingScales = TesKemampuanRatingScale::where('criteria_id', $firstCriteria->criteria_id)
                    ->orderBy('rating_level')
                    ->get();
                Log::info('Using first criteria for rating scales', ['criteria_id' => $firstCriteria->criteria_id, 'count' => count($ratingScales)]);
            } else {
                Log::warning('No criteria available for job_id: ' . $jobId);
            }
        }

        // Get current rating information
        $currentRatingScale = $tesKemampuan->getRatingScale();

        return view('tes-kemampuan.edit', compact(
            'tesKemampuan',
            'pelamar',
            'users',
            'allCriteria',
            'ratingScales',
            'currentRatingScale'
        ));
    }

    public function update(Request $request, TesKemampuan $tesKemampuan)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'skor' => 'required|integer|between:0,100',
            'specific_score' => 'required|integer|between:0,100',
            'catatan' => 'nullable',
            'jadwal' => 'required|date',
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Lulus,Magang',
            'criteria_id' => 'nullable|exists:tes_kemampuan_criteria,criteria_id',
            'rating_scale' => 'nullable|exists:tes_kemampuan_rating_scales,id'
        ]);

        $tesKemampuan->pelamar_id = $request->pelamar_id;
        $tesKemampuan->user_id = $request->user_id;
        $tesKemampuan->catatan = $request->catatan;
        $tesKemampuan->jadwal = $request->jadwal;
        $tesKemampuan->status_seleksi = $request->status_seleksi;

        // Update criteria ID if provided
        if ($request->filled('criteria_id')) {
            $tesKemampuan->criteria_id = $request->criteria_id;
        }

        // If a rating scale is selected, validate the specific score is within the range
        if ($request->filled('rating_scale')) {
            $ratingScale = TesKemampuanRatingScale::findOrFail($request->rating_scale);

            // Validate specific score is within the rating scale range
            if ($request->specific_score < $ratingScale->min_score || $request->specific_score > $ratingScale->max_score) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['specific_score' => "Score must be between {$ratingScale->min_score} and {$ratingScale->max_score} for the selected rating scale"]);
            }

            // Use the specific score provided by the user
            $tesKemampuan->skor = $request->specific_score;
        } else {
            // If no rating scale is selected, just use the provided score
            $tesKemampuan->skor = $request->skor;
        }

        $tesKemampuan->save();

        // If status is changed to Magang, create/update Magang record
        if ($request->status_seleksi === 'Magang') {
            $pelamar = Pelamar::findOrFail($request->pelamar_id);

            // Create or update the Magang record
            $magang = Magang::firstOrNew(['pelamar_id' => $pelamar->pelamar_id]);

            // Only set these values if it's a new record
            if (!$magang->exists) {
                // Generate a unique ID for new magang records
                $lastMagang = Magang::orderBy('magang_id', 'desc')->first();

                if ($lastMagang) {
                    // Extract the numeric part and increment
                    $lastId = intval(substr($lastMagang->magang_id, 3));
                    $newId = 'MAG' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
                } else {
                    // If no existing magang, start with MAG001
                    $newId = 'MAG001';
                }

                $magang->magang_id = $newId;
                $magang->user_id = $request->user_id;
                $magang->status_seleksi = 'Sedang Berjalan';

                // Set default start date to today if not provided
                if (!$magang->jadwal_mulai) {
                    $magang->jadwal_mulai = now();
                }
            }

            $magang->save();

            // Update pelamar status
            $pelamar->status_seleksi = 'Sedang Berjalan';
            $pelamar->save();

            // Determine which email to send based on test status
            $emailType = null;
            $emailSent = false;

            if ($tesKemampuan->status_seleksi === 'Lulus' || $tesKemampuan->status_seleksi === 'Magang') {
                $emailType = 'passed';
                try {
                    Mail::to($pelamar->email)->send(new SkillTestPassed($pelamar, $tesKemampuan, $magang));
                    $emailSent = true;
                } catch (\Exception $e) {
                    Log::error('Failed to send test passed email: ' . $e->getMessage());
                }
            } elseif ($tesKemampuan->status_seleksi === 'Tidak Lulus') {
                $emailType = 'failed';
                try {
                    Mail::to($pelamar->email)->send(new SkillTestFailed($pelamar, $tesKemampuan));
                    $emailSent = true;
                } catch (\Exception $e) {
                    Log::error('Failed to send test failed email: ' . $e->getMessage());
                }
            }

            if ($request->has('redirect') && $request->redirect === 'show') {
                $successMessage = 'Test status updated successfully';

                if ($emailType) {
                    if ($emailSent) {
                        $successMessage .= '. Email notification has been sent to ' . $pelamar->email;
                    } else {
                        $successMessage .= '. Email notification could not be sent.';
                    }
                }

                return redirect()->route('tes-kemampuan.show', $tesKemampuan)->with('success', $successMessage);
            }
        }

        // Check if we were redirected from the show page
        if ($request->has('redirect') && $request->redirect === 'show') {
            return redirect()->route('tes-kemampuan.show', $tesKemampuan)->with('success', 'Test status updated successfully');
        }

        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan updated successfully');
    }

    public function destroy(TesKemampuan $tesKemampuan)
    {
        // Get the pelamar ID before deletion
        $pelamarId = $tesKemampuan->pelamar_id;

        $tesKemampuan->delete();

        // Update interview status back to Pending if it was in Tes Kemampuan status
        $interview = Interview::where('pelamar_id', $pelamarId)->first();
        if ($interview && $interview->status_seleksi === 'Tes Kemampuan') {
            $interview->status_seleksi = 'Pending';
            $interview->save();
        }

        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan deleted successfully');
    }

    /**
     * Get rating scales for a pelamar's job.
     * This is an API endpoint for AJAX requests.
     */
    public function getRatingScalesForPelamar($pelamarId)
    {
        $pelamar = Pelamar::with('job')->findOrFail($pelamarId);
        $jobId = $pelamar->job_id;

        Log::info('Getting rating scales for pelamar', [
            'pelamar_id' => $pelamarId,
            'job_id' => $jobId
        ]);

        // Get all criteria for this job
        $allCriteria = TesKemampuanCriteria::where('job_id', $jobId)->get();

        // First try to find a criteria with rating scales
        $criteria = null;
        $ratingScales = [];

        foreach ($allCriteria as $c) {
            $hasScales = TesKemampuanRatingScale::where('criteria_id', $c->criteria_id)->exists();
            if ($hasScales) {
                $criteria = $c;
                $ratingScales = TesKemampuanRatingScale::where('criteria_id', $c->criteria_id)
                    ->orderBy('rating_level')
                    ->get();
                Log::info('Found criteria with rating scales', [
                    'criteria_id' => $c->criteria_id,
                    'scales_count' => count($ratingScales)
                ]);
                break;
            }
        }

        // If no criteria with scales found, use the first one
        if (!$criteria && $allCriteria->count() > 0) {
            $criteria = $allCriteria->first();
            $ratingScales = TesKemampuanRatingScale::where('criteria_id', $criteria->criteria_id)
                ->orderBy('rating_level')
                ->get();
            Log::info('Using first criteria', [
                'criteria_id' => $criteria->criteria_id,
                'scales_count' => count($ratingScales)
            ]);
        }

        // If still no criteria, log warning
        if (!$criteria) {
            Log::warning('No criteria found for job', ['job_id' => $jobId]);
        }

        return response()->json([
            'criteria' => $criteria,
            'ratingScales' => $ratingScales,
            'job_id' => $jobId,
            'criteria_count' => $allCriteria->count()
        ]);
    }

    /**
     * Mark a test as failed and send email notification
     *
     * @param TesKemampuan $tesKemampuan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsFailed(TesKemampuan $tesKemampuan)
    {
        try {
            // Update the test status
            $tesKemampuan->status_seleksi = 'Tidak Lulus';
            $tesKemampuan->save();

            // Send email notification
            $pelamar = $tesKemampuan->pelamar;
            $emailSent = true;

            try {
                Mail::to($pelamar->email)->send(new SkillTestFailed($pelamar, $tesKemampuan));
            } catch (\Exception $e) {
                Log::error('Failed to send skill test result email: ' . $e->getMessage());
                $emailSent = false;
            }

            $successMessage = 'Test status has been updated to Failed';

            if ($emailSent) {
                $successMessage .= '. Email notification has been sent to ' . $pelamar->email;
            } else {
                $successMessage .= '. Email notification could not be sent.';
            }

            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('success', $successMessage);

        } catch (\Exception $e) {
            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('error', 'Failed to update test status: ' . $e->getMessage());
        }
    }

    /**
     * Reset a test status to pending
     *
     * @param TesKemampuan $tesKemampuan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetToPending(TesKemampuan $tesKemampuan)
    {
        try {
            // Update the test status
            $tesKemampuan->status_seleksi = 'Pending';
            $tesKemampuan->save();

            // Send email notification
            $pelamar = $tesKemampuan->pelamar;
            $emailSent = true;

            try {
                Mail::to($pelamar->email)->send(new SkillTestScheduled($pelamar, $tesKemampuan));
            } catch (\Exception $e) {
                Log::error('Failed to send skill test reset email: ' . $e->getMessage());
                $emailSent = false;
            }

            $successMessage = 'Test status has been reset to Pending';

            if ($emailSent) {
                $successMessage .= '. Email notification has been sent to ' . $pelamar->email;
            } else {
                $successMessage .= '. Email notification could not be sent.';
            }

            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('success', $successMessage);

        } catch (\Exception $e) {
            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('error', 'Failed to reset test status: ' . $e->getMessage());
        }
    }

    /**
     * Mark a test as passed and open contract discussion modal
     *
     * @param TesKemampuan $tesKemampuan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsPassed(TesKemampuan $tesKemampuan)
    {
        try {
            // Update the test status
            $tesKemampuan->status_seleksi = 'Lulus';
            $tesKemampuan->save();

            // Send email notification
            $pelamar = $tesKemampuan->pelamar;
            $emailSent = true;

            try {
                Mail::to($pelamar->email)->send(new SkillTestPassed($pelamar, $tesKemampuan, null));
            } catch (\Exception $e) {
                Log::error('Failed to send skill test passed email: ' . $e->getMessage());
                $emailSent = false;
            }

            $successMessage = 'Test status has been updated to Passed';

            if ($emailSent) {
                $successMessage .= '. Email notification has been sent to ' . $pelamar->email;
            } else {
                $successMessage .= '. Email notification could not be sent.';
            }

            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('success', $successMessage);

        } catch (\Exception $e) {
            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('error', 'Failed to update test status: ' . $e->getMessage());
        }
    }
}
