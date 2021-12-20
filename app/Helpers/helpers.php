<?PHP

use App\Penimbangan;

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

function tglsekarang()
{
    $tglskr = hari(date('N')) . " " . date('d') . "-" . bulan((int)date('m')) . "-" . date('Y');
    return $tglskr;
}
