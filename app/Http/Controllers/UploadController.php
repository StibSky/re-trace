<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;

        $request->userfile->store('userFiles/'.$firstname."_".$lastname , 'public');
        return redirect()->route('home');
    }
}
