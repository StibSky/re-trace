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

        $tree = [];

        if (isset ($subCategory2)) {
            foreach ($subCategory2 as $sub2) {
                $tree += [$sub2->id => $sub2->parent];
            }
        }
        if (isset ($subCategory1)) {
            foreach ($subCategory1 as $sub1) {
                $tree += [$sub1->id => $sub1->parent];
            }
        }
        if (isset($headCategory)) {
            foreach ($headCategory as $head) {
                $tree += [$head->id => $head->parent];
            }
        }

        function parseTree($tree, $root = null) {
            $return = array();
            # Traverse the tree and search for direct children of the root
            foreach($tree as $child => $parent) {
                # A direct child is found
                if($parent == $root) {
                    # Remove item from tree (we don't need to traverse this again)
                    unset($tree[$child]);
                    # Append the child into result array and parse its children
                    $return[] = array(
                        'id' => $child,
                        'children' => parseTree($tree, $child)
                    );
                }
            }
            return empty($return) ? null : $return;
        }


        $result = parseTree($tree);
        $unit = Unit::all();

        return view('adminDatabase.materialFunctions', [
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'units' => $unit,
            'tree' => $result
        ]);
    }

    public static function getNameFunction($id) {
        $substanceElement = DB::table('materialFunction')
            ->where('id', $id )->first();


        return $substanceElement->name;
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
