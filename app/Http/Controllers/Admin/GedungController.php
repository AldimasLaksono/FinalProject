<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\WEB\Gedung;
use App\Models\WEB\Log;

class GedungController extends Controller
{
    public function show_gedung(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $gedung = Gedung::all();

        return view('Data_Ruangan.gedung', compact('gedung'), ['data' => $data]);
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

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Ruang',
            'action' => 'Tambah Gedung',
            'useraccess' => $user->name_mut
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data Gedung berhasil ditambahkan');
        return redirect()->route('show_gedung');
    }

    public function delete_gedung(Request $request, $id_mg)
    {
        $gedung = Gedung::find($id_mg);

        if (!$gedung) {
            return redirect()->route('show_gedung')->with('error', 'Data tidak ditemukan.');
        }

        $gedung->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Ruang',
            'action' => 'Delete Gedung',
            'useraccess' => $user->name_mut
        ]);

        return redirect()->route('show_gedung')->with('success', 'Data berhasil dihapus.');
    }
}
