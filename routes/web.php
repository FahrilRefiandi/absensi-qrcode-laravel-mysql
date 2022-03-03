<?php

use App\Http\Controllers\Backend\absensiController as BackendAbsensiController;
use App\Http\Controllers\Backend\AbsensiPegawaiController;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Backend\JabatanController;
use App\Http\Controllers\Backend\LaporanController;
use App\Http\Controllers\Backend\pegawaiController;
use App\Http\Controllers\Backend\PengaturanController;
use App\Http\Controllers\Backend\PerizinanController;
use App\Http\Controllers\Backend\profil;
use App\Http\Controllers\frontend\absensiController;
use App\Http\Controllers\frontend\homeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\usersController;
use App\Http\Controllers\DownloadFileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [homeController::class,'index']);

Route::get('/absensi_masuk', [homeController::class,'absensiMasuk']);
Route::get('/absensi_keluar', [homeController::class,'absensiKeluar']);





// absensi
Route::get('/absensi_masuk/{token}', [absensiController::class,'absensiMasuk'])->middleware('auth');
Route::get('/absensi_keluar/{token}', [absensiController::class,'absensiKeluar'])->middleware('auth');
// absensi

// backend
Route::get('/dashboard', [dashboardController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('/absensi', [BackendAbsensiController::class,'index'])->middleware(['auth']);
Route::post('/absensi', [BackendAbsensiController::class,'index'])->middleware(['auth']);
Route::get('/tunjangan', [BackendAbsensiController::class,'tunjangan'])->middleware(['auth']);

Route::resource('/profil', profil::class)->middleware('auth');
// admin
Route::resource('/pegawai', pegawaiController::class)->middleware('admin');
Route::resource('/users', usersController::class)->middleware('admin');
Route::resource('/pengaturan', PengaturanController::class)->middleware('admin');
Route::post('/users-level/{id}', [usersController::class,'usersLevel'])->middleware('admin');
Route::resource('/absensi-pegawai', AbsensiPegawaiController::class)->middleware('admin');
Route::post('/absensi-pegawai/{id}', [AbsensiPegawaiController::class,'show'])->middleware('admin');

Route::get('/laporan-presensi-harian', [LaporanController::class,'laporanAbsensiHarian'])->middleware('admin');
Route::post('/laporan-presensi-harian', [LaporanController::class,'laporanAbsensiHarian'])->middleware('admin');
Route::get('/laporan-presensi-harian/print/{tgl}', [LaporanController::class,'laporanAbsensiHarianPrint'])->middleware('admin');

Route::get('/laporan-presensi-bulanan', [LaporanController::class,'laporanAbsensiBulanan'])->middleware('admin');
Route::post('/laporan-presensi-bulanan', [LaporanController::class,'laporanAbsensiBulanan'])->middleware('admin');
Route::get('/laporan-presensi-bulanan/print/{tgl}', [LaporanController::class,'laporanAbsensiBulananPrint'])->middleware('admin');

// Route::get('/laporan-pendapatan', [LaporanController::class,'laporanPendapatan'])->middleware('admin');

Route::get('/pengajuan-izin', [PerizinanController::class,'pengajuanIzin'])->middleware('auth');
Route::post('/pengajuan-izin', [PerizinanController::class,'store'])->middleware('auth');
Route::get('/perizinan', [PerizinanController::class,'index'])->middleware('admin');

Route::post('/perizinan/acc', [PerizinanController::class,'acc'])->middleware('admin');
Route::post('/perizinan/tolak', [PerizinanController::class,'tolak'])->middleware('admin');

Route::resource('/jabatan', JabatanController::class)->middleware('admin');
// admin
// backend

Route::post('/download',[DownloadFileController::class,'dowloadBuktiIzin']);

require __DIR__.'/auth.php';
