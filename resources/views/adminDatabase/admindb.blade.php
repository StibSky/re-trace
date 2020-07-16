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
                    <label for="inputCity">Unit ID:</label>
                    <input type="text" class="form-control" id="inputCity" name="unit_id">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPostCode">Is hazardous:</label>
                    <input type="text" class="form-control" id="inputPostCode" name="is_hazardous">
                </div>
                <div class="form-group">
                    <label for="headCode">Code</label>
                    <input type="text" class="form-control" id="headCode" name="code"
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
                    <option value="0">
                        ----
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
            <h3>OR</h3>
            <h2>Make new head category</h2>
            <div class="form-group">
                <label for="headName">Name</label>
                <input type="text" class="form-control" name="headName" placeholder="Stonelike materials">
            </div>
            <div class="form-group">
                <label for="headName_nl">Nederlandse Naam</label>
                <input type="text" class="form-control" name="headName_nl"
                       placeholder="Steenachtige materialen">
            </div>
            <div class="form-group">
                <label for="headName_fr">Franse naam</label>
                <input type="text" class="form-control" name="headName_fr"
                       placeholder="Matériaux pierreux">
            </div>
            <div class="form-group">
                <label for="headCode">Code</label>
                <input type="text" class="form-control" id="headCode" name="headCode"
                       placeholder="1701">
            </div>

            <button type="submit" id="add-button" class="btn btn-primary" name="addSubstance">Submit</button>
        </form>
    </div>
@endsection
@section('script')

@endsection
