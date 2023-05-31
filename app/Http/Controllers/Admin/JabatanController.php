<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Jabatan;
use App\Models\Log;

class JabatanController extends Controller
{
    public function show_datajbt()
    {
        $datajbt = Jabatan::all();

        return view('Data_Guru.tabel_jabatan', compact('datajbt'));
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

        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Tambah data jabatan',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_datajbt');
    }

    public function delete_datajbt($id_mja)
    {
        $jbt = Jabatan::find($id_mja);

        if (!$jbt) {
            return redirect()->route('show_datajbt')->with('error', 'Data tidak ditemukan.');
        }

        $jbt->delete();

        return redirect()->route('show_datajbt')->with('success', 'Data berhasil dihapus.');
    }
}
