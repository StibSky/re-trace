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
                        </figure>
                        <div class="col-12 col-lg-6">
                            <ul>
                                <li>{{ __("Name contact")}}: {{ $user->first_name }} {{ $user->last_name }}
                                </li>
                                <li>{{ __("Type")}}: {{ $project["type"] }}</li>
                                <li>{{ __("Action")}}: {{ $project["status"] }}</li>
                            </ul>
                        </div>
                    </div>
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
                                <p class="w-50">{{$stream->quantity / 1000}}
                                    @foreach($units as $unit)
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
        </div>
    </div>

@endsection
