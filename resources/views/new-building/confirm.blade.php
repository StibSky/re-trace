@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <img class="mb-4" src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">

        <h2>Confirm input and create project?</h2>
        <h3>Project name: {{ $building->projectName }}</h3>
        <h3>Address: {{ $building->address1 }}</h3>
        <h3>{{ $building->address2 }}</h3>
        <h3>City: {{ $building->city }}</h3>
        <h3>Postcode: {{ $building->postcode }}</h3>
        <h3>Type: {{ $building->type }}</h3>
        <h3>Activity: {{ $building->status }}</h3>

        <form action="{{ route('store') }}" method="post">
            @csrf
            <button type="submit" id="main-button" class="btn btn-primary" name="confirm">Create</button>
        </form>
        <a href="{{ url()->previous() }}" id="secondary-button" class="btn btn-primary">Back</a>
        <br>
    </div>
@endsection

