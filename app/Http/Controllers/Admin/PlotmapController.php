<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Plotmap;
use App\Models\Log;

class PlotmapController extends Controller
{
    public function show_datatm()
    {
        $datatm = DB::table('tb_t_mapel')
        ->join('tb_t_period_class', 'tb_t_mapel.id_tpc', '=', 'tb_t_period_class.id_tpc')
        ->join('tb_m_mapel', 'tb_t_mapel.id_mm', '=', 'tb_m_mapel.id_mm')
        ->join('tb_m_user_teacher', 'tb_t_mapel.id_mut', '=', 'tb_m_user_teacher.id_mut')
        ->select(
            'tb_t_mapel.*',
            'tb_t_period_class.*',
            'tb_m_mapel.*',
            'tb_m_user_teacher.*')
        ->get();

        return view('Data_Akademik.ploting_mapel', compact('datatm'));
    }

    public function input_datatm(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'id_tpc' => 'required|exists:tb_t_period_class,id_tpc|numeric',
            'id_mm' => 'required|exists:tb_m_mapel,id_mm|numeric',
            'id_mut' => 'required|exists:tb_m_user_teacher,id_mut|numeric',
            'kode_mm_tm' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $plotmap = new Plotmap();
        $plotmap->id_tpc = $request->input('id_tpc');
        $plotmap->id_mm = $request->input('id_mm');
        $plotmap->id_mut = $request->input('id_mut');
        $plotmap->kode_mm_tm = $request->input('kode_mm_tm');
        $plotmap->save();

        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Tambah data Ploting mapel',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_datatm');
    }

    public function updateform_plotmap($id_tm)
    {
        $datatm = DB::table('tb_t_mapel')
            ->where('id_tm', $id_tm)
            ->first();

        return view('Data_Akademik.update_ploting_mapel', compact('datatm'));
    }

    public function updateData_plotmap(Request $request, $id_tm)
    {
        $datatm = Plotmap::find($id_tm);
        $datatm->id_tpc = $request->input('id_tpc');
        $datatm->id_mm = $request->input('id_mm');
        $datatm->id_mut = $request->input('id_mut');
        $datatm->kode_mm_tm = $request->input('kode_mm_tm');

        $datatm->save();

        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Update data ploting mapel',
            'useraccess' => 'Administrator'
        ]);

        // session()->flash('success', 'Data siswa berhasil diperbarui');

        // return redirect()->route('data_siswa');
        if ($request->has('cancelButton')) {
            session()->flash('cancelMessage', 'Pembaruan data dibatalkan');
        } else {
            session()->flash('success', 'Data siswa berhasil diperbarui');
        }

        return redirect()->route('show_datatm');
    }

    public function delete_datatm($id_tm)
    {
        $datatm = Plotmap::find($id_tm);

        if (!$datatm) {
            return redirect()->route('show_datatm')->with('error', 'Data tidak ditemukan.');
        }

        $datatm->delete();

        return redirect()->route('show_datatm')->with('success', 'Data berhasil dihapus.');
    }
}
