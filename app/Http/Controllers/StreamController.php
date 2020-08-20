<?php

namespace App\Http\Controllers;

use App\Building;
use App\Stream;
use App\StreamImage;
use App\MaterialFunction;
use App\Substance;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Valuta;
use App\Unit;
use Illuminate\Support\Str;

class StreamController extends Controller
{
    public function streams1(Request $request, $id)
    {
        $stream = $request->session()->get('stream');
        $tag = $request->session()->get('tag');

        $image = $request->session()->get('image');

        $project = Building::all()->find($id);

        $filename = $request->session()->get('image.name');
        $projectFolder = $project->projectName;
        $firstname = User::where('id', $project->userid)->first()->first_name;
        $lastname = User::where('id', $project->userid)->first()->last_name;

        $targetFile = ('storage/userFiles/' . $firstname . '_' . $lastname . '/' . $projectFolder . '/' . $filename);

        var_dump($targetFile);

        return view('streams.add-streams1', [
            'stream' => $stream,
            'tag' => $tag,
            'project' => $project,
            'targetFile' => $targetFile
        ]);
    }

    public function uploadStreamImage(Request $request)
    {
        if (empty($request->session()->get('image'))) {
            $image = new StreamImage();
        } else {
            $image = $request->session()->get('image');
        }

        $imagebasename = $request->input("name") ?? $request->streamImage->getClientOriginalName();

        $originalExtension = $request->streamImage->getClientOriginalExtension();

        $imagename = Str::contains($imagebasename, $originalExtension) ? $imagebasename : $imagebasename . "." . $originalExtension;

        $allowedFiles = ['image/png', 'image/jpeg', 'image/vnd.dwg'];

        $mimetype = $request->streamImage->getMimeType();

        if (!in_array($mimetype, $allowedFiles)) {
            return back()->with('error', 'invalid file type');
        }

        $image->setName($imagename);

        $request->session()->put('image', $image);

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;

        $projectFolder = Building::where('id', $request->input("projectId"))->first()->projectName;

        $request->streamImage->storeAs('userFiles/' . $firstname . "_" . $lastname . "/" . $projectFolder, $imagename, 'public');

        return back()->with('success', 'image uploaded');
    }

    public function addStreams1(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("streamName") == null) {
            return redirect()->back()->withInput()->with('error', 'please fill in a name');
        }
        if ($request->input("streamAction") == null) {
            return redirect()->back()->withInput()->with('error', 'please select an action');
        }

        $stream->setName($request->input("streamName"));
        $stream->setDescription($request->input("streamDescription"));
        $stream->setAction($request->input('streamAction'));
        $stream->setBuildid($id);

        $request->session()->put('stream', $stream);

        return redirect('/add-streams2/' . $id);
    }

    public function streams2(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

        return view('streams.add-streams2', [
            'stream' => $stream,
            'id' => $id
        ]);
    }

    public function addStreams2(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("category") == null) {
            return redirect()->back()->withInput()->with('error', 'please select a destination');
        }

        $stream->setCategory($request->input("category"));

        $request->session()->put('stream', $stream);

        return redirect('/add-streams3/' . $id);
    }

    public function streams3(Request $request, $id)
    {
        $tag = $request->session()->get('tag');

        $substanceHeadCategory = Substance::whereNull('parent')->get();

        $substanceSubCategory1 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NULL)")->get();

        $substanceSubCategory2 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NOT NULL)")->get();

        $functionHeadCategory = MaterialFunction::whereNull('parent')->get();

        $functionSubCategory1 = DB::table('materialFunction')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM materialFunction WHERE parent IS NULL)")->get();

        $functionSubCategory2 = DB::table('materialFunction')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM materialFunction WHERE parent IS NOT NULL)")->get();

        return view('streams.add-streams3', [
            'substanceHeadCategories' => $substanceHeadCategory,
            'substanceSubCategories1' => $substanceSubCategory1,
            'substanceSubCategories2' => $substanceSubCategory2,
            'functionHeadCategories' => $functionHeadCategory,
            'functionSubCategories1' => $functionSubCategory1,
            'functionSubCategories2' => $functionSubCategory2,
            'tag' => $tag,
            'id' => $id
        ]);
    }

    public function addStreams3(Request $request, $id)
    {
        if (empty($request->session()->get('tag'))) {
            $tag = new Tag();
        } else {
            $tag = $request->session()->get('tag');
        }

        if ($request->input("substance") == null) {
            return redirect()->back()->withInput()->with('error', 'please select a material');
        }

        $tag->setMaterialId($request->input("substance"));

        if ($request->input("materialFunction") == null) {
            return redirect()->back()->withInput()->with('error', 'please select a function');
        }

        $tag->setFunctionId($request->input("materialFunction"));

        $request->session()->put('tag', $tag);

        return redirect('/add-streams4/' . $id);
    }

    public function streams4(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

        $units = Unit::all();

        $valutas = Valuta::all();

        return view('streams.add-streams4', [
            'stream' => $stream,
            'id' => $id,
            'units' => $units,
            'valutas' => $valutas
        ]);
    }

    public function addStreams4(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("streamQuantity") == null) {
            return redirect()->back()->withInput()->with('error', 'please give a quantity');
        }

        if ($request->input("streamUnit") == null) {
            return redirect()->back()->withInput()->with('error', 'please give a unit of measurement');
        }

        $stream->setQuantity($request->input("streamQuantity"));
        $stream->setUnitId($request->input("streamUnit"));

        if ($request->input("streamPrice") == null) {
            return redirect()->back()->withInput()->with('error', 'please give a price');
        }

        if ($request->input("streamValuta") == null) {
            return redirect()->back()->withInput()->with('error', 'please give a currency');
        }

        $stream->setPrice($request->input("streamPrice"));
        $stream->setValutaId($request->input("streamValuta"));

        $request->session()->put('stream', $stream);

        return redirect('/confirm/' . $id);
    }

    public function confirm(Request $request, $id)
    {
        $stream = $request->session()->get('stream');
        $tag = $request->session()->get('tag');

        $material = Substance::with('tags')
            ->where('id', $tag->getMaterialId())
            ->first();

        $streamFunction = MaterialFunction::with('tags')
            ->where('id', $tag->getFunctionId())
            ->first();

        $unit = Unit::with('stream')
            ->where('id', $stream->getUnitId())
            ->first();

        $valuta = Valuta::with('stream')
            ->where('id', $stream->getValutaId())
            ->first();

        return view('streams.confirm',
            ['stream' => $stream,
                'tag' => $tag,
                'id' => $id,
                'material' => $material,
                'streamFunction' => $streamFunction,
                'unit' => $unit,
                'valuta' => $valuta]);
    }

    public function store(Request $request, $id)
    {
        $stream = $request->session()->get('stream');
        $tag = $request->session()->get('tag');
        $image = $request->session()->get('image');

        $stream->save();

        $tag->setStreamId($stream->id);
        $image->setStreamId($stream->id);

        $tag->save();
        $image->save();

        $request->session()->forget('stream');
        $request->session()->forget('tag');
        $request->session()->forget('image');

        return redirect()->route('dash', $id)->with('success', 'Stream added successfully');
    }
}
