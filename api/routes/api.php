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
    Route::get('ship', 'ShipController@index');
    
    Route::post('people', 'PeopleController@create');
});
