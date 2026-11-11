@extends('layouts.app')

@section('title', 'Registered Farms')
@section('page-title', 'Registered Farms')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Farm Records</h3>

        <div class="card-tools">
            <a href="{{ route('farms.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Register Farm
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
                        <th>Farm Name</th>
                        <th>Owner</th>
                        <th>Location</th>
                        <th>Size</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($farms as $farm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $farm->farm_name }}</td>
                            <td>{{ $farm->owner_name }}</td>
                            <td>{{ $farm->location }}</td>
                            <td>
                                {{ number_format($farm->size, 2) }}
                                {{ $farm->size_unit }}
                            </td>
                            <td>{{ $farm->phone ?? 'N/A' }}</td>

                            <td>
                                <a href="{{ route('farms.edit', $farm->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('farms.destroy', $farm->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this farm?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                No farms registered yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $farms->links() }}
        </div>

    </div>
</div>

@endsection