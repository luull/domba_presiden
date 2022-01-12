<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Customer;
use App\City;
use App\Province;
use App\Listbank;
use App\H_jual;
use Exception;
use Illuminate\Http\Request;

class customerController extends Controller
{

    public function index()
    {
        try {


            $data = Customer::get();
            $province = Province::get();
            $city = City::get();
            $bank = Listbank::get();
            return view('admin.customer', compact('data', 'province', 'city', 'bank'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function create(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'propinsi' => 'required',
            'hp' => 'required',
            'email' => 'required',
            'kode_bank' => 'required',
            'no_rekening' => 'required',
        ]);
        if ($validasi) {
            $cek = Customer::where('nama', $request->nama)->first();
            if ($cek) {
                return redirect()->back()->with(['message' => 'Nama Customer ' . $request->nama . ' sudah terdaftar', 'alert' => 'danger']);
            }
            $hsl = Customer::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'propinsi' => $request->propinsi,
                'hp' => $request->hp,
                'email' => $request->email,
                'kode_bank' => $request->kode_bank,
                'no_rekening' => $request->no_rekening,
                'user_input' => session('admin_username'),
                'tgl_input' => date('Y-m-d h:i:s'),
            ]);
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Customer Berhasil Ditambahkan ', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Customer gagal ditambahkan', 'alert' => 'danger']);
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
                'alamat' => 'required',
                'kota' => 'required',
                'propinsi' => 'required',
                'hp' => 'required',
                'email' => 'required',
                'kode_bank' => 'required',
                'no_rekening' => 'required',
            ]);

            if ($validasi) {
                $hsl = Customer::where('id', $request->id)->update([
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'kota' => $request->kota,
                    'propinsi' => $request->propinsi,
                    'hp' => $request->hp,
                    'email' => $request->email,
                    'kode_bank' => $request->kode_bank,
                    'no_rekening' => $request->no_rekening,
                    'tgl_edit' => date('Y-m-d h:i:s'),
                    'user_edit' => session('admin_username')
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Customer Berhasil diubah', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Customer gagal diubah', 'alert' => 'danger']);
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
    public function order_list(Request $req)
    {
        $req->validate([
            'tanggal' => 'required'
        ]);
        $a_tgl = explode(" to ", $req->tanggal);
        $cust_id = $req->cust_id;
        $tg1 = convertTgl($a_tgl[0], "-");
        $tg2 = convertTgl($a_tgl[1], "-");
        if (empty($cust_id)) {
            $cust_name = "";
            $data = H_jual::where('tgl_transaksi', '>=', $tg1)
                ->where('tgl_transaksi', '<=', $tg2)->get();
        } else {
            $customer = Customer::where('id', $cust_id)->first();
            $cust_name = $customer->nama;
            $data = H_jual::where('tgl_transaksi', '>=', $tg1)
                ->where('tgl_transaksi', '<=', $tg2)
                ->where('id_customer', $cust_id)->get();
        }

        return view('admin.customer_order_list', compact('data', 'tg1', 'tg2', 'cust_id', 'cust_name'));
    }
    public function order_list1()
    {
        $customer = Customer::get();

        return view('admin.penjualan_customer_per_tgl', compact('customer'));
    }
}
