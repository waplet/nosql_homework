<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', 'TestController@index');

Auth::routes();

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('project', 'ProjectController');
    Route::resource('project/{project}/users', 'ProjectUserController');
    Route::resource('queue', 'QueueController');
    Route::resource('testBookingApp', 'TestController@testBookingApp');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/log/{log}', 'HomeController@viewLog');
});
Route::get('/docs', 'DocsController@index');

Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');
