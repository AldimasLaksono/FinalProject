<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Models\WEB\User_Guru;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        //$nip = $request->input('nip');

        //dd($email, $nip);

        // Lakukan validasi credentials sesuai dengan logika aplikasi Anda
        $user = User_Guru::where('email', $email)
            // ->where('nip', $nip)
            ->first();

        //$id_mut = $user->id_mut;

        if (!$user) {
            // Jika user tidak ditemukan, tampilkan pesan error dan kembali ke halaman login
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        // Dekripsi password yang ada di database
        $encryptedPassword = $user->password;
        $decryptedPassword = Crypt::decryptString($encryptedPassword);

        if ($password != $decryptedPassword) {
            // Jika password tidak sesuai, tampilkan pesan error dan kembali ke halaman login
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        // Cek status pengguna
        if ($user->status === 'deactive') {
            // Jika status pengguna tidak aktif, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        session()->put('user', $user);
        session()->put('id_mut', $user->id_mut);
        //dd($user->role_mut);

        // Redirect ke dashboard yang sesuai berdasarkan peran (role)
        if ($user->role_mut === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role_mut === 'guru') {
            return redirect()->route('dashboard2');
        }
        return redirect()->back()->with('error', 'Invalid credentials');

        // Redirect ke halaman dashboard atau halaman lain yang sesuai
        //return redirect()->route('dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
