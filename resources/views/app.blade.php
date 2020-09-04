<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!--
the landing page, this is where you go to when you click home as a logged in user (otherwise you get directed to the login page)
-->
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
    <div class="d-flex justify-content-center mt-5">
        <div class="content">
            <div class="title m-b-md" id="logo">
                <img src="{{ asset('images/re_logo.png') }}" class="w-75" alt="">
            </div>
        </div>
    </div>
    </body>
@endsection
</html>

