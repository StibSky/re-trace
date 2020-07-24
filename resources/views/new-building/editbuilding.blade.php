@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/editbuilding.css') }}"
@endsection
@section('content')

    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <form action="{{ route('saveEdit') }}" method="post" name="substanceForm">
            @csrf
            <h3> ADD MATERIAL STREAMS for {{ $project->projectName }}</h3>
            <label>Pick material:
                <input placeholder="search here" type="text" name="filter" id="filterCategories"/>
                <input value="{{$buildingId}}" type="hidden" name="buildingId"/>
                <select name="substance" id="categorySelect">
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

            </label>
            <br>
            <label for="quantity">Quantity: </label>
                <input type="text" name="quantity" placeholder="insert quantity"/>
            <br>
            <button type="submit" id="submit-button" class="btn btn-primary" name="saveEdit">Submit</button>
        </form>

        @endsection
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
