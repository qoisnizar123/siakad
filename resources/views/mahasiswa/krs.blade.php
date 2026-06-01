<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRS Mahasiswa | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
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
            font-weight: 600;
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

        /* CARD */
        .card-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
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
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h5><i class="fa-solid fa-graduation-cap me-2"></i> SIAKAD</h5>

        <a href="{{ route('mahasiswa.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('mahasiswa.krs') }}"><i class="fa fa-book me-2"></i> KRS</a>
        <a href="{{ route('mahasiswa.khs') }}"><i class="fa fa-chart-line me-2"></i> KHS</a>
        <a href="{{ route('mahasiswa.jadwal_kuliah') }}"><i class="fa fa-calendar me-2"></i> Jadwal</a>
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

        <!-- HEADER -->
        <div class="card-box">
            <h5>Kartu Rencana Studi (KRS)</h5>
            <small class="text-muted">Semester Ganjil 2026</small>
        </div>

        <!-- TABLE KRS -->
        <div class="card-box">
            <h6 class="mb-3">Pilih Mata Kuliah</h6>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen</th>
                        <th>Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox" class="mk" data-sks="3"></td>
                        <td>IF101</td>
                        <td>Pemrograman Web</td>
                        <td>3</td>
                        <td>Dr. Budi</td>
                        <td>Senin 08:00</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="mk" data-sks="3"></td>
                        <td>IF102</td>
                        <td>Basis Data</td>
                        <td>3</td>
                        <td>Dr. Andi</td>
                        <td>Selasa 10:00</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="mk" data-sks="2"></td>
                        <td>IF103</td>
                        <td>Jaringan Komputer</td>
                        <td>2</td>
                        <td>Dr. Siti</td>
                        <td>Rabu 13:00</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="mk" data-sks="3"></td>
                        <td>IF104</td>
                        <td>Algoritma</td>
                        <td>3</td>
                        <td>Dr. Ahmad</td>
                        <td>Kamis 09:00</td>
                    </tr>
                </tbody>
            </table>

            <!-- TOTAL -->
            <div class="d-flex justify-content-between align-items-center">
                <strong>Total SKS: <span id="totalSKS">0</span></strong>

                <button class="btn btn-primary">
                    Simpan KRS
                </button>
            </div>
        </div>

    </div>

    <script>
        const checkboxes = document.querySelectorAll('.mk');
        const totalSKS = document.getElementById('totalSKS');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                let total = 0;
                checkboxes.forEach(c => {
                    if (c.checked) {
                        total += parseInt(c.dataset.sks);
                    }
                });
                totalSKS.innerText = total;
            });
        });
    </script>

</body>

</html>