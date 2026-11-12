@extends('layouts.app')

@section('title', 'Visi & Misi - JDIH Kabupaten Toba')

@section('content')

@php
    $visiText = $data->visi ?? 'Terwujudnya Kabupaten Toba yang Unggul, Berkarakter, Maju, dan Berkelanjutan.';
    $defaultMisi = "1. Mewujudkan tata kelola pemerintahan yang baik, bersih, transparan, dan berwibawa.\n2. Meningkatkan pelayanan publik dan kepastian hukum yang berkeadilan bagi seluruh lapisan masyarakat.\n3. Mengembangkan potensi sumber daya daerah dan pariwisata berkelanjutan demi kesejahteraan rakyat.";
    $rawMisi = $data->misi ?? $defaultMisi;
    
    // Pisahkan tiap baris misi
    $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $rawMisi)));
    
    // Metadata tematik per item misi (Standar Korporasi & Pemerintahan Modern)
    $missionMetadata = [
        1 => [
            'accent' => 'navy',
            'icon' => 'bi-shield-check',
            'title' => 'Tata Kelola Pemerintahan Bersih',
            'tag' => 'Birokrasi & SPBE',
            'bullets' => [
                'Transparansi & akuntabilitas kinerja aparatur',
                'Implementasi SPBE terintegrasi nasional',
                'Birokrasi adaptif dan bebas pungutan liar'
            ]
        ],
        2 => [
            'accent' => 'amber',
            'icon' => 'bi-balance',
            'title' => 'Kepastian Hukum & Keadilan Sosial',
            'tag' => 'Regulasi & Pelayanan',
            'bullets' => [
                'Kemudahan akses regulasi hukum daerah bagi warga',
                'Harmonisasi naskah hukum yang adil dan tertib',
                'Edukasi dan kesadaran hukum masyarakat luas'
            ]
        ],
        3 => [
            'accent' => 'emerald',
            'icon' => 'bi-tree-fill',
            'title' => 'Pariwisata & Kemakmuran Rakyat',
            'tag' => 'Ekonomi Berkelanjutan',
            'bullets' => [
                'Pemberdayaan pariwisata Danau Toba berdaya saing',
                'Penguatan UMKM dan ekonomi kerakyatan',
                'Pembangunan ramah lingkungan dan lestari'
            ]
        ],
    ];
@endphp

<!-- ============================================================
     EXECUTIVE HEADER BANNER
     ============================================================ -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active">Visi &amp; Misi</li>
            </ol>
        </nav>
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">
                Visi &amp; Misi <span class="text-gold">Kabupaten Toba</span>
            </h1>
            <p class="text-white-50 small mb-0">Landasan filosofis, arah kebijakan strategis, dan komitmen pelayanan hukum Pemerintah Kabupaten Toba</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         MISI STRATEGIS DAERAH (3-COLUMN CORPORATE GRID)
         ============================================================ -->
    <div class="mb-5">
        <div class="sejarah-section-header text-start mb-4">
            <h2 class="sejarah-section-title">
                Misi Pembangunan <span class="text-gold">Kabupaten Toba</span>
            </h2>
            <p class="sejarah-section-sub mx-0">
                Mewujudkan visi <strong>"{{ $visiText }}"</strong> melalui langkah strategis tata kelola prima dan kepastian hukum bagi seluruh masyarakat
            </p>
        </div>

        <div class="row g-4">
            @foreach($lines as $index => $line)
                @php
                    $num = $index + 1;
                    $cleanText = preg_replace('/^\d+[\.\)]\s*/', '', $line);
                    $meta = $missionMetadata[$num] ?? [
                        'accent' => 'navy',
                        'icon' => 'bi-check-circle-fill',
                        'title' => 'Pilar Pembangunan ' . $num,
                        'tag' => 'Misi Prioritas ' . $num,
                        'bullets' => []
                    ];
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="mission-pillar-card">
                        <!-- Top Hairline Accent -->
                        <div class="mission-pillar-accent accent-{{ $meta['accent'] }}"></div>

                        <div class="mission-pillar-body">
                            <!-- Number Badge & Category Pill -->
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="mission-number-badge num-{{ $meta['accent'] }}">
                                    {{ str_pad($num, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="mission-category-pill pill-{{ $meta['accent'] }}">
                                    <i class="bi {{ $meta['icon'] }} me-1"></i> {{ $meta['tag'] }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h4 class="mission-pillar-headline">
                                {{ $meta['title'] }}
                            </h4>

                            <!-- Main Statement -->
                            <p class="mission-pillar-text">
                                {{ $cleanText }}
                            </p>

                            <!-- Strategic Bullets -->
                            @if(!empty($meta['bullets']))
                                <div class="mission-pillar-bullets mt-auto pt-3 border-top">
                                    @foreach($meta['bullets'] as $bullet)
                                        <div class="mission-bullet-item">
                                            <i class="bi bi-check2-circle text-success"></i>
                                            <span>{{ $bullet }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- ============================================================
         SECTION: PORTAL DISCOVERY HUB
         ============================================================ -->
    <div class="mb-4">
        <div class="sejarah-section-header mb-4">
            <h4 class="sejarah-section-title" style="font-size: 1.25rem;">
                Eksplorasi Informasi <span class="text-gold">Terkait</span>
            </h4>
            <p class="sejarah-section-sub">
                Kenali lebih dekat perjalanan sejarah, susunan kelembagaan, dan saluran kontak resmi Pemerintah Kabupaten Toba
            </p>
        </div>

        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('sejarah') }}" class="sejarah-hub-card">
                    <div class="sejarah-hub-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="sejarah-hub-info">
                        <div class="sejarah-hub-title">Sejarah JDIH</div>
                        <p class="sejarah-hub-desc">Linimasa pembentukan &amp; integrasi hukum</p>
                    </div>
                    <i class="bi bi-arrow-right sejarah-hub-arrow"></i>
                </a>
            </div>

            <div class="col-lg-4 col-md-6">
                <a href="{{ route('struktur') }}" class="sejarah-hub-card">
                    <div class="sejarah-hub-icon">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                    <div class="sejarah-hub-info">
                        <div class="sejarah-hub-title">Struktur Organisasi</div>
                        <p class="sejarah-hub-desc">Bagan tim pengelola JDIH Setdakab Toba</p>
                    </div>
                    <i class="bi bi-arrow-right sejarah-hub-arrow"></i>
                </a>
            </div>

            <div class="col-lg-4 col-md-12">
                <a href="{{ route('kontak') }}" class="sejarah-hub-card">
                    <div class="sejarah-hub-icon">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div class="sejarah-hub-info">
                        <div class="sejarah-hub-title">Kontak &amp; Pelayanan</div>
                        <p class="sejarah-hub-desc">Pusat konsultasi &amp; permohonan salinan fisik</p>
                    </div>
                    <i class="bi bi-arrow-right sejarah-hub-arrow"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
