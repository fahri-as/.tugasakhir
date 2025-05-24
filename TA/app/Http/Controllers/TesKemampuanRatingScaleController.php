<?php

namespace App\Http\Controllers;

use App\Models\TesKemampuanCriteria;
use App\Models\TesKemampuanRatingScale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TesKemampuanRatingScaleController extends Controller
{
    /**
     * Display a listing of the rating scales.
     */
    public function index()
    {
        $ratingScales = TesKemampuanRatingScale::with('criteria')->get();
        return view('tes-kemampuan-rating-scales.index', compact('ratingScales'));
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

        $criteria = TesKemampuanCriteria::findOrFail($criteriaId);
        return view('tes-kemampuan-rating-scales.create', compact('criteria'));
    }

    /**
     * Store a newly created rating scale in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'criteria_id' => 'required|exists:tes_kemampuan_criteria,criteria_id',
            'rating_level' => 'required|integer|min:1|max:5',
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'min_score' => 'required|integer|min:0|max:100',
            'max_score' => 'required|integer|min:0|max:100|gte:min_score',
        ]);

        // Generate a unique ID for the rating scale
        $id = 'TES_RATE_' . $request->criteria_id . '_' . Str::random(5);

        // Create new rating scale
        TesKemampuanRatingScale::create([
            'id' => $id,
            'criteria_id' => $request->criteria_id,
            'rating_level' => $request->rating_level,
            'name' => $request->name,
            'description' => $request->description,
            'min_score' => $request->min_score,
            'max_score' => $request->max_score,
        ]);

        // Get the criteria to redirect back to the job details
        $criteria = TesKemampuanCriteria::findOrFail($request->criteria_id);

        return redirect()->route('jobs.show', $criteria->job_id)
            ->with('success', 'Capability test rating scale created successfully.');
    }

    /**
     * Display the specified rating scale.
     */
    public function show(string $id)
    {
        $ratingScale = TesKemampuanRatingScale::with('criteria')->findOrFail($id);
        return view('tes-kemampuan-rating-scales.show', compact('ratingScale'));
    }

    /**
     * Show the form for editing the specified rating scale.
     */
    public function edit(string $id)
    {
        $ratingScale = TesKemampuanRatingScale::with('criteria')->findOrFail($id);
        return view('tes-kemampuan-rating-scales.edit', compact('ratingScale'));
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
            'min_score' => 'required|integer|min:0|max:100',
            'max_score' => 'required|integer|min:0|max:100|gte:min_score',
        ]);

        $ratingScale = TesKemampuanRatingScale::findOrFail($id);
        $ratingScale->update([
            'rating_level' => $request->rating_level,
            'name' => $request->name,
            'description' => $request->description,
            'min_score' => $request->min_score,
            'max_score' => $request->max_score,
        ]);

        // Get the criteria to redirect back to the job details
        $criteria = TesKemampuanCriteria::findOrFail($ratingScale->criteria_id);

        return redirect()->route('jobs.show', $criteria->job_id)
            ->with('success', 'Capability test rating scale updated successfully.');
    }

    /**
     * Remove the specified rating scale from storage.
     */
    public function destroy(string $id)
    {
        $ratingScale = TesKemampuanRatingScale::findOrFail($id);

        // Store the criteria ID to redirect after deletion
        $criteria = TesKemampuanCriteria::findOrFail($ratingScale->criteria_id);
        $jobId = $criteria->job_id;

        $ratingScale->delete();

        return redirect()->route('jobs.show', $jobId)
            ->with('success', 'Capability test rating scale deleted successfully.');
    }

    /**
     * Get all rating scales for a specific criteria.
     */
    public function getByCriteria(string $criteriaId)
    {
        $ratingScales = TesKemampuanRatingScale::where('criteria_id', $criteriaId)
            ->orderBy('rating_level')
            ->get();

        return response()->json($ratingScales);
    }
}
