<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\WEB\Tugas;
use App\Models\Log;

class tugascontroll extends Controller
{
    public function showtugas(Request $request)
    {
        // Mengambil data user dari session
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut,
            'id_mut' => $user->id_mut
        ];

        // Mengambil data mapel beserta name_tpc dari tabel tb_t_mapel dan tb_class
        $tugas = DB::table('tb_m_tugas')
            ->join('tb_t_class', 'tb_m_tugas.id_tc', '=', 'tb_t_class.id_tc')
            ->select('tb_t_class.*', 'tb_m_tugas.*')
            ->where('tb_m_tugas.id_mut', $user->id_mut)
            ->get();

        foreach ($tugas as $tugasItem) {
            $now = Carbon::now();
            $deadline = Carbon::parse($tugasItem->deadline_tt);

            if ($now->greaterThan($deadline)) {
                // Jika sudah melewati deadline, ubah status tugas menjadi 0 (tidak aktif)
                DB::table('tb_m_tugas')
                    ->where('id_mt', $tugasItem->id_mt)
                    ->update(['status' => 0]);
            }
        }

        return view('Data_Tugas-Guru.tugas', ['tugas' => $tugas], ['data' => $data]);
    }

    public function create_tugas(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'desk_tj' => 'required',
            'gmb_tj' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_tj' => 'nullable|mimes:pdf,doc,docx',
            'deadline_tt' => 'required|date',
        ]);

        // Mendapatkan ID user yang sedang login
        $id_mut = $request->session()->get('user')->id_mut;

        // Menyimpan data tugas ke dalam database
        $tugas = new Tugas();
        $tugas->id_tc = $request->input('id_tc');
        $tugas->id_mut = $id_mut;
        $tugas->desk_tj = $request->input('desk_tj');

        // Menyimpan gambar
        $file = $request->file('gmb_tj');
        $gambarName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('gambar'), $gambarName);
        $tugas->gmb_tj = $gambarName;

        // Menyimpan file
        $file = $request->file('file_tj');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('gambar'), $fileName);
        $tugas->file_tj = $fileName;

        $tugas->status = 1; // Tugas baru memiliki status 1 (aktif)
        $tugas->deadline_tt = $request->input('deadline_tt');
        $tugas->save();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Tugas',
            'action' => 'Upload Master Tugas',
            'useraccess' => $user->name_mut
        ]);

        if ($tugas) {
            $now = Carbon::now();
            $deadline = Carbon::parse($tugas->deadline_tt);

            if ($now->greaterThan($deadline)) {
                // Jika sudah melewati deadline, ubah status tugas menjadi 0 (tidak aktif)
                $tugas->status = 0;
                $tugas->save();
            }
        }

        // Redirect ke halaman yang tepat setelah berhasil membuat tugas
        return redirect()->route('show_tugas')->with('success', 'Tugas berhasil dibuat.');
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

    public function delete_tugas(Request $request, $id_mt)
    {
        $tugas = Tugas::find($id_mt);

        if (!$tugas) {
            // return redirect()->route('show_materi')->with('error', 'Data tidak ditemukan.');
            return Redirect::back()->with('success', 'Data tidak ditemukan.');
        }

        $tugas->delete();

        $user = $request->session()->get('user');
        Log::create([
            'module' => 'Data_Tugas',
            'action' => 'Delete data tugas',
            'useraccess' => $user->name_mut
        ]);

        // return redirect()->route('show_materi')->with('success', 'Data berhasil dihapus.');
        return Redirect::back()->with('success', 'Data berhasil dihapus.');
    }

    public function showDetailTugas(Request $request, $id_mt)
    {
        // Mengambil data user dari session
        $user = $request->session()->get('user');

        // Mendapatkan nama user (name_mut)
        $data = [
            'name_mut' => $user->name_mut,
            'foto_mut' => $user->foto_mut,
            'role_mut' => $user->role_mut,
            'id_mut' => $user->id_mut
        ];

        // Mengambil data tb_t_tugas berdasarkan id_mt
        $jawab = DB::table('tb_t_tugas')
            ->join('users', 'users.id_mus', '=', 'tb_t_tugas.id_mus')
            ->join('tb_t_nilai', 'tb_t_nilai.id_tu', '=', 'tb_t_tugas.id_tu')
            ->select('users.*', 'tb_t_tugas.*', 'tb_t_nilai.*')
            ->where('id_mt', $id_mt)
            ->get();

        return view('Data_Tugas-Guru.detail', ['jawab' => $jawab], ['data' => $data]);
    }

    public function downloadjawaban($filename)
    {
        $path = public_path('tugas/' . $filename);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json([
                'message' => 'File tidak ditemukan.'
            ], 404);
        }
    }

    public function inputNilai(Request $request)
    {
        //$id_tu = $request->input('id_tu'); // Ambil nilai id_tu dari form atau request

        // Validasi inputan dan lakukan operasi penyimpanan nilai ke dalam tabel tb_t_nilai
        try {
            DB::table('tb_t_nilai')->insert([
                'id_tu' => $request->input('id_tu'),
                'nilai_tn' => $request->input('nilai_tn'), // Ubah sesuai dengan nama kolom nilai di tabel tb_t_nilai
                // Tambahkan kolom lain sesuai dengan struktur tabel tb_t_nilai
            ]);

            return redirect()->back()->with('success', 'Nilai berhasil disimpan'); // Redirect ke halaman sebelumnya dengan pesan sukses
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan nilai: ' . $e->getMessage()); // Redirect ke halaman sebelumnya dengan pesan error
        }
    }
}
