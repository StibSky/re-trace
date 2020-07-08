@extends('layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 card" id="userInfo">
                <div class="row d-flex">
                    <div class="col-8 d-flex flex-center align-items-center">
                        <img src="{{ asset('images/coolbuilding.jpg') }}" alt="">
                    </div>
                    <div class="col-4 d-flex flex-center">
                        <div>
                            <h4>Hi {{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 float-right">
                <div class="row">
                    <div class="col-12 p-2 card d-flex flex-center" id="newProject">
                        <a id="newBuilding" href="{{ route('building') }}">add New Project</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-2 card" id="newSearch">
                        3
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
