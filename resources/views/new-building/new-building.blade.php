@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('home') }}" target="_blank" method="post">
            <label for="buildingname">Name:</label><br>
            <input type="text" id="buildingname" name="buildingname"><br>
            <h2>Address</h2>
            <div class="form-group">
                <label for="inputAddress">Address:</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address line 2:</label>
                <input type="text" class="form-control" id="inputAddress2"
                       placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City:</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputProvince">Province:</label>
                    <select id="inputProvince" class="form-control">
                        <option selected>Choose...</option>
                        <option></option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Post code:</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
            </div>
            <label for="buildingstatus">Building status:</label><br>
            <input type="text" id="buildingstatus" name="buildingstatus"><br>
            <input type="submit" value="Submit" class="btn">
        </form>
    </div>
@endsection
