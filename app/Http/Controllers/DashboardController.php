<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
use App\MaterialFunction;
use App\Materiallist;
use App\Stream;
use App\Substance;
use App\Tag;
use App\Unit;
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
        $tag = $request->session()->get('tag');

        $project = Building::all()->find($id);

        return view('streams.add-streams1', [
            'stream' => $stream,
            'tag' => $tag,
            'project' => $project
        ]);
    }

    public function addStreams1(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("streamName") == null) {
            return redirect()->back()->withInput()->with('error', 'please fill in a name');
        }

        $stream->setName($request->input("streamName"));
        $stream->setDescription($request->input("streamDescription"));
        $stream->setBuildid($id);

        $request->session()->put('stream', $stream);

        return redirect('/add-streams2/'.$id);
    }

    public function streams2(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

        return view('streams.add-streams2', [
            'stream' => $stream,
            'id' => $id
            ]);
    }

    public function addStreams2(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("category") == null) {
            return redirect()->back()->withInput()->with('error', 'please select a destination');
        }

        $stream->setCategory($request->input("category"));

        $request->session()->put('stream', $stream);

        return redirect('/add-streams3/'.$id);
    }

    public function streams3(Request $request, $id)
    {
        $tag = $request->session()->get('tag');

        $headCategory = Substance::whereNull('parent')->get();

        $subCategory1 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NULL)")->get();


        $subCategory2 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NOT NULL)")->get();

        return view('streams.add-streams3', [
            'tag' => $tag,
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'id' => $id

        ]);
    }

    public function addStreams3(Request $request, $id)
    {
        if (empty($request->session()->get('tag'))) {
            $tag = new Tag();
        } else {
            $tag = $request->session()->get('tag');
        }

        if ($request->input("substance") == null) {
            return redirect()->back()->withInput()->with('error', 'please select a material');
        }

        $tag->setMaterialId($request->input("substance"));

        $request->session()->put('tag', $tag);

        return redirect('/add-streams4/'.$id);
    }

    public function streams4(Request $request, $id)
    {
        $tag = $request->session()->get('tag');

        $headCategory = MaterialFunction::whereNull('parent')->get();

        $subCategory1 = DB::table('materialFunction')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM materialFunction WHERE parent IS NULL)")->get();

        $subCategory2 = DB::table('materialFunction')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM materialFunction WHERE parent IS NOT NULL)")->get();

        return view('streams.add-streams4', [
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'tag' => $tag,
            'id' => $id
        ]);
    }

    public function addStreams4(Request $request, $id)
    {
        if (empty($request->session()->get('tag'))) {
            $tag = new Tag();
        } else {
            $tag = $request->session()->get('tag');
        }

        if ($request->input("materialFunction") == null) {
            return redirect()->back()->withInput()->with('error', 'please select a function');
        }

        $tag->setFunctionId($request->input("materialFunction"));

        $request->session()->put('tag', $tag);

        return redirect('/add-streams5/'.$id);
    }

    public function streams5(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

        $units = Unit::all();

        return view('streams.add-streams5', [
            'stream' => $stream,
            'id' => $id,
            'units' => $units
        ]);
    }

    public function addStreams5(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("streamQuantity") == null) {
            return redirect()->back()->withInput()->with('error', 'please give a quantity');
        }

        if ($request->input("streamUnit") == null) {
            return redirect()->back()->withInput()->with('error', 'please give a unit of measurement');
        }

        $stream->setQuantity($request->input("streamQuantity"));
        $stream->setUnitId($request->input("streamUnit"));
        $request->session()->put('stream', $stream);

        return redirect('/add-streams6/'.$id);
    }

}
