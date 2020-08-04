<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderableg
     */
    public function index()


        //referencing foreign key
    {
        $userBuilding = Building::with('user')
            ->where('userid', Auth::id())
            ->simplePaginate(3);

        $firstbuilding = Building::with('user')
            ->where('userid', Auth::id())
            ->first();

        //gets all the info out the substances database
        $substances = DB::table('substance')->get();

        //map stuff
        $buildings = Building::where('userid', Auth::user()->id)->get();

        $locations = [];

        foreach ($buildings as $building) {
            array_push($locations,
                \GoogleMaps::load('geocoding')
                    ->setParam (['address' => $building->address1.' '.$building->city.' '.$building->postcode,
                    ])
                    ->get()
            );
        }


        return view('profile-page.home', [
            'buildings' => $userBuilding,
            'substances' => $substances,
            'firstbuilding' => $firstbuilding,
            'locations' => $locations
        ]);
    }
    public static function getLng($location) {
        $decodeLocation = json_decode($location, true);
        return $decodeLocation['results'][0]['geometry']['location']['lng'];
    }

    public static function getLat($location) {
        $decodeLocation = json_decode($location, true);
        return $decodeLocation['results'][0]['geometry']['location']['lat'];
    }
}
