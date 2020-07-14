<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($id)
    {
        $project = Building::all()->find($id);

        return view('dashboard.dashboard', [
            'project' => $project,
        ]);
    }
}
