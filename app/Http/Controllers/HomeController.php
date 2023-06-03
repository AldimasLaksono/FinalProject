<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\WEB\User;
use App\Models\WEB\User_Guru;
use App\Models\WEB\Tugas;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        // Mengambil data user dari sesi
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $activeTeacher = User_guru::where('status', 'active')->count();
        $inactiveTeacher = User_Guru::where('status', 'deactiv')->count();

        $activeStudents = User::where('status_mus', 'active')->count();
        $inactiveStudents = User::where('status_mus', 'deactiv')->count();

        // Mengirim data nama user ke halaman dashboard
        return view('dashboard', ['data' => $data], compact('activeStudents', 'inactiveStudents', 'activeTeacher', 'inactiveTeacher'));
    }

    public function dashboard2(Request $request)
    {
        // Mengambil data user dari sesi
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        $activeTeacher = Tugas::where('status', '1')->count();
        $inactiveTeacher = Tugas::where('status', '0')->count();

        $tClass = DB::table('tb_t_class as tc')
        ->join('tb_t_period_class as tpc', 'tc.id_tpc', '=', 'tpc.id_tpc')
        ->join('tb_t_mapel as tm', 'tpc.id_tpc', '=', 'tm.id_tpc')
        ->join('tb_m_user_teacher as mut', 'tm.id_mut', '=', 'mut.id_mut')
        ->join('tb_m_ruang as mr', 'tc.id_mr', '=', 'mr.id_mr')
        ->select('tc.*', 'mr.name_mr')
        ->where('mut.id_mut', $user->id_mut)
        ->distinct()
        ->get();


        // Mengirim data nama user ke halaman dashboard
        return view('dashboard2', ['data' => $data], compact('tClass', 'activeTeacher', 'inactiveTeacher'));
    }
}
