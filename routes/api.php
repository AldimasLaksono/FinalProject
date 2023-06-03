<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserStudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', [AuthController::class, 'login']);
Route::get('profil', [UserStudentController::class, 'profil']);
Route::post('update-foto', [UserStudentController::class, 'update_foto']);
Route::put('change-password', [UserStudentController::class, 'change_password']);
//Route::get('get-presensi', [PresensiController::class, 'get_presensi']);
Route::post('save-presensi', [PresensiController::class, 'save_presensi']);
//Route::get('show-all-mapel', [UserStudentController::class, 'showAllMapel']);
// Route::get('show-mapel-byperiod', [UserStudentController::class, 'showMapelbyPeriod']);
Route::get('show-all-mapel', [UserStudentController::class, 'showAllMapel']);
Route::get('show-list-materi/{id_tm}', [UserStudentController::class, 'showListMateri']);
Route::get('detail-materi/{id_tmat}', [UserStudentController::class, 'detailMateri']);
Route::get('show-tugas', [UserStudentController::class, 'showTugas']);
Route::get('detail-tugas/{id_mt}', [UserStudentController::class, 'detailTugas']);
Route::post('upload-tugas', [UserStudentController::class, 'uploadTugas']);
Route::post('logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
