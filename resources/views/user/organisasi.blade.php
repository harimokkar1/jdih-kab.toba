@extends('layouts.app')

@section('title', 'Struktur Organisasi - JDIH Kabupaten Toba')

@section('content')

@php
    $items = isset($allStruktur) && $allStruktur->count() > 0 ? $allStruktur : $struktur;
    $grouped = $items->groupBy('tingkat');
    $tingkatKeys = $grouped->keys()->sort()->values();
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
                <li class="breadcrumb-item active">Struktur Organisasi</li>
            </ol>
        </nav>
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">
                Struktur Organisasi <span class="text-gold">Pengelola JDIH</span>
            </h1>
            <p class="text-white-50 small mb-0">Bagan kelembagaan dan susunan tim pengelola Jaringan Dokumentasi dan Informasi Hukum Kabupaten Toba</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         HIERARCHICAL ORG TIERS
         ============================================================ -->
    <div class="mb-5">
        <div class="sejarah-section-header text-start mb-4">
            <h3 class="sejarah-section-title">
                Bagan Hierarki <span class="text-gold">Tim JDIH</span>
            </h3>
            <p class="sejarah-section-sub mx-0">
                Susunan struktural dan fungsional pejabat serta operator pengelola dokumentasi informasi hukum Pemerintah Kabupaten Toba
            </p>
        </div>

        @if($items->count() > 0)
            @foreach($tingkatKeys as $tingkatIndex => $tingkat)
                @php
                    $members = $grouped->get($tingkat);
                    
                    // Konfigurasi per tingkat hierarki
                    if ($tingkat == 1) {
                        $tierBadge = 'tier-gold';
                        $tierPillText = 'Pimpinan Utama & Penanggung Jawab';
                        $tierHeading = 'Pembina & Pengarah Kelembagaan';
                        $tierSubtitle = 'Menetapkan arah kebijakan strategis dan pengawasan umum penyelenggaraan JDIH';
                        $cardClass = 'card-leader';
                        $roleClass = 'role-gold';
                        $iconRole = 'bi-patch-check-fill';
                    } elseif ($tingkat == 2) {
                        $tierBadge = 'tier-navy';
                        $tierPillText = 'Koordinator & Pengawas Teknis';
                        $tierHeading = 'Sub Koordinator / Verifikator Hukum';
                        $tierSubtitle = 'Mengkoordinasikan verifikasi yuridis naskah dan validasi keabsahan dokumen hukum daerah';
                        $cardClass = 'card-subleader';
                        $roleClass = 'role-navy';
                        $iconRole = 'bi-shield-check';
                    } else {
                        $tierBadge = 'tier-slate';
                        $tierPillText = 'Tim Pelaksana & Pengelola Data';
                        $tierHeading = 'Operator, Analis, & Pengolah Data JDIH';
                        $tierSubtitle = 'Menyelenggarakan digitalisasi dokumen, pemeliharaan metadata, dan keterbukaan akses publik';
                        $cardClass = 'card-staff';
                        $roleClass = 'role-emerald';
                        $iconRole = 'bi-check-circle-fill';
                    }

                    $colClass = $members->count() === 1 ? 'col-lg-4 col-md-6' : ($members->count() === 2 ? 'col-lg-5 col-md-6' : 'col-lg-4 col-md-6');
                @endphp

                @if($tingkatIndex > 0)
                    <div class="org-tree-connector">
                        <div class="org-tree-stem"></div>
                        <div class="org-tree-node">
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                @endif

                <div class="org-tier-wrapper">
                    <div class="org-tier-header">
                        <h3 class="org-tier-title">{{ $tierHeading }}</h3>
                        <p class="org-tier-subtitle">{{ $tierSubtitle }}</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        @foreach($members as $person)
                            <div class="{{ $colClass }}">
                                <div class="org-member-card {{ $cardClass }}">
                                    <!-- AVATAR -->
                                    <div class="org-avatar-ring">
                                        @if($person->foto)
                                            <img src="{{ asset('storage/' . $person->foto) }}" alt="{{ $person->nama }}" class="org-avatar-img">
                                        @else
                                            <div class="org-avatar-placeholder {{ $tingkat > 2 ? 'placeholder-staff' : '' }}">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- NAMA -->
                                    <h4 class="org-member-name">{{ $person->nama }}</h4>

                                    <!-- JABATAN / ROLE -->
                                    <span class="org-role-capsule {{ $roleClass }}">
                                        {{ $person->jabatan }}
                                    </span>

                                    <!-- UNIT INSTANSI -->
                                    <div class="org-institution-tag">
                                        Bagian Hukum Setdakab Toba
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-5 bg-white rounded-4 border p-4 shadow-sm text-muted">
                <i class="bi bi-diagram-3 display-4 text-secondary mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Data struktur organisasi belum ditambahkan</h5>
                <p class="small text-muted mb-0">Bagan susunan tim pengelola JDIH akan segera diperbarui oleh administrator.</p>
            </div>
        @endif
    </div>

    <!-- ============================================================
         SECTION 3: PORTAL DISCOVERY HUB
         ============================================================ -->
    <div class="mb-4">
        <div class="sejarah-section-header mb-4">
            <h4 class="sejarah-section-title" style="font-size: 1.25rem;">
                Eksplorasi Informasi <span class="text-gold">Terkait</span>
            </h4>
            <p class="sejarah-section-sub">
                Pelajari rekam jejak linimasa, landasan visi misi, serta saluran permohonan informasi resmi JDIH Kabupaten Toba
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
                <a href="{{ route('visi') }}" class="sejarah-hub-card">
                    <div class="sejarah-hub-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div class="sejarah-hub-info">
                        <div class="sejarah-hub-title">Visi &amp; Misi</div>
                        <p class="sejarah-hub-desc">Arah kebijakan &amp; agenda aksi pembangunan</p>
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
