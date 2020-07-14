<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class newBuildingController extends Controller
{
    public function index()
    {
        return view('new-building.new-building');
    }

    public function updateBuildingIndex()
    {
        return view('new-building.updateBuilding');
    }

    public function addBuilding(Request $request) {
        $building = new Building();
        if (isset($_POST['submitNewBuilding'])){
            $building->setProjectName($request->input('projectName'));
            $building->setAddress1($request->input('inputAddress'));
            $building->setAddress2($request->input('inputAddress2'));
            $building->setCity($request->input('inputCity'));
            $building->setPostcode($request->input('inputPostCode'));
            $building->setType($request->input('type'));
            $user = Auth::user();
            $building->setUserid($user->id);
            $building->save();
        }
        if (isset($_POST['submitBuildingInfo'])) {
            $building = Building::where('userid', Auth::id())->first();
            $building->setImage($request->input('buildingImage'));
            $building->save();
        }
        return redirect()->route('home');
    }




}
