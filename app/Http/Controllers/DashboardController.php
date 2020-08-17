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

        if (!Auth::check()) {
            return redirect('login')->with('error', 'You were inactive for too long and logged out automatically');
        }

        if (Auth::user()->type == 'admin') {
            Auth::user()->id = Building::where('id', $id)->first()->userid;
        }
        if (Auth::user()->id != Building::where('id', $id)->first()->userid) {
            return redirect()->back();
        }
        $project = Building::all()->find($id);
        // $image = Image::all()->find($id);
        $materials = Materiallist::where('buildid', $id)->get();

        $buildingSubstances = [];

        foreach ($materials as $material) {
            array_push($buildingSubstances, Substance::where('id', $material->substanceId)->get());
        }

        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();

        $projecttypes = $projectfiles->pluck("type")->unique();

        return view('dashboard.dashboard', [
            'project' => $project,
            'buildingSubstances' => $buildingSubstances,
            'projecttypes' => $projecttypes
        ]);
    }

    public function adminDashboard()
    {
        //dashboardcontroller for administrators to see user info
        if (Auth::user()->type != 'admin') {
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

    public function streams1(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

/*        $headCategory = Substance::where(DB::raw('LENGTH(code)'), '=', '4')->get();

        $subCategory1 = Substance::where(DB::raw('LENGTH(code)'), '=', '6')->get();

        $subCategory2 = Substance::where(DB::raw('LENGTH(code)'), '=', '9')->get();*/


        $project = Building::all()->find($id);

        return view('streams.add-streams1', [
            'stream' => $stream,
            'project' => $project
        ]);
    }

    public function addStreams1()
    {
        if (empty($request->session()->get('stream'))) {
            $building = new Stream();
        } else {
            $building = $request->session()->get('building');
        }
    }
}
