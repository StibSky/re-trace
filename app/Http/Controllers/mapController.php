<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mapController extends Controller
{
    function maptest() {
        $response = \GoogleMaps::load('geocoding')
            ->setParam (['address' =>'Rode Kruisstraat 11 2220',
                ])
            ->get();

        $decoded = json_decode($response, true);

        $longName = $decoded['results'][0]['address_components'][0]['long_name'];
        $shortName = $decoded['results'][0]['address_components'][0]['short_name'];
        $fullAddress = $decoded['results'][0]['formatted_address'];
        $lat = $decoded['results'][0]['geometry']['location']['lat'];
        $lng = $decoded['results'][0]['geometry']['location']['lng'];


        return view('dashboard.map', [
            'response' =>$response,
            'longName' =>$longName,
            'shortName' =>$shortName,
            'fullAddress' =>$fullAddress,
            'lat' =>$lat,
            'lng' =>$lng
        ]);
    }
}
