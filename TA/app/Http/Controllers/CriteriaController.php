<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            $criteria = Criteria::where('job_id', $request->job_id)->get();
            return view('criteria.index', compact('criteria', 'job'));
        }

        // Otherwise, get all criteria grouped by job
        $criteriaByJob = Criteria::with('job')->get()->groupBy('job_id');
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
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|between:0,1',
        ]);

        // Generate a unique criteria_id
        $criteriaId = 'C' . Str::upper(Str::random(5));

        // Check if we need to generate a new ID (in case of collision)
        while (Criteria::where('criteria_id', $criteriaId)->exists()) {
            $criteriaId = 'C' . Str::upper(Str::random(5));
        }

        // Create the criteria with the generated ID
        $criteria = Criteria::create([
            'criteria_id' => $criteriaId,
            'job_id' => $request->job_id,
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'weight' => $request->weight ?? 0,
        ]);

        return redirect()->route('criteria.index', ['job_id' => $request->job_id])
            ->with('success', 'Criteria created successfully with ID: ' . $criteriaId);
    }

    /**
     * Display the specified criteria.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criterium)
    {
        // Load relationships
        $criterium->load('job', 'rowComparisons', 'columnComparisons');

        return view('criteria.show', compact('criterium'));
    }

    /**
     * Show the form for editing the specified criteria.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criterium)
    {
        $jobs = Job::all();
        return view('criteria.edit', compact('criterium', 'jobs'));
    }

    /**
     * Update the specified criteria in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criterium)
    {
        $request->validate([
            'job_id' => 'required|exists:job,job_id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'description' => 'nullable|string',
            'weight' => 'nullable|numeric|between:0,1',
        ]);

        $criterium->update([
            'job_id' => $request->job_id,
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'weight' => $request->weight ?? $criterium->weight,
        ]);

        return redirect()->route('criteria.index', ['job_id' => $request->job_id])
            ->with('success', 'Criteria updated successfully');
    }

    /**
     * Remove the specified criteria from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criterium)
    {
        // Store job_id before deletion for redirection
        $jobId = $criterium->job_id;

        // Check if criteria has any comparisons before deleting
        if ($criterium->rowComparisons()->count() > 0 || $criterium->columnComparisons()->count() > 0) {
            return redirect()->route('criteria.index', ['job_id' => $jobId])
                ->with('error', 'Cannot delete criteria. It has associated comparisons that must be deleted first.');
        }

        $criterium->delete();

        return redirect()->route('criteria.index', ['job_id' => $jobId])
            ->with('success', 'Criteria deleted successfully');
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