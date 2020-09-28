@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/add_streams.css') }}">
@endsection
@section('head-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                <h4>{{ __("Please give the price, quantity and unit of your stream") }}</h4>
                <form action="{{ route('add-streams4', $id) }}" method="post" class="mt-5" id="priceForm">
                    @csrf
                    <div class="form-row d-flex flex-row justify-content-between flex-nowrap">
                        {{--Gewenste prijs per éénheid en gratis filter checkbox--}}
                        <div class="form-group d-flex flex-column">
                            <label for="streamPrice" class="text-center"><strong>{{ __("Wanted price per unit") }}</strong></label>
                            <input type="text" class="form-control" id="streamPrice"
                                   name="streamPrice"
                                   placeholder="€ {{ __("PRICE") }}"
                                   value="@if(app()->getLocale() == "en" && number_format(session()->get('stream.price')) > 0){{ number_format((session()->get('stream.price') /100), 2, '.', ',')  }}@elseif (number_format(session()->get('stream.price')) > 0){{ number_format((session()->get('stream.price') /100), 2, ',', '.') }} @else € @endif">
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="streamQuantity" class="text-center"><strong>{{ __("Quantity") }}</strong></label>
                            <input type="text" class="form-control text-center" id="streamQuantity"
                                   name="streamQuantity"
                                   placeholder="QUANTITY" value="{{ session()->get('stream.quantity') /1000 }}">
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="streamUnit" class="text-center"><strong>{{ __("Unit") }}</strong></label>
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
                        <div class="form-group d-flex flex-column">
                            <label for="total" class="text-center"><strong>{{ __("Total") }}</strong></label>
                            <input type="text" name="total" id="total" placeholder="@if(app()->getLocale() == "en"){{" € 0.00 "}}@else{{" € 0,00 "}}@endif" class="text-center p-1  mx-5" style="color: black" disabled>
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
                    <div class="form-group d-flex">
                        <input type="checkbox" name="chkIsFree" id="chkIsFree" class="ml-0 pl-0"><label for="chkIsFree">{{ __("Check if items are free") }}</label>
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
            $('#chkIsFree').change(function(){
                if ($('#chkIsFree').is(':checked') == true){
                    $('#streamPrice').val('0').prop('disabled', true);
                } else {
                    $('#streamPrice').val('').prop('disabled', false);
                }
            });

            qty = $("#streamQuantity")
            qty.keyup(function(){
                var locale = $('html').attr('lang');
                var streamPrice = $("#streamPrice").val()
                var ennumber = streamPrice.replace('€', '').replace('&euro; ', '')
                var globalnumber = ennumber.replace(",", ".")
                var globalqty = qty.val().replace(",", ".")
                var number = locale === 'en' ? ennumber : globalnumber
                var streamquant = locale === 'en' ? qty.val() : globalqty
                var subtotal= streamquant * number
                var inttotal= (Math.round(subtotal * 100) / 100)
                var entotal = inttotal.toFixed(2)
                var globaltotal = entotal.replace(".", ",")
                var total= locale === 'en' ? entotal : globaltotal
                var totalstring = "€ "+total
                $("#total").val(totalstring);
            });
            price= $("#streamPrice")
            price.keyup(function(){
                var locale = $('html').attr('lang');
                var qty = $("#streamQuantity")
                var streamPrice = price.val()
                var ennumber = streamPrice.replace('€', '').replace('&euro; ', '')
                var globalnumber = ennumber.replace(",", ".")
                var globalqty = qty.val().replace(",", ".")
                var number = locale === 'en' ? ennumber : globalnumber
                var streamquant = locale === 'en' ? qty.val() : globalqty
                var subtotal= streamquant * number
                var inttotal= (Math.round(subtotal * 100) / 100)
                var entotal = inttotal.toFixed(2)
                var globaltotal = entotal.replace(".", ",")
                var total= locale === 'en' ? entotal : globaltotal
                var totalstring = "€ "+total
                $("#total").val(totalstring);
            });
        });
    </script>
@endsection
