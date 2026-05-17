<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRS Mahasiswa | SIAKAD</title>

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
            font-weight: 500;
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

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
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
        <h4><i class="fa-solid fa-graduation-cap me-2"></i>SIAKAD</h4>
        <div class="menu-title">Main Menu</div>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>Dashboard</a>
        <a href="{{ route('admin.data_mahasiswa') }}"><i class="fa fa-users"></i>Data Mahasiswa</a>
        <a href="{{ route('admin.data_dosen') }}"><i class="fa fa-chalkboard-teacher"></i>Data Dosen</a>
        <a href="{{ route('admin.matakuliah.index') }}"><i class="fa fa-book"></i>Mata Kuliah</a>
        <a href="{{ route('admin.jadwal_kuliah') }}"><i class="fa fa-calendar-days"></i>Jadwal Kuliah</a>
        <a href="{{ route('admin.krs_mahasiswa') }}" class="active"><i class="fa fa-file-signature"></i>KRS Mahasiswa</a>
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
                <h5 class="mb-1 fw-bold">KRS Mahasiswa</h5>
                <small class="text-muted">Manajemen pengajuan Kartu Rencana Studi mahasiswa</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="search-box"><i class="fa fa-search"></i><input type="text" placeholder="Cari mahasiswa atau NIM..."></div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKrs">
                    <i class="fa fa-plus me-2"></i>Tambah KRS
                </button>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3" role="alert">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-check me-3 fs-5 text-success"></i>
                <div class="text-dark"><strong>Berhasil!</strong> {{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3" role="alert">
            <div class="d-flex align-items-start">
                <i class="fa-solid fa-triangle-exclamation me-3 fs-5 text-danger mt-1"></i>
                <div class="text-dark">
                    <strong>Kendala Validasi:</strong>
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
                    <small class="text-muted">Total Pengajuan</small>
                    <h3 class="mt-2 fw-bold text-dark">{{ $totalPengajuan }}</h3>
                    <div class="icon bg-blue"><i class="fa fa-file-signature"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Disetujui</small>
                    <h3 class="mt-2 fw-bold text-success">{{ $disetujui }}</h3>
                    <div class="icon bg-green"><i class="fa fa-circle-check"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Menunggu</small>
                    <h3 class="mt-2 fw-bold text-warning">{{ $menunggu }}</h3>
                    <div class="icon bg-orange"><i class="fa fa-clock"></i></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card stat-card">
                    <small class="text-muted">Ditolak</small>
                    <h3 class="mt-2 fw-bold text-secondary">{{ $ditolak }}</h3>
                    <div class="icon bg-purple"><i class="fa fa-circle-xmark"></i></div>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h6 class="mb-1 fw-bold">Data Pengajuan KRS</h6>
                    <small class="text-muted">Daftar pengajuan KRS semester aktif</small>
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
                            <th>Semester</th>
                            <th>Total SKS</th>
                            <th>Status Pengajuan</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($krsGrouped as $m_id => $items)
                        @php
                        $firstItem = $items->first();
                        $totalSks = $items->sum(function($item) {
                        return $item->jadwal->matakuliah->sks ?? 0;
                        });
                        $isPending = $items->contains('status', 'pending');
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="student-profile">
                                    <div class="student-avatar">{{ substr($firstItem->mahasiswa->nama_mahasiswa, 0, 1) }}</div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $firstItem->mahasiswa->nama_mahasiswa }}</div>
                                        <small class="text-muted">{{ $firstItem->mahasiswa->prodi->nama_prodi ?? 'Teknik Informatika' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-medium">{{ $firstItem->mahasiswa->nim }}</span></td>
                            <td><span class="badge bg-light text-dark border px-2 py-1">Semester {{ $firstItem->mahasiswa->semester }}</span></td>
                            <td><span class="fw-bold text-primary">{{ $totalSks }} SKS</span></td>
                            <td>
                                @if($isPending)
                                <span class="badge-status badge-warning">Menunggu</span>
                                @else
                                <span class="badge-status badge-active">Disetujui</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-action btn btn-light border" data-bs-toggle="modal" data-bs-target="#modalApprove{{ $m_id }}" title="Validasi KRS">
                                        <i class="fa fa-pen text-warning"></i>
                                    </button>
                                    <form action="{{ route('admin.krs_mahasiswa.destroy', $m_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh daftar KRS mahasiswa ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn btn-light border" title="Hapus Semua KRS"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="modalApprove{{ $m_id }}" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4 shadow">
                                    <div class="modal-header border-0 bg-light px-4 pt-4">
                                        <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-file-signature text-warning me-2"></i>Validasi KRS Mahasiswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('admin.krs_mahasiswa.updateStatus', $m_id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-body p-4">
                                            <p class="small text-muted mb-3">Daftar mata kuliah yang diambil oleh <strong>{{ $firstItem->mahasiswa->nama_mahasiswa }}</strong> ({{ $totalSks }} SKS):</p>
                                            <ul class="list-group list-group-flush mb-4 small border rounded-3 overflow-hidden">
                                                @foreach($items as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center bg-white py-2">
                                                    <div>
                                                        <i class="fa-solid fa-book text-secondary me-2"></i>{{ $item->jadwal->matakuliah->nama_mk ?? 'Mata Kuliah' }}
                                                    </div>
                                                    <span class="badge bg-{{ $item->status == 'approved' ? 'success' : 'warning' }} rounded-pill fs-11">
                                                        {{ $item->status == 'approved' ? 'Approved' : 'Pending' }}
                                                    </span>
                                                </li>
                                                @endforeach
                                            </ul>

                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold text-muted">Aksi Validasi Global</label>
                                                <select name="status" class="form-select rounded-3" required>
                                                    <option value="approved" {{ !$isPending ? 'selected' : '' }}>Setujui Semua Kelas (Approved)</option>
                                                    <option value="pending" {{ $isPending ? 'selected' : '' }}>Tangguhkan Semua Kelas (Pending)</option>
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
                            <td colspan="7" class="text-center py-4 text-muted">Belum ada pengajuan rencana studi (KRS) dari mahasiswa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahKrs" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-header border-0 bg-light px-4 pt-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-circle-plus text-primary me-2"></i>Tambah KRS Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.krs_mahasiswa.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Pilih Mahasiswa</label>
                            <select name="mahasiswa_id" class="form-select rounded-3" required>
                                <option value="">-- Cari Nama / NIM Mahasiswa --</option>
                                @foreach($master_mahasiswa as $mhs)
                                <option value="{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->nama_mahasiswa }} (Smt {{ $mhs->semester }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Pilih Jadwal Kelas & Mata Kuliah</label>
                            <select name="jadwal_id" class="form-select rounded-3" required>
                                <option value="">-- Pilih Kelas Aktif --</option>
                                @foreach($master_jadwal as $jdl)
                                <option value="{{ $jdl->id }}">
                                    [{{ $jdl->hari }}, {{ substr($jdl->jam_mulai, 0, 5) }}] {{ $jdl->matakuliah->nama_mk ?? 'N/A' }} ({{ $jdl->matakuliah->sks ?? 0 }} SKS)
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 bg-light rounded-bottom-4">
                        <button type="button" class="btn btn-light rounded-3 px-3 border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4">Injeksi KRS</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>