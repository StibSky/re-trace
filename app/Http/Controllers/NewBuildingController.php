<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class newBuildingController extends Controller
{
    public function index()
    {
        return view('new-building.new-building');
    }

    public function addBuilding(Request $request) {
        if (isset($_POST['submitNewBuilding'])){
            $building = new Building();
            $building->setAddress1($request->input('inputAddress'));
            $building->setAddress2($request->input('inputAddress'));
            $building->setCity("test");
            $building->setImage("test");
            $building->setPlan("plannetje");
            $building->setMaterialList("test");
            $building->setPostcode("200");
            $building->setMeasuringState("yeet");

            $building->setSurface("200");
            $building->save();




        }
        return redirect()->route('home');
    }
}
