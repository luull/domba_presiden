<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Province;
use App\City;
use Exception;

class profilController extends Controller
{
    public function index()
    {
        try {


            $province = Province::get();
            $city = City::get();
            $data = User::where('username', session('admin_username'))->first();
            // dd(session('admin_username'));
            return view('admin.edit_profile', compact('data', 'province', 'city'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {


            $validasi = $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'email' => 'required',
                'propinsi' => 'required',
                'kota' => 'required',
                'hp' => 'required',
            ]);
            if ($validasi) {
                $unq = User::where('username', $request->username)->first();
                if ($unq) {
                    return redirect()->back()->with(['message' => 'Username Sudah Terdaftar ', 'alert' => 'warning']);
                } else {
                    $hsl = User::where('id', $request->id)->update([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'propinsi' => $request->propinsi,
                        'kota' => $request->kota,
                        'hp' => $request->hp,
                    ]);
                    if ($hsl) {
                        return redirect()->back()->with(['message' => 'Profil Berhasil Diubah ', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'Profil gagal Diubah', 'alert' => 'danger']);
                    }
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
