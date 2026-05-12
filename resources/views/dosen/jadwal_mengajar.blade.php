<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar | SIAKAD</title>

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
            transition: 0.3s;
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

        /* BADGE */
        .badge-online {
            background: #16a34a;
        }

        .badge-offline {
            background: #2563eb;
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
        }

        .btn-primary:hover {
            background: #162d6b;
        }

        /* SCHEDULE CARD */
        .schedule-card {
            border-left: 4px solid #1e3a8a;
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
                <strong>Jadwal Mengajar Dosen</strong><br>

                <small class="text-muted">
                    Semester Ganjil 2026/2027
                </small>
            </div>

        </div>

        <!-- STATISTIC -->
        <div class="row">

            <div class="col-md-4">

                <div class="card-box text-center">

                    <h3 class="text-primary">
                        12
                    </h3>

                    <small>Total Jadwal Mengajar</small>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card-box text-center">

                    <h3 class="text-success">
                        4
                    </h3>

                    <small>Jadwal Hari Ini</small>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card-box text-center">

                    <h3 class="text-warning">
                        3
                    </h3>

                    <small>Kelas Online</small>

                </div>

            </div>

        </div>

        <!-- FILTER -->
        <div class="card-box">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="mb-1">
                        Hari
                    </label>

                    <select class="form-select">
                        <option>Semua Hari</option>
                        <option>Senin</option>
                        <option>Selasa</option>
                        <option>Rabu</option>
                        <option>Kamis</option>
                        <option>Jumat</option>
                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="mb-1">
                        Mata Kuliah
                    </label>

                    <select class="form-select">
                        <option>Semua Mata Kuliah</option>
                        <option>Pemrograman Web</option>
                        <option>Basis Data</option>
                        <option>Algoritma</option>
                    </select>

                </div>

                <div class="col-md-4 mb-3 d-flex align-items-end">

                    <button class="btn btn-primary w-100">
                        <i class="fa fa-filter me-1"></i>
                        Filter Jadwal
                    </button>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="card-box">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6>
                    Daftar Jadwal Mengajar
                </h6>

                <button class="btn btn-success btn-sm">

                    <i class="fa fa-plus me-1"></i>
                    Tambah Jadwal

                </button>

            </div>

            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Ruangan</th>
                        <th>Metode</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>

                        <td>1</td>
                        <td>Senin</td>
                        <td>08:00 - 10:00</td>
                        <td>Pemrograman Web</td>
                        <td>IF-3A</td>
                        <td>Lab Komputer 1</td>

                        <td>
                            <span class="badge badge-offline text-white">
                                Offline
                            </span>
                        </td>

                        <td>

                            <button class="btn btn-info btn-sm text-white">
                                <i class="fa fa-eye"></i>
                            </button>

                            <button class="btn btn-warning btn-sm text-white">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>
                        <td>Selasa</td>
                        <td>10:00 - 12:00</td>
                        <td>Basis Data</td>
                        <td>IF-3B</td>
                        <td>Ruang D203</td>

                        <td>
                            <span class="badge badge-online text-white">
                                Online
                            </span>
                        </td>

                        <td>

                            <button class="btn btn-info btn-sm text-white">
                                <i class="fa fa-eye"></i>
                            </button>

                            <button class="btn btn-warning btn-sm text-white">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td>3</td>
                        <td>Rabu</td>
                        <td>13:00 - 15:00</td>
                        <td>Algoritma</td>
                        <td>IF-2A</td>
                        <td>Lab Algoritma</td>

                        <td>
                            <span class="badge badge-offline text-white">
                                Offline
                            </span>
                        </td>

                        <td>

                            <button class="btn btn-info btn-sm text-white">
                                <i class="fa fa-eye"></i>
                            </button>

                            <button class="btn btn-warning btn-sm text-white">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <!-- TODAY SCHEDULE -->
        <div class="card-box">

            <h6 class="mb-3">
                Jadwal Hari Ini
            </h6>

            <div class="card schedule-card mb-3 border-0 shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <strong>
                            Pemrograman Web
                        </strong><br>

                        <small class="text-muted">
                            IF-3A • 08:00 - 10:00 • Lab Komputer 1
                        </small>

                    </div>

                    <button class="btn btn-primary btn-sm">

                        <i class="fa fa-play me-1"></i>
                        Mulai Kelas

                    </button>

                </div>

            </div>

            <div class="card schedule-card border-0 shadow-sm">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <strong>
                            Basis Data
                        </strong><br>

                        <small class="text-muted">
                            IF-3B • 10:00 - 12:00 • Ruang D203
                        </small>

                    </div>

                    <button class="btn btn-primary btn-sm">

                        <i class="fa fa-play me-1"></i>
                        Mulai Kelas

                    </button>

                </div>

            </div>

        </div>

    </div>

</body>

</html>