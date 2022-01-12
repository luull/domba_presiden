<?php

namespace App\Http\Controllers\admin;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\D_booking;
use App\D_booking_temp;
use App\D_jual;
use App\Dummy_jual;
use App\H_jual;
use App\H_booking;
use App\H_booking_temp;
use App\Investor;
use App\RegisDomba;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class jualdombaController extends Controller
{
    public function jual()
    {
        $data = Customer::get();

        return view('admin.jualdomba', compact('data'));
    }
    public function jual1(Request $req)
    {
        $id = $req->id;
        $ses_id = session()->getId();

        Dummy_jual::where('session_id', $ses_id)
            ->where('customer_id', $id)
            ->where('username', session('admin_username'))
            ->where('jenis_transaksi', '2')
            ->delete();
        session(['username_dummy' => session('admin_username')]);

        $domba = RegisDomba::where('status', '<>', 2)->orderBy('id', 'desc')->get();
        $data = Customer::where('id', $id)->first();
        return view('admin.jualdomba1', compact('data', 'domba'));
    }
    public function addDummy(Request $req)
    {
        try {
            $ses_id = session()->getId();

            $data = RegisDomba::where('id', $req->id)->where('status', '<', 2)->first();
            if ($data) {
                $berat_akhir = berat_akhir($data->id, $data->berat_awal);
                $total = $data->harga_jual * $berat_akhir;
                /*Dummy_jual::where('session_id', $ses_id)
                    ->where('customer_id', $req->cust_id)
                    ->where('username', session('username_dummy'))
                    ->where('jenis_transaksi', '2')
                    ->where('no_regis', $data->no_regis)->delete();*/
                Dummy_jual::create([
                    'session_id' => $ses_id,
                    'no_regis' => $data->no_regis,
                    'customer_id' => $req->cust_id,
                    'username' => session('username_dummy'),
                    'berat_awal' => $data->berat_awal,
                    'berat_akhir' => $berat_akhir,
                    'jenis' => $data->jenis,
                    'kandang' => $data->kandang,
                    'kamar' => $data->kamar,
                    'harga' => $data->harga_jual,
                    'total' => $total,
                    'supplier' => $data->supplier,
                    'tgl_masuk' => $data->tgl_masuk,
                    'jenis_transaksi' => '2',

                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Data domba ' . $data->no_regis . ' sukses ditambahkan',
                    'data' => $data
                ]);
            } else {
                return
                    response()->json([
                        'status' => false,
                        'message' => 'Data domba tidak terdaftar atau sudah terjual',
                    ]);
            }
        } catch (Exception $e) {
            return
                response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ]);
        }
    }
    public function showDummy(Request $req)
    {
        try {

            $ses_id = session()->getId();
            $user = session('username_dummy');
            $cust_id = $req->id;
            $total = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $cust_id)
                ->where('username', $user)
                ->where('jenis_transaksi', '2')->sum('total');
            $data = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $cust_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->get();
            if (count($data) > 0) {

                return
                    response()->json([
                        'status' => true,
                        'data' => $data,
                        'total' => number_format($total, 0),
                    ]);
            } else {
                return
                    response()->json([
                        'status' => false,
                        'message' => 'Data masih kosong',
                    ]);
            }
        } catch (Exception $e) {
            return
                response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ]);
        }
    }
    public function proses_jual_selesai(Request $req)
    {
        try {

            DB::beginTransaction();
            $ses_id = session()->getId();
            $cust_id = $req->cust_id;
            $user = session('admin_username');
            $tgl_transaksi = convertTgl($req->tgl_transaksi, "-");
            if (empty($tgl_transaksi)) {
                return redirect()->back()->with(['message' => 'Tanggal Transaksi Masih Kosong', 'alert' => 'danger']);
            }
            $tgl_transaksi1 = str_replace("-", "", $tgl_transaksi);
            $prefix = 'INV' . $tgl_transaksi1 . '-';
            $pref = substr($prefix, 0, 10) . "%";
            $jml_transaksi = DB::select('select count(id) as jml from h_jual where no_transaksi like ?', [$pref]);
            if ($jml_transaksi) {
                $jml_transaksi = (int)$jml_transaksi[0]->jml + 1;
            } else {
                $jml_transaksi = 0;
            }
            $nol = str_repeat("0", 5 - strlen($jml_transaksi));
            $no_transaksi = $prefix . $nol . $jml_transaksi;
            $dummy = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $cust_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->get();
            $jml_item = 1;
            foreach ($dummy as $d) {
                D_jual::create([
                    'no_transaksi' => $no_transaksi,
                    'no_regis' => $d->no_regis,
                    'berat' => $d->berat_akhir,
                    'jml' => 1,
                    'hrg_jual' => $d->harga,
                    'total' => $d->total,

                ]);
                $jml_item++;
            }

            $sub_total = $req->totalorder;
            $sub_total = str_replace(",", "", $sub_total);

            $diskon = 0;
            $total = $sub_total - $diskon;
            $dibayar = $req->dibayar;
            $kembalian = $req->kembalian;
            $dibayar = str_replace(",", "", $dibayar);
            $kembalian = str_replace(",", "", $kembalian);
            $cara_bayar = $req->cara_bayar;
            $keterangan = $req->keterangan;
            H_jual::create([
                'no_transaksi' => $no_transaksi,
                'tgl_transaksi' => $tgl_transaksi,
                'id_customer' => $req->cust_id,
                'qty' => $jml_item,
                'sub_total' => $sub_total,
                'diskon' => $diskon,
                'total' => $total,
                'cara_bayar' => $cara_bayar,
                'keterangan' => $keterangan,
                'user_input' => session('admin_username'),
                'tgl_input' => Carbon::now(),



            ]);
            foreach ($dummy as $d) {
                RegisDomba::where('no_regis', $d->no_regis)->update([
                    'status' => 2
                ]);
            }
            $dummy = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $cust_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->delete();
            DB::commit();
            return redirect()->back()->with(['message' => 'Proses Penjualan Domba Sukses', 'alert' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses gagal ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }
    public function proses_booking_selesai(Request $req)
    {
        try {

            DB::beginTransaction();
            $ses_id = session()->getId();
            $investor_id = $req->cust_id;
            $user = session('admin_username');
            $tgl_transaksi = $req->tgl_transaksi;
            if (empty($tgl_transaksi)) {
                return redirect()->back()->with(['message' => 'Tanggal Transaksi Masih Kosong', 'alert' => 'danger']);
            }
            $tgl_transaksi1 = str_replace("-", "", $tgl_transaksi);
            $prefix = 'BKG' . $tgl_transaksi1 . '-';
            $pref = substr($prefix, 0, 10) . "%";
            $jml_transaksi = DB::select('select count(id) as jml from h_booking where no_transaksi like ?', [$pref]);
            if ($jml_transaksi) {
                $jml_transaksi = (int)$jml_transaksi[0]->jml + 1;
            } else {
                $jml_transaksi = 0;
            }
            $nol = str_repeat("0", 5 - strlen($jml_transaksi));
            $no_transaksi = $prefix . $nol . $jml_transaksi;
            $dummy = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $investor_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->get();
            $jml_item = 1;
            $berat_awal_investor = $d->berat_akhir;
            foreach ($dummy as $d) {
                D_booking::create([
                    'no_transaksi' => $no_transaksi,
                    'no_regis' => $d->no_regis,
                    'berat' => $d->berat_akhir,
                    'jml' => 1,
                    'hrg_jual' => $d->harga,
                    'total' => $d->total,

                ]);
                $jml_item++;
            }

            $sub_total = $req->totalorder;
            $sub_total = str_replace(",", "", $sub_total);

            $diskon = 0;
            $total = $sub_total - $diskon;
            $dibayar = $req->dibayar;
            $kembalian = $req->kembalian;
            $dibayar = str_replace(",", "", $dibayar);
            $kembalian = str_replace(",", "", $kembalian);
            $cara_bayar = $req->cara_bayar;
            $keterangan = $req->keterangan;
            H_booking::create([
                'no_transaksi' => $no_transaksi,
                'tgl_transaksi' => tgl_sekarang(),
                'id_investor' => $req->cust_id,
                'qty' => $jml_item,
                'sub_total' => $sub_total,
                'diskon' => $diskon,
                'total' => $total,
                'cara_bayar' => $cara_bayar,
                'keterangan' => $keterangan,
                'user_input' => session('admin_username'),
                'tgl_input' => Carbon::now(),



            ]);
            foreach ($dummy as $d) {
                RegisDomba::where('no_regis', $d->no_regis)->update([
                    'status' => 1,
                    'berat_awal_investor' => $berat_awal_investor,
                    'tgl_awal_investor' => tgl_sekarang(),
                ]);
            }
            $dummy = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $investor_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->delete();
            DB::commit();
            return redirect()->back()->with(['message' => 'Proses Penjualan Domba Sukses', 'alert' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses gagal ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }
    public function daftar_booking()
    {
        $data = H_booking_temp::where('tgl_acc', NULL)->orderBy('id', 'asc')->get();
        return view('admin.daftar_booking', compact('data'));
    }

    public function delete_daftar_booking(Request $req)
    {
        try {
            DB::beginTransaction();
            $hasil = H_booking_temp::where('no_transaksi', $req->id)->delete();
            if ($hasil) {
                D_booking_temp::where('no_transaksi', $req->id)->delete();
                DB::commit();
                return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
            } else {
                return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }

    public function approve_daftar_booking(Request $req)
    {
        try {
            DB::beginTransaction();
            $hasil = H_booking_temp::where('no_transaksi', $req->id)->update([
                'tgl_acc' => tgl_sekarang_full(),
                'user_acc' => session('admin_username')
            ]);
            $h_data = H_booking_temp::where('no_transaksi', $req->id)->get();
            $d_data = D_booking_temp::where('no_transaksi', $req->id)->get();
            foreach ($d_data as $d) {
                D_booking::create([
                    'no_transaksi' => $d->no_transaksi,
                    'no_regis' => $d->no_regis,
                    'berat' => $d->berat,
                    'jml' => $d->jml,
                    'hrg_jual' => $d->hrg_jual,
                    'total' => $d->total,

                ]);
                RegisDomba::where('no_regis', $d->no_regis)->update([
                    'status' => 1,
                    'pemilik' => session('investor_id'),
                ]);
            }
            foreach ($h_data as $h) {

                H_booking::create([
                    'no_transaksi' => $h->no_transaksi,
                    'tgl_transaksi' => $h->tgl_transaksi,
                    'id_investor' => $h->id_investor,
                    'qty' => $h->qty,
                    'sub_total' => $h->sub_total,
                    'diskon' => $h->diskon,
                    'total' => $h->total,
                    'cara_bayar' => $h->cara_bayar,
                    'keterangan' => $h->keterangan,
                    'user_input' => $h->user_input,
                    'tgl_input' => $h->tgl_input,
                ]);
            }
            DB::commit();
            return redirect()->back()->with(['message' => 'Data berhasil diapprove', 'alert' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Data gagal diapprove ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }

    public function booking()
    {
        $data = Investor::get();

        return view('admin.bookingdomba', compact('data'));
    }
    public function booking1(Request $req)
    {
        $id = $req->id;
        $ses_id = session()->getId();
        Dummy_jual::where('session_id', $ses_id)
            ->where('customer_id', $id)
            ->where('username', session('admin_username'))
            ->where('jenis_transaksi', '2')
            ->delete();

        $domba = RegisDomba::where('status', 0)->orderBy('id', 'desc')->get();
        $data = Investor::where('id', $id)->first();
        return view('admin.bookingdomba1', compact('data', 'domba'));
    }
    public function booking_by_investor(Request $req)
    {
        $id = session('investor_id');
        $ses_id = session()->getId();
        session(['username_dummy' => session('investor_username')]);
        Dummy_jual::where('session_id', $ses_id)
            ->where('customer_id', $id)
            ->where('username', session('investor_username'))
            ->where('jenis_transaksi', '2')
            ->delete();

        $domba = RegisDomba::where('status', '0')->orderBy('id', 'desc')->get();
        $data = Investor::where('id', $id)->first();
        return view('investor.bookingdomba', compact('data', 'domba'));
    }

    public function proses_booking_by_investor_selesai(Request $req)
    {
        try {
            DB::beginTransaction();
            $ses_id = session()->getId();
            $investor_id = session('investor_id');
            $user = session('investor_username');
            $tgl_transaksi = tgl_sekarang();

            $tgl_transaksi1 = str_replace("-", "", $tgl_transaksi);
            $prefix = 'BKG' . session('investor_id') . $tgl_transaksi1 . '-';
            $pref = substr($prefix, 0, 10) . "%";
            $jml_transaksi = DB::select('select count(id) as jml from h_booking where no_transaksi like ?', [$pref]);
            if ($jml_transaksi) {
                $jml_transaksi = (int)$jml_transaksi[0]->jml + 1;
            } else {
                $jml_transaksi = 0;
            }
            $nol = str_repeat("0", 5 - strlen($jml_transaksi));
            $no_transaksi = $prefix . $nol . $jml_transaksi;
            $dummy = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $investor_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->get();
            $jml_item = 1;
            $sub_total = 0;
            foreach ($dummy as $d) {
                D_booking_temp::create([
                    'no_transaksi' => $no_transaksi,
                    'no_regis' => $d->no_regis,
                    'berat' => $d->berat_akhir,
                    'jml' => 1,
                    'hrg_jual' => $d->harga,
                    'total' => $d->total,

                ]);
                $jml_item++;
                $sub_total = $sub_total + $d->total;
            }

            $diskon = 0;
            $total = $sub_total - $diskon;
            $dibayar = $total;
            $kembalian = 0;
            $cara_bayar = "Transfer";
            //$keterangan = $req->keterangan;
            $keterangan = "";
            H_booking_temp::create([
                'no_transaksi' => $no_transaksi,
                'tgl_transaksi' => $tgl_transaksi,
                'id_investor' => $investor_id,
                'qty' => $jml_item,
                'sub_total' => $sub_total,
                'diskon' => $diskon,
                'total' => $total,
                'cara_bayar' => $cara_bayar,
                'keterangan' => $keterangan,
                'user_input' => session('investor_username'),
                'tgl_input' => tgl_sekarang_full(),



            ]);

            $dummy = Dummy_jual::where('session_id', $ses_id)
                ->where('customer_id', $investor_id)
                ->where('jenis_transaksi', '2')
                ->where('username', $user)->delete();
            DB::commit();
            return redirect()->back()->with(['message' => 'Proses Pembelian Domba Sukses', 'alert' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses gagal ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }

    public function konfirmasi_pembayaran()
    {
        $bank = Bank::get();

        $invoice = H_booking_temp::where('id_investor', session('investor_id'))->where('tgl_acc', NULL)->get();
        return view('investor.konfirmasi_pembayaran', compact('invoice', 'bank'));
    }
    public function proses_konfirmasi_pembayaran(Request $req)
    {
        if ($req->hasFile('bukti_transfer')) {
            $nmfile = "bukti_pembayaran/" . session('investor_id') . $req->no_transaksi . "." . $req->bukti_transfer->getClientOriginalExtension();
            $namafile = asset("bukti_pembayaran/" . session('investor_id') .  $req->no_transaksi . "." . $req->bukti_transfer->getClientOriginalExtension());
            if (file_exists(public_path() . '/' . $nmfile)) {
                unlink(public_path() . '/' . $nmfile);
            }
            $keterangan = "Sudah ditransfer tgl " . $req->tgl_transfer . " ke " . $req->bank_tujuan . "<br>";
            $keterangan .= '<a href="' . $namafile . '" target="blank"><img src="' . $namafile . '" border=0 style="width:100px"></a>';

            $save = H_booking_temp::where('no_transaksi', $req->no_transaksi)->update([
                'keterangan' => $keterangan
            ]);
            if ($save) {

                $file = $req->file('bukti_transfer');
                $extension = $file->getClientOriginalExtension();
                $name = session('investor_id') . $req->no_transaksi . '.' . $extension;
                $hasil = $file->move(public_path() . '/bukti_pembayaran/' .  $name);

                $msg = 'Proses konfirmasi pembayaran sukses';
                $alert = "success";
            } else {
                $msg = 'Proses konfirmasi pembayaran gagal';
                $alert = "danger";
            }
        } else {

            $msg = 'Mohon maaf bukti transfer wajib dicantumkan';
            $alert = "danger";
        }
        return redirect('/investor/konfirmasi-pembayaran')->with(['message' => $msg, 'alert' => $alert]);
    }
}
