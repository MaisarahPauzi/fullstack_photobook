<?php

use Illuminate\Http\Request;

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::get('/photobook', 'PhotobookController@index');
    Route::get('/photobook/{id}', 'PhotobookController@show');
    Route::post('/photobook', 'PhotobookController@store');
    Route::put('/photobook/{id}', 'PhotobookController@update');
    Route::delete('/photobook/{id}', 'PhotobookController@destroy');
    Route::post('/upload', 'PhotobookController@upload');
    Route::delete('/delPhoto/{file}', 'PhotobookController@del');
});
