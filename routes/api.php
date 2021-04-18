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



Route::group(['prefix' => 'v1/'], function () {

    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/professions', 'ProfessionController@index');

    Route::get('/countries', 'CityController@countries');
    Route::get('/cities/{country}', 'CityController@cities');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::resource('/contacts', 'ContactController');
        Route::get('/contacts/agency/{agency}', 'ContactController@contactsByAgency');

        Route::resource('/agencies', 'AgencyController')->middleware('can:any,App\Agency');

        Route::post('/photos', 'PhotoController@store');
        Route::get('/photos/{photo}', 'PhotoController@show');
    });
});
