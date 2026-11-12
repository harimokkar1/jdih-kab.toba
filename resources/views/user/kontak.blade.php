@extends('layouts.app')

@section('title', 'Kontak Kami - JDIH Kabupaten Toba')

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
                <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
        </nav>
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">
                Pusat Layanan &amp; <span class="text-gold">Kontak JDIH</span>
            </h1>
            <p class="text-white-50 small mb-0">Layanan permohonan salinan naskah hukum resmi, konsultasi regulasi daerah, dan saluran informasi publik</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         EXECUTIVE HEADQUARTERS & INTERACTIVE MAP CONSOLE
         ============================================================ -->
    <div class="row g-4 align-items-stretch mb-5">
        <!-- LEFT COLUMN: SECRETARIAT & DIRECTORY -->
        <div class="col-lg-5">
            <div class="contact-console-card">
                <div class="contact-console-header">
                    <h3 class="h5 fw-bold text-dark mb-1">Sekretariat JDIH Kabupaten Toba</h3>
                    <p class="text-muted small mb-0">Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba</p>
                </div>

                <div class="contact-console-body">
                    <!-- BLOCK 1: ALAMAT -->
                    <div class="contact-block-item">
                        <div class="contact-block-pedestal pedestal-navy">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <div class="contact-block-title">Alamat Kantor Resmi</div>
                            <p class="contact-block-desc">
                                Jl. Sutomo, Pagar Batu, Balige 22385<br>
                                Kabupaten Toba, Provinsi Sumatera Utara
                            </p>
                            <span class="badge bg-light text-muted border rounded-pill px-2.5 py-1 small mt-1">
                                Kompleks Kantor Bupati Toba
                            </span>
                        </div>
                    </div>

                    <!-- BLOCK 2: SALURAN KONTAK CEPAT -->
                    <div class="contact-block-item">
                        <div class="contact-block-pedestal pedestal-emerald">
                            <i class="bi bi-headset"></i>
                        </div>
                        <div>
                            <div class="contact-block-title">Saluran Komunikasi Cepat</div>
                            <p class="contact-block-desc mb-2">
                                Konsultasi naskah regulasi &amp; layanan informasi publik:
                            </p>
                            <div class="contact-channel-buttons">
                                <a href="https://wa.me/6281362444195" target="_blank" class="contact-channel-btn btn-wa">
                                    <i class="bi bi-whatsapp"></i> 0813-6244-4195
                                </a>
                                <a href="mailto:hukumtobasamosirkab@gmail.com" class="contact-channel-btn btn-mail">
                                    <i class="bi bi-envelope-at"></i> Surel Kedinasan
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- BLOCK 3: JAM OPERASIONAL -->
                    <div class="contact-block-item">
                        <div class="contact-block-pedestal pedestal-amber">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="contact-block-title">Jam Pelayanan Kedinasan</div>
                            <table class="contact-schedule-table">
                                <tr>
                                    <td>Senin – Kamis</td>
                                    <td class="text-end fw-bold text-dark">08.00 – 16.30 WIB</td>
                                </tr>
                                <tr>
                                    <td>Jumat</td>
                                    <td class="text-end fw-bold text-dark">08.00 – 16.00 WIB</td>
                                </tr>
                                <tr>
                                    <td>Sabtu – Minggu</td>
                                    <td class="text-end text-danger fw-semibold">Tutup (Libur)</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- BLOCK 4: MAKLUMAT JAMINAN BEBAS BIAYA -->
                    <div class="contact-guarantee-note">
                        <i class="bi bi-shield-check text-success fs-5 flex-shrink-0"></i>
                        <div>
                            <strong>Layanan 100% Bebas Biaya:</strong> Permohonan salinan dokumen hukum dan konsultasi regulasi tidak dipungut biaya retribusi apapun.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: INTERACTIVE MAP CANVAS -->
        <div class="col-lg-7">
            <div class="map-canvas-card">
                <div class="map-canvas-header">
                    <div>
                        <div class="map-location-tagline">Denah Lokasi Kantor Pemkab Toba</div>
                        <p class="map-location-sub">
                            <i class="bi bi-geo-alt text-gold me-1"></i> Jl. Sutomo, Balige, Kabupaten Toba, Sumatera Utara
                        </p>
                    </div>
                    <a href="https://maps.google.com/?q=Kantor+Bupati+Toba" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Google Maps
                    </a>
                </div>
                
                <div class="flex-grow-1 p-0 position-relative">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15944.38531776953!2d99.0558145!3d2.3364448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e043f2115682d%3A0xe6bf448cf822e11a!2sKantor%20Bupati%20Toba!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        class="map-canvas-frame"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="map-canvas-footer">
                    <span class="map-foot-tag">
                        <i class="bi bi-geo-alt-fill text-gold"></i> Balige Kota
                    </span>
                    <span class="map-foot-tag">
                        <i class="bi bi-building text-gold"></i> Kompleks Bupati Toba
                    </span>
                    <span class="map-foot-tag">
                        <i class="bi bi-door-open-fill text-gold"></i> Bagian Hukum Setdakab
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
         PORTAL DISCOVERY HUB
         ============================================================ -->
    <div class="mb-4">
        <div class="sejarah-section-header mb-4">
            <h4 class="sejarah-section-title" style="font-size: 1.25rem;">
                Eksplorasi Informasi <span class="text-gold">Terkait</span>
            </h4>
            <p class="sejarah-section-sub">
                Kenali lebih dalam sejarah pembentukan jaringan, landasan visi misi, serta susunan tim pengelola JDIH Kabupaten Toba
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
        </div>
    </div>
</div>
@endsection
