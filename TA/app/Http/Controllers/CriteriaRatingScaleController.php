<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaRatingScale;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CriteriaRatingScaleController extends Controller
{
    public function index()
    {
        $ratingScales = CriteriaRatingScale::with('criteria')->get();
        return view('criteria-rating-scales.index', compact('ratingScales'));
    }

    public function create(Request $request)
    {
        try {
            $criteriaId = $request->query('criteria_id');

            if (!$criteriaId) {
                return redirect()->route('criteria.index')
                    ->with('error', 'Criteria ID is required to create a rating scale.');
            }

            $criteria = Criteria::where('criteria_id', $criteriaId)->first();

            if (!$criteria) {
                return redirect()->route('criteria.index')
                    ->with('error', 'Selected criteria not found.');
            }

            return view('criteria-rating-scales.create', compact('criteria'));
        } catch (\Exception $e) {
            return redirect()->route('criteria.index')
                ->with('error', 'An error occurred while creating the rating scale.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'criteria_id' => 'required|exists:criteria,criteria_id',
                'rating_level' => 'required|integer|min:1|max:5',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $ratingScale = CriteriaRatingScale::create([
                'id' => Str::random(8),
                'criteria_id' => $validated['criteria_id'],
                'rating_level' => $validated['rating_level'],
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            return redirect()->route('criteria.show', $validated['criteria_id'])
                ->with('success', 'Rating scale created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while saving the rating scale.');
        }
    }

    public function show(CriteriaRatingScale $ratingScale)
    {
        try {
            return view('criteria-rating-scales.show', compact('ratingScale'));
        } catch (\Exception $e) {
            return redirect()->route('criteria.index')
                ->with('error', 'An error occurred while viewing the rating scale.');
        }
    }

    public function edit($id)
    {
        try {
            $ratingScale = CriteriaRatingScale::where('id', $id)->first();

            if (!$ratingScale) {
                return redirect()->route('criteria.index')
                    ->with('error', 'Rating scale not found.');
            }

            $criteria = Criteria::where('criteria_id', $ratingScale->criteria_id)->first();

            if (!$criteria) {
                return redirect()->route('criteria.index')
                    ->with('error', 'Associated criteria not found.');
            }

            return view('criteria-rating-scales.edit', compact('ratingScale', 'criteria'));
        } catch (\Exception $e) {
            return redirect()->route('criteria.index')
                ->with('error', 'An error occurred while editing the rating scale.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ratingScale = CriteriaRatingScale::where('id', $id)->first();

            if (!$ratingScale) {
                return redirect()->route('criteria.index')
                    ->with('error', 'Rating scale not found.');
            }

            $validated = $request->validate([
                'criteria_id' => 'required|exists:criteria,criteria_id',
                'rating_level' => 'required|integer|min:1|max:5',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $ratingScale->update($validated);

            return redirect()->route('criteria.show', $validated['criteria_id'])
                ->with('success', 'Rating scale updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while updating the rating scale.');
        }
    }

    public function destroy($id)
    {
        try {
            $ratingScale = CriteriaRatingScale::where('id', $id)->first();

            if (!$ratingScale) {
                return redirect()->route('criteria.index')
                    ->with('error', 'Rating scale not found.');
            }

            $criteriaId = $ratingScale->criteria_id;
            $ratingScale->delete();

            return redirect()->route('criteria.show', $criteriaId)
                ->with('success', 'Rating scale deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while deleting the rating scale.');
        }
    }

    public function getByCriteria($criteriaId)
    {
        try {
            $ratingScales = CriteriaRatingScale::where('criteria_id', $criteriaId)
                ->orderBy('rating_level')
                ->get();
            return response()->json($ratingScales);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching rating scales.'], 500);
        }
    }
}