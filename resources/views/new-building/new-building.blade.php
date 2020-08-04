@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <img class="mb-4" src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
        <h3>Hi {{ Auth::user()->first_name }}</h3>
        <h3>Please give your project a name</h3>
        <form action="{{ route('newBuilding') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="projectName">Name:</label>
                <input type="text" class="form-control" id="projectName" name="projectName" placeholder="firstBuilding"
                       value="{{ session()->get('building.projectName') }}">
            </div>
            <button type="submit" id="main-button" class="btn btn-primary" name="newBuilding">Next</button>
        </form>
        <br>
        <br>
        <br>
        <p>Didn't want to create a new project?</p>
        <a id="secondary-button" class="btn btn-primary "
           href="{{route('home')}}">Back
            to profile </a>
    </div>
@endsection
