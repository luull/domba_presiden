<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Satuan;
use Illuminate\Http\Request;

class satuanpakanController extends Controller
{

    public function index()
    {
        $data = Satuan::get();
        return view('admin.satuan_pakan', compact('data'));
    }
    public function create(Request $request)
    {
        $validasi = $request->validate([
            'satuan' => 'required',
        ]);
        if ($validasi) {

            $hsl = Satuan::create([
                'satuan' => $request->satuan,
            ]);
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Satuan Berhasil Ditambahkan ', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Satuan gagal ditambahkan', 'alert' => 'danger']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = Satuan::where('id', $req->id)->first();
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
                'satuan' => 'required',
            ]);

            if ($validasi) {
                $hsl = Satuan::where('id', $request->id)->update([
                    'satuan' => $request->satuan,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Satuan Pakan Berhasil diubah', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Satuan Pakan gagal diubah', 'alert' => 'danger']);
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

        $hsl = Satuan::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
