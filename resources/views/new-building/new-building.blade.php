@extends('layouts.app')

@section('content')
    <!--
blade for adding a new building/project to a User
-->
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>Hi {{ Auth::user()->first_name }}</h3>
        <h3>Please give your project a name</h3>
        <form action="{{ route('newBuilding') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="projectName">Name:</label>
                <input type="text" class="form-control" id="projectName" name="projectName" placeholder="firstBuilding" value="{{ session()->get('register.name') }}">
            </div>
            <button type="submit" id="main-button" class="btn btn-primary" name="newBuilding">Submit</button>
        </form>
    </div>
@endsection
