<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiMingguanMagang;
use App\Models\Magang;
use Illuminate\Http\Request;

class EvaluasiMingguanMagangController extends Controller
{
    public function index()
    {
        $evaluasi = EvaluasiMingguanMagang::with(['magang', 'pelamar'])->get();
        return view('evaluasi.index', compact('evaluasi'));
    }

    public function create()
    {
        $magang = Magang::where('status_seleksi', 'accepted')->get();
        return view('evaluasi.create', compact('magang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'evaluasi_id' => 'required|unique:evaluasi_mingguan_magang',
            'magang_id' => 'required|exists:magang,magang_id',
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'minggu_ke' => 'required|integer|min:1',
            'kriteria1' => 'required|integer|between:1,5',
            'kriteria2' => 'required|integer|between:1,5',
            'kriteria3' => 'required|integer|between:1,5',
            'kriteria4' => 'required|integer|between:1,5',
            'kriteria5' => 'required|integer|between:1,5'
        ]);

        $evaluasi = new EvaluasiMingguanMagang($request->all());
        $evaluasi->skor_minggu = ($request->kriteria1 + $request->kriteria2 + $request->kriteria3 +
                                 $request->kriteria4 + $request->kriteria5) / 5;
        $evaluasi->save();

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi created successfully');
    }

    public function show(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->load(['magang', 'pelamar']);
        return view('evaluasi.show', compact('evaluasi'));
    }

    public function edit(EvaluasiMingguanMagang $evaluasi)
    {
        $magang = Magang::where('status_seleksi', 'accepted')->get();
        return view('evaluasi.edit', compact('evaluasi', 'magang'));
    }

    public function update(Request $request, EvaluasiMingguanMagang $evaluasi)
    {
        $request->validate([
            'magang_id' => 'required|exists:magang,magang_id',
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'minggu_ke' => 'required|integer|min:1',
            'kriteria1' => 'required|integer|between:1,5',
            'kriteria2' => 'required|integer|between:1,5',
            'kriteria3' => 'required|integer|between:1,5',
            'kriteria4' => 'required|integer|between:1,5',
            'kriteria5' => 'required|integer|between:1,5'
        ]);

        $evaluasi->fill($request->all());
        $evaluasi->skor_minggu = ($request->kriteria1 + $request->kriteria2 + $request->kriteria3 +
                                 $request->kriteria4 + $request->kriteria5) / 5;
        $evaluasi->save();

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi updated successfully');
    }

    public function destroy(EvaluasiMingguanMagang $evaluasi)
    {
        $evaluasi->delete();
        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi deleted successfully');
    }
}
