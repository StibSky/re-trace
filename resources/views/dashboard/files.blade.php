@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <h1>Files - {{ $project->projectName }}</h1>
    <ul>
        @foreach($projecttypes as $type)
            <h4 class="pb-3">{{ $type }}</h4>
            @foreach($projectfiles as $file)
                @if($file->type == $type)
                    <li class="d-flex flex-row justify-content-between pb-2">
                        <p>{{ $file->name }}</p>
                        <div class="d-flex flex-row justify-content-end">
                            <a href="#" class="btn btn-primary" id="secondary-button-medium">View</a>
                            <a href="{{route('downloadFile', $file->id)}}" class="btn btn-primary" id="main-button-medium">Download</a>
                        </div>
                    </li>
                    <hr>
                @endif
            @endforeach
        @endforeach
    </ul>

@endsection
