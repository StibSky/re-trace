@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <!--
   blade for admin page completely used to fill in the substance database
   makes use of jquery for custom dropdown menu
-->
    <form action="{{ route('saveadminfunctions') }}" method="post" name="substanceForm">
        @csrf
        <h2>Basic Info</h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Bathroom Tiles"
                   value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="name_nl">Nederlandse Naam</label>
            <input type="text" class="form-control" name="name_nl" value="{{old('name_nl')}}"
                   placeholder="Badkamertegels">
        </div>
        <div class="form-group">
            <label for="name_fr">Franse naam</label>
            <input type="text" class="form-control" name="name_fr" value="{{old('name_fr')}}"
                   placeholder="Carreaux sale de bains">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="unit_id">Unit ID:</label>
                <select name="unit_id" id="unit_id">
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <?php use App\Http\Controllers\MaterialFunctionController;
        use App\Building; ?>
        <h2>Select Parent</h2>
        <label>
            <input type="text" name="filter" id="filterCategories"/>
            <select name="parent" id="categorySelect">
                <option value="{{ null }}" class="headCategory">
                    NO PARENT/NEW CATEGORY
                </option>
                @foreach($tree as $node)
                    <option value="{{$node['id']}}" class="categoryOptions">
                        {{\App\Http\Controllers\MaterialFunctionController::getNameFunction( $node['id'])}}
                    </option>
                    @if($node['children'] != null)
                        @for($i =0; $i < count($node['children']); $i++)
                            <option value="{{$node['children'][$i]['id']}}" class="categoryOptions">
                                --{{\App\Http\Controllers\MaterialFunctionController::getNameFunction($node['children'][$i]['id'])}}
                            </option>
                            @if($node['children'][$i]['children'] !=null)
                                @for($j =0; $j < count($node['children'][$i]['children']); $j++)
                                    <option value="{{$node['children'][$i]['children'][$j]['id']}}" class="categoryOptions">
                                        ----{{\App\Http\Controllers\MaterialFunctionController::getNameFunction($node['children'][$i]['children'][$j]['id'])}}
                                    </option>
                                @endfor
                            @endif
                        @endfor
                    @endif
                @endforeach
            </select>
        </label>

        <button type="submit" id="add-button" class="btn btn-primary" name="addMaterialFunction">Submit</button>
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
