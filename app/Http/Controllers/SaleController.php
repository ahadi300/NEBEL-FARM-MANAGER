<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Farm;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    // Display all sales
    public function index()
    {
        $sales = Sale::with('farm')
            ->latest()
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    // Show sales registration form
    public function create()
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('sales.create', compact('farms'));
    }

    // Save new sale
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'product_type' => 'required|in:Crop,Livestock,Other',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|in:kg,tonnes,bags,animals,litres,pieces',
            'unit_price' => 'required|numeric|min:0.01',
            'buyer_name' => 'nullable|string|max:255',
            'buyer_phone' => 'nullable|string|max:30',
            'sale_date' => 'required|date',
            'notes' => 'nullable|string|max:2000',
        ]);

        // Calculate total amount automatically
        $validated['total_amount'] =
            $validated['quantity'] * $validated['unit_price'];

        Sale::create($validated);

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale recorded successfully.');
    }

    // Edit sale
    public function edit(Sale $sale)
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('sales.edit', compact('sale', 'farms'));
    }

    // Update sale
    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'product_type' => 'required|in:Crop,Livestock,Other',
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0.01',
            'unit' => 'required|in:kg,tonnes,bags,animals,litres,pieces',
            'unit_price' => 'required|numeric|min:0.01',
            'buyer_name' => 'nullable|string|max:255',
            'buyer_phone' => 'nullable|string|max:30',
            'sale_date' => 'required|date',
            'notes' => 'nullable|string|max:2000',
        ]);

        // Recalculate total amount when updating
        $validated['total_amount'] =
            $validated['quantity'] * $validated['unit_price'];

        $sale->update($validated);

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale updated successfully.');
    }

    // Delete sale
    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
}
