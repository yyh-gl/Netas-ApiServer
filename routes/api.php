<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::namespace('Api\V1')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index');
        Route::get('/{user_id}', 'UserController@show');
        Route::post('/', 'UserController@store');
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', 'TagController@index');
        Route::get('/{id}', 'TagController@show');
        Route::post('/', 'TagController@store');
    });
});