@extends('layouts.app')

@section('content')
    <form action="{{ route('checkpass') }}" method="post" name="checkPass">
    @csrf
        <label for="adminpassword">password</label>
        <input type="text" class="form-control" name="adminpassword" id="adminpassword">
        <button type="submit" id="add-button" class="btn btn-primary" name="submitPass">Submit pass</button>
    </form>
@endsection
