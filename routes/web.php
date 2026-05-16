<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\MatakuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. RUTE PUBLIK & GUEST (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// 2. RUTE TERPROTEKSI (Harus Login)
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Group MAHASISWA
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard_mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
        Route::get('/krs', [MahasiswaController::class, 'krs'])->name('mahasiswa.krs');
        Route::get('/khs', [MahasiswaController::class, 'khs'])->name('mahasiswa.khs');
        Route::get('/jadwal', [MahasiswaController::class, 'jadwal'])->name('mahasiswa.jadwal');
        Route::get('/booking', [MahasiswaController::class, 'booking'])->name('mahasiswa.booking');
        Route::post('/booking', [MahasiswaController::class, 'storeBooking'])->name('mahasiswa.booking.store');
        Route::delete('/booking/{id}/cancel', [MahasiswaController::class, 'cancelBooking'])->name('mahasiswa.booking.cancel');
    });

    // Group DOSEN
    Route::middleware('role:dosen')->prefix('dosen')->group(function () {
        Route::get('/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
        Route::get('/matakuliah', [DosenController::class, 'matakuliah'])->name('dosen.matakuliah');
        Route::get('/data_mahasiswa', [DosenController::class, 'dataMahasiswa'])->name('dosen.mahasiswa');
        Route::get('/absensi', [DosenController::class, 'absensi'])->name('dosen.absensi');
        Route::get('/nilai', [DosenController::class, 'nilai'])->name('dosen.nilai');
        Route::get('/jadwal_mengajar', [DosenController::class, 'jadwalMengajar'])->name('dosen.jadwal');
    });

    // Group ADMIN
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/data_mahasiswa', [AdminController::class, 'dataMahasiswa'])->name('admin.data_mahasiswa');
        Route::get('/data_dosen', [AdminController::class, 'dataDosen'])->name('admin.data_dosen');
        Route::get('/matakuliah', [AdminController::class, 'mataKuliah'])->name('admin.matakuliah');
        Route::get('/jadwal_kuliah', [AdminController::class, 'jadwalKuliah'])->name('admin.jadwal_kuliah');
        Route::get('/krs_mahasiswa', [AdminController::class, 'krsMahasiswa'])->name('admin.krs_mahasiswa');
        Route::get('/nilai_khs', [AdminController::class, 'nilaiKHS'])->name('admin.nilai_khs');
        Route::get('/booking', [AdminController::class, 'bookingIndex'])->name('admin.booking.index');
        Route::patch('/booking/{id}/update', [AdminController::class, 'updateStatus'])->name('admin.booking.update');
        Route::get('/manajemen_user', [AdminController::class, 'manajemenUser'])->name('admin.manajemen_user');
        Route::get('/pengaturan_sistem', [AdminController::class, 'pengaturanSistem'])->name('admin.pengaturan_sistem');
    });
});