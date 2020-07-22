<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return view('app');
    }
    else {
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/building', 'NewBuildingController@index')->name('building');
Route::post('/newBuilding', 'NewBuildingController@addBuilding')->name('newBuilding');
Route::post('/deleteBuilding', 'NewBuildingController@deleteBuilding')->name('deleteBuilding');
Route::get('/editBuilding/{id}', 'NewBuildingController@editBuilding')->name('editBuilding');
Route::post('/saveEdit', 'NewBuildingController@saveEdit')->name('saveEdit');


//route with dynamic linking for specific buildings
Route::get('/dashboard/{id}', 'DashboardController@index')->name('dash');
//route to upload files,
//==========================================
//MIGHT WORK DIFFERENT AFTER REDEPLOYMENT
//=========================================
Route::post('/upload', function (Request $request ){
    $request->userfile->store('userFiles','public');
    return redirect()->route('home');
})->name('upload');

Route::get('/updateadmin', 'UpdateAdminController@index')->name('updateAdmin');
Route::post('/saveadmindb', 'UpdateAdminController@update')->name('saveAdmin');


//



