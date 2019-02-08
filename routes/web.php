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
Route::get('/edit', 'HomeController@edit')->name('useredit');
Route::post('/edit', 'HomeController@update')->name('userupdate');
Route::get('/passedit', 'HomeController@passEdit')->name('passEdit');
Route::post('/passedit', 'HomeController@passUpdate')->name('passUpdate');
