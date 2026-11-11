<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\Farm;
use Illuminate\Http\Request;

class CropController extends Controller
{
    public function index()
    {
        $crops = Crop::with('farm')->latest()->paginate(10);

        return view('crops.index', compact('crops'));
    }

    public function create()
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('crops.create', compact('farms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'crop_name' => 'required|string|max:255',
            'season' => 'nullable|string|max:100',
            'area_planted' => 'required|numeric|min:0.01',
            'area_unit' => 'required|in:acres,hectares',
            'planting_date' => 'nullable|date',
            'expected_harvest_date' => 'nullable|date|after_or_equal:planting_date',
            'status' => 'required|in:planned,growing,harvested',
            'notes' => 'nullable|string|max:2000',
        ]);

        Crop::create($validated);

        return redirect()
            ->route('crops.index')
            ->with('success', 'Crop registered successfully.');
    }

    public function edit(Crop $crop)
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('crops.edit', compact('crop', 'farms'));
    }

    public function update(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'crop_name' => 'required|string|max:255',
            'season' => 'nullable|string|max:100',
            'area_planted' => 'required|numeric|min:0.01',
            'area_unit' => 'required|in:acres,hectares',
            'planting_date' => 'nullable|date',
            'expected_harvest_date' => 'nullable|date|after_or_equal:planting_date',
            'status' => 'required|in:planned,growing,harvested',
            'notes' => 'nullable|string|max:2000',
        ]);

        $crop->update($validated);

        return redirect()
            ->route('crops.index')
            ->with('success', 'Crop updated successfully.');
    }

    public function destroy(Crop $crop)
    {
        $crop->delete();

        return redirect()
            ->route('crops.index')
            ->with('success', 'Crop deleted successfully.');
    }
}