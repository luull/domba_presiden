<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/login', 'auth\signinController@index');
Route::get('/login-investor', 'auth\investorController@index');
Route::get('/', 'auth\signinController@index');
Route::get('/pages_maintenence.html', function () {
    echo '<body style="background:#000">
     <div style="background:#000;width:100%">

    <img src="images/under_construction_animated.gif" >
    </div>
    </body>';
});
Route::post('/login', 'auth\signinController@login')->name('action_login');
Route::post('/login-investor', 'auth\investorController@login')->name('action_investor_login');
Route::get('/logout', 'auth\signinController@logout');
Route::get('/investor/logout', 'auth\investorController@logout');
Route::group(['middleware' => 'investorMiddleware'], function () {
    Route::get('/investor/ubah_password', 'auth\investorController@ubah_password');
    Route::post('/investor/ubah_password', 'auth\investorController@proses_ubah_password')->name('ubah_password_investor');
    Route::post('/investor/ubah_password1', 'admin\investorController@proses_ubah_password')->name('ubah_password_investor_admin');
    Route::get('/investor/profil', 'admin\investorController@edit_profil');
    Route::post('/investor/profil', 'admin\investorController@proses_edit_profil')->name('proses_edit_profil');

    Route::get('/investor/booking1', 'admin\jualdombaController@booking_by_investor');
    Route::post('/investor/booking1', 'admin\jualdombaController@proses_booking_by_investor_selesai')->name('booking_by_investor_selesai');
    Route::get('/investor/booking', 'admin\jualdombaController@booking');
    Route::post('/investor/booking', 'admin\jualdombaController@proses_booking_selesai')->name('booking_selesai');
    Route::get('/investor/booking/{id}', 'admin\jualdombaController@booking1');
    Route::post('/investor/sold-list', 'admin\investorController@sold_list')->name('investor_sold_list');
    Route::get('/investor/sold-list', 'admin\investorController@sold_list1');
    Route::post('/investor/domba-list', 'admin\investorController@domba_list')->name('investor_sold_list');
    Route::get('/investor/domba-list', 'admin\investorController@domba_list1');
    Route::get('/investor/{investor_id}/domba-list', 'admin\investorController@domba_list');

    Route::post('/investor/booking-list', 'admin\investorController@order_list')->name('investor_order_list');
    Route::get('/investor/booking-list', 'admin\investorController@order_list1');
    Route::get('/investor/ubah-password/{id}', 'admin\investorController@ubah_password_investor');
    Route::get('/investor/domba/sold', 'admin\investorController@domba_sold');
    Route::get('/investor/domba/per_kandang', 'admin\investorController@domba_per_kandang');
    Route::post('/investor/domba/per_kandang', 'admin\investorController@domba_per_kandang1')->name('domba_per_kandang_per_investor');
    Route::get('/investor/domba/per_kamar', 'admin\investorController@domba_per_kamar');
    Route::post('/investor/domba/per_kamar', 'admin\investorController@domba_per_kamar1')->name('domba_per_kamar_per_investor');
    Route::get('/investor/domba/booked', 'admin\investorController@domba_booked');
    Route::get('/investor/domba/available', 'admin\investorController@domba_available');
    Route::get('/investor/domba/detil/{id}', 'admin\investorController@detil_domba');
    Route::get('/investor/domba', 'admin\investorController@domba_booked');
    Route::get('/investor/konfirmasi-pembayaran', 'admin\jualdombaController@konfirmasi_pembayaran');
    Route::post('/investor/konfirmasi-pembayaran', 'admin\jualdombaController@proses_konfirmasi_pembayaran')->name('konfirmasi_pembayaran');
    Route::get('/investor/daftar_booking', 'admin\jualdombaController@daftar_booking');
    Route::get('/investor/daftar_booking/delete/{id}', 'admin\jualdombaController@delete_daftar_booking');
    Route::get('/investor/daftar_booking/approve/{id}', 'admin\jualdombaController@approve_daftar_booking');
});
Route::group(['middleware' => 'loginMiddleware'], function () {
    Route::get('/ubah_password', 'auth\signinController@ubah_password');
    Route::post('/ubah_password', 'auth\signinController@proses_ubah_password')->name('ubah_password');
    Route::get('/dashboard', 'admin\dashboardController@index');
    Route::get('/dashboard-investor', 'admin\dashboardController@dashboard_investor');
    Route::get('/city/find/{id}', 'admin\supplierController@city_list');

    Route::get('/profil', 'admin\profilController@index');
    Route::post('/update_profil', 'admin\profilController@update')->name('update_profil');

    Route::get('/regis_domba', 'admin\regisController@index');
    Route::get('/domba', 'admin\regisController@index');
    Route::post('/admin/regis/create', 'admin\regisController@regis_domba')->name('create_regis');
    Route::post('/admin/regis/update', 'admin\regisController@update')->name('update_regis');
    Route::get('/admin/regis/delete/{id}', 'admin\regisController@delete')->name('delete_regis');
    Route::get('/admin/regis/find/{id}', 'admin\regisController@find');
    Route::get('/domba/penimbangan', 'admin\penimbanganController@index');
    Route::get('/domba/timbangan-terakhir/{id}', 'admin\penimbanganController@timbangan_terakhir');
    Route::get('/domba/pemberian-pakan/delete/{id}', 'admin\pakanController@delete_pemberian_pakan');
    Route::get('/domba/pemberian-pakan', 'admin\pakanController@pemberian_pakan');
    Route::post('/domba/create-pemberian-pakan', 'admin\pakanController@create_pemberian_pakan')->name('create_pemberian_pakan');
    Route::post('/domba/update-pemberian-pakan', 'admin\pakanController@update_pemberian_pakan')->name('update_pemberian_pakan');
    Route::get('/domba/sold', 'admin\regisController@sold');
    Route::get('/domba/booked', 'admin\regisController@booked');
    Route::get('/domba/available', 'admin\regisController@available');
    Route::get('/dummy-jual/add/{id}', 'admin\jualdombaController@addDummy');
    Route::get('/dummy-jual/show/{id}', 'admin\jualdombaController@showDummy');
    Route::get('/dummy-beli/add/{id}', 'admin\pakanController@addDummy');
    Route::get('/dummy-beli/show/{id}', 'admin\pakanController@showDummy');
    Route::get('/domba/per_kandang', 'admin\regisController@domba_per_kandang');
    Route::post('/domba/per_kandang', 'admin\regisController@domba_per_kandang1')->name('domba_per_kandang');
    Route::get('/domba/per_kamar', 'admin\regisController@domba_per_kamar');
    Route::post('/domba/per_kamar', 'admin\regisController@domba_per_kamar1')->name('domba_per_kamar');
    Route::get('/domba/berat-per-kandang', 'admin\regisController@total_berat_per_kandang');
    Route::get('/domba/berat-per-kamar', 'admin\regisController@total_berat_per_kamar');

    Route::get('/customer/order-list', 'admin\customerController@order_list1');
    Route::post('/customer/order-list', 'admin\customerController@order_list')->name('customer_order_list');
    Route::get('/customer/penjualan', 'admin\jualdombaController@jual');
    Route::post('/customer/penjualan', 'admin\jualdombaController@proses_jual_selesai')->name('jual_selesai');
    Route::get('/customer/penjualan/{id}', 'admin\jualdombaController@jual1');

    Route::get('/domba/detil/{id}', 'admin\regisController@detil');

    Route::post('/admin/penimbangan/create', 'admin\penimbanganController@create')->name('create_penimbangan');
    Route::post('/admin/penimbangan/update', 'admin\penimbanganController@update')->name('update_penimbangan');
    Route::get('/admin/penimbangan/delete/{id}', 'admin\penimbanganController@delete')->name('delete_penimbangan');
    Route::get('/admin/penimbangan/find/{id}', 'admin\penimbanganController@find');
    Route::get('/pakan/order', 'admin\pakanController@order');
    Route::get('/pakan/order/{id}', 'admin\pakanController@order1');
    Route::post('/pakan/order-selesai', 'admin\pakanController@proses_order_selesai')->name('order_selesai');
    Route::get('/pakan/do', 'admin\pakanController@do');
    Route::post('/pakan/do', 'admin\pakanController@do1');
    Route::post('/pakan/do-selesai', 'admin\pakanController@proses_do_selesai')->name('do_selesai');
    Route::get('/pakan/po-per-tgl', 'admin\pakanController@po_per_tgl');
    Route::post('/pakan/po-per-tgl', 'admin\pakanController@po_per_tgl1')->name('po_per_tanggal');
    Route::get('/pakan/do-per-tgl', 'admin\pakanController@do_per_tgl');
    Route::post('/pakan/do-per-tgl', 'admin\pakanController@do_per_tgl1')->name('do_per_tanggal');
    Route::get('/pakan/do/del/{id}', 'admin\pakanController@hapus_dummy_do');
    Route::get('/pakan/do/update/{id}', 'admin\pakanController@update_dummy_do');
    Route::post('/pakan/do/finish', 'admin\pakanController@do_finish');
    Route::post('/pakan/do/finish', 'admin\pakanController@do_finish');
    Route::get('/pakan/do/{id}', 'admin\pakanController@invoice_do');
    Route::get('/pakan/po/{id}', 'admin\pakanController@invoice_po');
    Route::get('/pakan/po/do/{id}', 'admin\pakanController@detil_po_do');
    Route::get('/pakan/detil_pakan/add', 'admin\pakanController@detil_pakan_add');
    Route::post('/pakan/pemberian-pakan/finish', 'admin\pakanController@proses_pemberian_pakan')->name('proses_pemberian_pakan');
    Route::get('/pakan/incoming/{id}', 'admin\pakanController@stok_incoming');

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

    Route::get('/booking', 'admin\bookingController@index');
    Route::post('/update_dummy', 'admin\bookingController@updummy')->name('update_dummy');
});
