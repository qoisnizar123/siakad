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
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .card-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: #1e3a8a;
            color: white;
            font-size: 13px;
        }

        .table td {
            font-size: 13px;
            vertical-align: middle;
        }

        .btn-primary {
            background: #1e3a8a;
            border: none;
        }

        .btn-primary:hover {
            background: #162d6b;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h5><i class="fa fa-graduation-cap me-2"></i>SIAKAD</h5>
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

    <div class="main">

        <div class="card-box d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1"><i class="fa fa-book-open text-primary me-2"></i> Kartu Rencana Studi (KRS)</h5>
                <small class="text-muted">Semester Ganjil 2026/2027 &bull; {{ $mahasiswa->nama_mahasiswa ?? $mahasiswa->nama ?? 'Mahasiswa' }}</small>
            </div>
            <div class="text-end">
                <span class="badge bg-primary fs-6 py-2 px-3">SKS Terdaftar: {{ $totalSksSaatIni }}</span>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="fa fa-circle-check me-2"></i> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-3">
            <i class="fa fa-triangle-exclamation me-2"></i> {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('mahasiswa.krs.store') }}" method="POST">
            @csrf
            <div class="card-box">
                <h6 class="mb-3 fw-semibold">Pilih Mata Kuliah Tersedia</h6>

                <table class="table table-bordered text-center shadow-sm">
                    <thead>
                        <tr>
                            <th width="80">Pilih</th>
                            <th width="100">Kode</th>
                            <th class="text-start">Mata Kuliah</th>
                            <th width="70">SKS</th>
                            <th>Dosen</th>
                            <th width="180">Jadwal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                        @php
                        // Cek apakah mahasiswa sudah mengambil mata kuliah ini sebelumnya
                        $isDiambil = $krsSaya->has($jadwal->id);
                        $statusKrs = $isDiambil ? $krsSaya[$jadwal->id]->status : null;
                        @endphp
                        <tr>
                            <td>
                                @if($isDiambil)
                                <span class="badge {{ $statusKrs == 'Disetujui' ? 'bg-success' : ($statusKrs == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }} w-100 py-2">
                                    {{ $statusKrs }}
                                </span>
                                @else
                                <input type="checkbox" name="jadwal_id[]" value="{{ $jadwal->id }}" class="jadwal-checkbox" data-sks="{{ $jadwal->matakuliah->sks ?? 0 }}">
                                @endif
                            </td>
                            <td class="fw-bold text-secondary">{{ $jadwal->matakuliah->kode_mk ?? '-' }}</td>
                            <td class="text-start fw-semibold text-dark">{{ $jadwal->matakuliah->nama_mk ?? 'N/A' }}</td>
                            <td>{{ $jadwal->matakuliah->sks ?? 0 }}</td>
                            <td class="text-start"><i class="fa fa-user-tie text-muted me-1"></i> {{ $jadwal->dosen->nama_dosen ?? 'N/A' }}</td>
                            <td>
                                {{ $jadwal->hari }}, {{ $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '--' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4">Belum ada jadwal kuliah yang dibuka untuk semester ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center mt-4 bg-light p-3 rounded border">
                    <strong class="fs-5 text-dark">
                        <i class="fa fa-calculator text-primary me-2"></i> Total SKS Ditambahkan: <span id="total-sks-ditambahkan">0</span>
                    </strong>

                    <button type="submit" id="btnSimpan" class="btn btn-primary rounded-3 px-4 fw-semibold" disabled>
                        <i class="fa fa-save me-1"></i> Simpan KRS
                    </button>
                </div>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.jadwal-checkbox');
            const totalText = document.getElementById('total-sks-ditambahkan');
            const btnSimpan = document.getElementById('btnSimpan'); // 💡 Sudah disesuaikan dengan HTML kamu

            function hitungSks() {
                let totalSks = 0;
                let jumlahDicentang = 0;

                checkboxes.forEach(function(box) {
                    if (box.checked) {
                        // 💡 Dibikin lebih aman agar tidak jadi NaN (Not a Number)
                        let sks = parseInt(box.getAttribute('data-sks'));
                        totalSks += (isNaN(sks) ? 0 : sks);
                        jumlahDicentang++;
                    }
                });

                if (totalText) {
                    totalText.textContent = totalSks; // 💡 Pakai textContent agar lebih reaktif
                }

                if (btnSimpan) {
                    btnSimpan.disabled = (jumlahDicentang === 0);
                    if (jumlahDicentang === 0) {
                        btnSimpan.classList.add('opacity-50');
                    } else {
                        btnSimpan.classList.remove('opacity-50');
                    }
                }
            }

            checkboxes.forEach(function(box) {
                box.addEventListener('change', hitungSks);
            });

            hitungSks();
        });
    </script>

</body>

</html>