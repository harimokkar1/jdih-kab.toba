<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'JDIH Kabupaten Toba - Jaringan Dokumentasi dan Informasi Hukum')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Portal Custom CSS (JDIHN.GO.ID Minimalist Modern Style + Toba Heritage) -->
    <link href="{{ asset('css/portal.css') }}?v={{ time() }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- OFFICIAL GOV UTILITY TOPBAR -->
    <div class="gov-utility-topbar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Left Side: Refined Dynamic DateTime Capsule -->
            <div class="gov-topbar-datetime">
                <span class="gov-datetime-item">
                    <i class="bi bi-calendar3"></i>
                    <span id="tobaDateText">Memuat tanggal...</span>
                </span>
                <span class="gov-datetime-sep"></span>
                <span class="gov-datetime-item">
                    <i class="bi bi-clock"></i>
                    <span id="tobaClockText" class="gov-clock-digits">00:00:00</span>
                    <span class="gov-clock-zone">WIB</span>
                </span>
            </div>

            <!-- Right Side: Fast Portal Links -->
            <div class="gov-topbar-links">
                <a href="https://tobakab.go.id" target="_blank" rel="noopener noreferrer" class="gov-topbar-link">
                    <i class="bi bi-globe2"></i>
                    <span>Pemkab Toba</span>
                    <i class="bi bi-arrow-up-right gov-ext-icon"></i>
                </a>
                <span class="gov-topbar-sep"></span>
                <a href="https://www.lapor.go.id" target="_blank" rel="noopener noreferrer" class="gov-topbar-link">
                    <i class="bi bi-megaphone"></i>
                    <span>SP4N-LAPOR!</span>
                    <i class="bi bi-arrow-up-right gov-ext-icon"></i>
                </a>
                <span class="gov-topbar-sep"></span>
                <a href="{{ route('kontak') }}" class="gov-topbar-link">
                    <i class="bi bi-envelope"></i>
                    <span>Kontak</span>
                </a>
            </div>
        </div>
    </div>

    <!-- JDIHN FLOATING PILL NAVBAR -->
    <header class="header-floating-wrapper">
        <div class="container">
            <nav class="navbar navbar-expand-lg jdihn-pill-navbar">
                <!-- BRAND LOGO & TITLE -->
                <a class="navbar-brand d-flex align-items-center py-0 me-3" href="{{ route('home') }}">
                    <div class="brand-logos">
                        <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" class="brand-jdihn-img">
                        <img src="{{ asset('logo.png') }}" alt="Logo Toba" class="brand-crest-img">
                    </div>
                    <div class="brand-text-wrapper d-none d-sm-flex flex-column">
                        <span class="brand-title">JDIH Kabupaten Toba</span>
                        <span class="brand-subtitle">Dokumentasi &amp; Informasi Hukum</span>
                    </div>
                </a>

                <!-- MOBILE TOGGLER -->
                <button class="navbar-toggler border-0 shadow-none p-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPillContent" aria-controls="navbarPillContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-3 text-dark"></i>
                </button>

                <!-- NAV MENU -->
                <div class="collapse navbar-collapse" id="navbarPillContent">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-1 gap-lg-2 my-2 my-lg-0">
                        <!-- BERANDA -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                Beranda
                            </a>
                        </li>

                        <!-- DOKUMEN / PRODUK HUKUM DROPDOWN -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('produk-hukum*', 'kategori*') ? 'active' : '' }}" href="{{ route('user.produk-hukum.global') }}" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                Dokumen
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item dropdown-item-featured {{ request()->routeIs('user.produk-hukum.global') ? 'active' : '' }}" href="{{ route('user.produk-hukum.global') }}">
                                        <span>Semua Produk Hukum</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @if(isset($navJenisPeraturan) && $navJenisPeraturan->count() > 0)
                                    @foreach($navJenisPeraturan as $itemJenis)
                                        <li>
                                            <a class="dropdown-item {{ (request()->routeIs('user.produk-hukum.jenis') && request()->route('slug') == $itemJenis->slug) ? 'active' : '' }}" href="{{ route('user.produk-hukum.jenis', $itemJenis->slug) }}">
                                                <span>{{ $itemJenis->nama }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li><a class="dropdown-item" href="{{ route('user.produk-hukum.global') }}"><span>Peraturan Daerah</span></a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.produk-hukum.global') }}"><span>Peraturan Bupati</span></a></li>
                                    <li><a class="dropdown-item" href="{{ route('user.produk-hukum.global') }}"><span>Keputusan Bupati</span></a></li>
                                @endif
                            </ul>
                        </li>

                        <!-- PROFIL DROPDOWN -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('sejarah', 'visi', 'organisasi', 'kontak') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('sejarah') ? 'active' : '' }}" href="{{ route('sejarah') }}">
                                        <span>Sejarah JDIH</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('visi') ? 'active' : '' }}" href="{{ route('visi') }}">
                                        <span>Visi &amp; Misi</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('struktur') ? 'active' : '' }}" href="{{ route('struktur') }}">
                                        <span>Struktur Organisasi</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">
                                        <span>Kontak Kami</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- INFORMASI DROPDOWN -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('berita*', 'pengumuman*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                Informasi
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ request()->is('berita*') ? 'active' : '' }}" href="{{ route('berita') }}">
                                        <span>Berita Hukum</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request()->is('pengumuman*') ? 'active' : '' }}" href="{{ route('pengumuman.index') }}">
                                        <span>Pengumuman</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- DASHBOARD ADMIN (IF LOGGED IN) -->
                        @auth
                            <li class="nav-item ms-lg-1">
                                <a class="btn btn-sm btn-dark rounded-pill px-3 py-1 fw-bold" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- FLASH MESSAGES (Hanya muncul jika ada pesan aktif) -->
    @if(session('success') || session('error'))
        <div class="container py-2">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 d-flex align-items-center mb-0" role="alert">
                    <i class="bi bi-check-circle-fill text-success fs-5 me-2"></i>
                    <div class="flex-grow-1">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 d-flex align-items-center mb-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-5 me-2"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    @endif

    <!-- MAIN BODY -->
    <main class="flex-grow-1 d-flex flex-column">
        @yield('content')
    </main>

    <!-- ============================================================
         OFFICIAL EXECUTIVE FOOTER (CLEAN, PROFESSIONAL & ESSENTIAL)
         ============================================================ -->
    <footer class="footer-modern mt-auto">
        <!-- Top Gradient Hairline Accent -->
        <div class="footer-accent-bar"></div>

        <div class="container py-5">
            <div class="row g-4 g-lg-5">
                <!-- KOLOM 1: IDENTITAS RESMI & KONTAK CEPAT -->
                <div class="col-lg-6 col-md-12">
                    <div class="footer-brand mb-3">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ asset('logo.png') }}" alt="Logo Pemkab Toba" style="height: 42px; width: auto; object-fit: contain;">
                            <div style="width: 1px; height: 32px; background: rgba(255, 255, 255, 0.15);"></div>
                            <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" style="height: 42px; width: auto; object-fit: contain; border-radius: 50%;">
                            <div>
                                <h6 class="footer-brand-title mb-0">JDIH KABUPATEN TOBA</h6>
                                <span class="footer-brand-sub">Bagian Hukum Setdakab</span>
                            </div>
                        </div>
                        <p class="footer-desc mb-3">
                            Portal resmi dokumentasi dan informasi hukum Pemerintah Kabupaten Toba yang terintegrasi dengan basis data nasional JDIHN Badan Pembinaan Hukum Nasional.
                        </p>
                        <div class="footer-contact-compact">
                            <div class="footer-contact-line">
                                <i class="bi bi-geo-alt-fill text-warning"></i>
                                <span>Jl. Sutomo, Pagar Batu, Balige, Kab. Toba, Sumut 22385</span>
                            </div>
                            <div class="footer-contact-line">
                                <i class="bi bi-whatsapp text-success"></i>
                                <a href="https://wa.me/6281362444195" target="_blank" rel="noopener noreferrer">0813-6244-4195</a>
                            </div>
                            <div class="footer-contact-line">
                                <i class="bi bi-envelope-fill text-info"></i>
                                <a href="mailto:hukumtobasamosirkab@gmail.com">hukumtobasamosirkab@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM 2: PRODUK HUKUM -->
                <div class="col-lg-3 col-sm-6 col-6">
                    <div class="footer-nav-col">
                        <h6 class="footer-col-heading">PRODUK HUKUM</h6>
                        <ul class="footer-menu-list list-unstyled">
                            <li><a href="{{ route('user.peraturan-daerah') }}"><i class="bi bi-chevron-right me-1"></i> Peraturan Daerah</a></li>
                            <li><a href="{{ route('user.peraturan-bupati') }}"><i class="bi bi-chevron-right me-1"></i> Peraturan Bupati</a></li>
                            <li><a href="{{ route('user.keputusan-bupati') }}"><i class="bi bi-chevron-right me-1"></i> Keputusan Bupati</a></li>
                            <li><a href="{{ route('user.produk-hukum.global') }}"><i class="bi bi-chevron-right me-1"></i> Semua Regulasi</a></li>
                        </ul>
                    </div>
                </div>

                <!-- KOLOM 3: TENTANG & INFORMASI -->
                <div class="col-lg-3 col-sm-6 col-6">
                    <div class="footer-nav-col">
                        <h6 class="footer-col-heading">KELEMBAGAAN</h6>
                        <ul class="footer-menu-list list-unstyled">
                            <li><a href="{{ route('sejarah') }}"><i class="bi bi-chevron-right me-1"></i> Sejarah JDIH</a></li>
                            <li><a href="{{ route('visi') }}"><i class="bi bi-chevron-right me-1"></i> Visi &amp; Misi</a></li>
                            <li><a href="{{ route('struktur') }}"><i class="bi bi-chevron-right me-1"></i> Struktur Tim</a></li>
                            <li><a href="{{ route('berita') }}"><i class="bi bi-chevron-right me-1"></i> Berita Hukum</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER BOTTOM SUB-BAR -->
        <div class="footer-bottom-modern py-3">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="footer-copyright small text-center text-md-start">
                    &copy; {{ date('Y') }} <strong>Pemerintah Kabupaten Toba</strong> &mdash; Bagian Hukum Sekretariat Daerah. Hak Cipta Dilindungi.
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="https://jdihn.go.id" target="_blank" rel="noopener noreferrer" class="footer-action-circle" title="JDIHN BPHN Nasional">
                        <i class="bi bi-globe2"></i>
                    </a>
                    <a href="mailto:hukumtobasamosirkab@gmail.com" class="footer-action-circle" title="Kirim Surel Resmi">
                        <i class="bi bi-envelope"></i>
                    </a>
                    <a href="https://wa.me/6281362444195" target="_blank" rel="noopener noreferrer" class="footer-action-circle" title="Layanan WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODAL PRATINJAU PDF CEPAT (MODERN PDF.JS CANVAS PREVIEW - ANTI AUTO DOWNLOAD) -->
    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                <div class="modal-header text-white py-3 px-3 px-md-4" style="background: linear-gradient(135deg, #0e223d 0%, #173860 100%) !important;">
                    <div class="d-flex align-items-center gap-2 text-truncate me-2 me-md-3">
                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-5"></i>
                        <h6 class="modal-title mb-0 text-truncate fw-bold text-white" id="pdfPreviewModalLabel">Pratinjau Dokumen</h6>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2 flex-shrink-0 ms-auto">
                        <!-- Page Navigator Controls -->
                        <div class="d-flex align-items-center gap-1 bg-white bg-opacity-10 px-2 py-1 rounded-pill border border-white border-opacity-10">
                            <button type="button" id="modalPdfPrev" class="btn btn-sm text-white p-0 px-1 border-0" title="Halaman Sebelumnya" disabled>
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <span class="small text-white px-1 user-select-none" style="font-size: 0.76rem;">
                                Hal <span id="modalPdfPageNum" class="fw-bold">1</span> / <span id="modalPdfTotalPages" class="fw-bold">--</span>
                            </span>
                            <button type="button" id="modalPdfNext" class="btn btn-sm text-white p-0 px-1 border-0" title="Halaman Berikutnya" disabled>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>

                        <!-- Zoom Controls -->
                        <div class="d-none d-sm-flex align-items-center gap-1 bg-white bg-opacity-10 px-2 py-1 rounded-pill border border-white border-opacity-10">
                            <button type="button" id="modalPdfZoomOut" class="btn btn-sm text-white p-0 px-1 border-0" title="Perkecil">
                                <i class="bi bi-dash-lg"></i>
                            </button>
                            <span id="modalPdfZoomLevel" class="small text-white px-1 user-select-none" style="font-size: 0.76rem;">100%</span>
                            <button type="button" id="modalPdfZoomIn" class="btn btn-sm text-white p-0 px-1 border-0" title="Perbesar">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>

                        <!-- Only THIS button downloads the file -->
                        <a href="#" id="modalPdfDownloadBtn" class="btn btn-sm btn-warning text-dark rounded-pill px-3 py-1 fw-bold shadow-sm" title="Unduh Berkas PDF">
                            <i class="bi bi-download me-1"></i> Unduh PDF
                        </a>
                        <button type="button" class="btn-close btn-close-white ms-1" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                </div>
                
                <div class="modal-body p-0 position-relative text-center overflow-auto" id="modalPdfContainer" style="height: 75vh; min-height: 520px; background: #323639;">
                    <!-- Loading state -->
                    <div id="modalPdfLoading" class="position-absolute top-50 start-50 translate-middle text-center text-white">
                        <div class="spinner-border text-light mb-2" role="status"></div>
                        <p class="small text-white-50 mb-0">Sedang memuat pratinjau naskah...</p>
                    </div>

                    <!-- Error state -->
                    <div id="modalPdfError" class="py-5 text-center text-white" style="display: none; padding-top: 100px !important;">
                        <i class="bi bi-file-earmark-x fs-1 text-warning mb-2 d-block"></i>
                        <h6 class="text-white mb-2">Pratinjau Naskah Tidak Tersedia</h6>
                        <p class="small text-white-50 mb-3">Naskah digital belum diunggah atau tidak dapat ditampilkan langsung.</p>
                        <a href="#" id="modalPdfFallbackDownload" class="btn btn-sm btn-primary rounded-pill px-4">
                            <i class="bi bi-download me-1"></i> Coba Unduh Berkas
                        </a>
                    </div>

                    <!-- Canvas where PDF is rendered -->
                    <div class="p-3 d-flex justify-content-center">
                        <canvas id="modalPdfCanvas" class="shadow-lg mx-auto" style="display: none; max-width: 100%; height: auto; border-radius: 4px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- PDF.js Mozilla Local Engine (Anti Auto-Download Canvas Viewer) -->
    <script src="{{ asset('vendor/pdfjs/pdf.min.js') }}"></script>
    <script>
        if (window.pdfjsLib) {
            pdfjsLib.GlobalWorkerOptions.workerSrc = "{{ asset('vendor/pdfjs/pdf.worker.min.js') }}";
        }
    </script>
    <script>
        // Ctrl+K Shortcut for Search
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                e.preventDefault();
                const searchInput = document.querySelector('.smart-search-input');
                if (searchInput) {
                    searchInput.focus();
                } else {
                    window.location.href = "{{ route('user.cari') }}";
                }
            }
        });

        // Waktu Real-Time Pemkab Toba (Dinamis Berjalan Tiap Detik Tanpa Jitter)
        function updateTobaClock() {
            const clockEl = document.getElementById('tobaClockText');
            const dateEl = document.getElementById('tobaDateText');
            if (!clockEl) return;

            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clockEl.textContent = `${hours}:${minutes}:${seconds}`;

            if (dateEl && (!dateEl.getAttribute('data-init') || now.getSeconds() === 0)) {
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const dayName = days[now.getDay()];
                const day = String(now.getDate()).padStart(2, '0');
                const monthName = months[now.getMonth()];
                const year = now.getFullYear();
                dateEl.textContent = `${dayName}, ${day} ${monthName} ${year}`;
                dateEl.setAttribute('data-init', 'true');
            }
        }
        updateTobaClock();
        setInterval(updateTobaClock, 1000);

        // Efek Floating & Animasi Menyusut Saat Scroll (High-Performance 60fps)
        (function() {
            const header = document.querySelector('.header-floating-wrapper');
            const navbar = document.querySelector('.jdihn-pill-navbar');
            if (!header || !navbar) return;

            function checkScroll() {
                const scrollY = window.pageYOffset || document.documentElement.scrollTop || window.scrollY || 0;
                if (scrollY > 15) {
                    header.classList.add('header-scrolled');
                    navbar.classList.add('is-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                    navbar.classList.remove('is-scrolled');
                }
            }

            window.addEventListener('scroll', checkScroll, { passive: true });
            window.addEventListener('resize', checkScroll, { passive: true });
            document.addEventListener('DOMContentLoaded', checkScroll);
            checkScroll();
        })();

        // Dropdown Hover dengan Kontrol Eksklusif (Satu Tertutup Bersih Baru Satunya Terbuka - Anti-Overlap & Anti-Stuck)
        (function() {
            function initDropdownHover() {
                if (window.innerWidth < 992) return;
                
                const navbar = document.querySelector('.jdihn-pill-navbar');
                if (!navbar) return;

                const dropdownItems = navbar.querySelectorAll('.nav-item.dropdown');
                const nonDropdownItems = navbar.querySelectorAll('.nav-item:not(.dropdown), .navbar-brand');
                let activeDropdown = null;
                let closeTimer = null;

                function closeDropdown(item) {
                    if (!item) return;
                    item.classList.remove('is-open', 'show');
                    const toggle = item.querySelector('[data-bs-toggle="dropdown"]');
                    const menu = item.querySelector('.dropdown-menu');
                    if (toggle) {
                        toggle.classList.remove('show');
                        toggle.setAttribute('aria-expanded', 'false');
                        toggle.blur();
                    }
                    if (menu) {
                        menu.classList.remove('show');
                    }
                }

                function openDropdown(item) {
                    if (!item) return;
                    item.classList.add('is-open');
                    const toggle = item.querySelector('[data-bs-toggle="dropdown"]');
                    const menu = item.querySelector('.dropdown-menu');
                    if (toggle) {
                        toggle.classList.add('show');
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                    if (menu) {
                        menu.classList.add('show');
                    }
                    activeDropdown = item;
                }

                // Hover pada menu dropdown (Dokumen, Profil, Informasi)
                dropdownItems.forEach(function(item) {
                    item.addEventListener('mouseenter', function() {
                        if (closeTimer) {
                            clearTimeout(closeTimer);
                            closeTimer = null;
                        }

                        // JIKA ADA MENU LAIN YANG SEDANG TERBUKA: TUTUP LANGSUNG AGAR TIDAK TERTIMPA!
                        if (activeDropdown && activeDropdown !== item) {
                            closeDropdown(activeDropdown);
                            activeDropdown = null;
                        }

                        // Buka dropdown saat ini secara mulus
                        openDropdown(item);
                    });

                    item.addEventListener('mouseleave', function() {
                        closeTimer = setTimeout(function() {
                            if (activeDropdown === item) {
                                closeDropdown(item);
                                activeDropdown = null;
                            }
                        }, 120);
                    });

                    // Cegah browser outline / focus ring saat di-klik atau di-focus
                    const toggle = item.querySelector('[data-bs-toggle="dropdown"]');
                    if (toggle) {
                        toggle.addEventListener('focus', function() {
                            toggle.blur();
                        });
                        toggle.addEventListener('click', function() {
                            setTimeout(function() { toggle.blur(); }, 50);
                        });
                    }
                });

                // Hover pada item NON-DROPDOWN (seperti BERANDA & Logo):
                // Langsung tutup dropdown yang aktif seketika tanpa delay!
                nonDropdownItems.forEach(function(el) {
                    el.addEventListener('mouseenter', function() {
                        if (closeTimer) {
                            clearTimeout(closeTimer);
                            closeTimer = null;
                        }
                        if (activeDropdown) {
                            closeDropdown(activeDropdown);
                            activeDropdown = null;
                        }
                    });
                });

                // Tutup semua bila kursor keluar dari navbar
                navbar.addEventListener('mouseleave', function() {
                    if (closeTimer) clearTimeout(closeTimer);
                    closeTimer = setTimeout(function() {
                        if (activeDropdown) {
                            closeDropdown(activeDropdown);
                            activeDropdown = null;
                        }
                    }, 120);
                });
            }

            document.addEventListener('DOMContentLoaded', initDropdownHover);
            initDropdownHover();
            window.addEventListener('resize', initDropdownHover);
        })();

        // ============================================================
        // GLOBAL HANDLER UNTUK SEMUA MODERN & CUSTOM SELECT DROPDOWNS
        // ============================================================
        function initCustomFilterDropdowns() {
            document.querySelectorAll('.modern-select-dropdown, .custom-filter-dropdown').forEach(function(wrapper) {
                if (wrapper.dataset.customFilterInit) return;
                wrapper.dataset.customFilterInit = 'true';

                const input = wrapper.querySelector('input[type="hidden"]');
                const triggerBtn = wrapper.querySelector('.modern-select-btn, .custom-dropdown-btn');
                const currentIcon = wrapper.querySelector('.modern-select-prefix, .selected-icon-box');
                const currentLabel = wrapper.querySelector('.modern-select-label, .selected-label');
                const options = wrapper.querySelectorAll('.modern-select-item, .custom-dropdown-item');

                if (!options.length) return;

                options.forEach(function(opt) {
                    opt.addEventListener('click', function(e) {
                        e.preventDefault();
                        const val = this.getAttribute('data-value') ?? '';
                        const label = this.getAttribute('data-label') ?? '';
                        const icon = this.getAttribute('data-icon') ?? '';

                        // 1. Update hidden input
                        if (input) input.value = val;

                        // 2. Update trigger button display
                        if (currentLabel) currentLabel.textContent = label;
                        if (currentIcon && icon) {
                            currentIcon.className = 'bi ' + icon + ' modern-select-prefix';
                        }

                        // 3. Update active states
                        options.forEach(function(o) {
                            o.classList.remove('active');
                        });
                        this.classList.add('active');

                        // 4. Close bootstrap dropdown cleanly
                        if (triggerBtn && window.bootstrap && bootstrap.Dropdown) {
                            const bsDropdown = bootstrap.Dropdown.getInstance(triggerBtn);
                            if (bsDropdown) {
                                bsDropdown.hide();
                            }
                        }
                    });
                });
            });
        }
        document.addEventListener('DOMContentLoaded', initCustomFilterDropdowns);
        initCustomFilterDropdowns();

        // ============================================================
        // HANDLER PRATINJAU PDF MODAL (PDF.JS CANVAS - ANTI AUTO DOWNLOAD)
        // ============================================================
        const pdfModal = document.getElementById('pdfPreviewModal');
        let modalPdfDoc = null;
        let modalPdfPageNum = 1;
        let modalPdfScale = 1.25;
        let modalPdfPageRendering = false;
        let modalPdfPageNumPending = null;

        if (pdfModal) {
            const canvas = document.getElementById('modalPdfCanvas');
            const ctx = canvas ? canvas.getContext('2d') : null;
            const loading = document.getElementById('modalPdfLoading');
            const errorBox = document.getElementById('modalPdfError');
            const pageNumEl = document.getElementById('modalPdfPageNum');
            const totalPagesEl = document.getElementById('modalPdfTotalPages');
            const prevBtn = document.getElementById('modalPdfPrev');
            const nextBtn = document.getElementById('modalPdfNext');
            const zoomInBtn = document.getElementById('modalPdfZoomIn');
            const zoomOutBtn = document.getElementById('modalPdfZoomOut');
            const zoomLevelEl = document.getElementById('modalPdfZoomLevel');
            const downloadBtn = document.getElementById('modalPdfDownloadBtn');
            const modalTitle = document.getElementById('pdfPreviewModalLabel');
            const fallbackDownload = document.getElementById('modalPdfFallbackDownload');

            function renderModalPage(num) {
                if (!modalPdfDoc || !canvas || !ctx) return;
                modalPdfPageRendering = true;

                modalPdfDoc.getPage(num).then(function(page) {
                    const viewport = page.getViewport({ scale: modalPdfScale });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    const renderTask = page.render(renderContext);

                    renderTask.promise.then(function() {
                        modalPdfPageRendering = false;
                        if (loading) loading.style.display = 'none';
                        canvas.style.display = 'block';

                        if (modalPdfPageNumPending !== null) {
                            renderModalPage(modalPdfPageNumPending);
                            modalPdfPageNumPending = null;
                        }
                    }).catch(function() {
                        modalPdfPageRendering = false;
                    });
                }).catch(function() {
                    modalPdfPageRendering = false;
                    if (loading) loading.style.display = 'none';
                    if (errorBox) errorBox.style.display = 'block';
                });

                if (pageNumEl) pageNumEl.textContent = num;
                if (prevBtn) prevBtn.disabled = (num <= 1);
                if (nextBtn) nextBtn.disabled = (num >= (modalPdfDoc ? modalPdfDoc.numPages : 1));
            }

            function queueRenderModalPage(num) {
                if (modalPdfPageRendering) {
                    modalPdfPageNumPending = num;
                } else {
                    renderModalPage(num);
                }
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (modalPdfPageNum <= 1) return;
                    modalPdfPageNum--;
                    queueRenderModalPage(modalPdfPageNum);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    if (!modalPdfDoc || modalPdfPageNum >= modalPdfDoc.numPages) return;
                    modalPdfPageNum++;
                    queueRenderModalPage(modalPdfPageNum);
                });
            }

            if (zoomInBtn) {
                zoomInBtn.addEventListener('click', function() {
                    if (modalPdfScale >= 2.5) return;
                    modalPdfScale += 0.2;
                    if (zoomLevelEl) zoomLevelEl.textContent = Math.round(modalPdfScale * 100) + '%';
                    queueRenderModalPage(modalPdfPageNum);
                });
            }

            if (zoomOutBtn) {
                zoomOutBtn.addEventListener('click', function() {
                    if (modalPdfScale <= 0.6) return;
                    modalPdfScale -= 0.2;
                    if (zoomLevelEl) zoomLevelEl.textContent = Math.round(modalPdfScale * 100) + '%';
                    queueRenderModalPage(modalPdfPageNum);
                });
            }

            pdfModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (!button) return;

                const pdfUrl = button.getAttribute('data-pdf-url');
                const title = button.getAttribute('data-pdf-title') || 'Pratinjau Dokumen';
                const downloadUrl = button.getAttribute('data-pdf-download') || pdfUrl;

                if (modalTitle) modalTitle.textContent = title;
                if (downloadBtn) downloadBtn.href = downloadUrl;
                if (fallbackDownload) fallbackDownload.href = downloadUrl;

                if (loading) loading.style.display = 'block';
                if (errorBox) errorBox.style.display = 'none';
                if (canvas) canvas.style.display = 'none';

                modalPdfPageNum = 1;
                modalPdfScale = 1.25;
                if (zoomLevelEl) zoomLevelEl.textContent = '125%';
                if (pageNumEl) pageNumEl.textContent = '1';
                if (totalPagesEl) totalPagesEl.textContent = '--';
                if (prevBtn) prevBtn.disabled = true;
                if (nextBtn) nextBtn.disabled = true;

                if (window.pdfjsLib && pdfUrl) {
                    const loadingTask = pdfjsLib.getDocument({
                        url: pdfUrl,
                        cMapUrl: 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/cmaps/',
                        cMapPacked: true,
                    });

                    loadingTask.promise.then(function(pdfDoc) {
                        modalPdfDoc = pdfDoc;
                        if (totalPagesEl) totalPagesEl.textContent = pdfDoc.numPages;
                        renderModalPage(modalPdfPageNum);
                    }).catch(function(err) {
                        console.warn('PDF.js render warning:', err);
                        if (loading) loading.style.display = 'none';
                        if (errorBox) errorBox.style.display = 'block';
                    });
                } else {
                    if (loading) loading.style.display = 'none';
                    if (errorBox) errorBox.style.display = 'block';
                }
            });

            pdfModal.addEventListener('hidden.bs.modal', function () {
                if (modalPdfDoc) {
                    try { modalPdfDoc.destroy(); } catch(e) {}
                    modalPdfDoc = null;
                }
                if (canvas && ctx) {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    canvas.style.display = 'none';
                }
                if (loading) loading.style.display = 'block';
                if (errorBox) errorBox.style.display = 'none';
            });
        }

        // ============================================================
        // PERHITUNGAN DINAMIS TINGGI LAYAR (ANTI-FOOTER MENEMPEL JIKA ITEM SEDIKIT)
        // Menjaga bagian putih (konten) tetap lega, dinamis, profesional & modern
        // Banner header gelap tidak diubah, bagian putih yang dinamis!
        // ============================================================
        function adjustDynamicContentHeight() {
            // Targetkan semua halaman dengan banner (Dokumen, Profil, Informasi)
            const banners = document.querySelectorAll('.inner-header-banner, .page-header-banner');
            if (!banners.length) return;

            const windowHeight = window.innerHeight;

            banners.forEach(function(banner) {
                // Elemen berikutnya adalah container bagian putih (konten)
                let contentSection = banner.nextElementSibling;
                while (contentSection && !contentSection.classList.contains('container') && !contentSection.classList.contains('page-content-dynamic')) {
                    contentSection = contentSection.nextElementSibling;
                }

                if (!contentSection) return;

                // Hitung posisi batas bawah banner terhadap halaman
                const bannerRect = banner.getBoundingClientRect();
                const scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
                const bannerBottomFromTop = bannerRect.bottom + scrollY;

                // Hitung tinggi dinamis agar bagian putih mengisi layar dengan elegan:
                // Footer terdorong ke bawah layar (tidak nampak menempel langsung pada baris data sedikit)
                // Buffer 60px memberi jarak proporsional dan profesional
                const visibleRemaining = windowHeight - bannerBottomFromTop;
                const dynamicMinHeight = Math.max(560, visibleRemaining + 60);

                contentSection.style.minHeight = dynamicMinHeight + 'px';
                contentSection.style.display = 'flex';
                contentSection.style.flexDirection = 'column';
                contentSection.style.paddingBottom = '4.5rem';
            });
        }

        window.addEventListener('resize', adjustDynamicContentHeight);
        window.addEventListener('orientationchange', adjustDynamicContentHeight);
        document.addEventListener('DOMContentLoaded', adjustDynamicContentHeight);
        setTimeout(adjustDynamicContentHeight, 100);
        setTimeout(adjustDynamicContentHeight, 500);
    </script>
    @stack('scripts')
</body>
</html>
