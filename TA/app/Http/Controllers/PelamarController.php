<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Periode;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
class PelamarController extends Controller
{
    public function index()
    {
        $pelamar = Pelamar::with(['periode', 'job', 'magang', 'interview', 'tesKemampuan'])->get();
        return view('pelamar.index', compact('pelamar'));
    }

    public function create()
    {
        // Eager load jobs to have them available for the dropdown
        $periodes = Periode::with('jobs')->get();
        return view('pelamar.create', compact('periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode_id' => 'required|exists:periode,periode_id',
            'job_id' => [
                'required',
                Rule::exists('periode_job', 'job_id')->where(function ($query) use ($request) {
                    return $query->where('periode_id', $request->periode_id);
                }),
            ],
            'nama' => 'required',
            'email' => 'required|email', // Removed unique constraint
            'nomor_wa' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'lama_pengalaman' => 'required|integer|min:0',
            'tempat_pengalaman' => 'required|string',
            'deskripsi_tempat' => 'required',
            'berkas_cv' => 'required|file|mimes:pdf,doc,docx|max:500'
        ]);

        // Get the last applicant ID to generate the new one
        $lastApplicant = Pelamar::orderBy('pelamar_id', 'desc')->first();

        if ($lastApplicant) {
            // Extract the numeric part and increment
            $lastId = intval(substr($lastApplicant->pelamar_id, 2));
            $newId = 'PL' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no existing applicants, start with PL001
            $newId = 'PL001';
        }

        // Prepare data for creation
        $data = $request->except('berkas_cv');
        $data['pelamar_id'] = $newId;

        // Handle CV file upload
        if ($request->hasFile('berkas_cv')) {
            $file = $request->file('berkas_cv');
            $fileName = $newId . '_CV.' . $file->getClientOriginalExtension();

            // Make sure the directory exists
            $directory = public_path('cv_files');
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // Move the file directly to the public directory
            $file->move($directory, $fileName);

            // Store the relative path
            $data['berkas_cv'] = 'cv_files/' . $fileName;
        }

        $pelamar = Pelamar::create($data);
        return redirect()->route('pelamar.index')->with('success', 'Pelamar created successfully with ID: ' . $newId);
    }

    public function show(Pelamar $pelamar)
    {
        $pelamar->load(['periode', 'job', 'magang', 'interview', 'tesKemampuan']);
        return view('pelamar.show', compact('pelamar'));
    }

    public function edit(Pelamar $pelamar)
    {
        $periodes = Periode::with('jobs')->get();

        // Get the specific jobs for the current period
        $currentPeriodeJobs = [];
        if ($pelamar->periode_id) {
            $currentPeriode = $periodes->firstWhere('periode_id', $pelamar->periode_id);
            if ($currentPeriode) {
                $currentPeriodeJobs = $currentPeriode->jobs;
            }
        }

        return view('pelamar.edit', compact('pelamar', 'periodes', 'currentPeriodeJobs'));
    }

    public function update(Request $request, Pelamar $pelamar)
    {
        $validationRules = [
            'periode_id' => 'required|exists:periode,periode_id',
            'job_id' => [
                'required',
                Rule::exists('periode_job', 'job_id')->where(function ($query) use ($request) {
                    return $query->where('periode_id', $request->periode_id);
                }),
            ],
            'nama' => 'required',
            'email' => 'required|email', // Removed unique constraint
            'nomor_wa' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'lama_pengalaman' => 'required|integer|min:0',
            'tempat_pengalaman' => 'required|string',
            'deskripsi_tempat' => 'required'
        ];

        // Only validate file if a new one is being uploaded
        if ($request->hasFile('berkas_cv')) {
            $validationRules['berkas_cv'] = 'file|mimes:pdf,doc,docx|max:500';
        } else if (!$pelamar->berkas_cv) {
            // If no existing file and no new file uploaded, make it required
            $validationRules['berkas_cv'] = 'required|file|mimes:pdf,doc,docx|max:500';
        }

        $request->validate($validationRules);

        // Prepare data for update
        $data = $request->except(['berkas_cv', '_token', '_method']);

    // Handle CV file upload if present
    if ($request->hasFile('berkas_cv')) {
        // Delete old file if exists
        if ($pelamar->berkas_cv) {
            $oldFilePath = public_path($pelamar->berkas_cv);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }

        $file = $request->file('berkas_cv');
        $fileName = $pelamar->pelamar_id . '_CV.' . $file->getClientOriginalExtension();

        // Make sure the directory exists
        $directory = public_path('cv_files');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Move the file directly to the public directory
        $file->move($directory, $fileName);

        // Store the relative path
        $data['berkas_cv'] = 'cv_files/' . $fileName;
    }

    $pelamar->update($data);
    return redirect()->route('pelamar.index')->with('success', 'Pelamar updated successfully');
}

    public function destroy(Pelamar $pelamar)
    {
        // Delete CV file if exists
        if ($pelamar->berkas_cv) {
            // Extract the file path from the URL
            $path = str_replace('/storage/', '', $pelamar->berkas_cv);
            Storage::disk('public')->delete($path);
        }

        $pelamar->delete();
        return redirect()->route('pelamar.index')->with('success', 'Pelamar deleted successfully');
    }
}
