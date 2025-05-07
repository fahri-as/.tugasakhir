<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use App\Models\RatingScale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EvaluasiMingguanMagangController extends Controller
{
    public function index()
    {
        $evaluasi = EvaluasiMingguanMagang::with(['magang', 'magang.pelamar', 'ratingScale'])->get();
        return view('evaluasi.index', compact('evaluasi'));
    }

    public function create()
    {
        $magang = Magang::where('status_seleksi', 'Sedang Berjalan')->with('pelamar')->get();
        $ratingScales = RatingScale::all();
        return view('evaluasi.create', compact('magang', 'ratingScales'));
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

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi created successfully');
    }

    public function show(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->load(['magang', 'magang.pelamar', 'ratingScale']);
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

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi updated successfully');
    }

    public function destroy(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi deleted successfully');
    }
}
