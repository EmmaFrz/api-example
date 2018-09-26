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


//User 
Route::get('/users','UserController@index');
Route::get('/users/{user}','UserController@show');
Route::post('/users/new','UserController@store');
Route::delete('/users/delete/{user}','UserController@delete');
Route::put('/users/update/{user}','UserController@update');

//Jobs
Route::get('/jobs','JobController@index');
Route::get('/jobs/{job}','JobController@show');
Route::post('/jobs/new','JobController@store');
Route::put('/jobs/update/{job}','JobController@update');
Route::delete('/jobs/delete/{job}','JobController@delete');