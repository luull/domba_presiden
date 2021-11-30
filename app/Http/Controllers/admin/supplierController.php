<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{

    public function index()
    {
        $data = Supplier::get();
        return view('admin.supplier', compact('data'));
    }
    public function create(Request $request){
        $validasi = $request->validate([
            'nama_supplier' => 'required',
        ]);
        if ($validasi) {
               
                $hsl = Supplier::create([
                    'nama_supplier' => $request->nama_supplier,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Supplier Berhasil Ditambahkan ', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Supplier gagal ditambahkan', 'alert' => 'danger']);
                }
        }
        else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = Supplier::where('id', $req->id)->first();
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
                'nama_supplier' => 'required',
            ]);

            if ($validasi) {
            $hsl = Supplier::where('id', $request->id)->update([
                'nama_supplier' => $request->nama_supplier,
            ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Supplier Berhasil diubah', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Supplier gagal diubah', 'alert' => 'danger']);
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
      
        $hsl = Supplier::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}