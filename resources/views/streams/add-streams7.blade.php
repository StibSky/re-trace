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
                <h4>Please give the price of your stream</h4>
                <form action="{{ route('add-streams7', $id) }}" method="post" class="mt-5">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="streamAction" class="sr-only">Action:</label>
                            <select name="streamAction" id="streamAction">
                                <option value=null>
                                    PLEASE SELECT AN ACTION
                                </option>
                                <option value="reuse">
                                    Reuse
                                </option>
                                <option value="recycle">
                                    Recycle
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newStream">Next</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{route('streams6', $id)}}"><span><strong>Go Back</strong></span></a>
            </div>
        </div>
    </div>
@endsection
