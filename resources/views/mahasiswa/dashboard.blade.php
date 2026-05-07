<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Mahasiswa | SIAKAD</title>

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
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* CARD */
.card-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    font-size: 14px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.stat-card {
    text-align: center;
}

.stat-number {
    font-size: 20px;
    font-weight: 600;
    color: #1e3a8a;
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

/* PROFILE */
.profile {
    font-size: 13px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h5><i class="fa-solid fa-graduation-cap me-2"></i> SIAKAD</h5>

    <a href="/mahasiswa"><i class="fa fa-home me-2"></i> Dashboard</a>
    <a href="/krs"><i class="fa fa-book me-2"></i> KRS</a>
    <a href="#"><i class="fa fa-chart-line me-2"></i> KHS</a>
    <a href="#"><i class="fa fa-calendar me-2"></i> Jadwal</a>
    <a href="/booking"><i class="fa fa-door-open me-2"></i> Booking Ruangan</a>
    <a href="/"><i class="fa fa-sign-out-alt me-2"></i>Logout</a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <strong>Dashboard Mahasiswa</strong><br>
            <small class="text-muted">Semester Ganjil 2026</small>
        </div>

        <div class="profile">
            <i class="fa fa-user-circle me-1"></i>
        </div>
    </div>

    <!-- STAT -->
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card-box stat-card">
                <div>IPK</div>
                <div class="stat-number">3.75</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box stat-card">
                <div>SKS Diambil</div>
                <div class="stat-number">21</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box stat-card">
                <div>Semester</div>
                <div class="stat-number">5</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box stat-card">
                <div>Status</div>
                <div class="stat-number text-success">Aktif</div>
            </div>
        </div>
    </div>

    <!-- JADWAL -->
    <div class="card-box">
        <h6 class="mb-3">Jadwal Kuliah</h6>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Senin</td>
                    <td>Pemrograman Web</td>
                    <td>Dr. Budi</td>
                    <td>08:00 - 10:00</td>
                    <td>Lab 1</td>
                </tr>
                <tr>
                    <td>Selasa</td>
                    <td>Basis Data</td>
                    <td>Dr. Andi</td>
                    <td>10:00 - 12:00</td>
                    <td>R.203</td>
                </tr>
                <tr>
                    <td>Rabu</td>
                    <td>Algoritma</td>
                    <td>Dr. Siti</td>
                    <td>13:00 - 15:00</td>
                    <td>R.105</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>