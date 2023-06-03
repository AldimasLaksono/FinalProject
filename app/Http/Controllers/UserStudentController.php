<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Exception;
use App\Models\User;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\MapelClass;
use App\Models\Materi;
use App\Models\Tugas;


class UserStudentController extends Controller
{
    //
    public function profil(Request $request)
    {
        // $token = $request->bearerToken();
        // $user = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));

        // $user = User::find($user->id_mus);

        // return response()->json([
        //     'message' => 'success',
        //     'data' => $user
        // ]);


        // Mengambil user dari token JWT
        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        // Mengambil data profil pengguna
        $profil = User::select(
            'users.nis',
            'users.name_mus',
            'users.email',
            'users.ttl_mus',
            'users.alamat_mus',
            'users.notelp_mus',
            'tb_t_class.name_tc',
            'tb_m_period.name_mper'
        )
            ->join('tb_t_class', 'users.id_tc', '=', 'tb_t_class.id_tc')
            ->join('tb_t_period_class', 'tb_t_class.id_tpc', '=', 'tb_t_period_class.id_tpc')
            ->join('tb_m_period', 'tb_t_period_class.id_mper', '=', 'tb_m_period.id_mper')
            ->where('users.id_mus', $user->id_mus)
            ->first();

        return response()->json([
            'message' => 'success',
            'data' => $profil
        ]);
    }

    public function update_foto(Request $request)
    {

        // Validasi input file foto
        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        $userId = $user->id_mus;

        $validator = Validator::make($request->all(), [
            'foto_mus' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Proses upload foto
        if ($request->hasFile('foto_mus')) {
            // Hapus foto sebelumnya jika ada
            $previousPhoto = User::where('id_mus', $userId)->value('foto_mus');

            if ($previousPhoto) {
                $previousPhotoPath = public_path('foto_mus/' . $previousPhoto);
                if (File::exists($previousPhotoPath)) {
                    File::delete($previousPhotoPath);
                }
            }

            // Upload foto baru
            $photo = $request->file('foto_mus');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('foto_mus'), $photoName);

            // Update foto user di database
            User::where('id_mus', $userId)->update(['foto_mus' => $photoName]);

            return response()->json(['message' => 'Foto berhasil diupdate'], 200);
        }

        return response()->json(['message' => 'Foto gagal diupdate'], 500);
    }

    public function change_password(Request $request)
    {
        $token = $request->bearerToken();
        try {
            $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

            $user = User::find($user->id_mus);

            $validator = Validator::make($request->all(), [
                'password' => 'min:8',
                'confirmation_password' => 'same:password',
            ]);

            if ($validator->fails()) {
                $errs = $validator->errors()->all();
                $err = join(', ', $errs);

                return response()->json([
                    'message' => 'validation error',
                    'data' => $err
                ], 400);
            }

            $user->password = $request->password;
            $user->save();

            return response()->json([
                'message' => 'Password Berhasil Diubah',
                'data' => [
                    'nis' => $user->nis,
                    'id kelas' => $user->id_tc,
                    'nama siswa' => $user->name_mus,
                    'tempat tanggal lahir' => $user->ttl_mus,
                    'gender' => $user->gender_mus,
                    'alamat' => $user->alamat_mus,
                    'no telp' => $user->notelp_mus,
                    'email' => $user->email,
                    'foto' => $user->foto_mus,
                ]
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Invalid token',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function showAllMapel(Request $request)
    {
        // $token = $request->bearerToken();
        // if (!$token) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // $user = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));
        // $id_mus = $user->id_mus;

        // $userKelas = User::where('id_mus', $id_mus)
        //     ->with('kelas.periodClass')
        //     ->first();

        // if (!$userKelas || !$userKelas->kelas) {
        //     return response()->json(['message' => 'User class not found'], 404);
        // }

        // $data = DB::table('tb_t_period_class')
        //     ->join('tb_m_period', 'tb_m_period.id_mper', '=', 'tb_t_period_class.id_mper')
        //     ->join('tb_t_class', 'tb_t_class.id_tpc', '=', 'tb_t_period_class.id_tpc')
        //     ->join('tb_t_mapel', 'tb_t_mapel.id_tcp', '=', 'tb_t_period_class.id_tpc')
        //     ->join('tb_m_mapel', 'tb_m_mapel.id_mm', '=', 'tb_t_mapel.id_mm')
        //     ->join('tb_m_user_teacher', 'tb_m_user_teacher.id_mut', '=', 'tb_t_mapel.id_mut')
        //     ->select(
        //         'tb_m_period.name_mper',
        //         'tb_t_period_class.name_tpc',
        //         'tb_t_class.name_tc',
        //         'tb_m_mapel.name_mm',
        //         'tb_m_user_teacher.name_mut'
        //     )
        //     ->where('tb_t_period_class.id_mper', $userKelas->kelas->periodClass->id_mper)
        //     ->where('tb_t_class.id_tc', $userKelas->kelas->id_tc)
        //     ->get();

        // return response()->json($data);

        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));
        $id_mus = $user->id_mus;

        $userKelas = User::where('id_mus', $id_mus)
            ->with('kelas.periodClass')
            ->first();

        if (!$userKelas || !$userKelas->kelas) {
            return response()->json(['message' => 'User class not found'], 404);
        }

        $data = DB::table('tb_t_period_class')
            ->join('tb_m_period', 'tb_m_period.id_mper', '=', 'tb_t_period_class.id_mper')
            ->join('tb_t_class', 'tb_t_class.id_tpc', '=', 'tb_t_period_class.id_tpc')
            ->join('tb_t_mapel', 'tb_t_mapel.id_tpc', '=', 'tb_t_period_class.id_tpc')
            ->join('tb_m_mapel', 'tb_m_mapel.id_mm', '=', 'tb_t_mapel.id_mm')
            ->join('tb_m_user_teacher', 'tb_m_user_teacher.id_mut', '=', 'tb_t_mapel.id_mut')
            ->select(
                'tb_m_period.name_mper',
                'tb_t_period_class.*',
                'tb_t_mapel.*',
                'tb_t_class.name_tc',
                'tb_m_mapel.name_mm',
                'tb_m_user_teacher.name_mut'
            )
            ->where('tb_t_period_class.id_mper', $userKelas->kelas->periodClass->id_mper)
            ->where('tb_t_class.id_tc', $userKelas->kelas->id_tc)
            ->get();

        $response = [
            'message' => 'success',
            'data' => $data->map(function ($item) {
                return [
                    'id_mapel' => $item->id_tm,
                    'peiode' => $item->name_mper,
                    'periode kelas' => $item->name_tpc,
                    'nama_kelas' => $item->name_tc,
                    'nama_mapel' => $item->name_mm,
                    'nama_guru' => $item->name_mut,
                ];
            }),
        ];

        return response()->json($response);
    }

    // $token = $request->bearerToken();
    // if (!$token) {
    //     return response()->json(['message' => 'Unauthorized'], 401);
    // }

    // $user = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));
    // $id_mus = $user->id_mus;

    // $data = DB::table('tb_t_period_class')
    //     ->join('tb_m_period', 'tb_m_period.id_mper', '=', 'tb_t_period_class.id_mper')
    //     ->join('tb_t_class', 'tb_t_class.id_tpc', '=', 'tb_t_period_class.id_tpc')
    //     ->join('tb_t_mapel', 'tb_t_mapel.id_tcp', '=', 'tb_t_period_class.id_tpc')
    //     ->join('tb_m_mapel', 'tb_m_mapel.id_mm', '=', 'tb_t_mapel.id_mm')
    //     ->join('tb_m_user_teacher', 'tb_m_user_teacher.id_mut', '=', 'tb_t_mapel.id_mut')
    //     ->select(
    //         'tb_m_period.name_mper',
    //         'tb_t_period_class.name_tpc',
    //         'tb_t_class.name_tc',
    //         'tb_m_mapel.name_mm',
    //         'tb_m_user_teacher.name_mut'
    //     )
    //     ->get();

    // return response()->json($data);


    public function showListMateri(Request $request, $id_tm)
    {
        //     $token = $request->bearerToken();
        //     if (!$token) {
        //         return response()->json(['message' => 'Unauthorized'], 401);
        //     }

        //     try {
        //         $user = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));
        //         $id_mus = $user->id_mus;

        //         $materi = DB::table('tb_t_materi')
        //             ->join('tb_t_mapel', 'tb_t_materi.id_tm', '=', 'tb_t_mapel.id_tm')
        //             ->join('tb_m_mapel', 'tb_m_mapel.id_mm', '=', 'tb_t_mapel.id_mm')
        //             ->join('tb_t_period_class', 'tb_t_mapel.id_tcp', '=', 'tb_t_period_class.id_tpc')
        //             ->join('tb_m_period', 'tb_m_period.id_mper', '=', 'tb_t_period_class.id_mper')
        //             ->select(
        //                 'tb_t_period_class.name_tpc',
        //                 'tb_m_mapel.name_mm',
        //                 'tb_t_materi.judul_tmat',
        //             )
        //             ->where('tb_t_materi.id_tm', $id_tm)
        //             ->first();

        //         if (!$materi) {
        //             return response()->json(['message' => 'Materi not found'], 404);
        //         }

        //         return response()->json($materi);
        //     } catch (ExpiredException $e) {
        //         return response()->json(['message' => 'Token has expired'], 401);
        //     } catch (\Exception $e) {
        //         return response()->json(['message' => 'Invalid token'], 401);
        //     }

        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        $userId = $user->id_mus;
        $materi = Materi::with('mapel')
            ->where('id_tm', $id_tm)
            ->get();

        if ($materi->isEmpty()) {
            return response()->json(['message' => 'Materi not found'], 404);
        }

        $response = [
            'message' => 'success',
            'data' => $materi->map(function ($item) {
                return [
                    'id_mapel' => $item->id_tm,
                    'id_materi' => $item->id_tmat,
                    'judul_tmat' => $item->judul_tmat,
                    'mapel' => [
                        'id_mm' => $item->mapel->id_mm,
                        'kode_mapel' => $item->mapel->kode_mm_tm,
                    ],
                ];
            }),
        ];

        return response()->json($response);
    }

    public function detailMateri(Request $request, $id_tmat)
    {
        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        $userId = $user->id_mus;
        $materi = Materi::with(['mapel'])
            ->where('id_tmat', $id_tmat)
            ->first();

        if (!$materi) {
            return response()->json(['message' => 'Materi not found'], 404);
        }

        $response = [
            'message' => 'success',
            'data' => [
                'id_materi' => $materi->id_tmat,
                'judul materi' => $materi->judul_tmat,
                'deskripsi materi' => $materi->desk_tmat,
                'gambar materi' => $materi->gmb_tmat,
                'file materi' => $materi->file_tmat,
                'mapel' => [
                    'kode_mapel' => $materi->mapel->kode_mm_tm,
                ],
            ]
        ];

        return response()->json($response);
    }


    public function showTugas(Request $request)
    {
        // // Mendapatkan token dari request
        // $token = $request->bearerToken();

        // // Mengecek keberadaan token
        // if (!$token) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // try {
        //     // Mendekode token
        //     $decodedToken = JWT::decode($token, env('JWT_SECRET_KEY'), ['HS256']);
        // } catch (ExpiredException $e) {
        //     return response()->json(['error' => 'Token has expired'], 401);
        // } catch (Exception $e) {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // // Mendapatkan user ID dari token
        // $userId = $decodedToken->id_mus;

        // // Mendapatkan kelas ID berdasarkan user ID
        // $user = User::find($userId);
        // $kelasId = $user->kelas_id;

        // // Mengambil tugas berdasarkan kelas ID
        // $tugas = Tugas::join('tb_t_class', 'tb_m_tugas.id_tc', '=', 'tb_t_class.id_tc')
        //     ->join('tb_m_user_teacher', 'tb_m_tugas.id_mut', '=', 'tb_m_user_teacher.id_mut')
        //     ->join('tb_m_mapel', 'tb_t_class.id_tpc', '=', 'tb_m_mapel.id_mm')
        //     ->where('tb_t_class.id_tc', $kelasId)
        //     ->select('tb_m_tugas.id_mt', 'tb_m_tugas.desk_tj', 'tb_t_class.name_tc', 'tb_m_user_teacher.name_mut', 'tb_m_mapel.name_mm')
        //     ->get();

        // return response()->json($tugas);

        // $token = $request->bearerToken();
        // $user = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));
        // $userId = $user->id_mus;
        // $kelas = DB::table('tb_t_class')->where('id_mus', $userId)->first();
        // if ($kelas) {
        //     $tugas = DB::table('tb_t_tugas')
        //         ->join('tb_m_tugas', 'tb_t_tugas.id_mt', '=', 'tb_m_tugas.id_mt')
        //         ->where('tb_m_tugas.id_tc', $kelas->id_tc)
        //         ->get();

        //     return response()->json([
        //         'message' => 'Berhasil mendapatkan tugas berdasarkan kelas',
        //         'data' => $tugas
        //     ], 200);
        // }

        // return response()->json([
        //     'message' => 'Tidak ada tugas yang tersedia untuk kelas ini',
        //     'data' => []
        // ], 200);

        //YANG DIPAKAI

        // $validator = Validator::make($request->all(), [
        //     'id_tc' => 'required|exists:tb_t_class,id_tc',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        // $tugas = DB::table('tb_m_tugas')
        //     ->join('tb_t_class', 'tb_m_tugas.id_tc', '=', 'tb_t_class.id_tc')
        //     ->where('tb_m_tugas.id_tc', $request->id_tc)
        //     ->get();

        // if ($tugas->isEmpty()) {
        //     return response()->json([
        //         'message' => 'Tidak ada tugas yang tersedia untuk kelas ini',
        //         'data' => []
        //     ], 200);
        // }

        // return response()->json([
        //     'message' => 'Berhasil mendapatkan tugas berdasarkan kelas',
        //     'data' => $tugas
        // ], 200);

        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));
        $userId = $user->id_mus;

        $kelas = DB::table('users')
            ->where('id_mus', $userId)
            ->first();

        if ($kelas) {
            $tugas = DB::table('tb_m_tugas')
                ->join('tb_t_class', 'tb_m_tugas.id_tc', '=', 'tb_t_class.id_tc')
                ->join('tb_m_user_teacher', 'tb_m_tugas.id_mut', '=', 'tb_m_user_teacher.id_mut')
                ->where('tb_m_tugas.id_tc', $kelas->id_tc)
                ->where('tb_m_tugas.status', 1)
                ->get();;

            if ($tugas->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada tugas yang tersedia untuk kelas ini',
                    'data' => []
                ], 200);
            }

            $formattedTugas = [];
            foreach ($tugas as $tugasItem) {
                $formattedTugas[] = [
                    'id tugas' => $tugasItem->id_mt,
                    'kelas' => $tugasItem->name_tc,
                    'nama guru' => $tugasItem->name_mut,
                    'deskripsi tugas' => $tugasItem->desk_tj,
                    'batas waktu' => $tugasItem->deadline_tt
                ];
            }

            return response()->json([
                'message' => 'Tugas berdasarkan kelas',
                'data' => $formattedTugas
            ], 200);
        }

        return response()->json([
            'message' => 'Tidak ada kelas yang ditemukan untuk pengguna ini',
            'data' => []
        ], 200);
    }

    public function detailTugas(Request $request, $id_mt)
    {
        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        $userId = $user->id_mus;
        $tugas = Tugas::where('id_mt', $id_mt)
            ->first();

        if (!$tugas) {
            return response()->json(['message' => 'Tugas not found'], 404);
        }

        $response = [
            'message' => 'success',
            'data' => [
                'id tugas' => $tugas->id_mt,
                'deskripsi tugas' => $tugas->desk_tj,
                'gambar tugas' => $tugas->gmb_tj,
                'file tugas' => $tugas->file_tj,
            ]
        ];

        return response()->json($response, 200);
    }

    public function uploadTugas(Request $request)
    {

        // Mendapatkan user yang sedang login
        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        $userId = $user->id_mus;
        // Validasi input
        $validator = Validator::make($request->all(), [

            'id_mt' => 'required|exists:tb_m_tugas,id_mt',
            'desk_tj' => 'required',
            'file_tj' => 'required|file',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        // Membuat record tugas baru
        $tugas = [
            'id_mus' => $userId,
            'id_mt' => $request->id_mt,
            'desk_tj' => $request->desk_tj,
        ];

        // Upload file tugas
        // if ($request->hasFile('file_tj')) {
        //     $file = $request->file('file_tj');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('tugas', $fileName, 'public');
        //     $tugas['file_tj'] = $filePath;
        // }

        // Menyimpan file
        $file = $request->file('file_tj');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('tugas'), $fileName);
        $tugas['file_tj'] = $fileName;

        // Simpan tugas ke database
        DB::table('tb_t_tugas')->insert($tugas);

        return response()->json([
            'message' => 'Jawaban anda berhasil diunggah',
            'data' => $tugas

        ], 200);


        // tugas sesuai kelas 


        // // Mendapatkan user yang sedang login
        // $token = $request->bearerToken();
        // $user = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));
        // $userId = $user->id_mus;

        // // Mendapatkan id_tc kelas pengguna yang login
        // $kelasPengguna = DB::table('tb_t_class')->where('id_mus', $userId)->first();
        // $idTcKelasPengguna = $kelasPengguna->id_tc;

        // // Validasi input
        // $validator = Validator::make($request->all(), [
        //     'id_mt' => 'required|exists:tb_m_tugas,id_mt,id_tc,' . $idTcKelasPengguna,
        //     'desk_tj' => 'required',
        //     'file_tj' => 'required|file',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 400);
        // }

        // // Membuat record tugas baru
        // $tugas = [
        //     'id_mus' => $userId,
        //     'id_mt' => $request->id_mt,
        //     'desk_tj' => $request->desk_tj,
        // ];

        // // Upload file tugas
        // if ($request->hasFile('file_tj')) {
        //     $file = $request->file('file_tj');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('tugas', $fileName, 'public');
        //     $tugas['file_tj'] = $filePath;
        // }

        // // Simpan tugas ke database
        // DB::table('tb_t_tugas')->insert($tugas);

        // return response()->json(['message' => 'Jawaban anda telah berhasil diunggah'], 200);
    }
}
