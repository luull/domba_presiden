<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RegisDomba;
use App\JenisDomba;
use App\KandangDomba;
use Illuminate\Http\Request;

class regisController extends Controller
{

    public function index()
    {
        $jenis = JenisDomba::get();
        $kandang = KandangDomba::get();
        $data = RegisDomba::get();
        return view('admin.regis_domba', compact('jenis','kandang','data'));
    }
    public function regis_domba(Request $request){
        $validasi = $request->validate([
            'no_regis' => 'required',
            'tgl_masuk' => 'required',
            'berat_awal' => 'required',
            'jenis' => 'required',
            'kandang' => 'required',
            'kamar' => 'required',
            'harga_beli' => 'required',
            'supplier' => 'required'
        ]);
        if ($validasi) {
                $unq = RegisDomba::where('no_regis', $request->no_regis)->first();
                if($unq){
                    return redirect()->back()->with(['message' => 'No Registrasi Domba Sudah Terdaftar ', 'alert' => 'warning']);
                }else {
                $hsl = RegisDomba::create([
                    'no_regis' => $request->no_regis,
                    'tgl_masuk' => $request->tgl_masuk,
                    'berat_awal' => $request->berat_awal,
                    'jenis' => $request->jenis,
                    'kandang' => $request->kandang,
                    'kamar' => $request->kamar,
                    'harga_beli' => $request->harga_beli,
                    'supplier' => $request->supplier,
                ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Registrasi Domba Berhasil Ditambahkan ', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Registrasi Domba gagal ditambahkan', 'alert' => 'danger']);
                }
                }
        }
        else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = RegisDomba::where('id', $req->id)->first();
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
                'no_regis' => 'required',
                'tgl_masuk' => 'required',
                'berat_awal' => 'required',
                'jenis' => 'required',
                'kandang' => 'required',
                'kamar' => 'required',
                'harga_beli' => 'required',
                'supplier' => 'required'
            ]);

            if ($validasi) {
            $hsl = RegisDomba::where('id', $request->id)->update([
                'no_regis' => $request->no_regis,
                'tgl_masuk' => $request->tgl_masuk,
                'berat_awal' => $request->berat_awal,
                'jenis' => $request->jenis,
                'kandang' => $request->kandang,
                'kamar' => $request->kamar,
                'harga_beli' => $request->harga_beli,
                'supplier' => $request->supplier,
            ]);
                if ($hsl) {
                    return redirect()->back()->with(['message' => 'Registrasi Domba Berhasil diubah', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Registrasi Domba gagal diubah', 'alert' => 'danger']);
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
      
        $hsl = RegisDomba::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}