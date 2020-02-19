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

// For example component
Route::get('/start', 'StartController@start')->name('start');

// For props
Route::get('/props', 'StartController@props')->name('start');

// For ajax
Route::post('/getJson', 'StartController@getJson')->name('getJson');
Route::get('/ajax', 'StartController@getJsonView')->name('getJsonView');

// For chart
Route::post('/chartData', 'StartController@chartData')->name('chartData');
Route::get('/chart', 'StartController@chartDataView')->name('chartDataView');

Route::post('/random-chart', 'StartController@randomChart')->name('random-chart');
Route::get('/random-chart', 'StartController@randomChartView')->name('random-chartView');


Route::post('/socket-chart', 'StartController@socketChart')->name('socket-chart');
Route::get('/socket-chart', 'StartController@socketChartView')->name('socket-chartView');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
