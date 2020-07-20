<?php

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

Route::get('/newBuilding', 'NewBuildingController@step1')->name('building');
Route::post('/newBuilding', 'NewBuildingController@addStep1')->name('newBuilding');
Route::get('/newBuilding2', 'NewBuildingController@step2')->name('building2');
Route::post('/newBuilding2', 'NewBuildingController@addStep2')->name('newBuilding2');
Route::get('/newBuilding3', 'NewBuildingController@step3')->name('building3');
Route::post('/newBuilding3', 'NewBuildingController@addStep3')->name('newBuilding3');
Route::get('/newBuilding4', 'NewBuildingController@step4')->name('building4');
Route::post('/newBuilding4', 'NewBuildingController@addStep4')->name('newBuilding4');
//route with dynamic linking for specific buildings
Route::get('/dashboard/{id}', 'DashboardController@index')->name('dash');
Route::get('/updateBuilding', 'NewBuildingController@updateBuildingIndex')->name('updateBuilding');

//->middleware('auth')



