<?php

namespace App\Http\Controllers;

use App\Building;
use App\UploadedFile;
use App\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    //========================================================================================================================
    //IMPORTANT CHECK THAT ONLY TYPES OF DOCUMENTS CAN BE UPLOADED WE ACTUALLY WANT! CHECK MIME_CONTENT
    //========================================================================================================================

    public function upload(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', 'You were inactive for too long and logged out automatically');
        }

        $file = new UploadedFile();
//swap if
        //check if userfile instanceof
        if ($request->userfile != null) {
            $filebasename = $request->input("name") ?? $request->userfile->getClientOriginalName();

            $originalExtension = $request->userfile->getClientOriginalExtension();

            $filename = Str::contains($filebasename, $originalExtension) ? $filebasename : $filebasename . "." . $originalExtension;

            //be careful with $post
            if (isset($_POST['upload'])) {
                $file->setName($filename);
                $file->setFormat($originalExtension);
                $file->setType($request->input("type"));
                $user = Auth::user();
                $file->setUserId($user->id);
                $file->setProjectId($request->input("projectId"));
                $file->save();
            }

            $firstname = Auth::user()->first_name;
            $lastname = Auth::user()->last_name;

            $projectFolder = Building::where('id', $request->input("projectId"))->first()->projectName;

            //make constant of path
            $request->userfile->storeAs('userFiles/' . $firstname . "_" . $lastname . "/" . $projectFolder, $filename, 'public');

            return back()->with('success', 'file uploaded');
        } else {
            return back()->with('error', 'please select a file');
        }
    }

    public function viewFiles($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        //dd();

        return view('dashboard.files', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'firstname' => $firstname,
            'lastname' => $lastname,
        ]);

    }

    public function downloadFile($id)
    {
        $file = UploadedFile::where('id', $id)->first();
        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;
        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $filename = $file->name;

        $targetFile = storage_path('app/public/userFiles/' . $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);

        return response()->download($targetFile);
    }

    public function deleteFile(Request $request)
    {
        $file = UploadedFile::where('id', $request->input("fileId"))->first();

        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $filename = $file->name;

        $targetFile = storage_path('app/public/userFiles/' . $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);

        unlink($targetFile);

        $file->delete();

        return redirect()->back()->with('success', 'File deleted successfully');
    }

    public function previewFiles($id)
    {
        $file = UploadedFile::where('id', $id)->first();
        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;
        $firstname = User::where('id',$file->userId)->first()->first_name;
        $lastname = User::where('id',$file->userId)->first()->last_name;
        $filename = $file->name;

        $targetFile =  ('storage/app/public/userFiles/'. $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);
        //$targetFile =  ('storage/userFiles/'. $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);

        /* return view('dashboard.previewFiles', [
             'targetFile' => $targetFile,
         ]);*/
        return response()->file($targetFile);

    }
}
