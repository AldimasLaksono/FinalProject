<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Log;
use App\Models\WEB\User_Guru;
use App\Models\tb_m_jabatan;

class GuruController extends Controller
{
    public function inputform(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];
        
        return view('Data_Guru.input_guru', ['data' => $data]);
    }

    public function inputData(Request $request)
    {
        // Validasi input data siswa
        $validator = Validator::make($request->all(), [
            'id_mja' => 'required|exists:tb_m_jabatan,id_mja|numeric',
            'nip' => 'required|numeric|unique:tb_m_user_teacher',
            'name_mut' => 'required',
            'ttl_mut' => 'required',
            'gender_mut' => 'required',
            'alamat_mut' => 'required',
            'notelp_mut' => 'required|numeric',
            'email' => 'required|email|unique:tb_m_user_teacher',
            'status_mut' => 'required',
            'role_mut' => 'required',
            'password' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // // Jika validasi berhasil, simpan data siswa ke database
        $guru = new User_Guru();
        $guru->id_mja = $request->input('id_mja');
        $guru->nip = $request->input('nip');
        $guru->name_mut = $request->input('name_mut');
        $guru->ttl_mut = $request->input('ttl_mut');
        $guru->gender_mut = $request->input('gender_mut');
        $guru->alamat_mut = $request->input('alamat_mut');
        $guru->notelp_mut = $request->input('notelp_mut');
        $guru->email = $request->input('email');
        $guru->status_mut = $request->input('status_mut');
        $guru->role_mut = $request->input('role_mut');
        $guru->password = $request->input('password');
        $guru->status = $request->input('status');
        $guru->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Tambah data user guru',
            'useraccess' => $user->name_mut
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        //return redirect()->route('input_data')->with('success', 'Data siswa berhasil ditambahkan.');
        session()->flash('success', 'Data guru berhasil ditambahkan');
        return redirect()->route('formGuru');
    }

    public function importGuru(Request $request)
    {
        $file = $request->file('file');

        $rows = (new FastExcel)->import($file);

        foreach ($rows as $row) {
            User_Guru::create([
                'id_mja' => $row['id_mja'],
                'nip' => $row['nip'],
                'name_mut' => $row['name_mut'],
                'ttl_mut' => $row['ttl_mut'],
                'gender_mut' => $row['gender_mut'],
                'alamat_mut' => $row['alamat_mut'],
                'notelp_mut' => $row['notelp_mut'],
                'email' => $row['email'],
                'status_mut' => $row['status_mut'],
                'role_mut' => $row['role_mut'],
                'password' => $row['password'],
                'status' => $row['status'],
            ]);
        }

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Import data user guru',
            'useraccess' => $user->name_mut
        ]);

        session()->flash('success', 'Data berhasil diimpor dari file Excel.');
        return redirect()->back();
    }

    public function show_guru(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $userTeacher = User_Guru::leftJoin('tb_m_jabatan', 'tb_m_user_teacher.id_mja', '=', 'tb_m_jabatan.id_mja')
            ->select('tb_m_user_teacher.*', 'tb_m_jabatan.name_mja')
            ->get();
        return view('Data_Guru.show_guru', compact('userTeacher'), ['data' => $data]);
    }

    public function updateform_guru(Request $request, $id_mut)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $userTeacher = DB::table('tb_m_user_teacher')
            ->where('id_mut', $id_mut)
            ->first();

        $decryptedPassword = $userTeacher->password ? Crypt::decryptString($userTeacher->password) : null;

        $userTeacher->password = $decryptedPassword;

        return view('Data_Guru.update_guru', compact('userTeacher'), ['data' => $data]);
    }

    public function updateData_guru(Request $request, $id_mut)
    {
        $userTeacher = User_Guru::find($id_mut);
        $userTeacher->id_mja = $request->input('id_mja');
        $userTeacher->nip = $request->input('nip');
        $userTeacher->name_mut = $request->input('name_mut');
        $userTeacher->ttl_mut = $request->input('ttl_mut');
        $userTeacher->gender_mut = $request->input('gender_mut');
        $userTeacher->alamat_mut = $request->input('alamat_mut');
        $userTeacher->notelp_mut = $request->input('notelp_mut');
        $userTeacher->email = $request->input('email');
        $userTeacher->status_mut = $request->input('status_mut');
        $userTeacher->role_mut = $request->input('role_mut');
        $userTeacher->password = $request->input('password');
        $userTeacher->status = $request->input('status');
        // Update kolom-kolom lain sesuai kebutuhan

        $userTeacher->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Update data user guru',
            'useraccess' => $user->name_mut
        ]);

        // session()->flash('success', 'Data siswa berhasil diperbarui');

        // return redirect()->route('data_siswa');
        if ($request->has('cancelButton')) {
            session()->flash('cancelMessage', 'Pembaruan data dibatalkan');
        } else {
            session()->flash('success', 'Data berhasil diperbarui');
        }

        return redirect()->route('data_guru');
    }

    public function deleteData_guru(Request $request, $id_mut)
    {
        $userTeacher = User_Guru::find($id_mut);

        if (!$userTeacher) {
            return redirect()->route('data_guru')->with('error', 'Data tidak ditemukan.');
        }

        $userTeacher->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Delete data user guru',
            'useraccess' => $user->name_mut
        ]);

        return redirect()->route('data_guru')->with('success', 'Data berhasil dihapus.');
    }
}
