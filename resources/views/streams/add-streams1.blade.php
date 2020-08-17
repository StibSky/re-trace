@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>ADD NEW STREAM</h3>
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>Hi {{ Auth::user()->first_name }},</h4>
                <br>
                <h4>what is the name of your stream?</h4>
                <form action="{{ route('add-streams1', $project->id) }}" method="post" class="mt-5">
                    @csrf
                    <div class="form-group">
                        <label for="streamName" class="sr-only">Name:</label>
                        <input type="text" class="form-control text-center" id="streamName" name="streamName"
                               placeholder="STREAM NAME"
                               value="{{ session()->get('stream.name') }}">
                    </div>
                    <div class="form-group">
                        <label for="streamDescription" class="sr-only">Description:</label>
                        <textarea class="form-control text-center" id="streamDescription" name="streamDescription"
                               placeholder="DESCRIPTION">{{ session()->get('stream.description') }}</textarea>
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newStream">Next</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{route('dash', $project->id)}}"><span><strong>Go Back</strong></span></a>
            </div>
        </div>
    </div>
@endsection
