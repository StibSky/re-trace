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
    <link rel="stylesheer" href="{{ asset('css/logolanding.css') }}">
</head>
@extends('layouts.app')

@section('content')
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md" id="logo">
            <img src="{{ asset('images/re_logo.png') }}" class="img-circle" alt="">
        </div>
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

