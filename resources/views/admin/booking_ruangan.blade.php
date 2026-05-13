<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f1f5f9;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>

<body>

    <div class="main-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Manajemen Booking Ruangan</h4>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Mahasiswa</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Keperluan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $b)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $b->user->name }}</div>
                                        <small class="text-muted">{{ $b->user->email }}</small>
                                    </td>
                                    <td>{{ $b->ruangan->nama_ruangan }}</td>
                                    <td>
                                        <div>{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}</div>
                                        <span class="badge bg-info text-dark">{{ $b->jam_mulai }} - {{ $b->jam_selesai }}</span>
                                    </td>
                                    <td><small>{{ $b->keperluan }}</small></td>
                                    <td>
                                        <span class="badge {{ $b->status == 'disetujui' ? 'bg-success' : ($b->status == 'ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                                            {{ ucfirst($b->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($b->status == 'menunggu' || $b->status == 'dipesan')
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.booking.update', $b->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="disetujui">
                                                <button type="submit" class="btn btn-sm btn-success" title="Setujui">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.booking.update', $b->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Tolak">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan booking masuk.</td>
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

</html>