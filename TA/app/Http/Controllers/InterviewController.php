<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Pelamar;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::with('pelamar')->get();
        return view('interview.index', compact('interviews'));
    }

    public function create()
    {
        $pelamar = Pelamar::doesntHave('interview')->get();
        return view('interview.create', compact('pelamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'interview_id' => 'required|unique:interview',
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'kualifikasi_skor' => 'required|integer|between:1,5',
            'komunikasi_skor' => 'required|integer|between:1,5',
            'sikap_skor' => 'required|integer|between:1,5',
            'jadwal' => 'required|date'
        ]);

        $interview = new Interview($request->all());
        $interview->total_skor = ($request->kualifikasi_skor + $request->komunikasi_skor + $request->sikap_skor) / 3;
        $interview->save();

        return redirect()->route('interview.index')->with('success', 'Interview created successfully');
    }

    public function show(Interview $interview)
    {
        $interview->load('pelamar');
        return view('interview.show', compact('interview'));
    }

    public function edit(Interview $interview)
    {
        $pelamar = Pelamar::all();
        return view('interview.edit', compact('interview', 'pelamar'));
    }

    public function update(Request $request, Interview $interview)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'kualifikasi_skor' => 'required|integer|between:1,5',
            'komunikasi_skor' => 'required|integer|between:1,5',
            'sikap_skor' => 'required|integer|between:1,5',
            'jadwal' => 'required|date'
        ]);

        $interview->fill($request->all());
        $interview->total_skor = ($request->kualifikasi_skor + $request->komunikasi_skor + $request->sikap_skor) / 3;
        $interview->save();

        return redirect()->route('interview.index')->with('success', 'Interview updated successfully');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();
        return redirect()->route('interview.index')->with('success', 'Interview deleted successfully');
    }
}
