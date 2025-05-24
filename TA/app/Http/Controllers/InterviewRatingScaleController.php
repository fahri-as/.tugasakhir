<?php

namespace App\Http\Controllers;

use App\Models\InterviewCriteria;
use App\Models\InterviewRatingScale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InterviewRatingScaleController extends Controller
{
    /**
     * Display a listing of the rating scales.
     */
    public function index()
    {
        $ratingScales = InterviewRatingScale::with('criteria')->get();
        return view('interview-rating-scales.index', compact('ratingScales'));
    }

    /**
     * Show the form for creating a new rating scale.
     */
    public function create(Request $request)
    {
        // Get the criteria ID from the request
        $criteriaId = $request->input('criteria_id');

        if (!$criteriaId) {
            return redirect()->route('jobs.index')
                ->with('error', 'Criteria ID is required to create a rating scale.');
        }

        $criteria = InterviewCriteria::findOrFail($criteriaId);
        return view('interview-rating-scales.create', compact('criteria'));
    }

    /**
     * Store a newly created rating scale in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'criteria_id' => 'required|exists:interview_criteria,criteria_id',
            'rating_level' => 'required|integer|min:1|max:5',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        // Generate a unique ID for the rating scale
        $id = 'INT_RATE_' . $request->criteria_id . '_' . Str::random(5);

        // Create new rating scale
        InterviewRatingScale::create([
            'id' => $id,
            'criteria_id' => $request->criteria_id,
            'rating_level' => $request->rating_level,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Get the criteria to redirect back to the job details
        $criteria = InterviewCriteria::findOrFail($request->criteria_id);

        return redirect()->route('jobs.show', $criteria->job_id)
            ->with('success', 'Interview rating scale created successfully.');
    }

    /**
     * Display the specified rating scale.
     */
    public function show(string $id)
    {
        $ratingScale = InterviewRatingScale::with('criteria')->findOrFail($id);
        return view('interview-rating-scales.show', compact('ratingScale'));
    }

    /**
     * Show the form for editing the specified rating scale.
     */
    public function edit(string $id)
    {
        $ratingScale = InterviewRatingScale::with('criteria')->findOrFail($id);
        return view('interview-rating-scales.edit', compact('ratingScale'));
    }

    /**
     * Update the specified rating scale in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'rating_level' => 'required|integer|min:1|max:5',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
        ]);

        $ratingScale = InterviewRatingScale::findOrFail($id);
        $ratingScale->update([
            'rating_level' => $request->rating_level,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Get the criteria to redirect back to the job details
        $criteria = InterviewCriteria::findOrFail($ratingScale->criteria_id);

        return redirect()->route('jobs.show', $criteria->job_id)
            ->with('success', 'Interview rating scale updated successfully.');
    }

    /**
     * Remove the specified rating scale from storage.
     */
    public function destroy(string $id)
    {
        $ratingScale = InterviewRatingScale::findOrFail($id);

        // Store the criteria ID to redirect after deletion
        $criteria = InterviewCriteria::findOrFail($ratingScale->criteria_id);
        $jobId = $criteria->job_id;

        $ratingScale->delete();

        return redirect()->route('jobs.show', $jobId)
            ->with('success', 'Interview rating scale deleted successfully.');
    }

    /**
     * Get all rating scales for a specific criteria.
     */
    public function getByCriteria(string $criteriaId)
    {
        $ratingScales = InterviewRatingScale::where('criteria_id', $criteriaId)
            ->orderBy('rating_level')
            ->get();

        return response()->json($ratingScales);
    }
}
