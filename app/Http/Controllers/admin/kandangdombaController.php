<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KandangDomba;
use Illuminate\Http\Request;

class kandangdombaController extends Controller
{

    public function index()
    {
        $data = KandangDomba::get();
        return view('admin.kandang', compact('data'));
    }
    public function create(Request $request)
    {
        $validasi = $request->validate([
            'kandang' => 'required',
        ]);
        if ($validasi) {

            $hsl = KandangDomba::create([
                'kandang' => $request->kandang,
            ]);
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Kandang Domba Berhasil Ditambahkan ', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Kandang Domba gagal ditambahkan', 'alert' => 'danger']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = KandangDomba::where('id', $req->id)->first();
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
                'kandang' => 'required',
            ]);

            if ($validasi) {
                $hsl = KandangDomba::where('id', $request->id)->update([
                    'kandang' => $request->kandang,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Kandang Domba Berhasil diubah', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Kandang Domba gagal diubah', 'alert' => 'danger']);
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

        $hsl = KandangDomba::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
