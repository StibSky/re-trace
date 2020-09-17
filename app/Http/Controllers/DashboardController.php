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
use App\UploadedFile;
use App\User;
use App\Valuta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Table;

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
        //$materials = Materiallist::where('buildid', $id)->get();

        $buildingSubstances = [];

        /*        foreach ($materials as $material) {
                    array_push($buildingSubstances, Substance::where('id', $material->substanceId)->get());
                }*/

        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();


        $projecttypes = $projectfiles->pluck("type")->unique();

        $streams = Stream::where('buildid', $id)->get();

        $tags = [];
        $units = [];
        foreach ($streams as $stream) {
            array_push($tags, Tag::where('stream_id', $stream->id)->get());
            array_push($units, Unit::where('id', $stream->unit_id)->get());
        }

        $user = Auth::user();
        $userFolder = $user->first_name. "_" . $user->last_name;

        $project = Building::all()->find($id);



        return view('dashboard.dashboard', [
            'project' => $project,
            'buildingSubstances' => $buildingSubstances,
            'projecttypes' => $projecttypes,
            'streams' => $streams,
            'tags' => $tags,
            'userFolder' => $userFolder,
            'units' => $units
        ]);
    }

    public static function getMaterialName($id)
    {
        $materialName = DB::table('substance')
            ->where('id', $id)->first();

        if (app()->getLocale() == "en") {
            return $materialName->name;
        } elseif (app()->getLocale() == "fr") {
            return $materialName->name_fr;
        } elseif (app()->getLocale() == "nl") {
            return $materialName->name_nl;
        }
    }

    public
    static function getFunctionName($id)
    {
        $functionName = DB::table('materialFunction')
            ->where('id', $id)->first();


        if (app()->getLocale() == "en") {
            return $functionName->name;
        } elseif (app()->getLocale() == "fr") {
            return $functionName->name_fr;
        } elseif (app()->getLocale() == "nl") {
            return $functionName->name_nl;
        }
    }

    public static function getStreamBuilding($id)
    {
        $buildingId = DB::table('streams')->where('id', $id)->first()->buildid;
        $streamBuilding = DB::table('building')->where('id', $buildingId)->first();

        return $streamBuilding;
    }

    public static function getStreamImage($id)
    {
        $project = self::getStreamBuilding($id);

        $filename = DB::table('stream_images')->where('streamId', $id)->first()->name;

        $projectFolder = $project->projectName;
        $firstname = User::where('id', $project->userid)->first()->first_name;
        $lastname = User::where('id', $project->userid)->first()->last_name;
        $authid = User::where('id', $project->userid)->first()->id;


        $targetFolder = '/public/userFiles/' . $authid . '/' . $projectFolder;

        if (is_dir(Storage::path($targetFolder))) {
            $targetFile = $targetFolder . '/' . $filename;

            $fullPath = Storage::path($targetFile);

            $base64 = base64_encode(Storage::get($targetFile));
            $image_data = 'data:' . mime_content_type($fullPath) . ';base64,' . $base64;
        } else {
            $targetFile = null;
            $image_data = null;
        }


        return $image_data;
    }


    public
    function adminDashboard()
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

    public
    function editDashInfo(Request $request, $id)
    {
        $building = Building::where('id', $id)->first();


        if ($request->input('streetName') != null && $request->input('streetNumber') != null) {
            $building->setAddress1($request->input('streetName') . " " . $request->input('streetNumber'));
        }

        if ($request->input('city') !=null) {
            $building->setCity($request->input('city'));
        }

        if ($request->input('type') != null) {
            $building->setType($request->input('type'));
        }

        if ($request->input('status') != null) {
            $building->setStatus($request->input('status'));
        }

        $building->save();

        return back()->withErrors('success', __("Successfully updated your info"));
    }

}
