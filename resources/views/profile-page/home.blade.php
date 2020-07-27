@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('head-script')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@endsection
@section('content')
    <!--
HOMEPAGE for users, users find their projects here and functionality to upload files/materiallists
-->
    <div class="container">
        <div class="d-flex flex-md-row flex-column align-items-center">
            <div class="col-sm-6 col-12 px-2 card" id="userInfo">
                <div class="row no-gutters d-flex">
                    <div class="col-auto d-flex flex-center pl-4 pt-4">
                        <img src="{{ asset('images/coolbuilding.jpg') }}" class="img-circle" alt="">
                    </div>
                    <div class="col-4 d-flex flex-center">
                        <div>
                            <h4>Hi {{ Auth::user()->first_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters d-flex">
                    <div class="col-12 d-flex flex-column pl-4 pt-4">
                        <h4>Personal details</h4>
                        <ul>
                            <li>Full name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</li>
                            <li>Email address: {{ Auth::user()->email }}</li>
                            <li>Profile Type: {{ Auth::user()->type }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12 p-2 card d-flex" id="projectInfo">
                <div class="card-title mt-3 ml-3"><h3>My projects</h3></div>
                <div class="card-body">
                    @if(count($buildings) == 0)
                        <h5> - Please add your first project to progress your profile</h5>
                    @endif
                    <ul>
                        @foreach($buildings as $building)
                            <li class="mb-1 d-flex justify-content-between">
                                <a id="project-names"
                                   href="{{route('dash', $building->id)}}"> {{ $building->projectName ?? 'Project name' }}</a>
                                <div>
                                    @if(Auth::user()->type == 'admin')
                                        <a class="btn btn-primary" id="edit-button"
                                           href="{{ route('editBuilding', $building->id) }}"> edit</a>
                                        <button data-toggle="modal"
                                                data-target="#myModal" class="btn btn-primary" name="deleteBuilding"
                                                id="delete-button">Delete
                                        </button>
                                    @endif
                                </div>
                            </li>
                            <hr>
                            <div id="myModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title">Are you sure you want to delete?</h4>

                                        </div>
                                        <form action="{{ route('deleteBuilding', $building) }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <button value="{{ $building->id }}" class="btn btn-primary"
                                                        name="deleteBuilding" id="delete-button">Yes, delete project
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                        <div class="d-flex">
                            {{ $buildings->links() }}
                        </div>
                    </ul>
                </div>
                <a class="btn btn-primary mb-2 ml-5" id="add-button" href="{{ route('building') }}">Add New Project</a>
                {{--                <div class="row">
                                    <div class="col-12 py-4 card d-flex align-items-center" id="newSearch">
                                        <form class="form">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Search" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="mysearch">
                                                <div class="input-group-addon py-1" style="margin-left: -50px; z-index: 3; border-radius: 40px; border:none;">
                                                    <button class="btn btn-warning btn-sm" type="submit" style="border-radius: 20px;" id="search-btn"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>--}}
            </div>
        </div>
        <div class="container mt-3">
            <h2>Basic Progress Bar</h2>
            <div class="progress">
                @if (!isset($firstbuilding->projectName))
                    <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" aria-valuenow="15"
                         aria-valuemin="0" aria-valuemax="100" style="width:15%">
                        15% Completed Profile
                    </div>
                @else
                    <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100" style="width:25%">
                        25% Completed Profile
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
