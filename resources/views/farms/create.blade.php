
@extends('layouts.app')

@section('title', 'Register Farm')
@section('page-title', 'Register New Farm')

@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Farm Information</h3>
            </div>

            <form action="{{ route('farms.store') }}" method="POST">
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
                        <label for="farm_name">Farm Name *</label>
                        <input type="text" name="farm_name" id="farm_name"
                            class="form-control @error('farm_name') is-invalid @enderror"
                            value="{{ old('farm_name') }}"
                            placeholder="e.g. Green Valley Farm" required>
                        @error('farm_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="owner_name">Owner Name *</label>
                        <input type="text" name="owner_name" id="owner_name"
                            class="form-control"
                            value="{{ old('owner_name') }}"
                            placeholder="Enter farm owner's full name" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Farm Location *</label>
                        <input type="text" name="location" id="location"
                            class="form-control"
                            value="{{ old('location') }}"
                            placeholder="e.g. Mbeya, Tanzania" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="size">Farm Size *</label>
                            <input type="number" name="size" id="size"
                                class="form-control" min="0.01"
                                step="0.01" value="{{ old('size') }}"
                                placeholder="Enter farm size" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="size_unit">Measurement Unit *</label>
                            <select name="size_unit" id="size_unit"
                                class="form-control" required>
                                <option value="acres"
                                    {{ old('size_unit', 'acres') == 'acres' ? 'selected' : '' }}>
                                    Acres
                                </option>
                                <option value="hectares"
                                    {{ old('size_unit') == 'hectares' ? 'selected' : '' }}>
                                    Hectares
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone"
                            class="form-control"
                            value="{{ old('phone') }}"
                            placeholder="e.g. +255 7XX XXX XXX">
                    </div>

                    <div class="form-group">
                        <label for="notes">Additional Notes</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="form-control"
                            placeholder="Optional farm details">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Save Farm
                    </button>

                    <a href="{{ route('farms.index') }}"
                        class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
