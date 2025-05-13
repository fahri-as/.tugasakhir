<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Job;
use App\Models\Pelamar;
use App\Models\Magang;
use App\Models\EvaluasiMingguanMagang;
use App\Models\TotalSkorMingguMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'nama_periode' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'deskripsi' => 'nullable',
            'durasi_minggu_magang' => 'required|integer|min:1',
            'jobs' => 'required|array'
        ]);

        // Generate a new ID for the period
        $lastPeriode = Periode::orderBy('periode_id', 'desc')->first();

        if ($lastPeriode) {
            // Extract the numeric part and increment
            $lastId = intval(substr($lastPeriode->periode_id, 3));
            $newId = 'PER' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no existing periods, start with PER001
            $newId = 'PER001';
        }

        // Create new data array with the generated ID
        $data = $request->except('jobs');
        $data['periode_id'] = $newId;

        $periode = Periode::create($data);
        $periode->jobs()->attach($request->jobs);

        return redirect()->route('periode.index')->with('success', 'Periode created successfully with ID: ' . $newId);
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
        // Begin transaction for data integrity
        DB::beginTransaction();

        try {
            // Find all applicants associated with this period
            $pelamars = Pelamar::where('periode_id', $periode->periode_id)->get();

            foreach ($pelamars as $pelamar) {
                // Delete interview records (if the model exists)
                if (class_exists('App\\Models\\Interview')) {
                    \App\Models\Interview::where('pelamar_id', $pelamar->pelamar_id)->delete();
                }

                // Delete skill test records (if the model exists)
                if (class_exists('App\\Models\\SkillTest')) {
                    \App\Models\TesKemampuan::where('pelamar_id', $pelamar->pelamar_id)->delete();
                }

                // Delete magang (internship) records for this applicant
                $magangs = Magang::where('pelamar_id', $pelamar->pelamar_id)->get();
                foreach ($magangs as $magang) {
                    // Delete evaluations
                    EvaluasiMingguanMagang::where('magang_id', $magang->magang_id)->delete();

                    // Delete weekly scores
                    TotalSkorMingguMagang::where('magang_id', $magang->magang_id)->delete();

                    // Delete the magang record
                    $magang->delete();
                }

                // Delete any other related records that might be associated with the applicant
                // For example, if there are other tables not covered above, add them here

                // Delete the applicant
                $pelamar->delete();
            }

            // Detach jobs before deleting the period
            $periode->jobs()->detach();

            // Finally delete the period
            $periode->delete();

            // Commit the transaction
            DB::commit();

            return redirect()->route('periode.index')->with('success', 'Periode dan semua data terkait (pelamar, interview, skill test, magang, evaluasi) berhasil dihapus');
        } catch (\Exception $e) {
            // Rollback in case of error
            DB::rollback();
            return redirect()->route('periode.index')->with('error', 'Gagal menghapus periode: ' . $e->getMessage());
        }
    }
}