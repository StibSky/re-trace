<?php

namespace App\Http\Controllers;

use App\Building;
use App\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = new UploadedFile();

        if (isset($_POST['upload'])) {
            $file->setName(($request->input("name"))? $request->input("name") : $request->userfile->getClientOriginalName());
            $file->setFormat($request->userfile->getClientOriginalExtension());
            $file->setType($request->input("type"));
            $user = Auth::user();
            $file->setUserId($user->id);
            $file->setProjectId($request->input("projectId"));
            $file->save();
        }

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;

        $projectFolder = Building::where('id', $request->input("projectId"))->first()->projectName;

        $request->userfile->store('userFiles/'.$firstname."_".$lastname."/".$projectFolder , 'public');
        return redirect()->route('home');
    }
}
