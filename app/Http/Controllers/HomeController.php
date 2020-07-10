<?php

namespace App\Http\Controllers;

use App\Building;
use App\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()


        //linking User to Building, Useful for looping over all Buildings with specific user id
    {
        $userBuilding = Building::with('user')
            ->where('userid', Auth::id())
            ->get();

        return view('profile-page.home', [
            'buildings' => $userBuilding,
        ]);
    }
}
