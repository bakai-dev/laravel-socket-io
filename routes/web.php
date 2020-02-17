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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/start', 'StartController@star')->name('start');

Route::get('/props', 'StartController@props')->name('start');

Route::post('/getJson', 'StartController@getJson')->name('getJson');

Route::get('/ajax', 'StartController@getJsonView')->name('getJsonView');

Route::get('/start', function () {
    return view('start');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
