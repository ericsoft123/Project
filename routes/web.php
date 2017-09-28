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
    //return view('welcome');
	return view('test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/create', 'ProjectController@create')->name('create');

Route::post('/delete', 'ProjectController@delete')->name('delete');
Route::post('/update', 'ProjectController@update')->name('update');
Route::get('/sum', 'ProjectController@sum')->name('sum');
Route::get('/gettable', 'ProjectController@gettable')->name('gettable');
