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

class NewBuildingController extends Controller
{

    public function step1(Request $request)
    {
        $building = $request->session()->get('building');
        return view('new-building.new-building', compact('building'));
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
    /*    public function addBuilding(Request $request)
        {
            $building = new Building();
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
            }*/

    /*===================================================================================================
    THIS IF IS CURRENTLY UNUSED AND SHOULD BE DELETED IF THIS REMAINS THE CASE
      ===================================================================================================
    */
    /*        if (isset($_POST['submitBuildingInfo'])) {
                $building = Building::where('userid', Auth::id())->first();
                $building->setImage($request->input('buildingImage'));
                $building->save();
            }
            return redirect()->route('home');
        }*/

    public function addStep1(Request $request)
    {
        //can be converted to 1 if can be shortened
        $validatedName = $request->input('projectName');
        if (isset($_POST['newBuilding'])) {
            if (empty($request->session()->get('building'))) {
                $building = new Building();
                $building->setProjectName($validatedName);
                $request->session()->put('building', $building);
                if ($building->getProjectName() == null) {
                    return redirect()->back()->withInput()->with('error', 'please fill in a name');
                }
            } else {
                $building = $request->session()->get('building');
                $building->setProjectName($validatedName);
                $request->session()->put('building', $building);
                if ($building->getProjectName() == null) {
                    return redirect()->back()->withInput()->with('error', 'please fill in a name');
                }
            }
        }
        return redirect()->route('building2');
    }

    public function step2(Request $request)
    {
        $building = $request->session()->get('building');

        return view('new-building.new-building2', [
            'building' => $building,
        ]);
    }

    public function addStep2(Request $request)
    {
        /*        $validatedData = $request->validate([
                    'address1' => 'required',
                    'address2' => 'nullable',
                    'city' => 'required',
                    'postcode' => 'required'
                ]);*/
        $inputStreetNumber = $request->input('street_number');
        $inputStreet = $request->input('street');
        $inputAddress1 = $inputStreet . ' ' . $inputStreetNumber;
        $inputAddress2 = $request->input('address2');
        $inputCity = $request->input('city');
        $inputPostcode = $request->input('postcode');

        if ($inputStreetNumber == null) {
            return redirect()->back()->withInput()->with('error', 'please fill in a street number');
        }
        if ($inputStreet === null) {
            return redirect()->back()->withInput()->with('error', 'please fill in your address');
        }
        if ($inputCity == null) {
            return redirect()->back()->withInput()->with('error', 'please fill in city');
        }
        if ($inputPostcode == null) {
            return redirect()->back()->withInput()->with('error', 'please fill in postcode');
        }

        if (empty($request->session()->get('building'))) {
            $building = new Building();
        } else {
            $building = $request->session()->get('building');
        }

        $building->setAddress1($inputAddress1);
        $building->setAddress2($inputAddress2);
        $building->setCity($inputCity);
        $building->setPostcode($inputPostcode);
        $request->session()->put('building', $building);
        $request->session()->put('inputStreetNumber', $inputStreetNumber);
        $request->session()->put('inputStreet', $inputStreet);
        return redirect('/newBuilding3');
    }

    public function step3(Request $request)
    {
        $building = $request->session()->get('building');
        return view('new-building.new-building3',
            ['building' => $building,]);
    }

    public function addStep3(Request $request)
    {
        $inputType = $request->input('type');

        if ($inputType == null) {
            return redirect()->back()->with('error', 'please fill in type');
        }
        if (empty($request->session()->get('building'))) {
            $building = new Building();
        } else {
            $building = $request->session()->get('building');
        }
        $building->setType($inputType);
        $request->session()->put('building', $building);

        $request->session()->forget('inputStreetNumber');
        $request->session()->forget('inputStreet');

        return redirect()->route('building4');
    }

    public function step4(Request $request)
    {
        $building = $request->session()->get('building');
        return view('new-building.new-building4',
            ['building' => $building]);
    }

    public function addStep4(Request $request)
    {
        $inputStatus = $request->input('status');
        if ($inputStatus == null) {
            return redirect()->back()->with('error', 'please fill in status');
        }
        $user = Auth::user();
        if (empty($request->session()->get('building'))) {
            $building = new Building();
        } else {
            $building = $request->session()->get('building');
        }
        $building->setStatus($inputStatus);
        $request->session()->put('building', $building);
        $building->setUserid($user->id);
        return redirect()->route('confirm');
    }

    public function confirm(Request $request)
    {
        $building = $request->session()->get('building');

        return view('new-building.confirm',
            ['building' => $building]);
    }

    public function store(Request $request)
    {
        $building = $request->session()->get('building');
        $building->save();
        $request->session()->forget('building');
        $request->session()->forget('inputStreetNumber');
        $request->session()->forget('inputStreet');

        return redirect()->route('home')->with('success', 'Project created successfully');
    }

    public function deleteBuilding()
    {
        $building = Building::find($_POST['deleteBuilding'])->first();

        Building::destroy($_POST['deleteBuilding']);

        $building->save();
        return redirect()->route('home');
    }

    public function addStreams($id)
    {
        $headCategory = Substance::where(DB::raw('LENGTH(code)'), '=', '4')->get();

        $subCategory1 = Substance::where(DB::raw('LENGTH(code)'), '=', '6')->get();

        $subCategory2 = Substance::where(DB::raw('LENGTH(code)'), '=', '9')->get();


        $project = Building::all()->find($id);
        return view('new-building.addstreams', [
            'buildingId' => $id,
            'project' => $project,
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,]);
    }

    public function saveEdit(Request $request)
    {
        //check phan
        /** @var Materiallist $buildingMaterial */
        $buildingMaterial = new Materiallist();
        $buildingMaterial->setSubstanceId($request->input('substance'));
        $buildingMaterial->setBuildid($request->input('buildingId'));
        $buildingMaterial->setQuantity($request->input('quantity'));
        $inputBuildId = $request->input('buildingId');
        $checkMaterial = DB::table('materiallist')
            ->where('buildid', $inputBuildId)
            ->where('substanceId', $request->input('substance'))
            ->first();

        //Materiallist::where('buildid', '=', '$request->input('buildingId')', '=', Input::get('email'))->first();
        if ($checkMaterial != null) {
            return redirect()->back()->with('error', 'You already selected this material');
        }
        $buildingMaterial->save();
        return redirect()->back()->with('success', 'Material added successfully!');

    }
}

