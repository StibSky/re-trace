@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
<div class="form-group">
    <label for="projectImage">image url:</label>
    <input type="text" class="form-control" id="projectImage" name="projectImage"
           placeholder="http://building.png">
</div>
<h2>What are you going to do?</h2>
<form  action="{{ route('newBuilding4') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="status">Please select an option:</label>
        <select name="status" id="status">
            <option value="{{ session()->get('building.status') }}">{{ session()->get('building.status') }}</option>
            <option value="renovation">Renovation</option>
            <option value="demolition">Demolition</option>
            <option value="new Build">New Build</option>
            <option value="nothing">Nothing</option>
        </select>
    </div>
    <button type="submit" id="main-button" class="btn btn-primary" name="newBuilding4">Submit</button>
</form>
<br>
@endsection

