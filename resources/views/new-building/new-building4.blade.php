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
                <h4>What are you going to do?</h4>
                <form action="{{ route('newBuilding4') }}" method="post" class="mt-5">
                    @csrf
                    <div class="form-group">
                        <label for="status" class="sr-only">Status</label>
                        <select name="status" id="buttonSelect" multiple>
                            <option value="renovation">Renovation</option>
                            <option value="demolition">Demolition</option>
                            <option value="new Build">New Build</option>
                            <option value="nothing">Nothing</option>
                        </select>
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newBuilding4">Next</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ url()->previous() }}"><span><strong>Go Back</strong></span></a>
            </div>
        </div>
    </div>
@endsection

