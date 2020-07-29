<?php

namespace App\Http\Controllers;

use App\Building;
use App\UploadedFile;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = new UploadedFile();

        if (isset($_POST['upload'])) {
            $file->setName(($request->input("name"))?? $request->userfile->getClientOriginalName());
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

        $filebasename = $request->input("name") ?? $request->userfile->getClientOriginalName();

        $originalExtension = $request->userfile->getClientOriginalExtension();

        $filename = Str::contains($filebasename, $originalExtension) ? $filebasename : $filebasename.".".$originalExtension;

        $request->userfile->storeAs('userFiles/'.$firstname."_".$lastname."/".$projectFolder , $filename, 'public');

        return redirect()->route('home');
    }

    public function viewFiles($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();

        return view('dashboard.files', [
            'projectfiles' => $projectfiles
        ]);

    }

    public function downloadFile($id)
    {
        $file = UploadedFile::where('id', $id)->first();
        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;
        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $filename = $file->name;

        $targetFile = public_path().'/storage/userFiles/'.$firstname.'_'.$lastname.'/'.$projectFolder.'/'.$filename;

        return response()->download($targetFile);
    }
}
