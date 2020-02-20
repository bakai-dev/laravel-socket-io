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

Route::post('/chat', 'StartController@chat')->name('chat');
Route::get('/chat', 'StartController@chatView')->name('chatView');

Route::post('/private-chat', 'StartController@privateChat')->name('chat');
Route::get('/private-chat', 'StartController@privateChatView')->name('chatView');

Route::post('/echo-chat', 'ChatController@echoChat')->name('chat');
Route::get('/echo-chat', 'ChatController@echoChatView')->name('chatView');


Route::post('/private-echo-chat', 'ChatController@privateEchoChat')->name('chat');
Route::get('/private-echo-chat', 'ChatController@privateEchoChatView')->name('chatView');


Route::post('/room', 'ChatController@chatRoom')->name('chat');
Route::get('/room/{room}', 'ChatController@chatRoomView')->name('chatView');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
