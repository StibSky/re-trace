@extends('layouts.app')
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
@section('content')
    <style>
    </style>
    <div id="map" ></div>
    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQxZFeQzEx6mmfOypA8Q4uZOU5zmO6lS0&callback=initMap">
    </script>
    <script type="text/javascript">
        // Initialize and add the map
        function initMap() {
            var location = {lat: {!! json_encode($lat) !!}, lng: {!! json_encode($lng) !!}};
            var location2 = {lat: {!! json_encode($lat2) !!}, lng: {!! json_encode($lng2) !!}} ;
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 8, center: location2});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: location, map: map});
            var marker2 = new google.maps.Marker({position: location2, map: map});

        }
    </script>
@endsection
