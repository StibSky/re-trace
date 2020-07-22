@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')

    <form action="{{ route('saveEdit') }}" method="post" name="substanceForm">
        @csrf
        <h3> ADD MATERIAL STREAMS</h3>
        <label> pick material
            <input placeholder="search here" type="text" name="filter" id="filterCategories"/>
            <select name="parent" id="categorySelect">
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
    </script>
@endsection
