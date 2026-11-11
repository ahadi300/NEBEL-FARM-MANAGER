<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Crop;
use App\Models\Livestock;
use App\Models\Expense;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        // Farm Statistics
        $totalFarms = Farm::count();
        $totalAcres = Farm::where('size_unit', 'acres')->sum('size');
        $totalHectares = Farm::where('size_unit', 'hectares')->sum('size');
        $recentFarms = Farm::latest()->take(5)->get();

        // Crop Statistics
        $totalCropRecords = Crop::count();

        // Livestock Statistics
        $totalLivestockRecords = Livestock::count();
        $totalAnimals = Livestock::sum('quantity');

        $healthyAnimals = Livestock::where('health_status', 'healthy')->sum('quantity');
        $sickAnimals = Livestock::where('health_status', 'sick')->sum('quantity');
        $animalsUnderTreatment = Livestock::where('health_status', 'under_treatment')->sum('quantity');

        // Financial Statistics
        $totalExpenses = Expense::sum('amount');
        $totalSales = Sale::sum('total_amount');
        $netProfit = $totalSales - $totalExpenses;

        return view('dashboard', compact(
            'totalFarms',
            'totalAcres',
            'totalHectares',
            'recentFarms',
            'totalCropRecords',
            'totalLivestockRecords',
            'totalAnimals',
            'healthyAnimals',
            'sickAnimals',
            'animalsUnderTreatment',
            'totalExpenses',
            'totalSales',
            'netProfit'
        ));
    }
}
