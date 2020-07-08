@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-6 card p-2 mx-2">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <img src="{{ asset('images/kaora.jpeg') }}" class="img-circle" alt="">
                    </div>
                    <div class="col">
                        <div class="card-block px-2">
                            <h4 class="card-title">Welcome {{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 mx-2">
                <div class="row">
                    <div class="col-12 card">
                        <a id="newBuilding" href="{{ route('building') }}">add New Project</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 card">
                        3
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
