<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JenisDomba;
use Illuminate\Http\Request;

class jenisdombaController extends Controller
{

    public function index()
    {
        $data = JenisDomba::get();
        return view('admin.jenis_domba', compact('data'));
    }
    public function create(Request $request)
    {
        $validasi = $request->validate([
            'jenis' => 'required',
        ]);
        if ($validasi) {

            $hsl = JenisDomba::create([
                'jenis' => $request->jenis,
            ]);
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Jenis Domba Berhasil Ditambahkan ', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Jenis Domba gagal ditambahkan', 'alert' => 'danger']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = JenisDomba::where('id', $req->id)->first();
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
                'jenis' => 'required',
            ]);

            if ($validasi) {
                $hsl = JenisDomba::where('id', $request->id)->update([
                    'jenis' => $request->jenis,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Jenis Domba Berhasil diubah', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Jenis Domba gagal diubah', 'alert' => 'danger']);
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

        $hsl = JenisDomba::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
