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
        <div class="row">
            <div class="col-sm card p-4">
                <h3>{{ $project->projectName ?? 'Project name' }}</h3>
                <figure><img width="200em" height="200em" src="{{ $image->image ?? asset('images/coolbuilding.jpg') }}"></figure>
                <p>Type: {{ $project["type"] }}</p>
                <p>Here will come the information about your project.</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Upload more files or images
                </button>
            </div>
            <div class="col-sm card p-4">
                <h3>Information</h3>
                <ul>
                    <li>Location:
                        <ul>
                    <li>{{ $project["address1"] }}</li>
                    <li>{{ $project["address2"] }}</li>
                    </ul>
                    </li>
                    <li>Measuring State</li>
                    <li>Material list</li>
                    <li>Surface</li>
                    <li>Plans</li>
                    <li>Pictures</li>
                </ul>
            </div>
            <div class="col-sm card p-4">
                <h3>Material Streams</h3>
            </div>
                <div class="col-sm card p-4">

                    <h3>Waste Streams</h3>
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
                        <input type="file" name="userfile">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" value="upload"/>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
