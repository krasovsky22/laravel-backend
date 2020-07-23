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

Route::get('redirect/{driver}', 'AuthController@redirectToProvider')
    ->name('login.external')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('{driver}/callback', 'AuthController@handleProviderCallback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
