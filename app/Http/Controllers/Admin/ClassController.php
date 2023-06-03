<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\WEB\TClass;
use App\Models\WEB\Log;

class ClassController extends Controller
{
    public function show_class(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $class = DB::table('tb_t_class')
        ->join('tb_t_period_class', 'tb_t_class.id_tpc', '=', 'tb_t_period_class.id_tpc')
        ->join('tb_m_ruang', 'tb_t_class.id_mr', '=', 'tb_m_ruang.id_mr')
        ->select(
            'tb_t_class.*',
            'tb_t_period_class.*',
            'tb_m_ruang.*')
        ->get();

        return view('Data_Akademik.class', compact('class'), ['data' => $data]);
    }

    public function input_class(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'id_tpc' => 'required|exists:tb_t_period_class,id_tpc|numeric',
            'id_mr' => 'required|exists:tb_m_ruang,id_mr|numeric',
            'name_tc' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $class = new TClass();
        $class->id_tpc = $request->input('id_tpc');
        $class->id_mr = $request->input('id_mr');
        $class->name_tc = $request->input('name_tc');
        $class->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Tambah Data Ploting Class',
            'useraccess' => $user->name_mut
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_class');
    }

    public function updateform_class(Request $request, $id_tc)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $class = DB::table('tb_t_class')
            ->where('id_tc', $id_tc)
            ->first();

        return view('Data_Akademik.update_class', compact('class'), ['data' => $data]);
    }

    public function updateData_class(Request $request, $id_tc)
    {
        $class = TClass::find($id_tc);
        $class->id_tpc = $request->input('id_tpc');
        $class->id_mr = $request->input('id_mr');
        $class->name_tc = $request->input('name_tc');

        $class->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Update Data Ploting Class',
            'useraccess' => $user->name_mut
        ]);

        // session()->flash('success', 'Data siswa berhasil diperbarui');

        // return redirect()->route('data_siswa');
        if ($request->has('cancelButton')) {
            session()->flash('cancelMessage', 'Pembaruan data dibatalkan');
        } else {
            session()->flash('success', 'Data siswa berhasil diperbarui');
        }

        return redirect()->route('show_class');
    }

    public function delete_class(Request $request, $id_tc)
    {
        $class = TClass::find($id_tc);

        if (!$class) {
            return redirect()->route('show_class')->with('error', 'Data tidak ditemukan.');
        }

        $class->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Delete Data Ploting Class',
            'useraccess' => $user->name_mut
        ]);

        return redirect()->route('show_class')->with('success', 'Data berhasil dihapus.');
    }
}
