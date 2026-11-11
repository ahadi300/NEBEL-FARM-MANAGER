
@extends('layouts.app')

@section('title', 'Farm Expenses')

@section('page-title', 'Farm Expenses')

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card card-success card-outline">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-wallet mr-2"></i>
                    Expense Records
                </h3>

                <div class="card-tools">
                    <a href="{{ route('expenses.create') }}"
                       class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                        Add New Expense
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
                                <th>Category</th>
                                <th>Description</th>
                                <th>Amount (TZS)</th>
                                <th>Expense Date</th>
                                <th>Payment Method</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($expenses as $expense)

                                <tr>
                                    <td>{{ $loop->iteration + ($expenses->currentPage() - 1) * $expenses->perPage() }}</td>

                                    <td>
                                        {{ $expense->farm->farm_name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $expense->category }}
                                    </td>

                                    <td>
                                        {{ $expense->description ?? '-' }}
                                    </td>

                                    <td>
                                        {{ number_format($expense->amount, 2) }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}
                                    </td>

                                    <td>
                                        {{ $expense->payment_method ?? '-' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('expenses.edit', $expense->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('expenses.destroy', $expense->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this expense?')">

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
                                    <td colspan="8" class="text-center">
                                        No expense records found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $expenses->links() }}
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
