<?php

namespace App\Http\Controllers\Admin;

use App\D_beli;
use App\D_order;
use App\Dummy_beli;
use App\Dummy_do;
use App\Dummy_pakan;
use App\H_beli;
use App\H_order;
use App\Http\Controllers\Controller;
use App\KandangDomba;
use App\Satuan;
use App\Pakan;
use App\PemberianPakan;
use App\PemberianPakanDetil;
use App\RegisDomba;
use App\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PakanController extends Controller
{

    public function index()
    {
        try {


            if (!session('admin_username') || session('admin_username') == null) {
                return redirect('/');
            }
            $satuan = Satuan::get();
            $incoming = DB::select('select kode_pakan,sum(jml), sum(diterima),sum(jml-diterima) as selisih  from d_order_pakan group by kode_pakan having selisih>0');
            foreach ($incoming as $i) {
                Pakan::where('kode_pakan', $i->kode_pakan)->update([
                    'incoming' => $i->selisih
                ]);
            }
            $data = Pakan::get();
            $supplier = Supplier::where('jenis_supplier', 'Pakan')->get();
            return view('admin.pakan', compact('data', 'satuan', 'supplier'));
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
            $sess_id = session()->getId();
            $data_domba = RegisDomba::get();
            Dummy_pakan::where('session_id', $sess_id)->where('username', session('admin_username'))->delete();

            $data = PemberianPakan::get();
            $kandang = KandangDomba::get();
            $satuan = Satuan::get();
            $pakan = Pakan::get();

            return view('admin.pemberian_pakan', compact('data_domba', 'data', 'kandang', 'satuan', 'pakan'));
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function create_pemberian_pakan(Request $req)
    {
        try {
            DB::beginTransaction();
            $req->validate([
                'kandang' => 'required',
                'tanggal' => 'required',
                'jadwal' => 'required',
                'total_pakan' => 'required|numeric',
                'total_berat_domba' => 'required|numeric'
            ]);
            $tanggal = convertTgl($req->tanggal, "-");
            PemberianPakan::create([
                'kandang' => $req->kandang,
                'tanggal' => $tanggal,
                'jadwal' => $req->jadwal,
                'total_pakan' => $req->total_pakan,
                'total_berat_domba' => $req->total_berat_domba,
                'user_input' => session('admin_username'),
                'tgl_input' => tgl_sekarang_full()

            ]);
            DB::commit();
            return redirect()->back()->with(['message' => 'Proses pemberian pakan berhasil disimpan', 'alert' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses pemberian pakan gagal' . $e->getMessage(), 'alert' => 'danger']);
        }
    }

    public function create(Request $request)
    {
        try {


            $validasi = $request->validate([
                'nama_pakan' => 'required',
                'satuan_pakan' => 'required',
                'harga_pakan' => 'required',
            ]);

            $karakter = '123456789';
            $generate = substr(str_shuffle($karakter), 0, 3);
            $hasil = 'BP-00' . $generate;
            if ($validasi) {
                $cek = Pakan::where('nama_pakan', $request->nama_pakan)->first();
                if ($cek) {
                    return redirect()->back()->with(['message' => 'Jenis Pakan ' . $request->nama_pakan . ' sudah terdaftar', 'alert' => 'danger']);
                }
                $hsl = Pakan::create([
                    'kode_pakan' => $hasil,
                    'nama_pakan' => $request->nama_pakan,
                    'stok_awal' => $request->stok_pakan,
                    'stok' => $request->stok_pakan,
                    'total_stok' => $request->stok_pakan,
                    'satuan_pakan' => $request->satuan_pakan,
                    'harga_pakan' => $request->harga_pakan,
                    'supplier' => $request->supplier,
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
                    'satuan_pakan' => 'required',
                    'harga_pakan' => 'required',
                    'supplier' => 'required',
                ]);

                if ($validasi) {

                    $hsl = Pakan::where('id', $request->id)->first();
                    $hsl->kode_pakan = $request->kode_pakan;
                    $hsl->nama_pakan = $request->nama_pakan;
                    $hsl->stok_awal = $request->stok_pakan;
                    $hsl->stok = $request->stok_pakan + $hsl->stok_masuk - $hsl->stok_keluar;
                    $hsl->total_stok = $hsl->stok - $hsl->rusak;
                    $hsl->satuan_pakan = $request->satuan_pakan;
                    $hsl->harga_pakan = $request->harga_pakan;
                    $hsl->supplier = $request->supplier;
                    $hsl->update();
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

    public function do()
    {
        $data = H_order::where('status', 0)->get();
        return view('admin.do_pakan', compact('data'));
    }
    public function do1(Request $req)
    {

        $sess_id = session()->getId();
        if (strlen($req->no_po) < 1) {
            return redirect()->back()->with(['message' => 'Nomor Order masih kosong', 'alert' => 'danger']);
        } else {
            Dummy_do::where('session_id', $sess_id)->where('no_po', $req->no_po)->delete();
            $dummy = DB::select('select a.supplier_id,a.tgl_estimasi,a.tgl_po,b.*,nama_pakan,satuan_pakan from h_order_pakan a inner join d_order_pakan b on a.no_po=b.no_po inner join pakan c on b.kode_pakan  = c.kode_pakan where a.no_po = ?', [$req->no_po]);
            foreach ($dummy as $dt) {
                $selisih = $dt->jml - $dt->diterima;
                if ($selisih > 0) {

                    Dummy_do::create([
                        'session_id' => $sess_id,
                        'kode_pakan' => $dt->kode_pakan,
                        'nama_pakan' => $dt->nama_pakan,
                        'jml' => $selisih,
                        'satuan' => $dt->satuan_pakan,
                        'harga' => $dt->harga,
                        'total' => $dt->total,
                        'username' => session('admin_username'),
                        'supplier_id' => $dt->supplier_id,
                        'no_po' => $dt->no_po,
                        'tgl_po' => $dt->tgl_po
                    ]);
                }
            }
            $data = Dummy_do::where('session_id', $sess_id)->where('no_po', $req->no_po)->get();
            if (count($data) > 0) {

                $tgl_order = $data[0]->tgl_po;
                $tgl_estimasi = $data[0]->tgl_estimasi;
                $no_po = $req->no_po;
                $supplier_id = $data[0]->supplier_id;
                $pakan = DB::select('select a.*,nama_pakan,satuan_pakan from d_order_pakan a inner join pakan b on a.kode_pakan=b.kode_pakan where no_po = ?', [$req->no_po]);
                $pakan = $data;
                $supplier = Supplier::where('id', $supplier_id)->first();
                $tgl_do = tgl_sekarang();

                return view('admin.do_pakan1', compact('supplier', 'data', 'tgl_order', 'tgl_estimasi', 'pakan', 'supplier_id', 'no_po', 'tgl_do'));
            } else {
                return redirect()->back()->with(['message' => 'No Po ' . $req->no_po . ' sudah seluruhnya diterima', 'alert' => 'success']);
            }
        }
    }
    public function order()
    {
        $data = Supplier::where('jenis_supplier', 'Pakan')->get();
        return view('admin.order_pakan', compact('data'));
    }
    public function order1(Request $req)
    {
        $ses_id = session()->getId();
        $hps = Dummy_beli::where('session_id', $ses_id)
            ->where('supplier_id', $req->id)
            ->where('username', session('admin_username'))
            ->delete();

        $pakan = Pakan::where('supplier', $req->id)->get();
        $data = Supplier::where('id', $req->id)->first();
        $tgl_order = convert_tgl1(tgl_sekarang());

        return view('admin.order_pakan1', compact('pakan', 'data', 'tgl_order'));
    }

    public function addDummy(Request $req)
    {
        try {
            $ses_id = session()->getId();

            $data = Pakan::where('id', $req->id)->first();
            if ($data) {
                if ($req->jml > 0) {

                    $total = $data->harga_pakan * $req->jml;
                    $dt = Dummy_beli::where('supplier_id', $req->supplier_id)
                        ->where('username', session('admin_username'))
                        ->where('kode_pakan', $data->kode_pakan)->delete();

                    Dummy_beli::create([
                        'session_id' => $ses_id,
                        'kode_pakan' => $data->kode_pakan,
                        'nama_pakan' => $data->nama_pakan,
                        'supplier_id' => $req->supplier_id,
                        'username' => session('admin_username'),
                        'jml' => $req->jml,
                        'harga' => $data->harga_pakan,
                        'total' => $total,
                        'satuan' => $data->satuan_pakan,

                    ]);
                    return response()->json([
                        'status' => true,
                        'message' => 'Kode pakan ' . $data->kode_pakan . ' sukses ditambahkan',
                        'data' => $data
                    ]);
                } else {
                    $total = $data->harga_pakan * $req->jml;
                    $dt = Dummy_beli::where('supplier_id', $req->supplier_id)
                        ->where('username', session('admin_username'))
                        ->where('kode_pakan', $data->kode_pakan)->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Kode pakan ' . $data->kode_pakan . ' telah dihapus',
                        'data' => $data
                    ]);
                }
            } else {
                return
                    response()->json([
                        'status' => false,
                        'message' => 'Kode Pakan tidak terdaftar ',
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
            $user = session('admin_username');
            $supplier_id = $req->id;
            $total = Dummy_beli::where('session_id', $ses_id)
                ->where('supplier_id', $supplier_id)
                ->where('username', $user)
                ->sum('total');
            $data = Dummy_beli::where('session_id', $ses_id)
                ->where('supplier_id', $supplier_id)
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
    public function proses_order_selesai(Request $req)
    {
        try {

            DB::beginTransaction();
            $ses_id = session()->getId();
            $supplier_id = $req->supplier_id;
            $user = session('admin_username');
            //$tgl_transaksi = tgl_sekarang();

            $tgl_estimasi = convertTgl($req->tgl_estimasi, "-");
            $tgl_transaksi = convertTgl($req->tgl_transaksi, "-");
            if (empty($tgl_transaksi > tgl_sekarang())) {
                return redirect()->back()->with(['message' => 'Tanggal Order Melebihi tanggal sekarang', 'alert' => 'danger']);
            }

            if (empty($tgl_transaksi)) {
                return redirect()->back()->with(['message' => 'Tanggal Order Masih Kosong', 'alert' => 'danger']);
            }
            if (empty($tgl_estimasi)) {
                return redirect()->back()->with(['message' => 'Tanggal Estimasi Masih Kosong', 'alert' => 'danger']);
            }

            $tgl_transaksi1 = str_replace("-", "", $tgl_transaksi);
            $prefix = 'INV' . $tgl_transaksi1 . '-';
            $pref = substr($prefix, 0, 10) . "%";
            $jml_transaksi = DB::select('select count(id) as jml from h_order_pakan where no_po like ?', [$pref]);
            if ($jml_transaksi) {
                $jml_transaksi = (int)$jml_transaksi[0]->jml + 1;
            } else {
                $jml_transaksi = 0;
            }
            $nol = str_repeat("0", 5 - strlen($jml_transaksi));
            $no_transaksi = $prefix . $nol . $jml_transaksi;
            $dummy = Dummy_beli::where('session_id', $ses_id)
                ->where('supplier_id', $supplier_id)
                ->where('username', $user)->get();
            $jml_item = 0;
            foreach ($dummy as $d) {
                D_order::create([
                    'no_po' => $no_transaksi,
                    'kode_pakan' => $d->kode_pakan,
                    'jml' => $d->jml,
                    'harga' => $d->harga,
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
            H_order::create([
                'no_po' => $no_transaksi,
                'tgl_estimasi' => $tgl_estimasi,
                'tgl_po' => $tgl_transaksi,
                'supplier_id' => $supplier_id,
                'total' => $sub_total,
                'diskon' => $diskon,
                'status' => 0,
                'jml' => $jml_item,
                'grand_total' => $total,
                'cara_bayar' => $cara_bayar,
                'keterangan' => $keterangan,
                'user_input' => session('admin_username'),
                'tgl_input' => tgl_sekarang_full(),



            ]);

            $dummy = Dummy_beli::where('session_id', $ses_id)
                ->where('supplier_id', $supplier_id)
                ->where('username', $user)->delete();
            DB::commit();
            $po = H_order::where('no_po', $no_transaksi)->first();

            return redirect('/pakan/po/' . $po->id);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses Pembelian Pakan Gagal ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }
    public function po_per_tgl()
    {
        $data = Supplier::where('jenis_supplier', 'Pakan')->get();
        return view('admin.po_per_tgl', compact('data'));
    }
    public function po_per_tgl1(Request $req)
    {
        $a_tgl = explode(' to ', $req->tanggal);
        $tg1 = convertTgl($a_tgl[0], "-");
        $tg2 = convertTgl($a_tgl[1], "-");
        if ($req->nama == null) {
            $judul = "LAPORAN PEMBELIAN PAKAN KE SUPPLIER";
            $data = H_order::where('tgl_po', '>=', $tg1)->where('tgl_po', '<=', $tg2)->orderBy('id', 'asc')->get();
        } else {
            $data = H_order::where('tgl_po', '>=', $tg1)->where('tgl_po', '<=', $tg2)
                ->where('supplier_id', $req->supplier_id)->orderBy('id', 'asc')->get();
            $supplier = Supplier::where('id', $req->supplier_id)->first();
            $judul = "LAPORAN PEMBELIAN PAKAN KE " . strtoupper($supplier->nama_supplier);
        }
        $judul1 = "TANGGAL " . convert_tgl1($tg1) . " S/D " . convert_tgl1($tg2);
        return view('admin.po_per_tgl1', compact('data', 'judul', 'judul1'));
    }
    public function do_per_tgl()
    {
        $data = Supplier::where('jenis_supplier', 'Pakan')->get();
        return view('admin.do_per_tgl', compact('data'));
    }
    public function do_per_tgl1(Request $req)
    {
        $a_tgl = explode(' to ', $req->tanggal);
        $tg1 = convertTgl($a_tgl[0], "-");
        $tg2 = convertTgl($a_tgl[1], "-");
        if ($req->nama == null) {
            $judul = "LAPORAN PENERIMAAN PAKAN DARI SUPPLIER";
            $data = H_beli::where('tgl_do', '>=', $tg1)->where('tgl_po', '<=', $tg2)->orderBy('id', 'asc')->get();
        } else {

            $data = H_beli::where('tgl_do', '>=', $tg1)->where('tgl_po', '<=', $tg2)
                ->where('supplier_id', $req->supplier_id)->orderBy('id', 'asc')->get();
            $supplier = Supplier::where('id', $req->supplier_id)->first();
            $judul = "LAPORAN PENERIMAAN PAKAN DARI " . strtoupper($supplier->nama_supplier);
        }
        $judul1 = "TANGGAL " . convert_tgl1($tg1) . " S/D " . convert_tgl1($tg2);
        return view('admin.do_per_tgl1', compact('data', 'judul', 'judul1'));
    }
    public function hapus_dummy_do(Request $req)
    {
        try {
            $hps = Dummy_do::where('id', $req->id)->delete();

            if ($hps) {

                return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus ' . $e->getMessage()]);
        }
    }
    public function update_dummy_do(Request $req)
    {
        try {
            $jml = $req->jml;
            $id = $req->id;
            $hsl = DB::update('update dummy_do set jml=?, total=harga*jml where id = ?', [$jml, $id]);
            if ($hsl) {
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Data gagal diupdate']);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Data gagal diupdate ' . $e->getMessage()]);
        }
    }
    public function do_finish(Request $req)
    {
        try {
            DB::beginTransaction();
            $no_po = $req->no_po;
            $dt_order = H_order::where('no_po', $no_po)->first();
            $tgl_po = $dt_order->tgl_po;
            $supplier_id = $dt_order->supplier_id;
            $dummy = Dummy_do::where('no_po', $req->no_po)->get();
            $tgl_do = convertTgl($req->tgl_do, "-");
            if (empty($tgl_do)) {
                return redirect()->back()->with(['message' => 'Tanggal Penerimaan (DO) masih kosong  ', 'alert' => 'danger']);
            }
            $tgl_transaksi1 = str_replace("-", "", $tgl_do);
            $prefix = 'DO' . $tgl_transaksi1 . '-';
            $pref = substr($prefix, 0, 10) . "%";
            $jml_transaksi = DB::select('select count(id) as jml from h_beli_pakan where no_do like ?', [$pref]);
            if ($jml_transaksi) {
                $jml_transaksi = (int)$jml_transaksi[0]->jml + 1;
            } else {
                $jml_transaksi = 0;
            }
            $nol = str_repeat("0", 5 - strlen($jml_transaksi));
            $no_do = $prefix . $nol . $jml_transaksi;
            $jml_item = 0;
            $total = 0;
            foreach ($dummy as $d) {
                D_beli::create([
                    'no_do' => $no_do,
                    'kode_pakan' => $d->kode_pakan,
                    'jml' => $d->jml,
                    'harga' => $d->harga,
                    'total' => $d->total
                ]);
                $total = $total + $d->total;
                $upd_pakan = Pakan::where('kode_pakan', $d->kode_pakan)->first();
                $upd_pakan->stok_masuk = $upd_pakan->stok_masuk + $d->jml;
                $upd_pakan->stok = $upd_pakan->stok + $d->jml;
                $upd_pakan->total_stok = $upd_pakan->total_stok + $d->jml;
                $upd_pakan->update();
                $jml_item++;
            }
            H_beli::create([
                'no_do' => $no_do,
                'no_po' => $no_po,
                'tgl_do' => $tgl_do,
                'tgl_po' => $tgl_po,
                'jml' => $jml_item,
                'total' => $total,
                'supplier_id' => $supplier_id,
                'user_input' => session('admin_username'),
                'tgl_input' => tgl_sekarang_full()

            ]);
            $dt = DB::select('select kode_pakan,sum(a.jml) as tot  from d_beli_pakan a inner join 
            h_beli_pakan b on a.no_do=b.no_do where b.no_po = ? group by kode_pakan', [$no_po]);
            foreach ($dt as $d) {
                D_order::where('no_po', $no_po)->where('kode_pakan', $d->kode_pakan)->update([
                    'diterima' => $d->tot,
                ]);
            }
            $cek = D_order::where('no_po', $no_po)->get();
            $beres = true;
            foreach ($cek as $c) {
                if ($c->jml != $c->diterima) {
                    $beres = false;
                    break;
                }
            }
            if ($beres) {
                H_order::where('no_po', $no_po)->update([
                    'status' => 1
                ]);
            }
            DB::commit();
            $do = H_beli::where('no_do', $no_do)->first();

            return redirect('/pakan/do/' . $do->id);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses Penerimaan Pakan dari Supplier Gagal  ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }

    public function invoice_do(Request $req)
    {
        $data = H_beli::find($req->id);
        $detil = DB::select('select a.*,nama_pakan,satuan_pakan from d_beli_pakan a inner join pakan b on a.kode_pakan=b.kode_pakan where no_do = ?', [$data->no_do]);
        return view('admin.detil_do', compact('data', 'detil'));
    }
    public function invoice_po(Request $req)
    {
        $data = H_order::find($req->id);
        $detil = DB::select('select a.*,nama_pakan,satuan_pakan from d_order_pakan a inner join pakan b on a.kode_pakan=b.kode_pakan where no_po = ?', [$data->no_po]);

        return view('admin.detil_po', compact('data', 'detil'));
    }
    public function detil_po_do(Request $req)
    {

        $judul = "LAPORAN PENERIMAAN PAKAN NOMOR PO " . $req->id;
        $data = H_beli::where('no_po', '<=', $req->id)->orderBy('id', 'asc')->get();
        $judul1 = "";
        return view('admin.do_per_tgl1', compact('data', 'judul', 'judul1'));
    }
    public function detil_pakan_add(Request $req)
    {

        $sess_id = session()->getId();
        $username = session('admin_username');
        $pakan = Pakan::find($req->id);
        $kode_pakan = $pakan->kode_pakan;
        $jenis_pakan = $pakan->nama_pakan;
        $satuan = $pakan->satuan_pakan;
        $jml = $req->jml;
        $tanggal = convertTgl($req->tanggal, "-");
        if ($tanggal > tgl_sekarang()) {
            return response()->json(['status' => false, 'message' => 'Tanggal melebihi tanggal hari ini', 'alert' => 'danger']);
        }
        Dummy_pakan::where('session_id', $sess_id)
            ->where('username', $username)
            ->where('kode_pakan', $kode_pakan)->delete();

        if ($jml > 0) {

            Dummy_pakan::create([
                'session_id' => $sess_id,
                'username' => $username,
                'kode_pakan' => $kode_pakan,
                'jenis_pakan' => $jenis_pakan,
                'satuan' => $satuan,
                'jml' => $jml
            ]);
        }
        $data = Dummy_pakan::where('session_id', $sess_id)
            ->where('username', $username)->get();
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function proses_pemberian_pakan(Request $req)
    {
        try {
            DB::beginTransaction();
            $req->validate([
                'kandang' => 'required',
                'tanggal' => 'required',
                'total_berat_domba' => 'required',
                'jadwal' => 'required',
                'total_pakan' => 'required'
            ]);
            $tanggal = convertTgl($req->tanggal, "-");
            if ($tanggal > tgl_sekarang()) {
                return redirect()->back()->with(['message' => 'Tanggal tidak boleh melebihi hari ini', 'alert' => 'danger']);
            }
            if (strtolower($req->jadwal) == "pagi") {
                $j = 1;
            }

            if (strtolower($req->jadwal) == "siang") {
                $j = 2;
            }

            if (strtolower($req->jadwal) == "sore") {
                $j = 3;
            }
            $tgl_transaksi = str_replace("-", "", $req->tanggal);
            $prefix =  "P$tgl_transaksi-$j-";

            $pref = substr($prefix, 0, 12) . "%";
            $jml_transaksi = DB::select('select count(id) as jml from pemberian_pakan where no_transaksi like ?', [$pref]);
            if ($jml_transaksi) {
                $jml_transaksi = (int)$jml_transaksi[0]->jml + 1;
            } else {
                $jml_transaksi = 0;
            }
            $nol = str_repeat("0", 5 - strlen($jml_transaksi));
            $no_transaksi = $prefix . $nol . $jml_transaksi;

            $ses_id = session()->getId();
            $username = session('admin_username');


            $detil_pakan = "";
            $dummy_pakan = Dummy_pakan::where('session_id', $ses_id)->where('username', $username)->get();
            if ($dummy_pakan) {
                foreach ($dummy_pakan as $dp) {
                    PemberianPakanDetil::create([
                        'no_transaksi' => $no_transaksi,
                        'kode_pakan' => $dp->kode_pakan,
                        'jenis_pakan' => $dp->jenis_pakan,
                        'satuan' => $dp->satuan,
                        'jml' => $dp->jml

                    ]);
                    $pakan = Pakan::where('kode_pakan', $dp->kode_pakan)->first();
                    $pakan->stok_keluar = $pakan->stok_keluar + $dp->jml;
                    $pakan->stok = $pakan->stok - $dp->jml;

                    $pakan->update();
                    $detil_pakan .= $dp->jenis_pakan . " : " . $dp->jml . " " . $dp->satuan . "<br>";
                }
            }
            PemberianPakan::create([
                'no_transaksi' => $no_transaksi,
                'tanggal' => $tanggal,
                'kandang' => $req->kandang,
                'total_berat_domba' => $req->total_berat_domba,
                'jadwal' => $req->jadwal,
                'total_pakan' => $req->total_pakan,
                'satuan' => $req->satuan,
                'user_input' => $username,
                'tgl_input' => tgl_sekarang_full(),
                'detil_pakan' => $detil_pakan,


            ]);
            DB::commit();
            return redirect()->back()->with(['message' => 'Proses Pemberian Pakan sukses', 'alert' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Proses Pemberian Pakan gagal' . $e->getMessage(), 'alert' => 'danger']);
        }
    }
    public function delete_pemberian_pakan(Request $req)
    {
        try {

            $id = $req->id;
            $data = PemberianPakan::find($id);
            PemberianPakan::where('no_transaksi', $data->no_transaksi)->delete();
            PemberianPakanDetil::where('no_transaksi', $data->no_transaksi)->delete();
            return redirect()->back()->with(['message' => 'Proses penghapusan pemberian pakan sukses ', 'alert' => 'danger']);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => 'Proses penghapusan pemberian pakan gagal ' . $e->getMessage(), 'alert' => 'danger']);
        }
    }

    public function stok_incoming(Request $req)
    {
        $id = $req->id;
        $data = DB::select('select b.id,a.no_po,a.jml,a.diterima,b.tgl_po,b.tgl_estimasi,b.supplier_id from d_order_pakan a inner join h_order_pakan b on a.no_po=b.no_po where kode_pakan=? and a.jml>diterima', [$id]);
        $pakan = Pakan::where('kode_pakan', $id)->first();
        return view('admin.incoming', compact('data', 'pakan'));
    }
}
