<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WEB\Presensi;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function show_presensi(Request $request)
    {
        $user = $request->session()->get('user');
        
        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        //$presensi = Presensi::all();

        $presensi = DB::table('tb_t_presensi')
        ->join('users', 'tb_t_presensi.id_mus', '=', 'users.id_mus')
        ->select(
            'users.*',
            'tb_t_presensi.*')
        ->get();

        return view('Data_Presensi.presensi', compact('presensi'), ['data' => $data]);
    }
}
