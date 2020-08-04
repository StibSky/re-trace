<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class mapController extends Controller
{
    function maptest() {
        $building = Building::where('userid', Auth::user()->id)->orderby('id', 'DESC')->first();

        $response = \GoogleMaps::load('geocoding')
            ->setParam (['address' => $building->address1.' '.$building->city.' '.$building->postcode,
                ])
            ->get();

        $responseB = \GoogleMaps::load('geocoding')
            ->setParam (['address' => 'Rodekruisstraat 11 2220 Heist-op-den-berg',
            ])
            ->get();

        $decoded = json_decode($response, true);
        $decodedB = json_decode($responseB, true);

        $longName = $decoded['results'][0]['address_components'][0]['long_name'];
        $shortName = $decoded['results'][0]['address_components'][0]['short_name'];
        $fullAddress = $decoded['results'][0]['formatted_address'];
        $lat = $decoded['results'][0]['geometry']['location']['lat'];
        $lng = $decoded['results'][0]['geometry']['location']['lng'];
        $lat2 = $decodedB['results'][0]['geometry']['location']['lat'];
        $lng2 = $decodedB['results'][0]['geometry']['location']['lng'];


        return view('dashboard.map', [
            'response' =>$response,
            'longName' =>$longName,
            'shortName' =>$shortName,
            'fullAddress' =>$fullAddress,
            'lat' =>$lat,
            'lng' =>$lng,
            'lat2' =>$lat2,
            'lng2' =>$lng2
        ]);
    }
}
