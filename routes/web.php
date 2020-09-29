<?php

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

/*Route::get('/', function () {
    if (Auth::check()) {
        return view('app');
    } else {
        return view('auth.login');
    }
});*/

Auth::routes(['verify' => true]);

Route::get('/maptest', 'mapController@maptest')->name('maptest');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


Route::get('/', 'HomeController@index')->name('home');
Route::post('/deleteBuilding', 'NewBuildingController@deleteBuilding')->name('deleteBuilding');
Route::post('/deleteStream', 'StreamController@deleteStream')->name('deleteStream');
Route::post('/setStreamUnavailable', 'StreamController@setStreamUnavailable')->name('setStreamUnavailable');
Route::post('/saveEdit', 'NewBuildingController@saveEdit')->name('saveEdit');

Route::get('/newBuilding', 'NewBuildingController@step1')->name('building');
Route::post('/newBuilding', 'NewBuildingController@addStep1')->name('newBuilding');
Route::get('/newBuilding2', 'NewBuildingController@step2')->name('building2');
Route::post('/newBuilding2', 'NewBuildingController@addStep2')->name('newBuilding2');
Route::get('/newBuilding3', 'NewBuildingController@step3')->name('building3');
Route::post('/newBuilding3', 'NewBuildingController@addStep3')->name('newBuilding3');
Route::get('/newBuilding4', 'NewBuildingController@step4')->name('building4');
Route::post('/newBuilding4', 'NewBuildingController@addStep4')->name('newBuilding4');
Route::get('/confirm', 'NewBuildingController@confirm')->name('confirm');
Route::post('/store', 'NewBuildingController@store')->name('store');

//route with dynamic linking for specific buildings
Route::get('/dashboard/{id}', 'DashboardController@index')->name('dash');
Route::get('/overview/{id}', 'DashboardController@overview')->name('overview');
Route::get('/admindashboard', 'DashboardController@adminDashboard')->name('adminDashboard');

Route::get('/add-streams1/{id}', 'StreamController@streams1')->name('streams1');
Route::get('/add-streams2/{id}', 'StreamController@streams2')->name('streams2');
Route::get('/add-streams3/{id}', 'StreamController@streams3')->name('streams3');
Route::get('/add-streams4/{id}', 'StreamController@streams4')->name('streams4');
Route::post('/add-streams1/{id}', 'StreamController@addStreams1')->name('add-streams1');
Route::post('/add-streams2/{id}', 'StreamController@addStreams2')->name('add-streams2');
Route::post('/add-streams3/{id}', 'StreamController@addStreams3')->name('add-streams3');
Route::post('/add-streams4/{id}', 'StreamController@addStreams4')->name('add-streams4');

Route::get('/confirmStream/{id}', 'StreamController@confirm')->name('confirmStream');
Route::post('/storeStream/{id}', 'StreamController@store')->name('storeStream');

Route::get('/files/{id}', 'UploadController@viewFiles')->name('viewFiles');
Route::get('/download/{id}', 'UploadController@downloadFile')->name('downloadFile');
Route::get('/previewFiles/{id}', 'UploadController@previewFiles')->name('previewFiles');
Route::get('/Measuringstate/{id}', 'UploadController@measuringstate')->name('Measuringstate');
Route::get('/Location/{id}', 'UploadController@location')->name('Location');
Route::get('/Surface/{id}', 'UploadController@surface')->name('Surface');
Route::get('/Volume/{id}', 'UploadController@volume')->name('Volume');
Route::get('/Materiallist/{id}', 'UploadController@materiallist')->name('Materiallist');
Route::get('/Plans/{id}', 'UploadController@plans')->name('Plans');
Route::get('/Photosexterior/{id}', 'UploadController@photosexterior')->name('Photosexterior');
Route::get('/Photosinterior/{id}', 'UploadController@photosinterior')->name('Photosinterior');
Route::post('/deleteFile', 'UploadController@deleteFile')->name('deleteFile');
//route to upload files,
//==========================================
//MIGHT WORK DIFFERENT AFTER REDEPLOYMENT
//=========================================
Route::post('/upload', 'UploadController@upload')->name('upload');
Route::post('/uploadStreamImage', 'StreamController@uploadStreamImage')->name('uploadStreamImage');


Route::get('/updateadmin', 'UpdateAdminController@index')->name('updateAdmin');
Route::post('/saveadmindb', 'UpdateAdminController@update')->name('saveAdmin');

Route::get('/updateadminfunctions', 'MaterialFunctionController@index')->name('updateadminfunctions');
Route::post('/saveadminfunctions', 'MaterialFunctionController@update')->name('saveadminfunctions');


Route::post('/mysearch', 'HomeController@mysearch')->name('mysearch');
Route::post('/editUserInfo', 'HomeController@editUserInfo')->name('editUserInfo');
Route::post('/editDashInfo/{id}', 'DashboardController@editDashInfo')->name('editDashInfo');

Route::get('/streamView/{id}', 'StreamController@streamView')->name('streamView');

/*Route::get( '/verify-test', function () {
    // Get a user for demo purposes
    $user = App\User::find(1);
    return (new Illuminate\Auth\Notifications\VerifyEmail())->toMail($user);
});*/
//array('before' => 'auth', 'uses' => 'HomeController@index')



