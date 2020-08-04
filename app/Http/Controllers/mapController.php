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







        var_dump($decoded);

        return view('dashboard.map', [
            'response' =>$response
        ]);
    }
}
