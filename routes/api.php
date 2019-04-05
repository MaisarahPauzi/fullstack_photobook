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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::resource('products', 'ProductController');
    Route::get('/photobook', 'PhotobookController@index');
    Route::get('/photobook/{id}', 'PhotobookController@show');
    Route::post('/photobook', 'PhotobookController@store');
    Route::put('/photobook/{id}', 'PhotobookController@update');
    Route::delete('/photobook/{id}', 'PhotobookController@destroy');

    Route::post('/upload', 'PhotobookController@upload');
    Route::delete('/delPhoto/{dfile}', 'PhotobookController@del');
});
