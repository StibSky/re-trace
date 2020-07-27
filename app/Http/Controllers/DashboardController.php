<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
use App\Materiallist;
use App\Substance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /*
     * This controller is used to display information on the User profile
     * It is linked to the Image and Building Database
     */
    public function index($id)
    {
        $project = Building::all()->find($id);
        $image = Image::where('buildid', $id)->first();
        // $image = Image::all()->find($id);
        $materials = Materiallist::where('buildid', $id)->get();

        $buildingSubstances = [];

        foreach ($materials as $material) {
            array_push($buildingSubstances, Substance::where('id', $material->substanceId)->get());
        }


        return view('dashboard.dashboard', [
            'project' => $project,
            'image' => $image,
            'buildingSubstances' => $buildingSubstances
        ]);
    }

    public function adminDashboard()
    {
        if(Auth::user()->type != 'admin') {
            return redirect()->back();
        }
        $privateUsers = User::where('type', 'Private')->get();
        $businessUsers = User::where('type', 'Business')->get();
        $privateBuildings = [];
        foreach ($privateUsers as $privateUser) {
            array_push($privateBuildings, Building::where('userid', $privateUser->id)->get());
        }
        $businessBuildings = [];
        foreach ($businessUsers as $businessUser) {
            array_push($businessBuildings, Building::where('userid', $businessUser->id)->get());
        }

        return view('dashboard.adminDashboard', [
            'privates' => $privateUsers,
            'privateBuildings' => $privateBuildings,
            'businesses' => $businessUsers,
            'businessBuildings' => $businessBuildings
        ]);
    }
}
