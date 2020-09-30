@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/stream_overview.css') }}">
@endsection
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-lg-5 card w-50 mt-0 mx-4">
            <div class="card-header text-center" style="visibility: hidden"><h1 style="color: #DBDFE9">Image</h1></div>
            <div class="card-body mx-auto">
                <img src="{{ $targetFile ? $image_data : asset('images/logos/resquare.png')}}" alt="stream image here" id="streamOverviewImage">
            </div>
        </div>
        <div class="col-12 col-lg-5 card w-50 mt-2 mt-lg-0 mx-4 px-0">
            <div class="card-header text-center"><h1>{{$name}}</h1></div>
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
