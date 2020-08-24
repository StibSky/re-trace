@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <p><strong>name:</strong> {{$name}}</p>
    <p><strong>description:</strong> {{$description}}</p>
    <p><strong>category:</strong> {{$category}}</p>
    <p><strong>action:</strong> {{$action}}</p>
    <p><strong>quantity:</strong> {{$quantity}} {{$unit}} </p>
    <p><strong>price:</strong> {{$price}}{{$valuta}}</p>
    <p><strong>materials:</strong></p>
    @foreach($materials as $material)
        <p>{{$material}}</p>
    @endforeach
    <p><strong>functions:</strong> </p>
    @foreach($functions as $function)
        <p>{{$function}}</p>
    @endforeach
@endsection
