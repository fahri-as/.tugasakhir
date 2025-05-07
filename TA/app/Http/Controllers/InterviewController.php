<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::with(['pelamar', 'user'])->get();
        return view('interview.index', compact('interviews'));
    }

    public function create()
    {
        $pelamar = Pelamar::doesntHave('interview')->get();
        $users = User::all();
        return view('interview.create', compact('pelamar', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'kualifikasi_skor' => 'required|integer|between:1,5',
            'komunikasi_skor' => 'required|integer|between:1,5',
            'sikap_skor' => 'required|integer|between:1,5',
            'jadwal' => 'required|date'
        ]);

        // Generate a unique ID
        $interviewId = 'INT' . str_pad(Interview::count() + 1, 3, '0', STR_PAD_LEFT);

        $interview = new Interview();
        $interview->interview_id = $interviewId;
        $interview->pelamar_id = $request->pelamar_id;
        $interview->user_id = $request->user_id;
        $interview->kualifikasi_skor = $request->kualifikasi_skor;
        $interview->komunikasi_skor = $request->komunikasi_skor;
        $interview->sikap_skor = $request->sikap_skor;
        $interview->jadwal = $request->jadwal;

        // Calculate total score as average of the three scores
        $interview->total_skor = ($request->kualifikasi_skor + $request->komunikasi_skor + $request->sikap_skor) / 3;

        $interview->save();

        return redirect()->route('interview.index')->with('success', 'Interview created successfully');
    }

    public function show(Interview $interview)
    {
        $interview->load(['pelamar', 'user']);
        return view('interview.show', compact('interview'));
    }

    public function edit(Interview $interview)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('interview.edit', compact('interview', 'pelamar', 'users'));
    }

    public function update(Request $request, Interview $interview)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'kualifikasi_skor' => 'required|integer|between:1,5',
            'komunikasi_skor' => 'required|integer|between:1,5',
            'sikap_skor' => 'required|integer|between:1,5',
            'jadwal' => 'required|date'
        ]);

        $interview->pelamar_id = $request->pelamar_id;
        $interview->user_id = $request->user_id;
        $interview->kualifikasi_skor = $request->kualifikasi_skor;
        $interview->komunikasi_skor = $request->komunikasi_skor;
        $interview->sikap_skor = $request->sikap_skor;
        $interview->jadwal = $request->jadwal;

        // Calculate total score as average of the three scores
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
