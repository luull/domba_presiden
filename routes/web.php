<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'auth\signinController@index');
Route::post('/login', 'auth\signinController@login')->name('action_login');
Route::get('/dashboard', 'auth\signinController@dashboard');

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