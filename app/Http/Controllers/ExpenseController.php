<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Farm;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // Display all expenses
    public function index()
    {
        $expenses = Expense::with('farm')
            ->latest()
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    // Show expense registration form
    public function create()
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('expenses.create', compact('farms'));
    }

    // Save new expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'category' => 'required|in:Seeds,Fertilizer,Pesticides,Labour,Transport,Animal Feed,Veterinary,Equipment,Other',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|in:Cash,Mobile Money,Bank Transfer,Other',
            'notes' => 'nullable|string|max:2000',
        ]);

        Expense::create($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense recorded successfully.');
    }

    // Edit expense
    public function edit(Expense $expense)
    {
        $farms = Farm::orderBy('farm_name')->get();

        return view('expenses.edit', compact('expense', 'farms'));
    }

    // Update expense
    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'category' => 'required|in:Seeds,Fertilizer,Pesticides,Labour,Transport,Animal Feed,Veterinary,Equipment,Other',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'payment_method' => 'nullable|in:Cash,Mobile Money,Bank Transfer,Other',
            'notes' => 'nullable|string|max:2000',
        ]);

        $expense->update($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    // Delete expense
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }
}
