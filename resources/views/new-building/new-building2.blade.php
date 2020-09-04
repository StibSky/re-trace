@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/dashboard_old.css') }}">
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
@endsection
@section('content')
    <!--
blade for adding a new building/project to a User
-->
    <div class="container d-flex justify-content-center flex-column align-items-center">
        <h3>{{ __("CREATE A NEW PROJECT") }}</h3>
        <div class="card d-flex justify-content-center">
            <div class="mb-4 text-center card-header">
                <img src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
                <h3><strong>re-trace.io</strong></h3>
            </div>
            <div class="card-body text-center">
                <h4>{{ __("What's the address of your project?")}}</h4>
                <form action="{{ route('newBuilding2') }}" method="post" class="mt-5" id="address">
                    @csrf
                    <div id="locationField" class="w-100 mb-5 d-flex justify-content-center">
                        <input class="text-center" id="autocomplete"
                               placeholder="{{ __("SEARCH FOR YOUR ADDRESS HERE")}}"
                               onFocus="geolocate()"
                               type="text"/>
                    </div>
                    <div class="form-group">
                        <label for="street" class="sr-only">{{ __("Street name")}}</label>
                        <input type="text" class="form-control text-center" id="route" name="street"
                               value="{{ session()->get('inputStreetNumber') }}" placeholder="{{ __("STREET NAME")}}(*)"/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6 col-12">
                            <label for="street_number" class="sr-only">{{ __("Street number")}}</label>
                            <input type="text" class="form-control text-center" id="street_number" name="street_number"
                                   value="{{ session()->get('inputStreet') }}" placeholder="NR(*)"/>
                        </div>
                        <div class="form-group col-sm-6 col-12">
                            <label for="address2" class="sr-only">{{ __("Address2")}}</label>
                            <input type="text" class="form-control text-center" id="address2" name="address2"
                                   value="{{ session()->get('building.address2') }}" placeholder="{{ __("BUS")}}"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6 col-12">
                            <label for="city" class="sr-only">{{ __("City")}}</label>
                            <input type="text" class="form-control text-center" id="locality" name="city"
                                   value="{{ session()->get('building.city') }}" placeholder="{{ __("CITY")}}(*)"/>
                        </div>
                        <div class="form-group col-sm-6 col-12">
                            <label for="postcode" class="sr-only">{{ __("Postcode")}}</label>
                            <input type="text" class="form-control text-center" id="postal_code" name="postcode"
                                   value="{{ session()->get('building.postcode') }}" placeholder="{{ __("POST CODE")}}(*)"/>
                        </div>
                    </div>
                    <p>(*){{ __("required fields")}}</p>
                    <div class="align-self-center">
                        <button type="submit" id="main-button-wide" class="btn btn-primary" name="newBuilding2">{{ __("Next")}}</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{route('building')}}"><span><strong>Go Back</strong></span></a>
            </div>
        </div>
        <script>
            // This sample uses the Autocomplete widget to help the user select a
            // place, then it retrieves the address components associated with that
            // place, and then it populates the form fields with those details.
            // This sample requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script
            // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            var placeSearch, autocomplete;

            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                postal_code: 'long_name'
            };

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search predictions to
                // geographical location types.
                autocomplete = new google.maps.places.Autocomplete(
                    document.getElementById('autocomplete'), {types: ['geocode']});

                // Avoid paying for data that you don't need by restricting the set of
                // place fields that are returned to just the address components.
                autocomplete.setFields(['address_component']);

                // When the user selects an address from the drop-down, populate the
                // address fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();

                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details,
                // and then fill-in the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle(
                            {center: geolocation, radius: position.coords.accuracy});
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
        </script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&libraries=places&callback=initAutocomplete"
            defer></script>
    </div>
@endsection
