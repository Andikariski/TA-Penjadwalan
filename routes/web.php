<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\Dosen;
use App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\DaftarSempropController;
use App\Http\Controllers\DaftarPendadaranController;
// use App\Http\Controllers\SempropRegisterController;

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
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/emailcheck/{email}', [App\Http\Controllers\Controller::class, 'isEmailExist']);
Route::get('/otpcheck/{otp}/{email}', [App\Http\Controllers\Controller::class, 'isOTPExist']);
Route::get('/kirimemail', [App\Http\Controllers\Controller::class, 'sendEmails']);

Route::middleware(['auth', 'role:super_admin|dosen|mahasiswa'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
        Route::resource('topik', TopikController::class);
        Route::get('/penawaran/topiksaya', [PenawaranController::class, 'topiksaya'])->name('penawaran.topiksaya');
        Route::resource('penawaran', PenawaranController::class);
        Route::resource('logbook', LogbookController::class);
        Route::get('log/{id}', [LogbookController::class, 'log'])->name('log');
        Route::resource('daftar-semprop', DaftarSempropController::class);
        Route::resource('daftar-pendadaran', DaftarPendadaranController::class);
        Route::get('view_file/{id}', [DaftarSempropController::class, 'view_file'])->name('view_file');
});

Route::middleware(['auth', 'role:dosen|super_admin'])->group(function () {
        Route::resource('penelitian', Dosen\TopikController::class);
        Route::resource('mytopik', Dosen\DitawarkanController::class);
        Route::resource('bimbingan', Dosen\BimbinganController::class);
        Route::resource('penilaian-semprop', Dosen\PenilaianSempropPembimbingController::class);
        Route::resource('semprop-penguji', Dosen\PenilaianSempropPengujiController::class);
        Route::get('view/{id}', [Dosen\BimbinganController::class, 'view']);
        Route::post('/mytopik/ubah', [Dosen\DitawarkanController::class, 'edit'])->name('mytopik.ubah');

        Route::get('penilaian-pendadaran/{id}', [Dosen\PenilaianPendadaran::class, 'showPenilaianPendadaran']);
        Route::resource('nilai-pendadaran', Dosen\PenilaianPendadaran::class);

        Route::get('data-penilaian-pendadaran', [Dosen\PenilaianPendadaran::class, 'dataNilaianPenguji'])->name('nilai-pendadaran-penguji');
        // Route::get('pendadaran-penguji', Dosen\PenilaianPendadaran::class,'dataNilaianPenguji')->name('nilai-pendadaran-penguji')
        Route::get('nilai-pendadaran', [Dosen\PenilaianPendadaran::class, 'nilaiHasilUjian']);
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
        Route::resource('dosen', Superadmin\DosenController::class);
        Route::resource('setup', Superadmin\SetupController::class);
        Route::resource('skripsi', Superadmin\SkripsiMahasiswaController::class);
        Route::resource('pendadaran-register', Superadmin\PendadaranRegisterController::class);
        Route::resource('semprop-register', Superadmin\SempropRegisterController::class);
        Route::get('detail_file/{id}', [Superadmin\SempropRegisterController::class, 'detail_file'])->name('detail_file');

        Route::get('/data-mahasiswa', [Superadmin\SetupController::class, 'getDataMahasiswa']);
        Route::post('import-data-mahasiswa', [Superadmin\SetupController::class, 'importDataMahasiswa'])->name('importDataMahasiswa');


        // Route Fitur Jadwal Dosen
        Route::get('/jadwalDosen', [Superadmin\DosenController::class, 'jadwalDosen'])->name('jadwalDosen');
        Route::post('importJadwalDosen', [Superadmin\DosenController::class, 'importJadwalDosenExcel'])->name('importJadwalDosen');
        Route::get('tambahJadwalDosen', [Superadmin\DosenController::class, 'addJadwalDosen'])->name('tambahJadwalDosen');
        Route::post('store/{any}', [Superadmin\DosenController::class, 'storeJadwalDosen'])->name('simpanJadwalDosen');
        route::get('update/{id}', [Superadmin\DosenController::class, 'updateJadwalDosen'])->name('updateJadwalDosen');

        // Route Fitur Penjadwalan Semprop & Pendadaran
        Route::get('dataMahasiswa', [Superadmin\PenjadwalanController::class, 'dataMahasiswa'])->name('dataMahasiswa');
        Route::get('detailMahasiswa/{id}', [Superadmin\PenjadwalanController::class, 'detailMahasiswa'])->name('detailMahasiswa');
        Route::get('jadwal-Semprop/{id}', [Superadmin\PenjadwalanController::class, 'jadwalSempropByid'])->name('jadwal.SempropByid');
        Route::get('jadwal-Pendadaran/{id}', [Superadmin\PenjadwalanController::class, 'jadwalPendadaranById'])->name('jadwal.PendadaranByid');

        Route::get('jadwal-kosong-pendadaran', [Superadmin\PenjadwalanController::class, 'generateJadwalPendadaran']);
        Route::get('jadwal-kosong-semprop', [Superadmin\PenjadwalanController::class, 'generateJadwalSemprop']);
        Route::post('storePenjadwalan/{any}', [Superadmin\PenjadwalanController::class, 'storeJadwalSempropDanPendadaran'])->name('store.penjadwalan');
        Route::get('dataPenjadwalan', [Superadmin\PenjadwalanController::class, 'dataPenjadwalan'])->name('dataPenjadwalan');
        Route::get('detailPenjadwalanById/{id}', [Superadmin\PenjadwalanController::class, 'detailDataPenjadwalan'])->name('detail.penjadwalan');
        Route::get('deleteJadwal{id}', [Superadmin\PenjadwalanController::class, 'deleteJadwal'])->name('hapus.jadwal');

        Route::get('updateJadwalUjian-semprop/{id}', [Superadmin\PenjadwalanController::class, 'updateJadwalSemprop'])->name('update.semprop');
        Route::get('updateJadwalUjian-pendadaran/{id}', [Superadmin\PenjadwalanController::class, 'updateJadwalPendadaran'])->name('update.pendadaran');
        Route::put('simpanJadwalTerupdate/{id}', [Superadmin\PenjadwalanController::class, 'simpanJadwalTerupdate']);
        Route::get('tesEmail', [Superadmin\PenjadwalanController::class, 'tesEmail']);

        // Route setup link google meet
        Route::get('linkGoogleMeet', [Superadmin\SetupController::class, 'getlinkGoogleMeet'])->name('linkgooglemeet');
        Route::post('storeLink', [Superadmin\SetupController::class, 'storeGoogleMeet'])->name('simpanLinkGoogleMeet');
        Route::get('delete{id}', [Superadmin\SetupController::class, 'deleteLinkGoogleMeet'])->name('hapus.link');

        //Route untuk Testing
        Route::get('tesFungsi', [Superadmin\PenjadwalanController::class, 'jadwalPendadaranById']);
});

Route::get('/google/auth', function () {
        return view('auth.google');
});
