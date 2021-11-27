<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class signinController extends Controller
{

    public function index()
    {
        return view('auth.signin');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $uid = $request->username;
        $pwd = $request->password;
        $data = User::where('username', $uid)->first();
        if ($data) {
            if (Hash::check($pwd, $data->password)) {
                session(['login_sukses' => true]);
                session(['admin_id' => $data->id]);
                session(['admin_username' => $data->username]);
                session(['admin_level' => $data->level]);
              
                $admin_data = $data;
                return view('admin.dashboard', compact('admin_data'));
            }
        } else {
            return redirect('/')->with('message', 'Wrong Username or Password ');
        }
    }
    public function dashboard()
    {
        if (!session('username') || session('username') == null) {
            return view('/');
        }
        $admin_data = session('admin_data');
        return view('admin.dashboard', compact('admin_data'));
    }
}
