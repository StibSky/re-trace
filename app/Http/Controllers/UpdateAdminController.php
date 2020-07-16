<?php

namespace App\Http\Controllers;

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

    public function update()
    {

    }
}
