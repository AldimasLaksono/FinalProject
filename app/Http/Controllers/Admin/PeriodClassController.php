<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\WEB\PeriodClass;
use App\Models\Log;

class PeriodClassController extends Controller
{
    public function show_perclass(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $perclass = DB::table('tb_t_period_class')
        ->join('tb_m_period', 'tb_t_period_class.id_mper', '=', 'tb_m_period.id_mper')
        ->select(
            'tb_m_period.*',
            'tb_t_period_class.*')
        ->get();

        return view('Data_Akademik.period_class', compact('perclass'), ['data' => $data]);
    }

    public function input_perclass(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'id_mper' => 'required|exists:tb_m_period,id_mper|numeric',
            'name_tpc' => 'required',
            'description_tpc' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $perclass = new PeriodClass();
        $perclass->id_mper = $request->input('id_mper');
        $perclass->name_tpc = $request->input('name_tpc');
        $perclass->description_tpc = $request->input('description_tpc');
        $perclass->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Tambah data Ploting Class Period',
            'useraccess' => $user->name_mut
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_perclass');
    }

    public function updateform_perclass(Request $request, $id_tpc)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $perclass = DB::table('tb_t_period_class')
            ->where('id_tpc', $id_tpc)
            ->first();

        return view('Data_Akademik.update_period_class', compact('perclass'), ['data' => $data]);
    }

    public function updateData_perclass(Request $request, $id_tpc)
    {
        $perclass = PeriodClass::find($id_tpc);
        $perclass->id_mper = $request->input('id_mper');
        $perclass->name_tpc = $request->input('name_tpc');
        $perclass->description_tpc = $request->input('description_tpc');

        $perclass->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Update data Ploting Class Period',
            'useraccess' => $user->name_mut
        ]);

        // session()->flash('success', 'Data siswa berhasil diperbarui');

        // return redirect()->route('data_siswa');
        if ($request->has('cancelButton')) {
            session()->flash('cancelMessage', 'Pembaruan data dibatalkan');
        } else {
            session()->flash('success', 'Data siswa berhasil diperbarui');
        }

        return redirect()->route('show_perclass');
    }

    public function delete_perclass(Request $request, $id_tpc)
    {
        $perclass = PeriodClass::find($id_tpc);

        if (!$perclass) {
            return redirect()->route('show_perclass')->with('error', 'Data tidak ditemukan.');
        }

        $perclass->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Delete data Ploting Class Period',
            'useraccess' => $user->name_mut
        ]);

        return redirect()->route('show_perclass')->with('success', 'Data berhasil dihapus.');
    }
}
