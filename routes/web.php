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

Route::get('/', 'TaskController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('prefix' => 'admin'), function(){

    Route::get('/task-edit/{id}', 'TaskController@edit');

    Route::post('/task-store', 'TaskController@store');
    Route::put('/task-update', 'TaskController@update');
    Route::delete('/task-delete/{id}', 'TaskController@destroy');

});
