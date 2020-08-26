@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('head-script')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endsection
@section('content')
    <!--
HOMEPAGE for users, users find their projects here and functionality to upload files/materiallists
-->
    @if(session('verified'))
        <div class="alert alert-success">
            You've successfully verified your email!
        </div>
    @endif

    <div class="d-flex flex-md-row flex-column justify-content-between">
        <div class="col-md-6 col-12 px-2" id="userInfo">
            <div class="row card d-flex mb-5">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <div class="row px-3">
                        <div class="col-lg-5 col-12 d-flex flex-column">
                            <div class="row">
                                <img src="{{ asset('images/logos/resquare.png') }}" id="profilePic" class="w-50 mx-auto"
                                     alt="Placeholder">
                            </div>
                            <div class="row">
                                <a class="btn btn-primary mx-auto" name="editProfile" id="main-button"
                                   data-toggle="modal"
                                   data-target="#editModal">Edit
                                </a>
                            </div>
                        </div>
                        <div class="col-6 d-flex flex-column pt-lg-2 pt-4">
                            <h5>Personal details</h5>
                            <ul>
                                <li>Full name: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</li>
                                <li>Email address: {{ Auth::user()->email }}</li>
                                <li>Profile Type: {{ Auth::user()->type }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-lg-5 mt-1">
                <div class="card-header">My projects</div>
                <div class="card-body" id="myProjects">
                    @if(count($buildings) == 0)
                        <h5> - Please add your first project to progress your profile</h5>
                    @endif
                    <ul>
                        @foreach($buildings as $building)
                            <li class="d-flex flex-row justify-content-between">
                                <a id="project-names"
                                   href="{{route('dash', $building->id)}}"> {{ $building->projectName ?? 'Project name' }}</a>
                                <span class="w-100">{{ $building->type }}</span>
                                <div>
                                    @if(Auth::user()->type == 'admin')
                                        <button data-toggle="modal"
                                                data-target="#myModal" class="btn btn-primary"
                                                name="deleteBuilding"
                                                id="main-button-small">Delete
                                        </button>
                                    @endif
                                </div>
                            </li>
                            <hr class="py-0 my-2">
                        @endforeach
                    </ul>

                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" id="main-button" href="{{ route('building') }}">Add New Project</a>
                </div>
            </div>

        </div>
        <div class="col-md-5 col-12 mt-md-0 mt-2 p-2 card d-flex" id="projectInfo">
            <div class="row d-flex">
                <div class="col-12 d-flex justify-content-center" id="newSearch">
                    <form class="form text-center d-flex flex-column justify-content-center px-auto"
                          action="{{ route('mysearch') }}" method="post" name="searchForm">
                        @csrf
                        <label>Pick material:
                            <select name="substance" id="categorySelect" class="js-example-basic-single w-50">
                                <option selected disabled>Please select</option>
                                @foreach($headCategories as $headCategory)
                                    <option value="{{ $headCategory->id }}" class="categoryOptions">
                                        {{ $headCategory->name }}
                                    </option>
                                @endforeach
                                @foreach($subCategories1 as $subCategory1)

                                    <option value="{{ $subCategory1->id }}" class="categoryOptions">
                                        ---{{$subCategory1->name }}
                                    </option>

                                @endforeach
                                @foreach($subCategories2 as $subCategory2)

                                    <option value="{{ $subCategory2->id }}" class="categoryOptions">
                                        ------{{ $subCategory2->name }}
                                    </option>

                                @endforeach
                            </select>
                        </label>
                        <br>
                        <div class="input-group w-75 text-center d-flex justify-content-center mx-auto" id="searchBar">
                            <input class="form-control" type="text" placeholder="Search" aria-label="Search"
                                   style="padding-left: 20px; border-radius: 40px;" id="filterCategories"
                                   name="mysearch">
                            <div class="input-group-addon py-1"
                                 style="margin-left: -50px; z-index: 3; border-radius: 40px; border:none;">
                                <button class="btn btn-warning btn-sm" type="submit" style="border-radius: 20px;"
                                        id="search-btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="map" class="border border-dark mb-5 ml-5 mr-5 rounded"></div>
            </div>
        </div>
        <div id="editModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">
                            &times;
                        </button>
                        <h4 class="modal-title">Fill in the fields you want to edit, Leave the
                            fields
                            empty
                            if you don't want to change anything</h4>
                    </div>
                    <form action="{{ route('editUserInfo') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <label for="firstName">First name</label>
                            <input type="text" name="firstName" id="firstName">
                            <br>
                            <label for="lastName">Last name</label>
                            <input type="text" name="lastName" id="lastName">
                            <br>
                            <label for="Email">Email</label>
                            <input type="text" name="Email" id="Email">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <input type="submit" value="Submit" name="upload"/>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div id="myModal" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-left">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">X
                        </button>
                        <h4 class="modal-title">Are you sure you want to delete?</h4>
                    </div>
                    <form action="{{ route('deleteBuilding', $building) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <button value="{{ $building->id }}" class="btn btn-primary"
                                    name="deleteBuilding" id="main-button">Yes, delete
                                project
                            </button>
                            <button type="button" class="btn btn-default"
                                    id="secondary-button-small"
                                    data-dismiss="modal">No
                            </button>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>


    <?php use App\Http\Controllers\HomeController;
    use App\Building; ?>

    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&callback=initMap">
    </script>
    <script type="text/javascript">
        "use strict";

        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });

        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;

        const BELGIUM_BOUNDS = {
            north: 49.56,
            south: 51.47,
            west: 2.59,
            east: 6.26
        };
        const ANTWERPEN = {
            lat: 51.22,
            lng: 4.4
        };

        function initMap() {
            let map = new google.maps.Map(document.getElementById("map"), {
                center: ANTWERPEN,
                restriction: {
                    latLngBounds: BELGIUM_BOUNDS,
                    strictBounds: false
                },
                zoom: 8
            });


            let locationArray = [];
                @if(session('substanceId') !=null )
                @for($i=0; $i < count( session('materialLocations') ); $i++)
            var location = {
                    lat: {!! HomeController::getLat(session('materialLocations')[$i]) !!},
                    lng: {!! HomeController::getLng(session('materialLocations')[$i]) !!}};
            locationArray.push(location);
            console.log('test');
                @endfor
                @else
                @for($i=0; $i < count( $locations ); $i++)
            var location = {
                    lat: {!! HomeController::getLat($locations[$i]) !!},
                    lng: {!! HomeController::getLng($locations[$i]) !!}};
            locationArray.push(location);
            console.log(locationArray);
                @endfor
                @endif




            for (let i = 0; i < locationArray.length; i++) {
                new google.maps.Marker({
                    position: locationArray[i],
                    label: labels[labelIndex++ % labels.length],
                    map: map
                });
            }
        }
    </script>
    {{--  <div class="container mt-3">
          Profile Progress
          --}}{{--            <div class="progress">--}}{{--
          <div>
              @if (!isset($firstbuilding->projectName))
                  <h2><strong>Please add a first project to progress your profile </strong></h2>
              @else
                  <h3><strong>Your profile is up to date! Click your project names to edit and add files</strong></h3>
              @endif
          </div>
      </div>--}}
@endsection
