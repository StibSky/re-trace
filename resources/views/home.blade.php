@extends('layouts.app')

@section('content')
    <h1>Welcome {{ Auth::user()->name }}</h1>
    <a id="newBuilding" href="{{ route('building') }}">add New Building</a>
@endsection
