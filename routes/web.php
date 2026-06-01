<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;

// Controller Sub-Folder Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\MatakuliahController;
use App\Http\Controllers\Admin\JadwalKuliahController;
use App\Http\Controllers\Admin\DosenController as AdminJalurDosenController;
use App\Http\Controllers\Admin\MahasiswaController as AdminJalurMahasiswaController;
use App\Http\Controllers\Admin\KrsAdminController;
use App\Http\Controllers\Admin\NilaiKhsController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\Admin\PengaturanSistemController;

// Controller Sub-Folder Mahasiswa (Dinamis)
use App\Http\Controllers\Mahasiswa\JadwalKuliahController as MahasiswaJadwalController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sistem Informasi Akademik (SIAKAD)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTE GUEST & AUTENTIKASI
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// ==========================================
// 2. RUTE TERPROTEKSI: ROLE ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // 🏁 Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // 🏛️ Master Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('admin.ruangan.index');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('admin.ruangan.store');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('admin.ruangan.update'); // 💡 Ditambahkan perlindungan update
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('admin.ruangan.destroy');

    // 📝 Master Mata Kuliah (Mendukung legacy & .index)
    Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('admin.matakuliah.index');
    Route::get('/matakuliah_legacy', [MatakuliahController::class, 'index'])->name('admin.matakuliah');
    Route::post('/matakuliah', [MatakuliahController::class, 'store'])->name('admin.matakuliah.store');
    Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('admin.matakuliah.update'); // 💡 SOLUSI ERROR UPDATE MK
    Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('admin.matakuliah.destroy');

    // 📅 Master Jadwal Kuliah (Mendukung legacy & .index)
    Route::get('/jadwal_kuliah', [JadwalKuliahController::class, 'index'])->name('admin.jadwal_kuliah.index');
    Route::get('/jadwal_kuliah_legacy', [JadwalKuliahController::class, 'index'])->name('admin.jadwal_kuliah');
    Route::post('/jadwal_kuliah', [JadwalKuliahController::class, 'store'])->name('admin.jadwal_kuliah.store');
    Route::put('/jadwal_kuliah/{id}', [JadwalKuliahController::class, 'update'])->name('admin.jadwal_kuliah.update');
    Route::delete('/jadwal_kuliah/{id}', [JadwalKuliahController::class, 'destroy'])->name('admin.jadwal_kuliah.destroy');

    // 👨‍🏫 Manajemen Civitas Akademika: Dosen
    Route::get('/data_dosen', [AdminJalurDosenController::class, 'index'])->name('admin.data_dosen');
    Route::post('/data_dosen', [AdminJalurDosenController::class, 'store'])->name('admin.data_dosen.store');
    Route::put('/data_dosen/{id}', [AdminJalurDosenController::class, 'update'])->name('admin.data_dosen.update');
    Route::delete('/data_dosen/{id}', [AdminJalurDosenController::class, 'destroy'])->name('admin.data_dosen.destroy');

    // 👨‍🎓 Manajemen Civitas Akademika: Mahasiswa
    Route::get('/data_mahasiswa', [AdminJalurMahasiswaController::class, 'index'])->name('admin.data_mahasiswa');
    Route::post('/data_mahasiswa', [AdminJalurMahasiswaController::class, 'store'])->name('admin.data_mahasiswa.store');
    Route::put('/data_mahasiswa/{id}', [AdminJalurMahasiswaController::class, 'update'])->name('admin.data_mahasiswa.update');
    Route::delete('/data_mahasiswa/{id}', [AdminJalurMahasiswaController::class, 'destroy'])->name('admin.data_mahasiswa.destroy');

    // 🚪 Layanan Operasional: Booking Ruangan (Diselaraskan dengan AdminController)
    Route::get('/booking', [AdminController::class, 'bookingIndex'])->name('admin.booking.index');
    Route::get('/booking_legacy', [AdminController::class, 'bookingIndex'])->name('admin.booking');
    Route::patch('/booking/{id}/update', [AdminController::class, 'updateStatus'])->name('admin.booking.update');

    // 📋 Layanan Operasional: KRS Mahasiswa
    Route::get('/krs_mahasiswa', [KrsAdminController::class, 'index'])->name('admin.krs_mahasiswa.index');
    Route::get('/krs_mahasiswa_legacy', [KrsAdminController::class, 'index'])->name('admin.krs_mahasiswa');
    Route::post('/krs_mahasiswa', [KrsAdminController::class, 'store'])->name('admin.krs_mahasiswa.store');
    Route::delete('/krs_mahasiswa/{mahasiswa_id}', [KrsAdminController::class, 'destroy'])->name('admin.krs_mahasiswa.destroy');
    Route::put('/krs_mahasiswa/{mahasiswa_id}/update_status', [KrsAdminController::class, 'updateStatus'])->name('admin.krs_mahasiswa.updateStatus');

    // 📊 Layanan Operasional: KHS Nilai
    Route::get('/nilai_khs', [NilaiKhsController::class, 'index'])->name('admin.nilai_khs.index');
    Route::get('/nilai_khs_legacy', [NilaiKhsController::class, 'index'])->name('admin.nilai_khs');
    Route::post('/nilai_khs', [NilaiKhsController::class, 'store'])->name('admin.nilai_khs.store');
    Route::delete('/nilai_khs/{id}', [NilaiKhsController::class, 'destroy'])->name('admin.nilai_khs.destroy');

    // 👤 Kontrol & Konfigurasi User
    Route::get('/manajemen_user', [ManajemenUserController::class, 'index'])->name('admin.manajemen_user');
    Route::post('/manajemen_user', [ManajemenUserController::class, 'store'])->name('admin.manajemen_user.store');
    Route::put('/manajemen_user/{id}', [ManajemenUserController::class, 'update'])->name('admin.manajemen_user.update');
    Route::delete('/manajemen_user/{id}', [ManajemenUserController::class, 'destroy'])->name('admin.manajemen_user.destroy');

    // ⚙️ Konfigurasi Sistem & Tombol Clear Cache
    Route::get('/pengaturan_sistem', [PengaturanSistemController::class, 'index'])->name('admin.pengaturan_sistem');
    Route::post('/pengaturan_sistem', [PengaturanSistemController::class, 'update'])->name('admin.pengaturan_sistem.update');

    // 💡 SOLUSI ERROR CLEAR CACHE: Mengarahkan langsung ke method di PengaturanSistemController
    Route::post('/pengaturan_sistem/clear-cache', [PengaturanSistemController::class, 'clearCache'])->name('admin.pengaturan_sistem.clearCache');
});


// ==========================================
// 3. RUTE TERPROTEKSI: ROLE MAHASISWA
// ==========================================
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->group(function () {

    // 🏁 Fitur 1: Dashboard Utama Mahasiswa
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');

    // 📅 Fitur 2: Jadwal Kuliah (SOLUSI KUNCI SINKRONISASI TOTAL)
    // Kita kunci kedua nama rute ini agar semuanya diproses oleh MahasiswaJadwalController yang dinamis!
    Route::get('/jadwal', [MahasiswaJadwalController::class, 'index'])->name('mahasiswa.jadwal');
    Route::get('/jadwal_kuliah', [MahasiswaJadwalController::class, 'index'])->name('mahasiswa.jadwal_kuliah');

    // 📝 Fitur 3: Pengisian KRS Online
    Route::get('/mahasiswa/krs', [MahasiswaController::class, 'krs'])->name('mahasiswa.krs');
    Route::post('/mahasiswa/krs/simpan', [MahasiswaController::class, 'storeKrs'])->name('mahasiswa.krs.store');

    // 📊 Fitur 4: KHS & Hasil Nilai Akademik
    Route::get('/khs', [MahasiswaController::class, 'khs'])->name('mahasiswa.khs');

    // 🏛️ Fitur Tambahan: Booking Ruangan Sisi Mahasiswa
    Route::get('/booking', [MahasiswaController::class, 'booking'])->name('mahasiswa.booking');
    Route::post('/booking', [MahasiswaController::class, 'storeBooking'])->name('mahasiswa.booking.store');
    Route::delete('/booking/{id}/cancel', [MahasiswaController::class, 'cancelBooking'])->name('mahasiswa.booking.cancel');
});


// ==========================================
// 4. RUTE TERPROTEKSI: ROLE DOSEN 
// ==========================================
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->group(function () {

    // 🏠 Dashboard Utama Dosen
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');

    // 📅 Rute Jadwal Mengajar Dosen (💡 Diarahkan ke method jadwalMengajar & nama disamakan dengan sidebar)
    Route::get('/jadwal', [DosenController::class, 'jadwalMengajar'])->name('dosen.jadwal');
    Route::get('/jadwal_legacy', [DosenController::class, 'jadwalMengajar'])->name('dosen.jadwal_mengajar');
    Route::post('/jadwal/simpan', [DosenController::class, 'storeJadwal'])->name('dosen.jadwal.store');

    // 📝 Rute Mata Kuliah Dosen (💡 Diarahkan ke method matakuliah sesuai isi DosenController)
    Route::get('/matakuliah', [DosenController::class, 'matakuliah'])->name('dosen.matakuliah');
    Route::post('/matakuliah/simpan', [DosenController::class, 'storeMatakuliah'])->name('dosen.matakuliah.store');

    // 👥 Rute Daftar Mahasiswa (💡 Diarahkan ke method dataMahasiswa sesuai isi DosenController)
    Route::get('/mahasiswa', [DosenController::class, 'dataMahasiswa'])->name('dosen.mahasiswa');
    Route::post('/mahasiswa/approve/{id}', [DosenController::class, 'approveKrs'])->name('dosen.mahasiswa.approve');
    Route::post('/mahasiswa/reject/{id}', [DosenController::class, 'rejectKrs'])->name('dosen.mahasiswa.reject');

    // 📋 Rute Absensi / Presensi Mahasiswa oleh Dosen (💡 Diarahkan ke method absensi sesuai isi DosenController)
    Route::get('/absensi', [DosenController::class, 'absensi'])->name('dosen.absensi');
    Route::get('/absensi/kelas/{jadwal_id}', [DosenController::class, 'absensiKelas'])->name('dosen.absensi.kelas');
    Route::post('/absensi/pertemuan/simpan', [DosenController::class, 'storePertemuan'])->name('dosen.absensi.pertemuan.store');
    Route::post('/absensi/simpan', [DosenController::class, 'storeAbsensi'])->name('dosen.absensi.store');

    // 📊 Rute Manajemen Input Nilai KHS (Sesuai Struktur Kamu)
    Route::get('/nilai', [DosenController::class, 'nilai'])->name('dosen.nilai');
    Route::get('/nilai_index', [DosenController::class, 'indexNilai'])->name('dosen.nilai.index');
    Route::get('/nilai/kelas/{jadwal_id}', [DosenController::class, 'inputNilai'])->name('dosen.nilai.input');
    Route::post('/nilai/simpan', [DosenController::class, 'storeNilai'])->name('dosen.nilai.store');
    Route::delete('/nilai/hapus/{id}', [DosenController::class, 'destroyNilai'])->name('dosen.nilai.destroy');
});
