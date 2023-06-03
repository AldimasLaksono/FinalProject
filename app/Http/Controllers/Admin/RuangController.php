<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\WEB\Gedung;
use App\Models\WEB\Ruang;
use App\Models\Log;

class RuangController extends Controller
{
    public function show_ruang(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $ruang = DB::table('tb_m_ruang')
        ->join('tb_m_gedung', 'tb_m_ruang.id_mg', '=', 'tb_m_gedung.id_mg')
        ->select(
            'tb_m_ruang.*',
            'tb_m_gedung.*')
        ->get();

        return view('Data_Ruangan.ruang', compact('ruang'), ['data' => $data]);
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

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Ruang',
            'action' => 'Tambah Ruangan',
            'useraccess' => $user->name_mut
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data Ruang berhasil ditambahkan');
        return redirect()->route('show_ruang');
    }

    public function delete_ruang(Request $request, $id_mr)
    {
        $ruang = Ruang::find($id_mr);

        if (!$ruang) {
            return redirect()->route('show_ruang')->with('error', 'Data tidak ditemukan.');
        }

        $ruang->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Ruang',
            'action' => 'Delete Ruangan',
            'useraccess' => $user->name_mut
        ]);

        return redirect()->route('show_ruang')->with('success', 'Data berhasil dihapus.');
    }
}
