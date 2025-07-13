<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

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
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    });

    Route::get('/petugas', function () {
        return view('petugas.dashboard');
    })->name('dashboard.petugas');
});
