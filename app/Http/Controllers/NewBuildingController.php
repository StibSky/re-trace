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
            $building->setAddress2($request->input('inputAddress2'));
            $building->setCity($request->input('inputCity'));
            $building->setImage($request->input('inputImage'));
            $building->setPlan($request->input('inputPlan'));
            $building->setMaterialList($request->input('inputMaterialList'));
            $building->setPostcode($request->input('inputPostCode'));
            $building->setQuantity($request->input('inputQuantity'));
            $building->setStatus($request->input('buildingStatus'));


            $building->setSurface($request->input('inputSurface'));
            $building->save();




        }
        return redirect()->route('home');
    }
}
