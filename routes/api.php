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

//Authentication
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup');
    Route::get('signup/activate/{token}','AuthController@signupactivate');
  
   Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'AuthController@logout');
        Route::post('user', 'AuthController@user');
    });
});

//Password Reset
Route::group([       
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

//Users 
Route::get('/users/all','UserController@index');
Route::get('/users/{user}','UserController@show');


//Jobs
Route::get('/jobs','JobController@index');
Route::get('/jobs/{job}','JobController@show');

//Only with login
Route::group(['middleware' => 'auth:api'],function(){
	//Jobs
	Route::post('/jobs/new','JobController@store');
	Route::put('/jobs/update/{job}','JobController@update');
	Route::delete('/jobs/delete/{job}','JobController@delete');	
	//Users
	Route::delete('/users/delete/{user}','UserController@delete');
	Route::put('/users/update/{user}','UserController@update');
});