<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RegisDomba;
use App\Penimbangan;
use Illuminate\Http\Request;

class penimbanganController extends Controller
{

    public function index()
    {
        if (!session('admin_username') || session('admin_username') == null) {
            return redirect('/');
        }
        $data_domba = RegisDomba::get();
        $data= Penimbangan::get();
        return view('admin.penimbangan', compact('data_domba','data'));
    }
    public function create(Request $request){
        $validasi = $request->validate([
            'no_regis' => 'required',
            'tgl_timbang' => 'required',
            'berat_timbang' => 'required',
            'vitamin' => 'required',
        ]);
        if ($validasi) {
               
                $hsl = Penimbangan::create([

                    'no_regis' => $request->no_regis,
                    'tgl_timbang' => $request->tgl_timbang,
                    'berat_timbang' => $request->berat_timbang,
                    'vitamin' =>  $request->vitamin
                ]);
                $update_berat = RegisDomba::where('no_regis', $request->no_regis)->update([
                    'berat_akhir' => $request->berat_timbang,
                ]);
                if ($hsl && $update_berat) {
                    return redirect()->back()->with(['message' => 'Penimbangan Domba Berhasil Ditambahkan ', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Penimbangan Domba gagal ditambahkan', 'alert' => 'danger']);
                }
                
        }
        else {
            return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
        }
    }
    public function find(Request $req)
    {
        $hsl = Penimbangan::where('id', $req->id)->first();
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
                'tgl_timbang' => 'required',
                'berat_timbang' => 'required',
                'vitamin' => 'required',
            ]);
            
            if ($validasi) {
                $hsl = Penimbangan::where('id', $request->id)->update([
                    'no_regis' => $request->no_regis,
                    'tgl_timbang' => $request->tgl_timbang,
                    'berat_timbang' => $request->berat_timbang,
                    'vitamin' =>  $request->vitamin
                ]);
                $update_berat = RegisDomba::where('no_regis', $request->no_regis)->update([
                    'berat_akhir' => $request->berat_timbang,
                ]);
                if ($hsl && $update_berat) {
                    return redirect()->back()->with(['message' => 'Penimbangan Domba Berhasil diubah', 'alert' => 'success']);
                }else {
                    return redirect()->back()->with(['message' => 'Penimbangan Domba gagal diubah', 'alert' => 'danger']);
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
      
        $hsl = Penimbangan::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}