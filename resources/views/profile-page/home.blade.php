@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-6 px-2 card" id="userInfo" style="background-color: rgb(243,191,186)">
                <div class="row no-gutters d-flex">
                    <div class="col-auto d-flex flex-center pl-4 pt-4">
                        <img src="{{ asset('images/coolbuilding.jpg') }}" class="img-circle" alt="">
                    </div>
                    <div class="col-4 d-flex flex-center">
                        <div>
                            <h4>Hi {{ Auth::user()->first_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters d-flex">
                    <div class="col-12 d-flex pl-4 pt-4">
                        <p>this is placeholder text for your building info, you can edit this later.</p>
                    </div>
                  <!--  <a href="{{route('updateBuilding')}}">Edit information</a> -->
                </div>
            </div>
            <div class="col-6 float-right">
                <div class="row">
                    <div class="col-12 p-2 card d-flex" id="newProject" style="background-color: rgb(187,206,205)">
                        <a id="newBuilding" href="{{ route('building') }}"><h4>Add New Project</h4></a>
                        <ul>
                            @foreach($buildings as $building)
                                <li>
                                    <a href="{{route('dash', $building->id)}}"> {{ $building->address1 }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-2 card" id="newSearch" style="background-color: rgb(187,206,205)">
                        <form class="example" action="action_page.php">
                            <label>
                                <input type="text" placeholder="Search.." name="search">
                            </label>
                            <button type="submit"><i class="fa fa-search"> submit</i></button>
                        </form>
                        <ul>

                            @foreach($substances as $substance)
                                <li>
                                    <p> {{ $substance->name }}</p>
                                    <p> {{$substance->comments}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
