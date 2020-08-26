<?php

namespace App\Http\Controllers;

use App\Building;
use App\Materiallist;
use App\Substance;
use App\Unit;
use App\User;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
        //referencing foreign key
    {
        $userBuilding = Building::with('user')
            ->where('userid', Auth::id())
            ->get();

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
                    ->setParam(['address' => $building->address1 . ' ' . $building->city . ' ' . $building->postcode,
                    ])
                    ->get()
            );
        }
        //move to class
        $headCategory = Substance::where(DB::raw('LENGTH(code)'), '=', '4')->get();

        $subCategory1 = Substance::where(DB::raw('LENGTH(code)'), '=', '6')->get();

        $subCategory2 = Substance::where(DB::raw('LENGTH(code)'), '=', '10')->get();

        $unit = Unit::all();

        return view('profile-page.home', [
            'buildings' => $userBuilding,
            'substances' => $substances,
            'firstbuilding' => $firstbuilding,
            'locations' => $locations,
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'units' => $unit,
        ]);
    }

    //look up blade extensions laravel, put in separate class
    public static function getLng($location)
    {
        $decodeLocation = json_decode($location, true);
        return $decodeLocation['results'][0]['geometry']['location']['lng'];
    }

    public static function getLat($location)
    {
        $decodeLocation = json_decode($location, true);
        return $decodeLocation['results'][0]['geometry']['location']['lat'];
    }


    public function mysearch(Request $request)
    {
        $inputsearch = $request->input('mysearch');

        $substanceId = $request->input('substance');
        

        if ($substanceId == " ") {
            return back()->with('error', 'No locations with this material found or no material selected');
        }

        $buildings = DB::table('building')
            ->whereRaw("id IN (SELECT buildid FROM streams WHERE id IN (SELECT stream_id FROM tags WHERE material_id = " . $substanceId . "))")->get();


        $materialLocations = [];
        foreach ($buildings as $building) {
            array_push($materialLocations,
                \GoogleMaps::load('geocoding')
                    ->setParam(['address' => $building->address1 . ' ' . $building->city . ' ' . $building->postcode,
                    ])
                    ->get()
            );
        }
        return back()->with(
            ['mysearch' => $inputsearch,
                'substanceId' => $substanceId,
                'materialLocations' => $materialLocations]);
    }

    public function editUserInfo(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($request->input('firstName') != null) {
            $user->setFirstName($request->input('firstName'));
        }

        if ($request->input('Email') != null) {
            $user->setEmail($request->input('Email'));
        }

        if ($request->input('lastName') != null) {
            $user->setLastName($request->input('lastName'));
        }
        $user->save();

        return back()->withErrors('success', 'successfully updated your info');
    }
}
