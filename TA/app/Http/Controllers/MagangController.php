<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MagangController extends Controller
{
    // Update the index method in MagangController.php
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
        'magang_id', 'total_skor', 'rank', 'status_seleksi'
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

    public function create()
    {
        $pelamar = Pelamar::doesntHave('magang')->get();
        $users = User::all();
        return view('magang.create', compact('pelamar', 'users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'pelamar_id' => 'required|exists:pelamar,pelamar_id',
        'user_id' => 'required|exists:user,user_id',
        'total_skor' => 'nullable|numeric|between:0,5',
        'rank' => 'nullable|integer|min:1',
        'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan'
    ]);

    // Generate a unique ID
    $magangId = 'MAG' . str_pad(Magang::count() + 1, 3, '0', STR_PAD_LEFT);

    $magang = new Magang();
    $magang->magang_id = $magangId;
    $magang->pelamar_id = $request->pelamar_id;
    $magang->user_id = $request->user_id;
    $magang->total_skor = $request->total_skor ?? 0;
    $magang->rank = $request->rank;
    $magang->status_seleksi = $request->status_seleksi;
    $magang->save();

    return redirect()->route('magang.index')->with('success', 'Magang created successfully');
}

    public function show(Magang $magang)
    {
        $magang->load(['pelamar', 'user', 'evaluasiMingguan']);
        return view('magang.show', compact('magang'));
    }

    public function edit(Magang $magang)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('magang.edit', compact('magang', 'pelamar', 'users'));
    }

    public function update(Request $request, Magang $magang)
{
    $request->validate([
        'pelamar_id' => 'required|exists:pelamar,pelamar_id',
        'user_id' => 'required|exists:user,user_id',
        'total_skor' => 'nullable|numeric|between:0,5',
        'rank' => 'nullable|integer|min:1',
        'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan'
    ]);

    $magang->pelamar_id = $request->pelamar_id;
    $magang->user_id = $request->user_id;
    $magang->total_skor = $request->total_skor ?? $magang->total_skor;
    $magang->rank = $request->rank;
    $magang->status_seleksi = $request->status_seleksi;
    $magang->save();

    return redirect()->route('magang.index')->with('success', 'Magang updated successfully');
}

    public function destroy(Magang $magang)
    {
        $magang->delete();
        return redirect()->route('magang.index')->with('success', 'Magang deleted successfully');
    }

    public function updateStatus(Request $request, Magang $magang)
    {
        $request->validate([
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan,Selesai'
        ]);

        $magang->status_seleksi = $request->status_seleksi;
        $magang->save();

        return redirect()->route('magang.index')->with('success', 'Status updated successfully');
    }
}
