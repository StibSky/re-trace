@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __("CREATE A NEW PROJECT") }}</h3>
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>{{ __("What are you going to do?")}}</h4>
                <p>{{ __("You can only select")}} <strong>{{ __("one")}}</strong> {{ __("type")}}</p>
                <form action="{{ route('newBuilding4') }}" method="post" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="status" class="sr-only">{{ __("Status")}}</label>
                        <select name="status" id="buttonSelect" multiple>
                            <option value="renovation">{{ __("Renovation")}}</option>
                            <option value="demolition">{{ __("Demolition")}}</option>
                            <option value="new Build">{{ __("New Build")}}</option>
                            <option value="nothing">{{ __("Nothing")}}</option>
                        </select>
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newBuilding4">{{ __("Next")}}</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}"><span><strong>{{ __("Go Back")}}</strong></span></a>
            </div>
        </div>
    </div>
@endsection

