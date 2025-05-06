<?php

namespace App\Http\Controllers;

use App\Models\TesKemampuan;
use App\Models\Pelamar;
use Illuminate\Http\Request;

class TesKemampuanController extends Controller
{
    public function index()
    {
        $tesKemampuan = TesKemampuan::with('pelamar')->get();
        return view('tes-kemampuan.index', compact('tesKemampuan'));
    }

    public function create()
    {
        $pelamar = Pelamar::doesntHave('tesKemampuan')->get();
        return view('tes-kemampuan.create', compact('pelamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tes_id' => 'required|unique:tes_kemampuan',
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'skor' => 'required|integer|between:0,100',
            'catatan' => 'nullable',
            'jadwal' => 'required|date'
        ]);

        TesKemampuan::create($request->all());
        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan created successfully');
    }

    public function show(TesKemampuan $tesKemampuan)
    {
        $tesKemampuan->load('pelamar');
        return view('tes-kemampuan.show', compact('tesKemampuan'));
    }

    public function edit(TesKemampuan $tesKemampuan)
    {
        $pelamar = Pelamar::all();
        return view('tes-kemampuan.edit', compact('tesKemampuan', 'pelamar'));
    }

    public function update(Request $request, TesKemampuan $tesKemampuan)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'skor' => 'required|integer|between:0,100',
            'catatan' => 'nullable',
            'jadwal' => 'required|date'
        ]);

        $tesKemampuan->update($request->all());
        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan updated successfully');
    }

    public function destroy(TesKemampuan $tesKemampuan)
    {
        $tesKemampuan->delete();
        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan deleted successfully');
    }
}
