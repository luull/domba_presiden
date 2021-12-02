<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class dashboardController extends Controller
{

    public function index()
    {
        if (!session('admin_username') || session('admin_username') == null) {
            return redirect('/');
        }
        $admin_data = User::first();
        return view('admin.dashboard', compact('admin_data'));
    }
}