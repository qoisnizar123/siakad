<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Sistem | SIAKAD</title>

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

        /* CARD */
        .dashboard-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        /* FORM */
        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #dbe3ef;
            padding: 10px 14px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #172554;
        }

        .btn-light-custom {
            background: #f8fafc;
            border: 1px solid #dbe3ef;
            border-radius: 10px;
            padding: 10px 18px;
            font-size: 14px;
        }

        /* SETTING ITEM */
        .setting-item {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 18px;
        }

        .setting-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
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

        /* RESPONSIVE */
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
                gap: 10px;
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

        <a href="{{ route('admin.booking.index') }}">
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

        <a href="{{ route('admin.pengaturan_sistem') }}" class="active">
            <i class="fa fa-gear"></i>
            Pengaturan Sistem
        </a>

        <form id="logout-form"
              action="{{ route('logout') }}"
              method="POST"
              style="display: none;">
            @csrf
        </form>

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
                    Pengaturan Sistem
                </h5>

                <small class="text-muted">
                    Konfigurasi dan pengaturan Sistem Informasi Akademik
                </small>

            </div>

            <button class="btn btn-primary">

                <i class="fa fa-save me-2"></i>
                Simpan Perubahan

            </button>

        </div>

        <div class="row">

            <!-- FORM PENGATURAN -->
            <div class="col-lg-8">

                <div class="dashboard-card">

                    <h6 class="mb-4">
                        Informasi Sistem
                    </h6>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nama Universitas
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="Universitas Teknologi Indonesia">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Tahun Akademik
                            </label>

                            <select class="form-select">
                                <option>2025 / 2026</option>
                                <option>2026 / 2027</option>
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Semester Aktif
                            </label>

                            <select class="form-select">
                                <option>Ganjil</option>
                                <option>Genap</option>
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email Kampus
                            </label>

                            <input type="email"
                                   class="form-control"
                                   value="admin@kampus.ac.id">

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">
                                Alamat Kampus
                            </label>

                            <textarea class="form-control"
                                      rows="3">Jl. Pendidikan No. 10 Surabaya</textarea>

                        </div>

                    </div>

                </div>

                <div class="dashboard-card">

                    <h6 class="mb-4">
                        Pengaturan Keamanan
                    </h6>

                    <div class="mb-3">

                        <label class="form-label">
                            Password Minimum
                        </label>

                        <input type="number"
                               class="form-control"
                               value="8">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Session Timeout
                        </label>

                        <select class="form-select">
                            <option>30 Menit</option>
                            <option>1 Jam</option>
                            <option>2 Jam</option>
                        </select>

                    </div>

                    <div class="form-check form-switch mb-3">

                        <input class="form-check-input"
                               type="checkbox"
                               checked>

                        <label class="form-check-label">
                            Aktifkan Verifikasi Email
                        </label>

                    </div>

                    <div class="form-check form-switch">

                        <input class="form-check-input"
                               type="checkbox"
                               checked>

                        <label class="form-check-label">
                            Aktifkan Backup Otomatis
                        </label>

                    </div>

                </div>

            </div>

            <!-- STATUS -->
            <div class="col-lg-4">

                <div class="dashboard-card">

                    <h6 class="mb-4">
                        Status Sistem
                    </h6>

                    <div class="setting-item d-flex align-items-center gap-3">

                        <div class="setting-icon bg-green">
                            <i class="fa fa-server"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Server
                            </div>

                            <small class="text-success">
                                Online & Stabil
                            </small>

                        </div>

                    </div>

                    <div class="setting-item d-flex align-items-center gap-3">

                        <div class="setting-icon bg-blue">
                            <i class="fa fa-database"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Database
                            </div>

                            <small class="text-primary">
                                Terhubung
                            </small>

                        </div>

                    </div>

                    <div class="setting-item d-flex align-items-center gap-3">

                        <div class="setting-icon bg-orange">
                            <i class="fa fa-shield-halved"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Keamanan
                            </div>

                            <small class="text-warning">
                                Sistem Aman
                            </small>

                        </div>

                    </div>

                    <div class="setting-item d-flex align-items-center gap-3">

                        <div class="setting-icon bg-purple">
                            <i class="fa fa-cloud-arrow-up"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Backup
                            </div>

                            <small class="text-secondary">
                                Terakhir 1 Jam Lalu
                            </small>

                        </div>

                    </div>

                </div>

                <div class="dashboard-card">

                    <h6 class="mb-4">
                        Aksi Cepat
                    </h6>

                    <div class="d-grid gap-3">

                        <button class="btn btn-light-custom text-start">

                            <i class="fa fa-database me-2 text-primary"></i>
                            Backup Database

                        </button>

                        <button class="btn btn-light-custom text-start">

                            <i class="fa fa-rotate me-2 text-success"></i>
                            Restart Sistem

                        </button>

                        <button class="btn btn-light-custom text-start">

                            <i class="fa fa-trash me-2 text-danger"></i>
                            Bersihkan Cache

                        </button>

                        <button class="btn btn-light-custom text-start">

                            <i class="fa fa-file-export me-2 text-warning"></i>
                            Export Pengaturan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>