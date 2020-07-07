@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('buildingUpdate') }}" target="_blank" method="post">
            @csrf
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City:</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPostCode">Post code:</label>
                    <input type="text" class="form-control" id="inputPostCode" id="inputPostCode">
                </div>
            </div>
            <label for="buildingStatus">Building status:</label><br>
            <input type="text" id="buildingStatus" name="buildingStatus"><br>
            <br>
            <button type="submit"  class="btn-success" name="submitNewBuilding">Submit </button>
        </form>
    </div>
@endsection
