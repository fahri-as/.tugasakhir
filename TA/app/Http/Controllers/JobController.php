<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_job' => 'required',
            'deskripsi' => 'nullable'
        ]);

        // Generate a new ID for the job
        $lastJob = Job::orderBy('job_id', 'desc')->first();

        if ($lastJob) {
            // Extract the numeric part and increment
            $lastId = intval(substr($lastJob->job_id, 3));
            $newId = 'JOB' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no existing jobs, start with JOB001
            $newId = 'JOB001';
        }

        // Create new data array with the generated ID
        $data = $request->all();
        $data['job_id'] = $newId;

        Job::create($data);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully with ID: ' . $newId);
    }

    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'nama_job' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $job->update($request->all());
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully');
    }
}
