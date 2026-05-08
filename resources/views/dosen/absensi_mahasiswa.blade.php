<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Absensi Mahasiswa | SIAKAD</title>

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

/* BUTTON */
.btn-primary{
    background: #1e3a8a;
    border: none;
}

.btn-primary:hover{
    background: #162d6b;
}

/* STATUS */
.badge-hadir{
    background: #16a34a;
}

.badge-izin{
    background: #f59e0b;
}

.badge-alpha{
    background: #dc2626;
}

/* FORM */
.form-control,
.form-select{
    font-size: 14px;
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

    <a href="/absensi">
        <i class="fa fa-clipboard-check me-2"></i>
        Absensi
    </a>

    <a href="/nilai">
        <i class="fa fa-pen-to-square me-2"></i>
        Input Nilai
    </a>

    <a href="#">
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
            <strong>Absensi Mahasiswa</strong><br>

            <small class="text-muted">
                Kelola kehadiran mahasiswa
            </small>
        </div>

    </div>

    <!-- FILTER -->
    <div class="card-box">

        <div class="row">

            <div class="col-md-4 mb-3">
                <label class="mb-1">Mata Kuliah</label>

                <select class="form-select">
                    <option>Pemrograman Web</option>
                    <option>Basis Data</option>
                    <option>Algoritma</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="mb-1">Kelas</label>

                <select class="form-select">
                    <option>IF-3A</option>
                    <option>IF-3B</option>
                    <option>IF-2A</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label class="mb-1">Pertemuan</label>

                <select class="form-select">
                    <option>Pertemuan 1</option>
                    <option>Pertemuan 2</option>
                    <option>Pertemuan 3</option>
                </select>
            </div>

            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    Tampilkan
                </button>
            </div>

        </div>

    </div>

    <!-- TABLE ABSENSI -->
    <div class="card-box">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h6>
                Data Kehadiran Mahasiswa
            </h6>

            <button class="btn btn-success btn-sm">
                <i class="fa fa-save me-1"></i>
                Simpan Absensi
            </button>

        </div>

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Kehadiran</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>22012345</td>
                    <td>Hendra</td>

                    <td width="220">

                        <select class="form-select">
                            <option>Hadir</option>
                            <option>Izin</option>
                            <option>Sakit</option>
                            <option>Alpha</option>
                        </select>

                    </td>

                    <td>
                        <input type="text" class="form-control" placeholder="Keterangan">
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>22012346</td>
                    <td>Andi Saputra</td>

                    <td>

                        <select class="form-select">
                            <option>Hadir</option>
                            <option>Izin</option>
                            <option>Sakit</option>
                            <option>Alpha</option>
                        </select>

                    </td>

                    <td>
                        <input type="text" class="form-control" placeholder="Keterangan">
                    </td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>22012347</td>
                    <td>Siti Nurhaliza</td>

                    <td>

                        <select class="form-select">
                            <option>Hadir</option>
                            <option>Izin</option>
                            <option>Sakit</option>
                            <option>Alpha</option>
                        </select>

                    </td>

                    <td>
                        <input type="text" class="form-control" placeholder="Keterangan">
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <!-- REKAP -->
    <div class="row">

        <div class="col-md-4">

            <div class="card-box text-center">

                <h3 class="text-success">
                    25
                </h3>

                <small>Total Hadir</small>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card-box text-center">

                <h3 class="text-warning">
                    3
                </h3>

                <small>Total Izin / Sakit</small>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card-box text-center">

                <h3 class="text-danger">
                    1
                </h3>

                <small>Total Alpha</small>

            </div>

        </div>

    </div>

</div>

</body>
</html>