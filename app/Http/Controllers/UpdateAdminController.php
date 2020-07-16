<?php

namespace App\Http\Controllers;

use App\Building;
use App\Substance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateAdminController extends Controller
{
    public function index()
    {
        $substance = Substance::all();
        $headCategory = Substance::where(DB::raw('LENGTH(code)'), '=', '4')->get();

        $subCategory1 = Substance::where(DB::raw('LENGTH(code)'), '=', '6')->get();

        $subCategory2 = Substance::where(DB::raw('LENGTH(code)'), '=', '7')->get();

        return view('adminDatabase.admindb', [
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2
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
            $substance->setComments($request->input('comments'));
            $substance->setIsHazardous($request->input('is_hazardous'));
            $substance->setUnitId($request->input('unit_id'));
            $substance->save();

            //$parent = Substance::where();
            //$substance->setParent($parent->code);
        }
    }
}
