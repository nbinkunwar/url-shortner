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
Route::group(['prefix'=>'v1'],function (){
    Route::post('shorten', 'Api\LinkController@shorten');
    Route::get('links', 'Api\LinkController@index');
    Route::post('login', 'Api\Admin\LoginController@login');
    Route::delete('links/{id}','Api\Admin\LinkController@delete');

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
});

