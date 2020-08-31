@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
@endsection
@section('content')
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>{{ __("Confirm input and add stream?") }}</h4>
                <table class="d-flex justify-content-center mt-5">
                    <tr>
                        <td>{{ __("Stream name") }}: {{ $stream->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Description: {{ $stream->description }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Destination: {{ $stream->category }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Materials") }}:
                            <ul>
                                @if($materialArray)
                                    @foreach($materialArray as $material)
                                        <li>{{ $material->name }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Function:
                            <ul>
                                @if($functionArray)
                                    @foreach($functionArray as $streamFunction)
                                        <li>{{ $streamFunction->name }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </td>

                    </tr>
                    <tr>
                        <td>{{ __("Quantity") }}: {{ $stream->quantity }} {{ $unit->short_name }}</td>
                    </tr>
                    <tr>
                        <td>{{__("Price")}}: {{ $valuta->symbol }}{{ $stream->price }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Action") }}: {{ $stream->action }}</td>
                    </tr>
                </table>
                <form action="{{ route('storeStream', $id) }}" method="post" class="mt-5">
                    @csrf
                    <button type="submit" id="main-button" class="btn btn-primary" name="confirm">{{ __("Create") }}</button>
                </form>
            </div>

            <div class="card-footer text-center">
                <a href="{{route('streams4', $id)}}"><span><strong>{{ __("Go Back") }}</strong></span></a>
            </div>
        </div>
    </div>
@endsection

