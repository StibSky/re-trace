@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
<h2>What type of building is your project ?</h2>
<h3>{{ $building->address1 }}</h3>
<h3>{{ $building->address2 }}</h3>
<h3>{{ $building->city }}</h3>
<h3>{{ $building->postcode }}</h3>
<form  action="{{ route('newBuilding3') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="type">Please select an option:</label>
        <select name="type" id="type">
            <option value="{{ session()->get('building.type') }}">{{ session()->get('building.type') }}</option>
            <option value="detached house">Detached house</option>
            <option value="apartment">Apartment</option>
            <option value="terraced house">Terraced house</option>
            <option value="multiple houses">Multiple houses</option>
            <option value="commercial building">Commercial building</option>
        </select>
    </div>
    <button type="submit" id="main-button" class="btn btn-primary" name="newBuilding3">Submit</button>
</form>
<br>
@endsection

