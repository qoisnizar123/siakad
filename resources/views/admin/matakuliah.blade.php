<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mata Kuliah | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1e3a8a;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
        }

        .sidebar .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            opacity: .7;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-size: 14px;
            transition: .3s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.18);
        }

        .sidebar i {
            width: 20px;
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            padding: 25px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .search-box {
            position: relative;
            width: 320px;
        }

        .search-box input {
            border: 1px solid #dbe3ef;
            border-radius: 10px;
            padding: 10px 15px 10px 40px;
            width: 100%;
            font-size: 14px;
            outline: none;
        }

        .search-box input:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        .search-box i {
            position: absolute;
            top: 12px;
            left: 14px;
            color: #64748b;
        }

        /* CARD */
        .dashboard-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card .icon {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .bg-blue {
            background: rgba(59, 130, 246, 0.15);
            color: #2563eb;
        }

        .bg-green {
            background: rgba(34, 197, 94, 0.15);
            color: #16a34a;
        }

        .bg-orange {
            background: rgba(249, 115, 22, 0.15);
            color: #ea580c;
        }

        .bg-purple {
            background: rgba(168, 85, 247, 0.15);
            color: #9333ea;
        }

        /* BUTTON */
        .btn-primary {
            background: #1e3a8a;
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #172554;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* BADGE */
        .badge-status {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .badge-nonactive {
            background: #fee2e2;
            color: #991b1b;
        }

        @media(max-width: 991px) {
            .sidebar {
                width: 220px;
            }

            .main {
                margin-left: 220px;
            }
        }

        @media(max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

            .topbar {
                flex-direction: column;
                align-items: start;
                gap: 15px;
            }

            .search-box {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-graduation-cap me-4"></i>SIAKAD</h4>
        <div class="menu-title">Main Menu</div>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>Dashboard</a>
        <a href="{{ route('admin.data_mahasiswa') }}"><i class="fa fa-users"></i>Data Mahasiswa</a>
        <a href="{{ route('admin.data_dosen') }}"><i class="fa fa-chalkboard-teacher"></i>Data Dosen</a>
        <a href="{{ route('admin.matakuliah.index') }}" class="active"><i class="fa fa-book"></i>Mata Kuliah</a>
        <a href="{{ route('admin.jadwal_kuliah') }}"><i class="fa fa-calendar-days"></i>Jadwal Kuliah</a>
        <a href="{{ route('admin.krs_mahasiswa') }}"><i class="fa fa-file-signature"></i>KRS Mahasiswa</a>
        <a href="{{ route('admin.nilai_khs') }}"><i class="fa fa-chart-column"></i>Nilai & KHS</a>
        <a href="{{ route('admin.booking.index') }}"><i class="fa fa-door-open"></i>Booking Ruangan</a>

        <div class="menu-title">Pengaturan</div>
        <a href="{{ route('admin.manajemen_user') }}"><i class="fa fa-user-gear"></i>Manajemen User</a>
        <a href="{{ route('admin.pengaturan_sistem') }}"><i class="fa fa-gear"></i>Pengaturan Sistem</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i>Logout</a>
    </div>

    <div class="main">

        <div class="topbar">
            <div>
                <h5 class="mb-1 fw-bold">Data Mata Kuliah</h5>
                <small class="text-muted">Manajemen mata kuliah Sistem Informasi Akademik</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Cari mata kuliah...">
                </div>
                <button class="btn btn-primary rounded-3 fw-medium" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-2"></i>Tambah Mata Kuliah
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Total Mata Kuliah</small>
                    <h3 class="mt-2 fw-bold text-dark">{{ $totalMatakuliah }}</h3>
                    <div class="icon bg-blue"><i class="fa fa-book"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Mata Kuliah Wajib</small>
                    <h3 class="mt-2 fw-bold text-success">{{ $wajib }}</h3>
                    <div class="icon bg-green"><i class="fa fa-check-circle"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Mata Kuliah Pilihan</small>
                    <h3 class="mt-2 fw-bold text-warning">{{ $pilihan }}</h3>
                    <div class="icon bg-orange"><i class="fa fa-list"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Total SKS</small>
                    <h3 class="mt-2 fw-bold text-purple">{{ $totalSks }}</h3>
                    <div class="icon bg-purple"><i class="fa fa-layer-group"></i></div>
                </div>
            </div>
        </div>

        <div class="dashboard-card border-0">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="mb-1 fw-bold">Daftar Mata Kuliah</h6>
                    <small class="text-muted">Data mata kuliah aktif universitas</small>
                </div>
                <button class="btn btn-outline-primary btn-sm rounded-3">Export Data</button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode MK</th>
                            <th>Mata Kuliah</th>
                            <th>Program Studi</th>
                            <th>SKS</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matakuliah as $index => $mk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-light text-dark border fw-bold px-2 py-1 rounded">{{ $mk->kode_mk }}</span></td>
                            <td class="fw-semibold text-dark">{{ $mk->nama_mk }}</td>
                            <td>{{ $mk->prodi->nama_prodi ?? $mk->prodi->nama ?? 'Teknik Informatika' }}</td>
                            <td><span class="fw-medium">{{ $mk->sks }} SKS</span></td>
                            <td><span class="badge bg-primary-subtle text-primary border-0 rounded px-2 py-1">Semester {{ $mk->semester }}</span></td>
                            <td>
                                <span class="badge-status badge-active">Aktif</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-action btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $mk->id }}" title="Edit">
                                        <i class="fa fa-pen text-warning"></i>
                                    </button>

                                    <form action="{{ route('admin.matakuliah.destroy', $mk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn btn-light border" title="Hapus">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit{{ $mk->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow">
                                    <div class="modal-header border-0 bg-light px-4 pt-4">
                                        <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Edit Mata Kuliah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.matakuliah.update', $mk->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Kode Mata Kuliah</label>
                                                <input type="text" name="kode_mk" class="form-control rounded-3" value="{{ $mk->kode_mk }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Nama Mata Kuliah</label>
                                                <input type="text" name="nama_mk" class="form-control rounded-3" value="{{ $mk->nama_mk }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Program Studi</label>
                                                <select name="prodi_id" class="form-control rounded-3" required>
                                                    @foreach($prodis as $prodi)
                                                    <option value="{{ $prodi->id }}" {{ $mk->prodi_id == $prodi->id ? 'selected' : '' }}>
                                                        {{ $prodi->nama_prodi ?? $prodi->nama }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Jumlah SKS</label>
                                                    <input type="number" name="sks" class="form-control rounded-3" min="1" max="6" value="{{ $mk->sks }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Semester</label>
                                                    <input type="number" name="semester" class="form-control rounded-3" min="1" max="8" value="{{ $mk->semester }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4 bg-light rounded-bottom-4">
                                            <button type="button" class="btn btn-light rounded-3 px-3 border" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada kurikulum mata kuliah di database saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 bg-light px-4 pt-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-circle-plus text-primary me-2"></i>Tambah Mata Kuliah Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.matakuliah.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="form-control rounded-3" placeholder="Contoh: IF201" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control rounded-3" placeholder="Contoh: Pemrograman Framework" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Program Studi</label>
                            <select name="prodi_id" class="form-control rounded-3" required>
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi ?? $prodi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Jumlah SKS</label>
                                <input type="number" name="sks" class="form-control rounded-3" min="1" max="6" placeholder="Beban SKS" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">SemesterTarget</label>
                                <input type="number" name="semester" class="form-control rounded-3" min="1" max="8" placeholder="Semester 1-8" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-light rounded-3 px-3 border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>