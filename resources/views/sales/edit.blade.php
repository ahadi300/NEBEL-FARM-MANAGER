
@extends('layouts.app')

@section('title', 'Edit Sale')
@section('page-title', 'Edit Sale')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Update Sales Information</h3>
    </div>

    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Farm</label>
                <select name="farm_id" class="form-control" required>
                    @foreach($farms as $farm)
                        <option value="{{ $farm->id }}"
                            {{ old('farm_id', $sale->farm_id) == $farm->id ? 'selected' : '' }}>
                            {{ $farm->farm_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Type</label>
                <select name="product_type" class="form-control" required>
                    @foreach(['Crop', 'Livestock', 'Other'] as $type)
                        <option value="{{ $type }}"
                            {{ old('product_type', $sale->product_type) == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name"
                       class="form-control"
                       value="{{ old('product_name', $sale->product_name) }}"
                       required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" step="0.01" min="0.01"
                               name="quantity" class="form-control"
                               value="{{ old('quantity', $sale->quantity) }}"
                               required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit" class="form-control" required>
                            @foreach(['kg', 'tonnes', 'bags', 'animals', 'litres', 'pieces'] as $unit)
                                <option value="{{ $unit }}"
                                    {{ old('unit', $sale->unit) == $unit ? 'selected' : '' }}>
                                    {{ ucfirst($unit) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Unit Price (TZS)</label>
                <input type="number" step="0.01" min="0.01"
                       name="unit_price" class="form-control"
                       value="{{ old('unit_price', $sale->unit_price) }}"
                       required>
            </div>

            <hr>
            <h5>Buyer Information</h5>

            <div class="form-group">
                <label>Buyer Name</label>
                <input type="text" name="buyer_name"
                       class="form-control"
                       value="{{ old('buyer_name', $sale->buyer_name) }}">
            </div>

            <div class="form-group">
                <label>Buyer Phone</label>
                <input type="text" name="buyer_phone"
                       class="form-control"
                       value="{{ old('buyer_phone', $sale->buyer_phone) }}">
            </div>

            <div class="form-group">
                <label>Sale Date</label>
                <input type="date" name="sale_date"
                       class="form-control"
                       value="{{ old('sale_date', $sale->sale_date) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Additional Notes</label>
                <textarea name="notes" class="form-control"
                          rows="3">{{ old('notes', $sale->notes) }}</textarea>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Sale
            </button>

            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
