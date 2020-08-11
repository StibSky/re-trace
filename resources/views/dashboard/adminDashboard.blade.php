@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
    <h2 style="color: red">private users</h2>

    @foreach($privates as $private)
        <h5 style="color: blue">Username: "{{$private->first_name}}"</h5>
        @if(count($privateBuildings[0]) > 0)
            <ul>
                @foreach($privateBuildings as $privateBuilding)
                    @for($i = 0; $i < count($privateBuilding); $i++)
                        @if($private->id ==$privateBuilding[$i]['userid'] )

                            <li> <strong>projectName: </strong> " <a
                                    href="{{route('dash', $privateBuilding[$i]->id)}}">{{ $privateBuilding[$i]['projectName'] }}</a>
                                "<br>

                                @if(DB::table('uploaded_file')->where('projectId', $privateBuilding[$i]->id)->first() != null)
                                This user has files: "<a
                                    href="{{route('viewFiles', $privateBuilding[$i]->id)}}">Files</a>"
                                    <br>
                                @endif
                                 type:
                                "{{$privateBuilding[$i]['type']}}"
                            </li>
                        @endif
                    @endfor
                @endforeach
            </ul>
        @endif
    @endforeach
    <h2 style="color: red">business users</h2>
    @foreach($businesses as $business)
        <h5 style="color: blue">Username: "{{$business->first_name}}"</h5>
        @if(count($businessBuildings[0]) > 0)
            <ul>
                @foreach($businessBuildings as $businessBuilding)
                    @for($i = 0; $i < count($businessBuilding); $i++)
                        @if($business->id ==$businessBuilding[$i]['userid'] )
                            <li><strong>projectName: </strong> "<a
                                    href="{{route('dash', $businessBuilding[$i]->id)}}">{{ $businessBuilding[$i]['projectName'] }} </a>"

                                @if(DB::table('uploaded_file')->where('projectId', $businessBuilding[$i]->id)->first() != null)
                                    <strong style="color: green">This user has files: </strong> "<a
                                    href="{{route('viewFiles', $businessBuilding[$i]->id)}}">Files page </a>"
                                @endif
                                <br>
                                 type:
                                "{{$businessBuilding[$i]['type']}}"
                            </li>
                        @endif
                    @endfor
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection
