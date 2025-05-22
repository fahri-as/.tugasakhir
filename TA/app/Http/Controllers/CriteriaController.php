<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the criteria.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // If a job_id is provided, filter criteria by that job
        if ($request->has('job_id')) {
            $job = Job::findOrFail($request->job_id);
            $criteria = Criteria::where('job_id', $request->job_id)
                                ->orderBy('code') // Sort by code to ensure K1, K2, K3 order
                                ->get();
            return view('criteria.index', compact('criteria', 'job'));
        }

        // Otherwise, get all criteria grouped by job, but ordered by code within each group
        $criteriaQuery = Criteria::with('job')->orderBy('code');
        $criteriaByJob = $criteriaQuery->get()->groupBy('job_id');

        return view('criteria.index', compact('criteriaByJob'));
    }

    /**
     * Show the form for creating a new criteria.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $jobs = Job::all();

        // Pre-select job if job_id is provided
        $selectedJobId = $request->job_id;

        return view('criteria.create', compact('jobs', 'selectedJobId'));
    }

    /**
     * Store a newly created criteria in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:job,job_id',
            'name' => 'required|string|max:50',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255'

        ]);

        // Begin transaction to ensure all operations succeed or fail together
        DB::beginTransaction();

        try {
            // Generate a unique numeric criteria_id
            $criteriaId = mt_rand(1, 999);
            while (Criteria::where('criteria_id', $criteriaId)->exists()) {
                $criteriaId = mt_rand(1, 999);
            }

            // Create the criteria with the generated ID
            $criteria = Criteria::create([
                'criteria_id' => $criteriaId,
                'job_id' => $request->job_id,
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
            ]);

            $createdEvaluations = 0;

            // PART 1: For existing evaluations, add this criteria to each intern's weekly evaluation
            // Get interns (magang) via pelamar (applicants) that match the job_id
            // Then get unique magang_id and minggu_ke combinations from existing evaluations
            $existingEvaluations = DB::table('evaluasi_mingguan_magang as emm')
                ->join('magang as m', 'emm.magang_id', '=', 'm.magang_id')
                ->join('pelamar as p', 'm.pelamar_id', '=', 'p.pelamar_id')
                ->select('emm.magang_id', 'emm.minggu_ke')
                ->where('p.job_id', '=', $request->job_id)
                ->groupBy('emm.magang_id', 'emm.minggu_ke')
                ->get();

            // For each combination, create a new evaluation for the new criteria
            foreach ($existingEvaluations as $evaluation) {
                // Check if this evaluation already exists
                $exists = DB::table('evaluasi_mingguan_magang')
                    ->where('magang_id', $evaluation->magang_id)
                    ->where('criteria_id', $criteriaId)
                    ->where('minggu_ke', $evaluation->minggu_ke)
                    ->exists();

                if (!$exists) {
                    $evaluasiId = Str::uuid()->toString();

                    DB::table('evaluasi_mingguan_magang')->insert([
                        'evaluasi_id' => $evaluasiId,
                        'magang_id' => $evaluation->magang_id,
                        'criteria_id' => $criteriaId,
                        'minggu_ke' => $evaluation->minggu_ke,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    $createdEvaluations++;

                    // Ensure a total_skor_minggu_magang record exists for this magang_id and minggu_ke
                    $totalScoreExists = DB::table('total_skor_minggu_magang')
                        ->where('magang_id', $evaluation->magang_id)
                        ->where('minggu_ke', $evaluation->minggu_ke)
                        ->exists();

                    if (!$totalScoreExists) {
                        DB::table('total_skor_minggu_magang')->insert([
                            'id' => Str::uuid()->toString(),
                            'magang_id' => $evaluation->magang_id,
                            'minggu_ke' => $evaluation->minggu_ke,
                            'total_skor' => 0.00,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }

            // PART 2: For all interns with this job_id that have no evaluations yet,
            // create initial evaluation records for week 1
            $internsWithoutEvals = DB::table('magang as m')
                ->join('pelamar as p', 'm.pelamar_id', '=', 'p.pelamar_id')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                          ->from('evaluasi_mingguan_magang as emm')
                          ->whereRaw('emm.magang_id = m.magang_id');
                })
                ->select('m.magang_id')
                ->where('p.job_id', '=', $request->job_id)
                ->where('m.status_seleksi', '=', 'Sedang Berjalan') // Only for active interns
                ->groupBy('m.magang_id')
                ->get();

            foreach ($internsWithoutEvals as $intern) {
                $evaluasiId = Str::uuid()->toString();

                DB::table('evaluasi_mingguan_magang')->insert([
                    'evaluasi_id' => $evaluasiId,
                    'magang_id' => $intern->magang_id,
                    'criteria_id' => $criteriaId,
                    'minggu_ke' => 1, // Start with week 1
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $createdEvaluations++;

                // Ensure a total_skor_minggu_magang record exists for this magang_id and minggu_ke
                $totalScoreExists = DB::table('total_skor_minggu_magang')
                    ->where('magang_id', $intern->magang_id)
                    ->where('minggu_ke', 1)
                    ->exists();

                if (!$totalScoreExists) {
                    DB::table('total_skor_minggu_magang')->insert([
                        'id' => Str::uuid()->toString(),
                        'magang_id' => $intern->magang_id,
                        'minggu_ke' => 1,
                        'total_skor' => 0.00,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            DB::commit();

            $message = 'Criteria created successfully with ID: ' . $criteriaId;
            if ($createdEvaluations > 0) {
                $message .= '. Created ' . $createdEvaluations . ' evaluation records for existing interns.';
            }

            return redirect()->route('criteria.index', ['job_id' => $request->job_id])
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('criteria.create')
                ->with('error', 'Error creating criteria: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified criteria.
     *
     * @param  \App\Models\Criteria  $criterion
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criterion)
    {
        // Load relationships
        $criterion->load(['job',
            'rowComparisons' => function($query) {
                $query->with(['columnCriteria' => function($q) {
                    $q->orderBy('code');
                }]);
            },
            'columnComparisons' => function($query) {
                $query->with(['rowCriteria' => function($q) {
                    $q->orderBy('code');
                }]);
            }
        ]);

        return view('criteria.show', compact('criterion'));
    }

    /**
     * Show the form for editing the specified criteria.
     *
     * @param  \App\Models\Criteria  $criterion
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criterion)
    {
        $jobs = Job::all();
        return view('criteria.edit', compact('criterion', 'jobs'));
    }

    /**
     * Update the specified criteria in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criteria  $criterion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criterion)
    {
        $request->validate([
            'job_id' => 'required|exists:job,job_id',
            'name' => 'required|string|max:50',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:255'

        ]);

        $criterion->update([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description

        ]);

        return redirect()->route('criteria.index', ['job_id' => $request->job_id])
            ->with('success', 'Criteria updated successfully');
    }

    /**
     * Remove the specified criteria from storage.
     *
     * @param  \App\Models\Criteria  $criterion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criterion)
    {
        // Store job_id before deletion for redirection
        $jobId = $criterion->job_id;
        $criteriaId = $criterion->criteria_id;

        try {
            // Check if criteria has any comparisons before deleting
            if ($criterion->rowComparisons()->count() > 0 || $criterion->columnComparisons()->count() > 0) {
                return redirect()->route('criteria.index', ['job_id' => $jobId])
                    ->with('error', 'Cannot delete criteria. It has associated comparisons that must be deleted first.');
            }

            // Check if criteria is used in evaluations - warn but allow deletion
            $evaluasiCount = \App\Models\EvaluasiMingguanMagang::where('criteria_id', $criteriaId)->count();

            // Force delete to ensure it's removed - this will trigger the deleting event in the model
            // which will cascade delete evaluations
            $deleted = $criterion->delete();

            if (!$deleted) {
                return redirect()->route('criteria.index', ['job_id' => $jobId])
                    ->with('error', 'Failed to delete criteria. Please try again.');
            }

            $message = 'Criteria deleted successfully';
            if ($evaluasiCount > 0) {
                $message .= '. Also deleted ' . $evaluasiCount . ' related evaluations.';
            }

            return redirect()->route('criteria.index', ['job_id' => $jobId])
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->route('criteria.index', ['job_id' => $jobId])
                ->with('error', 'Error deleting criteria: ' . $e->getMessage());
        }
    }

    /**
     * Force delete a criteria by first removing all associated data
     *
     * @param  \App\Models\Criteria  $criterion
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(Criteria $criterion)
    {
        // Store job_id before deletion for redirection
        $jobId = $criterion->job_id;
        $criteriaId = $criterion->criteria_id;

        try {
            // Begin transaction to ensure all operations succeed or fail together
            DB::beginTransaction();

            // 1. Delete all comparisons where this criteria is in the row or column
            $rowComparisonsCount = $criterion->rowComparisons()->count();
            $columnComparisonsCount = $criterion->columnComparisons()->count();

            $criterion->rowComparisons()->delete();
            $criterion->columnComparisons()->delete();

            // 2. Count evaluations related to this criteria for the success message
            $evaluasiCount = $criterion->evaluations()->count();

            // 3. Delete the criteria - this will trigger the deleting event in the model
            // which will cascade delete evaluations
            $deleted = $criterion->delete();

            if (!$deleted) {
                DB::rollBack();
                return redirect()->route('criteria.index', ['job_id' => $jobId])
                    ->with('error', 'Failed to delete criteria. Please try again.');
            }

            DB::commit();

            $message = 'Criteria deleted successfully. ';
            if ($rowComparisonsCount > 0 || $columnComparisonsCount > 0) {
                $message .= 'Removed ' . ($rowComparisonsCount + $columnComparisonsCount) . ' comparisons. ';
            }
            if ($evaluasiCount > 0) {
                $message .= 'Deleted ' . $evaluasiCount . ' related evaluations.';
            }

            return redirect()->route('criteria.index', ['job_id' => $jobId])
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('criteria.index', ['job_id' => $jobId])
                ->with('error', 'Error deleting criteria: ' . $e->getMessage());
        }
    }

    /**
     * Update weights for multiple criteria at once
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateWeights(Request $request)
    {
        $request->validate([
            'weights' => 'required|array',
            'weights.*' => 'required|numeric|between:0,1',
            'job_id' => 'required|exists:job,job_id',
        ]);

        // Update each criteria weight
        foreach ($request->weights as $criteriaId => $weight) {
            $criteria = Criteria::findOrFail($criteriaId);
            $criteria->update(['weight' => $weight]);
        }

        return redirect()->route('criteria.index', ['job_id' => $request->job_id])
            ->with('success', 'Criteria weights updated successfully');
    }
}