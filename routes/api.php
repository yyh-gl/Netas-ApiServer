<?php

/*
|--------------------------------------------------------------------------
| API Version 1 Routes
|--------------------------------------------------------------------------
*/

Route::namespace('Api\V1')->group(function () {
    Route::group(['prefix' => 'v1'], function () {

        Route::group(['middleware' => 'auth:api'], function () {
            /*
            |------------------------------------------------------------------
            | User Routes with Authorization
            |------------------------------------------------------------------
            */
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', 'UserController@index');
                Route::get('/{user_id}', 'UserController@show');
            });

            /*
            |------------------------------------------------------------------
            | Tag Routes with Authorization
            |------------------------------------------------------------------
            */
            Route::group(['prefix' => 'tags'], function () {
                Route::get('/', 'TagController@index');
                Route::get('/{id}', 'TagController@show');
                Route::post('/', 'TagController@store');
            });
        });

        /*
        |------------------------------------------------------------------
        | User Routes with No Authorization
        |------------------------------------------------------------------
        */
        Route::group(['prefix' => 'users'], function () {
            Route::post('/', 'UserController@store');
        });
    });
});