<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Investor;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    public function index()
    {
        $karakter = '123456789';
        $generate = substr(str_shuffle($karakter), 0, 3);
        $hasil = 'TR-00'.$generate;
        
        
        $no_trans = $hasil;
        $tgl_trans = date('Y-m-d');
        $investor = Investor::get();

        return view('admin.booking', compact('no_trans','tgl_trans','investor'));
    }
}