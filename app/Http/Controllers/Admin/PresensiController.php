<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Presensi;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function show_presensi()
    {
        //$presensi = Presensi::all();

        $presensi = DB::table('tb_t_presensi')
        ->join('users', 'tb_t_presensi.id_mus', '=', 'users.id_mus')
        ->select(
            'users.*',
            'tb_t_presensi.*')
        ->get();

        return view('Data_Presensi.presensi', compact('presensi'));
    }
}
