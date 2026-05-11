<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIAKAD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
        }

        /* HEADER */
        .topbar {
            background: #1e3a8a;
            color: white;
            padding: 14px 30px;
            font-size: 14px;
            font-weight: 500;
        }

        /* MAIN */
        .main-box {
            margin-top: 50px;
        }

        /* LEFT PANEL */
        .info-panel {
            background: white;
            border-radius: 10px;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }

        .info-title {
            font-weight: 600;
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            gap: 10px;
            padding: 12px 0;
            font-size: 14px;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        /* LOGIN PANEL */
        .login-panel {
            background: white;
            border-radius: 10px;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }

        .login-title {
            font-weight: 600;
        }

        .login-subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        /* INPUT */
        .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #1e3a8a;
            box-shadow: 0 0 0 2px rgba(30, 58, 138, 0.1);
        }

        /* BUTTON */
        .btn-login {
            background: #1e3a8a;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #162d6b;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="topbar d-flex justify-content-between">
        <div>
            <i class="fa-solid fa-graduation-cap me-2"></i>
            Sistem Informasi Akademik
        </div>
    </div>

    <div class="container main-box">
        <div class="row g-4">

            <!-- LEFT INFO -->
            <div class="col-md-7">
                <div class="info-panel">
                    <div class="info-title">🔐 Akses Sistem</div>

                    <div class="info-item">
                        <i class="fa fa-user-graduate text-primary"></i>
                        <div>
                            <strong>Mahasiswa</strong><br>
                            Akses KRS, KHS, Jadwal, dan Booking ruangan.
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa fa-chalkboard-teacher text-primary"></i>
                        <div>
                            <strong>Dosen</strong><br>
                            Input nilai, kelola jadwal, dan data perkuliahan.
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa fa-user-cog text-primary"></i>
                        <div>
                            <strong>Admin</strong><br>
                            Kelola data akademik, pengguna, dan sistem.
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fa fa-circle-info text-primary"></i>
                        <div>
                            Gunakan akun sesuai peran Anda untuk mengakses sistem.
                        </div>
                    </div>
                </div>
            </div>

            <!-- LOGIN -->
            <div class="col-md-5">
                <div class="login-panel">

                    <div class="text-center mb-4">
                        <i class="fa-solid fa-building-columns fs-2 text-primary"></i>
                        <div class="login-title mt-2">Portal Sistem</div>
                        <div class="login-subtitle">Silakan login sesuai peran Anda</div>
                    </div>

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf <div class="mb-3">
                            <label class="small">Login Sebagai</label>
                            <select class="form-control" name="role_view">
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="small">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                                <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                                    <i id="eyeIcon" class="fa fa-eye-slash"></i>
                                </span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="checkbox" name="remember"> <small>Ingat saya</small>
                </div>
                <small><a href="#">Lupa password?</a></small>
            </div>

            <button type="submit" class="btn btn-login w-100 text-white">
                Login
            </button>
            </form>
        </div>
    </div>

    </div>

    <div class="footer">
        © 2026 - Sistem Informasi Akademik
    </div>
    </div>

    function togglePassword() {
    pass.type = "text";
    icon.classList.replace("fa-eye-slash", "fa-eye");
    } else {
    pass.type = "password";
    icon.classList.replace("fa-eye", "fa-eye-slash");
    }
    }
    </script>

</body>

</html>