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
                <h4>Which materials are in your stream?</h4>
                <form action="{{ route('add-streams3', $id) }}" method="post" class="mt-5">
                    @csrf
                    <input placeholder="search here" type="text" name="filter" id="filterCategories"/>
                    <select name="substance" id="categorySelect" multiple>
                        <option selected disabled class="categoryOptions">PLEASE SELECT A MATERIAL</option>
                        @foreach($headCategories as $headCategory)
                            <option value="{{ $headCategory->id }}" class="categoryOptions">
                                {{ $headCategory->code . " " .$headCategory->name }}
                            </option>
                        @endforeach
                        @foreach($subCategories1 as $subCategory1)

                            <option value="{{ $subCategory1->id }}" class="categoryOptions">
                                ---{{$subCategory1->code . " " .$subCategory1->name }}
                            </option>

                        @endforeach
                        @foreach($subCategories2 as $subCategory2)

                            <option value="{{ $subCategory2->id }}" class="categoryOptions">
                                ------{{ $subCategory2->code . " " .$subCategory2->name }}
                            </option>

                        @endforeach
                    </select>
                    <button type="submit" id="main-button-wide" class="btn btn-primary" name="newStream">Next</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('streams2', $id) }}"><span><strong>Go Back</strong></span></a>
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
