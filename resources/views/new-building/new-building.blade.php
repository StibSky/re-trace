@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="container">
        <form action="{{ route('newBuilding') }}" method="post">
            @csrf
            <h2>Project info</h2>
            <div class="form-group">
                <label for="projectName">Name:</label>
                <input type="text" class="form-control" id="projectName" name="projectName" placeholder="firstBuilding">
            </div>
            <div class="form-group">
                <label for="projectImage">image url:</label>
                <input type="text" class="form-control" id="projectImage" name="projectImage"
                       placeholder="http://building.png">
            </div>
            <div class="form-group">
                <label for="inputAddress">Address:</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress"
                       placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address line 2:</label>
                <input type="text" class="form-control" id="inputAddress2" name="inputAddress2"
                       placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" id="type">
                    <option value="single house">Single house</option>
                    <option value="apartment">Apartment</option>
                    <option value="row house">Row house</option>
                    <option value="multiple housing">Multiple housing</option>
                    <option value="commercial building">Commercial building</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City:</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPostCode">Post code:</label>
                    <input type="text" class="form-control" id="inputPostCode" name="inputPostCode">
                </div>
            </div>
            <br>
            <button type="submit" id="add-button" class="btn btn-primary" name="submitNewBuilding">Submit</button>
        </form>

        <br>
        <br>
        <br>
        <p >Didn't want to create a new project?</p>
        <a type="submit" id="add-button" class="btn btn-primary " name="submitNewBuilding"
           href="{{route('home')}}">Back
            to profile </a>

    </div>
@endsection
