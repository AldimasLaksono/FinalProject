<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT; //panggil library jwt
use Firebase\JWT\Key;
use App\Models\User; //panggil model user
use App\Models\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{
    // public function register(Request $request)
    // {

    //     //buat validasi inputan
    //     $validator = Validator::make($request->all(), [
    //         'nis' => 'required|unique:users',
    //         'name_mus' => 'required',
    //         'ttl_mus' => 'required',
    //         'gender_mus' => 'required',
    //         'alamat_mus' => 'required',
    //         'notelp_mus' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required',
    //         'status_mus' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return messageError($validator->messages()->toArray());
    //     }

    //     $user = $validator->validated();

    //     User::create($user);

    //     $payload = [
    //         'name_mus' => $user['name_mus'],
    //         'id_mus' => $user['id_mus'],
    //         'iat' => now()->timestamp,
    //         'exp' => now()->timestamp + 7200
    //     ];

    //     $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

    //     Log::create([
    //         'module' => 'register',
    //         'action' => 'registrasi akun',
    //         'useraccess' => $user['email']
    //     ]);

    //     return response()->json([
    //         "data" => [
    //             'msg' => "berhasil register",
    //             'nama' => $user['nama'],
    //             'email' => $user['email'],
    //             'role' => 'user',
    //         ],
    //         "token" => "Bearer {$token}"
    //     ], 200);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only(['nis', 'password']);

        $user = User::where('nis', $credentials['nis'])
            ->where('status_mus', 'active')
            ->first();

        $decryptedPassword = decrypt($user->password);

        if ($credentials['password'] != $decryptedPassword) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $payload = [
            'name_mus' => $user->name_mus,
            'id_mus' => $user->id_mus,
            'iat' => now()->timestamp,
            'exp' => now()->timestamp + 7200
        ];

        $token = JWT::encode($payload, '3C2iKx4U5U6I19UCM3cq', 'HS256');

        return response()->json([
            'msg' => "Berhasil Login",
            "data" => [
                'user' => [
                    'nis' => $user->nis,
                    'nama' => $user->name_mus,
                    'email' => $user->email
                ],
                'token' => $token,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        try {
            $decoded = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Invalid token'], 400);
        }

        auth()->logout();
        // Proses logout di sini (sesuai dengan kebutuhan aplikasi Anda)
        // Contoh: Menghapus token dari penyimpanan

        // Misalnya, jika Anda menggunakan penyimpanan token di database
        // Token::where('token', $token)->delete();

        return response()->json(['message' => 'Berhasil Keluar'], 200);
    }

    // public function forgotPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     $email = $request->email;

    //     // Cek apakah email ada dalam database
    //     $user = User::where('email', $email)->first();

    //     if (!$user) {
    //         return response()->json(['message' => 'Email not found'], 404);
    //     }

    //     // Generate token untuk reset password
    //     $token = sha1(mt_rand());

    //     // Simpan token ke dalam tabel reset_password
    //     DB::table('reset_password')->insert([
    //         'email' => $email,
    //         'token' => $token,
    //         'created_at' => now(),
    //     ]);

    //     // Kirim email reset password
    //     $data = [
    //         'email' => $email,
    //         'token' => $token,
    //     ];

    //     Mail::to($email)->send(new ResetPasswordMail($data));

    //     return response()->json(['message' => 'Password reset email has been sent']);
    // }

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'token' => 'required',
    //         'password' => 'required|min:8',
    //     ]);

    //     $email = $request->email;
    //     $token = $request->token;
    //     $password = $request->password;

    //     // Cek apakah token valid dalam tabel reset_password
    //     $resetPassword = DB::table('reset_password')
    //         ->where('email', $email)
    //         ->where('token', $token)
    //         ->first();

    //     if (!$resetPassword) {
    //         return response()->json(['message' => 'Invalid token'], 400);
    //     }

    //     // Update password user
    //     $user = User::where('email', $email)->first();
    //     $user->password = bcrypt($password);
    //     $user->save();

    //     // Hapus token dari tabel reset_password
    //     DB::table('reset_password')
    //         ->where('email', $email)
    //         ->where('token', $token)
    //         ->delete();

    //     return response()->json(['message' => 'Password reset successful']);
    // }
}
