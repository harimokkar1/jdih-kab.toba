@extends('layouts.app')

@section('title', 'Berita & Kegiatan Hukum - JDIH Kabupaten Toba')

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
                <li class="breadcrumb-item active">Berita Hukum</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">
                    <i class="bi bi-newspaper text-warning me-2"></i> Berita &amp; Kegiatan Hukum Daerah
                </h1>
                <p class="text-white-50 small mb-0">Publikasi informasi resmi, sosialisasi peraturan daerah, dan agenda Bagian Hukum Sekretariat Daerah Kabupaten Toba</p>
            </div>
            <div>
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold fs-6 shadow-xs">
                    <i class="bi bi-broadcast me-1"></i> Publikasi Resmi Pemkab Toba
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @forelse($beritas as $item)
            <div class="col-lg-4 col-md-6">
                <article class="berita-grid-card">
                    <!-- THUMBNAIL WRAPPER -->
                    <div class="berita-thumb-container">
                        <span class="berita-badge-floating">
                            <i class="bi bi-newspaper"></i> Warta JDIH
                        </span>

                        @if($item->gambar)
                            <img src="{{ asset('uploads/berita/' . $item->gambar) }}" class="berita-thumb-img" alt="{{ $item->judul }}">
                            <div class="berita-thumb-overlay"></div>
                        @else
                            <div class="news-thumb-placeholder">
                                <i class="bi bi-newspaper display-4 text-white-50"></i>
                            </div>
                        @endif
                    </div>

                    <!-- CARD BODY -->
                    <div class="berita-card-body">
                        <!-- META STRIP -->
                        <div class="berita-meta-strip">
                            <span>
                                <i class="bi bi-calendar3"></i>
                                {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }}
                            </span>
                            <span class="berita-meta-sep">&bull;</span>
                            <span>
                                <i class="bi bi-building text-primary"></i> Bagian Hukum
                            </span>
                        </div>

                        <!-- TITLE -->
                        <h2 class="berita-card-title">
                            <a href="{{ route('berita.detail', $item->id) }}" title="{{ $item->judul }}">
                                {{ Str::limit($item->judul, 72) }}
                            </a>
                        </h2>

                        <!-- EXCERPT -->
                        <p class="berita-card-excerpt">
                            {{ Str::limit(strip_tags($item->isi), 115) ?: 'Informasi dan dokumentasi kegiatan sosialisasi hukum Pemerintah Kabupaten Toba.' }}
                        </p>
                    </div>

                    <!-- CARD FOOTER -->
                    <div class="berita-card-footer">
                        <span class="small text-muted" style="font-size: 0.75rem;">
                            <i class="bi bi-shield-check text-success me-1"></i> Rilis Resmi
                        </span>
                        <a href="{{ route('berita.detail', $item->id) }}" class="berita-action-btn">
                            <span>Baca Selengkapnya</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white rounded-4 border text-muted shadow-xs">
                <i class="bi bi-newspaper display-4 text-secondary mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Belum ada berita yang dipublikasikan</h5>
                <p class="small text-muted mb-0">Informasi terbaru mengenai kegiatan hukum daerah akan ditampilkan di sini.</p>
            </div>
        @endforelse
    </div>

    @if($beritas->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $beritas->links() }}
        </div>
    @endif
</div>
@endsection
