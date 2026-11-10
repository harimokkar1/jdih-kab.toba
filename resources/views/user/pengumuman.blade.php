@extends('layouts.app')

@section('title', 'Pengumuman Resmi - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     EXECUTIVE HEADER BANNER
     ============================================================ -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Informasi</li>
                <li class="breadcrumb-item active">Pengumuman</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">
                    <i class="bi bi-megaphone-fill text-warning me-2"></i> Pengumuman &amp; Maklumat Resmi
                </h1>
                <p class="text-white-50 small mb-0">Daftar pemberitahuan penting, surat edaran, dan maklumat resmi Bagian Hukum Pemerintah Kabupaten Toba</p>
            </div>
            <div>
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold fs-6 shadow-xs">
                    <i class="bi bi-bell-fill me-1"></i> Warta Resmi Pemkab Toba
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        
        <!-- MAIN ANNOUNCEMENT FEED (LEFT COLUMN) -->
        <div class="col-lg-8">
            @forelse($pengumumans as $item)
                <article class="announcement-page-tile">
                    <!-- DATE CALENDAR PEDESTAL -->
                    <div class="announcement-date-pedestal">
                        <span class="announcement-pedestal-day">
                            {{ $item->tanggal_upload ? $item->tanggal_upload->format('d') : date('d') }}
                        </span>
                        <span class="announcement-pedestal-month">
                            {{ $item->tanggal_upload ? $item->tanggal_upload->translatedFormat('M') : date('M') }}
                        </span>
                        <span class="announcement-pedestal-year">
                            {{ $item->tanggal_upload ? $item->tanggal_upload->format('Y') : date('Y') }}
                        </span>
                    </div>

                    <!-- TILE BODY -->
                    <div class="announcement-tile-body">
                        <div class="announcement-tile-badges">
                            <span class="announcement-official-badge">
                                <i class="bi bi-megaphone-fill"></i> Siaran Resmi
                            </span>
                            @if($item->file_pdf)
                                <span class="announcement-pdf-pill">
                                    <i class="bi bi-file-earmark-pdf-fill"></i> Lampiran PDF
                                </span>
                            @endif
                        </div>

                        <!-- TITLE -->
                        <h2 class="announcement-tile-title">
                            <a href="{{ route('pengumuman.show', $item->id) }}" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </a>
                        </h2>

                        <!-- EXCERPT -->
                        <p class="announcement-tile-excerpt">
                            {{ Str::limit(strip_tags($item->isi), 160) }}
                        </p>

                        <!-- FOOTER ACTIONS -->
                        <div class="announcement-tile-footer">
                            <span class="announcement-meta-origin">
                                <i class="bi bi-shield-check text-success"></i> Bagian Hukum Setdakab Toba
                            </span>
                            
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('pengumuman.show', $item->id) }}" class="berita-action-btn">
                                    <span>Lihat Rincian</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>

                                @if($item->file_pdf)
                                    <a href="{{ asset('uploads/pengumuman/' . $item->file_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold" title="Unduh Berkas PDF">
                                        <i class="bi bi-download me-1"></i> Unduh PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-center py-5 bg-white rounded-4 border text-muted shadow-xs">
                    <i class="bi bi-megaphone display-4 text-secondary mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">Belum ada pengumuman resmi yang diterbitkan</h5>
                    <p class="small text-muted mb-0">Pemberitahuan terkini seputar hukum dan regulasi daerah akan ditampilkan di sini.</p>
                </div>
            @endforelse

            @if($pengumumans->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $pengumumans->links() }}
                </div>
            @endif
        </div>

        <!-- RIGHT SIDEBAR: HELPDESK & CHANNELS -->
        <div class="col-lg-4">
            <!-- BOX 1: HELPDESK -->
            <div class="pengumuman-sidebar-box">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-3 bg-danger bg-opacity-10 p-2.5 text-danger fs-3">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div>
                        <span class="small text-muted fw-bold text-uppercase">Bantuan &amp; Validasi</span>
                        <h5 class="fw-bold text-dark mb-0">Layanan Informasi JDIH</h5>
                    </div>
                </div>
                <p class="small text-muted mb-3" style="line-height: 1.6;">
                    Butuh konfirmasi keabsahan surat edaran, verifikasi maklumat hukum daerah, atau permohonan salinan naskah fisik resmi? Hubungi pengelola dokumentasi hukum kami.
                </p>
                <div class="d-flex flex-column gap-2">
                    <a href="https://wa.me/6281362444195" target="_blank" class="btn btn-sm btn-success rounded-pill fw-bold py-2">
                        <i class="bi bi-whatsapp me-1"></i> WhatsApp Hotline JDIH
                    </a>
                    <a href="{{ route('kontak') }}" class="btn btn-sm btn-outline-primary rounded-pill fw-bold py-2">
                        <i class="bi bi-geo-alt me-1"></i> Kontak &amp; Lokasi Kantor
                    </a>
                </div>
            </div>

            <!-- BOX 2: KANAL REGULASI TERKAIT -->
            <div class="pengumuman-sidebar-box">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="bi bi-collection-fill text-gold me-2"></i> Akses Dokumen Hukum
                </h6>
                <div class="list-group list-group-flush small">
                    <a href="{{ route('user.produk-hukum.jenis', 'peraturan-daerah') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                        <span><i class="bi bi-file-earmark-ruled me-2 text-primary"></i> Peraturan Daerah (PERDA)</span>
                        <i class="bi bi-chevron-right text-muted text-xs"></i>
                    </a>
                    <a href="{{ route('user.produk-hukum.jenis', 'peraturan-bupati') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                        <span><i class="bi bi-file-earmark-check me-2 text-warning"></i> Peraturan Bupati (PERBUP)</span>
                        <i class="bi bi-chevron-right text-muted text-xs"></i>
                    </a>
                    <a href="{{ route('berita') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2 border-bottom">
                        <span><i class="bi bi-newspaper me-2 text-info"></i> Berita &amp; Kegiatan Hukum</span>
                        <i class="bi bi-chevron-right text-muted text-xs"></i>
                    </a>
                    <a href="{{ route('sejarah') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0 py-2">
                        <span><i class="bi bi-clock-history me-2 text-success"></i> Profil &amp; Sejarah JDIH</span>
                        <i class="bi bi-chevron-right text-muted text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
