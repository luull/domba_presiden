<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Investor;
use App\City;
use App\Province;
use App\Bank;
use App\JenisDomba;
use App\KandangDomba;
use App\PemberianPakan;
use App\Penimbangan;
use App\RegisDomba;
use App\Supplier;
use Exception;
use Illuminate\Http\Request;

class investorController extends Controller
{

    public function index()
    {
        $data = Investor::get();
        $province = Province::get();
        $city = City::get();
        $bank = Bank::get();
        return view('admin.investor', compact('data', 'province', 'city', 'bank'));
    }
    public function create(Request $request)
    {
        try {


            $validasi = $request->validate([
                'username' => 'required',
                'password' => 'required',
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

                $hsl = Investor::create([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
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
                    return redirect()->back()->with(['message' => 'Investor Berhasil Ditambahkan ', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Investor gagal ditambahkan', 'alert' => 'danger']);
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
        $hsl = Investor::where('id', $req->id)->first();
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
                    $hsl = Investor::where('id', $request->id)->update([
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
                        return redirect()->back()->with(['message' => 'Investor Berhasil diubah', 'alert' => 'success']);
                    } else {
                        return redirect()->back()->with(['message' => 'Investor gagal diubah', 'alert' => 'danger']);
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


            $hsl = Investor::find($req->id)->delete();
            if ($hsl) {
                return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function edit_profil()
    {
        $province = Province::get();
        $city = City::get();
        $bank = Bank::get();
        $data = session('data_investor');
        return view('investor.profil_investor', compact('province', 'city', 'bank', 'data'));
    }
    public function proses_edit_profil(Request $request)
    {
        try {

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
                $hsl = Investor::where('id', session('data_investor')->id)->update([
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'kota' => $request->kota,
                    'propinsi' => $request->propinsi,
                    'hp' => $request->hp,
                    'email' => $request->email,
                    'kode_bank' => $request->kode_bank,
                    'no_rekening' => $request->no_rekening,
                    'tgl_edit' => date('Y-m-d h:i:s'),
                    'user_edit' => session('investor_username')
                ]);
                if ($hsl) {
                    $dt = Investor::find(session('data_investor')->id);
                    session(['data_investor' => $dt]);
                    return redirect()->back()->with(['message' => 'Profil Investor Berhasil diubah', 'alert' => 'success']);
                } else {
                    return redirect()->back()->with(['message' => 'Profil Investor gagal diubah', 'alert' => 'danger']);
                }
            } else {
                return redirect()->back()->with(['message' => 'Data yang diubah belum lengkap ', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function domba_sold()
    {
        try {



            $jenis = JenisDomba::get();
            $kandang = KandangDomba::get();
            $penimbangan = Penimbangan::get();
            $data = RegisDomba::where('status', 2)->orderBy('id', 'desc')->get();
            $judul = "DAFTAR DOMBA TERJUAL";
            $supplier =  Supplier::where('jenis_supplier', 'like', 'Domba')->orderBy('nama_supplier', 'asc')->get();
            return view('investor.laporan_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'supplier', 'judul'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function domba_available()
    {
        try {



            $jenis = JenisDomba::get();
            $kandang = KandangDomba::get();
            $penimbangan = Penimbangan::get();
            $data = RegisDomba::where('status', 0)->orderBy('id', 'desc')->get();
            $judul = "DAFTAR DOMBA SIAP DIJUAL";
            $supplier = Supplier::where('jenis_supplier', 'like', 'Domba')->orderBy('nama_supplier', 'asc')->get();
            return view('investor.laporan_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'supplier', 'judul'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function domba_booked()
    {
        try {



            $jenis = JenisDomba::get();
            $kandang = KandangDomba::get();
            $penimbangan = Penimbangan::get();
            $data = RegisDomba::where('status', 1)->orderBy('id', 'desc')->get();
            $judul = "DAFTAR DOMBA KESELURUHAN";
            $supplier = Supplier::where('jenis_supplier', 'like', 'Domba')->orderBy('nama_supplier', 'asc')->get();
            return view('investor.laporan_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'supplier', 'judul'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function detil_domba(Request $request)
    {
        try {



            $jenis = JenisDomba::get();
            $kandang = KandangDomba::get();
            $penimbangan = Penimbangan::where('no_regis', $request->id)->get();
            $data = RegisDomba::where('no_regis', $request->id)->first();
            $pakan = PemberianPakan::where('no_regis', $request->id)->get();


            return view('investor.detil_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'pakan'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
