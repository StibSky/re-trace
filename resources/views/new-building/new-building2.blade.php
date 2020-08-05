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
        <img class="mb-4" src="{{ asset('/images/retracelogo.png') }}" alt="" height="40">
        <h2>Please give your project's address</h2>
        <form  action="{{ route('newBuilding2') }}" method="post">
            @csrf
            <div id="locationField">
                <input id="autocomplete"
                       placeholder="Enter your address"
                       onFocus="geolocate()"
                       type="text"/>
            </div>
            <table id="address" class="mt-4 mb-4">
                <tr>
                    <td class="label">Street address(*)</td>
                    <td class="wideField" colspan="2"><input class="field" id="route" disabled="true" name="street" value="{{ old('street') }}"/></td>
                    <td class="slimField" colspan="1"><input class="field" id="street_number" name="street_number" value="{{ old('street_number') }}"/></td>
                </tr>
                <tr>
                    <td class="label">Address supplement (apartment, studio or floor)</td>
                    <td class="wideField" colspan="3"><input class="field" id="supplement" name="address2" value="{{ session()->get('building.address2') }}"/></td>
                </tr>
                <tr>
                    <td class="label">City(*)</td>
                    <td class="wideField" colspan="3"><input class="field" id="locality" disabled="true" name="city" value="{{ session()->get('building.city') }}"/></td>
                </tr>
                <tr>
                    <td class="label">Region</td>
                    <td class="slimField"><input class="field" id="administrative_area_level_1" disabled="true"/></td>
                    <td class="label">Post code(*)</td>
                    <td class="wideField"><input class="field" id="postal_code" disabled="true" name="postcode" value="{{ session()->get('building.postcode') }}"/></td>
                </tr>
                <tr>
                    <td class="label">Country</td>
                    <td class="wideField" colspan="3"><input class="field" id="country" disabled="true"/></td>
                </tr>
            </table>
            <p>(*)required fields</p>
            <button type="submit" id="main-button" class="btn btn-primary" name="newBuilding2">Next</button>
        </form>
        <br>
        <a href="{{ url()->previous() }}" id="secondary-button" class="btn btn-primary">Back</a>
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
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
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
                    navigator.geolocation.getCurrentPosition(function(position) {
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&libraries=places&callback=initAutocomplete"
                defer></script>
    </div>
@endsection
