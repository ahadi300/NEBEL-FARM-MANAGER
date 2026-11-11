
@extends('layouts.app')

@section('title', 'Farm Sales')

@section('page-title', 'Farm Sales Management')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card card-primary card-outline">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Sales Records
                </h3>

                <div class="card-tools">
                    <a href="{{ route('sales.create') }}"
                       class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>
                        Record New Sale

                    </a>
                </div>

            </div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Farm</th>
                                <th>Product Type</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price (TZS)</th>
                                <th>Total Amount (TZS)</th>
                                <th>Buyer</th>
                                <th>Sale Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($sales as $sale)

                                <tr>

                                    <td>
                                        {{ $loop->iteration + ($sales->currentPage() - 1) * $sales->perPage() }}
                                    </td>

                                    <td>
                                        {{ $sale->farm->farm_name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        <span class="badge badge-info">
                                            {{ $sale->product_type }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $sale->product_name }}
                                    </td>

                                    <td>
                                        {{ number_format($sale->quantity, 2) }}
                                        {{ $sale->unit }}
                                    </td>

                                    <td>
                                        {{ number_format($sale->unit_price, 2) }}
                                    </td>

                                    <td class="font-weight-bold text-success">
                                        {{ number_format($sale->total_amount, 2) }}
                                    </td>

                                    <td>
                                        {{ $sale->buyer_name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}
                                    </td>

                                    <td>

                                        <a href="{{ route('sales.edit', $sale->id) }}"
                                           class="btn btn-primary btn-sm">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('sales.destroy', $sale->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this sale?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="10" class="text-center">
                                        No sales records found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $sales->links() }}
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
