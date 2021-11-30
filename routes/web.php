<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'auth\signinController@index');
Route::post('/login', 'auth\signinController@login')->name('action_login');
Route::get('/dashboard', 'admin\dashboardController@index');

Route::get('/regis_domba', 'admin\regisController@index');
Route::post('/admin/regis/create', 'admin\regisController@regis_domba')->name('create_regis');
Route::post('/admin/regis/update', 'admin\regisController@update')->name('update_regis');
Route::get('/admin/regis/delete/{id}', 'admin\regisController@delete')->name('delete_regis');
Route::get('/admin/regis/find/{id}', 'admin\regisController@find');

Route::get('/penimbangan_domba', 'admin\penimbanganController@index');
Route::post('/admin/penimbangan/create', 'admin\penimbanganController@create')->name('create_penimbangan');
Route::post('/admin/penimbangan/update', 'admin\penimbanganController@update')->name('update_penimbangan');
Route::get('/admin/penimbangan/delete/{id}', 'admin\penimbanganController@delete')->name('delete_penimbangan');
Route::get('/admin/penimbangan/find/{id}', 'admin\penimbanganController@find');

Route::get('/stok_pakan', 'admin\stokpakanController@index');
Route::post('/admin/stok_pakan/create', 'admin\stokpakanController@create')->name('create_stok_pakan');
Route::post('/admin/stok_pakan/update', 'admin\stokpakanController@update')->name('update_stok_pakan');
Route::get('/admin/stok_pakan/delete/{id}', 'admin\stokpakanController@delete')->name('delete_stok_pakan');
Route::get('/admin/stok_pakan/find/{id}', 'admin\stokpakanController@find');

Route::get('/order_pakan', 'admin\orderpakanController@index');
Route::post('/admin/order_pakan/create', 'admin\orderpakanController@create')->name('create_order_pakan');
Route::post('/admin/order_pakan/update', 'admin\orderpakanController@update')->name('update_order_pakan');
Route::get('/admin/order_pakan/delete/{id}', 'admin\orderpakanController@delete')->name('delete_order_pakan');
Route::get('/admin/order_pakan/find/{id}', 'admin\orderpakanController@find');