<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Log;
use App\Models\User;

class SiswaController extends Controller
{
    public function show_data()
    {
        $userStudent = User::leftJoin('tb_t_class', 'users.id_tc', '=', 'tb_t_class.id_tc')
            ->select('users.*', 'tb_t_class.*')
            ->get();
            
        return view('Data_Siswa.show_siswa', compact('userStudent'));
    }

    public function inputform()
    {
        return view('Data_Siswa.input_data');
    }

    public function inputData(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'nis' => 'required|numeric|unique:users',
            'id_tc' => 'required|numeric|exists:tb_t_class,id_tc',
            'name_mus' => 'required',
            'ttl_mus' => 'required',
            'gender_mus' => 'required',
            'alamat_mus' => 'required',
            'notelp_mus' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'status_mus' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $siswa = new User();
        $siswa->nis = $request->input('nis');
        $siswa->id_tc = $request->input('id_tc');
        $siswa->name_mus = $request->input('name_mus');
        $siswa->ttl_mus = $request->input('ttl_mus');
        $siswa->gender_mus = $request->input('gender_mus');
        $siswa->alamat_mus = $request->input('alamat_mus');
        $siswa->notelp_mus = $request->input('notelp_mus');
        $siswa->email = $request->input('email');
        $siswa->password = $request->input('password');
        $siswa->status_mus = $request->input('status_mus');
        $siswa->save();

        Log::create([
            'module' => 'Data_Student',
            'action' => 'Tambah data user siswa',
            'useraccess' => 'Administrator'
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('input_data');
    }

    public function updateform($id_mus)
    {
        $userStudent = DB::table('users')
            ->where('id_mus', $id_mus)
            ->first();

        $password = $userStudent->password ? decrypt($userStudent->password) : null;

        return view('Data_Siswa.update_siswa', compact('userStudent', 'password'));
    }

    public function updateData(Request $request, $id_mus)
    {
        $userStudent = User::find($id_mus);
        $userStudent->nis = $request->input('nis');
        $userStudent->id_tc = $request->input('id_tc');
        $userStudent->name_mus = $request->input('name_mus');
        $userStudent->ttl_mus = $request->input('ttl_mus');
        $userStudent->gender_mus = $request->input('gender_mus');
        $userStudent->alamat_mus = $request->input('alamat_mus');
        $userStudent->notelp_mus = $request->input('notelp_mus');
        $userStudent->email = $request->input('email');
        $userStudent->password = $request->input('password');
        $userStudent->status_mus = $request->input('status_mus');
        // Update kolom-kolom lain sesuai kebutuhan

        $userStudent->save();

        Log::create([
            'module' => 'Data_Student',
            'action' => 'Update data user siswa',
            'useraccess' => 'Administrator'
        ]);

        // session()->flash('success', 'Data siswa berhasil diperbarui');

        // return redirect()->route('data_siswa');
        if ($request->has('cancelButton')) {
            session()->flash('cancelMessage', 'Pembaruan data dibatalkan');
        } else {
            session()->flash('success', 'Data siswa berhasil diperbarui');
        }

        return redirect()->route('data_siswa');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        $rows = (new FastExcel)->import($file);

        foreach ($rows as $row) {
            User::create([
                'nis' => $row['nis'],
                'id_tc' => $row['id_tc'],
                'name_mus' => $row['name_mus'],
                'ttl_mus' => $row['ttl_mus'],
                'gender_mus' => $row['gender_mus'],
                'alamat_mus' => $row['alamat_mus'],
                'notelp_mus' => $row['notelp_mus'],
                'email' => $row['email'],
                'password' => $row['password'],
                'status_mus' => $row['status_mus'],
            ]);
        }

        Log::create([
            'module' => 'Data_Student',
            'action' => 'Import data user siswa',
            'useraccess' => 'Administrator'
        ]);

        session()->flash('success', 'Data berhasil diimpor dari file Excel.');
        return redirect()->back();
    }

    public function deleteData($id_mus)
    {
        $userStudent = User::find($id_mus);

        if (!$userStudent) {
            return redirect()->route('data_siswa')->with('error', 'Data tidak ditemukan.');
        }

        $userStudent->delete();

        return redirect()->route('data_siswa')->with('success', 'Data berhasil dihapus.');
    }
}
