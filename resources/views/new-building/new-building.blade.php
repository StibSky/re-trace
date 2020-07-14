@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('buildingUpdate') }}" method="post">
            @csrf
            <h2>Project name</h2>
            <div class="form-group">
                <label for="projectName">Name:</label>
                <input type="text" class="form-control" id="projectName" name="projectName" placeholder="firstBuilding">
            </div>
            <h2>Address</h2>
            <div class="form-group">
                <label for="inputAddress">Address:</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address line 2:</label>
                <input type="text" class="form-control" id="inputAddress2" name="inputAddress2"
                       placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type"
                       placeholder="type">
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
            <button type="submit"  class="btn-success" name="submitNewBuilding">Submit </button>
        </form>
    </div>
@endsection
