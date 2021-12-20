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
            return redirect('/login');
        }
        $admin_data = User::first();
        return view('admin.dashboard', compact('admin_data'));
    }
    public function dashboard_investor()
    {
        $investor_data = User::first();
        return view('investor.dashboard-investor', compact('investor_data'));
    }
}
