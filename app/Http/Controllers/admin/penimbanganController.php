<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RegisDomba;
use App\Penimbangan;
use Exception;
use Illuminate\Http\Request;

class penimbanganController extends Controller
{

    public function index()
    {
        try {


            if (!session('admin_username') || session('admin_username') == null) {
                return redirect('/');
            }
            $data_domba = RegisDomba::get();
            $data = Penimbangan::orderBy('id', 'desc')->get();
            return view('admin.penimbangan', compact('data_domba', 'data'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function create(Request $request)
    {
        try {


            $validasi = $request->validate([
                'no_regis' => 'required',
                'tgl_timbang' => 'required',
                'berat_timbang' => 'required',
                'vitamin' => 'required',
            ]);
            if ($validasi) {
                $tgl_timbang = convertTgl($request->tgl_timbang, "-");
                if ($tgl_timbang > tgl_sekarang()) {
                    return redirect()->back()->with(['message' => 'Tanggal timbang melebihi tanggal sekarang ', 'alert' => 'danger']);
                }
                $hsl = Penimbangan::create([

                    'no_regis' => $request->no_regis,
                    'tgl_timbang' => $tgl_timbang,
                    'berat_timbang' => $request->berat_timbang,
                    'vitamin' =>  $request->vitamin
                ]);
                $update_berat = RegisDomba::where('no_regis', $request->no_regis)->update([
                    'berat_akhir' => $request->berat_timbang,
                ]);
                if ($hsl && $update_berat) {
                    return redirect()->back()->with(['message' => 'Penimbangan Domba Berhasil Ditambahkan ', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Penimbangan Domba gagal ditambahkan', 'alert' => 'danger']);
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
        $hsl = Penimbangan::where('id', $req->id)->first();
        if ($hsl) {
            return response()->json($hsl);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan', 'error' => true]);
        }
    }
    public function timbangan_terakhir(Request $req)
    {
        $hsl = Penimbangan::where('no_regis', $req->id)->orderBy('tgl_timbang', 'desc')->orderBy('id', 'desc')->first();
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
                    'no_regis' => 'required',
                    'tgl_timbang' => 'required',
                    'berat_timbang' => 'required',
                    'vitamin' => 'required',
                ]);

                if ($validasi) {
                    $tgl_timbang = convertTgl($request->tgl_timbang, "-'");

                    if ($tgl_timbang > tgl_sekarang()) {
                        return redirect()->back()->with(['message' => 'Tanggal timbang melebihi tanggal sekarang ', 'alert' => 'danger']);
                    }
                    $hsl = Penimbangan::where('id', $request->id)->update([
                        'no_regis' => $request->no_regis,
                        'tgl_timbang' => $tgl_timbang,
                        'berat_timbang' => $request->berat_timbang,
                        'vitamin' =>  $request->vitamin
                    ]);
                    $update_berat = RegisDomba::where('no_regis', $request->no_regis)->update([
                        'berat_akhir' => $request->berat_timbang,
                    ]);
                    if ($hsl) {
                        return redirect()->back()->with(['message' => 'Penimbangan Domba Berhasil diubah', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'Penimbangan Domba gagal diubah', 'alert' => 'danger']);
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


            $hsl = Penimbangan::find($req->id)->delete();
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
