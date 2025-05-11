<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\RatingScale;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EvaluasiMingguanMagangController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected period or default to the latest period
        $latestPeriode = Periode::orderBy('tanggal_mulai', 'desc')->first();
        $selectedPeriodeId = $request->periode_id ?? ($latestPeriode ? $latestPeriode->periode_id : null);

        // If a period is selected, we don't need to load all evaluations right away
        // We'll load them via AJAX when a week is selected
        $evaluasi = collect(); // Empty collection by default

        return view('evaluasi.index', compact('evaluasi'));
    }

    /**
     * API endpoint to get evaluations by week
     * This is called via AJAX from the frontend
     */
    public function getByWeek(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode,periode_id',
            'week' => 'required|integer|min:1',
        ]);

        $periodeId = $request->periode_id;
        $week = $request->week;

        // Get all evaluations for this week in the selected period
        $evaluations = EvaluasiMingguanMagang::with([
                'magang',
                'magang.pelamar',
                'magang.pelamar.job',
                'ratingScale'
            ])
            ->whereHas('magang', function($query) use ($periodeId) {
                $query->whereHas('pelamar', function($q) use ($periodeId) {
                    $q->where('periode_id', $periodeId);
                });
            })
            ->where('minggu_ke', $week)
            ->get();

        return response()->json($evaluations);
    }

    public function create(Request $request)
    {
        // Pre-select period and week if provided in the query parameters
        $selectedPeriodeId = $request->periode_id;
        $selectedWeek = $request->week;

        // Get interns who are currently active (status_seleksi = 'Sedang Berjalan')
        $magang = Magang::where('status_seleksi', 'Sedang Berjalan')
            ->with('pelamar')
            ->when($selectedPeriodeId, function($query) use ($selectedPeriodeId) {
                return $query->whereHas('pelamar', function($q) use ($selectedPeriodeId) {
                    $q->where('periode_id', $selectedPeriodeId);
                });
            })
            ->get();

        $ratingScales = RatingScale::all();

        return view('evaluasi.create', compact('magang', 'ratingScales', 'selectedPeriodeId', 'selectedWeek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'magang_id' => 'required|exists:magang,magang_id',
            'rating_id' => 'required|exists:rating_scales,rating_id',
            'minggu_ke' => 'required|integer|min:1',
        ]);

        // Check if evaluation already exists for this magang and week
        $exists = EvaluasiMingguanMagang::where('magang_id', $request->magang_id)
            ->where('minggu_ke', $request->minggu_ke)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Evaluation for this intern and week already exists');
        }

        // Get the rating value to calculate score
        $rating = RatingScale::findOrFail($request->rating_id);

        // Create the evaluation
        $evaluasi = new EvaluasiMingguanMagang();
        $evaluasi->evaluasi_id = Str::uuid()->toString();
        $evaluasi->magang_id = $request->magang_id;
        $evaluasi->rating_id = $request->rating_id;
        $evaluasi->minggu_ke = $request->minggu_ke;
        $evaluasi->skor_minggu = $rating->value / 10; // Convert to 0-5 scale
        $evaluasi->save();

        // Get the period ID to redirect back to the same period view
        $periodeId = Magang::with('pelamar')->findOrFail($request->magang_id)->pelamar->periode_id ?? null;
        $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];

        return redirect()->route('evaluasi.index', $redirectParams)->with('success', 'Evaluasi created successfully');
    }

    public function show(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->load(['magang', 'magang.pelamar', 'magang.pelamar.job', 'ratingScale']);
        return view('evaluasi.show', compact('evaluasi'));
    }

    public function edit(EvaluasiMingguanMagang $evaluasi)
    {
        $magang = Magang::with('pelamar')->get();
        $ratingScales = RatingScale::all();
        return view('evaluasi.edit', compact('evaluasi', 'magang', 'ratingScales'));
    }

    public function update(Request $request, EvaluasiMingguanMagang $evaluasi)
    {
        $request->validate([
            'magang_id' => 'required|exists:magang,magang_id',
            'rating_id' => 'required|exists:rating_scales,rating_id',
            'minggu_ke' => 'required|integer|min:1',
        ]);

        // Check if evaluation already exists for this magang and week (excluding current record)
        $exists = EvaluasiMingguanMagang::where('magang_id', $request->magang_id)
            ->where('minggu_ke', $request->minggu_ke)
            ->where('evaluasi_id', '!=', $evaluasi->evaluasi_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Evaluation for this intern and week already exists');
        }

        // Get the rating value to calculate score
        $rating = RatingScale::findOrFail($request->rating_id);

        // Update the evaluation
        $evaluasi->magang_id = $request->magang_id;
        $evaluasi->rating_id = $request->rating_id;
        $evaluasi->minggu_ke = $request->minggu_ke;
        $evaluasi->skor_minggu = $rating->value / 10; // Convert to 0-5 scale
        $evaluasi->save();

        // Get the period ID to redirect back to the same period view
        $periodeId = Magang::with('pelamar')->findOrFail($request->magang_id)->pelamar->periode_id ?? null;
        $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];

        return redirect()->route('evaluasi.index', $redirectParams)->with('success', 'Evaluasi updated successfully');
    }

    public function destroy(EvaluasiMingguanMagang $evaluasi)
    {
        // Get the period ID before deletion for redirecting back to the same period view
        $periodeId = $evaluasi->magang->pelamar->periode_id ?? null;

        $evaluasi->delete();

        $redirectParams = $periodeId ? ['periode_id' => $periodeId] : [];
        return redirect()->route('evaluasi.index', $redirectParams)->with('success', 'Evaluasi deleted successfully');
    }
}
