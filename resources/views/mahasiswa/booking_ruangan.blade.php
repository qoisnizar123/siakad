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
            background: rgba(255, 255, 255, 0.1);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
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

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <strong>Booking Ruangan</strong>
        </div>

        <div class="row">
            <div class="col-12">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <div class="col-md-5">
                <div class="card-box shadow-sm border-0 p-4">
                    <h6 class="mb-3 fw-bold text-primary">Form Booking</h6>

                    <form action="{{ route('mahasiswa.booking.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}" required>
                                @error('jam_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jam Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}" required>
                                @error('jam_selesai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ruangan</label>
                            <select name="ruangan_id" class="form-select @error('ruangan_id') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Pilih Ruangan --</option>
                                @foreach($ruangan as $r)
                                <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                                @endforeach
                            </select>
                            @error('ruangan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keperluan</label>
                            <textarea name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" rows="3" placeholder="Contoh: Kerja kelompok Pemrograman Web" required>{{ old('keperluan') }}</textarea>
                            @error('keperluan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 shadow-sm">
                            <i class="fa fa-paper-plane me-2"></i> Ajukan Booking
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card-box shadow-sm border-0 p-4">
                    <h6 class="mb-3 fw-bold text-primary">Riwayat Booking</h6>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Ruangan</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $booking->ruangan->nama_ruangan }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td>
                                    <td>
                                        @if($booking->status == 'menunggu')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif($booking->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                        @else
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->status == 'menunggu' || $booking->status == 'dipesan')
                                        <form action="{{ route('mahasiswa.booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-trash-can"></i> Batal
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada riwayat booking.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>

</html>