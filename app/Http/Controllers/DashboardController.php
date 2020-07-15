<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index($id)
    {
        $project = Building::all()->find($id);
        //$image = Image::where('buildid', $id);
        $image = Image::all()->find($id);


        return view('dashboard.dashboard', [
            'project' => $project,
            'image' => $image
        ]);
    }
}
