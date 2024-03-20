@extends('layouts.app')

@section('content')
<div class="container show p-5">
    <div class="row">
        @if (session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
             <h2>{{ $vehicle->color }}</h2>
             <h1>{{ $vehicle->fuel }}</h1>
        </div>
    </div>
    <a class="btn btn-primary mt-5" href="{{url()->previous()}}">CANCEL</a>
    <a class="btn btn-primary mt-5" href="{{ route('admin.vehicles.index') }}">HOME</a>
</div>
@endsection
