<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\InterviewCriteria;
use App\Models\TesKemampuanCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        // Create the job
        $job = Job::create($data);

        // Create interview criteria automatically
        $this->createInterviewCriteria($job->job_id);

        // Create test capability criteria automatically
        $this->createTesKemampuanCriteria($job->job_id);

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
        // Prevent deletion of specific job IDs
        if ($job->job_id === 'JOB001' || $job->job_id === 'JOB004') {
            return redirect()->route('jobs.index')->with('error', 'Job dengan ID ' . $job->job_id . ' tidak dapat dihapus.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully');
    }

    /**
     * Create standard interview criteria for a job
     */
    private function createInterviewCriteria($jobId)
    {
        $criteria = [
            [
                'name' => 'Kualifikasi',
                'code' => 'KL',
                'description' => 'Penilaian kesesuaian latar belakang, pendidikan, dan pengalaman kandidat dengan posisi yang dilamar',
                'weight' => 0.4000
            ],
            [
                'name' => 'Komunikasi',
                'code' => 'KM',
                'description' => 'Penilaian kemampuan komunikasi, penyampaian ide, dan interaksi selama wawancara',
                'weight' => 0.3000
            ],
            [
                'name' => 'Sikap',
                'code' => 'SK',
                'description' => 'Penilaian sikap profesional, motivasi, dan kepribadian kandidat',
                'weight' => 0.3000
            ]
        ];

        foreach ($criteria as $item) {
            InterviewCriteria::create([
                'criteria_id' => 'INT_CRIT_' . $jobId . '_' . (array_search($item, $criteria) + 1),
                'job_id' => $jobId,
                'name' => $item['name'],
                'code' => $item['code'],
                'description' => $item['description'],
                'weight' => $item['weight']
            ]);
        }
    }

    /**
     * Create standard test capability criteria for a job
     */
    private function createTesKemampuanCriteria($jobId)
    {
        TesKemampuanCriteria::create([
            'criteria_id' => 'TES_CRIT_' . $jobId,
            'job_id' => $jobId,
            'name' => 'Kemampuan Teknis',
            'code' => 'KT',
            'description' => 'Penilaian kemampuan teknis sesuai dengan posisi yang dilamar',
            'weight' => 1.0000
        ]);
    }
}