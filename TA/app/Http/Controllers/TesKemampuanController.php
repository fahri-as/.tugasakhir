<?php

namespace App\Http\Controllers;

use App\Models\TesKemampuan;
use App\Models\Pelamar;
use App\Models\User;
use App\Models\Magang;
use App\Models\Interview;
use App\Models\Periode;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SkillTestScheduled;
use App\Mail\SkillTestPassed;
use App\Mail\SkillTestFailed;

class TesKemampuanController extends Controller
{
    public function index(Request $request)
    {
        // Start with base query
        $query = TesKemampuan::with(['pelamar', 'pelamar.job', 'pelamar.periode', 'user']);

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
        return view('tes-kemampuan.create', compact('pelamar', 'users'));
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
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Lulus,Magang'
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

        $tesKemampuan = new TesKemampuan();
        $tesKemampuan->tes_id = $tesId;
        $tesKemampuan->pelamar_id = $request->pelamar_id;
        $tesKemampuan->user_id = $request->user_id;
        $tesKemampuan->skor = $request->skor;
        $tesKemampuan->catatan = $request->catatan;
        $tesKemampuan->jadwal = $jadwalDateTime;
        $tesKemampuan->status_seleksi = $request->status_seleksi;
        $tesKemampuan->save();

        // If status is Magang, create/update Magang record
        if ($request->status_seleksi == 'Magang') {
            // Check if magang record already exists
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

                Magang::create([
                    'magang_id' => $magangId,
                    'pelamar_id' => $request->pelamar_id,
                    'user_id' => $request->user_id,
                    'status_seleksi' => 'Pending', // Default to Pending in Magang
                    'jadwal_mulai' => null // Include the new column
                ]);
            }
        }

        // If we need to update the interview status
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
        $tesKemampuan->load(['pelamar', 'pelamar.job', 'pelamar.periode', 'user']);
        return view('tes-kemampuan.show', compact('tesKemampuan'));
    }

    public function edit(TesKemampuan $tesKemampuan)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('tes-kemampuan.edit', compact('tesKemampuan', 'pelamar', 'users'));
    }

    public function update(Request $request, TesKemampuan $tesKemampuan)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'skor' => 'required|integer|between:0,100',
            'catatan' => 'nullable',
            'jadwal' => 'required|date',
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Lulus,Magang'
        ]);

        $tesKemampuan->pelamar_id = $request->pelamar_id;
        $tesKemampuan->user_id = $request->user_id;
        $tesKemampuan->skor = $request->skor;
        $tesKemampuan->catatan = $request->catatan;
        $tesKemampuan->jadwal = $request->jadwal;
        $tesKemampuan->status_seleksi = $request->status_seleksi;
        $tesKemampuan->save();

        // If status is changed to Magang, create/update Magang record
        if ($request->status_seleksi == 'Magang') {
            // Check if magang record already exists
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

                Magang::create([
                    'magang_id' => $magangId,
                    'pelamar_id' => $request->pelamar_id,
                    'user_id' => $request->user_id,
                    'status_seleksi' => 'Pending', // Default to Pending in Magang
                    'jadwal_mulai' => null // Include the new column
                ]);
            }
        }

        // Send email notification if requested
        if ($request->has('send_email') && $request->send_email == '1') {
            $pelamar = Pelamar::findOrFail($request->pelamar_id);
            $emailSent = true;
            $emailType = '';

            try {
                if ($request->status_seleksi == 'Lulus') {
                    // Create a datetime object from the contract discussion date and time if provided
                    $kontrakJadwal = null;
                    if ($request->has('kontrak_tanggal') && $request->has('kontrak_waktu')) {
                        $kontrakDateTime = $request->kontrak_tanggal . ' ' . $request->kontrak_waktu . ':00';
                        $kontrakJadwal = \Carbon\Carbon::parse($kontrakDateTime);

                        // Pass the datetime to the template
                        Mail::to($pelamar->email)->send(new SkillTestPassed($pelamar, $tesKemampuan, $kontrakJadwal));
                    } else {
                        Mail::to($pelamar->email)->send(new SkillTestPassed($pelamar, $tesKemampuan));
                    }
                    $emailType = 'lulus';
                } elseif ($request->status_seleksi == 'Tidak Lulus') {
                    Mail::to($pelamar->email)->send(new SkillTestFailed($pelamar, $tesKemampuan));
                    $emailType = 'tidak lulus';
                }
            } catch (\Exception $e) {
                Log::error('Failed to send skill test ' . $emailType . ' email: ' . $e->getMessage());
                $emailSent = false;
            }

            // Check if we were redirected from the show page
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
}