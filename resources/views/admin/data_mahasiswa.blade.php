<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa | SIAKAD</title>

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
            font-size: 14px;
            font-weight: 500;
            padding: 10px 16px;
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

        /* PROFILE */
        .student-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            text-transform: uppercase;
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

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
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
        <a href="{{ route('admin.data_mahasiswa') }}" class="active"><i class="fa fa-users"></i>Data Mahasiswa</a>
        <a href="{{ route('admin.data_dosen') }}"><i class="fa fa-chalkboard-teacher"></i>Data Dosen</a>
        <a href="{{ route('admin.matakuliah.index') }}" class="{{ Request::is('admin/matakuliah*') ? 'active' : '' }}"><i class="fa fa-book"></i>Mata Kuliah</a>
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
                <h5 class="mb-1 fw-bold">Data Mahasiswa</h5>
                <small class="text-muted">Manajemen data mahasiswa Sistem Informasi Akademik</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="search-box"><i class="fa fa-search"></i><input type="text" placeholder="Cari mahasiswa..."></div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="fa fa-plus me-2"></i>Tambah Mahasiswa
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-check me-3 fs-5 text-success"></i>
                <div class="text-dark">
                    <strong>Berhasil Menyimpan Data Mahasiswa!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3" role="alert">
            <div class="d-flex align-items-start">
                <i class="fa-solid fa-triangle-exclamation me-3 fs-5 text-danger mt-1"></i>
                <div class="text-dark">
                    <strong class="d-block mb-1">Gagal Menyimpan Data:</strong>
                    <ul class="mb-0 ps-3 small">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Total Mahasiswa</small>
                    <h3 class="mt-2 fw-bold text-dark">{{ $totalMahasiswa }}</h3>
                    <div class="icon bg-blue"><i class="fa fa-users"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Mahasiswa Aktif</small>
                    <h3 class="mt-2 fw-bold text-success">{{ $mahasiswaAktif }}</h3>
                    <div class="icon bg-green"><i class="fa fa-user-check"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Mahasiswa Cuti</small>
                    <h3 class="mt-2 fw-bold text-warning">{{ $mahasiswaCuti }}</h3>
                    <div class="icon bg-orange"><i class="fa fa-user-clock"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Alumni</small>
                    <h3 class="mt-2 fw-bold text-purple">{{ $alumni }}</h3>
                    <div class="icon bg-purple"><i class="fa fa-user-graduate"></i></div>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="mb-1 fw-bold">Daftar Mahasiswa</h6>
                    <small class="text-muted">Data mahasiswa aktif semester 2026</small>
                </div>
                <button class="btn btn-outline-primary btn-sm rounded-3">Export Data</button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>NIM</th>
                            <th>Program Studi</th>
                            <th>Semester</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswas as $index => $m)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="student-profile">
                                    <div class="student-avatar">{{ substr($m->nama_mahasiswa, 0, 1) }}</div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $m->nama_mahasiswa }}</div>
                                        <small class="text-muted">{{ $m->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-medium">{{ $m->nim }}</span></td>
                            <td>{{ $m->prodi->nama_prodi ?? $m->prodi->nama ?? 'Teknik Informatika' }}</td>
                            <td><span class="badge bg-light text-dark border px-2">{{ $m->semester }}</span></td>
                            <td><span class="fw-medium text-secondary">{{ $m->angkatan }}</span></td>
                            <td>
                                <span class="badge-status {{ $m->status == 'Aktif' ? 'badge-active' : ($m->status == 'Cuti' ? 'badge-warning' : 'badge-nonactive') }}">
                                    {{ $m->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-action btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $m->id }}" title="Edit">
                                        <i class="fa fa-pen text-warning"></i>
                                    </button>
                                    <form action="{{ route('admin.data_mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn btn-light border" title="Hapus"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalEdit{{ $m->id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow">
                                    <div class="modal-header border-0 bg-light px-4 pt-4">
                                        <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-user-pen text-warning me-2"></i>Edit Data Mahasiswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.data_mahasiswa.update', $m->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">NIM Mahasiswa</label>
                                                <input type="text" name="nim" class="form-control rounded-3" value="{{ $m->nim }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                                                <input type="text" name="nama_mahasiswa" class="form-control rounded-3" value="{{ $m->nama_mahasiswa }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Email Student</label>
                                                <input type="email" name="email" class="form-control rounded-3" value="{{ $m->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Program Studi</label>
                                                <select name="prodi_id" class="form-select rounded-3" required>
                                                    @foreach($prodis as $prodi)
                                                    <option value="{{ $prodi->id }}" {{ $m->prodi_id == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi ?? $prodi->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Semester Berjalan</label>
                                                    <select name="semester" class="form-select rounded-3" required>
                                                        @for($i=1; $i<=14; $i++)
                                                            <option value="{{ $i }}" {{ $m->semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                                            @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label small fw-semibold text-muted">Tahun Angkatan</label>
                                                    <input type="number" name="angkatan" class="form-control rounded-3" value="{{ $m->angkatan }}" placeholder="Contoh: 2024" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Status Kemahasiswaan</label>
                                                <select name="status" class="form-select rounded-3" required>
                                                    <option value="Aktif" {{ $m->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="Cuti" {{ $m->status == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                                                    <option value="Alumni" {{ $m->status == 'Alumni' ? 'selected' : '' }}>Alumni</option>
                                                </select>
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
                            <td colspan="8" class="text-center py-4 text-muted">Belum ada data mahasiswa terdaftar di sistem lokal.</td>
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
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-user-plus text-primary me-2"></i>Tambah Mahasiswa Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.data_mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">NIM Mahasiswa</label>
                            <input type="text" name="nim" class="form-control rounded-3" placeholder="Contoh: 2216156001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                            <input type="text" name="nama_mahasiswa" class="form-control rounded-3" placeholder="Contoh: Muhamad Hanif" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Email Aktif / Student</label>
                            <input type="email" name="email" class="form-control rounded-3" placeholder="Contoh: hanif@student.ac.id" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Program Studi</label>
                            <select name="prodi_id" class="form-select rounded-3" required>
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi ?? $prodi->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Semester Pertama</label>
                                <select name="semester" class="form-select rounded-3" required>
                                    @for($i=1; $i<=14; $i++)
                                        <option value="{{ $i }}">Semester {{ $i }}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-semibold text-muted">Tahun Angkatan</label>
                                <input type="number" name="angkatan" class="form-control rounded-3" value="2026" placeholder="Contoh: 2026" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Status Awal</label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Alumni">Alumni</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-light rounded-3 px-3 border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Mahasiswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>