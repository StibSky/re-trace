<?php

namespace App\Http\Controllers;

use App\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = new UploadedFile();

        if (isset($_POST['upload'])) {
            $file->setName($request->userfile->getClientOriginalName());
            $file->setType($request->userfile->getClientOriginalExtension());
            $user = Auth::user();
            $file->setUserId($user->id);
            $file->setProjectId($request->input("projectId"));
            $file->save();
        }

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;

        $request->userfile->store('userFiles/'.$firstname."_".$lastname , 'public');
        return redirect()->route('home');
    }
}
