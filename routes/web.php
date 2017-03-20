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

Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');
Route::post('logout','Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'kota'],function (){
   Route::get('/','KotaController@index')->name('kota.index');
   Route::get('/remine','KotaController@remine')->name('kota.remine');
});

Route::group(['prefix' => 'kecamatan'],function (){
    Route::get('/','KecamatanController@index')->name('kecamatan.index');
    Route::get('/remine','KecamatanController@remine')->name('kecamatan.remine');
});

Route::group(['prefix' => 'kelurahan'],function (){
    Route::get('/','KelurahanController@index')->name('kelurahan.index');
    Route::get('/remine','KelurahanController@remine')->name('kelurahan.remine');
});

Route::group(['prefix' => 'rw'],function (){
    Route::get('/','RwController@index')->name('rw.index');
    Route::get('/remine','RwController@remine')->name('rw.remine');
});