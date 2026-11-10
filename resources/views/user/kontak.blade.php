@extends('layouts.app')

@section('title', 'Kontak Kami - JDIH Kabupaten Toba')

@section('content')

<!-- TOP CURVED BANNER -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Profil</li>
                <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold mb-1 text-white">Kontak &amp; Pelayanan Informasi</h1>
        <p class="text-white-50 small mb-0">Pusat layanan informasi regulasi, permohonan salinan naskah hukum, dan konsultasi hukum publik daerah</p>
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
                            <i class="bi bi-headset text-gold me-1"></i> PUSAT LAYANAN &amp; KONSULTASI REGULASI DAERAH
                        </span>
                        <h2 class="h4 fw-bold text-dark mt-2 mb-1" style="letter-spacing: -0.3px;">
                            Sekretariat JDIH Kabupaten Toba
                        </h2>
                        <p class="text-muted small mb-0">
                            Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba
                        </p>
                    </div>
                </div>

                <!-- MAIN CONTACT GRID: INFO & MAP -->
                <div class="row g-4 align-items-stretch">
                    
                    <!-- LEFT COLUMN: CHANNELS & WORKING HOURS -->
                    <div class="col-lg-5">
                        <div class="d-flex flex-column h-100">
                            
                            <!-- TILE 1: ALAMAT KANTOR -->
                            <div class="contact-channel-tile">
                                <div class="contact-pedestal pedestal-blue">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="contact-channel-content">
                                    <h5 class="contact-channel-title">Alamat Kantor Resmi</h5>
                                    <p class="contact-channel-desc">
                                        Bagian Hukum Sekretariat Daerah Kabupaten Toba<br>
                                        Jl. Sutomo, Pagar Batu, Balige 22385<br>
                                        Kabupaten Toba, Provinsi Sumatera Utara
                                    </p>
                                    <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1 small">
                                        <i class="bi bi-pin-map-fill text-danger me-1"></i> Kompleks Kantor Bupati Toba
                                    </span>
                                </div>
                            </div>

                            <!-- TILE 2: WHATSAPP & HOTLINE -->
                            <div class="contact-channel-tile">
                                <div class="contact-pedestal pedestal-emerald">
                                    <i class="bi bi-whatsapp"></i>
                                </div>
                                <div class="contact-channel-content">
                                    <h5 class="contact-channel-title">Telepon &amp; WhatsApp Resmi</h5>
                                    <p class="contact-channel-desc">
                                        Layanan informasi &amp; konsultasi cepat publik:
                                    </p>
                                    <a href="https://wa.me/6281362444195" target="_blank" class="contact-action-link link-whatsapp">
                                        <i class="bi bi-whatsapp"></i> 0813-6244-4195 <i class="bi bi-arrow-up-right ms-1"></i>
                                    </a>
                                    <small class="text-success d-block mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-check-circle-fill me-1"></i> Responsif pada jam kerja kedinasan
                                    </small>
                                </div>
                            </div>

                            <!-- TILE 3: SUREL / EMAIL -->
                            <div class="contact-channel-tile">
                                <div class="contact-pedestal pedestal-amber">
                                    <i class="bi bi-envelope-fill"></i>
                                </div>
                                <div class="contact-channel-content">
                                    <h5 class="contact-channel-title">Surat Elektronik (Surel)</h5>
                                    <p class="contact-channel-desc">
                                        Permohonan naskah regulasi &amp; persuratan resmi:
                                    </p>
                                    <a href="mailto:hukumtobasamosirkab@gmail.com" class="contact-action-link link-email">
                                        <i class="bi bi-envelope-at"></i> hukumtobasamosirkab@gmail.com <i class="bi bi-arrow-up-right ms-1"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- TILE 4: JAM PELAYANAN -->
                            <div class="contact-channel-tile mb-0">
                                <div class="contact-pedestal pedestal-navy">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                                <div class="contact-channel-content">
                                    <h5 class="contact-channel-title">Jam Pelayanan Publik</h5>
                                    <div class="small text-muted" style="line-height: 1.6;">
                                        <div class="d-flex justify-content-between border-bottom py-1">
                                            <span>Senin – Kamis</span>
                                            <span class="fw-bold text-dark">08.00 – 16.30 WIB</span>
                                        </div>
                                        <div class="d-flex justify-content-between border-bottom py-1">
                                            <span>Jumat</span>
                                            <span class="fw-bold text-dark">08.00 – 16.00 WIB</span>
                                        </div>
                                        <div class="pt-1 text-danger small">
                                            <i class="bi bi-info-circle me-1"></i> Sabtu, Minggu &amp; Libur Nasional Tutup
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- RIGHT COLUMN: INTERACTIVE MAP CANVAS -->
                    <div class="col-lg-7">
                        <div class="map-canvas-card">
                            <div class="map-canvas-header">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-warning fs-5"></i>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0" style="font-size: 0.98rem;">Denah Lokasi Kantor Pemkab Toba</h5>
                                        <span class="map-location-pill mt-1">
                                            <i class="bi bi-compass text-gold"></i> Balige, Kabupaten Toba
                                        </span>
                                    </div>
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
                        </div>
                    </div>

                </div>

                <!-- INSTITUTIONAL HELP NOTE -->
                <div class="profile-lead-callout mt-4 mb-4">
                    <div class="profile-lead-icon">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>
                    <div>
                        <span class="profile-lead-badge">Layanan Permohonan Salinan Regulasi</span>
                        <div class="profile-lead-text">
                            Masyarakat, instansi pemerintah, akademisi, dan media yang membutuhkan salinan fisik naskah resmi <strong>Lembaran Daerah</strong>, <strong>Berita Daerah</strong>, atau konsultasi hukum dapat mengajukan permohonan melalui sekretariat JDIH di atas tanpa dipungut biaya retribusi apapun.
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
                        <a href="{{ route('visi') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-eye-fill text-primary"></i> Visi &amp; Misi
                        </a>
                        <a href="{{ route('struktur') }}" class="profile-nav-pill-btn">
                            <i class="bi bi-diagram-3-fill text-warning"></i> Struktur Organisasi
                        </a>
                        <a href="{{ route('kontak') }}" class="profile-nav-pill-btn active">
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
