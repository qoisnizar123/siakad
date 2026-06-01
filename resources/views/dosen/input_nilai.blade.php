<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Detail | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        .sidebar { width: 240px; height: 100vh; position: fixed; background: #1e3a8a; color: white; padding: 20px; }
        .sidebar h5 { margin-bottom: 30px; }
        .sidebar a { display: block; color: white; padding: 10px; border-radius: 6px; text-decoration: none; margin-bottom: 5px; font-size: 14px; }
        .sidebar a:hover { background: rgba(255, 255, 255, 0.1); }
        .main { margin-left: 240px; padding: 20px; }
        .topbar { background: white; border-radius: 10px; padding: 15px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .card-box { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .table thead { background: #1e3a8a; color: white; }
        .table th, .table td { font-size: 13px; vertical-align: middle; }
        .grade-box { font-weight: 600; text-align: center; }
    </style>
</head>

<body>

    <div class="sidebar">
        <h5><i class="fa-solid fa-graduation-cap me-2"></i>SIAKAD</h5>
        <a href="{{ route('dosen.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('dosen.matakuliah') }}"><i class="fa fa-book-open me-2"></i> Mata Kuliah</a>
        <a href="{{ route('dosen.mahasiswa') }}"><i class="fa fa-users me-2"></i> Mahasiswa</a>
        <a href="{{ route('dosen.absensi') }}"><i class="fa fa-clipboard-check me-2"></i> Absensi</a>
        <a href="{{ route('dosen.nilai') }}"><i class="fa fa-graduation-cap me-2"></i> Input Nilai</a>
        <a href="{{ route('dosen.jadwal') }}"><i class="fa fa-calendar-day me-2"></i> Jadwal Mengajar</a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

    <div class="main">
        
        <div class="topbar">
            <div>
                <strong>Pengisian KHS Mahasiswa</strong><br>
                <span class="badge bg-primary mt-1">
                    <i class="fa fa-book me-1"></i> {{ $jadwal->matakuliah->nama_mk ?? 'N/A' }} (Kelas Semester {{ $jadwal->semester ?? '-' }})
                </span>
            </div>
            <a href="{{ route('dosen.nilai') }}" class="btn btn-sm btn-secondary rounded-3">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('dosen.nilai.store') }}" method="POST">
            @csrf
            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
            <input type="hidden" name="mata_kuliah_id" value="{{ $jadwal->mata_kuliah_id }}">
            <input type="hidden" name="semester" value="{{ $jadwal->semester }}">

            <div class="card-box">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0 fw-semibold text-dark">
                        <i class="fa-solid fa-calculator text-primary me-2"></i> Form Evaluasi (Tugas: 30%, UTS: 30%, UAS: 40%)
                    </h6>
                    <button type="submit" class="btn btn-success btn-sm rounded-3 px-3">
                        <i class="fa fa-save me-1"></i> Simpan Nilai Kelas
                    </button>
                </div>

                <table class="table table-bordered align-middle text-center shadow-sm">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="130">NIM</th>
                            <th class="text-start">Nama Mahasiswa</th>
                            <th width="95">Tugas (30%)</th>
                            <th width="95">UTS (30%)</th>
                            <th width="95">UAS (40%)</th>
                            <th width="105">Nilai Akhir</th>
                            <th width="70">Grade</th>
                            <th width="95">Bobot</th>
                            <th width="120">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $index => $krs)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-secondary fw-medium">{{ $krs->mahasiswa->nim ?? 'N/A' }}</td>
                            <td class="text-start fw-semibold text-dark">
                                {{ $krs->mahasiswa->nama_mahasiswa ?? $krs->mahasiswa->nama ?? 'N/A' }}
                            </td>
                            <td><input type="number" class="form-control text-center nilai tugas" min="0" max="100" placeholder="0" required></td>
                            <td><input type="number" class="form-control text-center nilai uts" min="0" max="100" placeholder="0" required></td>
                            <td><input type="number" class="form-control text-center nilai uas" min="0" max="100" placeholder="0" required></td>
                            <td><input type="number" name="nilai[{{ $krs->mahasiswa_id }}]" class="form-control text-center akhir fw-bold bg-light" readonly></td>
                            <td><div class="grade-box grade">-</div></td>
                            <td class="fw-bold text-primary display-bobot">0.00</td>
                            <td><span class="badge bg-secondary display-status text-white">Belum Diisi</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="fa-solid fa-users-slash fa-2x mb-2 opacity-50 d-block"></i>
                                Belum ada mahasiswa di kelas ini atau status KRS belum disetujui.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
        function hitungNilaiLengkap() {
            const rows = document.querySelectorAll("tbody tr");
            rows.forEach(row => {
                const inputTugas = row.querySelector(".tugas");
                if (!inputTugas) return;

                const tugas = parseFloat(row.querySelector(".tugas").value) || 0;
                const uts = parseFloat(row.querySelector(".uts").value) || 0;
                const uas = parseFloat(row.querySelector(".uas").value) || 0;

                const akhir = ((tugas * 0.3) + (uts * 0.3) + (uas * 0.4)).toFixed(0);
                row.querySelector(".akhir").value = akhir;

                let grade = "E";
                let bobot = "0.00";
                let status = "Mengulang";
                let badgeClass = "badge bg-danger text-white";

                if (akhir >= 85) {
                    grade = "A"; bobot = "4.00"; status = "Lulus"; badgeClass = "badge bg-success text-white";
                } else if (akhir >= 75) {
                    grade = "B"; bobot = "3.00"; status = "Lulus"; badgeClass = "badge bg-success text-white";
                } else if (akhir >= 65) {
                    grade = "C"; bobot = "2.00"; status = "Lulus"; badgeClass = "badge bg-success text-white";
                } else if (akhir >= 50) {
                    grade = "D"; bobot = "1.00"; status = "Mengulang"; badgeClass = "badge bg-warning text-white";
                } else {
                    grade = "E"; bobot = "0.00"; status = "Mengulang"; badgeClass = "badge bg-danger text-white";
                }

                const gradeBox = row.querySelector(".grade");
                gradeBox.innerHTML = grade;
                if(grade === 'A' || grade === 'B' || grade === 'C') gradeBox.className = "grade-box grade text-success";
                else if(grade === 'D') gradeBox.className = "grade-box grade text-warning";
                else gradeBox.className = "grade-box grade text-danger";

                row.querySelector(".display-bobot").innerHTML = bobot;

                const statusBadge = row.querySelector(".display-status");
                statusBadge.innerHTML = status;
                statusBadge.className = badgeClass;
            });
        }

        document.addEventListener("input", function (e) {
            if (e.target && e.target.classList.contains("nilai")) {
                hitungNilaiLengkap();
            }
        });
    </script>
</body>

</html>