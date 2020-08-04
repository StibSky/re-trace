@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
    <style>
        #map {
            width: 100%;
            height: 400px;
            background-color: grey;
        }
    </style>
    <div id="map" ></div>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&callback=initMap">
    </script>
    <script type="text/javascript">
        // Initialize and add the map
        function initMap() {
            var location = {lat: {!! json_encode($lat) !!}, lng: {!! json_encode($lng) !!}} ;
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: location});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: location, map: map});

        }
    </script>
@endsection
