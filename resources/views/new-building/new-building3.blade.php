@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>{{ __("What type of building is your project?") }}</h4>
                <p>{{ __("You can only select")}} <strong>{{ __("one")}}</strong> {{ __("type")}}</p>
                <form action="{{ route('newBuilding3') }}" method="post" class="mt-4">
                    @csrf
                    <div class="form-group">
                        <label for="type" class="sr-only">Type</label>
                        <select name="type" id="buttonSelect" multiple>
                            <option value="detached house">{{ __("Detached house")}}</option>
                            <option value="apartment">{{ __("Apartment")}}</option>
                            <option value="terraced house">{{ __("Terraced house")}}</option>
                            <option value="multiple houses">{{ __("Multiple houses")}}</option>
                            <option value="commercial building">{{ __("Commercial building")}}</option>
                        </select>
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newBuilding3">{{ __("Next")}}
                    </button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}"><span><strong>{{ __("Go Back")}}</strong></span></a>
            </div>
        </div>
    </div>
@endsection

