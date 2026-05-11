<?php

use App\Http\Controllers\AuthController;
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

// AUTH ROUTES - Tidak memerlukan login
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// PROTECTED ROUTES - Memerlukan login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // MAHASISWA ROUTES
    Route::get('/dashboard_mahasiswa', function () {
        return view('mahasiswa.dashboard');
    })->middleware('role:mahasiswa');

    Route::get('/booking', function () {
        return view('mahasiswa.booking_ruangan');
    })->middleware('role:mahasiswa');

    Route::get('/krs', function () {
        return view('mahasiswa.krs');
    })->middleware('role:mahasiswa');

    Route::get('/khs', function () {
        return view('mahasiswa.khs');
    })->middleware('role:mahasiswa');

    Route::get('/jadwal_kuliah', function () {
        return view('mahasiswa.jadwal_kuliah');
    })->middleware('role:mahasiswa');

    // DOSEN ROUTES
    Route::get('/dashboard_dosen', function () {
        return view('dosen.dashboard');
    })->middleware('role:dosen');

    Route::get('/matakuliah', function () {
        return view('dosen.matakuliah');
    })->middleware('role:dosen');

    Route::get('/data_mahasiswa', function () {
        return view('dosen.data_mahasiswa');
    })->middleware('role:dosen');

    Route::get('/absensi_mahasiswa', function () {
        return view('dosen.absensi_mahasiswa');
    })->middleware('role:dosen');

    Route::get('/nilai', function () {
        return view('dosen.nilai');
    })->middleware('role:dosen');

    Route::get('/jadwal_mengajar', function () {
        return view('dosen.jadwal_mengajar');
    })->middleware('role:dosen');

    // ADMIN ROUTES
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->middleware('role:admin');
});