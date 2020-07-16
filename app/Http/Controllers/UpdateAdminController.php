<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateAdminController extends Controller
{
    public function index()

    {


        return view('adminDatabase.admindb');
    }

    public function update(){

    }
}
