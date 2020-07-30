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
    <ul>
        @foreach($projecttypes as $type)
            <h4>{{ $type }}</h4>
            @foreach($projectfiles as $file)
                @if($file->type == $type)
                    <li><a href="{{route('downloadFile', $file->id)}}">{{ $file->name }}</a></li>
                <button>test</button>
                @endif
            @endforeach
        @endforeach
    </ul>

@endsection
