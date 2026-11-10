@extends('layouts.app')

@section('title', 'Sejarah JDIH - JDIH Kabupaten Toba')

@section('content')

<!-- TOP CURVED BANNER -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active">Sejarah JDIH</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1 text-white">Sejarah JDIH Kabupaten Toba</h1>
        <p class="text-white-50 small mb-0">Perjalanan pembentukan, landasan regulasi, dan transformasi digital jaringan dokumentasi hukum daerah</p>
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
                            <i class="bi bi-shield-check text-gold me-1"></i> DOKUMENTASI HUKUM RESMI PEMERINTAH KABUPATEN TOBA
                        </span>
                        <h2 class="h4 fw-bold text-dark mt-2 mb-1" style="letter-spacing: -0.3px;">
                            Jaringan Dokumentasi dan Informasi Hukum
                        </h2>
                        <p class="text-muted small mb-0">
                            Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba
                        </p>
                    </div>
                </div>

                <!-- LEAD CALLOUT / EXECUTIVE QUOTE -->
                <div class="profile-lead-callout mb-4">
                    <div class="profile-lead-icon">
                        <i class="bi bi-quote"></i>
                    </div>
                    <div>
                        <span class="profile-lead-badge">Amanat Regulasi Nasional</span>
                        <div class="profile-lead-text">
                            Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kabupaten Toba dibentuk berdasarkan amanat <strong>Peraturan Presiden Nomor 33 Tahun 2012</strong> tentang Jaringan Dokumentasi dan Informasi Hukum Nasional sebagai pusat rujukan regulasi daerah yang tertib, terpadu, dan berkesinambungan guna menjamin kepastian hukum bagi seluruh elemen masyarakat.
                        </div>
                    </div>
                </div>

                <!-- STRUCTURED STORY TILES -->
                <div class="mb-4">
                    <!-- TILE 1: PEMBENTUKAN -->
                    <div class="profile-story-tile">
                        <div class="profile-story-header">
                            <div class="profile-story-icon-box icon-navy">
                                <i class="bi bi-bank2"></i>
                            </div>
                            <h3 class="profile-story-title">Latar Belakang &amp; Pembentukan</h3>
                        </div>
                        <p class="profile-story-body">
                            Keberadaan JDIH Kabupaten Toba lahir dari kebutuhan mendasar akan pengelolaan dokumentasi produk hukum daerah yang profesional, otentik, dan mudah diakses. Sebagai tindak lanjut penetapan Perpres No. 33 Tahun 2012, Pemerintah Kabupaten Toba membangun wadah terpusat dokumentasi hukum guna memastikan seluruh naskah peraturan tersimpan secara rapi, memiliki kepastian hukum, dan terlindungi integritas informasinya.
                        </p>
                    </div>

                    <!-- TILE 2: TATA KELOLA & DIGITALISASI -->
                    <div class="profile-story-tile">
                        <div class="profile-story-header">
                            <div class="profile-story-icon-box icon-gold">
                                <i class="bi bi-file-earmark-lock2-fill"></i>
                            </div>
                            <h3 class="profile-story-title">Komitmen Tata Kelola &amp; Transparansi Publik</h3>
                        </div>
                        <p class="profile-story-body">
                            Pemerintah Kabupaten Toba melalui <strong>Bagian Hukum Sekretariat Daerah</strong> terus berkomitmen meningkatkan tata kelola dokumentasi peraturan perundang-undangan—mulai dari <strong>Peraturan Daerah (PERDA)</strong>, <strong>Peraturan Bupati (PERBUP)</strong>, hingga <strong>Keputusan Bupati (KEPBUP)</strong>. Digitalisasi menyeluruh dihadirkan agar setiap regulasi dapat diakses secara terbuka, akuntabel, dan cepat tanpa hambatan jarak maupun batasan waktu.
                        </p>
                    </div>

                    <!-- TILE 3: INTEGRASI SATU DATA -->
                    <div class="profile-story-tile">
                        <div class="profile-story-header">
                            <div class="profile-story-icon-box icon-teal">
                                <i class="bi bi-diagram-3-fill"></i>
                            </div>
                            <h3 class="profile-story-title">Transformasi Digital &amp; Integrasi Satu Data JDIHN</h3>
                        </div>
                        <p class="profile-story-body">
                            Seiring laju transformasi digital tata kelola pemerintahan berbasis elektronik (SPBE), portal JDIH Kabupaten Toba telah <strong>terintegrasi secara penuh dengan portal JDIHN Nasional</strong> yang dikelola oleh <strong>Badan Pembinaan Hukum Nasional (BPHN) Kementerian Hukum Republik Indonesia</strong>. Integrasi melalui pertukaran data API v2.0 memastikan standardisasi metadata naskah hukum, validitas data terverifikasi, serta kepastian hukum yang kokoh bagi publik.
                        </p>
                    </div>
                </div>

                <!-- THREE FEATURE PILLARS -->
                <div class="row g-3 pt-3 mb-4 border-top">
                    <div class="col-md-4">
                        <div class="profile-pillar-card">
                            <div class="profile-pillar-icon-pedestal pedestal-blue">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h4 class="profile-pillar-title">Legalitas Sah</h4>
                            <p class="profile-pillar-text">
                                Berlandaskan Perpres No. 33 Tahun 2012 dan Peraturan Bupati tentang Pengelolaan JDIH Kabupaten Toba.
                            </p>
                            <span class="profile-pillar-badge badge-pillar-blue">
                                <i class="bi bi-check2-circle"></i> Payung Hukum Sah
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-pillar-card">
                            <div class="profile-pillar-icon-pedestal pedestal-amber">
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                            </div>
                            <h4 class="profile-pillar-title">Terintegrasi Nasional</h4>
                            <p class="profile-pillar-text">
                                Terkoneksi secara otomatis via API v2.0 ke basis data JDIHN Badan Pembinaan Hukum Nasional RI.
                            </p>
                            <span class="profile-pillar-badge badge-pillar-amber">
                                <i class="bi bi-cpu"></i> Satu Data JDIHN
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="profile-pillar-card">
                            <div class="profile-pillar-icon-pedestal pedestal-emerald">
                                <i class="bi bi-globe2"></i>
                            </div>
                            <h4 class="profile-pillar-title">Akses Terbuka</h4>
                            <p class="profile-pillar-text">
                                Pelayanan informasi regulasi daerah dan unduh naskah digital publik aktif 24/7 tanpa dipungut biaya.
                            </p>
                            <span class="profile-pillar-badge badge-pillar-emerald">
                                <i class="bi bi-unlock-fill"></i> Layanan 24/7 Gratis
                            </span>
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
                        <a href="{{ route('visi') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-eye-fill text-primary"></i> Visi &amp; Misi
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
