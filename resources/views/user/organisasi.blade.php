@extends('layouts.app')

@section('title', 'Struktur Organisasi - JDIH Kabupaten Toba')

@section('content')

@php
    $items = isset($allStruktur) && $allStruktur->count() > 0 ? $allStruktur : $struktur;
    $grouped = $items->groupBy('tingkat');
    $tingkatKeys = $grouped->keys()->sort()->values();
@endphp

<!-- TOP CURVED BANNER -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active">Struktur Organisasi</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1 text-white">Struktur Organisasi Pengelola JDIH</h1>
        <p class="text-white-50 small mb-0">Bagan kelembagaan dan susunan tim pengelola Jaringan Dokumentasi dan Informasi Hukum Kabupaten Toba</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
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
                            <i class="bi bi-diagram-3-fill text-gold me-1"></i> TATA KELOLA &amp; KELEMBAGAAN JDIH
                        </span>
                        <h2 class="h4 fw-bold text-dark mt-2 mb-1" style="letter-spacing: -0.3px;">
                            Bagan Susunan Tim Pengelola JDIH
                        </h2>
                        <p class="text-muted small mb-0">
                            Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba
                        </p>
                    </div>
                </div>

                <!-- INSTITUTIONAL PREAMBLE CALLOUT -->
                <div class="profile-lead-callout mb-5">
                    <div class="profile-lead-icon">
                        <i class="bi bi-building-fill-gear"></i>
                    </div>
                    <div>
                        <span class="profile-lead-badge">Tata Kelola Kelembagaan</span>
                        <div class="profile-lead-text">
                            Pengelolaan JDIH Kabupaten Toba diselenggarakan secara terpusat oleh <strong>Bagian Hukum Sekretariat Daerah Kabupaten Toba</strong> dengan pembagian fungsi pengumpulan, verifikasi, standardisasi metadata, digitalisasi naskah, dan pelayanan regulasi publik sesuai amanat <strong>Perpres No. 33 Tahun 2012</strong> dan standar integrasi BPHN RI.
                        </div>
                    </div>
                </div>

                <!-- HIERARCHICAL ORG TIERS -->
                @if($items->count() > 0)
                    @foreach($tingkatKeys as $tingkatIndex => $tingkat)
                        @php
                            $members = $grouped->get($tingkat);
                            
                            // Styling konfigurasi per tingkat
                            if ($tingkat == 1) {
                                $tierBadge = 'tier-gold';
                                $tierIcon = 'bi-star-fill text-gold';
                                $tierPillText = 'Pimpinan Utama & Penanggung Jawab';
                                $tierHeading = 'Pembina & Pengarah Kelembagaan';
                                $cardClass = 'card-leader';
                                $roleClass = 'role-gold';
                                $iconRole = 'bi-patch-check-fill text-gold';
                                $colClass = $members->count() === 1 ? 'col-lg-6 col-md-8 mx-auto' : ($members->count() === 2 ? 'col-lg-5 col-md-6' : 'col-lg-4 col-md-6');
                            } elseif ($tingkat == 2) {
                                $tierBadge = 'tier-navy';
                                $tierIcon = 'bi-diagram-2-fill text-primary';
                                $tierPillText = 'Koordinator & Pengawas Teknis';
                                $tierHeading = 'Sub Koordinator / Verifikator Hukum';
                                $cardClass = 'card-subleader';
                                $roleClass = 'role-navy';
                                $iconRole = 'bi-shield-check text-primary';
                                $colClass = 'col-lg-4 col-md-6';
                            } else {
                                $tierBadge = 'tier-emerald';
                                $tierIcon = 'bi-people-fill text-success';
                                $tierPillText = 'Tim Pelaksana & Pengelola Data';
                                $tierHeading = 'Operator, Analis, & Pengolah Data JDIH';
                                $cardClass = 'card-staff';
                                $roleClass = 'role-emerald';
                                $iconRole = 'bi-cpu-fill text-success';
                                $colClass = 'col-lg-4 col-md-6';
                            }
                        @endphp

                        @if($tingkatIndex > 0)
                            <div class="org-connector-line"></div>
                        @endif

                        <div class="org-tier-wrapper">
                            <div class="org-tier-header">
                                <span class="org-tier-pill {{ $tierBadge }}">
                                    <i class="bi {{ $tierIcon }} me-1"></i> {{ $tierPillText }}
                                </span>
                                <h3 class="h5 fw-bold text-dark mt-2 mb-1">{{ $tierHeading }}</h3>
                                <p class="text-muted small mb-0">Tingkat Hierarki {{ $tingkat }}</p>
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

                                            <!-- ROLE BADGE (SLIM & ELEGANT) -->
                                            <span class="org-role-capsule {{ $roleClass }}">
                                                <i class="bi {{ $iconRole }}"></i> {{ $person->jabatan }}
                                            </span>

                                            <!-- NAMA -->
                                            <h4 class="org-member-name">{{ $person->nama }}</h4>

                                            <!-- UNIT INSTANSI -->
                                            <div class="org-institution-tag">
                                                <i class="bi bi-building text-gold"></i> Bagian Hukum Setdakab Toba
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-5 bg-light rounded-4 border text-muted">
                        <i class="bi bi-diagram-3 display-4 text-secondary mb-3 d-block"></i>
                        <h5 class="fw-bold text-dark">Data struktur organisasi belum ditambahkan</h5>
                        <p class="small text-muted mb-0">Bagan susunan tim pengelola JDIH akan segera diperbarui oleh administrator.</p>
                    </div>
                @endif

                <!-- QUICK NAVIGATION PILL FOOTER -->
                <div class="profile-quick-nav mt-5">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-compass text-gold fs-5"></i>
                        <span class="small fw-bold text-dark">Informasi Profil Lainnya:</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <a href="{{ route('sejarah') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-hourglass-split text-primary"></i> Sejarah JDIH
                        </a>
                        <a href="{{ route('visi') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-eye-fill text-primary"></i> Visi &amp; Misi
                        </a>
                        <a href="{{ route('struktur') }}" class="profile-nav-pill-btn active">
                            <i class="bi bi-diagram-3-fill text-gold"></i> Struktur Organisasi
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
