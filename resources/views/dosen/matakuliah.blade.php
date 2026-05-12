<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah | SIAKAD</title>

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
                <strong>Data Mata Kuliah</strong><br>
                <small class="text-muted">
                    Semester Ganjil 2026/2027
                </small>
            </div>

        </div>

        <!-- CARD -->
        <div class="card-box">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6>
                    Daftar Mata Kuliah
                </h6>

                <button class="btn btn-primary btn-sm">
                    <i class="fa fa-plus me-1"></i>
                    Tambah Mata Kuliah
                </button>

            </div>

            <!-- SEARCH -->
            <div class="row mb-3">

                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari mata kuliah...">
                </div>

                <div class="col-md-3">
                    <select class="form-control">
                        <option>Semua Semester</option>
                        <option>Semester 1</option>
                        <option>Semester 3</option>
                        <option>Semester 5</option>
                    </select>
                </div>

            </div>

            <!-- TABLE -->
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>IF101</td>
                        <td>Pemrograman Web</td>
                        <td>3</td>
                        <td>IF-3A</td>
                        <td>Semester 3</td>
                        <td>
                            <span class="badge badge-active text-white">
                                Aktif
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>IF102</td>
                        <td>Basis Data</td>
                        <td>3</td>
                        <td>IF-3B</td>
                        <td>Semester 3</td>
                        <td>
                            <span class="badge badge-active text-white">
                                Aktif
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>IF103</td>
                        <td>Algoritma</td>
                        <td>2</td>
                        <td>IF-2A</td>
                        <td>Semester 2</td>
                        <td>
                            <span class="badge badge-nonactive text-white">
                                Nonaktif
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-between align-items-center mt-3">

                <small class="text-muted">
                    Menampilkan 1 sampai 3 data
                </small>

                <nav>
                    <ul class="pagination pagination-sm mb-0">

                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>

                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>

                    </ul>
                </nav>

            </div>

        </div>

    </div>

</body>

</html>