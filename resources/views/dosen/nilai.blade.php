<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Nilai | SIAKAD</title>

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
                <strong>Rekapitulasi Nilai Mahasiswa</strong><br>
                <small class="text-muted">Daftar nilai evaluasi akademik mahasiswa yang Anda ampu</small>
            </div>
            <div>
                <i class="fa fa-user-circle me-1"></i>
                {{ $dosen->nama_dosen ?? 'Dosen SIAKAD' }}
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-3 mb-3">
            <i class="fa fa-circle-check me-2"></i>{{ session('success') }}
        </div>
        @endif

        <div class="card-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-semibold text-dark"><i class="fa-solid fa-graduation-cap text-primary me-2"></i>Data Nilai Kuliah</h6>
                
                <button class="btn btn-success btn-sm rounded-3 px-3" data-bs-toggle="modal" data-bs-target="#pilihKelasModal">
                    <i class="fa fa-plus me-1"></i> Tambah Nilai
                </button>
            </div>

            <table class="table table-bordered align-middle text-center shadow-sm">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Mata Kuliah</th>
                        <th width="70">SKS</th>
                        <th width="100">Nilai</th>
                        <th width="110">Bobot</th>
                        <th width="130">Status</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($khsRecords as $index => $k)
                    @php
                        $bobot = 0.00;
                        $status = 'Mengulang';
                        $badgeClass = 'bg-danger';

                        if ($k->nilai_huruf == 'A') { $bobot = 4.00; $status = 'Lulus'; $badgeClass = 'bg-success'; }
                        elseif ($k->nilai_huruf == 'B') { $bobot = 3.00; $status = 'Lulus'; $badgeClass = 'bg-success'; }
                        elseif ($k->nilai_huruf == 'C') { $bobot = 2.00; $status = 'Lulus'; $badgeClass = 'bg-success'; }
                        elseif ($k->nilai_huruf == 'D') { $bobot = 1.00; $status = 'Mengulang'; $badgeClass = 'bg-warning'; }
                        else { $bobot = 0.00; $status = 'Mengulang'; $badgeClass = 'bg-danger'; }
                        
                        $targetJadwal = $jadwals->where('mata_kuliah_id', $k->mata_kuliah_id)->first();
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-start fw-semibold text-dark">{{ $k->mahasiswa->nama_mahasiswa ?? $k->mahasiswa->nama ?? 'N/A' }}</td>
                        <td class="text-start text-secondary">{{ $k->matakuliah->nama_mk ?? 'N/A' }}</td>
                        <td>{{ $k->matakuliah->sks ?? 0 }}</td>
                        <td class="fw-bold">{{ $k->nilai_angka }} ({{ $k->nilai_huruf }})</td>
                        <td class="fw-bold text-primary">{{ number_format($bobot, 2) }}</td>
                        <td><span class="badge {{ $badgeClass }} px-2 py-1 text-white">{{ $status }}</span></td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ $targetJadwal ? route('dosen.nilai.input', $targetJadwal->id) : '#' }}" class="btn btn-sm btn-warning text-white rounded-2" title="Edit Nilai">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('dosen.nilai.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data nilai mahasiswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-2" title="Hapus Nilai">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="fa-solid fa-folder-open fa-2x mb-2 opacity-50 d-block"></i>
                            Belum ada rekap data nilai mahasiswa yang tersimpan di sistem database.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="pilihKelasModal" tabindex="-1" aria-labelledby="pilihKelasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="pilihKelasModalLabel">
                        <i class="fa-solid fa-layer-group text-primary me-2"></i> Pilih Kelas Kuliah
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form id="formPilihKelas">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Mata Kuliah yang Anda Ampu</label>
                            <select class="form-select rounded-3" id="idJadwalPilihan" required>
                                <option value="" disabled selected>-- Pilih Kelas Kuliah --</option>
                                @foreach($jadwals as $j)
                                    <option value="{{ $j->id }}">
                                        {{ $j->matakuliah->nama_mk ?? 'N/A' }} (Kelas Semester {{ $j->semester ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-light btn-sm rounded-3 px-3" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm rounded-3 px-3">Buka Form Input</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('formPilihKelas').addEventListener('submit', function(e) {
            e.preventDefault();
            const jadwalId = document.getElementById('idJadwalPilihan').value;
            if (jadwalId) {
                window.location.href = "{{ url('dosen/nilai/kelas') }}/" + jadwalId;
            }
        });
    </script>
</body>
</html>