<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\JadwalKuliah;
use App\Models\Krs;
use App\Models\Khs;
use App\Models\Absensi;
use App\Models\Pertemuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DosenController extends Controller
{
    // === Fitur Dashboard Dosen ===
    public function dashboard()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        
        $totalMk = 0;
        $totalMahasiswa = 0;
        $totalPertemuan = 0;
        $rataRataNilai = 0;
        $jadwals = collect();
        $aktivitasTerbaru = collect();

        if ($dosen) {
            // Ambil semua ID Jadwal & ID Mata Kuliah milik dosen
            $jadwalIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('id');
            $mkIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('mata_kuliah_id')->unique();

            // 1. Hitung Total Mata Kuliah
            $totalMk = $mkIds->count();
            
            // 2. Hitung Total Mahasiswa Unik dari KRS yang 'Disetujui'
            $totalMahasiswa = Krs::whereIn('mata_kuliah_id', $mkIds)
                ->where('status', 'Disetujui')
                ->distinct('mahasiswa_id')
                ->count('mahasiswa_id');

            // 3. Hitung Total Pertemuan Absensi yang sudah dibuat
            $totalPertemuan = Pertemuan::whereIn('jadwal_id', $jadwalIds)->count();

            // 4. Jadwal Mengajar (Ambil 5 jadwal untuk preview di tabel dashboard)
            $jadwals = JadwalKuliah::with(['matakuliah'])
                ->where('dosen_id', $dosen->id)
                ->orderBy('hari', 'asc')
                ->limit(5)
                ->get();
                
            // 5. Aktivitas Terbaru (Mengambil 3 riwayat pembuatan pertemuan/absensi terakhir)
            $aktivitasTerbaru = Pertemuan::with('jadwal.matakuliah')
                ->whereIn('jadwal_id', $jadwalIds)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        }

        return view('dosen.dashboard', compact(
            'dosen', 'totalMk', 'totalMahasiswa', 'totalPertemuan', 'rataRataNilai', 'jadwals', 'aktivitasTerbaru'
        ));
    }

    // === Fitur Jadwal Mengajar ===
    public function jadwalMengajar(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = collect();
        $jadwalHariIni = collect();
        
        $totalJadwal = 0;
        $jadwalHariIniCount = 0;
        $kelasOnlineCount = 0;

        // Logika Penentuan Hari & Judul Dinamis Berdasarkan Filter
        $hariRealTime = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd'); 
        $filterHari = $request->input('hari', 'Semua Hari'); 

        if ($filterHari != 'Semua Hari') {
            $judulJadwalBawah = "Jadwal Hari Ini (" . $filterHari . ")";
            $hariPencarianCard = $filterHari;
        } else {
            $judulJadwalBawah = "Jadwal Hari Ini";
            $hariPencarianCard = $hariRealTime; 
        }

        if ($dosen) {
            // 1. Query untuk Tabel Tengah (Berdasarkan Filter)
            $query = JadwalKuliah::with(['matakuliah'])->where('dosen_id', $dosen->id);
            if ($filterHari != 'Semua Hari') {
                $query->where('hari', $filterHari);
            }
            $jadwals = $query->orderBy('hari', 'asc')->orderBy('jam_mulai', 'asc')->get();

            // Hitung Statistik Dasar
            $totalJadwal = JadwalKuliah::where('dosen_id', $dosen->id)->count();
            $kelasOnlineCount = JadwalKuliah::where('dosen_id', $dosen->id)->where('metode', 'Online')->count();
            
            // 2. Query untuk Card Bawah
            $jadwalHariIni = JadwalKuliah::with(['matakuliah'])
                ->where('dosen_id', $dosen->id)
                ->where('hari', $hariPencarianCard)
                ->orderBy('jam_mulai', 'asc')
                ->get();
            $jadwalHariIniCount = $jadwalHariIni->count();
        }

        // Ambil daftar mata kuliah dosen ini untuk opsi dropdown/modal
        $mataKuliahOptions = JadwalKuliah::with('matakuliah')->where('dosen_id', $dosen->id ?? 0)->get()->unique('mata_kuliah_id');

        return view('dosen.jadwal_mengajar', compact(
            'dosen', 'jadwals', 'totalJadwal', 'jadwalHariIniCount', 
            'kelasOnlineCount', 'jadwalHariIni', 'judulJadwalBawah', 'mataKuliahOptions'
        ));
    }

    // Proses Tambah Jadwal Baru
    public function storeJadwal(Request $request)
    {
        $request->validate([
            'mata_kuliah_id' => 'required',
            'kelas' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required|string',
            'metode' => 'required|string',
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->first();

        JadwalKuliah::create([
            'dosen_id' => $dosen->id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
            'metode' => $request->metode,
        ]);

        return redirect()->back()->with('success', 'Jadwal mengajar baru berhasil ditambahkan.');
    }

    // === Fitur Penilaian Mahasiswa ===
    
    // Halaman Utama Rekapitulasi Nilai
    public function nilai()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $khsRecords = collect();
        $jadwals = collect();

        if ($dosen) {
            // Ambil semua kelas/jadwal yang diampu oleh dosen ini
            $jadwals = JadwalKuliah::with('matakuliah')
                ->where('dosen_id', $dosen->id)
                ->get();

            $mataKuliahIds = $jadwals->pluck('mata_kuliah_id');

            // Ambil rekap data KHS mahasiswa
            $khsRecords = Khs::with(['mahasiswa', 'matakuliah'])
                ->whereIn('mata_kuliah_id', $mataKuliahIds)
                ->get();
        }

        return view('dosen.nilai', compact('dosen', 'khsRecords', 'jadwals'));
    }

    public function indexNilai()
    {
        return $this->nilai();
    }
        
    // Halaman Form Input Nilai per Kelas
    public function inputNilai(int $jadwal_id)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwal = JadwalKuliah::with('matakuliah')->findOrFail($jadwal_id);
        
        $mahasiswas = Krs::with('mahasiswa')
            ->where('mata_kuliah_id', $jadwal->mata_kuliah_id)
            ->where('status', 'Disetujui')
            ->get();
        
        return view('dosen.input_nilai', compact('dosen', 'jadwal', 'mahasiswas'));
    }
            
    // Proses Simpan Nilai ke Database (KHS)
    public function storeNilai(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $mahasiswa_id => $skor) {
            if ($skor >= 85) $huruf = 'A';
            elseif ($skor >= 75) $huruf = 'B';
            elseif ($skor >= 65) $huruf = 'C';
            elseif ($skor >= 50) $huruf = 'D';
            else $huruf = 'E';

            Khs::updateOrCreate(
                [
                    'mahasiswa_id' => $mahasiswa_id,
                    'mata_kuliah_id' => $request->mata_kuliah_id,
                ],
                [
                    'nilai_angka' => $skor,
                    'nilai_huruf' => $huruf,
                    'semester' => $request->semester,
                ]
            );
        }

        return redirect()->route('dosen.nilai')->with('success', 'Nilai mahasiswa berhasil disimpan!');
    }
    
    // Proses Hapus Nilai
    public function destroyNilai(int $id)
    {
        $khs = Khs::findOrFail($id);
        $khs->delete();

        return redirect()->route('dosen.nilai')->with('success', 'Data nilai mahasiswa berhasil dihapus dari sistem!');
    }

    // === Fitur Mata Kuliah Dosen ===
    public function matakuliah()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = collect();
        
        if ($dosen) {
            // Tarik data jadwal yang diampu dosen ini beserta detail matakuliahnya
            $jadwals = JadwalKuliah::with(['matakuliah'])
                ->where('dosen_id', $dosen->id)
                ->get();
        }
            
        return view('dosen.matakuliah', compact('dosen', 'jadwals'));
    }

    // Proses Tambah Mata Kuliah Mandiri
    public function storeMatakuliah(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:50',
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer',
            'kelas' => 'required|string|max:50',
            'semester' => 'required|string|max:50',
        ]);

        $dosen = Dosen::where('user_id', Auth::id())->first();

        // 1. Simpan data master mata kuliah
        $mk = Matakuliah::create([
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'prodi_id' => $dosen->prodi_id,
        ]);

        // 2. Hubungkan mata kuliah ke dosen sebagai kelas baru
        JadwalKuliah::create([
            'dosen_id' => $dosen->id,
            'mata_kuliah_id' => $mk->id,
            'kelas' => $request->kelas,
            'semester' => $request->semester,
            'ruangan_id' => 1,             
            'hari' => 'Senin',             
            'jam_mulai' => '08:00:00',     
            'jam_selesai' => '10:00:00',
        ]);

        return redirect()->back()->with('success', 'Mata kuliah baru berhasil ditambahkan dan ditugaskan ke Anda.');
    }
            
    // === Fitur Persetujuan KRS Mahasiswa ===
    public function dataMahasiswa()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $krsRecords = collect();

        if ($dosen) {
            $mataKuliahIds = JadwalKuliah::where('dosen_id', $dosen->id)->pluck('mata_kuliah_id');

            $krsRecords = Krs::with(['mahasiswa', 'matakuliah'])
                ->whereIn('mata_kuliah_id', $mataKuliahIds)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('dosen.data_mahasiswa', compact('dosen', 'krsRecords'));
    }

    // Menyetujui KRS
    public function approveKrs(int $id)
    {
        $krs = Krs::findOrFail($id);
        $krs->update(['status' => 'Disetujui']);

        return redirect()->back()->with('success', 'Mahasiswa berhasil disetujui masuk ke kelas.');
    }

    // Menolak KRS
    public function rejectKrs(int $id)
    {
        $krs = Krs::findOrFail($id);
        $krs->update(['status' => 'Ditolak']);

        return redirect()->back()->with('success', 'Pengajuan kelas mahasiswa ditolak.');
    }

    // === Fitur Absensi Perkuliahan ===
    
    // Halaman Utama Filter Absensi
    public function absensi(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = collect();

        if ($dosen) {
            $jadwals = JadwalKuliah::with('matakuliah')
                ->where('dosen_id', $dosen->id)
                ->get();
        }

        return view('dosen.absensi_mahasiswa', compact('dosen', 'jadwals'));
    }

    // Halaman Form Absensi Kelas Terpilih
    public function absensiKelas(int $jadwal_id, Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwals = JadwalKuliah::with('matakuliah')->where('dosen_id', $dosen->id)->get();
        $jadwal_terpilih = JadwalKuliah::with('matakuliah')->findOrFail($jadwal_id);

        $pertemuans = Pertemuan::where('jadwal_id', $jadwal_id)->orderBy('pertemuan_ke', 'asc')->get();
        $pertemuan_aktif = null;
        $mahasiswas = collect();

        if ($request->has('pertemuan_id') && $request->pertemuan_id != '') {
            $pertemuan_aktif = Pertemuan::findOrFail($request->pertemuan_id);
            
            $mahasiswas = Krs::with(['mahasiswa', 'mahasiswa.absensi' => function($q) use ($pertemuan_aktif) {
                $q->where('pertemuan_id', $pertemuan_aktif->id);
            }])
            ->where('mata_kuliah_id', $jadwal_terpilih->mata_kuliah_id)
            ->where('status', 'Disetujui')
            ->get();
        }

        return view('dosen.absensi_mahasiswa', compact('dosen', 'jadwals', 'jadwal_terpilih', 'pertemuans', 'pertemuan_aktif', 'mahasiswas'));
    }

    // Simpan Catatan Pertemuan Baru
    public function storePertemuan(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'pertemuan_ke' => 'required|integer',
            'tanggal_pertemuan' => 'required|date',
            'catatan_materi' => 'nullable|string'
        ]);

        Pertemuan::create($request->all());
        return redirect()->back()->with('success', 'Sesi pertemuan baru berhasil dibuat.');
    }

    // Simpan / Update Absensi Mahasiswa
    public function storeAbsensi(Request $request)
    {
        $request->validate([
            'pertemuan_id' => 'required',
            'kehadiran' => 'required|array'
        ]);

        foreach ($request->kehadiran as $mahasiswa_id => $data) {
            Absensi::updateOrCreate(
                [
                    'pertemuan_id' => $request->pertemuan_id,
                    'mahasiswa_id' => $mahasiswa_id
                ],
                [
                    'status_kehadiran' => $data['status'],
                    'keterangan' => $data['keterangan'] ?? null
                ]
            );
        }

        return redirect()->back()->with('success', 'Data absensi mahasiswa berhasil disimpan.');
    }
}