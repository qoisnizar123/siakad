<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Booking Ruangan | SIAKAD</title>

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
    background: rgba(255,255,255,0.1);
}

/* MAIN */
.main {
    margin-left: 240px;
    padding: 20px;
}

/* TOPBAR */
.topbar {
    background: white;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
}

/* CARD */
.card-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
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

/* STATUS */
.badge-success {
    background: #16a34a;
}

.badge-warning {
    background: #f59e0b;
}

.badge-danger {
    background: #dc2626;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h5><i class="fa fa-graduation-cap me-2"></i>SIAKAD</h5>

    <a href="/mahasiswa"><i class="fa fa-home me-2"></i>Dashboard</a>
    <a href="/krs"><i class="fa fa-book me-2"></i>KRS</a>
    <a href="#"><i class="fa fa-chart-line me-2"></i> KHS</a>
    <a href="#"><i class="fa fa-calendar me-2"></i>Jadwal</a>
    <a href="/booking"><i class="fa fa-door-open me-2"></i>Booking Ruangan</a>
    <a href="/"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <strong>Booking Ruangan</strong>
    </div>

    <div class="row">

        <!-- FORM -->
        <div class="col-md-5">
            <div class="card-box">
                <h6 class="mb-3">Form Booking</h6>

                <form>
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Jam Selesai</label>
                        <input type="time" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Ruangan</label>
                        <select class="form-control">
                            <option>Lab Komputer 1</option>
                            <option>Lab Komputer 2</option>
                            <option>Ruang Kelas A</option>
                            <option>Ruang Kelas B</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Keperluan</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <button class="btn btn-primary w-100">
                        Ajukan Booking
                    </button>
                </form>
            </div>
        </div>

        <!-- TABLE -->
        <div class="col-md-7">
            <div class="card-box">
                <h6 class="mb-3">Riwayat Booking</h6>

                <table class="table table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>Ruangan</th>
                            <th>Jam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10-08-2026</td>
                            <td>Lab Komputer 1</td>
                            <td>08:00 - 10:00</td>
                            <td><span class="badge bg-warning">Menunggu</span></td>
                        </tr>
                        <tr>
                            <td>12-08-2026</td>
                            <td>Ruang Kelas A</td>
                            <td>13:00 - 15:00</td>
                            <td><span class="badge bg-success">Disetujui</span></td>
                        </tr>
                        <tr>
                            <td>14-08-2026</td>
                            <td>Lab Komputer 2</td>
                            <td>10:00 - 12:00</td>
                            <td><span class="badge bg-danger">Ditolak</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>

</body>
</html>