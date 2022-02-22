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

Route::get('/', 'DataMapController@index');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

/*
 * Datas Routes
 */
Route::get('/peta', 'DataMapController@index')->name('data_map.index');
Route::resource('datas', 'DataController');
