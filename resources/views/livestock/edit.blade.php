@extends('layouts.app')

@section('title', 'Edit Livestock | Nebel Farm Manager')
@section('page-title', 'Edit Livestock Information')

@section('content')

<div class="row">
    <div class="col-md-10">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    Update Livestock Information
                </h3>
            </div>

            <form action="{{ route('livestock.update', $livestock->id) }}" method="POST">

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
                                    {{ old('farm_id', $livestock->farm_id) == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->farm_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Animal Type *</label>

                            <select name="animal_type" class="form-control" required>
                                @foreach(['Cattle', 'Goats', 'Sheep', 'Poultry', 'Pigs'] as $animal)
                                    <option value="{{ $animal }}"
                                        {{ old('animal_type', $livestock->animal_type) == $animal ? 'selected' : '' }}>
                                        {{ $animal }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Breed</label>

                            <input type="text"
                                   name="breed"
                                   class="form-control"
                                   value="{{ old('breed', $livestock->breed) }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Quantity *</label>

                        <input type="number"
                               name="quantity"
                               class="form-control"
                               value="{{ old('quantity', $livestock->quantity) }}"
                               min="1"
                               required>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Purchase Date</label>

                            <input type="date"
                                   name="purchase_date"
                                   class="form-control"
                                   value="{{ old('purchase_date', $livestock->purchase_date) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Purchase Cost (TZS)</label>

                            <input type="number"
                                   name="purchase_cost"
                                   class="form-control"
                                   value="{{ old('purchase_cost', $livestock->purchase_cost) }}"
                                   min="0"
                                   step="0.01">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Health Status *</label>

                        <select name="health_status" class="form-control" required>

                            <option value="healthy"
                                {{ old('health_status', $livestock->health_status) == 'healthy' ? 'selected' : '' }}>
                                Healthy
                            </option>

                            <option value="sick"
                                {{ old('health_status', $livestock->health_status) == 'sick' ? 'selected' : '' }}>
                                Sick
                            </option>

                            <option value="under_treatment"
                                {{ old('health_status', $livestock->health_status) == 'under_treatment' ? 'selected' : '' }}>
                                Under Treatment
                            </option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>

                        <textarea name="notes"
                                  class="form-control"
                                  rows="3">{{ old('notes', $livestock->notes) }}</textarea>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Livestock
                    </button>

                    <a href="{{ route('livestock.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection