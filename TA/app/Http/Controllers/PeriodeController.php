<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Job;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::with('jobs')->get();
        return view('periode.index', compact('periodes'));
    }

    public function create()
    {
        $jobs = Job::all();
        return view('periode.create', compact('jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|unique:periode',
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'nullable',
            'durasi_minggu_magang' => 'required|integer|min:1',
            'jobs' => 'required|array'
        ]);

        $periode = Periode::create($request->except('jobs'));
        $periode->jobs()->attach($request->jobs);

        return redirect()->route('periode.index')->with('success', 'Periode created successfully');
    }

    public function show(Periode $periode)
    {
        $periode->load('jobs');
        return view('periode.show', compact('periode'));
    }

    public function edit(Periode $periode)
    {
        $jobs = Job::all();
        $periode->load('jobs');
        return view('periode.edit', compact('periode', 'jobs'));
    }

    public function update(Request $request, Periode $periode)
    {
        $request->validate([
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'nullable',
            'durasi_minggu_magang' => 'required|integer|min:1',
            'jobs' => 'required|array'
        ]);

        $periode->update($request->except('jobs'));
        $periode->jobs()->sync($request->jobs);

        return redirect()->route('periode.index')->with('success', 'Periode updated successfully');
    }

    public function destroy(Periode $periode)
    {
        $periode->jobs()->detach();
        $periode->delete();
        return redirect()->route('periode.index')->with('success', 'Periode deleted successfully');
    }
}
