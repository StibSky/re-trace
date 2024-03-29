@extends('layouts.app')
@section('stylesheet')
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
                <h4>{{ __("Confirm input and create project?")}}</h4>
                <table class="d-flex justify-content-center mt-5">
                    <tr>
                        <td>{{ __("Project name")}}: {{ $building->projectName }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Address")}}: {{ $building->address1 }}</td>
                    </tr>
                    <tr>
                        <td>{{ $building->address2 }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("City")}}: {{ $building->city }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Postcode")}}: {{ $building->postcode }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Type")}}: {{ $building->type }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Activity")}}: {{ $building->status }}</td>
                    </tr>
                </table>
                <form action="{{ route('store') }}" method="post" class="mt-5">
                    @csrf
                    <button type="submit" id="main-button" class="btn btn-primary" name="confirm">{{ __("Create")}}</button>
                </form>
            </div>

            <div class="card-footer text-center">
                <a href="{{route('building4')}}"><span><strong>{{ __("Go Back")}}</strong></span></a>
            </div>
        </div>
    </div>
@endsection

