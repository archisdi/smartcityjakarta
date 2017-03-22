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
    return redirect('login');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'kota'], function () {
    Route::get('/', 'KotaController@index')->name('kota.index');
    Route::get('/remine', 'KotaController@remine')->name('kota.remine');
    Route::get('/export', 'KotaController@export')->name('kota.export');
});

Route::group(['prefix' => 'kecamatan'], function () {
    Route::get('/', 'KecamatanController@index')->name('kecamatan.index');
    Route::get('/remine', 'KecamatanController@remine')->name('kecamatan.remine');
    Route::get('/export', 'KecamatanController@export')->name('kecamatan.export');
});

Route::group(['prefix' => 'kelurahan'], function () {
    Route::get('/', 'KelurahanController@index')->name('kelurahan.index');
    Route::get('/remine', 'KelurahanController@remine')->name('kelurahan.remine');
    Route::get('/export', 'KelurahanController@export')->name('kelurahan.export');
});

Route::group(['prefix' => 'rw'], function () {
    Route::get('/', 'RwController@index')->name('rw.index');
    Route::get('/remine', 'RwController@remine')->name('rw.remine');
    Route::get('/export', 'RwController@export')->name('rw.export');
});

Route::group(['prefix' => 'tps'], function () {
    Route::get('/', 'TpsController@index')->name('tps.index');
    Route::get('/remine', 'TpsController@remine')->name('tps.remine');
    Route::get('/maps', 'TpsController@maps')->name('tps.maps');
    Route::get('/chart/{type}', 'TpsController@chart')->name('tps.chart');
    Route::get('/export', 'TpsController@export')->name('tps.export');
});

Route::group(['prefix' => 'rumahsakit'], function () {
    Route::get('/', 'RsController@index')->name('rs.index');
    Route::get('/remine', 'RsController@remine')->name('rs.remine');
    Route::get('/maps', 'RsController@maps')->name('rs.maps');
    Route::get('/chart/{type}', 'RsController@chart')->name('rs.chart');
    Route::get('/export', 'RsController@export')->name('rs.export');
});