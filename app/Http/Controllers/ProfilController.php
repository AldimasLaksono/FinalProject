<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WEB\Jabatan;
use App\Models\WEB\User_Guru;
use App\Models\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;

class ProfilController extends Controller
{
    public function show_profile(Request $request)
    {
        // Mengambil data user dari sesi
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'id_mut' => $user->id_mut,
            'id_mja' => $user->id_mja,
            'nip' => $user->nip,
            'ttl_mut' => $user->ttl_mut,
            'gender_mut' => $user->gender_mut,
            'alamat_mut' => $user->alamat_mut,
            'notelp_mut' => $user->notelp_mut,
            'email' => $user->email,
            'status_mut' => $user->status_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut,
            'password' => $user->password,
            'status' => $user->status,
        ];

        $decryptedPassword = Crypt::decryptString($user->password);
        $data['password'] = $decryptedPassword;


        $mja = Jabatan::where('id_mja', $user->id_mja)->first();
        $data['name_mja'] = $mja->name_mja;

        // Mengirim data nama user ke halaman dashboard
        return view('profile', ['data' => $data]);
    }

    public function update_guru(Request $request)
    {
        // Mengambil data user dari sesi
        $user = $request->session()->get('user');

        $userTeacher = User_Guru::find($user->id_mut);
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

        // Memperbarui data user dalam session dengan data yang sudah diperbarui
        $request->session()->put('user', $userTeacher);

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Teacher',
            'action' => 'Update data user guru',
            'useraccess' => $user->name_mut
        ]);
        session()->flash('success', 'Data Profile berhasil diperbarui');

        return redirect()->route('profile');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Mengambil data user dari sesi
        $user = $request->session()->get('user');

        // Mengambil user guru berdasarkan id_mut
        $userGuru = User_Guru::find($user->id_mut);

        // Memeriksa kecocokan password saat ini
        $decryptedPassword = Crypt::decryptString($userGuru->password);
        // var_dump($request->current_password);
        // var_dump($decryptedPassword);
        if ($request->current_password != $decryptedPassword) {
            session()->flash('error', 'Password saat ini tidak cocok');
            return redirect()->route('profile');
        }

        // Mengupdate password baru
        //$encryptedPassword = Crypt::encryptString($request->new_password);
        $userGuru->password = $request->new_password;
        $userGuru->save();

        // Memperbarui data user dalam session dengan data yang sudah diperbarui
        $request->session()->put('user', $userGuru);

        session()->flash('success', 'Password berhasil diperbarui');
        return redirect()->route('profile');
    }

    public function updatePhoto(Request $request)
    {
        // Validasi input
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengambil data user dari sesi
        $user = $request->session()->get('user');

        // Mengambil user guru berdasarkan id_mut
        $userGuru = User_Guru::find($user->id_mut);

        // Menghapus foto profil yang ada (jika ada)
        if ($userGuru->foto_mut) {
            $pathToOldFile = public_path('path_ke_foto') . '/' . $userGuru->foto_mut;
            if (file_exists($pathToOldFile)) {
                unlink($pathToOldFile);
            }
        }

        // Menyimpan foto profil baru
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('path_ke_foto'), $fileName);

        // Mengupdate foto profil pada model user guru
        $userGuru->foto_mut = $fileName;
        $userGuru->save();

        // Memperbarui data user dalam session dengan data yang sudah diperbarui
        $request->session()->put('user', $userGuru);

        session()->flash('success', 'Foto profil berhasil diperbarui');
        return redirect()->route('profile');
    }
}
