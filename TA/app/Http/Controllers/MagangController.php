<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Pelamar;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function index()
    {
        $magang = Magang::with(['pelamar', 'evaluasiMingguan'])->get();
        return view('magang.index', compact('magang'));
    }

    public function create()
    {
        $pelamar = Pelamar::doesntHave('magang')->get();
        return view('magang.create', compact('pelamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'magang_id' => 'required|unique:magang',
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'total_skor' => 'required|numeric|between:0,5',
            'status_seleksi' => 'required|in:pending,accepted,rejected'
        ]);

        Magang::create($request->all());
        return redirect()->route('magang.index')->with('success', 'Magang created successfully');
    }

    public function show(Magang $magang)
    {
        $magang->load(['pelamar', 'evaluasiMingguan']);
        return view('magang.show', compact('magang'));
    }

    public function edit(Magang $magang)
    {
        $pelamar = Pelamar::all();
        return view('magang.edit', compact('magang', 'pelamar'));
    }

    public function update(Request $request, Magang $magang)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'total_skor' => 'required|numeric|between:0,5',
            'status_seleksi' => 'required|in:pending,accepted,rejected'
        ]);

        $magang->update($request->all());
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
            'status_seleksi' => 'required|in:pending,accepted,rejected'
        ]);

        $magang->status_seleksi = $request->status_seleksi;
        $magang->save();

        return redirect()->route('magang.index')->with('success', 'Status updated successfully');
    }
}
