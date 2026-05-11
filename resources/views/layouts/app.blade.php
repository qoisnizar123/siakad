<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #1e3a8a 0%, #1e40af 100%);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background: white;
            border-radius: 10px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            height: fit-content;
        }

        .sidebar-item {
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .sidebar-item:hover {
            background: #f3f4f6;
            margin-left: 5px;
        }

        .sidebar-item.active {
            background: #1e3a8a;
            color: white;
            font-weight: 600;
        }

        .main-content {
            background: white;
            border-radius: 10px;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }

        .card-custom {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .btn-logout {
            background: #dc2626;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: #b91c1c;
            color: white;
        }
    </style>

    @yield('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-white fw-bold" href="#">
                <i class="fa-solid fa-graduation-cap me-2"></i>
                SIAKAD
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-white small">{{ Auth::user()->name }}</span>
                <span class="badge bg-light text-dark">{{ ucfirst(Auth::user()->role) }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout btn-sm text-white">
                        <i class="fa-solid fa-sign-out-alt me-1"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container-fluid py-4">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i>
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- SIDEBAR -->
            @yield('sidebar')

            <!-- CONTENT -->
            <div class="col-md-9">
                <div class="main-content">
                    <h1 class="mb-4">@yield('page-title')</h1>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>
