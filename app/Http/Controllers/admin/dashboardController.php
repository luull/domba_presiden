<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function index()
    {
        // if (!session('username') || session('username') == null) {
        //     return view('/');
        // }
        $admin_data = User::first();
        return view('admin.dashboard', compact('admin_data'));
    }
}