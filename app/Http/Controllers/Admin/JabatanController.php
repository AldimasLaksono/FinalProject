<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\WEB\Jabatan;
use App\Models\Log;

class JabatanController extends Controller
{
    public function show_datajbt(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $datajbt = Jabatan::all();

        return view('Data_Guru.tabel_jabatan', compact('datajbt'), ['data' => $data]);
    }

    public function input_datajbt(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'name_mja' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $jbt = new Jabatan();
        $jbt->name_mja = $request->input('name_mja');
        $jbt->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Tambah data jabatan',
            'useraccess' => $user->name_mut
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_datajbt');
    }

    public function delete_datajbt(Request $request, $id_mja)
    {
        $jbt = Jabatan::find($id_mja);

        if (!$jbt) {
            return redirect()->route('show_datajbt')->with('error', 'Data tidak ditemukan.');
        }

        $jbt->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Delete jabatan',
            'useraccess' => $user->name_mut
        ]);

        return redirect()->route('show_datajbt')->with('success', 'Data berhasil dihapus.');
    }
}
