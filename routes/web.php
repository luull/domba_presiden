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

Route::get('/supplier', 'admin\supplierController@index');
Route::get('/supplier/pakan', 'admin\supplierController@pakan');
Route::get('/supplier/domba', 'admin\supplierController@domba');
Route::post('/admin/supplier/create', 'admin\supplierController@create')->name('create_supplier');
Route::post('/admin/supplier/update', 'admin\supplierController@update')->name('update_supplier');
Route::get('/admin/supplier/delete/{id}', 'admin\supplierController@delete')->name('delete_supplier');
Route::get('/admin/supplier/find/{id}', 'admin\supplierController@find');

Route::get('/investor', 'admin\investorController@index');
Route::post('/admin/investor/create', 'admin\investorController@create')->name('create_investor');
Route::post('/admin/investor/update', 'admin\investorController@update')->name('update_investor');
Route::get('/admin/investor/delete/{id}', 'admin\investorController@delete')->name('delete_investor');
Route::get('/admin/investor/find/{id}', 'admin\investorController@find');

Route::get('/customer', 'admin\customerController@index');
Route::post('/admin/customer/create', 'admin\customerController@create')->name('create_customer');
Route::post('/admin/customer/update', 'admin\customerController@update')->name('update_customer');
Route::get('/admin/customer/delete/{id}', 'admin\customerController@delete')->name('delete_customer');
Route::get('/admin/customer/find/{id}', 'admin\customerController@find');

Route::get('/user', 'admin\userController@index');
Route::post('/admin/user/create', 'admin\userController@create')->name('create_user');
Route::post('/admin/user/update', 'admin\userController@update')->name('update_user');
Route::get('/admin/user/delete/{id}', 'admin\userController@delete')->name('delete_user');
Route::get('/admin/user/find/{id}', 'admin\userController@find');

Route::get('/pakan', 'admin\pakanController@index');
Route::post('/admin/pakan/create', 'admin\pakanController@create')->name('create_pakan');
Route::post('/admin/pakan/update', 'admin\pakanController@update')->name('update_pakan');
Route::get('/admin/pakan/delete/{id}', 'admin\pakanController@delete')->name('delete_pakan');
Route::get('/admin/pakan/find/{id}', 'admin\pakanController@find');

Route::get('/order_pakan', 'admin\orderpakanController@index');
Route::post('/admin/order_pakan/create', 'admin\orderpakanController@create')->name('create_order_pakan');
Route::post('/admin/order_pakan/update', 'admin\orderpakanController@update')->name('update_order_pakan');
Route::get('/admin/order_pakan/delete/{id}', 'admin\orderpakanController@delete')->name('delete_order_pakan');
Route::get('/admin/order_pakan/find/{id}', 'admin\orderpakanController@find');
Route::post('/admin/order_pakan/received', 'admin\orderpakanController@received')->name('received_order_pakan');

Route::get('/detail_order/{id}', 'admin\detailorderController@index')->name('detail_order');
Route::post('/admin/dummy/create', 'admin\detailorderController@create')->name('create_dummy');
Route::get('/admin/detail_order/find/{id}', 'admin\detailorderController@find');

Route::get('/jenis_domba', 'admin\jenisdombaController@index');
Route::post('/admin/jenis_domba/create', 'admin\jenisdombaController@create')->name('create_jenis_domba');
Route::post('/admin/jenis_domba/update', 'admin\jenisdombaController@update')->name('update_jenis_domba');
Route::get('/admin/jenis_domba/delete/{id}', 'admin\jenisdombaController@delete')->name('delete_jenis_domba');
Route::get('/admin/jenis_domba/find/{id}', 'admin\jenisdombaController@find');

Route::get('/kandang_domba', 'admin\kandangdombaController@index');
Route::post('/admin/kandang_domba/create', 'admin\kandangdombaController@create')->name('create_kandang_domba');
Route::post('/admin/kandang_domba/update', 'admin\kandangdombaController@update')->name('update_kandang_domba');
Route::get('/admin/kandang_domba/delete/{id}', 'admin\kandangdombaController@delete')->name('delete_kandang_domba');
Route::get('/admin/kandang_domba/find/{id}', 'admin\kandangdombaController@find');

Route::get('/satuan_pakan', 'admin\satuanpakanController@index');
Route::post('/admin/satuan_pakan/create', 'admin\satuanpakanController@create')->name('create_satuan_pakan');
Route::post('/admin/satuan_pakan/update', 'admin\satuanpakanController@update')->name('update_satuan_pakan');
Route::get('/admin/satuan_pakan/delete/{id}', 'admin\satuanpakanController@delete')->name('delete_satuan_pakan');
Route::get('/admin/satuan_pakan/find/{id}', 'admin\satuanpakanController@find');
