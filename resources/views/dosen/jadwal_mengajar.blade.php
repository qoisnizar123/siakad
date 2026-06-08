<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; background: #f1f5f9; }
        .sidebar { width: 240px; height: 100vh; position: fixed; background: #1e3a8a; color: white; padding: 20px; }
        .sidebar h5 { margin-bottom: 30px; }
        .sidebar a { display: block; color: white; padding: 10px; border-radius: 6px; text-decoration: none; margin-bottom: 5px; font-size: 14px; transition: 0.3s; }
        .sidebar a:hover { background: rgba(255, 255, 255, 0.1); }
        .main { margin-left: 240px; padding: 20px; }
        .topbar { background: white; border-radius: 10px; padding: 15px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .card-box { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); }
        .table thead { background: #1e3a8a; color: white; font-size: 13px; }
        .table td { font-size: 13px; vertical-align: middle; }
        .badge-online { background: #16a34a; }
        .badge-offline { background: #2563eb; }
        .btn-primary { background: #1e3a8a; border: none; }
        .btn-primary:hover { background: #162d6b; }
        .schedule-card { border-left: 4px solid #1e3a8a; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h5><i class="fa-solid fa-graduation-cap me-2"></i>SIAKAD</h5>
        <a href="{{ route('dosen.dashboard') }}"><i class="fa fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('dosen.matakuliah') }}"><i class="fa fa-book-open me-2"></i> Mata Kuliah</a>
        <a href="{{ route('dosen.mahasiswa') }}"><i class="fa fa-users me-2"></i> Mahasiswa</a>
        <a href="{{ route('dosen.absensi') }}"><i class="fa fa-clipboard-check me-2"></i> Absensi</a>
        <a href="{{ route('dosen.nilai') }}"><i class="fa fa-graduation-cap me-2"></i> Input Nilai</a>
        <a href="{{ route('dosen.jadwal') }}"><i class="fa fa-calendar-day me-2"></i> Jadwal Mengajar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <div>
                <strong>Jadwal Mengajar Dosen</strong><br>
                <small class="text-muted">Semester Ganjil 2026/2027</small>
            </div>
            <div>
                <i class="fa fa-user-circle me-1"></i> {{ $dosen->nama_dosen ?? 'Dosen SIAKAD' }}
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="fa fa-circle-check me-2"></i> {{ session('success') }}
        </div>
        @endif

        <!-- STATISTIC -->
        <div class="row">
            <div class="col-md-6">
                <div class="card-box text-center py-4">
                    <h3 class="text-primary fw-bold">{{ $totalJadwal }}</h3>
                    <small class="fw-semibold text-muted">Total Jadwal Mengajar</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-box text-center py-4">
                    <h3 class="text-success fw-bold">{{ $jadwalHariIniCount }}</h3>
                    <small class="fw-semibold text-muted">{{ $judulJadwalBawah }}</small>
                </div>
            </div>
        </div>

        <!-- FILTER -->
        <div class="card-box">
            <form action="{{ route('dosen.jadwal') }}" method="GET" class="row">
                <div class="col-md-5 mb-3">
                    <label class="mb-1 small fw-semibold">Hari</label>
                    <select name="hari" class="form-select">
                        <option value="Semua Hari">Semua Hari</option>
                        <option value="Senin" {{ request('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ request('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ request('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ request('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ request('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ request('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100"><i class="fa fa-filter me-1"></i> Filter Jadwal</button>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-semibold">Daftar Jadwal Mengajar</h6>
                <button class="btn btn-success btn-sm rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal">
                    <i class="fa fa-plus me-1"></i> Tambah Jadwal
                </button>
            </div>

            <table class="table table-bordered align-middle text-center shadow-sm">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Hari</th>
                        <th width="130">Jam</th>
                        <th class="text-start">Mata Kuliah</th>
                        <th width="100">Kelas</th>
                        <th width="150">Ruangan</th>
                        <th width="100">Metode</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $index => $j)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold text-primary">{{ $j->hari ?? '-' }}</td>
                        <td>
                            {{ $j->jam_mulai ? \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') : '--:--' }} - 
                            {{ $j->jam_selesai ? \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') : '--:--' }}
                        </td>
                        <td class="text-start fw-semibold text-dark">{{ $j->matakuliah->nama_mk ?? 'N/A' }}</td>
                        <td>{{ $j->kelas ?? '-' }}</td>
                        <td><i class="fa fa-door-open text-muted me-1"></i> {{ $j->ruangan->nama_ruangan ?? 'Belum ada ruangan' }}</td>
                        <td>
                            <span class="badge {{ $j->metode == 'Offline' ? 'bg-primary' : 'bg-success' }} text-white px-2 py-1">
                                {{ $j->metode ?? 'Offline' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('dosen.absensi.kelas', $j->id) }}" class="btn btn-sm btn-light border" title="Buka Absensi"><i class="fa fa-clipboard-user text-success"></i></a>
                                <a href="{{ route('dosen.nilai.input', $j->id) }}" class="btn btn-sm btn-light border" title="Input Nilai"><i class="fa fa-marker text-warning"></i></a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fa-solid fa-calendar-xmark fa-2x mb-2 d-block opacity-50"></i>
                            Belum ada jadwal mengajar yang ditugaskan untuk Anda di database lokal.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TODAY SCHEDULE -->
        <div class="card-box">
            <h6 class="mb-3 fw-semibold"><i class="fa fa-clock text-primary me-2"></i>{{ $judulJadwalBawah }}</h6>

            @forelse($jadwalHariIni as $jHariIni)
            <div class="card schedule-card mb-3 border-0 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center py-2">
                    <div>
                        <strong class="text-dark fs-6">{{ $jHariIni->matakuliah->nama_mk ?? 'N/A' }}</strong><br>
                        <small class="text-muted">
                            <i class="fa fa-users me-1"></i> Kelas {{ $jHariIni->kelas ?? '-' }} &bull; 
                            <i class="fa fa-clock me-1"></i> {{ $jHariIni->jam_mulai ? \Carbon\Carbon::parse($jHariIni->jam_mulai)->format('H:i') : '--:--' }} - {{ $jHariIni->jam_selesai ? \Carbon\Carbon::parse($jHariIni->jam_selesai)->format('H:i') : '--:--' }} &bull; 
                            <i class="fa fa-location-dot me-1"></i> {{ $jHariIni->ruangan ?? 'N/A' }}
                        </small>
                    </div>
                    <!-- Tombol Timer (Tanpa tag a yang membungkus) -->
                    <button type="button" id="btn-timer-{{ $jHariIni->id }}" onclick="mulaiKelas('{{ $jHariIni->id }}')" class="btn btn-primary btn-sm rounded-3 px-3 shadow-sm">
                        <i class="fa fa-play me-1"></i> <span id="text-timer-{{ $jHariIni->id }}">Mulai Kelas</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="alert alert-light border border-dashed text-center text-muted">
                Tidak ada kelas yang dijadwalkan untuk Anda pada hari ini. Selamat beristirahat!
            </div>
            @endforelse
        </div>
    </div>

    <!-- 🏛️ MODAL TAMBAH JADWAL -->
    <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-calendar-plus text-primary me-2"></i> Atur Jadwal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dosen.jadwal.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Mata Kuliah</label>
                            <select name="mata_kuliah_id" class="form-select" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($mataKuliahOptions as $opt)
                                    <option value="{{ $opt->mata_kuliah_id }}">{{ $opt->matakuliah->nama_mk ?? 'N/A' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Kelas</label>
                                <input type="text" name="kelas" class="form-control" placeholder="Misal: IF-3A" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Hari</label>
                                <select name="hari" class="form-select" required>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Ruangan</label>
                                <input type="text" name="ruangan" class="form-control" placeholder="Misal: Lab Komputer 1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Metode</label>
                                <select name="metode" class="form-select" required>
                                    <option value="Offline">Offline</option>
                                    <option value="Online">Online</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light btn-sm px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-3 rounded-3">Simpan Jadwal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ⚡ BUNDLE SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- ⏱️ SCRIPT TIMER KELAS -->
    <script>
    let activeTimers = {};

    function mulaiKelas(jadwalId) {
        let btn = document.getElementById('btn-timer-' + jadwalId);
        let textSpan = document.getElementById('text-timer-' + jadwalId);
        
        if (btn.classList.contains('btn-primary')) {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-danger');
            btn.innerHTML = '<i class="fa fa-stop-circle me-1"></i> <span id="text-timer-'+jadwalId+'">00:00:00</span>';
            
            let detikan = 0;
            let timerElement = document.getElementById('text-timer-' + jadwalId);
            
            activeTimers[jadwalId] = setInterval(() => {
                detikan++;
                let jam = Math.floor(detikan / 3600);
                let menit = Math.floor((detikan % 3600) / 60);
                let detik = detikan % 60;
                
                timerElement.innerText = 
                    String(jam).padStart(2, '0') + ':' + 
                    String(menit).padStart(2, '0') + ':' + 
                    String(detik).padStart(2, '0');
            }, 1000);

        } else {
            clearInterval(activeTimers[jadwalId]);
            btn.classList.remove('btn-danger');
            btn.classList.add('btn-success');
            btn.innerHTML = '<i class="fa fa-check me-1"></i> Kelas Selesai';
            btn.disabled = true;
            
            setTimeout(() => {
                window.location.href = "{{ url('/dosen/absensi/kelas') }}/" + jadwalId;
            }, 1500);
        }
    }
    </script>
</body>
</html>