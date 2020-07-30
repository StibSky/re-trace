@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container">
        <ul>
            @foreach($projectfiles as $projectfile)
                <li>
                    <a href="{{route('downloadFile', $projectfile->id)}}">{{ $projectfile->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
