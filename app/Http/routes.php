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
        Route::get('', 'Shop\ShopController@catalog');
        Route::get('orders', 'Shop\OrderController@orders');
        Route::get('orders/{order}', 'Shop\OrderController@showOrder');
        Route::get('basket', 'Shop\BasketController@index');
        Route::post('basket', 'Shop\BasketController@addToBasket');
        Route::post('basket/place_order', 'Shop\BasketController@placeOrder');
        Route::get('item_type/{itemType}/items', 'Shop\ShopController@itemsForType');
    });

Route::group(
    [
        'prefix' => 'auth'
    ],
    function () {
        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@logout');
    }
);