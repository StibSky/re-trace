@extends('layouts.app')

@section('content')

    <h1>welcome {{Auth::user()->name}}</h1>
    <button type="button" class="btn btn-secondary">add new building</button>

@endsection
