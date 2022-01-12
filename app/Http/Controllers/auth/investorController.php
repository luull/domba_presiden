<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class investorController extends Controller
{

    public function index()
    {
        return view('auth.investor');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $uid = $request->username;
        $pwd = $request->password;

        $data = Investor::where('username', $uid)->first();
        if ($data) {
            if (Hash::check($pwd, $data->password)) {
                session(['login_investor_sukses' => true]);
                session(['investor_id' => $data->id]);
                session(['investor_username' => $data->username]);
                session(['investor_nama' => $data->nama]);

                session(['data_investor' => $data]);
                return redirect('/dashboard-investor');
            } else {

                return redirect()->back()->with('message', 'Username atau Password Salah ');
            }
        } else {
            return redirect()->back()->with('message', 'Username atau Password Salah ');
        }
    }
    public function logout(Request $request)
    {
        session()->forget('login_investor_sukses');
        return redirect('/login-investor')->with('message', 'Anda telah Keluar ');
    }
    public function ubah_password()
    {
        return view('investor.ubah_password_investor');
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
        $data = Investor::where('username', session('investor_username'))->first();
        $getid = Investor::where('username', session('investor_username'))->first()->id;
        if ($data) {
            if (Hash::check($old, $data->password)) {
                if (Hash::check($pwd, $data->password)) {
                    return redirect('/investor/ubah_password')->with('message', 'Password sama dengan yang lama');
                } elseif (Hash::check($pwd2, $data->password)) {
                    return redirect('/investor/ubah_password')->with('message', 'Password sama dengan yang lama');
                } else {
                    if ($pwd != $pwd2) {
                        return redirect('/investor/ubah_password')->with('message', 'Password tidak sama');
                    } else {
                        $hsl = investor::where('id', $getid)->update([
                            'password' => bcrypt($pwd)
                        ]);
                        if ($hsl) {
                            $request->session()->flush();
                            return redirect('/login-investor')->with('message', 'Silahkan login kembali dengan password baru');
                        }
                    }
                }
            } else {
                return redirect('/investor/ubah_password')->with('message', 'Password lama salah');
            }
        }
    }
}
