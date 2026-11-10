@extends('layouts.app')

@section('title', 'JDIH Kabupaten Toba - Jaringan Dokumentasi dan Informasi Hukum')

@section('content')

<!-- ============================================================
     HERO SECTION (CLEAN TOBA HERITAGE & CITIZEN SMART SEARCH)
     ============================================================ -->
<section class="hero-search-wrapper">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <!-- Large Title JDIH with Gold Accent -->
                <h1 class="hero-main-title">JDI<span class="gold">H</span></h1>
                <div class="hero-main-title-sub">KABUPATEN TOBA</div>

                <!-- Subtitle -->
                <p class="hero-search-subtitle mx-auto">
                    <strong>Satu Data</strong> dokumen hukum <strong>Kabupaten Toba</strong> &mdash; Akses naskah resmi peraturan perundang-undangan dan informasi hukum dalam satu platform terpercaya
                </p>

                <!-- Search Bar Pill -->
                <div class="hero-smart-search-card mx-auto">
                    <form action="{{ route('user.cari') }}" method="GET">
                        <div class="smart-search-input-group">
                            <input type="text" name="judul" class="smart-search-input" placeholder="Ketik judul, nomor, topik atau kata kunci peraturan..." value="{{ request('judul') }}" autocomplete="off">
                            <button type="submit" class="btn-smart-search-submit" title="Cari Dokumen">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Quick Topic Tags -->
                <div class="hero-quick-tags justify-content-center">
                    <span class="hero-quick-tags-label"><i class="bi bi-fire text-danger me-1"></i>Topik Populer:</span>
                    <a href="{{ route('user.cari', ['judul' => 'Pajak']) }}" class="hero-tag-link">#PajakDaerah</a>
                    <a href="{{ route('user.cari', ['judul' => 'Pariwisata']) }}" class="hero-tag-link">#Pariwisata</a>
                    <a href="{{ route('user.cari', ['judul' => 'APBD']) }}" class="hero-tag-link">#APBD</a>
                    <a href="{{ route('user.cari', ['judul' => 'Tata Ruang']) }}" class="hero-tag-link">#TataRuang</a>
                    <a href="{{ route('user.cari', ['judul' => 'Kesehatan']) }}" class="hero-tag-link">#Kesehatan</a>
                    <a href="{{ route('user.cari', ['judul' => 'Desa']) }}" class="hero-tag-link">#PemerintahanDesa</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SEKSI PIMPINAN DAERAH (KOMITMEN TOBA MANTAP 2030 & REGULASI)
     ============================================================ -->
<section class="leadership-governance-section py-4 py-lg-5">
    <div class="container">
        <div class="leadership-executive-card">
            <div class="row align-items-center g-4 g-xl-5">
                <!-- SISI KIRI: FOTO RESMI LANDSCAPE BUPATI & WAKIL BUPATI -->
                <div class="col-lg-6">
                    <div class="leadership-photo-canvas">
                        <div class="leadership-photo-halo"></div>
                        <div class="leadership-photo-frame">
                            <img src="{{ asset('pimpinan-toba.png') }}" 
                                 alt="Bupati & Wakil Bupati Kabupaten Toba - Effendi S. P. Napitupulu, SE & Drs. Audi Murphy O. Sitorus, SH., M.Si" 
                                 class="leadership-img">
                            <div class="leadership-photo-glare"></div>
                        </div>
                    </div>
                </div>

                <!-- SISI KANAN: NARASI & KOMITMEN HUKUM PEMKAB TOBA -->
                <div class="col-lg-6">
                    <div class="leadership-narrative ps-lg-2">
                        <div class="leadership-badge-pill mb-3">
                            <span>PEMERINTAH KABUPATEN TOBA</span>
                        </div>

                        <h2 class="leadership-title">
                            Menuju <span class="text-gold">Toba Mantap 2030</span> Melalui Kepastian Hukum
                        </h2>

                        <blockquote class="leadership-quote mb-3">
                            &ldquo;Maju Daerahnya, Sejahtera Rakyatnya, dan Berkelanjutan Pembangunannya.&rdquo;
                        </blockquote>

                        <p class="leadership-desc">
                            Pemerintah Kabupaten Toba di bawah kepemimpinan Bupati <strong>Effendi S. P. Napitupulu, SE</strong> bersama Wakil Bupati <strong>Drs. Audi Murphy O. Sitorus, SH., M.Si</strong> berkomitmen mewujudkan tata kelola pemerintahan yang bersih, transparan, dan akuntabel melalui keterbukaan regulasi perundang-undangan daerah yang mudah diakses serta terintegrasi secara nasional demi kemajuan seluruh masyarakat Toba.
                        </p>

                        <!-- CTA Actions -->
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <a href="{{ route('visi') }}" class="btn btn-navy rounded-pill px-4 py-2 fw-bold">
                                Visi &amp; Misi Daerah
                            </a>
                            <a href="{{ route('struktur') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                                Struktur Tim JDIH
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     DOKUMEN TERBARU / TERPOPULER (PREMIUM SIGNATURE CARDS)
     ============================================================ -->
<section class="py-5 bg-white">
    <div class="container">
        <!-- Section Header -->
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
            <div>
                <span class="section-kicker-badge badge-blue">
                    <i class="bi bi-clock-history"></i> ARSIP REGULASI RESMI
                </span>
                <h3 class="section-title mb-1">Dokumen <span class="text-gold">{{ ($activeTab ?? 'terbaru') === 'populer' ? 'Terpopuler' : 'Terbaru' }}</span></h3>
                <p class="section-subtitle mb-0">Koleksi naskah hukum resmi yang baru diterbitkan atau paling banyak diakses masyarakat</p>
            </div>
            <a href="{{ route('user.produk-hukum.global') }}" class="bulletin-view-all-pill">
                <span>Lihat semua arsip</span> <i class="bi bi-chevron-right ms-1"></i>
            </a>
        </div>

        <!-- Document Cards List -->
        <div class="d-flex flex-column gap-3">
            @forelse($produkHukumTerbaru as $ph)
                <div class="modern-doc-card">
                    <!-- Card Top: Badges & Tanggal -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge-doc-type">{{ $ph->jenisPeraturan->singkatan ?? 'REGULASI' }}</span>
                            @if(($ph->status ?? 'BERLAKU') !== 'BERLAKU')
                                <span class="badge-status-inactive">
                                    <i class="bi bi-x-circle me-1"></i> {{ $ph->status }}
                                </span>
                            @endif
                        </div>
                        @if($ph->tanggal_penetapan)
                            <span class="text-muted small">
                                <i class="bi bi-calendar-check me-1"></i> Penetapan: {{ $ph->tanggal_penetapan->translatedFormat('d F Y') }}
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h5 class="doc-title mb-2">
                        <a href="{{ route('user.produk-hukum.detail', $ph->id) }}">
                            {{ strtoupper($ph->judul) }}
                        </a>
                    </h5>

                    <!-- Meta Chips -->
                    <div class="doc-meta-chips mb-2">
                        <span class="doc-meta-chip">
                            <i class="bi bi-file-earmark-text text-primary"></i>
                            <span>{{ $ph->jenisPeraturan->nama ?? 'Peraturan' }} <strong>Nomor {{ $ph->nomor_peraturan ?: '-' }}</strong></span>
                        </span>
                        <span class="doc-meta-chip">
                            <i class="bi bi-calendar3 text-warning"></i>
                            <span>Tahun: <strong>{{ $ph->tahun ?: '-' }}</strong></span>
                        </span>
                        <span class="doc-meta-chip">
                            <i class="bi bi-building text-secondary"></i>
                            <span>Pemrakarsa: <strong>{{ $ph->teu_badan ?: 'Pemerintah Kabupaten Toba' }}</strong></span>
                        </span>
                    </div>

                    <!-- Snippet / Abstrak -->
                    <p class="doc-snippet-text">
                        {{ Str::limit(strip_tags($ph->abstrak ?? $ph->subjek ?? ''), 220) ?: 'Dokumen resmi peraturan perundang-undangan Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba.' }}
                    </p>

                    <!-- Footer: Stats + Buttons -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                        <div class="d-flex align-items-center gap-3 text-muted small">
                            <span title="Jumlah Kali Dilihat"><i class="bi bi-eye-fill me-1 text-primary"></i> {{ number_format($ph->view_count ?? 0, 0, ',', '.') }}x dilihat</span>
                            <span title="Jumlah Unduhan"><i class="bi bi-download me-1 text-success"></i> {{ number_format($ph->download_count ?? 0, 0, ',', '.') }}x diunduh</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('user.produk-hukum.detail', $ph->id) }}" class="btn-doc-detail">
                                <i class="bi bi-info-circle me-1"></i> Rincian
                            </a>
                            @if(!empty($ph->file_dokumen))
                                <button type="button" class="btn-doc-preview" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#pdfPreviewModal" 
                                    data-pdf-url="{{ route('user.produk-hukum.preview', $ph->id) }}" 
                                    data-pdf-title="{{ $ph->judul }}"
                                    data-pdf-download="{{ route('user.produk-hukum.download', $ph->id) }}">
                                    <i class="bi bi-eye me-1"></i> Pratinjau
                                </button>
                            @endif
                            <a href="{{ route('user.produk-hukum.download', $ph->id) }}" class="btn-doc-download">
                                <i class="bi bi-download"></i> Unduh PDF
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted py-5 border rounded-3 bg-light">
                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary"></i>
                    Belum ada produk hukum yang diunggah.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ============================================================
     KLASIFIKASI PRODUK HUKUM (THEMATIC DISTINCT ICONS & BORDERS)
     ============================================================ -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="section-title mb-0">Klasifikasi Produk Hukum</h3>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center">
            @forelse($jenisPeraturans as $item)
                @php
                    $slug = Str::slug($item->nama);
                    $iconClass = 'bi-envelope-paper-fill';
                    $themeClass = 'theme-edaran';
                    $tagText = $item->singkatan ?: 'SE';

                    if (str_contains($slug, 'perda') || str_contains($slug, 'daerah')) {
                        $iconClass = 'bi-bank2';
                        $themeClass = 'theme-perda';
                        $tagText = $item->singkatan ?: 'PERDA';
                    } elseif (str_contains($slug, 'perbup') || str_contains($slug, 'peraturan-bupati')) {
                        $iconClass = 'bi-award-fill';
                        $themeClass = 'theme-perbup';
                        $tagText = $item->singkatan ?: 'PERBUP';
                    } elseif (str_contains($slug, 'kepbup') || str_contains($slug, 'keputusan')) {
                        $iconClass = 'bi-file-earmark-check-fill';
                        $themeClass = 'theme-kepbup';
                        $tagText = $item->singkatan ?: 'KEPBUP';
                    } elseif (str_contains($slug, 'inbup') || str_contains($slug, 'instruksi')) {
                        $iconClass = 'bi-lightning-charge-fill';
                        $themeClass = 'theme-inbup';
                        $tagText = $item->singkatan ?: 'INBUP';
                    }
                @endphp
                <div class="col">
                    <a href="{{ route('user.produk-hukum.jenis', $item->slug) }}" class="legal-thematic-card {{ $themeClass }} text-decoration-none">
                        <div class="legal-card-icon">
                            <i class="bi {{ $iconClass }}"></i>
                        </div>
                        <h6 class="legal-card-title">{{ $item->nama }}</h6>
                        <span class="legal-card-tag">{{ $tagText }}</span>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    Belum ada kategori jenis produk hukum.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ============================================================
     BERITA & PENGUMUMAN RESMI (KANVAS WARTA & MAKLUMAT HUKUM TOBA)
     ============================================================ -->
<section class="news-bulletin-section py-5">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <!-- BERITA HUKUM (col-lg-7) -->
            <div class="col-lg-7">
                <div class="bulletin-header">
                    <div>
                        <h4 class="section-title mb-1">Berita <span class="text-gold">Hukum</span></h4>
                        <p class="section-subtitle mb-0">Sosialisasi peraturan, transparansi dan agenda hukum Kabupaten Toba</p>
                    </div>
                    <a href="{{ route('berita') }}" class="bulletin-view-all-pill">
                        <span>Semua Berita</span> <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($beritas as $b)
                        <article class="news-modern-card">
                            <div class="row g-0 align-items-stretch">
                                <div class="col-sm-4">
                                    <div class="news-thumb-wrapper">
                                        @if($b->gambar)
                                            <img src="{{ asset('uploads/berita/' . $b->gambar) }}" alt="{{ $b->judul }}" class="news-thumb-img">
                                        @else
                                            <div class="news-thumb-placeholder">
                                                <i class="bi bi-newspaper"></i>
                                            </div>
                                        @endif
                                        <span class="news-category-badge">Berita JDIH</span>
                                    </div>
                                </div>
                                <div class="col-sm-8 d-flex flex-column justify-content-between">
                                    <div class="news-body-content p-3 p-xl-4">
                                        <div class="news-meta-row mb-2">
                                            <span class="news-date">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $b->created_at ? $b->created_at->translatedFormat('d F Y') : '-' }}
                                            </span>
                                            <span class="news-meta-sep">&bull;</span>
                                            <span class="news-author">Bagian Hukum</span>
                                        </div>
                                        <h6 class="news-title mb-2">
                                            <a href="{{ route('berita.detail', $b->id) }}">{{ Str::limit($b->judul, 75) }}</a>
                                        </h6>
                                        <p class="news-excerpt mb-0">
                                            {{ Str::limit(strip_tags($b->isi), 105) ?: 'Informasi dan dokumentasi kegiatan sosialisasi hukum Pemerintah Kabupaten Toba.' }}
                                        </p>
                                    </div>
                                    <div class="news-footer-action px-3 px-xl-4 pb-3">
                                        <a href="{{ route('berita.detail', $b->id) }}" class="news-read-link">
                                            <span>Baca Selengkapnya</span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center text-muted p-4 bg-light rounded-3">
                            Belum ada berita hukum yang diterbitkan.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- PENGUMUMAN RESMI (col-lg-5) -->
            <div class="col-lg-5">
                <div class="bulletin-header header-announcement">
                    <div>
                        <h4 class="section-title mb-1">Pengumuman <span class="text-gold">Resmi</span></h4>
                        <p class="section-subtitle mb-0">Pemberitahuan resmi Sekretariat Daerah Kabupaten Toba</p>
                    </div>
                    <a href="{{ route('pengumuman.index') }}" class="bulletin-view-all-pill">
                        <span>Semua</span> <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($pengumumans as $p)
                        <div class="announcement-modern-card">
                            <div class="announcement-datebox">
                                <span class="datebox-month">{{ $p->tanggal_upload ? $p->tanggal_upload->translatedFormat('M') : date('M') }}</span>
                                <span class="datebox-day">{{ $p->tanggal_upload ? $p->tanggal_upload->format('d') : date('d') }}</span>
                            </div>
                            <div class="flex-grow-1">
                                <div class="announcement-top-meta mb-1">
                                    <span class="announcement-badge"><i class="bi bi-megaphone-fill me-1"></i> Pengumuman</span>
                                </div>
                                <h6 class="announcement-title mb-2">
                                    <a href="{{ route('pengumuman.show', $p->id) }}">{{ $p->judul }}</a>
                                </h6>
                                <a href="{{ route('pengumuman.show', $p->id) }}" class="announcement-link">
                                    <span>Lihat Pengumuman</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted p-3 bg-light rounded-3">
                            Belum ada pengumuman resmi.
                        </div>
                    @endforelse

                    <!-- Service Promo / Helpdesk Card (Balances the right column) -->
                    <div class="jdih-service-promo-card mt-2">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="service-promo-icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div>
                                <h6 class="service-promo-title mb-0">Layanan Informasi &amp; Bantuan</h6>
                                <small class="text-muted">Bagian Hukum Setdakab Toba</small>
                            </div>
                        </div>
                        <p class="service-promo-desc mb-3">
                            Butuh naskah fisik regulasi daerah atau konsultasi seputar JDIH Toba? Hubungi tim dokumentasi hukum kami.
                        </p>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                <i class="bi bi-envelope me-1"></i> Kontak
                            </a>
                            <a href="https://wa.me/6281362444195" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                <i class="bi bi-whatsapp me-1"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SINERGI ANTAR LEMBAGA (PORTAL MITRA STRATEGIS)
     ============================================================ -->
<section class="py-5 synergy-section" style="background: #f8fafc;">
    <div class="container">
        <div class="text-center mb-4 pb-1">
            <h3 class="section-title mb-1">Sinergi <span class="text-gold">Antar Lembaga</span></h3>
            <p class="section-subtitle mx-auto mb-0" style="max-width: 580px;">
                Jaringan dokumentasi hukum nasional dan keterhubungan portal layanan publik terintegrasi Pemerintah RI &amp; Daerah
            </p>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3 g-xl-4">
            <!-- JDIH NASIONAL -->
            <div class="col">
                <a href="https://jdihn.go.id" target="_blank" rel="noopener noreferrer" class="modern-link-card h-100">
                    <div class="modern-link-top d-flex justify-content-between align-items-center mb-3">
                        <div class="modern-link-logo-tile">
                            <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN BPHN">
                        </div>
                        <div class="modern-link-ext-pill" title="Kunjungi Portal">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="modern-link-body">
                        <h6 class="modern-link-title">JDIH Nasional</h6>
                        <p class="modern-link-desc">Pusat JDIHN Badan Pembinaan Hukum Nasional Kementerian Hukum RI</p>
                    </div>
                    <div class="modern-link-footer">
                        <span class="modern-link-domain"><i class="bi bi-globe2 me-1"></i>jdihn.go.id</span>
                        <span class="modern-link-agency">BPHN RI</span>
                    </div>
                </a>
            </div>

            <!-- JDIH PROV SUMUT -->
            <div class="col">
                <a href="https://jdih.sumutprov.go.id" target="_blank" rel="noopener noreferrer" class="modern-link-card h-100">
                    <div class="modern-link-top d-flex justify-content-between align-items-center mb-3">
                        <div class="modern-link-logo-tile">
                            <img src="{{ asset('PROVINSI.jpg') }}" alt="Logo JDIH Provinsi Sumatera Utara">
                        </div>
                        <div class="modern-link-ext-pill" title="Kunjungi Portal">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="modern-link-body">
                        <h6 class="modern-link-title">JDIH Prov. Sumut</h6>
                        <p class="modern-link-desc">Portal Jaringan Dokumentasi &amp; Informasi Hukum Provinsi Sumatera Utara</p>
                    </div>
                    <div class="modern-link-footer">
                        <span class="modern-link-domain"><i class="bi bi-globe2 me-1"></i>jdih.sumutprov.go.id</span>
                        <span class="modern-link-agency">Pemprov Sumut</span>
                    </div>
                </a>
            </div>

            <!-- PEMKAB TOBA -->
            <div class="col">
                <a href="https://tobakab.go.id" target="_blank" rel="noopener noreferrer" class="modern-link-card h-100">
                    <div class="modern-link-top d-flex justify-content-between align-items-center mb-3">
                        <div class="modern-link-logo-tile">
                            <img src="{{ asset('logo.png') }}" alt="Logo Kabupaten Toba">
                        </div>
                        <div class="modern-link-ext-pill" title="Kunjungi Portal">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="modern-link-body">
                        <h6 class="modern-link-title">Pemkab Toba</h6>
                        <p class="modern-link-desc">Portal Resmi Pelayanan Informasi Pemerintah Daerah Kabupaten Toba</p>
                    </div>
                    <div class="modern-link-footer">
                        <span class="modern-link-domain"><i class="bi bi-globe2 me-1"></i>tobakab.go.id</span>
                        <span class="modern-link-agency">Pemkab Toba</span>
                    </div>
                </a>
            </div>

            <!-- SP4N LAPOR -->
            <div class="col">
                <a href="https://www.lapor.go.id" target="_blank" rel="noopener noreferrer" class="modern-link-card h-100">
                    <div class="modern-link-top d-flex justify-content-between align-items-center mb-3">
                        <div class="modern-link-logo-tile">
                            <img src="{{ asset('lapor.png') }}" alt="Logo SP4N-LAPOR!">
                        </div>
                        <div class="modern-link-ext-pill" title="Kunjungi Portal">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="modern-link-body">
                        <h6 class="modern-link-title">SP4N-LAPOR!</h6>
                        <p class="modern-link-desc">Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional Republik Indonesia</p>
                    </div>
                    <div class="modern-link-footer">
                        <span class="modern-link-domain"><i class="bi bi-globe2 me-1"></i>lapor.go.id</span>
                        <span class="modern-link-agency">KemenPAN-RB</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
