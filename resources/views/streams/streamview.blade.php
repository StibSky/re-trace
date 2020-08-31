@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <p><strong>Name:</strong> {{$name}}</p>
    <p><strong>Description:</strong> {{$description}}</p>
    <p><strong>Category:</strong> {{$category}}</p>
    <p><strong>Action:</strong> {{$action}}</p>
    <p><strong>Quantity:</strong> {{$quantity}} {{$unit}} </p>
    <p><strong>Price:</strong> {{$price}}{{$valuta}}</p>
    <p><strong>Materials:</strong></p>
    @foreach($materials as $material)
        <p>{{$material}}</p>
    @endforeach
    <p><strong>Functions:</strong> </p>
    @foreach($functions as $function)
        <p>{{$function}}</p>
    @endforeach
@endsection
