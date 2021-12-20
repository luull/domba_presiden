<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KandangDomba;
use App\Satuan;
use App\Pakan;
use App\PemberianPakan;
use App\RegisDomba;
use Exception;
use Illuminate\Http\Request;

class PakanController extends Controller
{

    public function index()
    {
        try {


            if (!session('admin_username') || session('admin_username') == null) {
                return redirect('/');
            }
            $satuan = Satuan::get();
            $data = Pakan::get();
            return view('admin.pakan', compact('data', 'satuan'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function pemberian_pakan()
    {
        try {


            if (!session('admin_username') || session('admin_username') == null) {
                return redirect('/');
            }
            $data_domba = RegisDomba::get();
            $data = PemberianPakan::get();
            $kandang = KandangDomba::get();

            return view('admin.pemberian_pakan', compact('data_domba', 'data', 'kandang'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function create(Request $request)
    {
        try {


            $validasi = $request->validate([
                'nama_pakan' => 'required',
                'stok_pakan' => 'required',
                'satuan_pakan' => 'required',
                'harga_pakan' => 'required',
            ]);
            $karakter = '123456789';
            $generate = substr(str_shuffle($karakter), 0, 3);
            $hasil = 'BP-00' . $generate;
            if ($validasi) {

                $hsl = Pakan::create([
                    'kode_pakan' => $hasil,
                    'nama_pakan' => $request->nama_pakan,
                    'stok_pakan' => $request->stok_pakan,
                    'satuan_pakan' => $request->satuan_pakan,
                    'harga_pakan' => $request->harga_pakan,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Jenis Pakan Berhasil Ditambahkan ', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Jenis Pakan gagal ditambahkan', 'alert' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
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
    public function update(Request $request)
    {
        try {


            if (!empty($request->id)) {
                $validasi = $request->validate([
                    'nama_pakan' => 'required',
                    'stok_pakan' => 'required',
                    'satuan_pakan' => 'required',
                    'harga_pakan' => 'required',
                ]);

                if ($validasi) {
                    $hsl = Pakan::where('id', $request->id)->update([
                        'kode_pakan' => $request->kode_pakan,
                        'nama_pakan' => $request->nama_pakan,
                        'stok_pakan' => $request->stok_pakan,
                        'satuan_pakan' => $request->satuan_pakan,
                        'harga_pakan' => $request->harga_pakan,
                    ]);
                    if ($hsl) {
                        return redirect()->back()->with(['message' => 'Jenis Pakan Berhasil diubah', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'Jenis Pakan gagal diubah', 'alert' => 'danger']);
                    }
                } else {
                    return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap ', 'alert' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap,idnya kosong ', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function delete(Request $req)
    {
        try {


            $hsl = Pakan::find($req->id)->delete();
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
