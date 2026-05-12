@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('sidebar')
<style>
    body {
        background: #eef2f7;
        font-family: 'Segoe UI', sans-serif;
    }

    /* TOPBAR */
    .topbar {
        background: #1e3a8a;
        padding: 14px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .topbar .logo {
        font-size: 28px;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .badge-role {
        background: white;
        color: #333;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }

    .logout-btn {
        background: #ef4444;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 600;
    }

    /* LAYOUT */
    .dashboard-wrapper {
        display: flex;
        gap: 20px;
        padding: 20px;
    }

    /* SIDEBAR */
    .sidebar {
        width: 300px;
        background: white;
        border-radius: 14px;
        padding: 24px;
        height: fit-content;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .sidebar h5 {
        color: #2563eb;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 12px;
        text-decoration: none;
        color: #2563eb;
        margin-bottom: 10px;
        transition: 0.3s;
        font-size: 15px;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #eef2ff;
    }

    /* CONTENT */
    .main-content {
        flex: 1;
        background: white;
        border-radius: 14px;
        padding: 35px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .main-content h1 {
        font-size: 55px;
        margin-bottom: 35px;
    }

    /* CARDS */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .stat-card {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 24px;
    }

    .stat-card h6 {
        color: #6b7280;
        margin-bottom: 12px;
    }

    .stat-card h2 {
        font-size: 45px;
        font-weight: bold;
    }

    .text-blue {
        color: #2563eb;
    }

    .text-green {
        color: #16a34a;
    }

    .text-cyan {
        color: #06b6d4;
    }

    .text-orange {
        color: #f59e0b;
    }

    hr {
        margin: 35px 0;
    }

    /* STATISTIK */
    .system-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .box {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 24px;
        min-height: 260px;
    }

    .box h5 {
        margin-bottom: 25px;
    }

    .table-custom {
        width: 100%;
    }

    .table-custom tr {
        border-bottom: 1px solid #e5e7eb;
    }

    .table-custom td {
        padding: 16px 0;
        font-size: 15px;
    }

    .table-custom td:last-child {
        text-align: right;
        font-weight: bold;
    }

    .user-list li {
        list-style: none;
        margin-bottom: 22px;
        font-size: 17px;
    }

    .user-list i {
        width: 25px;
    }

    @media(max-width: 1200px) {
        .stats-row {
            grid-template-columns: repeat(2,1fr);
        }
    }

    @media(max-width: 768px) {

        .dashboard-wrapper {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }

        .system-grid {
            grid-template-columns: 1fr;
        }

        .main-content h1 {
            font-size: 40px;
        }
    }
</style>

<!-- TOPBAR -->
<div class="topbar">

    <div class="logo">
        <i class="fa-solid fa-graduation-cap"></i>
        SIAKAD
    </div>

    <div class="topbar-right">

        <span>Admin Siakad</span>

        <span class="badge-role">
            Admin
        </span>

        <button class="logout-btn">
            <i class="fa-solid fa-right-from-bracket me-1"></i>
            Logout
        </button>

    </div>

<<<<<<< HEAD
    <a href="#">
        <i class="fa fa-user-gear"></i>
        Manajemen User
    </a>

    <a href="#">
        <i class="fa fa-gear"></i>
        Pengaturan Sistem siakad
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket me-2"></i>
            <span>Logout</span>
        </a>

=======
>>>>>>> ab57b138eb5d2af9197d93d0d07a6cc509d715e4
</div>

<!-- DASHBOARD -->
<div class="dashboard-wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h5>Menu Admin</h5>

        <a href="#" class="active">
            <i class="fa-solid fa-chart-column"></i>
            Dashboard
        </a>

        <a href="#">
            <i class="fa-solid fa-users"></i>
            Manajemen User
        </a>

        <a href="#">
            <i class="fa-solid fa-book"></i>
            Manajemen Matakuliah
        </a>

        <a href="#">
            <i class="fa-solid fa-building"></i>
            Manajemen Ruangan
        </a>

        <a href="#">
            <i class="fa-solid fa-gear"></i>
            Pengaturan Sistem
        </a>

        <a href="#">
            <i class="fa-solid fa-file-lines"></i>
            Laporan
        </a>

    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <h1>Dashboard Admin</h1>

        <!-- STATISTIC -->
        <div class="stats-row">

            <div class="stat-card">
                <h6>Total Pengguna</h6>
                <h2 class="text-blue">245</h2>
            </div>

            <div class="stat-card">
                <h6>Mahasiswa Aktif</h6>
                <h2 class="text-green">180</h2>
            </div>

            <div class="stat-card">
                <h6>Dosen Aktif</h6>
                <h2 class="text-cyan">45</h2>
            </div>

            <div class="stat-card">
                <h6>Matakuliah</h6>
                <h2 class="text-orange">62</h2>
            </div>

        </div>

        <hr>

        <h3 class="mb-4">Statistik Sistem</h3>

        <!-- STATISTIK -->
        <div class="system-grid">

            <!-- STATUS -->
            <div class="box">

                <h5>Status Pengguna</h5>

                <table class="table-custom">

                    <tr>
                        <td>Pengguna Aktif</td>
                        <td>240</td>
                    </tr>

                    <tr>
                        <td>Pengguna Nonaktif</td>
                        <td>5</td>
                    </tr>

                </table>

            </div>

            <!-- DISTRIBUSI -->
            <div class="box">

                <h5>Distribusi Pengguna</h5>

                <ul class="user-list p-0">

                    <li>
                        <i class="fa-solid fa-user-graduate text-primary"></i>
                        Mahasiswa: 180 orang
                    </li>

                    <li>
                        <i class="fa-solid fa-chalkboard-user text-info"></i>
                        Dosen: 45 orang
                    </li>

                    <li>
                        <i class="fa-solid fa-user-gear text-warning"></i>
                        Admin: 20 orang
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>

@endsection
<style>
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

        <a href="#" class="active">
            <i class="fa fa-home"></i>
            Dashboard
        </a>

        <a href="#">
            <i class="fa fa-users"></i>
            Data Mahasiswa
        </a>

        <a href="#">
            <i class="fa fa-chalkboard-teacher"></i>
            Data Dosen
        </a>

        <a href="#">
            <i class="fa fa-book"></i>
            Mata Kuliah
        </a>

        <a href="#">
            <i class="fa fa-calendar-days"></i>
            Jadwal Kuliah
        </a>

        <a href="#">
            <i class="fa fa-file-signature"></i>
            KRS Mahasiswa
        </a>

        <a href="#">
            <i class="fa fa-chart-column"></i>
            Nilai & KHS
        </a>

        <a href="#">
            <i class="fa fa-door-open"></i>
            Booking Ruangan
        </a>

        <div class="menu-title">
            Pengaturan
        </div>

        <a href="#">
            <i class="fa fa-user-gear"></i>
            Manajemen User
        </a>

        <a href="#">
            <i class="fa fa-gear"></i>
            Pengaturan Sistem siakad
        </a>

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

                <div class="col-md-2">

                    <button class="btn btn-light border w-100 py-3">

                        <i class="fa fa-users fs-4 text-primary mb-2"></i><br>

                        Mahasiswa

                    </button>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-light border w-100 py-3">

                        <i class="fa fa-chalkboard-teacher fs-4 text-success mb-2"></i><br>

                        Dosen

                    </button>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-light border w-100 py-3">

                        <i class="fa fa-book fs-4 text-warning mb-2"></i><br>

                        Mata Kuliah

                    </button>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-light border w-100 py-3">

                        <i class="fa fa-calendar-days fs-4 text-danger mb-2"></i><br>

                        Jadwal

                    </button>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-light border w-100 py-3">

                        <i class="fa fa-chart-column fs-4 text-info mb-2"></i><br>

                        Nilai

                    </button>

                </div>

                <div class="col-md-2">

                    <button class="btn btn-light border w-100 py-3">

                        <i class="fa fa-gear fs-4 text-secondary mb-2"></i><br>

                        Pengaturan

                    </button>

                </div>

            </div>

        </div>

    </div>

</body>

</html>