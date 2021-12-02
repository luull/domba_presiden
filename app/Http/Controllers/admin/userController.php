<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class userController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('admin.user', compact('data'));
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
        ]);
        if ($validasi) {

            $hsl = User::create([
                'nama' => $request->nama,
            ]);
            if ($hsl) {
                return redirect()->back()->with(['message' => 'User Admin Berhasil Ditambahkan ', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'User Admin gagal ditambahkan', 'alert' => 'danger']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
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
        if (!empty($request->id)) {
            $validasi = $request->validate([
                'nama' => 'required',
            ]);

            if ($validasi) {
                $hsl = User::where('id', $request->id)->update([
                    'nama' => $request->nama,
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
    }
    public function delete(Request $req)
    {

        $hsl = User::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
