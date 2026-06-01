<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah | SIAKAD</title>

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
        .table thead { background: #1e3a8a; color: white; font-size: 13px; }
        .table td { font-size: 13px; vertical-align: middle; }
        .badge-active { background: #16a34a; }
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
                <strong>Data Mata Kuliah Diampu</strong><br>
                <small class="text-muted">Informasi beban mengajar akademik</small>
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

        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-semibold text-dark"><i class="fa-solid fa-book text-primary me-2"></i>Daftar Mata Kuliah</h6>
                
                <button class="btn btn-primary btn-sm rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#tambahMkModal">
                    <i class="fa fa-plus me-1"></i> Tambah Mata Kuliah
                </button>
            </div>

            <table class="table table-bordered align-middle shadow-sm text-center">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th width="100">Kode</th>
                        <th class="text-start">Mata Kuliah</th>
                        <th width="70">SKS</th>
                        <th width="100">Kelas</th>
                        <th width="130">Semester</th>
                        <th width="90">Status</th>
                        <th width="110">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $index => $j)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold text-secondary">{{ $j->matakuliah->kode_mk ?? '-' }}</td>
                        <td class="text-start fw-semibold text-dark">{{ $j->matakuliah->nama_mk ?? 'N/A' }}</td>
                        <td>{{ $j->matakuliah->sks ?? 0 }}</td>
                        <td>{{ $j->kelas ?? '-' }}</td>
                        <td>Semester {{ $j->semester ?? '-' }}</td>
                        <td><span class="badge badge-active text-white px-2 py-1">Aktif</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button class="btn btn-warning btn-sm text-white rounded-2" title="Edit Data"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm rounded-2" title="Hapus Data"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fa-solid fa-book-open fa-2x mb-2 opacity-50 d-block"></i>
                            Belum ada mata kuliah yang ditambahkan atau ditugaskan kepada Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="tambahMkModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark"><i class="fa-solid fa-book-medical text-primary me-2"></i> Buka Kelas Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dosen.matakuliah.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold text-muted">Kode MK</label>
                                <input type="text" name="kode_mk" class="form-control" placeholder="Contoh: IF101" required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label small fw-semibold text-muted">Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk" class="form-control" placeholder="Contoh: Pemrograman Web" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold text-muted">Jumlah SKS</label>
                                <input type="number" name="sks" class="form-control" placeholder="1-4" min="1" max="6" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold text-muted">Nama Kelas</label>
                                <input type="text" name="kelas" class="form-control" placeholder="Misal: IF-3A" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-semibold text-muted">Semester</label>
                                <select name="semester" class="form-select" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light btn-sm px-3 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm px-3 rounded-3">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>