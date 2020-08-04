<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mapController extends Controller
{
    function maptest() {
        $response = \GoogleMaps::load('geocoding')
            ->setParam (['address' =>'santa cruz'])
            ->get();


        return view('dashboard.map', [
            'response' =>$response
        ]);
    }
}
