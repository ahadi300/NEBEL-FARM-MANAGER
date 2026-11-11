<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Crop;
use App\Models\Livestock;
use App\Models\Expense;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Display Reports
    public function index(Request $request)
    {
        // Date filters
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Farm filter
        $farmId = $request->farm_id;

        // Farm Report
        $farmsQuery = Farm::query();

        if ($farmId) {
            $farmsQuery->where('id', $farmId);
        }

        $farms = $farmsQuery->latest()->get();

        // Crop Report
        $cropsQuery = Crop::with('farm');

        if ($farmId) {
            $cropsQuery->where('farm_id', $farmId);
        }

        if ($startDate) {
            $cropsQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $cropsQuery->whereDate('created_at', '<=', $endDate);
        }

        $crops = $cropsQuery->latest()->get();

        // Livestock Report
        $livestockQuery = Livestock::with('farm');

        if ($farmId) {
            $livestockQuery->where('farm_id', $farmId);
        }

        $livestock = $livestockQuery->latest()->get();

        // Expenses Report
        $expensesQuery = Expense::with('farm');

        if ($farmId) {
            $expensesQuery->where('farm_id', $farmId);
        }

        if ($startDate) {
            $expensesQuery->whereDate('expense_date', '>=', $startDate);
        }

        if ($endDate) {
            $expensesQuery->whereDate('expense_date', '<=', $endDate);
        }

        $expenses = $expensesQuery->latest()->get();

        // Sales Report
        $salesQuery = Sale::with('farm');

        if ($farmId) {
            $salesQuery->where('farm_id', $farmId);
        }

        if ($startDate) {
            $salesQuery->whereDate('sale_date', '>=', $startDate);
        }

        if ($endDate) {
            $salesQuery->whereDate('sale_date', '<=', $endDate);
        }

        $sales = $salesQuery->latest()->get();

        // Financial Summary
        $totalExpenses = $expenses->sum('amount');
        $totalSales = $sales->sum('total_amount');
        $netProfit = $totalSales - $totalExpenses;

        // Dropdown data
        $allFarms = Farm::orderBy('farm_name')->get();

        return view('reports.index', compact(
            'farms',
            'crops',
            'livestock',
            'expenses',
            'sales',
            'totalExpenses',
            'totalSales',
            'netProfit',
            'allFarms',
            'startDate',
            'endDate',
            'farmId'
        ));
    }

    // Export Reports as PDF
    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $farmId = $request->farm_id;

        // Farm Report
        $farmsQuery = Farm::query();

        if ($farmId) {
            $farmsQuery->where('id', $farmId);
        }

        $farms = $farmsQuery->latest()->get();

        // Crop Report
        $cropsQuery = Crop::with('farm');

        if ($farmId) {
            $cropsQuery->where('farm_id', $farmId);
        }

        if ($startDate) {
            $cropsQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $cropsQuery->whereDate('created_at', '<=', $endDate);
        }

        $crops = $cropsQuery->latest()->get();

        // Livestock Report
        $livestockQuery = Livestock::with('farm');

        if ($farmId) {
            $livestockQuery->where('farm_id', $farmId);
        }

        $livestock = $livestockQuery->latest()->get();

        // Expenses Report
        $expensesQuery = Expense::with('farm');

        if ($farmId) {
            $expensesQuery->where('farm_id', $farmId);
        }

        if ($startDate) {
            $expensesQuery->whereDate('expense_date', '>=', $startDate);
        }

        if ($endDate) {
            $expensesQuery->whereDate('expense_date', '<=', $endDate);
        }

        $expenses = $expensesQuery->latest()->get();

        // Sales Report
        $salesQuery = Sale::with('farm');

        if ($farmId) {
            $salesQuery->where('farm_id', $farmId);
        }

        if ($startDate) {
            $salesQuery->whereDate('sale_date', '>=', $startDate);
        }

        if ($endDate) {
            $salesQuery->whereDate('sale_date', '<=', $endDate);
        }

        $sales = $salesQuery->latest()->get();

        // Financial Summary
        $totalExpenses = $expenses->sum('amount');
        $totalSales = $sales->sum('total_amount');
        $netProfit = $totalSales - $totalExpenses;

        // Generate PDF
        $pdf = Pdf::loadView('reports.pdf', compact(
            'farms',
            'crops',
            'livestock',
            'expenses',
            'sales',
            'totalExpenses',
            'totalSales',
            'netProfit',
            'startDate',
            'endDate',
            'farmId'
        ));

        return $pdf->setPaper('a4', 'landscape')
                   ->download('nebel-farm-report.pdf');
    }
}
