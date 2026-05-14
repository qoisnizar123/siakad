<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User | SIAKAD</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon -->
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
            top: 0;
            left: 0;
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
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: .3s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.12);
        }

        .sidebar a.active {
            background: rgba(255,255,255,0.18);
        }

        .sidebar i {
            width: 20px;
            text-align: center;
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
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
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
            outline: none;
        }

        .search-box input:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 4px rgba(30,58,138,0.1);
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
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
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
            background: rgba(59,130,246,0.15);
            color: #2563eb;
        }

        .bg-green {
            background: rgba(34,197,94,0.15);
            color: #16a34a;
        }

        .bg-orange {
            background: rgba(249,115,22,0.15);
            color: #ea580c;
        }

        .bg-purple {
            background: rgba(168,85,247,0.15);
            color: #9333ea;
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #172554;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* USER PROFILE */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* BADGE */
        .badge-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-admin {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-user {
            background: #f3e8ff;
            color: #7e22ce;
        }

        /* RESPONSIVE */
        @media(max-width: 991px) {

            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }
        }

        @media(max-width: 768px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

            .topbar {
                flex-direction: column;
                align-items: start;
                gap: 15px;
            }

            .search-box {
                width: 100%;
            }
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

        <a href="{{ route('admin.dashboard') }}">
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

        <a href="{{ route('admin.manajemen_user') }}" class="active">
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
                    Manajemen User
                </h5>

                <small class="text-muted">
                    Kelola akun pengguna sistem akademik
                </small>
            </div>

            <div class="d-flex align-items-center gap-3">

                <div class="search-box">

                    <i class="fa fa-search"></i>

                    <input type="text"
                           placeholder="Cari user...">

                </div>

                <button class="btn btn-primary">

                    <i class="fa fa-plus me-2"></i>
                    Tambah User

                </button>

            </div>

        </div>

        <!-- STATISTIC -->
        <div class="row">

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Total User
                    </small>

                    <h3 class="mt-2">
                        1,254
                    </h3>

                    <div class="icon bg-blue">
                        <i class="fa fa-users"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Administrator
                    </small>

                    <h3 class="mt-2">
                        12
                    </h3>

                    <div class="icon bg-green">
                        <i class="fa fa-user-shield"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Dosen
                    </small>

                    <h3 class="mt-2">
                        186
                    </h3>

                    <div class="icon bg-orange">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="dashboard-card stat-card">

                    <small class="text-muted">
                        Mahasiswa
                    </small>

                    <h3 class="mt-2">
                        1,056
                    </h3>

                    <div class="icon bg-purple">
                        <i class="fa fa-user-graduate"></i>
                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="dashboard-card">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h6 class="mb-1">
                        Daftar User
                    </h6>

                    <small class="text-muted">
                        Data akun pengguna sistem SIAKAD
                    </small>

                </div>

                <button class="btn btn-outline-primary btn-sm">

                    Export Data

                </button>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Terakhir Login</th>
                            <th width="120">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>

                            <td>

                                <div class="user-profile">

                                    <div class="user-avatar">
                                        H
                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            Hendra
                                        </div>

                                        <small class="text-muted">
                                            Administrator Sistem
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>admin@kampus.ac.id</td>

                            <td>
                                <span class="badge-status badge-admin">
                                    Admin
                                </span>
                            </td>

                            <td>
                                <span class="badge-status badge-active">
                                    Aktif
                                </span>
                            </td>

                            <td>13 Mei 2026</td>

                            <td>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-eye text-primary"></i>
                                </button>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-pen text-warning"></i>
                                </button>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>

                            <td>

                                <div class="user-profile">

                                    <div class="user-avatar">
                                        S
                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            Siti Rahmawati
                                        </div>

                                        <small class="text-muted">
                                            Dosen Teknik Informatika
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>siti@kampus.ac.id</td>

                            <td>
                                <span class="badge-status badge-user">
                                    Dosen
                                </span>
                            </td>

                            <td>
                                <span class="badge-status badge-active">
                                    Aktif
                                </span>
                            </td>

                            <td>12 Mei 2026</td>

                            <td>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-eye text-primary"></i>
                                </button>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-pen text-warning"></i>
                                </button>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>3</td>

                            <td>

                                <div class="user-profile">

                                    <div class="user-avatar">
                                        R
                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            Rizky Pratama
                                        </div>

                                        <small class="text-muted">
                                            Mahasiswa Sistem Informasi
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>rizky@student.ac.id</td>

                            <td>
                                <span class="badge-status badge-user">
                                    Mahasiswa
                                </span>
                            </td>

                            <td>
                                <span class="badge-status badge-inactive">
                                    Nonaktif
                                </span>
                            </td>

                            <td>08 Mei 2026</td>

                            <td>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-eye text-primary"></i>
                                </button>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-pen text-warning"></i>
                                </button>

                                <button class="btn-action btn btn-light border">
                                    <i class="fa fa-trash text-danger"></i>
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

</html>