<?php

namespace App\Http\Controllers;

use App\Building;
use App\UploadedFile;
use App\User;
use bar\baz\source_with_namespace;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function __construct()
    {

    }

    public function upload(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login')->with('error', __('You were inactive for too long and logged out automatically'));
        }

        $file = new UploadedFile();
        if ($request->userfile == null) {
            return back()->with('error', __('please select a file'));
        }

        $filebasename = $request->input("name") ?? $request->userfile->getClientOriginalName();

        //get filebasename and sanitise

        $originalExtension = $request->userfile->getClientOriginalExtension();

        $filename = Str::contains($filebasename, $originalExtension) ? $filebasename : $filebasename . "." . $originalExtension;

        $allowedFiles = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'image/png', 'image/jpeg',
            'application/msword', 'text/plain', 'image/vnd.dwg', 'application/vnd.mcd', 'application/vnd.vwx', 'application/vnd.ifc', 'application/octet-stream',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        //make array and check met in_array
        $mimetype = $request->userfile->getMimeType();
        if (!in_array($mimetype, $allowedFiles)) {
            return back()->with('error', __('invalid file type'));
        }

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
        $authid = Auth::user()->id;


        $projectFolder = Building::where('id', $request->input("projectId"))->first()->projectName;
        //dd($request->userfile->getMimeType());

        $request->userfile->storeAs('userFiles/' . $authid . "/" . $projectFolder, $filename, 'public');

        return back()->with('success', __('file uploaded'));

    }

    public
    function viewFiles($id)
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

    public
    function downloadFile($id)
    {
        $file = UploadedFile::where('id', $id)->first();
        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;
        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $filename = $file->name;
        $authid = Auth::user()->id;


        $targetFile = storage_path('app/public/userFiles/' . $authid . '/' . $projectFolder . '/' . $filename);

        return response()->download($targetFile);
    }

    public
    function deleteFile(Request $request)
    {
        $file = UploadedFile::where('id', $request->input("fileId"))->first();

        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $authid = Auth::user()->id;

        $filename = $file->name;

        $targetFile = storage_path('app/public/userFiles/' . $authid . '/' . $projectFolder . '/' . $filename);

        unlink($targetFile);

        $file->delete();

        return redirect()->back()->with('success', __('File deleted successfully'));
    }

    public
    function previewFiles($id)
    {
        $authid = Auth::user()->id;
        $registeredUser = DB::table('users')
            ->whereRaw($authid . " IN (SELECT userId FROM uploaded_file where projectId = ". $id ." )")->get();
        if ($registeredUser !=null ){
        $file = UploadedFile::where('id', $id)->first();
        $projectFolder = Building::where('id', $file->projectId)->first()->projectName;
        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $filename = $file->name;

        $targetFile = storage_path('app/public/userFiles/' . $authid . '/' . $projectFolder . '/' . $filename);
        //$targetFile =  ('storage/userFiles/'. $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);

        /* return view('dashboard.previewFiles', [
             'targetFile' => $targetFile,
         ]);*/
        return response()->file($targetFile);
        }
        return back()->withErrors("not allowed");
    }

    public function measuringstate($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Measuring state";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype
        ]);
    }

    public function location($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Location";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype
        ]);

    }

    public function surface($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Surface";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype

        ]);
    }

    public function volume($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Volume";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype

        ]);
    }

    public function materiallist($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Material list";


        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype

        ]);
    }

    public function plans($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Plans";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype

        ]);
    }

    public function photosexterior($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Photos exterior";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype

        ]);
    }

    public function photosinterior($id)
    {
        $projectfiles = DB::table('uploaded_file')
            ->where('projectId', $id)
            ->get();
        //->groupBy("type");

        $project = Building::where('id', $id)->first();

        $projecttypes = $projectfiles->pluck("type")->unique();

        $filetype = "Photos interior";

        return view('files.typefiles', [
            'project' => $project,
            'projectfiles' => $projectfiles,
            'projecttypes' => $projecttypes,
            'filetype' => $filetype

        ]);
    }
}
