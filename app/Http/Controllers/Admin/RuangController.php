<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Gedung;
use App\Models\Ruang;
use App\Models\Log;

class RuangController extends Controller
{
    public function show_ruang()
    {

        $ruang = DB::table('tb_m_ruang')
        ->join('tb_m_gedung', 'tb_m_ruang.id_mg', '=', 'tb_m_gedung.id_mg')
        ->select(
            'tb_m_ruang.*',
            'tb_m_gedung.*')
        ->get();

        return view('Data_Ruangan.ruang', compact('ruang'));
    }

    public function input_ruang(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'id_mg' => 'required|exists:tb_m_gedung,id_mg|numeric',
            'name_mr' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $ruang = new Ruang();
        $ruang->id_mg = $request->input('id_mg');
        $ruang->name_mr = $request->input('name_mr');
        $ruang->save();

        Log::create([
            'module' => 'Data_Ruang',
            'action' => 'Tambah Ruangan',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data Ruang berhasil ditambahkan');
        return redirect()->route('show_ruang');
    }

    public function delete_ruang($id_mr)
    {
        $ruang = Ruang::find($id_mr);

        if (!$ruang) {
            return redirect()->route('show_ruang')->with('error', 'Data tidak ditemukan.');
        }

        $ruang->delete();

        return redirect()->route('show_ruang')->with('success', 'Data berhasil dihapus.');
    }
}
