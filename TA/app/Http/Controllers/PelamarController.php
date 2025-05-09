<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\Periode;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class PelamarController extends Controller
{
    // No middleware in constructor - we handle this in routes

    public function index(Request $request)
    {
        // Start with base query
        $query = Pelamar::with(['periode', 'job', 'magang', 'interview', 'tesKemampuan']);

        // Apply period filter if requested
        if ($request->has('periode_id') && !empty($request->periode_id)) {
            $query->where('periode_id', $request->periode_id);
        }

        // Apply sorting if requested
        $sortBy = $request->input('sort_by', 'pelamar_id'); // Default sort by ID
        $sortDir = $request->input('sort_dir', 'asc'); // Default sort direction

        // Only allow specific columns to be sortable
        $allowedSortColumns = [
            'pelamar_id', 'nama', 'job_id', 'periode_id',
            'pendidikan', 'tgl_lahir', 'lama_pengalaman'
        ];

        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortDir);
        }

        // Get the filtered and sorted results
        $pelamar = $query->get();

        return view('pelamar.index', compact('pelamar'));
    }

    // The rest of the controller remains the same...
}
