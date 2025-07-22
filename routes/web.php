<?php

use App\Models\SiswaModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [DashboardController::class, 'dashboardAdmin'])->name('dashboard.admin');
        // Data Siswa
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
        Route::delete('/siswa/{id}', [SiswaController::class, 'delete'])->name('siswa.delete');
        Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
        Route::get('/siswa/import/template', [SiswaController::class, 'downloadTemplate'])->name('siswa.import.template');
        Route::delete('/siswa/delete/all', [SiswaController::class, 'deleteAll'])->name('siswa.delete.all');

        // Data Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas/store', [KelasController::class, 'store'])->name('kelas.store');
        Route::delete('/kelas/{id}', [KelasController::class, 'delete'])->name('kelas.delete');
        Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');

        // Data Petugas
        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::post('/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
        Route::delete('/petugas/{id}', [PetugasController::class, 'delete'])->name('petugas.delete');

        // Kategori pembayaran
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::delete('/kategori/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
        Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');

        // Input Pembayaran
        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/get-siswa-by-kelas/{kelasId}', [PembayaranController::class, 'getSiswaByKelas'])->name('get.siswa.by.kelas');
        Route::get('/pembayaran/kwitansi/{id}', [PembayaranController::class, 'kwitansi'])
            ->name('pembayaran.kwitansi');

        // Riwayat Pembayaran
        Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    });

    Route::get('/petugas', function () {
        return view('petugas.dashboard');
    })->name('dashboard.petugas');
});
