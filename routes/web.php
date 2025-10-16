<?php

use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index']);
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/attemptLogin', [LoginController::class, 'attemptLogin'])->name('login.attemptLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

// Route::get('/home', [HomeController::class, 'index']);
// Route::get('/prodi', [ProdiController::class, 'index']);

// Route::get('/inbound', [HomeController::class, 'inbound']);
// Route::get('/outbound', [HomeController::class, 'outbound']);
// Route::get('/pendaftaran', [AktivitasController::class, 'pendaftaran']);
// Route::get('/konversi_mk', [AktivitasController::class, 'konversi_krs']);
// Route::get('/histori_aktivitas', [AktivitasController::class, 'his_aktivitas']);

Route::group(['prefix' => 'aktivitas', 'as' => 'aktivitas.'], function() {
    Route::get('/', [AktivitasController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [AktivitasController::class, 'edit'])->name('edit');
    Route::post('simpan', [AktivitasController::class, 'simpan'])->name('simpan');
    Route::delete('/{id}', [AktivitasController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa.'], function() {
    Route::get('/', [MahasiswaController::class, 'index'])->name('index');
    Route::get('/pendaftaran', [MahasiswaController::class, 'pendaftaran'])->name('pendaftaran');
    Route::get('/konversi_mk', [MahasiswaController::class, 'konversi_mk'])->name('konversi_mk');
    Route::get('/histori_aktivitas', [MahasiswaController::class, 'histori_aktivitas'])->name('histori_aktivitas');
    Route::post('store', [MahasiswaController::class, 'store'])->name('store');
    Route::delete('deleteAktivitas/{id}', [MahasiswaController::class, 'deleteAktivitas'])->name('deleteAktivitas');

});

Route::group(['prefix' => 'prodi', 'as' => 'prodi.'], function() {
    Route::get('/', [ProdiController::class, 'index'])->name('index');
    Route::post('addAktivitas', [ProdiController::class, 'addAktivitas'])->name('addAktivitas');
    Route::post('addPembimbing', [ProdiController::class, 'addPembimbing'])->name('addPembimbing');
    Route::post('addPenguji', [ProdiController::class, 'addPenguji'])->name('addPenguji');
    Route::post('addKonversiMK', [ProdiController::class, 'addKonversiMK'])->name('addKonversiMK');
    Route::delete('deleteKonversiMK/{id}', [ProdiController::class, 'deleteKonversiMK'])->name('deleteKonversiMK');
    Route::delete('deleteDosenPenguji/{id}', [ProdiController::class, 'deleteDosenPenguji'])->name('deleteDosenPenguji');
    Route::delete('deleteDosenPembimbing/{id}', [ProdiController::class, 'deleteDosenPembimbing'])->name('deleteDosenPembimbing');
    Route::delete('deletePeserta/{id}', [ProdiController::class, 'deletePeserta'])->name('deletePeserta');

    Route::delete('deleteAktivitas/{id}', [ProdiController::class, 'deleteAktivitas'])->name('deleteAktivitas');
    Route::get('/aktivitasMBKM', [ProdiController::class, 'aktivitas'])->name('aktivitasMBKM');
    Route::get('/detilAktivitas/{id}', [ProdiController::class, 'detilAktivitas'])->name('detilAktivitas');
    Route::get('/pesertaAktivitas/{id}', [ProdiController::class, 'pesertaAktivitas'])->name('pesertaAktivitas');
    Route::get('/paketMK', [ProdiController::class, 'paket'])->name('paketMK');
    Route::get('/{aktivitas_id}/list', [ProdiController::class, 'list'])->name('list');
    Route::get('/konversiAktivitas', [ProdiController::class, 'konversiAktivitas'])->name('konversiAktivitas');
    Route::get('/konversiPermata', [ProdiController::class, 'konversiPermata'])->name('konversiPermata');
    Route::get('/edit/{id}', [ProdiController::class, 'editAktivitas'])->name('edit');
    // Route::get('/aktivMhs', [ProdiController::class, 'aktivitasMhs'])->name('aktivMhs');
    
});