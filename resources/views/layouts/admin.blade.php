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
                <div class="admin-topbar-left d-flex align-items-center gap-2">
                    <button type="button" class="btn-admin-mobile-toggle" id="btnSidebarToggle" aria-label="Toggle Navigation">
                        <i class="bi bi-list"></i>
                    </button>

                    <!-- Global Command Palette Search Trigger Button -->
                    <button type="button" class="btn-admin-command-palette d-none d-sm-flex align-items-center gap-2" id="btnOpenCommandPalette" title="Buka Command Palette (Ctrl+K)">
                        <i class="bi bi-search text-muted"></i>
                        <span class="command-placeholder">Cari modul, regulasi, aksi cepat...</span>
                        <kbd class="command-kbd">Ctrl K</kbd>
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

    <!-- COMMAND PALETTE MODAL (Ctrl + K) -->
    <div class="modal fade command-palette-modal" id="commandPaletteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content command-palette-content border-0 shadow-lg">
                <div class="command-palette-header d-flex align-items-center px-3 py-3 border-bottom">
                    <i class="bi bi-search text-primary me-2 fs-5"></i>
                    <input type="text" class="form-control border-0 shadow-none ps-1 fs-6" id="commandPaletteInput" placeholder="Ketik apa yang ingin Anda cari (e.g. tambah peraturan, berita, perda, izin)..." autocomplete="off">
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="command-palette-body p-2" id="commandPaletteResults" style="max-height: 400px; overflow-y: auto;">
                    <!-- Aksi Cepat -->
                    <div class="command-group-title">Aksi Cepat Admin</div>
                    <a href="{{ route('admin.peraturan.create') }}" class="command-item">
                        <div class="command-item-icon bg-primary-subtle text-primary"><i class="bi bi-plus-lg"></i></div>
                        <div class="command-item-text">
                            <span class="command-item-title">Tambah Dokumen Peraturan Baru</span>
                            <span class="command-item-desc">Unggah naskah PDF &amp; metadata regulasi daerah baru</span>
                        </div>
                        <span class="command-item-badge">Peraturan</span>
                    </a>
                    <a href="{{ route('admin.peraturan.index', ['has_file' => '0']) }}" class="command-item">
                        <div class="command-item-icon bg-danger-subtle text-danger"><i class="bi bi-file-earmark-x"></i></div>
                        <div class="command-item-text">
                            <span class="command-item-title">Audit Regulasi Belum Ada PDF</span>
                            <span class="command-item-desc">Filter regulasi yang belum memiliki dokumen naskah digital</span>
                        </div>
                        <span class="command-item-badge text-danger">Kepatuhan BPHN</span>
                    </a>
                    <a href="{{ route('admin.berita') }}" class="command-item">
                        <div class="command-item-icon bg-info-subtle text-info"><i class="bi bi-newspaper"></i></div>
                        <div class="command-item-text">
                            <span class="command-item-title">Tulis &amp; Kelola Berita Hukum</span>
                            <span class="command-item-desc">Warta kegiatan sosialisasi dan informasi hukum daerah</span>
                        </div>
                        <span class="command-item-badge">Publikasi</span>
                    </a>
                    <a href="{{ route('admin.pengumuman.index') }}" class="command-item">
                        <div class="command-item-icon bg-warning-subtle text-warning"><i class="bi bi-megaphone"></i></div>
                        <div class="command-item-text">
                            <span class="command-item-title">Kelola Pengumuman Resmi</span>
                            <span class="command-item-desc">Rilis maklumat, edaran, dan pengumuman untuk publik</span>
                        </div>
                        <span class="command-item-badge">Pengumuman</span>
                    </a>

                    <!-- Navigasi Halaman -->
                    <div class="command-group-title mt-2">Navigasi Halaman Administrasi</div>
                    <a href="{{ route('admin.dashboard') }}" class="command-item">
                        <div class="command-item-icon bg-secondary-subtle text-secondary"><i class="bi bi-grid-1x2"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Dasbor Utama (Ringkasan &amp; Analitik)</span></div>
                        <span class="command-item-shortcut">&crarr;</span>
                    </a>
                    <a href="{{ route('admin.jenis-peraturan.index') }}" class="command-item">
                        <div class="command-item-icon bg-secondary-subtle text-secondary"><i class="bi bi-tags"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Kelola Klasifikasi &amp; Jenis Peraturan</span></div>
                        <span class="command-item-shortcut">&crarr;</span>
                    </a>
                    <a href="{{ route('admin.peraturan.index') }}" class="command-item">
                        <div class="command-item-icon bg-secondary-subtle text-secondary"><i class="bi bi-journal-text"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Database Arsip Peraturan Daerah &amp; Bupati</span></div>
                        <span class="command-item-shortcut">&crarr;</span>
                    </a>
                    <a href="{{ route('admin.struktur') }}" class="command-item">
                        <div class="command-item-icon bg-secondary-subtle text-secondary"><i class="bi bi-diagram-3"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Struktur Organisasi Bagian Hukum Toba</span></div>
                        <span class="command-item-shortcut">&crarr;</span>
                    </a>
                    <a href="{{ route('admin.visi') }}" class="command-item">
                        <div class="command-item-icon bg-secondary-subtle text-secondary"><i class="bi bi-compass"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Visi &amp; Misi Kabupaten Toba</span></div>
                        <span class="command-item-shortcut">&crarr;</span>
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="command-item">
                        <div class="command-item-icon bg-success-subtle text-success"><i class="bi bi-globe2"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Buka Portal Publik JDIH Kabupaten Toba</span></div>
                        <span class="command-item-shortcut"><i class="bi bi-box-arrow-up-right"></i></span>
                    </a>
                    <a href="{{ route('api.jdihn.index') }}" target="_blank" class="command-item">
                        <div class="command-item-icon bg-primary-subtle text-primary"><i class="bi bi-code-slash"></i></div>
                        <div class="command-item-text"><span class="command-item-title">Cek Endpoint Respon API JDIHN (JSON)</span></div>
                        <span class="command-item-shortcut"><i class="bi bi-box-arrow-up-right"></i></span>
                    </a>
                </div>
                <div class="command-palette-footer d-flex justify-content-between align-items-center px-3 py-2 border-top bg-light rounded-bottom" style="font-size: 0.72rem; color: #64748b;">
                    <div class="d-flex align-items-center gap-2">
                        <span><kbd class="kbd-sm">Ctrl + K</kbd> Buka Kapan Saja</span>
                        <span>&bull;</span>
                        <span><kbd class="kbd-sm">ESC</kbd> Tutup</span>
                    </div>
                    <span>Satu Data JDIH Toba &bull; SPBE</span>
                </div>
            </div>
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

            // Command Palette (Ctrl+K / Cmd+K)
            const commandModalEl = document.getElementById('commandPaletteModal');
            const btnOpenCommand = document.getElementById('btnOpenCommandPalette');
            const commandInput = document.getElementById('commandPaletteInput');
            const commandResults = document.getElementById('commandPaletteResults');

            function openCommandPalette() {
                if (commandModalEl && typeof bootstrap !== 'undefined') {
                    const modal = bootstrap.Modal.getOrCreateInstance(commandModalEl);
                    modal.show();
                    setTimeout(() => {
                        if (commandInput) {
                            commandInput.focus();
                            commandInput.select();
                        }
                    }, 150);
                }
            }

            if (btnOpenCommand) {
                btnOpenCommand.addEventListener('click', openCommandPalette);
            }

            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                    e.preventDefault();
                    openCommandPalette();
                }
            });

            // Live filter items in Command Palette
            if (commandInput && commandResults) {
                commandInput.addEventListener('input', function () {
                    const query = this.value.toLowerCase().trim();
                    const items = commandResults.querySelectorAll('.command-item');
                    const titles = commandResults.querySelectorAll('.command-group-title');

                    items.forEach(item => {
                        const text = item.textContent.toLowerCase();
                        if (!query || text.includes(query)) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Hide headers if no items visible in that group
                    titles.forEach(title => {
                        title.style.display = query ? 'none' : 'block';
                    });
                });
            }
        });

        // Global Modern File Uploader Helpers
        window.handleFileSelected = function(input, previewId) {
            const preview = document.getElementById(previewId);
            if (!preview) return;
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const nameEl = preview.querySelector('.uploader-file-name');
                const sizeEl = preview.querySelector('.uploader-file-size');
                if (nameEl) nameEl.textContent = file.name;
                if (sizeEl) sizeEl.textContent = (file.size >= 1048576) ? (sizeMB + ' MB') : ((file.size / 1024).toFixed(0) + ' KB');
                preview.classList.remove('d-none');
                const dropArea = input.closest('.modern-file-uploader')?.querySelector('.uploader-drop-area');
                if (dropArea) dropArea.style.display = 'none';
            }
        };

        window.clearSelectedFile = function(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            if (input) input.value = '';
            if (preview) preview.classList.add('d-none');
            const dropArea = input?.closest('.modern-file-uploader')?.querySelector('.uploader-drop-area');
            if (dropArea) dropArea.style.display = 'flex';
        };

        // ==========================================================================
        // MODERN SELECT (BEAUTIFUL ENTERPRISE CUSTOM DROPDOWN ENGINE)
        // ==========================================================================
        window.initModernSelect = function(selectEl) {
            if (!selectEl || selectEl.dataset.modernSelectInit === 'true') return;
            selectEl.dataset.modernSelectInit = 'true';

            // Hide original select visually but keep in DOM for form submission & HTML5 validation
            selectEl.style.position = 'absolute';
            selectEl.style.opacity = '0';
            selectEl.style.pointerEvents = 'none';
            selectEl.style.width = '1px';
            selectEl.style.height = '1px';
            selectEl.style.margin = '-1px';
            selectEl.style.clip = 'rect(0, 0, 0, 0)';
            selectEl.tabIndex = -1;

            const isSm = selectEl.classList.contains('form-select-sm') || selectEl.closest('.col-lg-2, .col-lg-3, .col-md-3, .col-md-4');

            // Wrapper
            const wrapper = document.createElement('div');
            wrapper.className = 'modern-select-wrapper' + (isSm ? ' modern-select-sm' : '');
            selectEl.parentNode.insertBefore(wrapper, selectEl);
            wrapper.appendChild(selectEl);

            // Trigger button
            const trigger = document.createElement('button');
            trigger.type = 'button';
            trigger.className = 'modern-select-trigger' + (isSm ? ' trigger-sm' : '');
            trigger.setAttribute('aria-haspopup', 'listbox');
            trigger.setAttribute('aria-expanded', 'false');

            const labelSpan = document.createElement('span');
            labelSpan.className = 'modern-select-label text-truncate';
            
            const chevron = document.createElement('i');
            chevron.className = 'bi bi-chevron-down modern-select-chevron';

            trigger.appendChild(labelSpan);
            trigger.appendChild(chevron);
            wrapper.appendChild(trigger);

            // Menu Dropdown
            const menu = document.createElement('div');
            menu.className = 'modern-select-menu';
            menu.setAttribute('role', 'listbox');

            // Build options list
            const optionsList = document.createElement('div');
            optionsList.className = 'modern-select-options-list';

            let totalOptions = 0;

            function updateOptions() {
                optionsList.innerHTML = '';
                totalOptions = 0;
                const selectedVal = selectEl.value;
                let currentLabel = '';

                const children = Array.from(selectEl.children);
                children.forEach(child => {
                    if (child.tagName === 'OPTGROUP') {
                        const groupHeader = document.createElement('div');
                        groupHeader.className = 'modern-select-optgroup-label';
                        groupHeader.textContent = child.label;
                        optionsList.appendChild(groupHeader);

                        Array.from(child.children).forEach(opt => {
                            createOptionEl(opt);
                        });
                    } else if (child.tagName === 'OPTION') {
                        createOptionEl(child);
                    }
                });

                function createOptionEl(opt) {
                    totalOptions++;
                    const isSelected = (opt.value === selectedVal) || (!selectedVal && !opt.value && selectEl.selectedIndex === totalOptions - 1);
                    if (isSelected || (!currentLabel && totalOptions === 1)) {
                        currentLabel = opt.textContent.trim();
                    }

                    const item = document.createElement('div');
                    item.className = 'modern-select-option' + (isSelected ? ' selected' : '');
                    item.dataset.value = opt.value;
                    item.setAttribute('role', 'option');
                    item.setAttribute('aria-selected', isSelected ? 'true' : 'false');

                    const textSpan = document.createElement('span');
                    textSpan.className = 'modern-select-option-text';
                    textSpan.textContent = opt.textContent.trim();

                    const checkIcon = document.createElement('i');
                    checkIcon.className = 'bi bi-check2 modern-select-check';

                    item.appendChild(textSpan);
                    item.appendChild(checkIcon);

                    item.addEventListener('click', function(e) {
                        e.stopPropagation();
                        selectEl.value = opt.value;
                        labelSpan.textContent = opt.textContent.trim();
                        
                        optionsList.querySelectorAll('.modern-select-option').forEach(o => {
                            o.classList.remove('selected');
                            o.setAttribute('aria-selected', 'false');
                        });
                        item.classList.add('selected');
                        item.setAttribute('aria-selected', 'true');

                        closeMenu();
                        selectEl.dispatchEvent(new Event('change', { bubbles: true }));
                    });

                    optionsList.appendChild(item);
                }

                labelSpan.textContent = currentLabel || (selectEl.options[selectEl.selectedIndex]?.textContent.trim()) || '-- Pilih --';
            }

            updateOptions();

            // Search box if options > 6
            let searchInput = null;
            if (totalOptions > 6) {
                const searchBox = document.createElement('div');
                searchBox.className = 'modern-select-search-box';
                searchBox.innerHTML = '<i class="bi bi-search"></i>';
                searchInput = document.createElement('input');
                searchInput.type = 'text';
                searchInput.className = 'modern-select-search-input';
                searchInput.placeholder = 'Cari opsi...';
                searchInput.autocomplete = 'off';

                searchInput.addEventListener('input', function() {
                    const q = this.value.toLowerCase().trim();
                    const optionEls = optionsList.querySelectorAll('.modern-select-option');
                    optionEls.forEach(el => {
                        const txt = el.textContent.toLowerCase();
                        if (!q || txt.includes(q)) {
                            el.style.display = 'flex';
                        } else {
                            el.style.display = 'none';
                        }
                    });
                    optionsList.querySelectorAll('.modern-select-optgroup-label').forEach(hdr => {
                        let next = hdr.nextElementSibling;
                        let hasVisible = false;
                        while (next && !next.classList.contains('modern-select-optgroup-label')) {
                            if (next.style.display !== 'none') hasVisible = true;
                            next = next.nextElementSibling;
                        }
                        hdr.style.display = hasVisible ? 'block' : 'none';
                    });
                });

                searchBox.appendChild(searchInput);
                menu.appendChild(searchBox);
            }

            menu.appendChild(optionsList);
            wrapper.appendChild(menu);

            function openMenu() {
                document.querySelectorAll('.modern-select-wrapper.is-open').forEach(w => {
                    if (w !== wrapper) {
                        w.classList.remove('is-open', 'dropup');
                        const t = w.querySelector('.modern-select-trigger');
                        if (t) t.setAttribute('aria-expanded', 'false');
                        const card = w.closest('.admin-card, .card');
                        if (card) card.classList.remove('z-dropdown-active');
                        const col = w.closest('[class*="col-"]');
                        if (col) col.classList.remove('col-dropdown-active');
                    }
                });

                const rect = trigger.getBoundingClientRect();
                const spaceBelowWindow = window.innerHeight - rect.bottom;
                const spaceAboveWindow = rect.top;

                // Smart positioning: check if inside modal vs regular card
                const modalContainer = wrapper.closest('.modal-content, .modal-body');
                let shouldDropup = false;

                if (modalContainer) {
                    const modalRect = modalContainer.getBoundingClientRect();
                    const spaceBelowInModal = modalRect.bottom - rect.bottom;
                    const spaceAboveInModal = rect.top - modalRect.top;

                    // If space below inside modal is tight (< 220px) and there's more room above, flip up
                    if (spaceBelowInModal < 220 && spaceAboveInModal > spaceBelowInModal) {
                        shouldDropup = true;
                    }
                } else {
                    if (spaceBelowWindow < 260 && spaceAboveWindow > 260) {
                        shouldDropup = true;
                    }
                }

                if (shouldDropup) {
                    wrapper.classList.add('dropup');
                } else {
                    wrapper.classList.remove('dropup');
                }

                wrapper.classList.add('is-open');
                trigger.setAttribute('aria-expanded', 'true');

                // Elevate parent stacking contexts so nothing clips or overlays the dropdown
                const parentCard = wrapper.closest('.admin-card, .card');
                if (parentCard) parentCard.classList.add('z-dropdown-active');
                
                const parentCol = wrapper.closest('[class*="col-"]');
                if (parentCol) parentCol.classList.add('col-dropdown-active');

                if (searchInput) {
                    searchInput.value = '';
                    searchInput.dispatchEvent(new Event('input'));
                    setTimeout(() => searchInput.focus(), 60);
                }
            }

            function closeMenu() {
                wrapper.classList.remove('is-open', 'dropup');
                trigger.setAttribute('aria-expanded', 'false');
                const parentCard = wrapper.closest('.admin-card, .card');
                if (parentCard) parentCard.classList.remove('z-dropdown-active');
                const parentCol = wrapper.closest('[class*="col-"]');
                if (parentCol) parentCol.classList.remove('col-dropdown-active');
            }

            trigger.addEventListener('click', function(e) {
                e.stopPropagation();
                if (wrapper.classList.contains('is-open')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            selectEl.addEventListener('change', function() {
                const opt = selectEl.options[selectEl.selectedIndex];
                if (opt) {
                    labelSpan.textContent = opt.textContent.trim();
                    optionsList.querySelectorAll('.modern-select-option').forEach(o => {
                        if (o.dataset.value === opt.value) {
                            o.classList.add('selected');
                            o.setAttribute('aria-selected', 'true');
                        } else {
                            o.classList.remove('selected');
                            o.setAttribute('aria-selected', 'false');
                        }
                    });
                }
            });
        };

        window.initAllModernSelects = function() {
            document.querySelectorAll('select.form-select:not(.no-modern-select)').forEach(window.initModernSelect);
        };

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.modern-select-wrapper')) {
                document.querySelectorAll('.modern-select-wrapper.is-open').forEach(w => {
                    w.classList.remove('is-open', 'dropup');
                    const t = w.querySelector('.modern-select-trigger');
                    if (t) t.setAttribute('aria-expanded', 'false');
                    const card = w.closest('.admin-card, .card');
                    if (card) card.classList.remove('z-dropdown-active');
                    const col = w.closest('[class*="col-"]');
                    if (col) col.classList.remove('col-dropdown-active');
                });
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modern-select-wrapper.is-open').forEach(w => {
                    w.classList.remove('is-open', 'dropup');
                    const t = w.querySelector('.modern-select-trigger');
                    if (t) t.setAttribute('aria-expanded', 'false');
                    const card = w.closest('.admin-card, .card');
                    if (card) card.classList.remove('z-dropdown-active');
                    const col = w.closest('[class*="col-"]');
                    if (col) col.classList.remove('col-dropdown-active');
                });
            }
        });

        document.addEventListener('DOMContentLoaded', window.initAllModernSelects);
        document.addEventListener('show.bs.modal', function() {
            setTimeout(window.initAllModernSelects, 60);
        });
        document.addEventListener('shown.bs.modal', function() {
            setTimeout(window.initAllModernSelects, 60);
        });
    </script>

    @stack('scripts')
</body>
</html>
