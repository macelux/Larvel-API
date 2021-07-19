<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::get('users', 'UsersController@index');

Route::get('user/{id}', 'UsersController@show');

Route::get('users', 'UsersController@index');
 Route::post('/register', 'Api\AuthController@register');
 Route::post('/login', 'Api\AuthController@login');
 Route::put('user/{id}', 'UsersController@update');
 Route::delete('user/{id}', 'UsersController@destroy');
