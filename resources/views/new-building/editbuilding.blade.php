@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')

    <div class="container">
        <form action="{{ route('saveEdit') }}" method="post" name="substanceForm">
            @csrf
            <h3> ADD MATERIAL STREAMS</h3>
            <label> pick material
                <input placeholder="search here" type="text" name="filter" id="filterCategories"/>
                <input value="{{$buildingId}}" type="hidden" name="buildingId"/>
                <select name="material" id="categorySelect">
                    @foreach($headCategories as $headCategory)
                        <option value="{{ $headCategory->name }}" class="categoryOptions">
                            {{ $headCategory->code . " " .$headCategory->name }}
                        </option>
                    @endforeach
                    @foreach($subCategories1 as $subCategory1)

                        <option value="{{ $subCategory1->name }}" class="categoryOptions">
                            ---{{$subCategory1->code . " " .$subCategory1->name }}
                        </option>

                    @endforeach
                    @foreach($subCategories2 as $subCategory2)

                        <option value="{{ $subCategory2->name }}" class="categoryOptions">
                            ------{{ $subCategory2->code . " " .$subCategory2->name }}
                        </option>

                    @endforeach
                </select>
            </label>
            <br>
            <button type="submit" id="add-button" class="btn btn-primary" name="saveEdit">Submit</button>
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
