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
        <div class="col-12 col-lg-6 mr-lg-2 mr-xl-3 mx-auto px-0 align-self-stretch">
            <div class="row card" id="projectOverview">
                <div class="card-header">
                    <h4>{{ $project->projectName ?? 'Project name' }}</h4>
                </div>
                <div class="card-body mb-lg-2 mb-3">
                    <div class="row">
                        <figure class="d-flex flex-column col-12 col-lg-6">
                            <img class="mx-auto" id="projectPic" src="{{ asset('images/coolbuilding.jpg') }}">
                            <button type="button" id="main-button" class="btn btn-primary mt-3 mx-auto">Edit
                            </button>
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
                                <li>Location: {{ $project["address1"] }}
                                    <ul>
                                        <li>{{ $project["address2"] }}</li>
                                    </ul>
                                </li>
                                <li>Type: {{ $project["type"] }}</li>
                                <li>Action: {{ $project["status"] }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row card mt-lg-2 mt-3" id="projectInfo">
                <div class="card-header">
                    <h4>Information</h4>
                </div>
                <div class="card-body" id="infoOverview">{{--
                @if(count($projecttypes) == 0)
                    <h5> - Please add your first files to progress your profile</h5>
                @endif--}}
                    <ul>
                        @foreach($projecttypes as $projecttype)
                            <li class="d-flex flex-row  justify-content-between">
                                <a href="{{route(str_replace(' ', '', $projecttype), $project->id)}}">{{ $projecttype }}</a>
                            </li>
                            <hr class="py-0 my-2">
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer" id="dashboard-footer2">
                    <button type="button" id="main-button" class="btn btn-primary" data-toggle="modal"
                            data-target="#myModal">
                        Upload information
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 card mt-lg-0 mt-3 ml-lg-3 ml-xl-4 mx-auto px-0 align-self-stretch" id="waste-streams">
            <div class="card-header">
                <h4>Waste Streams</h4>
            </div>
            <div class="card-body">
                @if(count($streams) > 0)
                    <ul>
                        @foreach($streams as $stream)
                            <li>{{ $stream->name }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class=" card-footer" id="dashboard-footer3">
                <a class="btn btn-primary mt-3" id="main-button"
                   href="{{ route('streams1', $project->id) }}">Add streams</a>
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
                    <h4 class="modal-title">Please upload a new file or image</h4>

                </div>
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="text" name="name">
                        <input type="file" name="userfile">
                        <br>
                        <label for="type">Select file type:</label>
                        <select name="type">
                            <option value="Measuring state">Measuring state</option>
                            <option value="Location">Location</option>
                            <option value="Surface">Surface</option>
                            <option value="Volume">Volume</option>
                            <option value="Material list">Material list</option>
                            <option value="Plans">Plans</option>
                            <option value="Photos exterior">Photos exterior</option>
                            <option value="Photos interior">Photos interior</option>
                        </select>
                        <input value="{{ $project->id }}" type="hidden" name="projectId"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
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
