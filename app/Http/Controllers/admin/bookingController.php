<?php

namespace App\Http\Controllers\admin;

use App\Dummy_h_book;
use App\Dummy_d_book;
use App\Http\Controllers\Controller;
use App\Investor;
use App\Penimbangan;
use App\RegisDomba;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    public function index()
    {
        $karakter = '123456789';
        $generate = substr(str_shuffle($karakter), 0, 2);
        
        
        $tgl_trans = date('Y-m-d');
        $generatedate = str_replace("-", "", $tgl_trans);
        $hasil = 'TR-00'.$generatedate;
        $no_trans = $hasil;
        $investor = Investor::get();
        $domba = RegisDomba::where('status', '0')->get();
        $dummy = Dummy_d_book::get();
        return view('admin.booking', compact('no_trans','tgl_trans','investor','domba','dummy'));
    }
}