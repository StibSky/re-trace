@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <div class="d-flex justify-content-center">
        <div class="card w-50 mt-0 h-100">
            <div class="card-header h-100 text-center"><h1>{{$name}}</h1></div>
            <div class="card-body">
                <p><strong>{{ __("Description") }}:</strong> {{$description}}</p>
                <p><strong>{{ __("Origin") }}:</strong> {{$category}}</p>
                <p><strong>{{ __("Category") }}:</strong> {{$action}}</p>
                <p><strong>{{ __("Quantity") }}:</strong> {{$quantity / 1000}} {{$unit}} </p>
                <p><strong>{{ __("Price") }}:</strong> {{$price / 100}}{{$valuta}}</p>
                <p><strong>{{ __("Materials") }}:</strong></p>
                @foreach($materials as $material)
                    <p>
                        @if(app()->getLocale() == 'en')
                            {{$material->name}}
                        @elseif(app()->getLocale() == 'nl')
                            {{$material->name_nl}}
                        @elseif(app()->getLocale() == 'fr')
                            {{$material->name_fr}}
                        @endif
                    </p>
                @endforeach
                <p><strong>{{ __("Functions") }}:</strong></p>
                @foreach($functions as $function)
                    @if(app()->getLocale() == 'en')
                        {{$function->name}}
                    @elseif(app()->getLocale() == 'nl')
                        {{$function->name_nl}}
                    @elseif(app()->getLocale() == 'fr')
                        {{$function->name_fr}}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
