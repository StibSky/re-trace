@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <!--
blade for the specific user projects
uses dynamic linking
-->
    <div class="d-flex flex-lg-row flex-column align-items-stretch justify-content-center">
        <div class="col-12 col-lg-4 mr-lg-2 mr-xl-3 mx-auto px-0 align-self-stretch">
            <div class="row card" id="projectOverview">
                <div class="card-header">
                    <h5>{{ $project->projectName ?? 'Project name' }}</h5>
                </div>
                <div class="card-body mb-lg-2 mb-3">
                    <div class="row">
                        <figure class="d-flex flex-column col-12 col-lg-6">
                            <img class="mx-auto" id="projectPic" src="{{ asset('images/coolbuilding.jpg') }}">
                            <button type="button" id="main-button" class="btn btn-primary mt-3 mx-auto" name="editDash"
                                    data-toggle="modal"
                                    data-target="#editDashModal">{{ __("Edit")}}
                            </button>
                            <div id="editDashModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>

                                            <h4 class="modal-title">{{ __("Fill in the fields you want to edit")}},
                                                {{ __("Leave the fields empty if you don't want to change anything")}}
                                                <br>
                                                {{ __("To change street please fill in Name and Number")}}</h4>


                                        </div>
                                        <form action="{{ route('editDashInfo', $project->id) }}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="streetName">{{ __("Street name")}}</label>
                                                    <input type="text" name="streetName" id="streetName">
                                                    <br>
                                                    <label for="streetNumber">{{ __("Street number")}}"</label>
                                                    <input type="text" name="streetNumber" id="streetNumber">
                                                    <br>
                                                    <label for="city">{{ __("City")}}"</label>
                                                    <input type="text" name="city" id="City">
                                                    <br>
                                                    <label for="typeButtonSelect">{{ __("Type")}}</label>
                                                    <select name="type" id="typeButtonSelect" multiple>
                                                        <option
                                                            value="detached house">{{ __("Detached house")}}</option>
                                                        <option value="apartment">{{ __("Apartment")}}</option>
                                                        <option
                                                            value="terraced house">{{ __("Terraced house")}}</option>
                                                        <option
                                                            value="multiple houses">{{ __("Multiple houses")}}</option>
                                                        <option
                                                            value="commercial building">{{ __("Commercial building")}}</option>
                                                    </select>
                                                    <br>
                                                    <label for="buttonSelect">{{ __("Action")}}</label>
                                                    <select name="status"
                                                            id="buttonSelect"
                                                            multiple>
                                                        <option value="renovation">{{ __("Renovation")}}</option>
                                                        <option value="demolition">{{ __("Demolition")}}</option>
                                                        <option value="new Build">{{ __("New Build")}}</option>
                                                        <option value="nothing">{{ __("Nothing")}}</option>
                                                    </select>

                                                </div>
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

                            @if(Auth::user()->type == 'admin')
                                <button data-toggle="modal"
                                        data-target="#deleteModal" class="btn btn-primary mx-auto mt-1"
                                        name="deleteBuilding"
                                        id="main-button">Delete
                                </button>
                            @endif
                        </figure>
                        <div class="col-12 col-lg-6">
                            <ul>
                                <li>{{ __("Location")}}: {{ $project["address1"] }}
                                    <ul>
                                        <li>{{ $project["address2"] }}</li>
                                    </ul>
                                </li>
                                <li>{{ __("Type")}}: {{ $project["type"] }}</li>
                                <li>{{ __("Action")}}: {{ $project["status"] }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row card mt-lg-2 mt-3" id="projectInfo">
                <div class="card-header">
                    <h5>{{ __("Information")}}</h5>
                </div>
                <div class="card-body" id="infoOverview">{{--
                @if(count($projecttypes) == 0)
                    <h5> - Please add your first files to progress your profile</h5>
                @endif--}}
                    <ul>
                            <li class="d-flex flex-row  justify-content-between">
{{--                                <a href="{{route(str_replace(' ', '', $projecttype), $project->id)}}">{{ $projecttype }}</a>--}}
                            </li>
                    </ul>
                    <ul>
                        <li class="d-flex flex-row  justify-content-between">@if($projecttypes->contains("Measuring state"))
                                <a href="{{route(str_replace(' ', '', 'Measuring state'), $project->id)}}">{{ __("Measuring state")}}</a>
                                                                                 @else{{ __("Measuring state")}}
                        @endif</li>
                        <hr class="py-0 my-2">
                        <li class="d-flex flex-row  justify-content-between">@if($projecttypes->contains("Material list"))
                                <a href="{{route(str_replace(' ', '', 'Material list'), $project->id)}}">{{ __("Material list")}}</a>
                            @else{{ __("Material list")}}
                            @endif</li>
                        <hr class="py-0 my-2">
                        <li class="d-flex flex-row  justify-content-between">@if($projecttypes->contains("Plans"))
                                <a href="{{route(str_replace(' ', '', 'Plans'), $project->id)}}">{{ __("Plans")}}</a>
                            @else{{ __("Plans")}}
                            @endif</li>
                        <hr class="py-0 my-2">
                        <li class="d-flex flex-row  justify-content-between">@if($projecttypes->contains("Demolition plans"))
                                <a href="{{route(str_replace(' ', '', 'Demolition plans'), $project->id)}}">{{ __("Demolition plans")}}</a>
                            @else{{ __("Demolition plans")}}
                            @endif</li>
                        <hr class="py-0 my-2">
                        <li class="d-flex flex-row  justify-content-between">@if($projecttypes->contains("Photos exterior"))
                                <a href="{{route(str_replace(' ', '', 'Photos exterior'), $project->id)}}">{{ __("Photos exterior")}}</a>
                            @else{{ __("Photos exterior")}}
                            @endif</li>
                        <hr class="py-0 my-2">
                        <li class="d-flex flex-row  justify-content-between">@if($projecttypes->contains("Photos interior"))
                                <a href="{{route(str_replace(' ', '', 'Photos interior'), $project->id)}}">{{ __("Photos interior")}}</a>
                            @else{{ __("Photos interior")}}
                            @endif</li>
                        <hr class="py-0 my-2">
                    </ul>
                </div>
                <div class="card-footer" id="dashboard-footer2">
                    <button type="button" id="main-button" class="btn btn-primary" data-toggle="modal"
                            data-target="#myModal">
                        {{ __("Upload information")}}
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7 card mt-lg-0 mt-3 ml-lg-3 ml-xl-4 mx-auto px-0 align-self-stretch"
             id="waste-streams">
            <div class="card-header">
                <h5>{{ __("Waste Streams")}}</h5>
            </div>
            <div class="d-flex flex-row justify-content-between text-left" id="titleBar">
                <div class="column w-75"></div>
                <div class="column w-100"><p>{{ __("Stream")}}</p></div>
                <div class="column w-100"><p>{{ __("Action")}}</p></div>
                <div class="column w-50"><p>{{ __("Quantity")}}</p></div>
            </div>

            <div class="card-body" id="wasteStreams">
                @if(count($streams) > 0)
                    <ul>
                        @foreach($streams as $stream)
                            <li class="d-flex flex-row justify-content-between">
                                <div class="w-75">
                                    <img id="streamImage"
                                         src="{{\App\Http\Controllers\DashboardController::getStreamImage($stream->id)}}"/>
                                </div>
                                <strong class="w-100"><a
                                        href="{{route('streamView', $stream->id)}}">{{ $stream->name }}</a></strong>

                                <p class="w-100">{{$stream->action}}</p>
                                <p class="w-50">{{$stream->quantity / 1000}}                                 @foreach($units as $unit)
                                        @if($stream->unit_id == $unit[0]['id'])
                                            {{ $unit[0]['short_name'] }}
                                            @break
                                        @endif
                                    @endforeach</p>


                            </li>
                            <hr class="py-0 my-2">
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class=" card-footer" id="dashboard-footer3">
                <a class="btn btn-primary mt-3" id="main-button"
                   href="{{ route('streams1', $project->id) }}">{{ __("Add streams")}}</a>
            </div>
        </div>
    </div>
    {{--    <div class="card-body">
            <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="userfile"/>
                <input type="submit" value="upload"/>
            </form>
        </div>--}}
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">{{ __("Please upload a new file or image")}}</h4>

                </div>
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name">
                        <input type="file" name="userfile">
                        <br>
                        <label for="type">{{ __("Select file type")}}:</label>
                        <select name="type">
                            <option value="Measuring state">{{ __("Measuring state")}}</option>
                            <option value="Material list">{{ __("Material list")}}</option>
                            <option value="Plans">{{ __("Plans")}}</option>
                            <option value="Demolition plans">{{ __("Demolition plans")}}</option>
                            <option value="Photos exterior">{{ __("Photos exterior")}}</option>
                            <option value="Photos interior">{{ __("Photos interior")}}</option>
                        </select>
                        <input value="{{ $project->id }}" type="hidden" name="projectId"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Close")}}
                        </button>
                        <input type="submit" value="upload" name="upload"/>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div id="deleteModal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-left">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X
                    </button>
                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                </div>
                <form action="{{ route('deleteBuilding', $project) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <button value="{{ $project->id }}" class="btn btn-primary"
                                name="deleteBuilding" id="main-button">Yes, delete project
                        </button>
                        <button type="button" class="btn btn-default" id="secondary-button-small"
                                data-dismiss="modal">No
                        </button>
                    </div>
                    <div class="modal-footer">

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--            <h4 style="width:50%; margin-left: auto; margin-right: auto; margin-top: 3em">upload first files to progress
                    profile</h4>
                <div class="progress" style="margin-left: auto; margin-right: auto; margin-top: 1em; width: 50%">
                    <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100" style="width:25%" ;
                    >
                        25% Completed Profile
                    </div>
                </div>--}}

@endsection
