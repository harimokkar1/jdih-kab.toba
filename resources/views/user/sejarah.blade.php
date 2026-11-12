@extends('layouts.app')

@section('title', 'Sejarah & Transformasi - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     EXECUTIVE HEADER BANNER
     ============================================================ -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active">Sejarah JDIH</li>
            </ol>
        </nav>
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">
                Sejarah &amp; Transformasi <span class="text-gold">JDIH Kabupaten Toba</span>
            </h1>
            <p class="text-white-50 small mb-0">Menelusuri jejak pembentukan, evolusi regulasi, dan transformasi digital keterbukaan hukum di Kabupaten Toba</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         VERTICAL INTERACTIVE CHRONOLOGY TIMELINE
         ============================================================ -->
    <div class="sejarah-timeline-container">
        <div class="sejarah-section-header">
            <h3 class="sejarah-section-title">
                Linimasa Perjalanan <span class="text-gold">&amp; Transformasi</span>
            </h3>
            <p class="sejarah-section-sub">
                Rekam jejak tahapan perkembangan pengelolaan regulasi dari arsip konvensional menuju portal digital hukum terpadu
            </p>
        </div>

        <div class="sejarah-timeline">
            <!-- TIMELINE 1: 2012 -->
            <div class="sejarah-timeline-item">
                <div class="sejarah-timeline-node">
                    <i class="bi bi-bank2"></i>
                </div>
                <div class="sejarah-timeline-card">
                    <div class="sejarah-badge-row">
                        <span class="sejarah-year-chip">2012</span>
                        <span class="sejarah-phase-pill">Fase Fondasi &amp; Pembentukan</span>
                    </div>
                    <h4 class="sejarah-card-heading">Lahirnya Landasan Jaringan Dokumentasi Hukum Nasional</h4>
                    <p class="sejarah-card-desc">
                        Diterbitkannya Peraturan Presiden Nomor 33 Tahun 2012 tentang JDIHN menjadi dasar hukum pembentukan simpul jaringan dokumentasi hukum terintegrasi di seluruh Indonesia. Pemerintah Kabupaten Toba mengawali penataan naskah hukum daerah secara terpusat di bawah koordinasi Bagian Hukum Setdakab Toba.
                    </p>
                    <ul class="sejarah-key-points">
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Pembentukan simpul jaringan dokumentasi hukum daerah</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Inventarisasi berkas lembaran peraturan daerah</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Penetapan standar kodifikasi naskah hukum resmi</li>
                    </ul>
                </div>
            </div>

            <!-- TIMELINE 2: 2016-2020 -->
            <div class="sejarah-timeline-item">
                <div class="sejarah-timeline-node">
                    <i class="bi bi-file-earmark-lock2-fill"></i>
                </div>
                <div class="sejarah-timeline-card">
                    <div class="sejarah-badge-row">
                        <span class="sejarah-year-chip">2016 &ndash; 2020</span>
                        <span class="sejarah-phase-pill">Fase Standardisasi &amp; Arsip Digital</span>
                    </div>
                    <h4 class="sejarah-card-heading">Modernisasi Kearsipan &amp; Digitalisasi Naskah Hukum</h4>
                    <p class="sejarah-card-desc">
                        Menjawab tuntutan keterbukaan informasi publik dan akuntabilitas tata kelola pemerintahan, Bagian Hukum Setdakab Toba mengalihkan penyimpanan arsip lembaran cetak ke format digital beresolusi tinggi, merapikan klasifikasi Peraturan Daerah (PERDA), Peraturan Bupati (PERBUP), dan Keputusan Bupati (KEPBUP).
                    </p>
                    <ul class="sejarah-key-points">
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Digitalisasi naskah hukum ke format PDF terverifikasi</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Penerapan SOP uji keabsahan &amp; status keberlakuan regulasi</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Rintisan layanan penyebarluasan informasi hukum bagi masyarakat</li>
                    </ul>
                </div>
            </div>

            <!-- TIMELINE 3: 2021-2024 -->
            <div class="sejarah-timeline-item">
                <div class="sejarah-timeline-node">
                    <i class="bi bi-diagram-3-fill"></i>
                </div>
                <div class="sejarah-timeline-card">
                    <div class="sejarah-badge-row">
                        <span class="sejarah-year-chip">2021 &ndash; 2024</span>
                        <span class="sejarah-phase-pill">Fase Integrasi Satu Data JDIHN</span>
                    </div>
                    <h4 class="sejarah-card-heading">Integrasi Penuh API v2.0 ke BPHN Kementerian Hukum RI</h4>
                    <p class="sejarah-card-desc">
                        Portal JDIH Kabupaten Toba terhubung secara otomatis ke sistem basis data JDIHN Nasional (jdihn.go.id) di bawah Badan Pembinaan Hukum Nasional (BPHN). Standardisasi metadata nasional dan validasi otomatis memastikan keterpaduan naskah regulasi Kabupaten Toba dalam satu data hukum Indonesia.
                    </p>
                    <ul class="sejarah-key-points">
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Pertukaran data otomatis API v2.0 nasional secara real-time</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Pratinjau digital interaktif (Instant PDF Preview)</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Standardisasi metadata TEU Badan, Subjek, dan Sumber Hukum</li>
                    </ul>
                </div>
            </div>

            <!-- TIMELINE 4: MENUJU 2030 -->
            <div class="sejarah-timeline-item">
                <div class="sejarah-timeline-node">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                </div>
                <div class="sejarah-timeline-card">
                    <div class="sejarah-badge-row">
                        <span class="sejarah-year-chip">Visi 2030</span>
                        <span class="sejarah-phase-pill">Fase Transformasi Ekosistem Cerdas</span>
                    </div>
                    <h4 class="sejarah-card-heading">Mewujudkan Ekosistem Regulasi Toba Mantap 2030</h4>
                    <p class="sejarah-card-desc">
                        Menghadirkan portal dokumentasi hukum cerdas berbasis *Citizen-Centric UI/UX* dengan pencarian pintar, tata kelola ramah disabilitas, dan keterhubungan layanan publik multi-kanal guna menyukseskan visi Pemerintah Kabupaten Toba menuju kepastian hukum yang adil dan berkeadaban.
                    </p>
                    <ul class="sejarah-key-points">
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Antarmuka modern, cepat, dan responsif lintas perangkat</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Konsultasi dan bantuan informasi regulasi terintegrasi</li>
                        <li class="sejarah-key-point"><i class="bi bi-check-circle-fill"></i> Menopang fondasi hukum terpercaya Menuju Toba Mantap 2030</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
         LEGAL FOUNDATION FRAMEWORK (3-COLUMN CARDS)
         ============================================================ -->
    <div class="mb-5">
        <div class="sejarah-section-header">
            <h3 class="sejarah-section-title">
                Landasan Yuridis <span class="text-gold">&amp; Payung Hukum</span>
            </h3>
            <p class="sejarah-section-sub">
                Regulasi resmi yang mendasari eksistensi, tata kelola, dan operasional JDIH Kabupaten Toba
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="sejarah-framework-card">
                    <div class="sejarah-framework-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="sejarah-framework-sub">Regulasi Tingkat Nasional</div>
                    <h4 class="sejarah-framework-title">Perpres No. 33 Tahun 2012</h4>
                    <p class="sejarah-framework-text">
                        Tentang Jaringan Dokumentasi dan Informasi Hukum Nasional sebagai payung hukum utama integrasi basis data regulasi antar lembaga pemerintah di Indonesia.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="sejarah-framework-card">
                    <div class="sejarah-framework-icon">
                        <i class="bi bi-journal-check"></i>
                    </div>
                    <div class="sejarah-framework-sub">Standar Pengelolaan Teknis</div>
                    <h4 class="sejarah-framework-title">Permenkumham No. 8 Tahun 2019</h4>
                    <p class="sejarah-framework-text">
                        Pedoman standar pengelolaan naskah, verifikasi otentisitas, standardisasi format metadata, serta pengoperasian sistem informasi hukum daerah.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="sejarah-framework-card">
                    <div class="sejarah-framework-icon">
                        <i class="bi bi-building-check"></i>
                    </div>
                    <div class="sejarah-framework-sub">Pemerintah Kabupaten Toba</div>
                    <h4 class="sejarah-framework-title">Regulasi Kelembagaan Daerah</h4>
                    <p class="sejarah-framework-text">
                        Peraturan Bupati dan Keputusan Bupati Toba yang menetapkan Bagian Hukum Sekretariat Daerah sebagai pengelola tunggal simpul jaringan JDIH Kabupaten Toba.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
         PORTAL DISCOVERY HUB (CLEAN SPACIOUS NAVIGATION)
         ============================================================ -->
    <div class="mb-4">
        <div class="sejarah-section-header mb-4">
            <h4 class="sejarah-section-title" style="font-size: 1.25rem;">
                Eksplorasi Informasi <span class="text-gold">Terkait</span>
            </h4>
            <p class="sejarah-section-sub">
                Kenali lebih dekat landasan strategis, susunan kelembagaan, dan koleksi regulasi Pemerintah Kabupaten Toba
            </p>
        </div>

        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('visi') }}" class="sejarah-hub-card">
                    <div class="sejarah-hub-icon">
                        <i class="bi bi-compass-fill"></i>
                    </div>
                    <div class="sejarah-hub-info">
                        <div class="sejarah-hub-title">Visi &amp; Misi Daerah</div>
                        <p class="sejarah-hub-desc">Arah kebijakan strategis Kabupaten Toba</p>
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
                <a href="{{ route('user.produk-hukum.global') }}" class="sejarah-hub-card">
                    <div class="sejarah-hub-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                    <div class="sejarah-hub-info">
                        <div class="sejarah-hub-title">Katalog Produk Hukum</div>
                        <p class="sejarah-hub-desc">Akses ribuan naskah regulasi resmi daerah</p>
                    </div>
                    <i class="bi bi-arrow-right sejarah-hub-arrow"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
