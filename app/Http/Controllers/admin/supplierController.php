<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Supplier;
use App\City;
use App\Province;
use Illuminate\Http\Request;

class supplierController extends Controller
{

    public function index()
    {
        try {
            $data = Supplier::get();
            $province = Province::get();
            $city = City::get();
            return view('admin.supplier', compact('data', 'province', 'city'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function pakan()
    {
        try {
            $data = Supplier::where('jenis_supplier', 'like', 'Pakan')->get();
            return view('admin.supplier-pakan', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function domba()
    {
        try {


            $data = Supplier::where('jenis_supplier', 'like', 'Domba')->get();
            return view('admin.supplier-domba', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function create(Request $request)
    {
        try {


            $validasi = $request->validate([
                'nama_supplier' => 'required',
                'jenis_supplier' => 'required',
                'alamat' => 'required',
                'kota' => 'required',
                'propinsi' => 'required',
                'hp' => 'required',
                'email' => 'required',
                'kontak' => 'required',
            ]);
            if ($validasi) {
                $cek = Supplier::where('nama_supplier', $request->nama_supplier)->first();
                if ($cek) {
                    return redirect()->back()->with(['message' => 'Nama Supplier ' . $request->nama_supplier . ' sudah terdaftar', 'alert' => 'danger']);
                }
                $hsl = Supplier::create([
                    'nama_supplier' => $request->nama_supplier,
                    'jenis_supplier' => $request->jenis_supplier,
                    'alamat' => $request->alamat,
                    'kota' => $request->kota,
                    'propinsi' => $request->propinsi,
                    'telp' => $request->telp,
                    'hp' => $request->hp,
                    'email' => $request->email,
                    'kontak' => $request->kontak,
                    'user_input' => session('admin_username'),
                    'tgl_input' => date('Y-m-d h:i:s'),
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Supplier Berhasil Ditambahkan ', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Supplier gagal ditambahkan', 'alert' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
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
        try {


            if (!empty($request->id)) {
                $validasi = $request->validate([
                    'nama_supplier' => 'required',
                    'jenis_supplier' => 'required',
                    'alamat' => 'required',
                    'kota' => 'required',
                    'propinsi' => 'required',
                    'hp' => 'required',
                    'email' => 'required',
                    'kontak' => 'required',
                ]);

                if ($validasi) {

                    $hsl = Supplier::where('id', $request->id)->update([
                        'nama_supplier' => $request->nama_supplier,
                        'jenis_supplier' => $request->jenis_supplier,
                        'alamat' => $request->alamat,
                        'kota' => $request->kota,
                        'propinsi' => $request->propinsi,
                        'telp' => $request->telp,
                        'hp' => $request->hp,
                        'email' => $request->email,
                        'kontak' => $request->kontak,
                        'tgl_edit' => date('Y-m-d h:i:s'),
                        'user_edit' => session('admin_username')
                    ]);
                    if ($hsl) {
                        return redirect()->back()->with(['message' => 'Supplier Berhasil diubah', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'Supplier gagal diubah', 'alert' => 'danger']);
                    }
                } else {
                    return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap ', 'alert' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap,idnya kosong ', 'alert' => 'danger']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function delete(Request $req)
    {
        try {



            $hsl = Supplier::find($req->id)->delete();
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function city_list(Request $req)
    {
        try {


            $get = Province::where('province', $req->id)->first()->id;
            $city = City::where('province_id', $get)->get();
            if (count($city) > 0) {
                $data = array(
                    'code' => 200,
                    'result' => $city
                );
                $code = 200;
            } else {
                $code = 404;
                $data = array(
                    'code' => 404,
                    'error' => 'Province ID not Found'
                );
            }


            return  response()->json($data, $code);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
