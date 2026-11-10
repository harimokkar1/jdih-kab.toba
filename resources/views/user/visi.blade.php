@extends('layouts.app')

@section('title', 'Visi & Misi - JDIH Kabupaten Toba')

@section('content')

@php
    $visiText = $data->visi ?? 'Terwujudnya Kabupaten Toba yang Unggul, Berkarakter, Maju, dan Berkelanjutan.';
    $defaultMisi = "1. Mewujudkan tata kelola pemerintahan yang baik, bersih, transparan, dan berwibawa.\n2. Meningkatkan pelayanan publik dan kepastian hukum yang berkeadilan bagi seluruh lapisan masyarakat.\n3. Mengembangkan potensi sumber daya daerah dan pariwisata berkelanjutan demi kesejahteraan rakyat.";
    $rawMisi = $data->misi ?? $defaultMisi;
    
    // Pisahkan tiap baris misi
    $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $rawMisi)));
    
    // Metadata tematik per item misi
    $missionMetadata = [
        1 => [
            'pedestal' => 'pedestal-1',
            'tag_class' => 'tag-blue',
            'tag_icon' => 'bi-shield-check',
            'tag_text' => 'Tata Kelola Bersih & Akuntabilitas SPBE',
        ],
        2 => [
            'pedestal' => 'pedestal-2',
            'tag_class' => 'tag-amber',
            'tag_icon' => 'bi-balance',
            'tag_text' => 'Kepastian Hukum & Akses Keadilan Publik',
        ],
        3 => [
            'pedestal' => 'pedestal-3',
            'tag_class' => 'tag-green',
            'tag_icon' => 'bi-tree-fill',
            'tag_text' => 'Pariwisata Danau Toba & Kemakmuran Berkelanjutan',
        ],
    ];
@endphp

<!-- TOP CURVED BANNER -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active">Visi &amp; Misi</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1 text-white">Visi &amp; Misi Kabupaten Toba</h1>
        <p class="text-white-50 small mb-0">Landasan filosofis, arah kebijakan strategis, dan komitmen pelayanan hukum Pemerintah Kabupaten Toba</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="profile-executive-card p-4 p-md-5 mb-4">
                
                <!-- DUAL CREST & OFFICIAL HEADER -->
                <div class="text-center mb-5">
                    <div class="profile-crest-capsule mb-3">
                        <div class="profile-crest-item">
                            <img src="{{ asset('logo.png') }}" alt="Logo Pemkab Toba" class="profile-crest-logo">
                            <div class="profile-crest-name">
                                PEMKAB TOBA
                                <small>Sumatera Utara</small>
                            </div>
                        </div>
                        <div class="profile-crest-divider"></div>
                        <div class="profile-crest-item">
                            <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" class="profile-crest-logo">
                            <div class="profile-crest-name">
                                JDIHN NASIONAL
                                <small>BPHN Kemenkumham RI</small>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 rounded-pill px-3 py-1.5 small fw-bold mb-2">
                            <i class="bi bi-compass text-gold me-1"></i> ARAH KEBIJAKAN &amp; LANDASAN STRATEGIS DAERAH
                        </span>
                        <h2 class="h4 fw-bold text-dark mt-2 mb-1" style="letter-spacing: -0.3px;">
                            Visi &amp; Misi Pembangunan Daerah
                        </h2>
                        <p class="text-muted small mb-0">
                            Pemerintah Kabupaten Toba — Bagian Hukum Sekretariat Daerah
                        </p>
                    </div>
                </div>

                <!-- SECTION 1: VISI DAERAH (GRAND CIVIC CARD) -->
                <div class="visi-grand-card mb-5">
                    <div class="visi-quote-watermark">
                        <i class="bi bi-quote"></i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                        <span class="visi-badge-pill mb-0">
                            <i class="bi bi-compass-fill"></i> RUMUSAN VISI UTAMA DAERAH
                        </span>
                        <span class="badge bg-white bg-opacity-10 text-white-50 border border-white border-opacity-10 rounded-pill px-3 py-1 small">
                            RPJMD Kabupaten Toba
                        </span>
                    </div>

                    <div class="visi-statement-text">
                        "{{ $visiText }}"
                    </div>

                    <!-- 4 STRATEGIC CORE VALUES -->
                    <div class="visi-values-grid">
                        <div class="visi-value-chip">
                            <div class="visi-value-keyword">
                                <i class="bi bi-award-fill"></i> UNGGUL
                            </div>
                            <p class="visi-value-desc">SDM kompeten, birokrasi profesional, &amp; berdaya saing tinggi</p>
                        </div>
                        <div class="visi-value-chip">
                            <div class="visi-value-keyword">
                                <i class="bi bi-shield-shaded"></i> BERKARAKTER
                            </div>
                            <p class="visi-value-desc">Kearifan lokal Batak Narimbang, santun, &amp; berintegritas</p>
                        </div>
                        <div class="visi-value-chip">
                            <div class="visi-value-keyword">
                                <i class="bi bi-graph-up-arrow"></i> MAJU
                            </div>
                            <p class="visi-value-desc">Transformasi digital SPBE &amp; pertumbuhan ekonomi merata</p>
                        </div>
                        <div class="visi-value-chip">
                            <div class="visi-value-keyword">
                                <i class="bi bi-tree-fill"></i> BERKELANJUTAN
                            </div>
                            <p class="visi-value-desc">Kelestarian Danau Toba &amp; pembangunan ramah lingkungan</p>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: MISI STRATEGIS DAERAH -->
                <div class="mb-5">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div>
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-warning bg-opacity-10 text-warning-emphasis small fw-bold mb-2">
                                <i class="bi bi-flag-fill text-gold"></i> TIGA AGENDA UTAMA AKSI DAERAH
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-1">Misi Pembangunan Kabupaten Toba</h3>
                            <p class="text-muted small mb-0">Langkah nyata operasional dalam mewujudkan tata kelola prima dan keadilan hukum bagi masyarakat</p>
                        </div>
                    </div>

                    <div class="mission-cards-wrapper">
                        @foreach($lines as $index => $line)
                            @php
                                $num = $index + 1;
                                // Hapus nomor depan jika ada ("1. ", "1) ", dst.)
                                $cleanText = preg_replace('/^\d+[\.\)]\s*/', '', $line);
                                $meta = $missionMetadata[$num] ?? [
                                    'pedestal' => 'pedestal-generic',
                                    'tag_class' => 'tag-blue',
                                    'tag_icon' => 'bi-check-circle-fill',
                                    'tag_text' => 'Pilar Pembangunan ' . $num,
                                ];
                            @endphp
                            <div class="mission-card-item">
                                <div class="mission-num-pedestal {{ $meta['pedestal'] }}">
                                    <span>{{ str_pad($num, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="mission-content-body">
                                    <span class="mission-tag-pill {{ $meta['tag_class'] }}">
                                        <i class="bi {{ $meta['tag_icon'] }}"></i> {{ $meta['tag_text'] }}
                                    </span>
                                    <p class="mission-item-text">
                                        {{ $cleanText }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- SECTION 3: HARMONISASI HUKUM JDIH -->
                <div class="profile-lead-callout mb-4">
                    <div class="profile-lead-icon">
                        <i class="bi bi-journal-bookmark-fill"></i>
                    </div>
                    <div>
                        <span class="profile-lead-badge">Peran Regulasi JDIH Toba</span>
                        <div class="profile-lead-text">
                            Seluruh produk hukum daerah yang dihimpun dan dipublikasikan pada portal JDIH Kabupaten Toba—baik <strong>Peraturan Daerah (PERDA)</strong>, <strong>Peraturan Bupati (PERBUP)</strong>, maupun <strong>Keputusan Bupati (KEPBUP)</strong>—berfungsi sebagai payung hukum formal untuk mengawal terlaksananya Visi dan Misi pembangunan Pemerintah Kabupaten Toba secara tertib, terbuka, dan akuntabel.
                        </div>
                    </div>
                </div>

                <!-- QUICK NAVIGATION PILL FOOTER -->
                <div class="profile-quick-nav">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-compass text-gold fs-5"></i>
                        <span class="small fw-bold text-dark">Informasi Profil Lainnya:</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="{{ route('sejarah') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-hourglass-split text-primary"></i> Sejarah JDIH
                        </a>
                        <a href="{{ route('visi') }}" class="profile-nav-pill-btn active">
                            <i class="bi bi-eye-fill text-gold"></i> Visi &amp; Misi
                        </a>
                        <a href="{{ route('struktur') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-diagram-3-fill text-warning"></i> Struktur Organisasi
                        </a>
                        <a href="{{ route('kontak') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-telephone-fill text-success"></i> Kontak &amp; Lokasi
                        </a>
                        <a href="{{ route('user.produk-hukum.jenis', 'peraturan-daerah') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-collection-fill text-secondary"></i> Produk Hukum
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
