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

        foreach($materials as $material) {
            array_push($buildingSubstances, Substance::where('id', $material->substanceId)->get());
        }


        return view('dashboard.dashboard', [
            'project' => $project,
            'image' => $image,
            'buildingSubstances' => $buildingSubstances
        ]);
    }

    public function adminDashboard() {
        $privateUsers = User::where('type', 'Private');
        $businessUsers =User::where('type', 'Business');
        return view('dashboard.adminDashboard', [
            'private' => $privateUsers,
            'business' => $businessUsers
        ]);
    }
}
