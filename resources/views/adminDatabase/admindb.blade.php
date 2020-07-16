@extends('layouts.app')
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <div class="container">
        <form action="{{ route('saveAdmin') }}" method="post">
            @csrf
            <h2>New head category</h2>
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
            <div class="form-group">
                <label for="projectName">Add new head category:</label>
                <input type="text" class="form-control" name="name" placeholder="Stonelike materials">
            </div>
            <div class="form-group">
                <label for="inputAddress">Voeg nieuwe hoofdcategorie toe:</label>
                <input type="text" class="form-control" name="name_nl"
                       placeholder="Steenachtige materialen">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Ajoutez nouvelle catégorie principale:</label>
                <input type="text" class="form-control" name="name_fr"
                       placeholder="Matériaux pierreux">
            </div>
            <div class="form-group">
                <label for="projectImage">Add new code:</label>
                <input type="text" class="form-control" id="projectImage" name="code"
                       placeholder="1701">
            </div>
            <h2>Address</h2>
            <div class="form-group">
                <label for="type">Specific weight</label>
                <input type="text" class="form-control" id="type" name="type"
                       placeholder="if applicable">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City:</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPostCode">Post code:</label>
                    <input type="text" class="form-control" id="inputPostCode" name="inputPostCode">
                </div>
            </div>
            <br>
            <button type="submit" id="add-button" class="btn btn-primary" name="addSubstance">Submit</button>
        </form>
    </div>
@endsection
@section('script')

@endsection
