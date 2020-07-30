@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <!--
blade for the specific user projects
uses dynamic linking
-->
    <div class="container">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="d-flex flex-lg-row flex-column align-items-center">
            <div class="col-12 col-md-6 col-lg card p-4">
                <div class="card-title">
                    <h4>{{ $project->projectName ?? 'Project name' }}</h4>
                </div>
                <figure><img class="w-100"
                             src="{{ $image->image ?? asset('images/coolbuilding.jpg') }}">
                </figure>
                <p>Type: {{ $project["type"] }}</p>
                <button type="button" id="main-button" class="btn btn-primary" data-toggle="modal"
                        data-target="#myModal">
                    Upload files
                </button>
                <a id="main-button" class="btn btn-primary"
                   href="{{route('viewFiles', $project->id)}}"> View files</a>
                <a class="btn btn-primary mt-3" id="secondary-button"
                   href="{{ route('addstreams', $project->id) }}">Add streams</a>
            </div>
            <div class="col-12 col-md-6 col-lg card p-4">
                <h4>Information</h4>
                <ul>
                    <li>Location: {{ $project["address1"] }}
                        <ul>
                            <li>{{ $project["address2"] }}</li>
                        </ul>
                    </li>
                    {{--                    <li>Measuring State</li>
                                        <li>Material list</li>
                                        <li>Surface</li>
                                        <li>Plans</li>
                                        <li>Pictures</li>--}}
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg card p-4">
                <h4>Waste Streams</h4>
                @if(count($buildingSubstances) > 0)
                    <ul>
                        @foreach($buildingSubstances as $buildingSubstance)
                            <li>{{ $buildingSubstance[0]['name'] }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    {{--    <div class="card-body">
            <form action="{{ route('upload') }}"method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="userfile" />
                <input type="submit" value="upload"/>
            </form>
        </div>--}}
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Please upload a new file or image</h4>

                </div>
                <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{--                        <input type="text" name="name">--}}
                        <input type="file" name="userfile">
                        <input type="text" name="name">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" value="upload" name="upload"/>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <h4 style="width:50%; margin-left: auto; margin-right: auto; margin-top: 3em">upload first files to progress
        profile</h4>
    <div class="progress" style="margin-left: auto; margin-right: auto; margin-top: 1em; width: 50%">
        <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" aria-valuenow="25"
             aria-valuemin="0" aria-valuemax="100" style="width:25%";
        >
            25% Completed Profile
        </div>
    </div>


@endsection
