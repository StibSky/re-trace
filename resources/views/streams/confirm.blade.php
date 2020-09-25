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
                        <td>{{ __("Description") }}: {{ $stream->description }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Origin") }}: {{ $stream->category }}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Materials") }}:
                            <ul>
                                @if($materialArray)
                                    @foreach($materialArray as $material)
                                        @if(app()->getLocale() == 'en')
                                            <li>{{$material->name}}</li>
                                        @elseif(app()->getLocale() == 'nl')
                                            <li>{{$material->name_nl}}</li>
                                        @elseif(app()->getLocale() == 'fr')
                                            <li>{{$material->name_fr}}</li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>{{ __("Function")}}:
                            <ul>
                                @if($functionArray)
                                    @foreach($functionArray as $streamFunction)
                                        @if(app()->getLocale() == 'en')
                                            <li>{{$streamFunction->name}}</li>
                                        @elseif(app()->getLocale() == 'nl')
                                            <li>{{$streamFunction->name_nl}}</li>
                                        @elseif(app()->getLocale() == 'fr')
                                            <li>{{$streamFunction->name_fr}}</li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </td>

                    </tr>
                    <tr>
                        <td>{{ __("Quantity") }}: {{ $stream->quantity / 1000}} {{ $unit->short_name }}</td>
                    </tr>
                    <tr>
                        <td>{{__("Price")}}
                            : {{ $valuta->symbol }}{{ number_format($stream->price / 100, 2, ',', '.')}}</td>
                    </tr>
                    <tr>
                        <td>{{ __("Action") }}: {{ $stream->action }}</td>
                    </tr>
                </table>
                <form action="{{ route('storeStream', $id) }}" method="post" class="mt-5">
                    @csrf
                    <button type="submit" id="main-button" class="btn btn-primary"
                            name="confirm">{{ __("Create") }}</button>
                </form>
            </div>

            <div class="card-footer text-center">
                <a href="{{route('streams4', $id)}}"><span><strong>{{ __("Go Back") }}</strong></span></a>
            </div>
        </div>
    </div>
@endsection

