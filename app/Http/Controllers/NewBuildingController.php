<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class newBuildingController extends Controller
{

    public function step1(Request $request)
    {
        $building = $request->session()->get('building');

        var_dump($building);

        return view('new-building.new-building', compact('building'));
    }

    public function updateBuildingIndex()
    {
        return view('new-building.updateBuilding');
    }

    public function addBuilding(Request $request) {
        $building = new Building();
        if (isset($_POST['submitNewBuilding'])){
            $building->setAddress1($request->input('inputAddress'));
            $building->setAddress2($request->input('inputAddress2'));
            $building->setCity($request->input('inputCity'));
            $building->setPostcode($request->input('inputPostCode'));
            $building->setType($request->input('type'));
            $user = Auth::user();
            $building->setUserid($user->id);
            $building->save();
        }
        if (isset($_POST['submitBuildingInfo'])) {
            $building = Building::where('userid', Auth::id())->first();
            $building->setImage($request->input('buildingImage'));
            $building->save();
        }
        return redirect()->route('home');
    }

    public function addStep1(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:building',
        ]);
        if(empty($request->session()->get('building'))){
            $building = new Building();
            $building->fill($validatedData);
            $request->session()->put('building', $building);
        }else{
            $building = $request->session()->get('building');
            $building->fill($validatedData);
            $request->session()->put('building', $building);
        }
        return redirect('/newBuilding2');
    }

    public function step2(Request $request)
    {
        $building = $request->session()->get('building');

        return view('new-building.new-building2',compact('building'));
    }

    public function PostcreateStep2(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|unique:building',
        ]);
        if(empty($request->session()->get('building'))){
            $building = new \App\building();
            $building->fill($validatedData);
            $request->session()->put('building', $building);
        }else{
            $building = $request->session()->get('building');
            $building->fill($validatedData);
            $request->session()->put('building', $building);
        }
        return redirect('/newBuilding3');
    }

    public function createStep3(Request $request)
    {
        $building = $request->session()->get('building');
        return view('new-building.new-building3',compact('building'));
    }

    public function PostcreateStep3(Request $request)
    {
        $building = $request->session()->get('building');

        if(!isset($building->productImg)) {
            $request->validate([
                'productimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $fileName = "productImage-" . time() . '.' . request()->productimg->getClientOriginalExtension();
            $request->productimg->storeAs('productimg', $fileName);
            $building = $request->session()->get('building');
            $building->productImg = $fileName;
            $request->session()->put('building', $building);
        }
        return view('new-building.new-building4',compact('building'));
    }

    public function removeImage(Request $request)
    {
        $building = $request->session()->get('building');

        $building->productImg = null;

        return view('building.step3',compact('building'));
    }

    public function store(Request $request)
    {
        $building = $request->session()->get('building');

        $building->save();

        return redirect('/data');
    }




}
