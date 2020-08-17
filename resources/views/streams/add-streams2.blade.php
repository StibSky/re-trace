@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/create_project.css') }}">
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
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>What's the destination of your stream?</h4>
                <form action="{{ route('add-streams2', $id) }}" method="post" class="mt-5">
                    @csrf
                    <input placeholder="search here" type="text" name="filter" id="filterCategories"/>
                    <select name="category" id="categorySelect">
                        <option value="null" class="categoryOptions">PLEASE SELECT A DESTINATION</option>
                        <option value="destination1" class="categoryOptions">
                            destination 1
                        </option>

                        <option value="destination2" class="categoryOptions">
                            destination 2
                        </option>

                        <option value="destination3" class="categoryOptions">
                            destination 3
                        </option>

                    </select>
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
        $(document).ready(function () {
            $('#filterCategories').change(function () {
                var filter = $(this).val();
                $('.categoryOptions').each(function () {
                    if ($(this).text().toLowerCase().includes(filter.toLowerCase())) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                    $('#categorySelect').text().toLowerCase().includes(filter.toLowerCase());
                })
            })
        })
    </script></div>
@endsection
@endsection
