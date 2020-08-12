<?php

namespace App\Http\Controllers;

use App\MaterialFunction;
use App\Substance;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialFunctionController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please log in and make sure you are admin to access this page');
        }
        if (Auth::user()->type != 'admin') {
            return redirect()->back();
        }

        $headCategory = MaterialFunction::whereNull('parent')->get();


        $subCategory1 = DB::table('materialFunction')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM materialFunction WHERE parent IS NULL)")->get();


        $subCategory2 = DB::table('materialFunction')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM materialFunction WHERE parent IS NOT NULL)")->get();


        $unit = Unit::all();

        return view('adminDatabase.materialFunctions', [
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'units' => $unit,
        ]);
    }

    public function update(Request $request)
    {
        $materialFunction = new MaterialFunction();
        if (isset($_POST['addMaterialFunction'])) {
            $materialFunction->setName($request->input('name'));
            $materialFunction->setNameNl($request->input('name_nl'));
            $materialFunction->setNameFr($request->input('name_fr'));
            $materialFunction->setComments($request->input('comment'));
            $materialFunction->setParent($request->input('parent'));
            $materialFunction->setUnitId($request->input('unit_id'));
        }


        if ($materialFunction->getName() == null) {
            return back()->withInput()->with('error', 'please fill in a name');
        }

        $materialFunction->save();
        return redirect()->back()->with('success', 'IT WORKS!');

    }

}
