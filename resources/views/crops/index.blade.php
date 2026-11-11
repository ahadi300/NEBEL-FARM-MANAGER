
@extends('layouts.app')

@section('title', 'Crop Management | Nebel Farm Manager')

@section('page-title', 'Crop Management')

@section('content')

<div class="row">
    <div class="col-12">

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
                    <i class="fas fa-seedling"></i>
                    Registered Crops
                </h3>

                <div class="card-tools">
                    <a href="{{ route('crops.create') }}"
                       class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add New Crop
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Crop Name</th>
                            <th>Farm</th>
                            <th>Area Planted</th>
                            <th>Planting Date</th>
                            <th>Expected Harvest</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($crops as $crop)

                            <tr>
                                <td>
                                    {{ $loop->iteration + ($crops->currentPage() - 1) * $crops->perPage() }}
                                </td>

                                <td>{{ $crop->crop_name }}</td>

                                <td>
                                    {{ $crop->farm->farm_name ?? 'Farm unavailable' }}
                                </td>

                                <td>
                                    {{ number_format($crop->area_planted, 2) }}
                                    {{ $crop->area_unit }}
                                </td>

                                <td>{{ $crop->planting_date ?? 'N/A' }}</td>

                                <td>{{ $crop->expected_harvest_date ?? 'N/A' }}</td>

                                <td>
                                    @if($crop->status == 'harvested')
                                        <span class="badge badge-success">Harvested</span>
                                    @elseif($crop->status == 'growing')
                                        <span class="badge badge-info">Growing</span>
                                    @else
                                        <span class="badge badge-warning">Planned</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('crops.edit', $crop->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('crops.destroy', $crop->id) }}"
                                          method="POST"
                                          style="display:inline;"
                                          onsubmit="return confirm('Are you sure you want to delete this crop?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </form>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center">
                                    <i class="fas fa-info-circle"></i>
                                    No crops registered yet.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">
                {{ $crops->links() }}
            </div>

        </div>

    </div>
</div>

@endsection
