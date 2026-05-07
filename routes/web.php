<?php

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

Route::get('/', function () {
    return view('login');
});

Route::get('/mahasiswa', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/booking', function () {
    return view('mahasiswa.booking_ruangan');
});

Route::get('/krs', function () {
    return view('mahasiswa.krs');
});

Route::get('/dosen', function () {
    return view('dosen.dashboard');
});

Route::get('/matakuliah', function () {
    return view('dosen.matakuliah');
});