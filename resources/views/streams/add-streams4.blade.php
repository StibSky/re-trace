@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/add_streams.css') }}">
@endsection
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __("ADD NEW STREAM") }}</h3>
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>{{ __("Please give the quantity and unit of your stream") }}</h4>
                <form action="{{ route('add-streams4', $id) }}" method="post" class="mt-5">
                    @csrf
                    <div class="form-row d-flex align-items-center justify-content-between">
                        <h5>€</h5>
                        <div class="form-group">
                            <label for="streamPrice" class="sr-only">{{ __("Price") }}:</label>
                            <input type="text" class="form-control text-center" id="streamPrice"
                                   name="streamPrice"
                                   placeholder="{{ __("PRICE") }}"
                                   value="@if(app()->getLocale() == "en"){{ number_format((session()->get('stream.price') /100), 2, '.', ',')  }}@else{{ number_format((session()->get('stream.price') /100), 2, ',', '.') }}@endif">
                        </div>
                        <div class="form-group">
                            <label for="total" class="sr-only">{{ __("Total") }}:</label>
                            <input type="text" name="total" id="total" placeholder="{{ __("TOTAL") }}" class="text-center" style="color: black" disabled>
                        </div>
                        <div class="form-group">
                            <label for="streamQuantity" class="sr-only">{{ __("Quantity") }}:</label>
                            <input type="text" class="form-control text-center" id="streamQuantity"
                                   name="streamQuantity"
                                   placeholder="QUANTITY" value="{{ session()->get('stream.quantity') /1000 }}">
                        </div>
                        <div class="form-group">
                            <label for="streamUnit" class="sr-only">{{ __("Unit") }}:</label>
                            <select name="streamUnit" id="streamUnit" class="custom-select text-center">
                                <option selected disabled>
                                    {{ __("UNIT") }}
                                </option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}">
                                        @if(app()->getLocale() == "en")
                                            {{ $unit->name }}
                                        @elseif(app()->getLocale() == "fr")
                                            {{ $unit->name_fr }}
                                        @elseif(app()->getLocale() == "nl")
                                            {{ $unit->name_nl }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
{{--                        <div class="form-group">
                            <label for="streamUnit" class="sr-only">{{ __("Valuta") }}:</label>
                            <select name="streamValuta" id="streamValuta">
                                <option selected disabled>
                                    {{ __("PLEASE SELECT A CURRENCY") }}
                                </option>
                                @foreach($valutas as $valuta)
                                    <option value="{{ $valuta->id }}">
                                        {{ $valuta->symbol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>--}}
                    </div>
                    <button type="submit" id="main-button" class="btn btn-primary"
                            name="newStream">{{ __("Next") }}</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{route('streams3', $id)}}"><span><strong>{{ __("Go Back") }}</strong></span></a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            qty = $("#streamQuantity")
            qty.keyup(function(){
                var locale = $('html').attr('lang');
                var ennumber = $("#streamPrice").val()
                var globalnumber = ennumber.replace(",", ".")
                var globalqty = qty.val().replace(",", ".")
                var number = locale === 'en' ? ennumber : globalnumber
                var streamquant = locale === 'en' ? qty.val() : globalqty
                var subtotal= streamquant * number
                console.log(subtotal)
                var inttotal= (Math.round(subtotal * 100) / 100)
                var entotal = inttotal.toFixed(2)
                var globaltotal = entotal.replace(".", ",")
                var total= locale === 'en' ? entotal : globaltotal
                $("#total").val(total);
            });
        });
    </script>
@endsection
