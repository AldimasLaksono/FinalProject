<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Gedung;
use App\Models\Log;

class GedungController extends Controller
{
    public function show_gedung()
    {
        $gedung = Gedung::all();

        return view('Data_Ruangan.gedung', compact('gedung'));
    }

    public function input_gedung(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'name_mg' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $gedung = new Gedung();
        $gedung->name_mg = $request->input('name_mg');
        $gedung->save();

        Log::create([
            'module' => 'Data_Ruang',
            'action' => 'Tambah Gedung',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data Gedung berhasil ditambahkan');
        return redirect()->route('show_gedung');
    }

    public function delete_gedung($id_mg)
    {
        $gedung = Gedung::find($id_mg);

        if (!$gedung) {
            return redirect()->route('show_gedung')->with('error', 'Data tidak ditemukan.');
        }

        $gedung->delete();

        return redirect()->route('show_gedung')->with('success', 'Data berhasil dihapus.');
    }
}
