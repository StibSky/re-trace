@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
    <h3>private users</h3>

    @foreach($privates as $private)
        <h5>Username: "{{$private->first_name}}"</h5>
        <i>projects</i>
        @if(count($privateBuildings[0]) > 0)
            <ul>
                @foreach($privateBuildings as $privateBuilding)
                   @for($i = 0; $i < count($privateBuilding); $i++)
                        @if($private->id ==$privateBuilding[$i]['userid'] )

                        <li>projectName: " <a
                                href="{{route('dash', $privateBuilding[$i]->id)}}">{{ $privateBuilding[$i]['projectName'] }}</a>
                            " <br> type:
                            "{{$privateBuilding[$i]['type']}}"
                        </li>
                        @endif
                    @endfor
                @endforeach
            </ul>
        @endif
    @endforeach
    <h3>business users</h3>
    @foreach($businesses as $business)
        <h5>Username: "{{$business->first_name}}"</h5>
        <i>projects</i>
        @if(count($businessBuildings[0]) > 0)
            <ul>
                @foreach($businessBuildings as $businessBuilding)
                    @for($i = 0; $i < count($businessBuilding); $i++)
                        @if($business->id ==$businessBuilding[$i]['userid'] )
                        <li>projectName: "<a
                                href="{{route('dash', $businessBuilding[$i]->id)}}">{{ $businessBuilding[$i]['projectName'] }} </a>"
                            <br> type:
                            "{{$businessBuilding[$i]['type']}}"
                        </li>
                        @endif
                    @endfor
                @endforeach
            </ul>
        @endif
    @endforeach
@endsection
