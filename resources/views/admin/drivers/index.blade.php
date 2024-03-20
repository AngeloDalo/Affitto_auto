@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-title-index">
            <h1 class="fw-bold">Your Drivers</h1>
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
                            <th>Phone</th>
                            <th>B-day</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Vehicle</th>
                            <th>Licences</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                            <tr>
                                <td>{{ $driver->phone }}</td>
                                <td>{{ $driver->b_day }}</td>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->surname }}</td>
                                <td>{{ $driver->vehicle_id }}</td>
                                <td>
                                    @if ($driver->licences()->get()->count() === 0)
                                        No Licences
                                    @endif
                                    @foreach ($driver->licences()->get() as $licence)
                                        {{ $licence->category }}
                                    @endforeach
                                </td>
                                <td>{{ $driver->created_at }}</td>
                                <td>{{ $driver->updated_at }}</td>
                                <td><a class="btn btn-danger text-white"
                                        href="{{ route('admin.drivers.show', $driver->id) }}">View</a></td>
                                <td>
                                    <a class="btn btn-danger text-white"
                                        href="{{ route('admin.drivers.edit', $driver->id) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
