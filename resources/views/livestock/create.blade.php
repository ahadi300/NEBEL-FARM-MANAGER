@extends('layouts.app')

@section('title', 'Register Livestock | Nebel Farm Manager')
@section('page-title', 'Register New Livestock')

@section('content')

<div class="row">
    <div class="col-md-10">

        <div class="card card-success">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cow"></i>
                    Livestock Information
                </h3>
            </div>

            <form action="{{ route('livestock.store') }}" method="POST">

                @csrf

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
                            <option value="">-- Select Farm --</option>

                            @foreach($farms as $farm)
                                <option value="{{ $farm->id }}"
                                    {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                                    {{ $farm->farm_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Animal Type *</label>

                            <select name="animal_type" class="form-control" required>
                                <option value="">-- Select Animal --</option>
                                <option value="Cattle" {{ old('animal_type') == 'Cattle' ? 'selected' : '' }}>Cattle</option>
                                <option value="Goats" {{ old('animal_type') == 'Goats' ? 'selected' : '' }}>Goats</option>
                                <option value="Sheep" {{ old('animal_type') == 'Sheep' ? 'selected' : '' }}>Sheep</option>
                                <option value="Poultry" {{ old('animal_type') == 'Poultry' ? 'selected' : '' }}>Poultry</option>
                                <option value="Pigs" {{ old('animal_type') == 'Pigs' ? 'selected' : '' }}>Pigs</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Breed</label>

                            <input type="text"
                                   name="breed"
                                   class="form-control"
                                   value="{{ old('breed') }}"
                                   placeholder="e.g. Friesian, Boer, Sasso">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Quantity *</label>

                        <input type="number"
                               name="quantity"
                               class="form-control"
                               value="{{ old('quantity') }}"
                               min="1"
                               required
                               placeholder="Enter number of animals">
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Purchase Date</label>

                            <input type="date"
                                   name="purchase_date"
                                   class="form-control"
                                   value="{{ old('purchase_date') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Purchase Cost (TZS)</label>

                            <input type="number"
                                   name="purchase_cost"
                                   class="form-control"
                                   value="{{ old('purchase_cost') }}"
                                   min="0"
                                   step="0.01"
                                   placeholder="e.g. 1500000">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Health Status *</label>

                        <select name="health_status" class="form-control" required>
                            <option value="healthy" {{ old('health_status', 'healthy') == 'healthy' ? 'selected' : '' }}>
                                Healthy
                            </option>

                            <option value="sick" {{ old('health_status') == 'sick' ? 'selected' : '' }}>
                                Sick
                            </option>

                            <option value="under_treatment" {{ old('health_status') == 'under_treatment' ? 'selected' : '' }}>
                                Under Treatment
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Additional Notes</label>

                        <textarea name="notes"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Additional livestock information">{{ old('notes') }}</textarea>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i>
                        Save Livestock
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