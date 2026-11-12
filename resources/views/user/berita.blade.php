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
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">
                Berita &amp; Kegiatan <span class="text-gold">Hukum Daerah</span>
            </h1>
            <p class="text-white-50 small mb-0">Publikasi informasi resmi, sosialisasi peraturan daerah, dan agenda Bagian Hukum Sekretariat Daerah Kabupaten Toba</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         SEARCH & FILTER CONSOLE (EXECUTIVE TOOLBAR)
         ============================================================ -->
    <div class="berita-search-wrapper">
        <form action="{{ route('berita') }}" method="GET">
            <div class="berita-search-bar">
                <i class="bi bi-search berita-search-icon"></i>
                <input type="text" name="search" class="berita-search-input" 
                       placeholder="Cari berita atau agenda kegiatan hukum..." 
                       value="{{ request('search') }}"
                       autocomplete="off">
                @if(request('search'))
                    <a href="{{ route('berita') }}" class="berita-search-clear" title="Reset Pencarian">
                        <i class="bi bi-x-circle-fill"></i>
                    </a>
                @endif
                <button class="btn-berita-search" type="submit">
                    Cari
                </button>
            </div>
        </form>

        @if(request('search'))
            <div class="mt-2 pt-2 d-flex align-items-center justify-content-between flex-wrap gap-2 px-1">
                <span class="small text-muted" style="font-size: 0.82rem;">
                    Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                </span>
                <a href="{{ route('berita') }}" class="small text-danger text-decoration-none fw-semibold">
                    <i class="bi bi-x-circle me-1"></i>Reset Pencarian
                </a>
            </div>
        @endif
    </div>

    <!-- ============================================================
         BERITA & WARTA GRID
         ============================================================ -->
    <div class="row g-4">
        @forelse($beritas as $item)
            <div class="col-lg-4 col-md-6">
                <article class="berita-grid-card">
                    <!-- THUMBNAIL WRAPPER -->
                    <div class="berita-thumb-container">
                        @if($item->gambar)
                            <img src="{{ asset('uploads/berita/' . $item->gambar) }}" class="berita-thumb-img" alt="{{ $item->judul }}">
                        @else
                            <div class="news-thumb-placeholder">
                                <i class="bi bi-newspaper display-5 text-white-50"></i>
                            </div>
                        @endif
                    </div>

                    <!-- CARD BODY -->
                    <div class="berita-card-body">
                        <!-- META STRIP -->
                        <div class="berita-meta-strip">
                            <span>
                                {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }}
                            </span>
                            <span class="berita-meta-dot"></span>
                            <span>
                                Bagian Hukum
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
                            {{ Str::limit(html_entity_decode(strip_tags($item->isi)), 115) ?: 'Informasi dan dokumentasi kegiatan sosialisasi hukum Pemerintah Kabupaten Toba.' }}
                        </p>
                    </div>

                    <!-- CARD FOOTER -->
                    <div class="berita-card-footer">
                        <span class="berita-card-category">
                            Warta Daerah
                        </span>
                        <a href="{{ route('berita.detail', $item->id) }}" class="berita-read-link">
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
        <div class="mt-4 d-flex justify-content-end">
            {{ $beritas->links() }}
        </div>
    @endif
</div>
@endsection
