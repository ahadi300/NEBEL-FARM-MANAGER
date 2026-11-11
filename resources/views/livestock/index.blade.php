@extends('layouts.app')

@section('title', 'Livestock Management | Nebel Farm Manager')
@section('page-title', 'Livestock Management')

@section('content')

<div class="row">
    <div class="col-12">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>

                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="card card-success">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cow"></i>
                    Registered Livestock
                </h3>

                <div class="card-tools">
                    <a href="{{ route('livestock.create') }}"
                       class="btn btn-success btn-sm">

                        <i class="fas fa-plus"></i>
                        Add New Livestock

                    </a>
                </div>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Animal Type</th>
                            <th>Farm</th>
                            <th>Breed</th>
                            <th>Quantity</th>
                            <th>Purchase Cost (TZS)</th>
                            <th>Health Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($livestocks as $livestock)

                            <tr>

                                <td>
                                    {{ $loop->iteration + ($livestocks->currentPage() - 1) * $livestocks->perPage() }}
                                </td>

                                <td>{{ $livestock->animal_type }}</td>

                                <td>
                                    {{ $livestock->farm->farm_name ?? 'Farm unavailable' }}
                                </td>

                                <td>{{ $livestock->breed ?? 'N/A' }}</td>

                                <td>{{ number_format($livestock->quantity) }}</td>

                                <td>
                                    {{ $livestock->purchase_cost !== null
                                        ? number_format($livestock->purchase_cost, 2)
                                        : 'N/A' }}
                                </td>

                                <td>
                                    @if($livestock->health_status == 'healthy')
                                        <span class="badge badge-success">Healthy</span>

                                    @elseif($livestock->health_status == 'sick')
                                        <span class="badge badge-danger">Sick</span>

                                    @else
                                        <span class="badge badge-warning">Under Treatment</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('livestock.edit', $livestock->id) }}"
                                       class="btn btn-primary btn-sm">

                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('livestock.destroy', $livestock->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Are you sure you want to delete this livestock?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center">
                                    <i class="fas fa-info-circle"></i>
                                    No livestock registered yet.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">
                {{ $livestocks->links() }}
            </div>

        </div>

    </div>
</div>

@endsection