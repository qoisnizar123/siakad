<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai | SIAKAD</title>

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

        /* FORM */
        .form-control,
        .form-select {
            font-size: 14px;
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
        }

        .btn-primary:hover {
            background: #162d6b;
        }

        /* GRADE */
        .grade-box {
            font-weight: 600;
            text-align: center;
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
                <strong>Input Nilai Mahasiswa</strong><br>

                <small class="text-muted">
                    Kelola nilai perkuliahan mahasiswa
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
                    <label class="mb-1">Semester</label>

                    <select class="form-select">
                        <option>Semester Ganjil</option>
                        <option>Semester Genap</option>
                    </select>
                </div>

                <div class="col-md-2 mb-3 d-flex align-items-end">

                    <button class="btn btn-primary w-100">
                        Tampilkan
                    </button>

                </div>

            </div>

        </div>

        <!-- TABLE -->
        <div class="card-box">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h6>
                    Data Nilai Mahasiswa
                </h6>

                <button class="btn btn-success btn-sm">
                    <i class="fa fa-save me-1"></i>
                    Simpan Nilai
                </button>

            </div>

            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tugas</th>
                        <th>UTS</th>
                        <th>UAS</th>
                        <th>Nilai Akhir</th>
                        <th>Grade</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>

                        <td>1</td>
                        <td>22012345</td>
                        <td>Hendra</td>

                        <td>
                            <input type="number" class="form-control nilai tugas" value="85">
                        </td>

                        <td>
                            <input type="number" class="form-control nilai uts" value="80">
                        </td>

                        <td>
                            <input type="number" class="form-control nilai uas" value="90">
                        </td>

                        <td width="120">
                            <input type="text" class="form-control akhir" readonly>
                        </td>

                        <td width="100">
                            <div class="grade-box grade"></div>
                        </td>

                    </tr>

                    <tr>

                        <td>2</td>
                        <td>22012346</td>
                        <td>Andi Saputra</td>

                        <td>
                            <input type="number" class="form-control nilai tugas" value="75">
                        </td>

                        <td>
                            <input type="number" class="form-control nilai uts" value="70">
                        </td>

                        <td>
                            <input type="number" class="form-control nilai uas" value="80">
                        </td>

                        <td>
                            <input type="text" class="form-control akhir" readonly>
                        </td>

                        <td>
                            <div class="grade-box grade"></div>
                        </td>

                    </tr>

                    <tr>

                        <td>3</td>
                        <td>22012347</td>
                        <td>Siti Nurhaliza</td>

                        <td>
                            <input type="number" class="form-control nilai tugas" value="60">
                        </td>

                        <td>
                            <input type="number" class="form-control nilai uts" value="65">
                        </td>

                        <td>
                            <input type="number" class="form-control nilai uas" value="70">
                        </td>

                        <td>
                            <input type="text" class="form-control akhir" readonly>
                        </td>

                        <td>
                            <div class="grade-box grade"></div>
                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <script>
        function hitungNilai() {

            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {

                const tugas = parseFloat(row.querySelector(".tugas").value) || 0;
                const uts = parseFloat(row.querySelector(".uts").value) || 0;
                const uas = parseFloat(row.querySelector(".uas").value) || 0;

                const akhir = ((tugas * 0.3) + (uts * 0.3) + (uas * 0.4)).toFixed(0);

                row.querySelector(".akhir").value = akhir;

                let grade = "";

                if (akhir >= 85) {
                    grade = "A";
                } else if (akhir >= 75) {
                    grade = "B";
                } else if (akhir >= 65) {
                    grade = "C";
                } else if (akhir >= 50) {
                    grade = "D";
                } else {
                    grade = "E";
                }

                row.querySelector(".grade").innerHTML = grade;

            });

        }

        document.querySelectorAll(".nilai").forEach(input => {
            input.addEventListener("input", hitungNilai);
        });

        hitungNilai();
    </script>

</body>

</html>