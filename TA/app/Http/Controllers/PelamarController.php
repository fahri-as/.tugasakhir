<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Periode;
use App\Models\Job;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function index()
    {
        $pelamar = Pelamar::with(['periode', 'job', 'magang', 'interview', 'tesKemampuan'])->get();
        return view('pelamar.index', compact('pelamar'));
    }

    public function create()
    {
        $periodes = Periode::all();
        $jobs = Job::all();
        return view('pelamar.create', compact('periodes', 'jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|unique:pelamar',
            'periode_id' => 'required|exists:periode,periode_id',
            'job_id' => 'required|exists:job,job_id',
            'nama' => 'required',
            'email' => 'required|email|unique:pelamar',
            'nomor_wa' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'lama_pengalaman' => 'nullable|integer',
            'tempat_pengalaman' => 'nullable|integer',
            'deskripsi_tempat' => 'nullable',
            'cv_gdrive_id' => 'nullable',
            'cv_gdrive_link' => 'nullable'
        ]);

        $pelamar = Pelamar::create($request->all());
        return redirect()->route('pelamar.index')->with('success', 'Pelamar created successfully');
    }

    public function show(Pelamar $pelamar)
    {
        $pelamar->load(['periode', 'job', 'magang', 'interview', 'tesKemampuan', 'evaluasiMingguan']);
        return view('pelamar.show', compact('pelamar'));
    }

    public function edit(Pelamar $pelamar)
    {
        $periodes = Periode::all();
        $jobs = Job::all();
        return view('pelamar.edit', compact('pelamar', 'periodes', 'jobs'));
    }

    public function update(Request $request, Pelamar $pelamar)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode,periode_id',
            'job_id' => 'required|exists:job,job_id',
            'nama' => 'required',
            'email' => 'required|email|unique:pelamar,email,' . $pelamar->pelamar_id . ',pelamar_id',
            'nomor_wa' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'lama_pengalaman' => 'nullable|integer',
            'tempat_pengalaman' => 'nullable|integer',
            'deskripsi_tempat' => 'nullable',
            'cv_gdrive_id' => 'nullable',
            'cv_gdrive_link' => 'nullable'
        ]);

        $pelamar->update($request->all());
        return redirect()->route('pelamar.index')->with('success', 'Pelamar updated successfully');
    }

    public function destroy(Pelamar $pelamar)
    {
        $pelamar->delete();
        return redirect()->route('pelamar.index')->with('success', 'Pelamar deleted successfully');
    }
}
