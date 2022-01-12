<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Investor;
use App\City;
use App\Province;
use App\Listbank;
use App\JenisDomba;
use App\KandangDomba;
use App\PemberianPakan;
use App\Penimbangan;
use App\RegisDomba;
use App\Supplier;
use Exception;
use App\H_booking;
use App\H_jual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class investorController extends Controller
{

    public function index()
    {
        $data = Investor::get();
        $province = Province::get();
        $city = City::get();
        $bank = Listbank::get();
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
            ]);
            if ($validasi) {
                $cek = Investor::where('username', $request->username)->first();
                if ($cek) {
                    return redirect()->back()->with(['message' => 'Username Investor ' . $request->username . ' sudah terdaftar', 'alert' => 'danger']);
                }
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
        $bank = Listbank::get();
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
    public function domba_per_kandang()
    {
        $kandang = KandangDomba::get();

        return view('investor.domba_per_kandang', compact('kandang'));
    }
    public function domba_per_kandang1(Request $req)
    {
        try {



            $jenis = JenisDomba::get();
            $kandang = KandangDomba::get();
            $penimbangan = Penimbangan::get();
            $data = RegisDomba::where('pemilik', session('investor_id'))->where('status', '<', 2)->WHERE('kandang', $req->kandang)->orderBy('id', 'desc')->get();
            $judul = "DAFTAR DOMBA PERKANDANG<br> " . strtoupper($req->kandang);
            $supplier =  Supplier::where('jenis_supplier', 'like', 'Domba')->orderBy('nama_supplier', 'asc')->get();
            return view('investor.laporan_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'supplier', 'judul'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function domba_per_kamar()
    {
        $kamar = DB::select('select kamar from regis_domba group by kamar order by length(kamar),kamar');
        $kandang = KandangDomba::get();
        return view('investor.domba_per_kamar', compact('kamar', 'kandang'));
    }
    public function domba_per_kamar1(Request $req)
    {
        try {


            $jenis = JenisDomba::get();
            $penimbangan = Penimbangan::get();
            $data = RegisDomba::where('pemilik', session('investor_id'))->where('status', '<', 2)
                ->where('kandang', $req->kandang)
                ->WHERE('kamar', $req->kamar)->orderBy('id', 'desc')->get();
            $judul = "DAFTAR DOMBA PERKAMAR<br> " . strtoupper($req->kandang) . " KAMAR " . strtoupper($req->kamar);
            $supplier =  Supplier::where('jenis_supplier', 'like', 'Domba')->orderBy('nama_supplier', 'asc')->get();
            return view('investor.laporan_domba', compact('jenis',  'data', 'penimbangan', 'supplier', 'judul'));
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
            $data = RegisDomba::where('pemilik', session('investor_id'))->where('status', 2)->orderBy('id', 'desc')->get();
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
            $data = RegisDomba::where('pemilik', session('investor_id'))->where('status', '<', 2)->orderBy('id', 'desc')->get();
            $judul = "DAFTAR DOMBA AVAILABLE";
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
            $data = RegisDomba::where('pemilik', session('investor_id'))->orderBy('id', 'desc')->get();
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
            $data = RegisDomba::where('no_regis', $request->id)->first();
            $penimbangan = Penimbangan::where('no_regis', $request->id)
                ->where('tgl_timbang', '>=', $data->tgl_masuk_investor)->get();
            $pakan = PemberianPakan::where('kandang', $data->kandang)->get();

            return view('investor.detil_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'pakan'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
    public function ubah_password_investor(Request $req)
    {
        $id = $req->id;

        return view('admin.ubah_password_investor', compact('id'));
    }
    public function proses_ubah_password(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'password1' => 'required'
        ]);
        $username = $request->username;
        $pwd = $request->password;
        $pwd2 = $request->password1;
        $data = Investor::where('username', $username)->first();
        $getid = Investor::where('username', $username)->first()->id;
        if ($data) {
            if (Hash::check($pwd, $data->password)) {
                return redirect()->back()->with('message', 'Password sama dengan yang lama');
            } elseif (Hash::check($pwd2, $data->password)) {
                return redirect()->back()->with('message', 'Password sama dengan yang lama');
            } else {
                if ($pwd != $pwd2) {
                    return redirect()->back()->with('message', 'Password tidak sama');
                } else {
                    $hsl = investor::where('id', $getid)->update([
                        'password' => bcrypt($pwd)
                    ]);
                    if ($hsl) {
                        return redirect('/investor')->with(['message' => 'Proses ubah password Investor ' . $username . ' sukses', 'alert' => 'success']);
                    }
                }
            }
        }
    }

    public function daftar_domba(Request $req)
    {
        $investor = $req->investor;
        $jenis = JenisDomba::get();
        $kandang = KandangDomba::get();
        $penimbangan = Penimbangan::get();
        $data = RegisDomba::orderBy('id', 'desc')->get();
        $supplier = Supplier::where('jenis_supplier', 'like', 'Domba')->orderBy('nama_supplier', 'asc')->get();
        return view('investor.daftar_domba', compact('jenis', 'kandang', 'data', 'penimbangan', 'supplier'));
    }

    public function order_list(Request $req)
    {
        $req->validate([
            'tanggal' => 'required'
        ]);
        $a_tgl = explode(" to ", $req->tanggal);
        $investor_id = $req->investor_id;
        if (count($a_tgl) == 1) {
            $tg1 = convertTgl($a_tgl[0], "-");
            $tg2 = $tg1;
        } else {
            $tg1 = convertTgl($a_tgl[0], "-");
            $tg2 = convertTgl($a_tgl[1], "-");
        }

        if (empty($investor_id)) {
            $investor_name = "";
            $data = H_booking::where('tgl_transaksi', '>=', $tg1)
                ->where('tgl_transaksi', '<=', $tg2)->get();
        } else {
            $investor = Investor::where('id', $investor_id)->first();
            $investor_name = $investor->nama;
            $data = H_booking::where('tgl_transaksi', '>=', $tg1)
                ->where('tgl_transaksi', '<=', $tg2)
                ->where('id_investor', $investor_id)->get();
        }

        return view('admin.investor_booking_list', compact('data', 'tg1', 'tg2', 'investor_id', 'investor_name'));
    }
    public function order_list1()
    {
        $investor = Investor::get();

        return view('admin.booking_investor_per_tgl', compact('investor'));
    }
    public function sold_list1()
    {
        $investor = Investor::get();

        return view('admin.penjualan_investor_per_tgl', compact('investor'));
    }
    public function sold_list(Request $req)
    {
        $req->validate([
            'tanggal' => 'required'
        ]);
        $a_tgl = explode(" to ", $req->tanggal);
        $investor_id = $req->investor_id;
        if (count($a_tgl) == 1) {
            $tg1 = $a_tgl[0];
            $tg2 = $tg1;
        } else {
            $tg1 = $a_tgl[0];
            $tg2 = $a_tgl[1];
        }

        if (empty($investor_id)) {
            $investor_name = "";
            $data = H_jual::where('tgl_transaksi', '>=', $tg1)
                ->where('tgl_transaksi', '<=', $tg2)->get();
        } else {
            $investor = Investor::where('id', $investor_id)->first();
            $investor_name = $investor->nama;

            $data = DB::select('select a.*,d.id_investor,e.nama from h_jual a inner join d_jual b   
        on a.no_transaksi=b.no_transaksi inner join d_booking c on b.no_regis=c.no_regis  inner join h_booking d on  c.no_transaksi=d.no_transaksi inner join investor e on d.id_investor=e.id  where a.tgl_transaksi>=? and a.tgl_transaksi<=? and d.id_investor=?', [$tg1, $tg2, $investor_id]);
        }

        return view('admin.investor_order_list', compact('data', 'tg1', 'tg2', 'investor_id', 'investor_name'));
    }
    public function domba_list1()
    {
        $investor = Investor::get();

        return view('admin.domba_investor1', compact('investor'));
    }
    public function domba_list(Request $req)
    {


        $investor_id = $req->investor_id;
        $jenis = $req->jenis;
        if (empty($jenis)) {
            $jenis = 3;
        }
        $investor_name = get_investor_name($investor_id);
        if ($jenis == 1) {
            $status = 1;
        }
        if ($jenis == 2) {
            $status = 2;
        }
        if ($jenis == 3) {
            $status = 0;
        }
        if ($status > 0) {
            $data = DB::select('SELECT a.*,nama FROM regis_domba a inner join investor b on a.pemilik=b.id where a.status=? and a.pemilik=?', [$status,  $investor_id]);
        } else {
            $data = DB::select('SELECT a.*,nama FROM regis_domba a inner join investor b on a.pemilik=b.id where  a.pemilik=?', [$investor_id]);
        }

        return view('admin.domba_investor', compact('data', 'jenis', 'investor_id', 'investor_name'));
    }
}
