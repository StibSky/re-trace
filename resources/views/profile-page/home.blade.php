@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">--}}
    {{--    <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
          integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA=="
          crossorigin="anonymous"/>
    <style type="text/css">
        .dropdown-toggle {
            height: 4vh;
            width: 40vw;
        !important;
        }
    </style>
@endsection
@section('head-script')
    {{--    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>--}}
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>--}}
    {{--
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
@endsection
@section('content')
    <!--
HOMEPAGE for users, users find their projects here and functionality to upload files/materiallists
-->
    @if(session('verified'))
        <div class="alert alert-success">
            {{ __("You've successfully verified your email!")}}
        </div>
    @endif

    <div class="d-flex flex-md-row flex-column align-items-stretch justify-content-between">
        <div class="col-md-4 mr-1 col-12 pr-2 ml-0" id="userInfo">
            <div class="row card d-flex mb-5">
                <div class="card-header d-flex flex-row justify-content-between">
                    <h5>{{ __("Profile")}}</h5>
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false" id="cog-link">
                        <img id="cog" src="{{ asset('images/cog-24.png') }}" alt="cog" class="align-self-center">
                        <div class="dropdown-menu">
                            <a class="dropdown-item" name="editProfile"
                               data-toggle="modal"
                               data-target="#editModal">{{ __("Edit")}}
                            </a>
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row px-3 py-2">
                        <div class="col-lg-5 col-12 d-flex flex-column">
                            <img src="{{ asset('images/logos/resquare.png') }}" id="profilePic" class="w-50 mx-auto"
                                 alt="Placeholder">
                        </div>
                        <div class="col-6 d-flex flex-column pt-lg-2 pt-4">
                            <h5>{{ __("Personal details")}}</h5>
                            <ul>
                                <li>{{ __("Full name")}}
                                    : {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</li>
                                <li>{{ __("Email address")}}: {{ Auth::user()->email }}</li>
                                <li>{{ __("Profile Type")}}: {{ Auth::user()->type }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row card mt-lg-5 mt-1">
                <div class="card-header"><h5>{{ __("My projects")}}</h5></div>
                <div class="d-flex flex-row justify-content-between" id="titleBar">
                    <span class="w-75">{{ __("Name")}}</span>
                    <span class="w-100">{{ __("Type")}}</span>
                    <span class="w-75">{{ __("Category")}}</span>
                    <span class="w-75"> </span>
                </div>
                <div class="card-body text-left" id="myProjects">
                    @if(count($buildings) == 0)
                        <h5> - {{ __("Please add your first project to progress your profile")}}</h5>
                    @endif
                    <ul>
                        @foreach($buildings as $building)
                            <li class="d-flex flex-row justify-content-between">
                                <a id="project-names" class="w-75"
                                   href="{{route('dash', $building->id)}}"> {{ $building->projectName ?? 'Project name' }}</a>
                                <span class="w-100">{{ $building->type }}</span>
                                <span class="w-75">{{ $building->status }}</span>
                                <div class="w-75">
                                    @if(Auth::user()->type == 'admin')
                                        <button data-toggle="modal"
                                                data-target="#myModal" class="btn btn-primary"
                                                name="deleteBuilding"
                                                id="main-button-small">{{ __("Delete")}}
                                        </button>
                                    @endif
                                </div>
                            </li>
                            <hr class="py-0 my-2">
                        @endforeach
                    </ul>

                </div>
                <div class="card-footer">
                    <a class="btn btn-primary" id="main-button"
                       href="{{ route('building') }}">{{ __("+ New Project")}}</a>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-12 mt-md-0 mt-2 p-2 mx-0 ml-md-3 card d-flex" id="mapAndSearch">
            <div class="card-body d-flex">
                <div class="col-4">
                    {{--                    <div class="d-flex flex-column w-25">
                                                                <button type="button" id="moreMats" class="moreMats"
                                                                        onclick="$('.materialDrop').toggle(function(){$('#moreMats').html($('#materialDropdown')
                                                                            .is(':visible')?'{{ __("Hide Materials") }}':'{{ __("Materials") }}');});">{{ __("Materials") }}</button>
                                                                <button type="button" id="moreFuncts" class="moreFuncts"
                                                                        onclick="$('.functionDrop').toggle(function(){$('#moreFuncts').html($('#functionDropdown')
                                                                            .is(':visible')?'{{ __("Hide Functions") }}':'{{ __("Functions") }}');});">{{ __("Functions") }}</button>
                                                            </div>--}}
                    <div id="newSearch">
                        <form class="form d-flex flex-column justify-content-center"
                              action="{{ route('mysearch') }}" method="post" name="searchForm">
                            @csrf
                            <div id="searchField">
                                <div class="input-group text-center" id="searchBar">
                                    <input class="form-control" type="text" placeholder="{{ __("Search")}}"
                                           aria-label="Search" value="{{ session()->get('mysearch') }}"
                                           id="filterCategories"
                                           name="mysearch">
                                </div>
                                <a class="btn btn-primary mt-2 d-flex flex-row justify-content-between"
                                   id="toggleMaterial">
                                    <div>{{ __("Filter by material")}}</div>
                                    <div><i class="arrow down"></i></div>
                                </a>
                                <div class="materialContainer">
                                    <label for="substance[]" class="sr-only">Material</label>
                                    <select class="js-example-basic-multiple" multiple data-live-search="true"
                                            id="materialDropdown"
                                            name="substance[]" data-placeholder="{{ __("Search")}}...">
                                        @foreach($subCategories1 as $subCategory1)
                                            <option value="{{ $subCategory1->id }}">
                                                @if(app()->getLocale() == "en")
                                                    {{ $subCategory1->name }}
                                                @elseif(app()->getLocale() == "fr")
                                                    {{ $subCategory1->name_fr }}
                                                @elseif(app()->getLocale() == "nl")
                                                    {{ $subCategory1->name_nl }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <a class="btn" id="resetMaterial">{{ __("Clear material filters")}}</a>

                                <a class="btn btn-primary mt-2 d-flex flex-row justify-content-between"
                                   id="toggleFunction">
                                    <div>{{ __("Filter by function")}}</div>
                                    <div><i class="arrow down"></i></div>
                                </a>
                                <div id="functionContainer">
                                    <label for="dbFunction[]" class="sr-only">Function</label>
                                    <select class="js-example-basic-multiple" multiple
                                            data-live-search="true" id="functionDropdown"
                                            name="dbFunction[]" data-placeholder="{{ __("Search")}}...">
                                        @foreach($functionSubCategory1 as $functionSub)
                                            <option value="{{ $functionSub->id }}" class="dropdown-item">
                                                @if(app()->getLocale() == "en")
                                                    {{ $functionSub->name }}
                                                @elseif(app()->getLocale() == "fr")
                                                    {{ $functionSub->name_fr }}
                                                @elseif(app()->getLocale() == "nl")
                                                    {{ $functionSub->name_nl }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <a class="btn" id="resetFunction">{{ __("Clear function filters")}}</a>
                                <a class="btn btn-primary mt-2 d-flex flex-row justify-content-between"
                                   id="toggleLocation">
                                    <div>{{ __("Filter by location")}}</div>
                                    <div><i class="arrow down"></i></div>
                                </a>
                                <div id="locationContainer">
                                    <label for="dbLocation[]" class="sr-only">Location</label>
                                    <select class="js-example-basic-multiple" multiple
                                            data-live-search="true" id="locationDropdown"
                                            name="dbLocation[]" data-placeholder="{{ __("Search")}}...">
                                        @foreach($buildingLocations as $buildingLocation)
                                            <option value="{{ $buildingLocation->city }}" class="dropdown-item">
                                                {{ $buildingLocation->city }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <a class="btn" id="resetLocation">{{ __("Clear location filters")}}</a>


                            </div>
                            {{--                            <div class="form-group">
                                                            <search-dropdown
                                                                :options="{{ $subCategories1->toJson() }}"
                                                                selected.sync="selected"
                                                                placeholder="Material"
                                                                tag-placeholder="Please select tag"
                                                            ></search-dropdown>
                                                        </div>--}}
                            <div class="d-flex flex-row justify-content-between" id="bottomFilters"><span>Filters</span><a
                                    class="btn text-right" id="resetFilters">{{ __("Clear all")}}</a></div>


                            <button class="btn btn-primary mt-2 mb-1" type="submit"
                                    id="main-button">{{ __("Search") }}</button>
                        </form>
                    </div>
                    <div class="mt-1" id="prevTags">
                        @if(session('materialTagArray'))
                            <p>Material filters:</p>
                            <div>
                                @for($i=0; $i < (count( session('materialTagArray') )); $i++)
{{--                                    @foreach($subCategories1 as $subCategory1)--}}

                                    <span
                                        class="btn btn-primary searchTags">{{ session('materialTagArray')[$i] }}</span>
{{--                                    @endforeach--}}
                                @endfor

                            </div>


                        @endif
                        @if(session('functionTagArray') && session('materialLocations'))
                            <p>Function filters:</p>
                            <div>
                                @for($i=0; $i < (count( session('functionTagArray') )); $i++)
                                    <span
                                        class="btn btn-primary searchTags">{{ session('functionTagArray')[$i] }}</span>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-8">
                    <div id="map" class="border border-dark rounded w-100"></div>
                </div>
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
                        <h4 class="modal-title">{{ __("Fill in the fields you want to edit")}},
                            {{ __("Leave the fields empty if you don't want to change anything")}}</h4>
                    </div>
                    <form action="{{ route('editUserInfo') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <label for="firstName">{{ __("First name")}}</label>
                            <input type="text" name="firstName" id="firstName">
                            <br>
                            <label for="lastName">{{ __("Last name")}}</label>
                            <input type="text" name="lastName" id="lastName">
                            <br>
                            <label for="Email">{{ __("Email")}}</label>
                            <input type="text" name="Email" id="Email">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                {{ __("Close")}}
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
                        <h4 class="modal-title">{{ __("Are you sure you want to delete?")}}</h4>
                    </div>
                    @if(count($buildings) > 0)
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
                    @endif
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
@push('script')
    <?php use App\Http\Controllers\HomeController;
    use App\Building; ?>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&callback=initMap">
    </script>
    <script type="text/javascript">
        "use strict";
        $(document).ready(function () {
            $('#materialDropdown').parent().hide();

            $(document).on('click', '#toggleMaterial', function () {
                // ($('#materialDropdown').parent().is(':hidden')) ? $('#materialDropdown').parent().slideDown() : $('#materialDropdown').parent().slideUp();
                $('#materialDropdown').parent().slideToggle();
            });


            $('#functionDropdown').parent().hide();
            $(document).on('click', '#toggleFunction', function () {
                $('#functionDropdown').parent().slideToggle();
            });

            $('#locationDropdown').parent().hide();
            $(document).on('click', '#toggleLocation', function () {
                $('#locationDropdown').parent().slideToggle();
            });

            $('.js-example-basic-multiple').select2({
                theme: "material",
            });

            $(".select2-selection__arrow")
                .addClass("material-icons")
                .html("arrow_drop_down");

            $('#resetMaterial').on('click', function () {
                $('#materialDropdown').val(null).trigger("change");
            });
            $('#resetFunction').on('click', function () {
                $('#functionDropdown').val(null).trigger("change");
            });
            $('#resetFilters').on('click', function () {
                $('.js-example-basic-multiple').val(null).trigger("change");
            });
        });

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
                zoom: 8
            });
            let marker;
            let locationArray = [];
                @if(session('materialLocations'))
                @for($i=0; $i < (count( session('materialLocations') )); $i++)
            var location = {
                    lat: {!! HomeController::getLat(session('materialLocations')[$i]) !!},
                    lng: {!! HomeController::getLng(session('materialLocations')[$i]) !!}};
            locationArray.push(location);
            var icon = {
                url: '/images/map_pin_rood.svg', // url
                scaledSize: new google.maps.Size(40, 40), // scaled size
            }
            marker = new google.maps.Marker({
                position: locationArray['{{$i}}'],
                map: map,
                title: "Click to contact",
                icon: icon
            });
            google.maps.event.addListener(marker, 'click', function () {
                window.location.href = "overview/{!! session('buildIds')[$i] !!} ";
            });
                @endfor
                @else
                @for($i=0; $i < count( $locations ); $i++)
            var location = {
                    lat: {!! HomeController::getLat($locations[$i]) !!},
                    lng: {!! HomeController::getLng($locations[$i]) !!}};
            locationArray.push(location);
            var icon = {
                url: '/images/map_pin.svg', // url
                scaledSize: new google.maps.Size(40, 40), // scaled size
            }
            new google.maps.Marker({
                position: locationArray['{{$i}}'],
                map: map,
                title: "Own project",
                icon: icon
            });
            @endfor
            @endif
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
@endpush
