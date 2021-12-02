<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Dummy;
use App\OrderPakan;
use App\Pakan;
use Illuminate\Http\Request;

class detailorderController extends Controller
{

    public function index(Request $request)
    {
        if (!session('admin_username') || session('admin_username') == null) {
            return redirect('/');
        } elseif(!session('id_order') || session('id_order') == null) {
            return redirect('/order_pakan');
        }
        // dd($request->id);
            $getdatadummy = OrderPakan::where('no_order', $request->id )->first();
            $dummy = OrderPakan::where('no_order', $request->id)->first();
            $dummyorder = Dummy::where('id_order', $getdatadummy->no_order)->get();
            // dd($dummy);
            $pakan = Pakan::all();
            return view('admin.detail_order', compact('dummy','pakan','dummyorder'));

    }
    public function create(Request $request){
        $karakter = '123456789';
        $generate = substr(str_shuffle($karakter), 0, 3);
        $hasil = 'TR-00'.$generate;
                $hsl = Dummy::create([
                    'no_transaksi' => $hasil,
                    'id_order' => $request->id_order,
                    'tgl_order' => $request->tgl_order,
                    'tgl_estimasi' => $request->tgl_estimasi,
                    'tgl_transaksi' => $request->tgl_transaksi,
                    'order_by' => $request->order_by,
                    'nama_pakan' => $request->nama_pakan,
                    'jumlah_pakan' => $request->jumlah_pakan,
                    'supplier' => $request->supplier,
                    'total' => $request->total,
                    // 'harga' => '0',
                ]);
                
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Order Pakan Berhasil Ditambahkan ', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Order Pakan gagal ditambahkan', 'alert' => 'danger']);
                }
    }
    public function find(Request $req)
    {
        $hsl = Pakan::where('id', $req->id)->first();
        if ($hsl) {
            return response()->json($hsl);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => true]);
        }
    }
}