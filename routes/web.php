<?php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Models\Livestock;
use App\Models\Crop;
use Illuminate\Support\Facades\Route;
use App\Models\Farm;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\LivestockController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SaleController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');
Route::resource('farms', FarmController::class);


Route::resource('crops', CropController::class)->except(['show']);


Route::resource('livestock', LivestockController::class)->except(['show']);


Route::resource('expenses', ExpenseController::class)->except(['show']);


Route::resource('sales', SaleController::class)->except(['show']);


Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');


Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])
    ->name('reports.exportPdf');