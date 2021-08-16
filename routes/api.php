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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::prefix('admin')->group(function () {
    Route::post('/register', 'Admin\LoginController@register');
    Route::post('/login', 'Admin\LoginController@login');
    Route::post('/refresh', 'Admin\LoginController@refresh');
    Route::post('/logout', 'Admin\LoginController@logout');
    Route::post('/create_user', 'Admin\LoginController@create');
    Route::get('/get_user_info', 'Admin\UserController@getUserInfo');

});
