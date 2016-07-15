<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect('shop');
});

Route::group(
    [
        'prefix' => 'shop',
        'middleware' => ['web', 'auth']
    ],
    function () {
        Route::get('/', function () {
            return view('welcome');
        });
    });

Route::group(
    [
        'prefix' => 'auth',
        'middleware' => ['web']
    ],
    function () {
        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@getLogout');
    }
);