<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        .sidebar { width: 240px; height: 100vh; position: fixed; background: #1e3a8a; color: white; padding: 20px; }
        .sidebar h5 { margin-bottom: 30px; }
        .sidebar a { display: block; color: white; padding: 10px; border-radius: 6px; text-decoration: none; margin-bottom: 5px; font-size: 14px; transition: 0.3s; }
        .sidebar a:hover { background: rgba(255, 255, 255, 0.1); }
        .main { margin-left: 240px; padding: 20px; }
        .topbar { background: white; border-radius: 10px; padding: 15px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .card-box { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .stat-card { text-align: center; }
        .stat-icon { font-size: 25px; color: #1e3a8a; margin-bottom: 10px; }
        .stat-number { font-size: 22px; font-weight: 600; color: #1e3a8a; }
        .table thead { background: #1e3a8a; color: white; font-size: 13px; }
        .table td { font-size: 13px; vertical-align: middle; }
        .btn-primary { background: #1e3a8a; border: none; }
        .btn-primary:hover { background: #162d6b; }
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
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

    <!-- MAIN -->
    <div class="main">
        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <strong>Dashboard Dosen</strong><br>
                <small class="text-muted">Semester Ganjil 2026/2027</small>
            </div>
            <div>
                <i class="fa fa-user-circle me-1"></i> {{ $dosen->nama_dosen ?? 'Dosen SIAKAD' }}
            </div>
        </div>

        <!-- STATISTIK -->
        <div class="row">
            <div class="col-md-3">
                <div class="card-box stat-card shadow-sm border-0">
                    <div class="stat-icon"><i class="fa fa-book"></i></div>
                    <div class="stat-number">{{ $totalMk }}</div>
                    <small class="text-muted fw-semibold">Mata Kuliah</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box stat-card shadow-sm border-0">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <div class="stat-number">{{ $totalMahasiswa }}</div>
                    <small class="text-muted fw-semibold">Total Mahasiswa Aktif</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box stat-card shadow-sm border-0">
                    <div class="stat-icon"><i class="fa fa-calendar-check"></i></div>
                    <div class="stat-number">{{ $totalPertemuan }}</div>
                    <small class="text-muted fw-semibold">Total Pertemuan</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box stat-card shadow-sm border-0">
                    <div class="stat-icon"><i class="fa fa-chart-line"></i></div>
                    <div class="stat-number">{{ $rataRataNilai > 0 ? $rataRataNilai : '-' }}</div>
                    <small class="text-muted fw-semibold">Rata-rata Nilai</small>
                </div>
            </div>
        </div>

        <!-- JADWAL MENGAJAR PREVIEW -->
        <div class="card-box shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold">Jadwal Mengajar (Preview)</h6>
                <a href="{{ route('dosen.jadwal') }}" class="btn btn-primary btn-sm rounded-3 px-3">
                    <i class="fa fa-arrow-right me-1"></i> Kelola Jadwal
                </a>
            </div>
            <table class="table table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th class="text-start">Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $j)
                    <tr>
                        <td class="fw-semibold text-dark text-start">{{ $j->matakuliah->nama_mk ?? 'N/A' }}</td>
                        <td>Kelas {{ $j->kelas ?? '-' }}</td>
                        <td class="fw-bold text-primary">{{ $j->hari }}</td>
                        <td>
                            {{ $j->jam_mulai ? \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') : '--:--' }} - 
                            {{ $j->jam_selesai ? \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') : '--:--' }}
                        </td>
                        <td>{{ $j->ruangan->nama_ruangan ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $j->metode == 'Offline' ? 'bg-primary' : 'bg-success' }} text-white">
                                {{ $j->metode ?? 'Offline' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada jadwal mengajar yang ditugaskan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- AKTIVITAS TERBARU -->
        <div class="card-box shadow-sm border-0">
            <h6 class="mb-3 fw-bold"><i class="fa fa-bell text-warning me-2"></i>Aktivitas Pertemuan & Absensi Terakhir</h6>
            <ul class="list-group list-group-flush border rounded">
                @forelse($aktivitasTerbaru as $aktivitas)
                <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                    <div>
                        <strong class="d-block text-dark">Pertemuan ke-{{ $aktivitas->pertemuan_ke }} : {{ $aktivitas->jadwal->matakuliah->nama_mk ?? 'Mata Kuliah' }}</strong>
                        <small class="text-muted"><i class="fa fa-book-open me-1"></i> Materi: {{ $aktivitas->catatan_materi ?? 'Tidak ada catatan' }}</small>
                    </div>
                    <span class="badge bg-light text-secondary border">
                        {{ \Carbon\Carbon::parse($aktivitas->created_at)->diffForHumans() }}
                    </span>
                </li>
                @empty
                <li class="list-group-item text-muted text-center py-3">
                    Belum ada riwayat aktivitas pembuatan pertemuan atau absensi kelas.
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</body>
</html>