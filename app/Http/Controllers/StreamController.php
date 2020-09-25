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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Faker\Provider\pt_BR\check_digit;

class StreamController extends Controller
{
    public function streams1(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

        $image = $request->session()->get('image');

        $project = Building::all()->find($id);

        $filename = $request->session()->get('image.name');
        $projectFolder = $project->projectName;
        $firstname = User::where('id', $project->userid)->first()->first_name;
        $lastname = User::where('id', $project->userid)->first()->last_name;
        $authid = User::where('id', $project->userid)->first()->id;

        $targetFolder = '/public/userFiles/' . $authid . '/' . $projectFolder;

        if (is_dir(Storage::path($targetFolder))) {
            $targetFile = $targetFolder . '/' . $filename;

            $fullPath = Storage::path($targetFile);

            $base64 = base64_encode(Storage::get($targetFile));
            $image_data = 'data:' . mime_content_type($fullPath) . ';base64,' . $base64;
        } else {
            $targetFile = null;
            $image_data = null;
        }

        return view('streams.add-streams1', [
            'stream' => $stream,
            'project' => $project,
            'targetFile' => $targetFile,
            'image_data' => $image_data
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
            return back()->with('error', __('invalid file type'));
        }

        $image->setName($imagename);

        $request->session()->put('image', $image);

        $firstname = Auth::user()->first_name;
        $lastname = Auth::user()->last_name;
        $authid = Auth::user()->id;

        $projectFolder = Building::where('id', $request->input("projectId"))->first()->projectName;

        $request->streamImage->storeAs('userFiles/' . $authid . "/" . $projectFolder, $imagename, 'public');

        return back()->with('success', __('image uploaded'));
    }

    public function addStreams1(Request $request, $id)
    {
        if (empty($request->session()->get('stream'))) {
            $stream = new Stream();
        } else {
            $stream = $request->session()->get('stream');
        }

        if ($request->input("streamName") == null) {
            return redirect()->back()->withInput()->with('error', __('please fill in a name'));
        }
        if ($request->input("streamAction") == null) {
            return redirect()->back()->withInput()->with('error', __('please select an action'));
        }

        if ($request->session()->get('image') == null) {
            return redirect()->back()->withInput()->with('error', __('please upload an image'));
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
            return redirect()->back()->withInput()->with('error', 'please select an origin');
        }

        $stream->setCategory($request->input("category"));

        $request->session()->put('stream', $stream);

        return redirect('/add-streams3/' . $id);
    }

    public function streams3(Request $request, $id)
    {
        $tag = $request->session()->get('tag');

        $substanceHeadCategory = DB::table('substance')
            ->whereRaw("parent IS NULL AND is_hazardous != 1")->get();
        $substanceSubCategory1 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NULL)AND is_hazardous != 1")->get();
        $substanceSubCategory2 = DB::table('substance')
            ->whereRaw("parent IS NOT NULL AND parent IN (SELECT id FROM substance WHERE parent IS NOT NULL)AND is_hazardous != 1")->get();

        $functionHeadCategory = DB::table('materialFunction')
            ->whereRaw("parent IS NULL")->get();

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
//        if (empty($request->session()->get('tag'))) {
//            $tag = new Tag();
//        } else {
//            $tag = $request->session()->get('tag');
//        }
        if ($request->input("substance") == null && $request->input("materialFunction") == null) {
            return redirect()->back()->withInput()->with('error', __('please select at least one material and/or function'));
        }

        $sessionMaterials = [];
        $materialIds = [];

        if (isset($_POST["substance"])) {
            for ($i = 0; $i < count($_POST["substance"]); $i++) {
                ${'materialTag' . $i} = new Tag();
                ${'materialTag' . $i}->setMaterialId($_POST["substance"][$i]);
                array_push($sessionMaterials, ${'materialTag' . $i});

                array_push($materialIds, $_POST["substance"][$i]);

            }
        }
        $request->session()->put('materialSession', $sessionMaterials);
        $request->session()->put('materialIds', $materialIds);


        $sessionFunctions = [];
        $functionIds = [];

        if (isset($_POST["materialFunction"])) {
            for ($i = 0; $i < count($_POST["materialFunction"]); $i++) {
                ${'functionTag' . $i} = new Tag();
                ${'functionTag' . $i}->setFunctionId($_POST["materialFunction"][$i]);
                array_push($sessionFunctions, ${'functionTag' . $i});
                array_push($functionIds, $_POST["materialFunction"][$i]);
            }
        }
        $request->session()->put('functionSession', $sessionFunctions);
        $request->session()->put('functionIds', $functionIds);


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
            return redirect()->back()->withInput()->with('error', __('please give a quantity'));
        }

        if ($request->input("streamUnit") == null) {
            return redirect()->back()->withInput()->with('error', __('please give a unit of measurement'));
        }

        $quantity = $request->input("streamQuantity");
        $quantity = str_replace(',', '.', $quantity);

        $stream->setQuantity($quantity * 1000);
        $stream->setUnitId($request->input("streamUnit"));

        if ($request->input("streamPrice") == null) {
            return redirect()->back()->withInput()->with('error', __('please give a price'));
        }

        /*        if ($request->input("streamValuta") == null) {
                    return redirect()->back()->withInput()->with('error', __('please give a currency'));
                }*/

        $price = $request->input("streamPrice");
        $price = str_replace(',', '.', $price);
        $price = str_replace('€', '', $price);

        $stream->setPrice($price * 100);
        $stream->setValutaId('1');

        $request->session()->put('stream', $stream);

        return redirect('/confirmStream/' . $id);
    }

    public function confirm(Request $request, $id)
    {
        $stream = $request->session()->get('stream');

        $functionArray = null;

        $materialArray = null;

        if ($request->session()->get('materialSession')) {
            $materialArray = [];

            $materialTags = $request->session()->get('materialSession');

            foreach ($materialTags as $materialTag) {
                $material = Substance::with('tags')
                    ->where('id', $materialTag->getMaterialId())
                    ->first();
                array_push($materialArray, $material);
            }
        }

        if ($request->session()->get('functionSession')) {
            $functionArray = [];

            $functionTags = $request->session()->get('functionSession');

            foreach ($functionTags as $functionTag) {
                $streamFunction = MaterialFunction::with('tags')
                    ->where('id', $functionTag->getFunctionId())
                    ->first();
                array_push($functionArray, $streamFunction);
            }
        }

        $unit = Unit::with('stream')
            ->where('id', $stream->getUnitId())
            ->first();

        $valuta = Valuta::with('stream')
            ->where('id', $stream->getValutaId())
            ->first();

        return view('streams.confirm',
            ['stream' => $stream,
                'id' => $id,
                'materialArray' => $materialArray,
                'functionArray' => $functionArray,
                'unit' => $unit,
                'valuta' => $valuta]);
    }

    public function store(Request $request, $id)
    {
        $stream = $request->session()->get('stream');


        $image = $request->session()->get('image');

        $stream->save();

        if ($request->session()->get('materialSession')) {

            $materialTags = $request->session()->get('materialSession');

            foreach ($materialTags as $materialTag) {
                $materialTag->setStreamId($stream->id);
                $materialTag->save();
            }
        }

        if ($request->session()->get('functionSession')) {
            $functionTags = $request->session()->get('functionSession');

            foreach ($functionTags as $functionTag) {
                $functionTag->setStreamId($stream->id);
                $functionTag->save();
            }
        }

        $image->setStreamId($stream->id);
        $image->save();

        $request->session()->forget('stream');
        $request->session()->forget('materialSession');
        $request->session()->forget('functionSession');
        $request->session()->forget('image');
        $request->session()->forget('materialIds');
        $request->session()->forget('functionIds');

        return redirect()->route('dash', $id)->with('success', __('Stream added successfully'));
    }

    public function cancel(Request $request)
    {
        $request->session()->forget('stream');
        $request->session()->forget('materialSession');
        $request->session()->forget('functionSession');
        $request->session()->forget('image');
        $request->session()->forget('materialIds');
        $request->session()->forget('functionIds');
    }

    public function streamView($id)
    {
        $stream = DB::table('streams')->where('id', $id)->first();
        $name = $stream->name;
        $description = $stream->description;
        $category = $stream->category;
        $action = $stream->action;
        $unit = DB::table('unit')->where('id', $stream->unit_id)->first()->short_name;
        $quantity = $stream->quantity;
        $valuta = DB::table('valuta')->where('id', $stream->valuta_id)->first()->symbol;
        $price = $stream->price;

        $materialTags = DB::table('tags')->whereRaw('stream_id = ' . $id . ' AND material_id IS NOT NULL')
            ->get();

        $materialIds = [];

        foreach ($materialTags as $materialTag) {
            array_push($materialIds, $materialTag->material_id);
        }

        $materials = [];
        foreach ($materialIds as $materialId) {
            array_push($materials, DB::table('substance')->where('id', $materialId)->first());
        }

        $functionTags = DB::table('tags')->whereRaw('stream_id = ' . $id . ' AND function_id IS NOT NULL')
            ->get();

        $functionIds = [];

        foreach ($functionTags as $functionTag) {
            array_push($functionIds, $functionTag->function_id);
        }

        $functions = [];
        foreach ($functionIds as $functionId) {
            array_push($functions, DB::table('materialFunction')->where('id', $functionId)->first());
        }

        return view('streams.streamview', [
            'name' => $name,
            'description' => $description,
            'category' => $category,
            'action' => $action,
            'unit' => $unit,
            'quantity' => $quantity,
            'valuta' => $valuta,
            'price' => $price,
            'materials' => $materials,
            'functions' => $functions
        ]);
    }
}
