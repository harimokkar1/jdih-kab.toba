<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'JDIH Kabupaten Toba - Jaringan Dokumentasi dan Informasi Hukum')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons 1.11.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Portal Modern CSS -->
    <link href="{{ asset('css/portal.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    <!-- TOP HEADER BAR -->
    <div class="top-header d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="bi bi-geo-alt me-1 text-warning"></i> Jl. Sutomo, Pagar Batu, Balige, Kab. Toba</span>
                <span><i class="bi bi-envelope me-1 text-warning"></i> hukumtobasamosirkab@gmail.com</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="https://jdihn.go.id" target="_blank" class="text-decoration-none text-light opacity-75 hover-opacity-100">
                    <img src="{{ asset('logo-jdihn.jpg') }}" alt="JDIHN" height="18" class="me-1 rounded-1"> JDIH Nasional
                </a>
                <span>|</span>
                <span class="text-warning"><i class="bi bi-clock me-1"></i> {{ now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('logo_jdihn-toba.png') }}" alt="Logo JDIH Toba" height="46">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Beranda
                        </a>
                    </li>

                    <!-- MENU PROFIL -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('sejarah', 'visi', 'organisasi', 'kontak') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            Profil
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="{{ route('sejarah') }}"><i class="bi bi-clock-history me-2 text-primary"></i> Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('visi') }}"><i class="bi bi-compass me-2 text-primary"></i> Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('struktur') }}"><i class="bi bi-diagram-3 me-2 text-primary"></i> Struktur Organisasi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('kontak') }}"><i class="bi bi-telephone me-2 text-primary"></i> Kontak Kami</a></li>
                        </ul>
                    </li>

                    <!-- MENU PRODUK HUKUM DINAMIS (Requirement #4) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('produk-hukum*', 'kategori*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            Produk Hukum
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li>
                                <a class="dropdown-item fw-bold text-primary" href="{{ route('user.produk-hukum.global') }}">
                                    <i class="bi bi-grid-fill me-2"></i> Semua Produk Hukum
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            @if(isset($navJenisPeraturan) && $navJenisPeraturan->count() > 0)
                                @foreach($navJenisPeraturan as $itemJenis)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.produk-hukum.jenis', $itemJenis->slug) }}">
                                            <i class="bi bi-file-earmark-text me-2 text-muted"></i> {{ $itemJenis->nama }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li><a class="dropdown-item" href="{{ route('user.produk-hukum.global') }}">Peraturan Daerah</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.produk-hukum.global') }}">Peraturan Bupati</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.produk-hukum.global') }}">Keputusan Bupati</a></li>
                            @endif
                        </ul>
                    </li>

                    <!-- MENU INFORMASI -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('berita*', 'pengumuman*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                            Informasi
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="{{ route('berita') }}"><i class="bi bi-newspaper me-2 text-primary"></i> Berita Hukum</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengumuman.index') }}"><i class="bi bi-megaphone me-2 text-primary"></i> Pengumuman</a></li>
                        </ul>
                    </li>

                    <!-- BUTTON CARI DOKUMEN -->
                    <li class="nav-item ms-lg-2 my-2 my-lg-0">
                        <a class="btn btn-outline-warning btn-sm px-3 rounded-pill" href="{{ route('user.cari') }}">
                            <i class="bi bi-search me-1"></i> Cari Dokumen
                        </a>
                    </li>

                    <!-- ADMIN / LOGIN -->
                    <li class="nav-item ms-lg-2">
                        @auth
                            <a class="btn btn-light btn-sm px-3 rounded-pill fw-semibold" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        @else
                            <a class="nav-link text-warning fw-semibold" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                            </a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- NOTIFIKASI FLASH MESSAGE -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- FOOTER WITH VISITOR STATISTICS (Requirement #2) -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <!-- KOLOM 1: TENTANG -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget-title">JDIH Kabupaten Toba</div>
                    <p class="small text-muted mb-3" style="line-height: 1.7;">
                        Jaringan Dokumentasi dan Informasi Hukum (JDIH) Pemerintah Kabupaten Toba adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan sebagai sarana pemberian pelayanan informasi hukum yang mudah, cepat, dan akurat.
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('logo.png') }}" alt="Logo Toba" height="40">
                        <img src="{{ asset('logo-jdihn.jpg') }}" alt="Logo JDIHN" height="40" class="rounded">
                    </div>
                </div>

                <!-- KOLOM 2: MENU CEPAT -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget-title">Menu Cepat</div>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1"></i> Beranda</a></li>
                        <li><a href="{{ route('user.produk-hukum.global') }}"><i class="bi bi-chevron-right me-1"></i> Produk Hukum</a></li>
                        <li><a href="{{ route('user.cari') }}"><i class="bi bi-chevron-right me-1"></i> Cari Peraturan</a></li>
                        <li><a href="{{ route('berita') }}"><i class="bi bi-chevron-right me-1"></i> Berita Hukum</a></li>
                        <li><a href="{{ route('pengumuman.index') }}"><i class="bi bi-chevron-right me-1"></i> Pengumuman</a></li>
                        <li><a href="{{ route('api.jdihn.index') }}" target="_blank"><i class="bi bi-code-slash me-1 text-warning"></i> API JDIHN</a></li>
                    </ul>
                </div>

                <!-- KOLOM 3: KONTAK -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget-title">Kontak Kami</div>
                    <ul class="list-unstyled small text-muted d-flex flex-column gap-2 mb-0">
                        <li class="d-flex gap-2">
                            <i class="bi bi-geo-alt-fill text-warning flex-shrink-0 mt-1"></i>
                            <span>Bagian Hukum Sekretariat Daerah Kabupaten Toba, Jl. Sutomo, Balige 22385</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-telephone-fill text-warning flex-shrink-0 mt-1"></i>
                            <span>0813-6244-4195</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-envelope-fill text-warning flex-shrink-0 mt-1"></i>
                            <span>hukumtobasamosirkab@gmail.com</span>
                        </li>
                    </ul>
                </div>

                <!-- KOLOM 4: STATISTIK PENGUNJUNG (Requirement #2) -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget-title">Statistik Pengunjung</div>
                    <div class="visitor-stat-box">
                        <div class="visitor-stat-row">
                            <span class="stat-label"><i class="bi bi-circle-fill text-success" style="font-size: 8px;"></i> Online</span>
                            <span class="stat-val text-success">{{ number_format($visitorStats['online'] ?? 1, 0, ',', '.') }}</span>
                        </div>
                        <div class="visitor-stat-row">
                            <span class="stat-label"><i class="bi bi-calendar-check text-info"></i> Hari Ini</span>
                            <span class="stat-val">{{ number_format($visitorStats['hari_ini'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="visitor-stat-row">
                            <span class="stat-label"><i class="bi bi-calendar-minus text-secondary"></i> Kemarin</span>
                            <span class="stat-val">{{ number_format($visitorStats['kemarin'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="visitor-stat-row">
                            <span class="stat-label"><i class="bi bi-calendar3 text-warning"></i> Minggu Ini</span>
                            <span class="stat-val">{{ number_format($visitorStats['minggu_ini'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="visitor-stat-row pt-2 mt-1 border-top border-secondary">
                            <span class="stat-label fw-bold text-light"><i class="bi bi-people-fill text-primary"></i> Total Pengunjung</span>
                            <span class="stat-val text-warning fw-bold">{{ number_format($visitorStats['total'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOOTER BOTTOM -->
            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-2">
                <div>
                    &copy; {{ date('Y') }} <strong>JDIH Kabupaten Toba</strong>. All Rights Reserved.
                </div>
                <div class="d-flex gap-3">
                    <a href="https://span.lapor.go.id" target="_blank" class="small"><i class="bi bi-megaphone me-1"></i> SP4N-LAPOR!</a>
                    <a href="https://jdihn.go.id" target="_blank" class="small"><i class="bi bi-shield-check me-1"></i> Portal JDIHN</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
