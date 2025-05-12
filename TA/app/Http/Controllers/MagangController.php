<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Pelamar;
use App\Models\User;
use App\Models\TesKemampuan;
use App\Models\EvaluasiMingguanMagang;
use App\Models\RatingScale;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MagangController extends Controller
{
    /**
     * Display a listing of magang records with filtering and sorting options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        return view('magang.index', compact('magang'));
    }

    /**
     * Show the form for creating a new magang record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelamar = Pelamar::doesntHave('magang')->get();
        $users = User::all();
        return view('magang.create', compact('pelamar', 'users'));
    }



    /**
     * Store a newly created magang record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Magang created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('magang.create')
                ->with('error', 'Error creating magang record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified magang record.
     *
     * @param  \App\Models\Magang  $magang
     * @return \Illuminate\Http\Response
     */
    public function show(Magang $magang)
    {
        $magang->load(['pelamar', 'user', 'evaluasiMingguan']);
        return view('magang.show', compact('magang'));
    }

    /**
     * Show the form for editing the specified magang record.
     *
     * @param  \App\Models\Magang  $magang
     * @return \Illuminate\Http\Response
     */
    public function edit(Magang $magang)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('magang.edit', compact('magang', 'pelamar', 'users'));
    }

    /**
     * Update the specified magang record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magang  $magang
     * @return \Illuminate\Http\Response
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
            }

            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Magang updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('magang.edit', $magang)
                ->with('error', 'Error updating magang record: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified magang record from storage and reset related statuses.
     *
     * @param  \App\Models\Magang  $magang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magang $magang)
{
    // Start a transaction to ensure all updates happen together
    DB::beginTransaction();

    try {
        // Store the pelamar_id before deleting
        $pelamarId = $magang->pelamar_id;

        // Delete all associated evaluations first
        EvaluasiMingguanMagang::where('magang_id', $magang->magang_id)->delete();

        // Log the deletion of evaluations
        Log::info("Deleted all evaluations for magang_id: {$magang->magang_id}");

        // Check if there are any evaluations
        if ($magang->evaluasiMingguan()->count() > 0) {
            return redirect()->route('magang.index')
                ->with('error', 'Cannot delete internship record. It has associated weekly evaluations that must be deleted first.');
        }

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magang  $magang
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Magang $magang)
    {
        $request->validate([
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan,Selesai'
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
            }

            // If status is changing FROM "Sedang Berjalan" to something else, update related records
            if ($previousStatus === 'Sedang Berjalan' && $request->status_seleksi !== 'Sedang Berjalan') {
                // For example, if internship is completed (Lulus) or failed (Tidak Lulus)
                // You might want to update the pelamar status accordingly
                if ($request->status_seleksi === 'Lulus' || $request->status_seleksi === 'Tidak Lulus') {
                    $magang->pelamar->status_seleksi = ($request->status_seleksi === 'Lulus') ? 'Lulus' : 'Tidak Lulus';
                    $magang->pelamar->save();
                }
            }

            DB::commit();

            return redirect()->route('magang.index')->with('success', 'Status updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('magang.index')
                ->with('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    /**
     * Schedule the start date for an internship.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Magang  $magang
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

                // Create an entry for each week and criteria
                for ($week = 1; $week <= $weekCount; $week++) {
                    if ($criteriaList->isEmpty()) {
                        // If no criteria, create a single evaluation per week
                        $this->createEvaluation($magang, $defaultRating, null, $week);
                    } else {
                        // Create one evaluation per criteria for each week
                        foreach ($criteriaList as $criteria) {
                            $this->createEvaluation($magang, $defaultRating, $criteria->criteria_id, $week);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('tes-kemampuan.show', $tesKemampuan)
                ->with('success', 'Internship scheduled successfully. Weekly evaluations have been created.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error scheduling internship: ' . $e->getMessage());
        }
    }

    /**
     * Helper method to create an evaluation record
     *
     * @param Magang $magang
     * @param RatingScale $defaultRating
     * @param string|null $criteriaId
     * @param int $week
     */
    private function createEvaluation(Magang $magang, RatingScale $defaultRating, ?string $criteriaId, int $week)
    {
        // Check if evaluation for this week, magang, and criteria already exists
        $existingEval = EvaluasiMingguanMagang::where('magang_id', $magang->magang_id)
            ->where('minggu_ke', $week)
            ->where('criteria_id', $criteriaId)
            ->first();

        if (!$existingEval && $defaultRating) {
            $evaluasi = new EvaluasiMingguanMagang();
            $evaluasi->evaluasi_id = Str::uuid()->toString();
            $evaluasi->magang_id = $magang->magang_id;
            $evaluasi->rating_id = $defaultRating->rating_id;
            $evaluasi->criteria_id = $criteriaId;
            $evaluasi->minggu_ke = $week;
            $evaluasi->skor_minggu = $defaultRating->value / 10; // Convert to 0-5 scale
            $evaluasi->save();
        }
    }

    /**
     * Bulk update ranks for multiple magang records.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateRanks(Request $request)
    {
        $request->validate([
            'ranks' => 'required|array',
            'ranks.*' => 'required|integer|min:1',
        ]);

        // Start a transaction to ensure all updates succeed or fail together
        DB::beginTransaction();

        try {
            foreach ($request->ranks as $magangId => $rank) {
                $magang = Magang::findOrFail($magangId);
                $magang->rank = $rank;
                $magang->save();
            }

            DB::commit();
            return redirect()->route('magang.index')->with('success', 'Ranks updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('magang.index')->with('error', 'Failed to update ranks: ' . $e->getMessage());
        }
    }
}