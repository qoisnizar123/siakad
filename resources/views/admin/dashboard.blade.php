<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #1e3a8a;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .sidebar .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            opacity: .7;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: .3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.18);
        }

        .sidebar i {
            width: 20px;
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            padding: 25px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            position: relative;
            width: 320px;
        }

        .search-box input {
            border: 1px solid #dbe3ef;
            border-radius: 10px;
            padding: 10px 15px 10px 40px;
            width: 100%;
            font-size: 14px;
        }

        .search-box i {
            position: absolute;
            top: 12px;
            left: 14px;
            color: #64748b;
        }

        /* CARD */
        .dashboard-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card .icon {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .bg-blue {
            background: rgba(59, 130, 246, 0.15);
            color: #2563eb;
        }

        .bg-green {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
        }

        .bg-orange {
            background: rgba(249, 115, 22, 0.15);
            color: #ea580c;
        }

        .bg-purple {
            background: rgba(168, 85, 247, 0.15);
            color: #9333ea;
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

        /* ACTIVITY */
        .activity-item {
            display: flex;
            align-items: start;
            margin-bottom: 18px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 14px;
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
        }

        .btn-primary:hover {
            background: #172554;
        }

        /* BADGE */
        .badge-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 11px;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h4>
            <i class="fa-solid fa-graduation-cap me-2"></i>
            SIAKAD
        </h4>

        <div class="menu-title">
            Main Menu
        </div>

        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="fa fa-home"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.data_mahasiswa') }}">
            <i class="fa fa-users"></i>
            Data Mahasiswa
        </a>

        <a href="{{ route('admin.data_dosen') }}">
            <i class="fa fa-chalkboard-teacher"></i>
            Data Dosen
        </a>

        <a href="{{ route('admin.matakuliah') }}">
            <i class="fa fa-book"></i>
            Mata Kuliah
        </a>

        <a href="{{ route('admin.jadwal_kuliah') }}">
            <i class="fa fa-calendar-days"></i>
            Jadwal Kuliah
        </a>

        <a href="{{ route('admin.krs_mahasiswa') }}">
            <i class="fa fa-file-signature"></i>
            KRS Mahasiswa
        </a>

        <a href="{{ route('admin.nilai_khs') }}">
            <i class="fa fa-chart-column"></i>
            Nilai & KHS
        </a>

        <a href="{{ route('admin.booking_ruangan') }}">
            <i class="fa fa-door-open"></i>
            Booking Ruangan
        </a>

        <div class="menu-title">
            Pengaturan
        </div>

        <a href="{{ route('admin.manajemen_user') }}">
            <i class="fa fa-user-gear"></i>
            Manajemen User
        </a>

        <a href="{{ route('admin.pengaturan_sistem') }}">
            <i class="fa fa-gear"></i>
            Pengaturan Sistem
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt"></i>
            Logout
        </a>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">

            <div>
                <h5 class="mb-1">
                    Dashboard Admin
                </h5>

                <small class="text-muted">
                    Sistem Informasi Akademik Universitas
                </small>
            </div>

            <div class="d-flex align-items-center gap-3">

                <div class="search-box">

                    <i class="fa fa-search"></i>

                    <input type="text" placeholder="Cari data mahasiswa, dosen, jadwal...">

                </div>

                <div>
                    <i class="fa fa-user-circle fs-4 text-primary"></i>
                    <span class="ms-1">Administrator</span>
                </div>

            </div>

        </div>

        <!-- STATISTIC -->
        <div class="row">

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Total Mahasiswa
                    </small>

                    <h3 class="mt-2">
                        2,845
                    </h3>

                    <div class="icon bg-blue">
                        <i class="fa fa-users"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Total Dosen
                    </small>

                    <h3 class="mt-2">
                        186
                    </h3>

                    <div class="icon bg-green">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Mata Kuliah
                    </small>

                    <h3 class="mt-2">
                        124
                    </h3>

                    <div class="icon bg-orange">
                        <i class="fa fa-book"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Booking Ruangan
                    </small>

                    <h3 class="mt-2">
                        32
                    </h3>

                    <div class="icon bg-purple">
                        <i class="fa fa-door-open"></i>
                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <!-- TABLE -->
            <div class="col-md-8">

                <div class="dashboard-card">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h6 class="mb-0">
                            Aktivitas Akademik Terbaru
                        </h6>

                        <button class="btn btn-primary btn-sm">
                            Lihat Semua
                        </button>

                    </div>

                    <table class="table table-bordered align-middle">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>

                                <td>1</td>
                                <td>Hendra</td>
                                <td>Pengajuan KRS</td>
                                <td>09 Mei 2026</td>

                                <td>
                                    <span class="badge-status badge-active">
                                        Disetujui
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>2</td>
                                <td>Rizky Pratama</td>
                                <td>Booking Ruangan</td>
                                <td>09 Mei 2026</td>

                                <td>
                                    <span class="badge-status badge-pending">
                                        Menunggu
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>3</td>
                                <td>Salsa Putri</td>
                                <td>Upload Tugas Akhir</td>
                                <td>08 Mei 2026</td>

                                <td>
                                    <span class="badge-status badge-active">
                                        Selesai
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>4</td>
                                <td>Ahmad Fauzi</td>
                                <td>Input Nilai</td>
                                <td>08 Mei 2026</td>

                                <td>
                                    <span class="badge-status badge-active">
                                        Berhasil
                                    </span>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- ACTIVITY -->
            <div class="col-md-4">

                <div class="dashboard-card">

                    <h6 class="mb-4">
                        Aktivitas Sistem
                    </h6>

                    <div class="activity-item">

                        <div class="activity-icon bg-blue">
                            <i class="fa fa-user-plus"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Mahasiswa Baru
                            </div>

                            <small class="text-muted">
                                25 mahasiswa baru ditambahkan hari ini
                            </small>

                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon bg-green">
                            <i class="fa fa-book"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Jadwal Kuliah
                            </div>

                            <small class="text-muted">
                                Jadwal semester baru berhasil dibuat
                            </small>

                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon bg-orange">
                            <i class="fa fa-chart-line"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Input Nilai
                            </div>

                            <small class="text-muted">
                                80% dosen telah menginput nilai
                            </small>

                        </div>

                    </div>

                    <div class="activity-item">

                        <div class="activity-icon bg-purple">
                            <i class="fa fa-server"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Status Server
                            </div>

                            <small class="text-muted">
                                Sistem berjalan normal tanpa kendala
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- QUICK ACCESS -->
        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h6 class="mb-0">
                    Akses Cepat
                </h6>

            </div>

            <div class="row text-center">

                <div class="col-md-2 mb-3">

                    <a href="{{ route('admin.data_mahasiswa') }}"
                    class="text-decoration-none">

                        <button class="btn btn-light border w-100 py-3">

                            <i class="fa fa-users fs-4 text-primary mb-2"></i><br>

                            Mahasiswa

                        </button>

                    </a>

                </div>

                <div class="col-md-2 mb-3">

                    <a href="{{ route('admin.data_dosen') }}"
                    class="text-decoration-none">

                        <button class="btn btn-light border w-100 py-3">

                            <i class="fa fa-chalkboard-teacher fs-4 text-success mb-2"></i><br>

                            Dosen

                        </button>

                    </a>

                </div>

                <div class="col-md-2 mb-3">

                    <a href="{{ route('admin.matakuliah') }}"
                    class="text-decoration-none">

                        <button class="btn btn-light border w-100 py-3">

                            <i class="fa fa-book fs-4 text-warning mb-2"></i><br>

                            Mata Kuliah

                        </button>

                    </a>

                </div>

                <div class="col-md-2 mb-3">

                    <a href="{{ route('admin.jadwal_kuliah') }}"
                    class="text-decoration-none">

                        <button class="btn btn-light border w-100 py-3">

                            <i class="fa fa-calendar-days fs-4 text-danger mb-2"></i><br>

                            Jadwal

                        </button>

                    </a>

                </div>

                <div class="col-md-2 mb-3">

                    <a href="{{ route('admin.nilai_khs') }}"
                    class="text-decoration-none">

                        <button class="btn btn-light border w-100 py-3">

                            <i class="fa fa-chart-column fs-4 text-info mb-2"></i><br>

                            Nilai

                        </button>

                    </a>

                </div>

                <div class="col-md-2 mb-3">

                    <a href="{{ route('admin.pengaturan_sistem') }}"
                    class="text-decoration-none">

                        <button class="btn btn-light border w-100 py-3">

                            <i class="fa fa-gear fs-4 text-secondary mb-2"></i><br>

                            Pengaturan

                        </button>

                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>