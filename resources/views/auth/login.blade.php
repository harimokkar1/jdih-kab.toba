<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - JDIH Kabupaten Toba</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy-dark: #101c2e;
            --navy-primary: #142239;
            --navy-lighter: #24354f;
            --gold: #D4A843;
            --gold-bright: #eab308;
        }

        body {
            background-color: var(--navy-dark);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(212, 168, 67, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(37, 99, 235, 0.08) 0%, transparent 40%);
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
        }

        .login-header {
            background: var(--navy-primary);
            padding: 30px 24px 24px;
            text-align: center;
            color: #ffffff;
            border-bottom: 3px solid var(--gold-bright);
        }

        .login-header-logos {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            margin-bottom: 14px;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.92rem;
            color: #0f172a;
        }

        .form-control:focus {
            border-color: var(--navy-primary);
            box-shadow: 0 0 0 3px rgba(20, 34, 57, 0.12);
        }

        .input-group-text {
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
        }

        .btn-login {
            background: var(--navy-primary);
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            border: none;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background: var(--navy-lighter);
            color: var(--gold-bright);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-header">
        <div class="login-header-logos">
            <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" height="34" class="rounded-circle">
            <img src="{{ asset('logo.png') }}" alt="Logo Toba" height="34">
        </div>
        <h5 class="fw-bold mb-1 letter-spacing-1">JDIH KABUPATEN TOBA</h5>
        <small class="text-white-50" style="font-size: 0.72rem;">Portal Administrasi Pengelolaan Dokumen Hukum</small>
    </div>

    <div class="p-4 p-sm-5">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show small rounded-3 border-0 d-flex align-items-center mb-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-danger me-2"></i>
                <div class="flex-grow-1">
                    {{ session('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Surat Elektronik (Email)</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control border-start-0" placeholder="admin@jdih.tobakab.go.id" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">Kata Sandi (Password)</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="passwordInput" class="form-control border-start-0 border-end-0" placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary border-start-0 input-group-text" type="button" onclick="togglePasswordVisibility()">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100 mb-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke Dasbor
            </button>

            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="small text-decoration-none text-muted fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda Portal
                </a>
            </div>
        </form>
    </div>

    <div class="text-center py-3 bg-light border-top text-muted small" style="font-size: 11.5px;">
        &copy; {{ date('Y') }} Bagian Hukum Setdakab Toba. Hak Cipta Dilindungi.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('toggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
</body>
</html>
