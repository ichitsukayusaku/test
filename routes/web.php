<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'TestController@index')->name('list');

Route::get('/home/create', 'TestController@create')->name('create');
Route::post('/home/create', 'TestController@store')->name('store');
Route::post('/home/destroy{id}', 'TestController@destroy')->name('destroy');
Route::get('/home/detail{id}', 'TestController@show')->name('detail');
Route::get('/home/detail/edit{id}', 'TestController@edit')->name('edit');
Route::post('/home/detail/edit{id}', 'TestController@update')->name('update');
