<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('login', array('as' => 'auth.login', 'uses' => 'AuthController@getLogin'));
Route::post('login', array('uses' => 'AuthController@postLogin'));
Route::get('logout', array('as' => 'auth.logout', 'uses' => 'AuthController@getLogout'));