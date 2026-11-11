
@extends('layouts.app')

@section('title', 'Record New Sale')
@section('page-title', 'Record New Sale')

@section('content')

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Sales Registration Form</h3>
    </div>

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Please correct the following errors:</strong>
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
                    <option value="">Select Farm</option>
                    @foreach($farms as $farm)
                        <option value="{{ $farm->id }}"
                            {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                            {{ $farm->farm_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Product Type</label>
                <select name="product_type" class="form-control" required>
                    <option value="">Select Product Type</option>
                    <option value="Crop" {{ old('product_type') == 'Crop' ? 'selected' : '' }}>Crop</option>
                    <option value="Livestock" {{ old('product_type') == 'Livestock' ? 'selected' : '' }}>Livestock</option>
                    <option value="Other" {{ old('product_type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name"
                       class="form-control"
                       value="{{ old('product_name') }}"
                       placeholder="e.g. Maize, Beans, Cattle"
                       required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" step="0.01" min="0.01"
                               name="quantity" class="form-control"
                               value="{{ old('quantity') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit" class="form-control" required>
                            @foreach(['kg', 'tonnes', 'bags', 'animals', 'litres', 'pieces'] as $unit)
                                <option value="{{ $unit }}"
                                    {{ old('unit', 'kg') == $unit ? 'selected' : '' }}>
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
                       value="{{ old('unit_price') }}"
                       placeholder="Enter price per unit" required>
            </div>

            <hr>
            <h5>Buyer Information</h5>

            <div class="form-group">
                <label>Buyer Name</label>
                <input type="text" name="buyer_name"
                       class="form-control"
                       value="{{ old('buyer_name') }}">
            </div>

            <div class="form-group">
                <label>Buyer Phone</label>
                <input type="text" name="buyer_phone"
                       class="form-control"
                       value="{{ old('buyer_phone') }}">
            </div>

            <div class="form-group">
                <label>Sale Date</label>
                <input type="date" name="sale_date"
                       class="form-control"
                       value="{{ old('sale_date', date('Y-m-d')) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Additional Notes</label>
                <textarea name="notes" class="form-control"
                          rows="3">{{ old('notes') }}</textarea>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Save Sale
            </button>

            <a href="{{ route('sales.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </form>
</div>

@endsection
