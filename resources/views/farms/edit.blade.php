
@extends('layouts.app')

@section('title', 'Edit Farm')
@section('page-title', 'Edit Farm')

@section('content')

<div class="row">
    <div class="col-md-10">
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Farm Information</h3>
            </div>

            <form action="{{ route('farms.update', $farm) }}" method="POST">
                @csrf
                @method('PUT')

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
                            class="form-control"
                            value="{{ old('farm_name', $farm->farm_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="owner_name">Owner Name *</label>
                        <input type="text" name="owner_name" id="owner_name"
                            class="form-control"
                            value="{{ old('owner_name', $farm->owner_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Farm Location *</label>
                        <input type="text" name="location" id="location"
                            class="form-control"
                            value="{{ old('location', $farm->location) }}" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="size">Farm Size *</label>
                            <input type="number" name="size" id="size"
                                class="form-control" min="0.01" step="0.01"
                                value="{{ old('size', $farm->size) }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="size_unit">Measurement Unit *</label>
                            <select name="size_unit" id="size_unit"
                                class="form-control" required>

                                <option value="acres"
                                    {{ old('size_unit', $farm->size_unit) == 'acres' ? 'selected' : '' }}>
                                    Acres
                                </option>

                                <option value="hectares"
                                    {{ old('size_unit', $farm->size_unit) == 'hectares' ? 'selected' : '' }}>
                                    Hectares
                                </option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" name="phone" id="phone"
                            class="form-control"
                            value="{{ old('phone', $farm->phone) }}">
                    </div>

                    <div class="form-group">
                        <label for="notes">Additional Notes</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="form-control">{{ old('notes', $farm->notes) }}</textarea>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Farm
                    </button>

                    <a href="{{ route('farms.index') }}"
                        class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
