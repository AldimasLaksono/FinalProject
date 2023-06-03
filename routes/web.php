<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\PlotmapController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Admin\PeriodClassController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\RuangController;
use App\Http\Controllers\Admin\GedungController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Guru\MateriController;
use App\Http\Controllers\Guru\tugascontroll;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman login
Route::redirect('/', 'login');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// Rute untuk proses logout
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['CheckLogin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard2', [HomeController::class, 'dashboard2'])->name('dashboard2');

    Route::controller(ProfilController::class)->prefix('Profile')->group(function () {
        Route::get('', 'show_profile')->name('profile');
        Route::post('updatePassword', 'updatePassword')->name('updatePassword');
        Route::post('update_guru', 'update_guru')->name('update_guru');
        Route::post('update_photo', 'updatePhoto')->name('update_photo');
        Route::get('/profile/photo', 'getProfilePhoto')->name('getProfilePhoto');
    });

    Route::controller(SiswaController::class)->prefix('UserStudent')->group(function () {
        Route::get('', 'show_data')->name('data_siswa');
        Route::get('input-data', 'inputform')->name('input_data');
        Route::post('inputData', 'inputData')->name('inputData');
        Route::get('updateform/{id_mus}', 'updateform')->name('updateform');
        Route::post('updateData/{id_mus}', 'updateData')->name('updateData');
        Route::post('import', 'import')->name('import');
        Route::delete('deleteData/{id_mus}', 'deleteData')->name('deleteData');
    });
    
    Route::controller(GuruController::class)->prefix('UserTeacher')->group(function () {
        Route::get('', 'show_guru')->name('data_guru');
        Route::get('formGuru', 'inputform')->name('formGuru');
        Route::post('inputGuru', 'inputData')->name('inputGuru');
        Route::get('updateform_guru/{id_mut}', 'updateform_guru')->name('updateform_guru');
        Route::post('updateData_guru/{id_mut}', 'updateData_guru')->name('updateData_guru');
        Route::post('importGuru', 'importGuru')->name('importGuru');
        Route::delete('deleteData_guru/{id_mut}', 'deleteData_guru')->name('deleteData_guru');
    });
    
    Route::controller(JabatanController::class)->prefix('Jabatan')->group(function () {
        Route::get('', 'show_datajbt')->name('show_datajbt');
        Route::post('input_datajbt', 'input_datajbt')->name('input_datajbt');
        Route::delete('delete_datajbt/{id_mja}', 'delete_datajbt')->name('delete_datajbt');
    });
    
    Route::controller(MapelController::class)->prefix('Mapel')->group(function () {
        Route::get('', 'show_datamm')->name('show_datamm');
        Route::post('input_datamm', 'input_datamm')->name('input_datamm');
        Route::delete('delete_datamm/{id_mm}', 'delete_datamm')->name('delete_datamm');
    });
    
    Route::controller(PlotmapController::class)->prefix('PlotMapel')->group(function () {
        Route::get('', 'show_datatm')->name('show_datatm');
        Route::post('input_datatm', 'input_datatm')->name('input_datatm');
        Route::get('updateform_plotmap/{id_tm}', 'updateform_plotmap')->name('updateform_plotmap');
        Route::post('updateData_plotmap/{id_tm}', 'updateData_plotmap')->name('updateData_plotmap');
        Route::delete('delete_datatm/{id_tm}', 'delete_datatm')->name('delete_datatm');
    });
    
    Route::controller(PeriodController::class)->prefix('Period')->group(function () {
        Route::get('', 'show_period')->name('show_period');
        Route::post('input_period', 'input_period')->name('input_period');
        Route::delete('delete_period/{id_mper}', 'delete_period')->name('delete_period');
        Route::put('update-status/{id_mper}', 'updateStatus')->name('update-status');
    });
    
    Route::controller(PeriodClassController::class)->prefix('PeriodClass')->group(function () {
        Route::get('', 'show_perclass')->name('show_perclass');
        Route::post('input_perclass', 'input_perclass')->name('input_perclass');
        Route::get('updateform_perclass/{id_tpc}', 'updateform_perclass')->name('updateform_perclass');
        Route::post('updateData_perclass/{id_tpc}', 'updateData_perclass')->name('updateData_perclass');
        Route::delete('delete_perclass/{id_tpc}', 'delete_perclass')->name('delete_perclass');
    });
    
    Route::controller(ClassController::class)->prefix('Class_Mapel')->group(function () {
        Route::get('', 'show_class')->name('show_class');
        Route::post('input_class', 'input_class')->name('input_class');
        Route::get('updateform_class/{id_tc}', 'updateform_class')->name('updateform_class');
        Route::post('updateData_class/{id_tc}', 'updateData_class')->name('updateData_class');
        Route::delete('delete_class/{id_tc}', 'delete_class')->name('delete_class');
    });
    
    Route::controller(RuangController::class)->prefix('Ruang')->group(function () {
        Route::get('', 'show_ruang')->name('show_ruang');
        Route::post('input_ruang', 'input_ruang')->name('input_ruang');
        Route::delete('delete_ruang/{id_mr}', 'delete_ruang')->name('delete_ruang');
    });
    
    Route::controller(GedungController::class)->prefix('Gedung')->group(function () {
        Route::get('', 'show_gedung')->name('show_gedung');
        Route::post('input_gedung', 'input_gedung')->name('input_gedung');
        Route::delete('delete_gedung/{id_mg}', 'delete_gedung')->name('delete_gedung');
    });
    
    Route::get('show_dataLog', [LogController::class, 'show_data'])->name('show_dataLog');
    Route::get('show_presensi', [PresensiController::class, 'show_presensi'])->name('show_presensi');


    //ROLE GURU

    Route::controller(MateriController::class)->prefix('Materi_Ajar')->group(function () {
        Route::get('', 'show_mapelajar')->name('show_mapelajar');
        Route::get('show_materi/{id_tm}', 'show_materiajar')->name('show_materi');
        Route::post('tambah_materi/{id_tm}', 'store')->name('tambah_materi');
        Route::delete('delete_materi/{id_tmat}', 'delete_materi')->name('delete_materi');
        Route::get('/download-gambar/{filename}', 'downloadGambar')->name('download_gambar');
        Route::get('/download-file/{filename}', 'downloadFile')->name('download_file');
    });

    Route::controller(tugascontroll::class)->prefix('datatugas')->group(function () {
        Route::get('', 'showtugas')->name('showtugas');
        Route::post('create_tugas', 'create_tugas')->name('create_tugas');
        Route::delete('delete_tugas/{id_mt}', 'delete_tugas')->name('delete_tugas');
        Route::get('/download-gambar/{filename}', 'downloadGambar')->name('download.gambar');
        Route::get('/download-file/{filename}', 'downloadFile')->name('download.file');
        Route::get('/detail/{id_mt}', 'showDetailTugas')->name('detail_tugas');
        Route::get('/download-jawaban/{filename}', 'downloadjawaban')->name('download.jawaban');
        Route::post('/input-nilai', 'inputNilai')->name('input.nilai');
    });

    
});









