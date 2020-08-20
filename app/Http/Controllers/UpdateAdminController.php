<?php

namespace App\Http\Controllers;

use App\Building;
use App\Substance;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class UpdateAdminController extends Controller
{
    /*
     * Divides the substance database into 3 main categories, this way it is easier
     * to trace what kind of material you are dealing with
     *
     *     /*   ===================================================================================================
            FIND A WAY TO DEAL WITH MAGIC NUMBERS
         ===================================================================================================
    */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please log in and make sure you are admin to access this page');
        }
        if (Auth::user()->type != 'admin') {
            return redirect()->back();
        }

        $headCategory = Substance::whereNull('parent')->get();

        $subCategory1 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NULL)")->get();

        $subCategory2 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NOT NULL)")->get();


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

        function parseTree($tree, $root = null)
        {
            $return = array();
            # Traverse the tree and search for direct children of the root
            foreach ($tree as $child => $parent) {
                # A direct child is found
                if ($parent == $root) {
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

        return view('adminDatabase.admindb', [
            'headCategories' => $headCategory,
            'subCategories1' => $subCategory1,
            'subCategories2' => $subCategory2,
            'units' => $unit,
            'tree' => $result
        ]);
    }

    public static function getNameFunction($id)
    {
        $substanceElement = DB::table('substance')
            ->where('id', $id)->first();


        return $substanceElement->code . " " . $substanceElement->name;
    }

    /*
     * This function fills in the Substance database
     * makes use of Unit foreign key
     * error handling for each field that is explicitly required
     */
    public function update(Request $request)
    {
        $substance = new Substance();
        if (isset($_POST['addSubstance'])) {
            $substance->setName($request->input('name'));
            $substance->setNameNl($request->input('name_nl'));
            $substance->setNameFr($request->input('name_fr'));
            $substance->setSpecificWeight($request->input('specific_weight'));
            $substance->setComments($request->input('comment'));
            $substance->setParent($request->input('parent'));
            $substance->setIsHazardous($request->input('is_hazardous'));
            $substance->setUnitId($request->input('unit_id'));


            if ($substance->getParent() != null && $request->input('code') != null) {
                return back()->withInput()->with('error', 'you cannot select a parent if you fill in a code yourself');
            }
            //AUTOMATIC NUMBERING PROGRESS
            if (($substance->getParent()) != null && $request->input('code') == null) {
                $parentCode = Substance::where('id', $substance->getParent())->first()->code;
                $parentId = Substance::where('id', $substance->getParent())->first()->id;
            } else {
                $parentCode = 0;
                $substance->setCode($request->input('code'));
            }

            if (strlen($parentCode) == 6) {
                if ((Substance::where('parent', $parentId)->orderby('id', 'DESC')->first()) == null) {
                    $substance->setCode(($parentCode * 10000) + 1);
                } else {
                    $child = (Substance::where('parent', $parentId)->orderby('id', 'DESC')->first()->code) + 1;
                    $substance->setCode($child);
                }
            } elseif (strlen($parentCode) == 4) {
                if ((Substance::where('parent', $parentId)->orderby('id', 'DESC')->first()) == null) {
                    $substance->setCode(($parentCode * 100) + 1);
                } else {
                    $child = (Substance::where('parent', $parentId)->orderby('id', 'DESC')->first()->code) + 1;
                    $substance->setCode($child);
                }
            }
            if ($substance->getName() == null) {
                return back()->withInput()->with('error', 'please fill in a name');
            }
            if ($substance->getSpecificWeight() == null) {
                return back()->withInput()->with('error', 'please fill in a weight (0 if you dont know)');
            }
            if (Substance::where('code', $substance->getCode())->first()) {
                return back()->withInput()->with('error', 'this code already exists');
            }
            if (strlen($substance->getCode()) == 4 || strlen($substance->getCode()) == 6 || strlen($substance->getCode()) == 10) {
                $substance->save();
                return redirect()->back()->with('success', 'IT WORKS!');
            } else {
                return back()->withInput()->with('error', 'Code for new stream must be 4 characters long');
            }
            //$parent = Substance::where();
            //$substance->setParent($parent->code);
        }

    }

}
