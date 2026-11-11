
@extends('layouts.app')

@section('title', 'Edit Crop | Nebel Farm Manager')

@section('page-title', 'Edit Crop Information')

@section('content')

<div class="row">
    <div class="col-md-10">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Update Crop Information
                </h3>
            </div>

            <form action="{{ route('crops.update', $crop->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please correct these errors:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Select Farm *</label>
                        <select name="farm_id" class="form-control" required>
                            @foreach($farms as $farm)
                                <option value="{{ $farm->id }}"
                                    {{ old('farm_id', $crop->farm_id) == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->farm_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Crop Name *</label>
                        <input type="text"
                               name="crop_name"
                               class="form-control"
                               value="{{ old('crop_name', $crop->crop_name) }}"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Growing Season</label>
                        <input type="text"
                               name="season"
                               class="form-control"
                               value="{{ old('season', $crop->season) }}">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Area Planted *</label>
                            <input type="number"
                                   name="area_planted"
                                   class="form-control"
                                   value="{{ old('area_planted', $crop->area_planted) }}"
                                   min="0.01"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Area Unit *</label>
                            <select name="area_unit" class="form-control" required>
                                <option value="acres"
                                    {{ old('area_unit', $crop->area_unit) == 'acres' ? 'selected' : '' }}>
                                    Acres
                                </option>

                                <option value="hectares"
                                    {{ old('area_unit', $crop->area_unit) == 'hectares' ? 'selected' : '' }}>
                                    Hectares
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Planting Date</label>
                            <input type="date"
                                   name="planting_date"
                                   class="form-control"
                                   value="{{ old('planting_date', $crop->planting_date) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Expected Harvest Date</label>
                            <input type="date"
                                   name="expected_harvest_date"
                                   class="form-control"
                                   value="{{ old('expected_harvest_date', $crop->expected_harvest_date) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Crop Status *</label>
                        <select name="status" class="form-control" required>
                            <option value="planned"
                                {{ old('status', $crop->status) == 'planned' ? 'selected' : '' }}>
                                Planned
                            </option>

                            <option value="growing"
                                {{ old('status', $crop->status) == 'growing' ? 'selected' : '' }}>
                                Growing
                            </option>

                            <option value="harvested"
                                {{ old('status', $crop->status) == 'harvested' ? 'selected' : '' }}>
                                Harvested
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>
                        <textarea name="notes"
                                  class="form-control"
                                  rows="3">{{ old('notes', $crop->notes) }}</textarea>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Crop
                    </button>

                    <a href="{{ route('crops.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
