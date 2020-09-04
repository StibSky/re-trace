@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
@endsection
@section('content')
    <p><strong>{{ __("Name") }}:</strong> {{$name}}</p>
    <p><strong>{{ __("Description") }}:</strong> {{$description}}</p>
    <p><strong>{{ __("Category") }}:</strong> {{$category}}</p>
    <p><strong>{{ __("Action") }}:</strong> {{$action}}</p>
    <p><strong>{{ __("Quantity") }}:</strong> {{$quantity}} {{$unit}} </p>
    <p><strong>{{ __("Price") }}:</strong> {{$price}}{{$valuta}}</p>
    <p><strong>{{ __("Materials") }}:</strong></p>
    @foreach($materials as $material)
        <p>{{$material}}</p>
    @endforeach
    <p><strong>{{ __("Functions") }}:</strong> </p>
    @foreach($functions as $function)
        <p>{{$function}}</p>
    @endforeach
@endsection
