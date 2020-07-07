<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Re-trace.io</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
@extends('layouts.app')

@section('content')
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            re-trace.io


        </div>
        <h3> building platform</h3>



        <div class="links">
            <a href="https://re-trace.io" target="_blank">start-it website</a>
            @auth
                <a href="{{route('home')}}">User homePage</a>
            @endauth
        </div>
    </div>
</div>
</body>
@endsection
</html>

