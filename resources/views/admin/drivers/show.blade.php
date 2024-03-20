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
             <h2>{{ $driver->name }}</h2>
             <h1>{{ $driver->surname }}</h1>
        </div>
    </div>
    <a class="btn btn-primary mt-5" href="{{url()->previous()}}">CANCEL</a>
    <a class="btn btn-primary mt-5" href="{{ route('admin.drivers.index') }}">HOME</a>
</div>
@endsection
