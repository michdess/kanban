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

// Auth::routes(['register' => false]);
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('tasks', 'TaskController@index')->middleware('auth');
Route::post('task', 'TaskController@store')->middleware('auth');
Route::patch('task/{id}', 'TaskController@update')->middleware('auth');
Route::get('task/{id}/complete', 'TaskController@complete')->middleware('auth');
Route::get('task/{id}/incomplete', 'TaskController@incomplete')->middleware('auth');
Route::delete('task/{id}', 'TaskController@destroy')->middleware('auth');