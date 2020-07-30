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

        if ($request->userfile != null) {
            $filebasename = $request->input("name") ?? $request->userfile->getClientOriginalName();

            $originalExtension = $request->userfile->getClientOriginalExtension();

            $filename = Str::contains($filebasename, $originalExtension) ? $filebasename : $filebasename . "." . $originalExtension;

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
            ->orderBy("type")
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

        $targetFile = storage_path('app/public/userFiles/' . $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);

        return response()->download($targetFile);
    }
}
