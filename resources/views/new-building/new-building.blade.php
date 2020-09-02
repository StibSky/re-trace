@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __("CREATE A NEW PROJECT") }}</h3>
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
            <h4>Hi {{ Auth::user()->first_name }},</h4>
                <br>
                <h4>{{ __("What is the name of your project?") }}</h4>
                <form action="{{ route('newBuilding') }}" method="post" class="mt-5">
                    @csrf
                    <div class="form-group">
                        <label for="projectName" class="sr-only">{{ __("Name") }}:</label>
                        <input type="text" class="form-control text-center" id="projectName" name="projectName"
                               placeholder="{{ __("PROJECT NAME") }}"
                               value="{{ session()->get('building.projectName') }}">
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newBuilding">{{ __("Next")}}</button>
                </form>
            </div>
            <div class="card-footer text-center">
            <a href="{{route('home')}}"><span><strong>{{ __("Go Back")}}</strong></span></a>
            </div>
        </div>
    </div>
@endsection
