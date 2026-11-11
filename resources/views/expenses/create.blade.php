
@extends('layouts.app')

@section('title', 'Add Farm Expense')

@section('page-title', 'Register Farm Expense')

@section('content')

<div class="row">
    <div class="col-md-10">

        <div class="card card-success card-outline">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-wallet mr-2"></i>
                    Expense Registration Form
                </h3>
            </div>

            <form action="{{ route('expenses.store') }}" method="POST">

                @csrf

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please correct the following errors:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Select Farm</label>
                        <select name="farm_id" class="form-control" required>
                            <option value="">-- Select Farm --</option>

                            @foreach($farms as $farm)
                                <option value="{{ $farm->id }}"
                                    {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->farm_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Expense Category</label>
                        <select name="category" class="form-control" required>
                            <option value="">-- Select Category --</option>

                            @foreach([
                                'Seeds',
                                'Fertilizer',
                                'Pesticides',
                                'Labour',
                                'Transport',
                                'Animal Feed',
                                'Veterinary',
                                'Equipment',
                                'Other'
                            ] as $category)

                                <option value="{{ $category }}"
                                    {{ old('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <input type="text"
                               name="description"
                               class="form-control"
                               value="{{ old('description') }}"
                               placeholder="Enter expense description">
                    </div>

                    <div class="form-group">
                        <label>Amount (TZS)</label>
                        <input type="number"
                               name="amount"
                               class="form-control"
                               step="0.01"
                               min="0.01"
                               value="{{ old('amount') }}"
                               placeholder="Enter amount"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Expense Date</label>
                        <input type="date"
                               name="expense_date"
                               class="form-control"
                               value="{{ old('expense_date') }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_method" class="form-control">
                            <option value="">-- Select Payment Method --</option>

                            @foreach(['Cash', 'Mobile Money', 'Bank Transfer', 'Other'] as $method)

                                <option value="{{ $method }}"
                                    {{ old('payment_method') == $method ? 'selected' : '' }}>
                                    {{ $method }}
                                </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>
                        <textarea name="notes"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Enter additional information">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Save Expense
                    </button>

                    <a href="{{ route('expenses.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection
