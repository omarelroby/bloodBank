<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api'],function() {
    Route::get('governorates', 'MainController@governorates'); //default: api/v1/governorates
    Route::get('cities', 'MainController@cities');
    Route::get('setting','MainController@setting');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('get-notification', 'MainController@getnotific');
    Route::put('edit-notification','AuthController@editnotific');
    Route::get('blood-type','MainController@bloodType');
    Route::post('contactus','AuthController@contactus');
    Route::get('categories','MainController@categories');
    Route::post('register/{id}', 'AuthController@editprofile');
    Route::get('getSetting/{id}','AuthController@getSetting');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('posts', 'MainController@posts');

    });
});
