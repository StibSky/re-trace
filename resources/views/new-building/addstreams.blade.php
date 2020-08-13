@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')

    <div class="container">
        <form action="{{ route('saveEdit') }}" method="post" name="substanceForm">
            @csrf
            <h3> ADD MATERIAL STREAMS for {{ $project->projectName }}</h3>
            <div class="form-group">
                <label for="title">Title</label>
                <label>
                    <input type="text" class="form-control" name="title" placeholder="project title"
                           value="{{old('title')}}">
                </label>
            </div>
            <div class="form-group">
                <label for="description">description</label>
                <input type="textarea" class="form-control" name="description" placeholder="project description"
                       value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="description">desciprtion</label>
                <input type="textarea" class="form-control" name="description" placeholder="project description"
                       value="{{old('name')}}">
            </div>
            <label>Label 2:
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
            <button type="submit" id="main-button" class="btn btn-primary" name="saveEdit">Submit</button>
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
