<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\WEB\User_Guru;
use App\Models\Log;
use App\Models\WEB\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show_mapelajar(Request $request)
    {
        // Mengambil data user dari session
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut
        ];

        // Mengambil data mapel beserta name_tpc dari tabel tb_t_mapel dan tb_class
        $mapel = DB::table('tb_t_mapel')
            ->join('tb_t_period_class', 'tb_t_mapel.id_tpc', '=', 'tb_t_period_class.id_tpc')
            ->join('tb_m_period', 'tb_t_period_class.id_mper', '=', 'tb_m_period.id_mper')
            ->where('tb_t_mapel.id_mut', $user->id_mut)
            ->get();

        return view('Data_Materi-Guru.tabel_mapel', ['mapel' => $mapel], ['data' => $data]);
    }

    public function show_materiajar(Request $request, $id_tm)
    {
        // Mengambil data user dari session
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut,
            'id_tm' => $id_tm
        ];

        // Mengambil daftar materi berdasarkan id_tm
        $materi = Materi::where('id_tm', $id_tm)->get();

        return view('Data_Materi-Guru.show_materi', ['materi' => $materi], ['data' => $data]);
    }

    public function store(Request $request, $id_tm)
    {
        // Validasi input materi
        $request->validate([
            'id_tm' => 'required',
            'judul_tmat' => 'required',
            'desk_tmat' => 'nullable',
            'gmb_tmat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_tmat' => 'nullable|mimes:pdf,doc,docx',
        ]);

        // Simpan data materi ke dalam database
        $materi = new Materi;
        $materi->id_tm = $id_tm;
        $materi->judul_tmat = $request->judul_tmat;
        $materi->desk_tmat = $request->desk_tmat;

        // Upload gambar materi
        if ($request->hasFile('gmb_tmat')) {
            $gambar = $request->file('gmb_tmat');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambarPath = $gambar->move(public_path('gambar'), $gambarName)->getPathname();
            $materi->gmb_tmat = $gambarPath;
        }

        // Upload file materi
        if ($request->hasFile('file_tmat')) {
            $file = $request->file('file_tmat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('file'), $fileName)->getPathname();
            $materi->file_tmat = $filePath;
        }

        $materi->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Materi',
            'action' => 'Upload data materi',
            'useraccess' => $user->name_mut
        ]);

        // Redirect kembali ke halaman "show materi"
        return Redirect::back()->with('success', 'Materi berhasil ditambahkan.');
    }

    public function delete_materi(Request $request, $id_tmat)
    {
        $materi = Materi::find($id_tmat);

        if (!$materi) {
            // return redirect()->route('show_materi')->with('error', 'Data tidak ditemukan.');
            return Redirect::back()->with('success', 'Data tidak ditemukan.');
        }

        $materi->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Materi',
            'action' => 'Delete data materi',
            'useraccess' => $user->name_mut
        ]);

        // return redirect()->route('show_materi')->with('success', 'Data berhasil dihapus.');
        return Redirect::back()->with('success', 'Data berhasil dihapus.');
    }

    public function downloadGambar($filename)
    {
        $path = public_path('gambar/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json([
                'message' => 'Gambar tidak ditemukan.'
            ], 404);
        }
    }

    public function downloadFile($filename)
    {
        $path = public_path('gambar/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json([
                'message' => 'File tidak ditemukan.'
            ], 404);
        }
    }
}
