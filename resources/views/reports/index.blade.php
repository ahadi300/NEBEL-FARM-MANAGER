
@extends('layouts.app')

@push('styles')
<style>
    @media print {
        .main-sidebar,
        .main-header,
        .main-footer,
        .content-header,
        .no-print {
            display: none !important;
        }

        .content-wrapper {
            margin-left: 0 !important;
            min-height: auto !important;
        }

        .content {
            padding: 0 !important;
        }

        body {
            background: white !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            page-break-inside: avoid;
        }

        .table {
            font-size: 11px;
            width: 100%;
        }

        .card-header {
            background: white !important;
            color: black !important;
        }

        button,
        a.btn,
        form {
            display: none !important;
        }

        @page {
            size: landscape;
            margin: 10mm;
        }
    }
</style>
@endpush

@section('title', 'Reports Management')
@section('page-title', 'Reports Management')

@section('content')

{{-- Print Button --}}
<div class="row mb-3 no-print">
    <form action="{{ route('reports.exportPdf') }}" method="GET" class="d-inline">
    <input type="hidden" name="farm_id" value="{{ $farmId }}">
    <input type="hidden" name="start_date" value="{{ $startDate }}">
    <input type="hidden" name="end_date" value="{{ $endDate }}">

    <button type="submit" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Export PDF
    </button>
</form>
    <div class="col-md-12 text-right">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Print Report
        </button>
    </div>
</div>

{{-- Financial Summary --}}
<div class="row">

    <div class="col-lg-4 col-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>TZS {{ number_format($totalExpenses, 2) }}</h3>
                <p>Total Expenses</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>TZS {{ number_format($totalSales, 2) }}</h3>
                <p>Total Sales</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box {{ $netProfit >= 0 ? 'bg-info' : 'bg-warning' }}">
            <div class="inner">
                <h3>TZS {{ number_format($netProfit, 2) }}</h3>
                <p>Net Profit / Loss</p>
            </div>
            <div class="icon">
                <i class="fas fa-calculator"></i>
            </div>
        </div>
    </div>

</div>

{{-- Report Filters --}}
<div class="card card-primary no-print">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-filter"></i> Report Filters
        </h3>
    </div>

    <form action="{{ route('reports.index') }}" method="GET">
        <div class="card-body">
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Farm</label>

                        <select name="farm_id" class="form-control">
                            <option value="">All Farms</option>

                            @foreach($allFarms as $farm)
                                <option value="{{ $farm->id }}"
                                    {{ $farmId == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->farm_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Start Date</label>

                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ $startDate }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>End Date</label>

                        <input type="date"
                               name="end_date"
                               class="form-control"
                               value="{{ $endDate }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>&nbsp;</label>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer">
            <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-sync"></i> Reset Filters
            </a>
        </div>
    </form>
</div>

{{-- Farm Report --}}
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-tractor"></i> Farm Report
        </h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Farm Name</th>
                    <th>Owner</th>
                    <th>Location</th>
                    <th>Size</th>
                </tr>
            </thead>

            <tbody>
                @forelse($farms as $farm)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $farm->farm_name }}</td>
                        <td>{{ $farm->owner_name }}</td>
                        <td>{{ $farm->location }}</td>
                        <td>
                            {{ number_format($farm->size, 2) }}
                            {{ $farm->size_unit }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No farm records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Crop Report --}}
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-seedling"></i> Crop Report
        </h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Crop</th>
                    <th>Farm</th>
                    <th>Area</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($crops as $crop)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $crop->crop_name }}</td>
                        <td>{{ $crop->farm->farm_name ?? 'N/A' }}</td>
                        <td>
                            {{ number_format($crop->area_planted, 2) }}
                            {{ $crop->area_unit }}
                        </td>
                        <td>{{ ucfirst($crop->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No crop records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Livestock Report --}}
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-cow"></i> Livestock Report
        </h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Animal</th>
                    <th>Farm</th>
                    <th>Breed</th>
                    <th>Quantity</th>
                    <th>Health Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($livestock as $animal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $animal->animal_type }}</td>
                        <td>{{ $animal->farm->farm_name ?? 'N/A' }}</td>
                        <td>{{ $animal->breed ?? 'N/A' }}</td>
                        <td>{{ number_format($animal->quantity) }}</td>
                        <td>
                            {{ ucfirst(str_replace('_', ' ', $animal->health_status)) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No livestock records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Expenses Report --}}
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-wallet"></i> Expenses Report
        </h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Farm</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($expenses as $expense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $expense->farm->farm_name ?? 'N/A' }}</td>
                        <td>{{ $expense->category }}</td>
                        <td>{{ $expense->description ?? 'N/A' }}</td>
                        <td>TZS {{ number_format($expense->amount, 2) }}</td>
                        <td>{{ $expense->expense_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No expense records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Sales Report --}}
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-shopping-cart"></i> Sales Report
        </h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Farm</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Buyer</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sale->farm->farm_name ?? 'N/A' }}</td>
                        <td>{{ $sale->product_name }}</td>
                        <td>
                            {{ number_format($sale->quantity, 2) }}
                            {{ $sale->unit }}
                        </td>
                        <td>{{ $sale->buyer_name ?? 'N/A' }}</td>
                        <td>TZS {{ number_format($sale->total_amount, 2) }}</td>
                        <td>{{ $sale->sale_date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            No sales records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
