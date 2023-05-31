<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\PeriodClass;
use App\Models\Log;

class PeriodClassController extends Controller
{
    public function show_perclass()
    {
        $perclass = DB::table('tb_t_period_class')
        ->join('tb_m_period', 'tb_t_period_class.id_mper', '=', 'tb_m_period.id_mper')
        ->select(
            'tb_m_period.*',
            'tb_t_period_class.*')
        ->get();

        return view('Data_Akademik.period_class', compact('perclass'));
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

        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Tambah data Ploting Class Period',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('show_perclass');
    }

    public function updateform_perclass($id_tpc)
    {
        $perclass = DB::table('tb_t_period_class')
            ->where('id_tpc', $id_tpc)
            ->first();

        return view('Data_Akademik.update_period_class', compact('perclass'));
    }

    public function updateData_perclass(Request $request, $id_tpc)
    {
        $perclass = PeriodClass::find($id_tpc);
        $perclass->id_mper = $request->input('id_mper');
        $perclass->name_tpc = $request->input('name_tpc');
        $perclass->description_tpc = $request->input('description_tpc');

        $perclass->save();

        Log::create([
            'module' => 'Data_Akademik',
            'action' => 'Update data Ploting Class Period',
            'useraccess' => 'Administrator'
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

    public function delete_perclass($id_tpc)
    {
        $perclass = PeriodClass::find($id_tpc);

        if (!$perclass) {
            return redirect()->route('show_perclass')->with('error', 'Data tidak ditemukan.');
        }

        $perclass->delete();

        return redirect()->route('show_perclass')->with('success', 'Data berhasil dihapus.');
    }
}
