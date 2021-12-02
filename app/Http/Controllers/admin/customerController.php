<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

class customerController extends Controller
{
    public function index()
    {
        $data = Customer::get();
        return view('admin.customer', compact('data'));
    }

    public function create(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
        ]);
        if ($validasi) {

            $hsl = Customer::create([
                'nama' => $request->nama,
            ]);
            if ($hsl) {
                return redirect()->back()->with(['message' => 'customer Berhasil Ditambahkan ', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'customer gagal ditambahkan', 'alert' => 'danger']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = Customer::where('id', $req->id)->first();
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
                $hsl = Customer::where('id', $request->id)->update([
                    'nama' => $request->nama,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'customer Berhasil diubah', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'customer gagal diubah', 'alert' => 'danger']);
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

        $hsl = Customer::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
