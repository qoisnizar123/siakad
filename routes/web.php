<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

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

// Rute Publik (Landing Page)
Route::get('/', function () {
    return view('login');
});

// Rute Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group MAHASISWA
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/krs', [MahasiswaController::class, 'krs'])->name('mahasiswa.krs');
    Route::get('/khs', [MahasiswaController::class, 'khs'])->name('mahasiswa.khs');
    Route::get('/jadwal', [MahasiswaController::class, 'jadwal'])->name('mahasiswa.jadwal');
    Route::get('/booking', [MahasiswaController::class, 'booking'])->name('mahasiswa.booking');
});

// Group DOSEN
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->group(function () {
    Route::get('/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/matakuliah', [DosenController::class, 'matakuliah'])->name('dosen.matakuliah');
    Route::get('/data-mahasiswa', [DosenController::class, 'dataMahasiswa'])->name('dosen.mahasiswa');
    Route::get('/absensi', [DosenController::class, 'absensi'])->name('dosen.absensi');
    Route::get('/nilai', [DosenController::class, 'nilai'])->name('dosen.nilai');
    Route::get('/jadwal-mengajar', [DosenController::class, 'jadwalMengajar'])->name('dosen.jadwal');
});

// Group ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
