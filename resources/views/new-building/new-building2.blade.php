@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h2>Please give your project's address</h2>
        <h3>Project name: {{ $building->projectName }}</h3>
        <form  action="{{ route('newBuilding2') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="address1">Address:</label>
                <input type="text" class="form-control" id="address1" name="address1"
                       placeholder="1234 Main St" value="{{ session()->get('building.address1') }}">
            </div>
            <div class="form-group">
                <label for="address2">Address line 2:</label>
                <input type="text" class="form-control" id="address2" name="address2"
                       placeholder="Apartment, studio, or floor" value="{{ session()->get('building.address2') }}">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City:</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ session()->get('building.city') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPostCode">Post code:</label>
                    <input type="text" class="form-control" id="postcode" name="postcode" value="{{ session()->get('building.postcode') }}">
                </div>
            </div>
            <button type="submit" id="main-button" class="btn btn-primary" name="newBuilding2">Submit</button>
        </form>
        <br>

    </div>
@endsection
