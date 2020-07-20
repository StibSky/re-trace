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
                    <div class="col-12 d-flex pl-4 pt-4">
                        <p>this is placeholder text for your building info, you can edit this later.</p>
                    </div>
                <!--  <a href="{{route('updateBuilding')}}">Edit information</a> -->
                </div>
            </div>
            <div class="col-sm-6 col-12 p-2 card d-flex" id="projectInfo">
                <div class="card-title mt-3 ml-3"><h3>My projects</h3></div>
                <div class="card-body">
                    <ul>
                        @foreach($buildings as $building)
                            <li class="mb-1 d-flex justify-content-between">
                                <a id="project-names"
                                   href="{{route('dash', $building->id)}}"> {{ $building->projectName ?? 'Project name' }}</a>
                                <div>
                                    <a class="btn btn-primary" id="edit-button" href="#">Edit</a>
                                    <a class="btn btn-primary" id="delete-button" href="#">Delete</a>
                                </div>
                            </li>
                            <hr>
                        @endforeach
                            <div class="d-flex">
                                {{ $buildings->links() }}
                            </div>
                    </ul>
                </div>
                <a class="btn btn-primary mb-2 ml-2" id="add-button" href="{{ route('building') }}">Add New Project</a>
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
    </div>
@endsection
