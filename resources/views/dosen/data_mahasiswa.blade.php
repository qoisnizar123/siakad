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
body{
    font-family: 'Inter', sans-serif;
    background: #f1f5f9;
}

/* SIDEBAR */
.sidebar{
    width: 240px;
    height: 100vh;
    position: fixed;
    background: #1e3a8a;
    color: white;
    padding: 20px;
}

.sidebar h5{
    margin-bottom: 30px;
}

.sidebar a{
    display: block;
    color: white;
    padding: 10px;
    border-radius: 6px;
    text-decoration: none;
    margin-bottom: 5px;
    font-size: 14px;
}

.sidebar a:hover{
    background: rgba(255,255,255,0.1);
}

/* MAIN */
.main{
    margin-left: 240px;
    padding: 20px;
}

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

/* AVATAR */
.avatar{
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
.btn-primary{
    background: #1e3a8a;
    border: none;
}

.btn-primary:hover{
    background: #162d6b;
}

.btn-warning{
    color: white;
}

/* BADGE */
.badge-active{
    background: #16a34a;
}

.badge-nonactive{
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

    <a href="/">
        <i class="fa fa-sign-out-alt me-2"></i>
        Logout
    </a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>
            <strong>Data Mahasiswa</strong><br>
            <small class="text-muted">
                Daftar mahasiswa kelas
            </small>
        </div>

    </div>

    <!-- CARD -->
    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h6>
                Daftar Mahasiswa
            </h6>

            <button class="btn btn-primary btn-sm">
                <i class="fa fa-plus me-1"></i>
                Tambah Mahasiswa
            </button>

        </div>

        <!-- FILTER -->
        <div class="row mb-3">

            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Cari nama / NIM mahasiswa">
            </div>

            <div class="col-md-3">
                <select class="form-control">
                    <option>Semua Kelas</option>
                    <option>IF-3A</option>
                    <option>IF-3B</option>
                    <option>IF-2A</option>
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-control">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </div>

        </div>

        <!-- TABLE -->
        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>

                    <td>
                        <div class="d-flex align-items-center gap-2">

                            <div class="avatar">
                                H
                            </div>

                            <div>
                                <strong>Hendra</strong><br>
                                <small class="text-muted">
                                    hendra@student.ac.id
                                </small>
                            </div>

                        </div>
                    </td>

                    <td>22012345</td>
                    <td>Informatika</td>
                    <td>IF-3A</td>
                    <td>Semester 3</td>

                    <td>
                        <span class="badge badge-active text-white">
                            Aktif
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-info btn-sm text-white">
                            <i class="fa fa-eye"></i>
                        </button>

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

                    <td>
                        <div class="d-flex align-items-center gap-2">

                            <div class="avatar">
                                A
                            </div>

                            <div>
                                <strong>Andi Saputra</strong><br>
                                <small class="text-muted">
                                    andi@student.ac.id
                                </small>
                            </div>

                        </div>
                    </td>

                    <td>22012346</td>
                    <td>Informatika</td>
                    <td>IF-3B</td>
                    <td>Semester 3</td>

                    <td>
                        <span class="badge badge-active text-white">
                            Aktif
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-info btn-sm text-white">
                            <i class="fa fa-eye"></i>
                        </button>

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

                    <td>
                        <div class="d-flex align-items-center gap-2">

                            <div class="avatar">
                                S
                            </div>

                            <div>
                                <strong>Siti Nurhaliza</strong><br>
                                <small class="text-muted">
                                    siti@student.ac.id
                                </small>
                            </div>

                        </div>
                    </td>

                    <td>22012347</td>
                    <td>Sistem Informasi</td>
                    <td>SI-2A</td>
                    <td>Semester 2</td>

                    <td>
                        <span class="badge badge-nonactive text-white">
                            Nonaktif
                        </span>
                    </td>

                    <td>

                        <button class="btn btn-info btn-sm text-white">
                            <i class="fa fa-eye"></i>
                        </button>

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
                Menampilkan 1 sampai 3 data mahasiswa
            </small>

            <nav>
                <ul class="pagination pagination-sm mb-0">

                    <li class="page-item disabled">
                        <a class="page-link" href="#">
                            Previous
                        </a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link" href="#">
                            1
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#">
                            2
                        </a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#">
                            Next
                        </a>
                    </li>

                </ul>
            </nav>

        </div>

    </div>

</div>

</body>
</html>