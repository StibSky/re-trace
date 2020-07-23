<?php

namespace App\Http\Controllers;

use App\Building;
use App\Image;
use App\Materiallist;
use App\Substance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class newBuildingController extends Controller
{

    //used to load the page
    public function index()
    {
        return view('new-building.new-building');
    }

    /* would be used to edit building information
    ===================================================================================================
    THIS FUNCTION IS CURRENTLY UNUSED AND SHOULD BE DELETED IF THIS REMAINS THE CASE
    ===================================================================================================
 */
    public function updateBuildingIndex()
    {
        return view('new-building.updateBuilding');
    }


    /*function to add new "projects" to the database
    =====================================================================================================
    IMAGE IS AN URL AND SHOULD CHANGE TO AN UPLOADABLE PICTURE
    =====================================================================================================
    */
    public function addBuilding(Request $request)
    {
        $building = new Building();
        $image = new Image();
        if (isset($_POST['submitNewBuilding'])) {
            $building->setProjectName($request->input('projectName'));
            $building->setAddress1($request->input('inputAddress'));
            $building->setAddress2($request->input('inputAddress2'));
            $building->setCity($request->input('inputCity'));
            $building->setPostcode($request->input('inputPostCode'));
            $building->setType($request->input('type'));
            $user = Auth::user();
            $building->setUserid($user->id);

            //error handling for user, redirects back to the same page with error message
            //check the blades to find out more about error syntax
            if ($building->getProjectName() == null) {
                return redirect()->back()->with('error', 'please fill in a name');
            }
            if ($building->getAddress1() == null) {
                return redirect()->back()->with('error', 'please fill in address field 1');
            }
            if ($building->getCity() == null) {
                return redirect()->back()->with('error', 'please fill in city');
            }
            if ($building->getPostcode() == null) {
                return redirect()->back()->with('error', 'please fill in postcode');
            }
            if ($building->getType() == null) {
                return redirect()->back()->with('error', 'please fill in type');
            }

            //VERY important to look at order of save() statements, can only do a get once the sets are saved
            $building->save();
            $image->setImage($request->input('projectImage'));
            $image->setCreatedAt(date("Y-m-d H:i:s"));
            $image->setBuildid($building->getId());
            $image->save();
        }

        /*===================================================================================================
        THIS IF IS CURRENTLY UNUSED AND SHOULD BE DELETED IF THIS REMAINS THE CASE
          ===================================================================================================
        */
        if (isset($_POST['submitBuildingInfo'])) {
            $building = Building::where('userid', Auth::id())->first();
            $building->setImage($request->input('buildingImage'));
            $building->save();
        }
        return redirect()->route('home');
    }

    public function deleteBuilding()
    {
        $building = Building::find($_POST['deleteBuilding'])->first();

        Building::destroy($_POST['deleteBuilding']);

        $building->save();

        return redirect()->route('home');
    }

    public function editBuilding($id)
    {
        $headCategory = Substance::where(DB::raw('LENGTH(code)'), '=', '4')->get();

        $subCategory1 = Substance::where(DB::raw('LENGTH(code)'), '=', '6')->get();

        $subCategory2 = Substance::where(DB::raw('LENGTH(code)'), '=', '9')->get();


        $project = Building::all()->find($id);
        return view('new-building.editbuilding', [
            'buildingId' => $id,
            'project' => $project,
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,]);
    }

    public function saveEdit(Request $request) {
        //check phan
        /** @var Materiallist $buildingMaterial */
        $buildingMaterial = new Materiallist();
        $buildingMaterial->setSubstanceId($request->input('substance'));
        $buildingMaterial->setBuildid($request->input('buildingId'));
        $buildingMaterial->setQuantity($request->input('quantity'));
        $inputBuildId = $request->input('buildingId');
        $checkMaterial = DB::table('materialList')
            ->where('buildid', $inputBuildId)
            ->where('substanceId', $request->input('substance'))
            ->first();

        //Materiallist::where('buildid', '=', '$request->input('buildingId')', '=', Input::get('email'))->first();
        if ($checkMaterial === null) {
            $buildingMaterial->save();
            return redirect()->back()->with('success', 'Material added successfully!');
        }
        else {
            return redirect()->back()->with('error', 'You already selected this material');
        }

    }
}

