<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
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

    public function addBuilding(Request $request)
    {
        $building = new Building();
        $image = new Image();
        if (isset($_POST['submitNewBuilding'])) {
            $building->setProjectName($request->input('projectName'));
            $building->setAddress1($request->input('inputAddress'));
            $building->setAddress2($request->input('inputAddress2'));
            $building->setCity($request->input('inputCity'));
            $building->setPostcode($request->input('inputPostCode'));
            $building->setType($request->input('type'));
            $user = Auth::user();
            $building->setUserid($user->id);
            if ($building->getProjectName() == null) {
                return redirect()->back()->with('error', 'please fill in a name');
            }
            if ($building->getAddress1() == null) {
                return redirect()->back()->with('error', 'please fill in both address fields');
            }
            if ($building->getAddress2() == null) {
                return redirect()->back()->with('error', 'please fill in both address fields');
            }
            if ($building->getCity() == null) {
                return redirect()->back()->with('error', 'please fill in city');
            }
            if ($building->getPostcode() == null) {
                return redirect()->back()->with('error', 'please fill in postcode');
            }
            if ($building->getType() == null) {
                return redirect()->back()->with('error', 'please fill in type');
            }
            $building->save();
            $image->setImage($request->input('projectImage'));
            $image->setCreatedAt(date("Y-m-d H:i:s"));
            $image->setBuildid($building->getId());
            $image->save();


        }

        //this if statement is not in production
        if (isset($_POST['submitBuildingInfo'])) {
            $building = Building::where('userid', Auth::id())->first();
            $building->setImage($request->input('buildingImage'));
            $building->save();
        }
        return redirect()->route('home');
    }


}
