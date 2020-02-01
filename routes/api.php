<?php

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


Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('redirect/{driver}', 'AuthController@redirectToProvider')
    ->name('login.external')
    ->where('driver', implode('|', config('auth.socialite.drivers')));
Route::get('{driver}/callback', 'AuthController@handleProviderCallback')
    ->where('driver', implode('|', config('auth.socialite.drivers')));

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/users', "Users");
    Route::get('/user', "Users@current");

    //upload profile image
    Route::apiResource('/characters', "Characters");
    Route::post('/character/character-image-upload', 'Characters@updateImage');
});
