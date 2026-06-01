<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHS Mahasiswa | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        .sidebar { width: 240px; height: 100vh; position: fixed; background: #1e3a8a; color: white; padding: 20px; }
        .sidebar h5 { margin-bottom: 30px; }
        .sidebar a { display: block; color: white; padding: 10px; border-radius: 6px; text-decoration: none; margin-bottom: 5px; font-size: 14px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255, 255, 255, 0.1); }
        .main { margin-left: 240px; padding: 20px; }
        .topbar { background: white; border-radius: 10px; padding: 15px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .card-box { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .table thead { background: #1e3a8a; color: white; font-size: 13px; }
        .table td { font-size: 13px; vertical-align: middle; }
        .ipk-card { text-align: center; border-left: 4px solid #1e3a8a; }
        .ipk-number { font-size: 34px; font-weight: 700; color: #1e3a8a; }
        .badge-grade { padding: 6px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; }
        .grade-A { background: #16a34a; color: white; }
        .grade-B { background: #2563eb; color: white; }
        .grade-C { background: #f59e0b; color: white; }
        .grade-D, .grade-E { background: #dc2626; color: white; }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h5><i class="fa fa-graduation-cap me-2"></i>SIAKAD</h5>
        <a href="{{ route('mahasiswa.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('mahasiswa.krs') }}"><i class="fa fa-book me-2"></i> KRS</a>
        <a href="{{ route('mahasiswa.khs') }}"><i class="fa fa-chart-line me-2"></i> KHS</a>
        <a href="{{ route('mahasiswa.jadwal_kuliah') }}"><i class="fa fa-calendar me-2"></i> Jadwal</a>
        <a href="{{ route('mahasiswa.booking') }}"><i class="fa fa-door-open me-2"></i> Booking Ruangan</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket me-2"></i>
            <span>Logout</span>
        </a>
    </div>

    <!-- MAIN -->
    <div class="main">
        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <strong>Kartu Hasil Studi (KHS)</strong><br>
                <small class="text-muted">Semester Ganjil 2026/2027</small>
            </div>
        </div>

        <!-- PROFILE -->
        <div class="card-box">
            <div class="row">
                <div class="col-md-3">
                    <small class="text-muted">Nama Mahasiswa</small>
                    <div class="fw-semibold">{{ $mahasiswa->nama_mahasiswa ?? $mahasiswa->nama ?? '-' }}</div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">NIM</small>
                    <div class="fw-semibold">{{ $mahasiswa->nim ?? '-' }}</div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Program Studi</small>
                    <div class="fw-semibold">{{ $mahasiswa->program_studi ?? 'Informatika' }}</div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Semester</small>
                    <div class="fw-semibold">Semester {{ $mahasiswa->semester ?? 1 }}</div>
                </div>
            </div>
        </div>

        <!-- STATISTIC -->
        <div class="row">
            <div class="col-md-4">
                <div class="card-box ipk-card">
                    <small class="text-muted">IPS Semester</small>
                    <div class="ipk-number">{{ number_format($ips, 2) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box ipk-card">
                    <small class="text-muted">IPK Kumulatif</small>
                    <div class="ipk-number">{{ number_format($ipk, 2) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box ipk-card">
                    <small class="text-muted">Total SKS Diambil</small>
                    <div class="ipk-number">{{ $totalSks }}</div>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Daftar Nilai Mata Kuliah</h6>
                <button class="btn btn-success btn-sm" onclick="window.print()">
                    <i class="fa fa-download me-1"></i> Cetak KHS
                </button>
            </div>

            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Kode MK</th>
                        <th class="text-start">Mata Kuliah</th>
                        <th width="80">SKS</th>
                        <th width="120">Nilai Angka</th>
                        <th width="100">Grade</th>
                        <th width="100">Mutu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilais as $index => $n)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $n->matakuliah->kode_mk ?? '-' }}</td>
                        <td class="text-start fw-semibold">{{ $n->matakuliah->nama_mk ?? 'N/A' }}</td>
                        <td>{{ $n->matakuliah->sks ?? 0 }}</td>
                        <td>{{ $n->nilai_angka ?? $n->nilai ?? 0 }}</td>
                        <td>
                            <span class="badge-grade grade-{{ $n->calculated_grade }}">
                                {{ $n->calculated_grade }}
                            </span>
                        </td>
                        <td class="fw-bold text-primary">{{ $n->calculated_mutu }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-muted py-4">Belum ada data nilai yang dipublikasikan oleh Dosen untuk semester ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- SUMMARY -->
        <div class="card-box">
            <div class="row text-center">
                <div class="col-md-3">
                    <h5 class="text-primary fw-bold">{{ $totalMataKuliah }}</h5>
                    <small class="text-muted">Total Mata Kuliah</small>
                </div>
                <div class="col-md-3">
                    <h5 class="text-success fw-bold">{{ $totalSks }}</h5>
                    <small class="text-muted">Total SKS</small>
                </div>
                <div class="col-md-3">
                    <h5 class="text-warning fw-bold">{{ $totalMutu }}</h5>
                    <small class="text-muted">Total Mutu</small>
                </div>
                <div class="col-md-3">
                    <h5 class="text-danger fw-bold">{{ number_format($ips, 2) }}</h5>
                    <small class="text-muted">IPS Akhir</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>