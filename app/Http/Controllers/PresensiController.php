<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use stdClass;

use Firebase\JWT\Key;
use Firebase\JWT\JWT;


class PresensiController extends Controller
{
    //
    public function save_presensi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $token = $request->bearerToken();
        $user = JWT::decode($token, new Key('3C2iKx4U5U6I19UCM3cq', 'HS256'));

        $presensi = new Presensi();
        $presensi->id_mus = $user->id_mus;
        $presensi->status = $request->status;
        $presensi->latitude = $request->latitude;
        $presensi->longitude = $request->longitude;
        $presensi->tanggal = date('Y-m-d H:i:s');

        $presensi->save();

        return response()->json([
            'success' => true,
            'data' => [
                'id siswa' => $presensi->id_mus,
                'status' => $presensi->status,
                'tanggal' => $presensi->tanggal,
            ],
            'message' => 'Presensi Sukses'
        ]);
    }
}
