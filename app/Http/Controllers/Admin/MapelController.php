<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Mapel;
use App\Models\Log;

class MapelController extends Controller
{
    public function show_datamm()
    {
        $datamm = Mapel::all();

        return view('Data_Akademik.data_mapel', compact('datamm'));
    }

    public function input_datamm(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'name_mm' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $mapel = new Mapel();
        $mapel->name_mm = $request->input('name_mm');
        $mapel->save();

        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Tambah data mapel',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_datamm');
    }

    public function delete_datamm($id_mm)
    {
        $mapel = Mapel::find($id_mm);

        if (!$mapel) {
            return redirect()->route('show_datamm')->with('error', 'Data tidak ditemukan.');
        }

        $mapel->delete();

        return redirect()->route('show_datamm')->with('success', 'Data berhasil dihapus.');
    }
}
