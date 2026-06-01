<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: #1e3a8a;
            color: white;
            padding: 20px;
        }

        .sidebar h5 {
            font-weight: 600;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.18);
            font-weight: 600;
        }

        /* MAIN */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* CARD */
        .card-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .stat-card {
            text-align: center;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 600;
            color: #1e3a8a;
        }

        /* TABLE */
        .table thead {
            background: #1e3a8a;
            color: white;
            font-size: 13px;
        }

        .table td {
            font-size: 13px;
            vertical-align: middle;
        }

        .profile {
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h5><i class="fa-solid fa-graduation-cap me-2"></i> SIAKAD</h5>
        <a href="{{ route('mahasiswa.dashboard') }}" class="active"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('mahasiswa.krs') }}"><i class="fa fa-book me-2"></i> KRS</a>
        <a href="{{ route('mahasiswa.khs') }}"><i class="fa fa-chart-line me-2"></i> KHS</a>
        <a href="{{ route('mahasiswa.jadwal_kuliah') }}"><i class="fa fa-calendar me-2"></i> Jadwal</a>
        <a href="{{ route('mahasiswa.booking') }}"><i class="fa fa-door-open me-2"></i> Booking Ruangan</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-top: 30px;">
            <i class="fa-solid fa-right-from-bracket me-2"></i><span>Logout</span>
        </a>
    </div>

    <div class="main">

        <div class="topbar">
            <div>
                <strong>Dashboard Mahasiswa</strong><br>
                <small class="text-muted">Semester Ganjil 2026</small>
            </div>
            <div class="profile">
                <i class="fa fa-user-circle me-1"></i>{{ Auth::user()->name }}
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div>IPK</div>
                    <div class="stat-number">{{ number_format($ipk, 2) }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div>SKS Diambil</div>
                    <div class="stat-number">{{ $sksDiambil }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div>Semester</div>
                    <div class="stat-number">{{ $semester }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div>Status</div>
                    <div class="stat-number {{ strtolower($statusAkun) == 'aktif' ? 'text-success' : 'text-danger' }}">
                        {{ $statusAkun }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box">
            <h6 class="mb-3">Jadwal Kuliah Semester Anda</h6>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Jam</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $j)
                        <tr>
                            <td class="fw-semibold">{{ $j->hari }}</td>
                            <td class="fw-bold text-dark">{{ $j->matakuliah->nama ?? 'N/A' }}</td>
                            <td>{{ $j->dosen->nama_dosen ?? $j->dosen->nama ?? 'Dosen' }}</td>
                            <td class="text-primary fw-medium">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $j->ruangan->nama_ruangan ?? 'N/A' }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada paket jadwal perkuliahan rilis di database local untuk semester Anda.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>