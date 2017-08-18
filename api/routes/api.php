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

Route::group(array(), function()
{
    Route::get('people', 'PeopleController@get');
    Route::get('ship', 'ShipController@get');
    
    Route::post('people', 'PeopleController@create');
    Route::post('ship', 'ShipController@create');
    
    Route::delete('ship/{id}', 'ShipController@delete');
    Route::delete('people/{id}', 'PeopleController@delete');
});
