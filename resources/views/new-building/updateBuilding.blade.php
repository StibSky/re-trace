@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ route('buildingUpdate') }}" target="_blank" method="post">
            @csrf
            <h2>image</h2>
            <div class="form-group">
                <label for="buildingImage">building Image Url:</label>
                <input type="text" class="form-control" id="buildingImage" name="buildingImage"
                       placeholder="https://building.jpg">
            </div>

            <br>
            <button type="submit" class="btn-success" name="submitBuildingInfo">Submit</button>
        </form>
    </div>

@endsection
