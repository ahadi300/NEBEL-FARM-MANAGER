<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\Farm;
use Illuminate\Http\Request;

class LivestockController extends Controller
{
    // Display all livestock
    public function index()
    {
        $livestocks = Livestock::with('farm')
            ->latest()
            ->paginate(10);

        return view('livestock.index', compact('livestocks'));
    }

    // Show registration form
    public function create()
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('livestock.create', compact('farms'));
    }

    // Save livestock
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'animal_type' => 'required|in:Cattle,Goats,Sheep,Poultry,Pigs',
            'breed' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric|min:0',
            'health_status' => 'required|in:healthy,sick,under_treatment',
            'notes' => 'nullable|string|max:2000',
        ]);

        Livestock::create($validated);

        return redirect()
            ->route('livestock.index')
            ->with('success', 'Livestock registered successfully.');
    }

    // Show edit form
    public function edit(Livestock $livestock)
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('livestock.edit', compact('livestock', 'farms'));
    }

    // Update livestock
    public function update(Request $request, Livestock $livestock)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'animal_type' => 'required|in:Cattle,Goats,Sheep,Poultry,Pigs',
            'breed' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric|min:0',
            'health_status' => 'required|in:healthy,sick,under_treatment',
            'notes' => 'nullable|string|max:2000',
        ]);

        $livestock->update($validated);

        return redirect()
            ->route('livestock.index')
            ->with('success', 'Livestock updated successfully.');
    }

    // Delete livestock
    public function destroy(Livestock $livestock)
    {
        $livestock->delete();

        return redirect()
            ->route('livestock.index')
            ->with('success', 'Livestock deleted successfully.');
    }
}