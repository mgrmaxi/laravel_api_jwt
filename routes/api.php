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

Route::middleware('jwt.auth')->group( function(){
    Route::resource('books','API\bookController');
});

Route::middleware('jwt.auth')->get('/users', function (Request $request) {
    return auth()->user();
});

Route::post('user/register' ,'APIRegisterController@register');
Route::post('user/login' ,'APILoginController@login');