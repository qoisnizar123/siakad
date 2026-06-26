<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa | SIAKAD</title>

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
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* MAIN */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* CARD */
        .card-box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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

        /* AVATAR */
        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #1e3a8a;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
        }

        .btn-primary:hover {
            background: #162d6b;
        }

        .btn-warning {
            color: white;
        }

        /* BADGE */
        .badge-active {
            background: #16a34a;
        }

        .badge-nonactive {
            background: #dc2626;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h5>
            <i class="fa-solid fa-graduation-cap me-2"></i>
            SIAKAD
        </h5>

        <a href="{{ route('dosen.dashboard') }}">
            <i class="fa fa-home me-2"></i> Dashboard
        </a>

        <a href="{{ route('dosen.matakuliah') }}">
            <i class="fa fa-book-open me-2"></i> Mata Kuliah
        </a>

        <a href="{{ route('dosen.mahasiswa') }}">
            <i class="fa fa-users me-2"></i> Mahasiswa
        </a>

        <a href="{{ route('dosen.absensi') }}">
            <i class="fa fa-clipboard-check me-2"></i> Absensi
        </a>

        <a href="{{ route('dosen.nilai') }}">
            <i class="fa fa-graduation-cap me-2"></i> Input Nilai
        </a>

        <a href="{{ route('dosen.jadwal') }}">
            <i class="fa fa-calendar-day me-2"></i> Jadwal Mengajar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt me-2"></i>
            Logout
        </a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <strong>Data Mahasiswa Kelas</strong><br>
                <small class="text-muted">Persetujuan dan manajemen mahasiswa yang mengambil kelas Anda</small>
            </div>
            <div>
                <i class="fa fa-user-circle me-1"></i> {{ $dosen->nama_dosen ?? 'Dosen SIAKAD' }}
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="fa fa-circle-check me-2"></i> {{ session('success') }}
        </div>
        @endif

        <!-- CARD LIST MAHASISWA -->
        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6><i class="fa-solid fa-list-check text-primary me-2"></i>Daftar Pengajuan KRS Mahasiswa</h6>
            </div>

            <!-- TABLE DINAMIS -->
            <table class="table table-bordered align-middle shadow-sm">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th>Mata Kuliah Diambil</th>
                        <th>Status</th>
                        <th width="140">Aksi Persetujuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krsRecords as $index => $krs)
                    @php
                    // Logika Inisial Avatar (Mengambil huruf pertama dari nama)
                    $namaLengkap = $krs->mahasiswa->nama_mahasiswa ?? $krs->mahasiswa->nama ?? 'U';
                    $inisial = substr($namaLengkap, 0, 1);

                    // Konversi Warna Badge
                    if($krs->status == 'Disetujui') { $badge = 'bg-success'; }
                    elseif($krs->status == 'Ditolak') { $badge = 'bg-danger'; }
                    else { $badge = 'bg-warning text-dark'; }
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="avatar">{{ $inisial }}</div>
                                <div>
                                    <strong class="text-dark">{{ $namaLengkap }}</strong><br>
                                    <small class="text-muted">{{ $krs->mahasiswa->email ?? 'Tidak ada email' }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-secondary fw-medium">{{ $krs->mahasiswa->nim ?? '-' }}</td>
                        <td>{{ $krs->mahasiswa->program_studi ?? 'Informatika' }}</td>
                        <td>{{ $krs->jadwal->matakuliah->nama_mk ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $badge }}">{{ $krs->status ?? 'Menunggu' }}</span>
                        </td>
                        <td>
                            <!-- TOMBOL AKSI PERSETUJUAN -->
                            <div class="d-flex justify-content-center gap-1">
                                <!-- Tombol Approve -->
                                <form action="{{ route('dosen.mahasiswa.approve', $krs->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success text-white" title="Setujui Mahasiswa" {{ $krs->status == 'Disetujui' ? 'disabled' : '' }}>
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>

                                <!-- Tombol Reject -->
                                <form action="{{ route('dosen.mahasiswa.reject', $krs->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger text-white" title="Tolak Mahasiswa" {{ $krs->status == 'Ditolak' ? 'disabled' : '' }}>
                                        <i class="fa fa-xmark"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fa-solid fa-users-slash fa-2x mb-2 opacity-50 d-block"></i>
                            Belum ada mahasiswa yang mendaftar ke kelas Anda melalui KRS.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>