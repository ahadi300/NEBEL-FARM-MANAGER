<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>NEBEL FARM MANAGER REPORT</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #198754;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #198754;
            margin-bottom: 5px;
        }

        h3 {
            color: #198754;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #e8f5e9;
        }

        .summary {
            width: 100%;
            margin-bottom: 20px;
        }

        .summary td {
            font-weight: bold;
            padding: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>

<div class="header">

    <img src="{{ public_path('images/nebel-logo.png') }}"
     style="width: 180px; height: auto; margin-bottom: 10px;">
    <h2>FARM MANAGEMENT REPORT</h2>

    <p>Generated: {{ now()->format('d M Y H:i') }}</p>

</div>

<p>
    <strong>Start Date:</strong>
    {{ $startDate ?: 'All Dates' }}
    &nbsp;&nbsp;
    <strong>End Date:</strong>
    {{ $endDate ?: 'All Dates' }}
</p>

<h3>FINANCIAL SUMMARY</h3>

<table class="summary">
    <tr>
        <td>Total Sales</td>
        <td>TZS {{ number_format($totalSales, 2) }}</td>
        <td>Total Expenses</td>
        <td>TZS {{ number_format($totalExpenses, 2) }}</td>
        <td>Net Profit</td>
        <td>TZS {{ number_format($netProfit, 2) }}</td>
    </tr>
</table>

<h3>1. FARM RECORDS</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Farm Name</th>
            <th>Owner</th>
            <th>Location</th>
            <th>Size</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @forelse($farms as $farm)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $farm->farm_name }}</td>
                <td>{{ $farm->owner_name }}</td>
                <td>{{ $farm->location }}</td>
                <td>{{ $farm->size }} {{ $farm->size_unit }}</td>
                <td>{{ $farm->phone }}</td>
            </tr>
        @empty
            <tr><td colspan="6">No farm records found.</td></tr>
        @endforelse
    </tbody>
</table>

<h3>2. CROP RECORDS</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Farm</th>
            <th>Crop</th>
            <th>Season</th>
            <th>Area</th>
            <th>Planting Date</th>
            <th>Expected Harvest</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($crops as $crop)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $crop->farm->farm_name ?? 'N/A' }}</td>
                <td>{{ $crop->crop_name }}</td>
                <td>{{ $crop->season }}</td>
                <td>{{ $crop->area_planted }} {{ $crop->area_unit }}</td>
                <td>{{ $crop->planting_date }}</td>
                <td>{{ $crop->expected_harvest_date }}</td>
                <td>{{ $crop->status }}</td>
            </tr>
        @empty
            <tr><td colspan="8">No crop records found.</td></tr>
        @endforelse
    </tbody>
</table>

<h3>3. LIVESTOCK RECORDS</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Farm</th>
            <th>Animal Type</th>
            <th>Breed</th>
            <th>Quantity</th>
            <th>Purchase Cost (TZS)</th>
            <th>Health Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($livestock as $animal)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $animal->farm->farm_name ?? 'N/A' }}</td>
                <td>{{ $animal->animal_type }}</td>
                <td>{{ $animal->breed }}</td>
                <td>{{ $animal->quantity }}</td>
                <td>{{ number_format($animal->purchase_cost ?? 0, 2) }}</td>
                <td>{{ $animal->health_status }}</td>
            </tr>
        @empty
            <tr><td colspan="7">No livestock records found.</td></tr>
        @endforelse
    </tbody>
</table>

<h3>4. EXPENSE RECORDS</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Farm</th>
            <th>Category</th>
            <th>Description</th>
            <th>Amount (TZS)</th>
            <th>Date</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        @forelse($expenses as $expense)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $expense->farm->farm_name ?? 'N/A' }}</td>
                <td>{{ $expense->category }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ number_format($expense->amount, 2) }}</td>
                <td>{{ $expense->expense_date }}</td>
                <td>{{ $expense->payment_method }}</td>
            </tr>
        @empty
            <tr><td colspan="7">No expense records found.</td></tr>
        @endforelse
    </tbody>
</table>

<h3>5. SALES RECORDS</h3>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Farm</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit Price (TZS)</th>
            <th>Total (TZS)</th>
            <th>Buyer</th>
            <th>Sale Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sales as $sale)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sale->farm->farm_name ?? 'N/A' }}</td>
                <td>{{ $sale->product_name }}</td>
                <td>{{ $sale->quantity }} {{ $sale->unit }}</td>
                <td>{{ number_format($sale->unit_price, 2) }}</td>
                <td>{{ number_format($sale->total_amount, 2) }}</td>
                <td>{{ $sale->buyer_name }}</td>
                <td>{{ $sale->sale_date }}</td>
            </tr>
        @empty
            <tr><td colspan="8">No sales records found.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    <strong>NEBEL FARM MANAGER</strong><br>
    Discover Smart Solutions
</div>

</body>
</html>