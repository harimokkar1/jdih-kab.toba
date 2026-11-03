<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - JDIH Kabupaten Toba</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #06172e 0%, #0b2545 50%, #134074 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            background: #0b2545;
            padding: 30px 24px;
            text-align: center;
            color: #ffffff;
            border-bottom: 3px solid #d4a373;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus {
            border-color: #134074;
            box-shadow: 0 0 0 3px rgba(19, 64, 116, 0.15);
        }

        .btn-login {
            background: #0b2545;
            color: #ffffff;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: none;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #134074;
            color: #ffffff;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="container p-3">
    <div class="login-card mx-auto">
        <div class="login-header">
            <img src="{{ asset('logo.png') }}" alt="Logo Toba" height="56" class="mb-2">
            <h5 class="fw-bold mb-0">JDIH KABUPATEN TOBA</h5>
            <small class="text-light opacity-75">Sistem Informasi Dokumentasi Hukum</small>
        </div>

        <div class="p-4">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Email Pengguna</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="admin@jdih.tobakab.go.id" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 shadow-sm mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Panel Admin
                </button>

                <div class="text-center">
                    <a href="{{ route('home') }}" class="small text-decoration-none text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda Portal
                    </a>
                </div>
            </form>
        </div>

        <div class="text-center py-3 bg-light border-top text-muted small" style="font-size: 11px;">
            &copy; {{ date('Y') }} Bagian Hukum Setdakab Toba. All Rights Reserved.
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
