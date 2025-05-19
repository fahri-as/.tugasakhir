<?php

namespace App\Http\Controllers;

use App\Models\CriteriaComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CriteriaComparisonController extends Controller
{
    public function index()
    {
        $comparisons = CriteriaComparison::with(['criteriaColumn', 'criteriaRow'])->get();
        return response()->json($comparisons);
    }

    public function store(Request $request)
    {
        $request->validate([
            'criteria_column_id' => 'required|exists:criteria,criteria_id',
            'criteria_row_id' => 'required|exists:criteria,criteria_id',
            'value' => 'required|numeric|min:0'
        ]);

        $comparison = new CriteriaComparison([
            'comparisons_id' => Str::uuid(),
            'criteria_column_id' => $request->criteria_column_id,
            'criteria_row_id' => $request->criteria_row_id,
            'value' => $request->value
        ]);

        $comparison->save();

        return response()->json($comparison, 201);
    }

    public function show($id)
    {
        $comparison = CriteriaComparison::with(['criteriaColumn', 'criteriaRow'])->findOrFail($id);
        return response()->json($comparison);
    }

    public function update(Request $request, $id)
    {
        $comparison = CriteriaComparison::findOrFail($id);

        $request->validate([
            'criteria_column_id' => 'required|exists:criteria,criteria_id',
            'criteria_row_id' => 'required|exists:criteria,criteria_id',
            'value' => 'required|numeric|min:0'
        ]);

        $comparison->update([
            'criteria_column_id' => $request->criteria_column_id,
            'criteria_row_id' => $request->criteria_row_id,
            'value' => $request->value
        ]);

        return response()->json($comparison);
    }

    public function destroy($id)
    {
        $comparison = CriteriaComparison::findOrFail($id);
        $comparison->delete();
        return response()->json(null, 204);
    }

    public function getByCriteria($criteriaId)
    {
        $comparisons = CriteriaComparison::where('criteria_column_id', $criteriaId)
            ->orWhere('criteria_row_id', $criteriaId)
            ->with(['criteriaColumn', 'criteriaRow'])
            ->get();
        return response()->json($comparisons);
    }
}