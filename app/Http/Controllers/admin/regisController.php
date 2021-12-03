<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RegisDomba;
use App\JenisDomba;
use App\KandangDomba;
use App\Penimbangan;
use Illuminate\Http\Request;

class regisController extends Controller
{

    public function index()
    {
        if (!session('admin_username') || session('admin_username') == null) {
            return redirect('/');
        }
        $jenis = JenisDomba::get();
        $kandang = KandangDomba::get();
        $penimbangan = Penimbangan::get();
        $data = RegisDomba::get();
        return view('admin.regis_domba', compact('jenis', 'kandang', 'data','penimbangan'));
    }
    public function statistik(Request $request)
    {
        if (!session('admin_username') || session('admin_username') == null) {
            return redirect('/');
        }
        $jenis = JenisDomba::get();
        $kandang = KandangDomba::get();
        $penimbangan = Penimbangan::where('no_regis', $request->id)->get();
        $data = RegisDomba::where('no_regis', $request->id)->first();
        return view('admin.statistik_domba', compact('jenis', 'kandang', 'data','penimbangan'));
    }
    public function regis_domba(Request $request)
    {
        try {
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
                if ($unq) {
                    return redirect()->back()->with(['message' => 'No Registrasi Domba Sudah Terdaftar ', 'alert' => 'warning']);
                } else {
                    $hrg_beli = str_replace(".", "", $request->harga_beli);
                    $hrg_beli = str_replace(",", ".", $hrg_beli);

                    $berat = str_replace(".", "", $request->berat_awal);
                    $berat = str_replace(",", ".", $berat);

                    $hsl = RegisDomba::create([
                        'no_regis' => $request->no_regis,
                        'tgl_masuk' => $request->tgl_masuk,
                        'berat_awal' => $berat,
                        'jenis' => $request->jenis,
                        'kandang' => $request->kandang,
                        'kamar' => $request->kamar,
                        'harga_beli' => $hrg_beli,
                        'supplier' => $request->supplier,
                        'user_input' => session('admin_username'),
                    ]);
                    if ($hsl) {
                        return redirect()->back()->with(['message' => 'Registrasi Domba Berhasil Ditambahkan ', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'Registrasi Domba gagal ditambahkan', 'alert' => 'danger']);
                    }
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diinputan belum lengkap ', 'alert' => 'danger']);
            }
        } catch (\Exception $e) {

            return Redirect()->back()->with(['message' => 'Proses Registrasi Domba Gagal, Ket : ' . $e->getMessage(), 'alert' => 'danger'])->withInput($request->all());
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
                } else {
                    return redirect()->back()->with(['message' => 'Registrasi Domba gagal diubah', 'alert' => 'danger']);
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

        $hsl = RegisDomba::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
