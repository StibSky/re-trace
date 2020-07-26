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
        <div class="d-flex flex-lg-row flex-column align-items-center">
            <div class="col-12 col-md-6 col-lg card p-4">
                <div class="card-title">
                    <h4>{{ $project->projectName ?? 'Project name' }}</h4>
                </div>
                <figure><img class="w-100"
                             src="{{ $image->image ?? asset('images/coolbuilding.jpg') }}">
                </figure>
                <p>Type: {{ $project["type"] }}</p>
                <button type="button" id="add-button" class="btn btn-primary" data-toggle="modal"
                        data-target="#myModal">
                    Upload files
                </button>
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
{{--    <div id="myModal" class="modal fade">
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
    </div>--}}

@endsection
