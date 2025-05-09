<?php

namespace App\Http\Controllers;

use App\Models\TesKemampuan;
use App\Models\Pelamar;
use App\Models\User;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TesKemampuanController extends Controller
{
    public function index()
    {
        $tesKemampuan = TesKemampuan::with(['pelamar', 'user'])->get();
        return view('tes-kemampuan.index', compact('tesKemampuan'));
    }

    public function create()
    {
        $pelamar = Pelamar::doesntHave('tesKemampuan')->get();
        $users = User::all();
        return view('tes-kemampuan.create', compact('pelamar', 'users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'pelamar_id' => 'required|exists:pelamar,pelamar_id',
        'user_id' => 'required|exists:user,user_id',
        'skor' => 'required|integer|between:0,100',
        'catatan' => 'nullable',
        'jadwal' => 'required|date',
        'status_seleksi' => 'required|in:Pending,Tidak Lulus,Lulus,Magang'
    ]);

    // Generate a unique ID
    $tesId = 'TES' . str_pad(TesKemampuan::count() + 1, 3, '0', STR_PAD_LEFT);

    $tesKemampuan = new TesKemampuan();
    $tesKemampuan->tes_id = $tesId;
    $tesKemampuan->pelamar_id = $request->pelamar_id;
    $tesKemampuan->user_id = $request->user_id;
    $tesKemampuan->skor = $request->skor;
    $tesKemampuan->catatan = $request->catatan;
    $tesKemampuan->jadwal = $request->jadwal;
    $tesKemampuan->status_seleksi = $request->status_seleksi;
    $tesKemampuan->save();

    // If status is Magang, create/update Magang record
    if ($request->status_seleksi == 'Magang') {
        // Check if magang record already exists
        $magang = Magang::where('pelamar_id', $request->pelamar_id)->first();

        if (!$magang) {
            // Create new magang record
            $magangId = 'MAG' . str_pad(Magang::count() + 1, 3, '0', STR_PAD_LEFT);

            Magang::create([
                'magang_id' => $magangId,
                'pelamar_id' => $request->pelamar_id,
                'user_id' => $request->user_id,
                'status_seleksi' => 'Pending' // Default to Pending in Magang
            ]);
        }
    }

    return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan created successfully');
}

    public function show(TesKemampuan $tesKemampuan)
    {
        $tesKemampuan->load(['pelamar', 'user']);
        return view('tes-kemampuan.show', compact('tesKemampuan'));
    }

    public function edit(TesKemampuan $tesKemampuan)
    {
        $pelamar = Pelamar::all();
        $users = User::all();
        return view('tes-kemampuan.edit', compact('tesKemampuan', 'pelamar', 'users'));
    }

    public function update(Request $request, TesKemampuan $tesKemampuan)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:pelamar,pelamar_id',
            'user_id' => 'required|exists:user,user_id',
            'skor' => 'required|integer|between:0,100',
            'catatan' => 'nullable',
            'jadwal' => 'required|date',
            'status_seleksi' => 'required|in:Pending,Tidak Lulus,Lulus,Magang'
        ]);

        $tesKemampuan->pelamar_id = $request->pelamar_id;
        $tesKemampuan->user_id = $request->user_id;
        $tesKemampuan->skor = $request->skor;
        $tesKemampuan->catatan = $request->catatan;
        $tesKemampuan->jadwal = $request->jadwal;
        $tesKemampuan->status_seleksi = $request->status_seleksi;
        $tesKemampuan->save();

        // If status is changed to Magang, create/update Magang record
        if ($request->status_seleksi == 'Magang') {
            // Check if magang record already exists
            $magang = Magang::where('pelamar_id', $request->pelamar_id)->first();

            if (!$magang) {
                // Create new magang record
                $magangId = 'MAG' . str_pad(Magang::count() + 1, 3, '0', STR_PAD_LEFT);

                Magang::create([
                    'magang_id' => $magangId,
                    'pelamar_id' => $request->pelamar_id,
                    'user_id' => $request->user_id,
                    'status_seleksi' => 'Pending' // Default to Pending in Magang
                ]);
            }
        }

        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan updated successfully');
    }

    public function destroy(TesKemampuan $tesKemampuan)
    {
        $tesKemampuan->delete();
        return redirect()->route('tes-kemampuan.index')->with('success', 'Tes Kemampuan deleted successfully');
    }
}