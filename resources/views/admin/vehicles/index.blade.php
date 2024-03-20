@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-title-index">
            <h1 class="fw-bold">Your Vehicles</h1>
        </div>
        <!--message delate-->
        <div class="row">
            <div class="col">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table border border-danger text-center">
                    <thead>
                        <tr class="table-danger">
                            <th>Color</th>
                            <th>Fuel</th>
                            <th>Max_weight</th>
                            <th>type</th>
                            <th>Devices</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->color }}</td>
                                <td>{{ $vehicle->fuel }}</td>
                                <td>{{ $vehicle->max_weight }}</td>
                                <td>{{ $vehicle->type }}</td>
                                <td>
                                    @if ($vehicle->devices()->get()->count() === 0)
                                        No Devices
                                    @endif
                                    @foreach ($vehicle->devices()->get() as $device)
                                        {{ $device->name }}
                                    @endforeach
                                </td>
                                <td>{{ $vehicle->created_at }}</td>
                                <td>{{ $vehicle->updated_at }}</td>
                                <td><a class="btn btn-danger text-white"
                                        href="{{ route('admin.vehicles.show', $vehicle->id) }}">View</a></td>
                                <td>
                                    <a class="btn btn-danger text-white"
                                        href="{{ route('admin.vehicles.edit', $vehicle->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

