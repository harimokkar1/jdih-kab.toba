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
    <!-- Portal Modern CSS -->
    <link href="{{ asset('css/portal.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    <div class="admin-wrapper">
        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('logo.png') }}" alt="Logo" height="38">
                <div>
                    <h6 class="mb-0 fw-bold text-white">JDIH KAB. TOBA</h6>
                    <small class="text-secondary" style="font-size: 11px;">Panel Administrasi</small>
                </div>
            </div>

            <div class="sidebar-menu">
                <div class="menu-header">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-item-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dasbor
                </a>

                <!-- PRODUK HUKUM (Requirement #3) -->
                <div class="menu-header mt-2">Produk Hukum</div>
                <a href="{{ route('admin.jenis-peraturan.index') }}" class="nav-item-link {{ request()->routeIs('admin.jenis-peraturan.*') ? 'active' : '' }}">
                    <i class="bi bi-tags-fill"></i> Jenis Peraturan
                </a>
                <a href="{{ route('admin.peraturan.index') }}" class="nav-item-link {{ request()->routeIs('admin.peraturan.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-ruled-fill"></i> Dokumen Peraturan
                </a>

                <!-- KONTEN PORTAL -->
                <div class="menu-header mt-2">Konten Portal</div>
                <a href="{{ route('admin.berita') }}" class="nav-item-link {{ request()->routeIs('admin.berita*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Kelola Berita
                </a>
                <a href="{{ route('admin.pengumuman.index') }}" class="nav-item-link {{ request()->routeIs('admin.pengumuman*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone-fill"></i> Pengumuman
                </a>
                <a href="{{ route('admin.carousel') }}" class="nav-item-link {{ request()->routeIs('admin.carousel*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Kelola Carousel
                </a>
                <a href="{{ route('admin.struktur') }}" class="nav-item-link {{ request()->routeIs('admin.struktur*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3-fill"></i> Struktur Organisasi
                </a>
                <a href="{{ route('admin.visi') }}" class="nav-item-link {{ request()->routeIs('admin.visi*') ? 'active' : '' }}">
                    <i class="bi bi-compass-fill"></i> Visi & Misi
                </a>

                <!-- PENGATURAN & AKUN -->
                <div class="menu-header mt-2">Pengaturan Sistem</div>
                @if(auth()->user()->role === 'super_admin')
                    <a href="{{ route('super-admin') }}" class="nav-item-link {{ request()->routeIs('super-admin*') ? 'active' : '' }}">
                        <i class="bi bi-shield-lock-fill text-warning"></i> Kelola Admin
                    </a>
                @endif
                <a href="{{ route('home') }}" target="_blank" class="nav-item-link">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>
            </div>

            <!-- LOGOUT SECTION -->
            <div class="p-3 border-top border-secondary border-opacity-25">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="admin-content-area">
            <!-- TOPBAR -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center gap-2">
                    <h5 class="mb-0 fw-bold text-dark">@yield('page-title', 'Dashboard')</h5>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                        <i class="bi bi-globe me-1"></i> Buka Portal Publik
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle rounded-pill px-3 d-flex align-items-center gap-2 border" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle text-primary fs-5"></i>
                            <div class="text-start d-none d-sm-block">
                                <span class="fw-bold small d-block">{{ auth()->user()->name }}</span>
                                <span class="badge {{ auth()->user()->role === 'super_admin' ? 'bg-danger' : 'bg-primary' }}" style="font-size: 10px;">
                                    {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                                </span>
                            </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            @if(auth()->user()->role === 'super_admin')
                                <li><a class="dropdown-item" href="{{ route('super-admin') }}"><i class="bi bi-people me-2"></i> Manajemen Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-left me-2"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- FLASH ALERTS -->
            <div class="px-4 pt-3">
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

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> <strong>Mohon periksa kesalahan input berikut:</strong>
                        <ul class="mb-0 mt-2 small">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            <!-- MAIN BODY -->
            <main class="admin-main-body">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>

