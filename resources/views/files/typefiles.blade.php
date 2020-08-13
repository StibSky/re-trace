@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
    <h1>{{ $filetype }}</h1>
    @foreach($projectfiles as $file)
        @if($file->type == $filetype)
            <li class="d-flex flex-row justify-content-between pb-2">
                <p>{{ $file->name }} - {{ $file->id }}</p>
                <div class="d-flex flex-row justify-content-end">
                    @if($file->type == "Photos exterior" or $file->type == "Photos interior")
                        <a href="#" class="btn btn-primary" id="secondary-button-medium">Set as main image</a>
                    @endif
                    @if(Auth::user()->type == 'admin')
                        <button data-toggle="modal"
                                data-target="#myModal_{{ $file->id }}" class="btn btn-primary" name="deleteFile"
                                id="main-button-medium">Delete
                        </button>
                        <div id="myModal_{{ $file->id }}" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-left">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">X
                                        </button>
                                        <h4 class="modal-title">Are you sure you want to delete?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('deleteFile') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="fileId" value="{{ $file->id }}">
                                            <button type="submit" class="btn btn-primary"
                                                    name="deleteFile" id="main-button">Yes, please delete</button>
                                        </form>
                                        <button type="button" class="btn btn-default"
                                                id="secondary-button-small"
                                                data-dismiss="modal">No
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--                                    <a href="{{route('deleteFile', $file->id)}}" class="btn btn-primary"
                                                               id="main-button-medium">Yes, delete file</a>--}}
                    @endif
                    <a href="{{route('previewFiles', $file->id)}}" class="btn btn-primary" id="secondary-button-medium">View</a>
                    <a href="{{route('downloadFile', $file->id)}}" class="btn btn-primary" id="main-button-medium">Download</a>
                </div>
            </li>
            <hr>
        @endif
    @endforeach
@endsection
