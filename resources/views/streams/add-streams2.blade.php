@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/add_streams.css') }}">
@endsection
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>ADD NEW STREAM</h3>
        <div class="card d-flex justify-content-center" id="set-width">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>What's the origin of your stream?</h4>
                <form action="{{ route('add-streams2', $id) }}" method="post" class="mt-5">
                    @csrf
                    <div class="radio-toolbar">
                        <input type="radio" id="radioApple" name="category" value="Production surplus">
                        <label for="radioApple">Production surplus</label>

                        <input type="radio" id="radioBanana" name="category" value="Overstock">
                        <label for="radioBanana">Overstock</label>

                        <input type="radio" id="radioOrange" name="category" value="Construction and demolition waste">
                        <label for="radioOrange">Construction and demolition waste</label>
                    </div>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newStream">Next</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('streams1', $id) }}"><span><strong>Go Back</strong></span></a>
            </div>
        </div>
    </div>
@section('script')
    <script type="text/javascript">
        $("#btn1").click(function () {
            $(this).css("border-style", "inset")
            $("#btn2").css("border-style", "outset;");
            $("#btn3").css("border-style", "outset;");
            $("btnValue").val("Production surplus");
        });
        $("#btn2").click(function () {
            $(this).css("border-style", "inset")
            $("#btn1").css("border-style", "outset;");
            $("#btn3").css("border-style", "outset;");
            $("btnValue").val("Overstock");
        });
        $("#btn3").click(function () {
            $(this).css("border-style", "inset")
            $("#btn1").css("border-style", "outset;");
            $("#btn2").css("border-style", "outset;");
            $("btnValue").val("Construction and demolition waste");
        });
    </script>
@endsection
@endsection
