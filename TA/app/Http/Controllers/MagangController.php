<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Pelamar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MagangController extends Controller
{
    public function index()
    {
        $magang = Magang::with(['pelamar', 'user', 'evaluasiMingguan'])->get();
        return view('magang.index', compact('magang'));
    }

    public function create()
    {
        $pelamar = Pelamar::doesntHave('magang')->get();
        $users = User::all();
        return view('magang.create', compact('pelamar', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'total_skor' => 'nullable|numeric|between:0,5',
            'rank' => 'nullable|integer|min:1',
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan,Selesai'
        ]);

        // Generate a unique ID
        $magangId = 'MAG' . str_pad(Magang::count() + 1, 3, '0', STR_PAD_LEFT);

        $magang = new Magang();
        $magang->magang_id = $magangId;
        $magang->pelamar_id = $request->pelamar_id;
        $magang->user_id = $request->user_id;
        $magang->total_skor = $request->total_skor ?? 0;
        $magang->rank = $request->rank;
        $magang->status_seleksi = $request->status_seleksi;
        $magang->save();

        return redirect()->route('magang.index')->with('success', 'Magang created successfully');
    }

    public function show(Magang $magang)
    {
        $magang->load(['pelamar', 'user', 'evaluasiMingguan']);
        return view('magang.show', compact('magang'));
    }

    public function edit(Magang $magang)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('magang.edit', compact('magang', 'pelamar', 'users'));
    }

    public function update(Request $request, Magang $magang)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'total_skor' => 'nullable|numeric|between:0,5',
            'rank' => 'nullable|integer|min:1',
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan,Selesai'
        ]);

        $magang->pelamar_id = $request->pelamar_id;
        $magang->user_id = $request->user_id;
        $magang->total_skor = $request->total_skor ?? $magang->total_skor;
        $magang->rank = $request->rank;
        $magang->status_seleksi = $request->status_seleksi;
        $magang->save();

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
            'status_seleksi' => 'required|in:Pending,Lulus,Tidak Lulus,Sedang Berjalan,Selesai'
        ]);

        $magang->status_seleksi = $request->status_seleksi;
        $magang->save();

        return redirect()->route('magang.index')->with('success', 'Status updated successfully');
    }
}
