<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JenisPakan;
use App\OrderPakan;
use App\Supplier;
use Illuminate\Http\Request;

class orderpakanController extends Controller
{

    public function index()
    {
        $jenis_pakan = JenisPakan::get();
        $supplier = Supplier::get();
        $data = OrderPakan::get();
        return view('admin.order_pakan', compact('jenis_pakan','data','supplier'));
    }
    public function create(Request $request){
        $validasi = $request->validate([
            'tgl_order' => 'required',
            'jenis_pakan' => 'required',
            'tgl_estimasi' => 'required',
            'harga' => 'required',
            'supplier' => 'required',
        ]);
        $karakter = '123456789';
        $generate = substr(str_shuffle($karakter), 0, 6);
        $hasil = 'PO-'.$generate;
        if ($validasi) {
                $hsl = OrderPakan::create([
                    'no_order' => $hasil,
                    'tgl_order' => $request->tgl_order,
                    'jenis_pakan' => $request->jenis_pakan,
                    'tgl_estimasi' => $request->tgl_estimasi,
                    'harga' => $request->harga,
                    'supplier' => $request->supplier,
                    'status' => '0',
                    'tgl_terima' => date('Y-m-d')
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Order Pakan Berhasil Ditambahkan ', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Order Pakan gagal ditambahkan', 'alert' => 'danger']);
                }
        }
        else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = OrderPakan::where('id', $req->id)->first();
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
                'tgl_order' => 'required',
                'jenis_pakan' => 'required',
                'tgl_estimasi' => 'required',
                'harga' => 'required',
                'supplier' => 'required',
            ]);

            if ($validasi) {
            $hsl = OrderPakan::where('id', $request->id)->update([
                'no_order' => $request->no_order,
                'tgl_order' => $request->tgl_order,
                'jenis_pakan' => $request->jenis_pakan,
                'tgl_estimasi' => $request->tgl_estimasi,
                'harga' => $request->harga,
                'supplier' => $request->supplier,
            ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Order Pakan Berhasil diubah', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Order Pakan gagal diubah', 'alert' => 'danger']);
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
      
        $hsl = OrderPakan::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
    public function received(Request $request)
    {
        if (!empty($request->id)) {
            $hsl = OrderPakan::where('id', $request->id)->update([
                'tgl_terima' => $request->tgl_terima,
                'status' => 1
            ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Order Pakan Telah Sampai', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Order Pakan gagal sampai', 'alert' => 'danger']);
                }
            
        } else {
            return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap,idnya kosong ', 'alert' => 'danger']);
        }
    }
}