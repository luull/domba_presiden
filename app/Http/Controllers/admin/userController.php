<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Province;
use App\City;
use Exception;

class userController extends Controller
{
    public function index()
    {
        try {


            $data = User::get();
            $province = Province::get();
            $city = City::get();
            return view('admin.user', compact('data', 'province', 'city'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function create(Request $request)
    {
        try {

            $validasi = $request->validate([
                'nama' => 'required',
                'username' => 'required',
                'password' => 'required',
                'alamat' => 'required',
                'email' => 'required',
                'propinsi' => 'required',
                'kota' => 'required',
                'hp' => 'required',
                'level' => 'required'
            ]);
            if ($validasi) {
                $unq = User::where('username', $request->username)->first();
                if ($unq) {
                    return redirect()->back()->with(['message' => 'Username Sudah Terdaftar ', 'alert' => 'warning']);
                } else {

                    $hsl = User::create([
                        'username' => $request->username,
                        'password' => bcrypt($request->password),
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'propinsi' => $request->propinsi,
                        'kota' => $request->kota,
                        'hp' => $request->hp,
                        'level' => $request->level,
                    ]);
                    if ($hsl) {

                        return redirect()->back()->with(['message' => 'User Admin Berhasil Ditambahkan ', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'User Admin gagal ditambahkan', 'alert' => 'danger']);
                    }
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function find(Request $req)
    {
        $hsl = User::where('id', $req->id)->first();
        if ($hsl) {
            return response()->json($hsl);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => true]);
        }
    }
    public function update(Request $request)
    {
        try {

            if (!empty($request->id)) {
                $validasi = $request->validate([
                    'nama' => 'required',
                    'alamat' => 'required',
                    'email' => 'required',
                    'propinsi' => 'required',
                    'kota' => 'required',
                    'hp' => 'required',
                    'level' => 'required'
                ]);

                if ($validasi) {
                    $hsl = User::where('id', $request->id)->update([
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'alamat' => $request->alamat,
                        'propinsi' => $request->propinsi,
                        'kota' => $request->kota,
                        'hp' => $request->hp,
                        'level' => $request->level
                    ]);
                    if ($hsl) {
                        return redirect()->back()->with(['message' => 'User Admin Berhasil diubah', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'User Admin gagal diubah', 'alert' => 'danger']);
                    }
                } else {
                    return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap ', 'alert' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap,idnya kosong ', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function delete(Request $req)
    {
        try {

            $hsl = User::find($req->id)->delete();
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
