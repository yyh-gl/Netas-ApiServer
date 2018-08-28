<?php

/*
|--------------------------------------------------------------------------
| API Version 1 Routes
|--------------------------------------------------------------------------
*/
Route::namespace('Api\V1')->group(function () {
    Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {

        /*
        |------------------------------------------------------------------
        | User Routes
        |------------------------------------------------------------------
        */
        Route::group(['prefix' => 'users'], function () {
            Route::middleware('auth:api')->get('/', 'UserController@index');
            Route::get('/{user_id}', 'UserController@show');
            Route::post('/', 'UserController@store');
        });
        
        /*
        |------------------------------------------------------------------
        | Tag Routes
        |------------------------------------------------------------------
        */
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagController@index');
            Route::get('/{id}', 'TagController@show');
            Route::post('/', 'TagController@store');
        });
    });
});