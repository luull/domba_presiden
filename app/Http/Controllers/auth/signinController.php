<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
                return redirect('/dashboard');
            }else{

                return redirect()->back()->with('message', 'Username atau Password Salah ');
            }
        } else {
            return redirect()->back()->with('message', 'Username atau Password Salah ');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/')->with('message', 'Anda telah Keluar ');
    }
    public function ubah_password()
    {
        return view('admin.ubah_password');
    }
    public function proses_ubah_password(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'password1' => 'required'
        ]);
        $old = $request->old_password;
        $pwd = $request->password;
        $pwd2 = $request->password1;
        $data = User::where('username', session('admin_username'))->first();
        $getid = User::where('username', session('admin_username'))->first()->id;
        if ($data) {
            if (Hash::check($old, $data->password )) {
                if (Hash::check($pwd, $data->password )) {
                    return redirect('/ubah_password')->with('message','Password sama dengan yang lama');
                }elseif (Hash::check($pwd2, $data->password )) {
                    return redirect('/ubah_password')->with('message','Password sama dengan yang lama');
                }else {
                    if($pwd != $pwd2){
                        return redirect('/ubah_password')->with('message','Password tidak sama');
                    }else {
                        $hsl = User::where('id', $getid)->update([
                            'password' => bcrypt($pwd)
                        ]);
                        if($hsl){
                            $request->session()->flush();
                            return redirect('/')->with('message','Silahkan login kembali dengan password baru');
                        }
                    }
                }
            }else {
                return redirect('/ubah_password')->with('message','Password lama salah');
            }
        }
       
    }
}
