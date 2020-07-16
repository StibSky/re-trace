@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container">
        <form action="{{ route('saveAdmin') }}" method="post">
            @csrf
            <h2>Select Parent</h2>
            <label>
                <select>
                    @foreach($headCategories as $headCategory)



                            <option>
                                {{ $headCategory->code . " " .$headCategory->name }}
                            </option>

                    @endforeach
                    @foreach($subCategories1 as $subCategory1)

                            <option>
                                ---{{$subCategory1->code . " " .$subCategory1->name }}
                            </option>

                    @endforeach
                    @foreach($subCategories2 as $subCategory2)

                            <option>
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
                <input type="text" class="form-control" id="type" name="type"
                       placeholder="if applicable">
            </div>
            <div class="form-group">
                <label for="type">Comments</label>
                <input type="text" class="form-control" id="type" name="type"
                       placeholder="if applicable">
            </div>


            <button type="submit" id="add-button" class="btn btn-primary" name="addSubstance">Submit</button>
        </form>
    </div>
@endsection
@section('script')

@endsection
