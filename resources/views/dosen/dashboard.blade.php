@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('sidebar')
<div class="col-md-3">
    <div class="sidebar">
        <h6 class="mb-3 fw-bold text-primary">Menu Dosen</h6>
        <a href="/dashboard_dosen" class="sidebar-item active">
            <i class="fa-solid fa-chart-line me-2"></i>Dashboard
        </a>
        <a href="/matakuliah" class="sidebar-item">
            <i class="fa-solid fa-book me-2"></i>Mata Kuliah
        </a>
        <a href="/data_mahasiswa" class="sidebar-item">
            <i class="fa-solid fa-users me-2"></i>Data Mahasiswa
        </a>
        <a href="/absensi_mahasiswa" class="sidebar-item">
            <i class="fa-solid fa-clipboard-list me-2"></i>Absensi
        </a>
        <a href="/nilai" class="sidebar-item">
            <i class="fa-solid fa-star me-2"></i>Input Nilai
        </a>
        <a href="/jadwal_mengajar" class="sidebar-item">
            <i class="fa-solid fa-calendar me-2"></i>Jadwal Mengajar
        </a>
    </div>
</div>
@endsection

@section('page-title', 'Dashboard Dosen')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-custom">
            <div class="card-body">
                <h6 class="text-muted">Matakuliah Aktif</h6>
                <h3 class="text-primary">3</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom">
            <div class="card-body">
                <h6 class="text-muted">Total Mahasiswa</h6>
                <h3 class="text-success">87</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom">
            <div class="card-body">
                <h6 class="text-muted">Nilai Belum Input</h6>
                <h3 class="text-warning">12</h3>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<h5 class="mb-3">Matakuliah Yang Diampu</h5>
<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Kode</th>
                <th>Matakuliah</th>
                <th>Kelas</th>
                <th>SKS</th>
                <th>Jumlah Mahasiswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>INF101</td>
                <td>Pemrograman Dasar</td>
                <td>A</td>
                <td>3</td>
                <td>30</td>
                <td><a href="#" class="btn btn-sm btn-primary">Lihat</a></td>
            </tr>
            <tr>
                <td>INF102</td>
                <td>Algoritma & Struktur Data</td>
                <td>A</td>
                <td>4</td>
                <td>28</td>
                <td><a href="#" class="btn btn-sm btn-primary">Lihat</a></td>
            </tr>
            <tr>
                <td>INF103</td>
                <td>Database</td>
                <td>B</td>
                <td>3</td>
                <td>29</td>
                <td><a href="#" class="btn btn-sm btn-primary">Lihat</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection


/* TOPBAR */
.topbar{
background: white;
border-radius: 10px;
padding: 15px 20px;
margin-bottom: 20px;
display: flex;
justify-content: space-between;
align-items: center;
box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* CARD */
.card-box{
background: white;
border-radius: 10px;
padding: 20px;
margin-bottom: 20px;
box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.stat-card{
text-align: center;
}

.stat-icon{
font-size: 25px;
color: #1e3a8a;
margin-bottom: 10px;
}

.stat-number{
font-size: 22px;
font-weight: 600;
color: #1e3a8a;
}

/* TABLE */
.table thead{
background: #1e3a8a;
color: white;
font-size: 13px;
}

.table td{
font-size: 13px;
vertical-align: middle;
}

/* BUTTON */
.btn-primary{
background: #1e3a8a;
border: none;
}

.btn-primary:hover{
background: #162d6b;
}

/* BADGE */
.badge-active{
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

        <a href="/dashboard_dosen">
            <i class="fa fa-home me-2"></i>
            Dashboard
        </a>

        <a href="/matakuliah">
            <i class="fa fa-book me-2"></i>
            Mata Kuliah
        </a>

        <a href="/data_mahasiswa">
            <i class="fa fa-users me-2"></i>
            Mahasiswa
        </a>

        <a href="/absensi_mahasiswa">
            <i class="fa fa-clipboard-check me-2"></i>
            Absensi
        </a>

        <a href="/nilai">
            <i class="fa fa-pen-to-square me-2"></i>
            Input Nilai
        </a>

        <a href="/jadwal_mengajar">
            <i class="fa fa-calendar me-2"></i>
            Jadwal Mengajar
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
                <strong>Dashboard Dosen</strong><br>
                <small class="text-muted">
                    Semester Ganjil 2026/2027
                </small>
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
    </div>

</body>

</html>