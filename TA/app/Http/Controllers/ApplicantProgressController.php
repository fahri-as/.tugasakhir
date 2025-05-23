<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelamar;
use App\Models\Periode;

class ApplicantProgressController extends Controller
{
    public function index()
    {
        $periodes = Periode::orderBy('tanggal_mulai', 'desc')->get();
        return view('applicant-progress.index', compact('periodes'));
    }

    public function selectPeriod($periode_id)
    {
        $periode = Periode::findOrFail($periode_id);
        return view('applicant-progress.input-id', compact('periode'));
    }

    public function trackProgress(Request $request, $periode_id)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id'
        ]);

        $pelamar = Pelamar::with([
                'periode',
                'job',
                'interview',
                'tesKemampuan',
                'magang',
                'magang.evaluasiMingguan',
                'magang.totalSkorMingguan'
            ])
            ->where('pelamar_id', $request->pelamar_id)
            ->where('periode_id', $periode_id)
            ->first();

        if (!$pelamar) {
            return redirect()->back()->with('error', 'Applicant ID not found in the selected period.');
        }

        return view('applicant-progress.show-progress', compact('pelamar'));
    }
}
