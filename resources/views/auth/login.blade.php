<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk Admin - JDIH Kabupaten Toba</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS & Bootstrap Icons 1.11.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy-darkest: #070e18;
            --navy-deep: #0c1829;
            --navy-primary: #10233e;
            --navy-hover: #172f53;
            --gold-accent: #f59e0b;
            --toba-red: #dc2626;
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-700: #334155;
            --slate-900: #0f172a;
            --radius-md: 10px;
            --radius-lg: 16px;
            --radius-pill: 9999px;
            --footer-height: 58px;
            --transition: all 0.2s ease-in-out;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--slate-50);
            color: var(--slate-900);
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Heritage Accent Line */
        .top-accent-line {
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, var(--toba-red) 0%, var(--gold-accent) 25%, var(--navy-primary) 50%, var(--gold-accent) 75%, var(--toba-red) 100%);
            flex-shrink: 0;
        }

        /* Full Height Split Layout */
        .auth-split-wrapper {
            display: flex;
            flex: 1 0 auto;
            min-height: calc(100vh - 3px);
            width: 100%;
        }

        /* -------------------------------------------------------------
           LEFT PANEL: BRAND & GOVERNMENT IDENTITY
        ------------------------------------------------------------- */
        .auth-hero-panel {
            flex: 1.05;
            background: linear-gradient(155deg, #091424 0%, #0d1e35 50%, #122846 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #ffffff;
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Map Silhouette Watermark */
        .auth-hero-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 130%;
            height: 130%;
            background-image: url("{{ asset('indonesia-map-bg.svg') }}");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            opacity: 0.04;
            pointer-events: none;
            z-index: 1;
            filter: invert(1);
        }

        /* Ambient Glow */
        .auth-hero-glow {
            position: absolute;
            top: 25%;
            left: 10%;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, transparent 70%);
            filter: blur(60px);
            pointer-events: none;
            z-index: 1;
        }

        /* Left Body (Vertically Centered) */
        .auth-hero-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 56px;
            position: relative;
            z-index: 2;
        }

        .auth-hero-content-inner {
            max-width: 500px;
        }

        /* Government Label */
        .gov-label-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: var(--radius-pill);
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            margin-bottom: 24px;
        }

        .gov-label-badge i {
            color: var(--gold-accent);
        }

        /* Dual Logo Lockup */
        .brand-logos-lockup {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            padding: 10px 18px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            backdrop-filter: blur(10px);
            margin-bottom: 24px;
        }

        .brand-logo-toba {
            height: 44px;
            width: auto;
            object-fit: contain;
        }

        .brand-logo-sep {
            width: 1px;
            height: 32px;
            background: rgba(255, 255, 255, 0.18);
        }

        .brand-logo-jdihn {
            height: 44px;
            width: 44px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Title & Desc */
        .brand-hero-title {
            font-size: 2.05rem;
            font-weight: 800;
            line-height: 1.25;
            letter-spacing: -0.4px;
            color: #ffffff;
            margin-bottom: 12px;
        }

        .brand-hero-title span {
            color: var(--gold-accent);
        }

        .brand-hero-desc {
            font-size: 0.94rem;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.72);
            margin: 0;
        }

        /* -------------------------------------------------------------
           RIGHT PANEL: LOGIN CONSOLE (ELEVATED CARD)
        ------------------------------------------------------------- */
        .auth-form-panel {
            flex: 0.95;
            background-color: var(--slate-50);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        /* Right Body (Vertically Centered) */
        .auth-form-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 36px;
        }

        /* Modern Card Container */
        .auth-card-wrapper {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-lg);
            padding: 36px 32px;
            box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.05), 0 4px 8px -4px rgba(15, 23, 42, 0.02);
        }

        /* Badge in Card */
        .auth-card-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-pill);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--slate-700);
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .auth-card-badge i {
            color: var(--navy-primary);
        }

        .auth-card-title {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--slate-900);
            letter-spacing: -0.4px;
            margin-bottom: 20px;
        }

        /* Form Inputs */
        .form-label-clean {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: 6px;
            display: block;
        }

        .input-group-clean {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            border: 1.5px solid var(--slate-300);
            border-radius: var(--radius-md);
            background-color: #ffffff;
            transition: var(--transition);
        }

        .input-group-clean:focus-within {
            border-color: var(--navy-primary);
            box-shadow: 0 0 0 3px rgba(16, 35, 62, 0.08);
        }

        .input-icon-left {
            padding-left: 14px;
            padding-right: 4px;
            color: var(--slate-400);
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .input-group-clean:focus-within .input-icon-left {
            color: var(--navy-primary);
        }

        .form-control-clean {
            flex: 1;
            border: none;
            padding: 11px 12px;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--slate-900);
            background: transparent;
            outline: none;
            font-family: inherit;
        }

        .form-control-clean::placeholder {
            color: var(--slate-400);
            font-weight: 400;
        }

        .btn-toggle-eye {
            border: none;
            background: transparent;
            padding: 0 14px;
            color: var(--slate-400);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: color 0.2s ease;
        }

        .btn-toggle-eye:hover {
            color: var(--navy-primary);
        }

        /* Checkbox & Help Link */
        .form-check-clean {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-check-clean input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--navy-primary);
            cursor: pointer;
            margin: 0;
        }

        .form-check-clean label {
            font-size: 0.81rem;
            font-weight: 500;
            color: var(--slate-700);
            cursor: pointer;
            margin: 0;
            user-select: none;
        }

        .link-help-clean {
            font-size: 0.81rem;
            font-weight: 600;
            color: var(--navy-primary);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .link-help-clean:hover {
            color: var(--navy-hover);
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-submit-clean {
            width: 100%;
            background: var(--navy-primary);
            color: #ffffff;
            font-size: 0.92rem;
            font-weight: 700;
            padding: 12px 18px;
            border-radius: var(--radius-md);
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: var(--transition);
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(16, 35, 62, 0.16);
        }

        .btn-submit-clean:hover {
            background: var(--navy-hover);
            color: #ffffff;
            box-shadow: 0 5px 15px rgba(16, 35, 62, 0.22);
            transform: translateY(-1px);
        }

        .btn-submit-clean:active {
            transform: translateY(0);
        }

        /* Back to Home Link below button */
        .link-back-home {
            display: inline-flex;
            align-items: center;
            font-size: 0.82rem;
            color: var(--slate-500);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .link-back-home:hover {
            color: var(--navy-primary);
        }

        .link-back-home i {
            transition: transform 0.2s ease;
        }

        .link-back-home:hover i {
            transform: translateX(-3px);
        }

        /* Security Hint Note */
        .auth-security-hint {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 0.74rem;
            color: var(--slate-400);
            margin-top: 18px;
            text-align: center;
        }

        .auth-security-hint i {
            color: var(--slate-400);
        }

        /* Caps Lock Warning */
        .caps-lock-badge {
            background-color: #fef3c7;
            border: 1px solid #fde68a;
            color: #b45309;
            font-size: 0.77rem;
            padding: 6px 12px;
            border-radius: var(--radius-md);
            margin-top: 8px;
            display: none;
            align-items: center;
            gap: 6px;
        }

        /* -------------------------------------------------------------
           FOOTERS: PERFECTLY SEJAJAR (SAME HEIGHT & BORDER-TOP)
        ------------------------------------------------------------- */
        .auth-hero-footer,
        .auth-form-footer {
            height: var(--footer-height);
            min-height: var(--footer-height);
            max-height: var(--footer-height);
            flex: 0 0 var(--footer-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.78rem;
            box-sizing: border-box;
            position: relative;
            z-index: 2;
        }

        .auth-hero-footer {
            padding: 0 56px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.55);
        }

        .auth-form-footer {
            padding: 0 36px;
            border-top: 1px solid var(--slate-200);
            color: var(--slate-400);
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-links a {
            color: var(--slate-500);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--navy-primary);
        }

        /* Helpdesk Modal Styling */
        .modal-content-help {
            border: none;
            border-radius: 16px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header-help {
            background: var(--navy-primary);
            color: #ffffff;
            padding: 18px 24px;
            border-bottom: 3px solid var(--gold-accent);
        }

        /* -------------------------------------------------------------
           RESPONSIVE ADJUSTMENTS
        ------------------------------------------------------------- */
        @media (max-width: 991.98px) {
            .auth-split-wrapper {
                flex-direction: column;
            }

            .auth-hero-panel {
                flex: none;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .auth-hero-body {
                padding: 36px 24px 24px;
            }

            .brand-hero-title {
                font-size: 1.6rem;
            }

            .brand-hero-desc {
                font-size: 0.88rem;
            }

            .auth-hero-footer {
                padding: 0 24px;
            }

            .auth-form-body {
                padding: 36px 20px 24px;
            }

            .auth-card-wrapper {
                max-width: 100%;
                padding: 28px 22px;
            }

            .auth-form-footer {
                padding: 0 24px;
                flex-direction: column;
                justify-content: center;
                gap: 6px;
                text-align: center;
                height: auto;
                min-height: var(--footer-height);
                max-height: none;
                padding-top: 12px;
                padding-bottom: 12px;
            }
        }
    </style>
</head>
<body>

<!-- Top Heritage Accent Line -->
<div class="top-accent-line"></div>

<div class="auth-split-wrapper">

    <!-- =========================================================
         LEFT PANEL: BRAND & GOVERNMENT IDENTITY
    ========================================================== -->
    <div class="auth-hero-panel">
        <!-- Background Lighting & Map Silhouette -->
        <div class="auth-hero-glow"></div>
        <div class="auth-hero-watermark"></div>

        <!-- Vertically Balanced Main Section -->
        <div class="auth-hero-body">
            <div class="auth-hero-content-inner">
                <!-- Government Label -->
                <div>
                    <span class="gov-label-badge">
                        <i class="bi bi-shield-check"></i>
                        Pemerintah Kabupaten Toba &bull; Setdakab
                    </span>
                </div>

                <!-- Dual Logos: Toba Emblem & JDIHN -->
                <div class="brand-logos-lockup">
                    <img src="{{ asset('logo.png') }}" alt="Lambang Kabupaten Toba" class="brand-logo-toba">
                    <div class="brand-logo-sep"></div>
                    <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN BPHN" class="brand-logo-jdihn">
                </div>

                <!-- Title & Subtitle -->
                <h1 class="brand-hero-title">
                    Portal Administrasi<br>
                    <span>JDIH Kabupaten Toba</span>
                </h1>
                <p class="brand-hero-desc">
                    Pusat autentikasi resmi pengelolaan dokumen, verifikasi regulasi, dan penyebarluasan informasi hukum daerah yang terintegrasi secara nasional.
                </p>
            </div>
        </div>

        <!-- Left Footer (Clean, No Colored Dot, Exactly Aligned) -->
        <div class="auth-hero-footer">
            <div>
                Server Portal Aktif &bull; Terlindungi SPBE
            </div>
            <div class="d-none d-xl-block fst-italic">
                &ldquo;Horas! Berintegritas &amp; Akuntabel&rdquo;
            </div>
        </div>
    </div>

    <!-- =========================================================
         RIGHT PANEL: LOGIN CONSOLE (ELEVATED CARD)
    ========================================================== -->
    <div class="auth-form-panel">
        
        <!-- Right Body: Center Elevated Card -->
        <div class="auth-form-body">
            <div class="auth-card-wrapper">

                <!-- Title & Subtitle -->
                <h2 class="auth-card-title">Selamat Datang</h2>

                <!-- Error Alerts (Session Error) -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 d-flex align-items-center mb-3 shadow-sm py-2 px-3" role="alert">
                        <i class="bi bi-exclamation-octagon-fill fs-5 text-danger me-2 flex-shrink-0"></i>
                        <div class="small fw-semibold flex-grow-1">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 mb-3 shadow-sm py-2 px-3" role="alert">
                        <div class="d-flex align-items-center mb-1">
                            <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>
                            <strong class="small">Periksa kembali data Anda:</strong>
                        </div>
                        <ul class="mb-0 ps-3 small text-danger">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Caps Lock Alert -->
                <div id="capsLockAlert" class="caps-lock-badge mb-3">
                    <i class="bi bi-capslock-fill"></i>
                    <span><strong>Caps Lock Aktif:</strong> Perhatikan huruf besar/kecil sandi Anda.</span>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" id="loginForm" autocomplete="on">
                    @csrf

                    <!-- Input: Email -->
                    <div class="mb-3">
                        <label for="emailInput" class="form-label-clean">Surat Elektronik (Email)</label>
                        <div class="input-group-clean">
                            <span class="input-icon-left">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input 
                                type="email" 
                                name="email" 
                                id="emailInput" 
                                class="form-control-clean" 
                                placeholder="admin@jdih.tobakab.go.id" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                autocomplete="username"
                            >
                        </div>
                    </div>

                    <!-- Input: Password -->
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label-clean">Kata Sandi</label>
                        <div class="input-group-clean">
                            <span class="input-icon-left">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input 
                                type="password" 
                                name="password" 
                                id="passwordInput" 
                                class="form-control-clean" 
                                placeholder="••••••••••••" 
                                required 
                                autocomplete="current-password"
                            >
                            <button 
                                type="button" 
                                class="btn-toggle-eye" 
                                id="togglePasswordBtn" 
                                onclick="togglePasswordVisibility()" 
                                title="Tampilkan / Sembunyikan Kata Sandi"
                                aria-label="Tampilkan atau sembunyikan kata sandi"
                            >
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Help Modal Trigger -->
                    <div class="d-flex align-items-center justify-content-between mb-4 mt-2">
                        <div class="form-check-clean">
                            <input type="checkbox" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberMe">Ingat saya di perangkat ini</label>
                        </div>

                        <a href="javascript:void(0)" class="link-help-clean" data-bs-toggle="modal" data-bs-target="#helpDeskModal">
                            Bantuan Akses?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-submit-clean" id="btnSubmit">
                        <span id="btnSubmitText">
                            Masuk
                        </span>
                        <span id="btnSubmitSpinner" class="d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            Memverifikasi Kredensial...
                        </span>
                    </button>
                </form>

            </div>
        </div>

        <!-- Right Footer (Clean, Exactly Aligned Line) -->
        <div class="auth-form-footer">
            <div>
                &copy; {{ date('Y') }} Bagian Hukum Setdakab Toba.
            </div>
            <div class="footer-links">
                <a href="{{ route('home') }}">Beranda</a>
                <span>&bull;</span>
                <a href="https://jdihn.go.id" target="_blank" rel="noopener noreferrer">JDIHN Pusat</a>
                <span>&bull;</span>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#helpDeskModal">Bantuan</a>
            </div>
        </div>

    </div>

</div>

<!-- =========================================================
     MODAL: BANTUAN AKSES & KONTAK KEDINASAN
========================================================== -->
<div class="modal fade" id="helpDeskModal" tabindex="-1" aria-labelledby="helpDeskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-help">
            <div class="modal-header modal-header-help">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-headset fs-4 text-warning"></i>
                    <div>
                        <h6 class="modal-title fw-bold text-white mb-0" id="helpDeskModalLabel">Bantuan Akses Pengelola JDIH</h6>
                        <small class="text-white-50" style="font-size: 11px;">Bagian Hukum Sekretariat Daerah Kabupaten Toba</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-3">
                    <div class="d-inline-flex p-3 rounded-circle bg-light text-primary mb-2">
                        <i class="bi bi-key-fill fs-3 text-warning"></i>
                    </div>
                    <h6 class="fw-bold mb-1">Lupa Kata Sandi atau Butuh Akun Baru?</h6>
                    <p class="text-muted small mb-0">
                        Untuk menjaga keamanan data regulasi daerah, permohonan reset sandi dan pendaftaran operator baru dilakukan melalui verifikasi kedinasan resmi.
                    </p>
                </div>

                <div class="list-group list-group-flush border rounded-3 overflow-hidden mb-3 small">
                    <div class="list-group-item d-flex align-items-center gap-3 py-2">
                        <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Alamat Kantor:</strong>
                            <span class="text-muted">Bagian Hukum Setdakab Toba, Jl. Sutomo No. 1, Balige 22312</span>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center gap-3 py-2">
                        <i class="bi bi-envelope-fill text-primary fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Surat Elektronik:</strong>
                            <a href="mailto:jdih@tobakab.go.id" class="text-decoration-none text-primary">jdih@tobakab.go.id</a> / <a href="mailto:hukum@tobakab.go.id" class="text-decoration-none text-primary">hukum@tobakab.go.id</a>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center gap-3 py-2">
                        <i class="bi bi-clock-fill text-success fs-5"></i>
                        <div>
                            <strong class="d-block text-dark">Jam Operasional Layanan:</strong>
                            <span class="text-muted">Senin &ndash; Jumat, 08.00 &ndash; 16.00 WIB</span>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info border-0 rounded-3 small py-2 px-3 mb-0">
                    <i class="bi bi-info-circle-fill me-1 text-info"></i>
                    Silakan hubungi <strong>Super Administrator</strong> internal Bagian Hukum untuk penerbitan ulang kredensial akun Anda.
                </div>
            </div>
            <div class="modal-footer bg-light py-2 px-4">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 1. Password Visibility Toggle
    function togglePasswordVisibility() {
        const input = document.getElementById('passwordInput');
        const icon = document.getElementById('toggleIcon');
        if (!input || !icon) return;

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

    // 2. Caps Lock Warning Detector
    const passwordInput = document.getElementById('passwordInput');
    const capsLockAlert = document.getElementById('capsLockAlert');

    if (passwordInput && capsLockAlert) {
        ['keydown', 'keyup'].forEach(eventType => {
            passwordInput.addEventListener(eventType, function(event) {
                if (event.getModifierState && event.getModifierState('CapsLock')) {
                    capsLockAlert.style.display = 'flex';
                } else {
                    capsLockAlert.style.display = 'none';
                }
            });
        });

        passwordInput.addEventListener('blur', function() {
            capsLockAlert.style.display = 'none';
        });
    }

    // 3. Form Submit Loading State
    const loginForm = document.getElementById('loginForm');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnSubmitText = document.getElementById('btnSubmitText');
    const btnSubmitSpinner = document.getElementById('btnSubmitSpinner');

    if (loginForm && btnSubmit) {
        loginForm.addEventListener('submit', function() {
            btnSubmit.disabled = true;
            if (btnSubmitText) btnSubmitText.classList.add('d-none');
            if (btnSubmitSpinner) btnSubmitSpinner.classList.remove('d-none');
        });
    }
</script>

</body>
</html>