<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mahasiswa | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        .sidebar { width: 240px; height: 100vh; position: fixed; background: #1e3a8a; color: white; padding: 20px; }
        .sidebar h5 { margin-bottom: 30px; }
        .sidebar a { display: block; color: white; padding: 10px; border-radius: 6px; text-decoration: none; margin-bottom: 5px; font-size: 14px; }
        .sidebar a:hover { background: rgba(255, 255, 255, 0.1); }
        .main { margin-left: 240px; padding: 20px; }
        .topbar { background: white; border-radius: 10px; padding: 15px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .card-box { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .table thead { background: #1e3a8a; color: white; font-size: 13px; }
        .table td { font-size: 13px; vertical-align: middle; }
        .btn-primary { background: #1e3a8a; border: none; }
        .btn-primary:hover { background: #162d6b; }
        .form-control, .form-select { font-size: 14px; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h5><i class="fa-solid fa-graduation-cap me-2"></i>SIAKAD</h5>
        <a href="{{ route('dosen.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('dosen.matakuliah') }}"><i class="fa fa-book-open me-2"></i> Mata Kuliah</a>
        <a href="{{ route('dosen.mahasiswa') }}"><i class="fa fa-users me-2"></i> Mahasiswa</a>
        <a href="{{ route('dosen.absensi') }}"><i class="fa fa-clipboard-check me-2"></i> Absensi</a>
        <a href="{{ route('dosen.nilai') }}"><i class="fa fa-graduation-cap me-2"></i> Input Nilai</a>
        <a href="{{ route('dosen.jadwal') }}"><i class="fa fa-calendar-day me-2"></i> Jadwal Mengajar</a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <strong>Absensi Mahasiswa</strong><br>
                <small class="text-muted">Kelola kehadiran mahasiswa</small>
            </div>
            <div>
                <i class="fa fa-user-circle me-1"></i> {{ $dosen->nama_dosen ?? 'Dosen SIAKAD' }}
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="fa fa-circle-check me-2"></i>{{ session('success') }}
        </div>
        @endif

        <!-- FILTER & MANAJEMEN PERTEMUAN -->
        <div class="card-box">
            <div class="row">
                <!-- Pilihan Kelas -->
                <div class="col-md-5 mb-3">
                    <label class="mb-1 fw-semibold small">Mata Kuliah & Kelas</label>
                    <select class="form-select" onchange="if(this.value) window.location.href=this.value;">
                        <option value="">-- Pilih Kelas Anda --</option>
                        @foreach($jadwals as $j)
                            <option value="{{ route('dosen.absensi.kelas', $j->id) }}" {{ (isset($jadwal_terpilih) && $jadwal_terpilih->id == $j->id) ? 'selected' : '' }}>
                                {{ $j->matakuliah->nama_mk ?? 'N/A' }} (Semester {{ $j->semester ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilihan Pertemuan (Hanya muncul jika kelas sudah dipilih) -->
                @if(isset($jadwal_terpilih))
                <div class="col-md-7 mb-3">
                    <label class="mb-1 fw-semibold small">Filter Pertemuan & Aksi</label>
                    <form action="{{ route('dosen.absensi.kelas', $jadwal_terpilih->id) }}" method="GET" class="d-flex gap-2">
                        <select name="pertemuan_id" class="form-select w-50" required>
                            <option value="">-- Pilih Pertemuan --</option>
                            @foreach($pertemuans as $p)
                                <option value="{{ $p->id }}" {{ (isset($pertemuan_aktif) && $pertemuan_aktif->id == $p->id) ? 'selected' : '' }}>
                                    Pertemuan {{ $p->pertemuan_ke }} ({{ \Carbon\Carbon::parse($p->tanggal_pertemuan)->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary px-4">Tampilkan</button>
                        
                        <!-- Tombol Tambah Pertemuan -->
                        <button type="button" class="btn btn-outline-success px-3" data-bs-toggle="modal" data-bs-target="#tambahPertemuanModal">
                            <i class="fa fa-plus"></i> Pertemuan
                        </button>
                    </form>
                </div>
                @else
                <div class="col-md-7 mb-3 d-flex align-items-end">
                    <div class="alert alert-secondary w-100 mb-0 py-2 small border-0">
                        <i class="fa fa-info-circle me-1"></i> Silakan pilih kelas terlebih dahulu untuk melihat daftar pertemuan.
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if(isset($pertemuan_aktif))
        @php
            // Variabel untuk kalkulasi rekap
            $totalHadir = 0; $totalIzinSakit = 0; $totalAlpha = 0;
        @endphp
        
        <!-- TABLE ABSENSI BERSAMA FORM -->
        <div class="card-box">
            <form action="{{ route('dosen.absensi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="pertemuan_id" value="{{ $pertemuan_aktif->id }}">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6>
                        Data Kehadiran - 
                        <span class="text-primary">Pertemuan {{ $pertemuan_aktif->pertemuan_ke }}</span>
                        <br><small class="text-muted fw-normal">Materi: {{ $pertemuan_aktif->catatan_materi ?? 'Tidak ada catatan' }}</small>
                    </h6>
                    <button type="submit" class="btn btn-success btn-sm rounded-3 px-3">
                        <i class="fa fa-save me-1"></i> Simpan Absensi
                    </button>
                </div>

                <table class="table table-bordered align-middle shadow-sm">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="120">NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th width="180">Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $index => $krs)
                            @php
                                // Cek data absensi sebelumnya jika sudah pernah disimpan
                                $absensi = $krs->mahasiswa->absensi->first();
                                $statusKehadiran = $absensi ? $absensi->status_kehadiran : 'Alpha';
                                $keterangan = $absensi ? $absensi->keterangan : '';

                                // Hitung Rekap
                                if($statusKehadiran == 'Hadir') $totalHadir++;
                                elseif(in_array($statusKehadiran, ['Izin', 'Sakit'])) $totalIzinSakit++;
                                else $totalAlpha++;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-secondary">{{ $krs->mahasiswa->nim ?? '-' }}</td>
                                <td class="fw-semibold text-dark">{{ $krs->mahasiswa->nama_mahasiswa ?? $krs->mahasiswa->nama ?? 'N/A' }}</td>
                                <td>
                                    <!-- Select Status Kehadiran -->
                                    <select name="kehadiran[{{ $krs->mahasiswa_id }}][status]" class="form-select border-0 bg-light shadow-none">
                                        <option value="Hadir" {{ $statusKehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Izin" {{ $statusKehadiran == 'Izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="Sakit" {{ $statusKehadiran == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="Alpha" {{ $statusKehadiran == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="kehadiran[{{ $krs->mahasiswa_id }}][keterangan]" class="form-control border-0 bg-light shadow-none" placeholder="Isi keterangan jika perlu..." value="{{ $keterangan }}">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada mahasiswa yang disetujui di kelas ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </form>
        </div>

        <!-- REKAP OTOMATIS -->
        <div class="row">
            <div class="col-md-4">
                <div class="card-box text-center shadow-sm py-4">
                    <h3 class="text-success mb-1 fw-bold">{{ $totalHadir }}</h3>
                    <small class="text-muted fw-semibold">Total Hadir</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box text-center shadow-sm py-4">
                    <h3 class="text-warning mb-1 fw-bold">{{ $totalIzinSakit }}</h3>
                    <small class="text-muted fw-semibold">Total Izin / Sakit</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box text-center shadow-sm py-4">
                    <h3 class="text-danger mb-1 fw-bold">{{ $totalAlpha }}</h3>
                    <small class="text-muted fw-semibold">Total Alpha</small>
                </div>
            </div>
        </div>
        @endif

    </div>

    <!-- 🏛️ MODAL TAMBAH PERTEMUAN -->
    @if(isset($jadwal_terpilih))
    <div class="modal fade" id="tambahPertemuanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark"><i class="fa fa-calendar-plus text-primary me-2"></i> Buat Pertemuan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dosen.absensi.pertemuan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jadwal_id" value="{{ $jadwal_terpilih->id }}">
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Pertemuan Ke-</label>
                            <input type="number" name="pertemuan_ke" class="form-control" value="{{ count($pertemuans) + 1 }}" required readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Tanggal Pertemuan</label>
                            <input type="date" name="tanggal_pertemuan" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Materi / Catatan Pembahasan</label>
                            <textarea name="catatan_materi" class="form-control" rows="3" placeholder="Misal: Pengenalan Laravel, Migrasi Database..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light btn-sm px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-3 rounded-3">Simpan Pertemuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>