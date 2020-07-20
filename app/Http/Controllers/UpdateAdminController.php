<?php

namespace App\Http\Controllers;

use App\Building;
use App\Substance;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateAdminController extends Controller
{

    public function adminpassword()
    {
        return view('adminDatabase.adminpassword');
    }

    public function checkpass(Request $request) {
        if (isset($_POST['submitPass'])) {
            if ($request->input('adminpassword') == 1159) {
                return view('profile-page.home');
            }
            else {
                return redirect()->back();
            }
        }

    }

    public function index()
    {
        $substance = Substance::all();
        $headCategory = Substance::where(DB::raw('LENGTH(code)'), '=', '4')->get();

        $subCategory1 = Substance::where(DB::raw('LENGTH(code)'), '=', '6')->get();

        $subCategory2 = Substance::where(DB::raw('LENGTH(code)'), '=', '9')->get();


        $unit = Unit::all();

        return view('adminDatabase.admindb', [
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'units' => $unit,
        ]);
    }


    public function update(Request $request)
    {
        $substance = new Substance();
        if (isset($_POST['addSubstance'])) {
            $substance->setName($request->input('name'));
            $substance->setNameNl($request->input('name_nl'));
            $substance->setNameFr($request->input('name_fr'));
            $substance->setSpecificWeight($request->input('specific_weight'));
            $substance->setCode($request->input('code'));
            $substance->setComments($request->input('comment'));
            $substance->setParent($request->input('parent'));
            $substance->setIsHazardous($request->input('is_hazardous'));
            $substance->setUnitId($request->input('unit_id'));



            if ($substance->getName()==null) {
                return redirect()->back()->with('error', 'please fill in a name');
            }
            if ($substance->getSpecificWeight()==null) {
                return redirect()->back()->with('error', 'please fill in a weight (0 if you dont know)');
            }
            if (strlen($substance->getCode()) == 4 or strlen($substance->getCode()) == 6 or strlen($substance->getCode()) == 9) {
                $substance->save();
                return redirect()->back()->with('success', 'IT WORKS!');
            }
            else {
                return redirect()->back()->with('error', 'Code must be 4, 6 or 9 characters long');
            }



            //$parent = Substance::where();
            //$substance->setParent($parent->code);
        }

    }

}
