<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kuliah | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
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
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            margin-bottom: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        /* 💡 Menambahkan class active agar menu Jadwal menyala sesuai standardisasi visual tim */
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.18);
            font-weight: 500;
        }

        /* MAIN */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            border-radius: 12px;
            padding: 16px 22px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* CARD */
        .card-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
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

        /* BADGE */
        .badge-mk {
            background: #dbeafe;
            color: #1e40af;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-online {
            background: #16a34a;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11px;
        }

        .badge-offline {
            background: #2563eb;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11px;
        }

        /* TODAY CARD */
        .today-class {
            border-left: 4px solid #1e3a8a;
        }

        /* INFO */
        .info-icon {
            width: 45px;
            height: 45px;
            background: #dbeafe;
            color: #1e3a8a;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
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

    <div class="main">

        <div class="topbar">
            <div>
                <strong>Jadwal Kuliah Mahasiswa</strong><br>
                <small class="text-muted">
                    Paket Semester {{ $semesterMahasiswa }} &bull; Beban Total: {{ $totalSks }} SKS
                </small>
            </div>
            <div class="small fw-semibold text-secondary">
                <i class="fa fa-user me-1 text-primary"></i> {{ auth()->user()->name }}
            </div>
        </div>

        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>
                    Jadwal perkuliahan Paket Semester {{ $semesterMahasiswa }}
                </h6>
                <button class="btn btn-success btn-sm">
                    <i class="fa fa-download me-1"></i>
                    Cetak Jadwal
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Ruangan</th>
                            <th>SKS</th>
                            <th>Metode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $j)
                        <tr>
                            <td class="fw-semibold">{{ $j->hari }}</td>
                            <td class="text-primary fw-medium">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </td>
                            <td>
                                @if(isset($j->matakuliah->kode_mk))
                                <span class="badge-mk me-1">{{ $j->matakuliah->kode_mk }}</span>
                                @endif
                                <span class="fw-bold text-dark">{{ $j->matakuliah->nama ?? 'N/A' }}</span>
                            </td>
                            <td>{{ $j->dosen->nama_dosen ?? $j->dosen->nama ?? 'Dosen Pengajar' }}</td>
                            <td><span class="fw-medium text-secondary">{{ $j->ruangan->nama_ruangan ?? 'N/A' }}</span></td>
                            <td class="fw-bold">{{ $j->matakuliah->sks ?? 0 }}</td>
                            <td>
                                <span class="{{ strtolower($j->metode ?? 'Offline') == 'online' ? 'badge-online' : 'badge-offline' }}">
                                    {{ ucfirst($j->metode ?? 'Offline') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-calendar-xmark fs-4 mb-2 d-block text-secondary"></i>
                                Belum ada daftar paket jadwal perkuliahan yang dirilis untuk Semester {{ $semesterMahasiswa }} Anda.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>