<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Pelamar;
use App\Models\User;
use App\Models\InterviewCriteria;
use App\Models\InterviewRatingScale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\InterviewScheduled;
use App\Mail\InterviewFailed;

class InterviewController extends Controller
{
// Update the index method in InterviewController.php
public function index(Request $request)
{
    // Start with base query
    $query = Interview::with(['pelamar', 'pelamar.job', 'pelamar.periode', 'user']);

    // Check if we need to filter by period
    if ($request->filled('periode_id')) {
        // If a specific period is selected, filter by it
        $query->whereHas('pelamar', function($q) use ($request) {
            $q->where('periode_id', $request->periode_id);
        });
    } else if (!$request->has('periode_id')) {
        // First page load - default to most recent period
        $latestPeriode = \App\Models\Periode::orderBy('tanggal_mulai', 'desc')->first();
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
        'interview_id', 'jadwal', 'total_skor', 'status_seleksi'
    ];

    // Sort by direct columns
    if (in_array($sortBy, $allowedSortColumns)) {
        $query->orderBy($sortBy, $sortDir);
    }
    // Sort by relationships
    else if ($sortBy === 'pelamar_nama') {
        $query->join('pelamar', 'interview.pelamar_id', '=', 'pelamar.pelamar_id')
              ->orderBy('pelamar.nama', $sortDir)
              ->select('interview.*');
    }
    else if ($sortBy === 'job_nama') {
        $query->join('pelamar', 'interview.pelamar_id', '=', 'pelamar.pelamar_id')
              ->join('job', 'pelamar.job_id', '=', 'job.job_id')
              ->orderBy('job.nama_job', $sortDir)
              ->select('interview.*');
    }
    else if ($sortBy === 'periode_nama') {
        $query->join('pelamar', 'interview.pelamar_id', '=', 'pelamar.pelamar_id')
              ->join('periode', 'pelamar.periode_id', '=', 'periode.periode_id')
              ->orderBy('periode.nama_periode', $sortDir)
              ->select('interview.*');
    }
    // Default sort by total_skor descending if none specified
    else {
        $query->orderBy('total_skor', 'desc');
    }

    $interviews = $query->get();
    return view('interview.index', compact('interviews'));
}

    public function create()
    {
        $pelamar = Pelamar::doesntHave('interview')->get();
        $users = User::all();
        return view('interview.create', compact('pelamar', 'users'));
    }

    /**
     * Schedule an interview for an applicant with date and time.
     * This method combines date and time inputs into a single datetime value.
     * Includes validation that the datetime is in the future.
     */
    public function schedule(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'jadwal_tanggal' => 'required|date',
            'jadwal_waktu' => 'required',
        ]);

        // Combine date and time
        $jadwalDateTime = $request->jadwal_tanggal . ' ' . $request->jadwal_waktu . ':00';

        // Check if the datetime is in the future
        $scheduledTime = \Carbon\Carbon::parse($jadwalDateTime);
        $now = \Carbon\Carbon::now();

        if ($scheduledTime <= $now) {
            return redirect()->back()->with('error', 'Interview time must be in the future.');
        }

        // Get the max interview ID number with more robust error handling
        $interviewId = '';
        try {
            // Find the highest ID numerically by extracting the number part
            $maxId = Interview::selectRaw('CAST(SUBSTRING(interview_id, 4) AS UNSIGNED) as id_num')
                ->orderBy('id_num', 'desc')
                ->first();

            $nextId = $maxId ? $maxId->id_num + 1 : 1;
            $interviewId = 'INT' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Double-check that this ID doesn't already exist
            while (Interview::where('interview_id', $interviewId)->exists()) {
                $nextId++;
                $interviewId = 'INT' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }
        } catch (\Exception $e) {
            // Fallback to UUID if there's any issue with the sequence
            $interviewId = 'INT' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);
        }

        // Get the pelamar and their job
        $pelamar = Pelamar::with('job')->findOrFail($request->pelamar_id);

        // Find default criteria for this job
        $qualifikasi = InterviewCriteria::where('job_id', $pelamar->job_id)
            ->where('name', 'Kualifikasi')
            ->first();

        $komunikasi = InterviewCriteria::where('job_id', $pelamar->job_id)
            ->where('name', 'Komunikasi')
            ->first();

        $sikap = InterviewCriteria::where('job_id', $pelamar->job_id)
            ->where('name', 'Sikap')
            ->first();

        $interview = new Interview();
        $interview->interview_id = $interviewId;
        $interview->pelamar_id = $request->pelamar_id;
        $interview->user_id = $request->user_id;
        $interview->jadwal = $jadwalDateTime; // Store as datetime

        // Set default values for scores (to be updated later)
        $interview->kualifikasi_skor = 0;
        $interview->komunikasi_skor = 0;
        $interview->sikap_skor = 0;
        $interview->total_skor = 0;

        // Set criteria IDs if they exist
        if ($qualifikasi) {
            $interview->qualifikasi_criteria_id = $qualifikasi->criteria_id;
        }

        if ($komunikasi) {
            $interview->komunikasi_criteria_id = $komunikasi->criteria_id;
        }

        if ($sikap) {
            $interview->sikap_criteria_id = $sikap->criteria_id;
        }

        $interview->status_seleksi = 'Pending'; // Default status

        $interview->save();

        // Update the pelamar status to Interview
        // Use findOrFail to get a single model, not a collection
        $pelamar = Pelamar::findOrFail($request->pelamar_id);
        $pelamar->status_seleksi = 'Interview';
        $pelamar->save();

        // Send email notification to the applicant
        $emailSent = true;
        try {
            Mail::to($pelamar->email)->send(new InterviewScheduled($pelamar, $interview));
        } catch (\Exception $e) {
            Log::error('Failed to send interview email: ' . $e->getMessage());
            $emailSent = false;
        }

        $successMessage = 'Interview scheduled successfully for ' . $pelamar->nama . ' on ' .
               date('d F Y', strtotime($request->jadwal_tanggal)) . ' at ' .
               date('H:i', strtotime($request->jadwal_waktu));

        if ($emailSent) {
            $successMessage .= '. Email notification has been sent to ' . $pelamar->email;
        } else {
            $successMessage .= '. Email notification could not be sent.';
        }

        return redirect()->route('pelamar.show', $request->pelamar_id)
            ->with('success', $successMessage);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'kualifikasi_skor' => 'required|integer|between:1,5',
            'komunikasi_skor' => 'required|integer|between:1,5',
            'sikap_skor' => 'required|integer|between:1,5',
            'jadwal_tanggal' => 'required|date',
            'jadwal_waktu' => 'required',
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Tes Kemampuan'
        ]);

        // Combine date and time
        $jadwalDateTime = $request->jadwal_tanggal . ' ' . $request->jadwal_waktu . ':00';

        // Get the max interview ID number with more robust error handling
        $interviewId = '';
        try {
            // Find the highest ID numerically by extracting the number part
            $maxId = Interview::selectRaw('CAST(SUBSTRING(interview_id, 4) AS UNSIGNED) as id_num')
                ->orderBy('id_num', 'desc')
                ->first();

            $nextId = $maxId ? $maxId->id_num + 1 : 1;
            $interviewId = 'INT' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Double-check that this ID doesn't already exist
            while (Interview::where('interview_id', $interviewId)->exists()) {
                $nextId++;
                $interviewId = 'INT' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
            }
        } catch (\Exception $e) {
            // Fallback to UUID if there's any issue with the sequence
            $interviewId = 'INT' . substr(str_replace('-', '', Str::uuid()->toString()), 0, 7);
        }

        // Get the pelamar and their job
        $pelamar = Pelamar::with('job')->findOrFail($request->pelamar_id);

        // Find default criteria for this job
        $qualifikasi = InterviewCriteria::where('job_id', $pelamar->job_id)
            ->where('name', 'Kualifikasi')
            ->first();

        $komunikasi = InterviewCriteria::where('job_id', $pelamar->job_id)
            ->where('name', 'Komunikasi')
            ->first();

        $sikap = InterviewCriteria::where('job_id', $pelamar->job_id)
            ->where('name', 'Sikap')
            ->first();

        $interview = new Interview();
        $interview->interview_id = $interviewId;
        $interview->pelamar_id = $request->pelamar_id;
        $interview->user_id = $request->user_id;
        $interview->kualifikasi_skor = $request->kualifikasi_skor;
        $interview->komunikasi_skor = $request->komunikasi_skor;
        $interview->sikap_skor = $request->sikap_skor;
        $interview->jadwal = $jadwalDateTime;
        $interview->status_seleksi = $request->status_seleksi;

        // Set criteria IDs if they exist
        if ($qualifikasi) {
            $interview->qualifikasi_criteria_id = $qualifikasi->criteria_id;
        }

        if ($komunikasi) {
            $interview->komunikasi_criteria_id = $komunikasi->criteria_id;
        }

        if ($sikap) {
            $interview->sikap_criteria_id = $sikap->criteria_id;
        }

        // Calculate total score as average of the three scores
        $interview->total_skor = ($request->kualifikasi_skor + $request->komunikasi_skor + $request->sikap_skor) / 3;

        $interview->save();

        // Update the pelamar status
        $pelamar = Pelamar::findOrFail($request->pelamar_id);
        $pelamar->status_seleksi = 'Interview';
        $pelamar->save();

        return redirect()->route('interview.index')->with('success', 'Interview created successfully');
    }

    public function show(Interview $interview)
    {
        $interview->load(['pelamar', 'pelamar.job', 'pelamar.periode', 'user', 'qualifikasiCriteria', 'komunikasiCriteria', 'sikapCriteria']);

        // Get rating scale descriptions
        $kualifikasiDescription = $interview->getRatingDescription('kualifikasi');
        $komunikasiDescription = $interview->getRatingDescription('komunikasi');
        $sikapDescription = $interview->getRatingDescription('sikap');

        return view('interview.show', compact('interview', 'kualifikasiDescription', 'komunikasiDescription', 'sikapDescription'));
    }

    public function edit(Interview $interview)
    {
        $pelamar = Pelamar::all();
        $users = User::all();

        // Load job-specific criteria and rating scales
        $interview->load(['pelamar', 'pelamar.job']);

        // Get all criteria for this job
        $jobId = $interview->pelamar->job_id;

        $qualifikasiCriteria = InterviewCriteria::where('job_id', $jobId)
            ->where('name', 'Kualifikasi')
            ->first();

        $komunikasiCriteria = InterviewCriteria::where('job_id', $jobId)
            ->where('name', 'Komunikasi')
            ->first();

        $sikapCriteria = InterviewCriteria::where('job_id', $jobId)
            ->where('name', 'Sikap')
            ->first();

        // Get all rating scales for each criteria
        $qualifikasiRatings = [];
        $komunikasiRatings = [];
        $sikapRatings = [];

        if ($qualifikasiCriteria) {
            $qualifikasiRatings = InterviewRatingScale::where('criteria_id', $qualifikasiCriteria->criteria_id)
                ->orderBy('rating_level')
                ->get();
        }

        if ($komunikasiCriteria) {
            $komunikasiRatings = InterviewRatingScale::where('criteria_id', $komunikasiCriteria->criteria_id)
                ->orderBy('rating_level')
                ->get();
        }

        if ($sikapCriteria) {
            $sikapRatings = InterviewRatingScale::where('criteria_id', $sikapCriteria->criteria_id)
                ->orderBy('rating_level')
                ->get();
        }

        return view('interview.edit', compact(
            'interview',
            'pelamar',
            'users',
            'qualifikasiCriteria',
            'komunikasiCriteria',
            'sikapCriteria',
            'qualifikasiRatings',
            'komunikasiRatings',
            'sikapRatings'
        ));
    }

    public function update(Request $request, Interview $interview)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'kualifikasi_skor' => 'required|integer|between:0,5', // Changed to allow 0
            'komunikasi_skor' => 'required|integer|between:0,5', // Changed to allow 0
            'sikap_skor' => 'required|integer|between:0,5',     // Changed to allow 0
            'jadwal' => 'required|date',
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Tes Kemampuan'
        ]);

        $interview->pelamar_id = $request->pelamar_id;
        $interview->user_id = $request->user_id;
        $interview->kualifikasi_skor = $request->kualifikasi_skor;
        $interview->komunikasi_skor = $request->komunikasi_skor;
        $interview->sikap_skor = $request->sikap_skor;
        $interview->jadwal = $request->jadwal;
        $interview->status_seleksi = $request->status_seleksi;

        // Update criteria IDs if they're provided
        if ($request->filled('qualifikasi_criteria_id')) {
            $interview->qualifikasi_criteria_id = $request->qualifikasi_criteria_id;
        }

        if ($request->filled('komunikasi_criteria_id')) {
            $interview->komunikasi_criteria_id = $request->komunikasi_criteria_id;
        }

        if ($request->filled('sikap_criteria_id')) {
            $interview->sikap_criteria_id = $request->sikap_criteria_id;
        }

        // Calculate total score as average of the three scores
        $interview->total_skor = ($request->kualifikasi_skor + $request->komunikasi_skor + $request->sikap_skor) / 3;

        $interview->save();

        // Check if email notification should be sent for failed interviews
        if ($request->has('send_email') && $request->send_email == '1' && $request->status_seleksi == 'Tidak Lulus') {
            $pelamar = Pelamar::findOrFail($request->pelamar_id);

            $emailSent = true;
            try {
                Mail::to($pelamar->email)->send(new InterviewFailed($pelamar, $interview));
            } catch (\Exception $e) {
                Log::error('Failed to send interview failed email: ' . $e->getMessage());
                $emailSent = false;
            }

            // Customize the success message
            $redirectPath = $request->has('redirect') && $request->redirect === 'show'
                          ? route('interview.show', $interview)
                          : route('interview.index');

            if ($emailSent) {
                return redirect($redirectPath)
                    ->with('success', 'Interview updated successfully. Email notification has been sent to ' . $pelamar->email);
            } else {
                return redirect($redirectPath)
                    ->with('success', 'Interview updated successfully. Email notification could not be sent.');
            }
        }

        return redirect()->route('interview.index')->with('success', 'Interview updated successfully');
    }

    public function destroy(Interview $interview)
    {
        // Get the pelamar before deleting the interview
        $pelamar = $interview->pelamar;

        $interview->delete();

        // Reset pelamar status to Pending if it was in Interview status
        if ($pelamar && $pelamar->status_seleksi === 'Interview') {
            $pelamar->status_seleksi = 'Pending';
            $pelamar->save();
        }

        return redirect()->route('interview.index')->with('success', 'Interview deleted successfully');
    }
}