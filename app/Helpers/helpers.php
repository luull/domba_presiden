<?PHP

use App\Customer;
use App\Penimbangan;
use App\Investor;
use App\Supplier;
use Illuminate\Support\Facades\DB;

function get_customer_name($id)
{
    $hasil = Customer::where('id', $id)->first();
    if ($hasil) {
        $nama = $hasil->nama;
    } else {
        $nama = "";
    }
    return $nama;
}
function get_supplier_name($id)
{
    $hasil = Supplier::find($id);
    if ($hasil) {
        $nama = $hasil->nama_supplier;
    } else {
        $nama = "";
    }
    return $nama;
}
function get_investor_name($id)
{
    $hasil = Investor::find($id);
    if ($hasil) {
        $nama = $hasil->nama;
    } else {
        $nama = "";
    }
    return $nama;
}
function status_domba($id)
{
    $status = array('Available', 'Booked', 'Sold');
    return $status[$id];
}
function berat_akhir($id, $ba)
{
    $berat = $ba;
    $dt = Penimbangan::where('no_regis', $id)->orderBy('tgl_timbang', 'desc')->first();

    if ($dt == null) {
        $berat = $ba;
    } else {
        $berat = $dt->berat_timbang;
    }
    return $berat;
}
function get_customer($id)
{
    dd($id);
    $dt = Customer::where('id', $id)->first();

    return $dt->nama;
}
function only_month($tgl)
{
    $bln = substr($tgl, 5, 2);
    $bulan = array(
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
        "Agustus", "September", "Oktober", "Nopember", "Desember"
    );
    $sekarang = $bulan[(int)($bln) - 1];
    return $sekarang;
}
function only_day($tgl)
{
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum`at", "Sabtu");
    $thn = substr($tgl, 0, 4);
    $bln = substr($tgl, 5, 2);
    $tg = substr($tgl, 8, 2);

    $hr = date("w", mktime(0, 0, 0, $bln, $tg, $thn));
    $sekarang = $hari[$hr];
    return $sekarang;
}
function only_date($tgl)
{
    $tg = substr($tgl, 8, 2);
    $sekarang = $tg;
    return $sekarang;
}
function only_years($tgl)
{
    $thn = substr($tgl, 0, 4);
    $sekarang = $thn;
    return $sekarang;
}
function convertTgl($tgl, $tanda)
{
    $a_tgl = explode($tanda, $tgl);
    $tanggal = $a_tgl[2] . "-" . $a_tgl[1] . "-" . $a_tgl[0];
    return $tanggal;
}
function convert_tgl($tgl)
{
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum`at", "Sabtu");
    $thn = substr($tgl, 0, 4);
    $bln = substr($tgl, 5, 2);
    $tg = substr($tgl, 8, 2);
    $jam = substr($tgl, 11, 8);
    $hr = date("w", mktime(0, 0, 0, $bln, $tg, $thn));
    $bulan = array(
        "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
        "Agustus", "September", "Oktober", "Nopember", "Desember"
    );
    $sekarang = $hari[$hr] . ", " . $tg . " " . $bulan[(int)($bln) - 1] . " " . $thn . " " . $jam;
    return $sekarang;
}

function convert_tgl1($tgl)
{
    $thn = substr($tgl, 0, 4);
    $bln = substr($tgl, 5, 2);
    $tg = substr($tgl, 8, 2);
    $jam = substr($tgl, 11, 8);
    $hr = date("w", mktime(0, 0, 0, $bln, $tg, $thn));
    $sekarang = $tg . "-" . $bln . "-" . $thn;
    return $sekarang;
}

function convert_tgl2($tgl)
{
    $arr_tg = explode(" ", $tgl);
    $arr_tg1 = explode("-", $arr_tg[0]);
    $thn = $arr_tg1[0];
    $bln = $arr_tg1[1];
    $tg = $arr_tg1[2];
    $jam = $arr_tg[1];
    $hr = date("w");
    $sekarang = hari($hr) . ", " . $tg . "-" . $bln . "-" . $thn . " " . $jam;
    return $sekarang;
}

function hari($hr)
{
    $array_hari = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jum`at", "Sabtu", "Minggu");
    return $array_hari[$hr];
}

function bulan($bl)
{
    $bl = (int) $bl;
    $array_bulan = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
    return $array_bulan[$bl];
}
function bulan1($bl)
{
    $bl = (int) $bl;
    $array_bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    return $array_bulan[$bl];
}


function tgl_sekarang()
{
    $t1 = DB::select("select  curdate() as tgl");
    $tgl_skrg = $t1[0]->tgl;
    return $tgl_skrg;
}
function tgl_sekarang_full()
{
    $t1 = DB::select("select  now() as tgl");
    $tgl_skrg = $t1[0]->tgl;
    //$tgl_skrg = Carbon::now()->format('Y-m-d h:i:s');
    return $tgl_skrg;
}
function tgl_invoice()
{
    $t1 = DB::select("select  curdate() as tgl");
    //$tgl = Carbon::now()->format('Y-m-d');
    $tgl = $tgl_skrg = $t1[0]->tgl;
    $tgl_skrg = str_replace("-", "", $tgl);
    return $tgl_skrg;
}
function pemilik($id)
{
    $pemilik = "PDP";
    $investor = Investor::where('id', $id)->get();
    if (count($investor) > 0) {
        $pemilik = $investor[0]->nama;
    }
    return $pemilik;
}
