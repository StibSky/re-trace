<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
use App\Materiallist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $buildingmaterial = Materiallist::where('buildid', $id)->get();

        return view('dashboard.dashboard', [
            'project' => $project,
            'image' => $image,
            'buildingmaterial' => $buildingmaterial
        ]);
    }
}
