@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
    <style>
    </style>
    <?php use App\Http\Controllers\MapController; ?>
    <div id="map"></div>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&callback=initMap">
    </script>
    <script type="text/javascript">
        // Initialize and add the map
        function initMap() {
            let locationArray = [];
                @for($i=0; $i < count( $locations ); $i++)
            var location = {
                    lat: {!! MapController::getLat($locations[$i]) !!},
                    lng: {!! MapController::getLng($locations[$i]) !!}};
            locationArray.push(location);
                @endfor

                console.log(locationArray)

            let map = new google.maps.Map(
                document.getElementById('map'), {zoom: 8, center: location});

            for(let i = 0; i < locationArray.length; i++) {
                new google.maps.Marker({position: locationArray[i], map: map});
            }
        }
    </script>
@endsection
