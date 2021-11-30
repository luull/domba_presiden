<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JenisPakan;
use App\StokPakan;
use Illuminate\Http\Request;

class stokpakanController extends Controller
{

    public function index()
    {
        $jenis_pakan = JenisPakan::get();
        $data = StokPakan::get();
        return view('admin.stok_pakan', compact('jenis_pakan','data'));
    }
    public function create(Request $request){
        $validasi = $request->validate([
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required',
            'in_coming' => 'required',
            'pemakaian' => 'required',
        ]);
        if ($validasi) {
               
                $hsl = StokPakan::create([
                    'jenis_pakan' => $request->jenis_pakan,
                    'stok_pakan' => $request->stok_pakan,
                    'in_coming' => $request->in_coming,
                    'pemakaian' => $request->pemakaian,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Stok Pakan Berhasil Ditambahkan ', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Stok Pakan gagal ditambahkan', 'alert' => 'danger']);
                }
        }
        else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = StokPakan::where('id', $req->id)->first();
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
                'jenis_pakan' => 'required',
                'stok_pakan' => 'required',
                'in_coming' => 'required',
                'pemakaian' => 'required',
            ]);

            if ($validasi) {
            $hsl = StokPakan::where('id', $request->id)->update([
                'jenis_pakan' => $request->jenis_pakan,
                'stok_pakan' => $request->stok_pakan,
                'in_coming' => $request->in_coming,
                'pemakaian' => $request->pemakaian,
            ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Stok Pakan Berhasil diubah', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Stok Pakan gagal diubah', 'alert' => 'danger']);
                }
            
            }else{
                return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap ', 'alert' => 'danger']);
            }
        } else {
            return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap,idnya kosong ', 'alert' => 'danger']);
        }
    }
    public function delete(Request $req)
    {
      
        $hsl = StokPakan::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}