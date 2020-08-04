<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    function maptest() {
        $buildings = Building::where('userid', Auth::user()->id)->get();

        $locations = [];

        foreach ($buildings as $building) {
            array_push($locations,
                \GoogleMaps::load('geocoding')
                    ->setParam (['address' => $building->address1.' '.$building->city.' '.$building->postcode,
                    ])
                    ->get()
            );
        }

/*      $lat = getLat($locations[0]);*/

        //dd($lat);

        /*$response = \GoogleMaps::load('geocoding')
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
        $lng2 = $decodedB['results'][0]['geometry']['location']['lng'];*/


        return view('dashboard.map', [
            'locations' => $locations,
        ]);
    }

    public static function getLng($location) {
        $decodeLocation = json_decode($location, true);
        return $decodeLocation['results'][0]['geometry']['location']['lng'];
    }

    public static function getLat($location) {
        $decodeLocation = json_decode($location, true);
        return $decodeLocation['results'][0]['geometry']['location']['lat'];
    }
}
