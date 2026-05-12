<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHS Mahasiswa | SIAKAD</title>

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

        /* GPA CARD */
        .ipk-card {
            text-align: center;
            border-left: 4px solid #1e3a8a;
        }

        .ipk-number {
            font-size: 34px;
            font-weight: 700;
            color: #1e3a8a;
        }

        /* BADGE */
        .badge-grade {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        .grade-a {
            background: #16a34a;
            color: white;
        }

        .grade-b {
            background: #2563eb;
            color: white;
        }

        .grade-c {
            background: #f59e0b;
            color: white;
        }

        .grade-d {
            background: #dc2626;
            color: white;
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

        <a href="{{ route('mahasiswa.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('mahasiswa.krs') }}"><i class="fa fa-book me-2"></i> KRS</a>
        <a href="{{ route('mahasiswa.khs') }}"><i class="fa fa-chart-line me-2"></i> KHS</a>
        <a href="{{ route('mahasiswa.jadwal') }}"><i class="fa fa-calendar me-2"></i> Jadwal</a>
        <a href="{{ route('mahasiswa.booking') }}"><i class="fa fa-door-open me-2"></i> Booking Ruangan</a>
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
                <strong>Kartu Hasil Studi (KHS)</strong><br>

                <small class="text-muted">
                    Semester Ganjil 2026/2027
                </small>
            </div>

        </div>

        <!-- PROFILE -->
        <div class="card-box">

            <div class="row">

                <div class="col-md-3">

                    <small class="text-muted">
                        Nama Mahasiswa
                    </small>

                    <div class="fw-semibold">
                        Hendra
                    </div>

                </div>

                <div class="col-md-3">

                    <small class="text-muted">
                        NIM
                    </small>

                    <div class="fw-semibold">
                        22012345
                    </div>

                </div>

                <div class="col-md-3">

                    <small class="text-muted">
                        Program Studi
                    </small>

                    <div class="fw-semibold">
                        Informatika
                    </div>

                </div>

                <div class="col-md-3">

                    <small class="text-muted">
                        Semester
                    </small>

                    <div class="fw-semibold">
                        Semester 3
                    </div>

                </div>

            </div>

        </div>

        <!-- STATISTIC -->
        <div class="row">

            <div class="col-md-4">

                <div class="card-box ipk-card">

                    <small class="text-muted">
                        IPS Semester
                    </small>

                    <div class="ipk-number">
                        3.72
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card-box ipk-card">

                    <small class="text-muted">
                        IPK Kumulatif
                    </small>

                    <div class="ipk-number">
                        3.65
                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card-box ipk-card">

                    <small class="text-muted">
                        Total SKS
                    </small>

                    <div class="ipk-number">
                        58
                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="card-box">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6>
                    Daftar Nilai Mata Kuliah
                </h6>

                <button class="btn btn-success btn-sm">

                    <i class="fa fa-download me-1"></i>
                    Cetak KHS

                </button>

            </div>

            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Nilai Angka</th>
                        <th>Grade</th>
                        <th>Mutu</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>

                        <td>1</td>
                        <td>IF301</td>
                        <td>Pemrograman Web</td>
                        <td>3</td>
                        <td>90</td>

                        <td>
                            <span class="badge-grade grade-a">
                                A
                            </span>
                        </td>

                        <td>12</td>

                    </tr>

                    <tr>

                        <td>2</td>
                        <td>IF302</td>
                        <td>Basis Data</td>
                        <td>3</td>
                        <td>85</td>

                        <td>
                            <span class="badge-grade grade-a">
                                A
                            </span>
                        </td>

                        <td>12</td>

                    </tr>

                    <tr>

                        <td>3</td>
                        <td>IF303</td>
                        <td>Struktur Data</td>
                        <td>3</td>
                        <td>78</td>

                        <td>
                            <span class="badge-grade grade-b">
                                B
                            </span>
                        </td>

                        <td>9</td>

                    </tr>

                    <tr>

                        <td>4</td>
                        <td>IF304</td>
                        <td>Jaringan Komputer</td>
                        <td>2</td>
                        <td>72</td>

                        <td>
                            <span class="badge-grade grade-b">
                                B
                            </span>
                        </td>

                        <td>6</td>

                    </tr>

                    <tr>

                        <td>5</td>
                        <td>IF305</td>
                        <td>Sistem Operasi</td>
                        <td>2</td>
                        <td>65</td>

                        <td>
                            <span class="badge-grade grade-c">
                                C
                            </span>
                        </td>

                        <td>4</td>

                    </tr>

                </tbody>

            </table>

        </div>

        <!-- SUMMARY -->
        <div class="card-box">

            <div class="row text-center">

                <div class="col-md-3">

                    <h5 class="text-primary">
                        13
                    </h5>

                    <small class="text-muted">
                        Total Mata Kuliah
                    </small>

                </div>

                <div class="col-md-3">

                    <h5 class="text-success">
                        16
                    </h5>

                    <small class="text-muted">
                        Total SKS
                    </small>

                </div>

                <div class="col-md-3">

                    <h5 class="text-warning">
                        43
                    </h5>

                    <small class="text-muted">
                        Total Mutu
                    </small>

                </div>

                <div class="col-md-3">

                    <h5 class="text-danger">
                        3.72
                    </h5>

                    <small class="text-muted">
                        IPS
                    </small>

                </div>

            </div>

        </div>

    </div>

</body>

</html>