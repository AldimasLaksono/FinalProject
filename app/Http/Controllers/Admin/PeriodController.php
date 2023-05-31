<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Period;
use App\Models\Log;

class PeriodController extends Controller
{
    public function show_period()
    {
        $period = Period::all();

        foreach ($period as $item) {
            $item->status_label = ($item->status_mp == 1) ? 'Active' : 'Non-Active';
        }

        return view('Data_Akademik.data_period', compact('period'));
    }

    public function input_period(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'name_mper' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $period = new Period();
        $period->name_mper = $request->input('name_mper');
        $period->status_mp = $request->input('status_mp', '1');
        $period->save();

        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Tambah data period',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_period');
    }

    public function delete_period($id_mper)
    {
        $period = Period::find($id_mper);

        if (!$period) {
            return redirect()->route('show_period')->with('error', 'Data tidak ditemukan.');
        }

        $period->delete();

        return redirect()->route('show_period')->with('success', 'Data berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id_mper)
    {
        $period = Period::find($id_mper);

        if (!$period) {
            return response()->json(['message' => 'Periode tidak ditemukan'], 404);
        }

        $newStatus = $request->input('status_mp', 0);

        $period->status_mp = $newStatus;
        $period->save();

        if ($request->has('cancelButton')) {
            session()->flash('cancelMessage', 'Pembaruan data dibatalkan');
        } else {
            session()->flash('success', 'Data siswa berhasil diperbarui');
        }

        return redirect()->route('show_period');
    }
}
