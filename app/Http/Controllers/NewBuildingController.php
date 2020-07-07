<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;

class newBuildingController extends Controller
{
    public function index()
    {
        return view('new-building.new-building');
    }

    public function addBuilding() {
        if (isset($_POST['submitNewBuilding'])){
            $building = new Building();
            $building->setAddress1("test");
            $building->setAddress2("test");
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
