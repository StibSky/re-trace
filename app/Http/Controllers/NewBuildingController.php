<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newBuildingController extends Controller
{
    public function index()
    {
        return view('new-building.new-building');
    }
}
