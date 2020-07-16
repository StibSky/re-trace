@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <form action="{{ route('saveAdmin') }}" method="post">
            @csrf
            <h2>Basic Info</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Stonelike materials">
            </div>
            <div class="form-group">
                <label for="name_nl">Nederlandse Naam</label>
                <input type="text" class="form-control" name="name_nl"
                       placeholder="Steenachtige materialen">
            </div>
            <div class="form-group">
                <label for="name_fr">Franse naam</label>
                <input type="text" class="form-control" name="name_fr"
                       placeholder="Matériaux pierreux">
            </div>
            <div class="form-group">
                <label for="type">Specific weight</label>
                <input type="text" class="form-control" id="type" name="specific_weight"
                       placeholder="if applicable">
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
                <div class="form-group col-md-6">
                    <label for="is_hazardous">Is hazardous:</label>
                    <select name="is_hazardous" id="is_hazardous">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" id="code" name="code"
                           placeholder="1701">
                </div>
                <div class="form-group">
                    <label for="type">Comments</label>
                    <input type="text" class="form-control" id="type" name="type"
                           placeholder="if applicable">
                </div>
            </div>
            <h2>Select Parent</h2>
            <label>
                <select name="parent">
                    <option value="{{ null }}">
                        NO PARENT/NEW CATEGORY
                    </option>
                    @foreach($headCategories as $headCategory)



                            <option value="{{ $headCategory->id }}">
                                {{ $headCategory->code . " " .$headCategory->name }}
                            </option>

                    @endforeach
                    @foreach($subCategories1 as $subCategory1)

                            <option value="{{ $subCategory1->id }}">
                                ---{{$subCategory1->code . " " .$subCategory1->name }}
                            </option>

                    @endforeach
                    @foreach($subCategories2 as $subCategory2)

                            <option value="{{ $subCategory2->id }}">
                                ------{{ $subCategory2->code . " " .$subCategory2->name }}
                            </option>

                    @endforeach


                </select>
            </label>

            <button type="submit" id="add-button" class="btn btn-primary" name="addSubstance">Submit</button>
        </form>
    </div>
@endsection
@section('script')

@endsection
