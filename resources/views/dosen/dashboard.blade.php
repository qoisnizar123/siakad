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

        .stat-card {
            text-align: center;
        }

        .stat-icon {
            font-size: 25px;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 22px;
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

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
        }

        .btn-primary:hover {
            background: #162d6b;
        }

        /* BADGE */
        .badge-active {
            background: #16a34a;
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
                <strong>Dashboard Dosen</strong><br>
                <small class="text-muted">
                    Semester Ganjil 2026/2027
                </small>
            </div>

            <div>
                <i class="fa fa-user-circle me-1"></i>
                Dr. Ahmad Fauzi
            </div>

        </div>

        <!-- STATISTIK -->
        <div class="row">

            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div class="stat-icon">
                        <i class="fa fa-book"></i>
                    </div>

                    <div class="stat-number">4</div>

                    <small>Mata Kuliah</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div class="stat-icon">
                        <i class="fa fa-users"></i>
                    </div>

                    <div class="stat-number">120</div>

                    <small>Total Mahasiswa</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div class="stat-icon">
                        <i class="fa fa-calendar-check"></i>
                    </div>

                    <div class="stat-number">12</div>

                    <small>Total Pertemuan</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box stat-card">
                    <div class="stat-icon">
                        <i class="fa fa-chart-line"></i>
                    </div>

                    <div class="stat-number">3.75</div>

                    <small>Rata-rata Nilai</small>
                </div>
            </div>

        </div>

        <!-- JADWAL MENGAJAR -->
        <div class="card-box">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6>Jadwal Mengajar</h6>

                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-plus me-1"></i>
                    Tambah Jadwal
                </button>
            </div>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Pemrograman Web</td>
                        <td>IF-3A</td>
                        <td>Senin</td>
                        <td>08:00 - 10:00</td>
                        <td>Lab Komputer 1</td>
                        <td>
                            <span class="badge badge-active text-white">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Basis Data</td>
                        <td>IF-3B</td>
                        <td>Selasa</td>
                        <td>10:00 - 12:00</td>
                        <td>R.203</td>
                        <td>
                            <span class="badge badge-active text-white">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Algoritma</td>
                        <td>IF-2A</td>
                        <td>Rabu</td>
                        <td>13:00 - 15:00</td>
                        <td>R.105</td>
                        <td>
                            <span class="badge badge-active text-white">
                                Aktif
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- AKTIVITAS -->
        <div class="card-box">

            <h6 class="mb-3">Aktivitas Terbaru</h6>

            <ul class="list-group">

                <li class="list-group-item">
                    Input nilai Pemrograman Web berhasil diperbarui.
                </li>

                <li class="list-group-item">
                    Absensi kelas IF-3A telah disimpan.
                </li>

                <li class="list-group-item">
                    Jadwal mengajar semester ganjil telah diperbarui.
                </li>

            </ul>

        </div>

    </div>

</body>

</html>