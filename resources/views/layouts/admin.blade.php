<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Panel') - JDIH Kabupaten Toba</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons 1.11.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Dedicated Enterprise Admin CSS -->
    <link href="{{ asset('css/admin.css') }}?v={{ time() }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="admin-body">

    <!-- Mobile Sidebar Backdrop -->
    <div class="admin-sidebar-backdrop" id="adminSidebarBackdrop"></div>

    <div class="admin-wrapper">
        <!-- SIDEBAR -->
        <aside class="admin-sidebar" id="adminSidebar">
            <!-- BRAND HEADER -->
            <div class="sidebar-brand">
                <div class="sidebar-brand-wrapper">
                    <div class="sidebar-brand-logos">
                        <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" class="brand-logo-jdihn">
                        <img src="{{ asset('logo.png') }}" alt="Logo Toba" class="brand-logo-toba">
                    </div>
                    <div class="sidebar-brand-text">
                        <h6 class="brand-name">JDIH <span class="brand-gold">TOBA</span></h6>
                        <span class="brand-sub">Panel Administrasi</span>
                    </div>
                </div>
            </div>

            <!-- NAVIGATION MENU -->
            <div class="sidebar-menu">
                <div class="menu-header">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dasbor Utama</span>
                </a>

                <!-- PRODUK HUKUM -->
                <div class="menu-header">Produk Hukum</div>
                <a href="{{ route('admin.jenis-peraturan.index') }}" class="nav-item-link {{ request()->routeIs('admin.jenis-peraturan.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    <span>Jenis Peraturan</span>
                </a>
                <a href="{{ route('admin.peraturan.index') }}" class="nav-item-link {{ request()->routeIs('admin.peraturan.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Dokumen Peraturan</span>
                </a>

                <!-- KONTEN PORTAL -->
                <div class="menu-header">Konten &amp; Publikasi</div>
                <a href="{{ route('admin.berita') }}" class="nav-item-link {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Kelola Berita</span>
                </a>
                <a href="{{ route('admin.pengumuman.index') }}" class="nav-item-link {{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone"></i>
                    <span>Pengumuman</span>
                </a>
                <a href="{{ route('admin.struktur') }}" class="nav-item-link {{ request()->routeIs('admin.struktur*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3"></i>
                    <span>Struktur Organisasi</span>
                </a>
                <a href="{{ route('admin.visi') }}" class="nav-item-link {{ request()->routeIs('admin.visi*') ? 'active' : '' }}">
                    <i class="bi bi-compass"></i>
                    <span>Visi &amp; Misi</span>
                </a>

                <!-- PENGATURAN & AKUN -->
                @if(auth()->user()->role === 'super_admin')
                    <div class="menu-header">Pengaturan Sistem</div>
                    <a href="{{ route('super-admin') }}" class="nav-item-link {{ request()->routeIs('super-admin*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Manajemen Admin</span>
                    </a>
                @endif
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="admin-content-area">
            <!-- TOPBAR / APPBAR -->
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button type="button" class="btn-admin-mobile-toggle" id="btnSidebarToggle" aria-label="Toggle Navigation">
                        <i class="bi bi-list"></i>
                    </button>
                </div>

                <div class="admin-topbar-right">
                    <!-- Portal Publik Link Button -->
                    <a href="{{ route('home') }}" target="_blank" class="btn-admin-portal-link" title="Buka Portal Publik JDIH Kabupaten Toba">
                        <i class="bi bi-globe2"></i>
                        <span class="d-none d-sm-inline">Portal Publik</span>
                        <i class="bi bi-arrow-up-right text-muted small"></i>
                    </a>

                    <!-- User Profile Dropdown Chip (Elevated Modern Design) -->
                    <div class="dropdown">
                        <button class="btn admin-user-chip border-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="admin-user-chip-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="d-none d-md-flex flex-column text-start">
                                <span class="admin-user-chip-name">{{ Str::limit(auth()->user()->name, 16) }}</span>
                                <span class="admin-user-chip-role">{{ auth()->user()->role === 'super_admin' ? 'Super Administrator' : 'Staf Administrator' }}</span>
                            </div>
                            <i class="bi bi-chevron-down admin-user-chip-chevron"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end admin-profile-dropdown">
                            <!-- Dropdown Profile Header Card (Clean Surface Card) -->
                            <li class="dropdown-profile-header">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="dropdown-header-avatar">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-grow-1">
                                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                            <span class="dropdown-profile-name text-truncate">{{ auth()->user()->name }}</span>
                                            <span class="badge {{ auth()->user()->role === 'super_admin' ? 'badge-role-super-pill' : 'badge-role-admin-pill' }}">
                                                {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin Staf' }}
                                            </span>
                                        </div>
                                        <span class="dropdown-profile-email text-truncate d-block">
                                            <i class="bi bi-envelope me-1 opacity-75"></i>{{ auth()->user()->email }}
                                        </span>
                                    </div>
                                </div>
                            </li>

                            <li><hr class="dropdown-divider my-2 opacity-50"></li>

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="admin-dropdown-item item-logout w-100 text-start border-0 bg-transparent">
                                        <div class="dropdown-item-icon icon-rose">
                                            <i class="bi bi-box-arrow-left"></i>
                                        </div>
                                        <div class="flex-grow-1 min-w-0">
                                            <span class="dropdown-item-title text-danger">Logout / Keluar</span>
                                            <span class="dropdown-item-desc">Selesaikan sesi administrasi</span>
                                        </div>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- FLASH ALERTS -->
            <div class="px-4 pt-3">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 py-2 px-3 small d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-check-circle-fill text-success fs-6"></i>
                        <div class="flex-grow-1">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 py-2 px-3 small d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-6"></i>
                        <div class="flex-grow-1">
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 py-2 px-3 small" role="alert">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-exclamation-circle-fill text-danger fs-6"></i>
                            <strong>Periksa input berikut:</strong>
                        </div>
                        <ul class="mb-0 ps-4 small">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close p-2" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            <!-- MAIN BODY -->
            <main class="admin-main-body">
                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="admin-footer mt-auto">
                <span>&copy; {{ date('Y') }} <strong>JDIH Kabupaten Toba</strong> &mdash; Bagian Hukum Setdakab Toba.</span>
                <span>Versi 2.4-SPBE &bull; <a href="{{ route('api.jdihn.index') }}" target="_blank" class="text-muted text-decoration-none">API JDIHN</a></span>
            </footer>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js 4.4.4 for Interactive Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

    <!-- Mobile Drawer & Real-Time Clock -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnSidebarToggle = document.getElementById('btnSidebarToggle');
            const adminSidebar = document.getElementById('adminSidebar');
            const adminSidebarBackdrop = document.getElementById('adminSidebarBackdrop');

            function toggleSidebar() {
                if (adminSidebar && adminSidebarBackdrop) {
                    adminSidebar.classList.toggle('open');
                    adminSidebarBackdrop.classList.toggle('active');
                }
            }

            if (btnSidebarToggle) btnSidebarToggle.addEventListener('click', toggleSidebar);
            if (adminSidebarBackdrop) adminSidebarBackdrop.addEventListener('click', toggleSidebar);
        });
    </script>

    @stack('scripts')
</body>
</html>
