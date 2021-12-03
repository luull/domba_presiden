<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Investor;
use App\City;
use App\Province;
use App\Bank;
use Illuminate\Http\Request;

class investorController extends Controller
{

    public function index()
    {
        $data = Investor::get();
        $province = Province::get();
        $city = City::get();
        $bank = Bank::get();
        return view('admin.investor', compact('data','province','city','bank'));
    }
    public function create(Request $request)
    {
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

            $hsl = Investor::create([
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
    }
    public function delete(Request $req)
    {

        $hsl = Investor::find($req->id)->delete();
        if ($hsl) {
            return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert' => 'success']);
        } else {
            return redirect()->back()->with(['message' => 'Data gagal dihapus', 'alert' => 'danger']);
        }
    }
}
