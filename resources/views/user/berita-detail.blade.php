@extends('layouts.app')

@section('title', $berita->judul . ' - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     EXECUTIVE HEADER BANNER
     ============================================================ -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita Hukum</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 320px;">{{ $berita->judul }}</li>
            </ol>
        </nav>
        <h1 class="h3 fw-bold text-white mb-2" style="line-height: 1.45;">{{ $berita->judul }}</h1>
        <div class="small text-white-50 d-flex align-items-center gap-3 flex-wrap">
            <span>{{ $berita->created_at ? $berita->created_at->translatedFormat('l, d F Y - H:i') : '-' }} WIB</span>
            <span class="opacity-50">&bull;</span>
            <span>Bagian Hukum Setdakab Toba</span>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden p-4 p-md-5 bg-white mb-4">
                @if($berita->gambar)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" class="img-fluid rounded-4 w-100 shadow-sm" style="max-height: 480px; object-fit: cover;" alt="{{ $berita->judul }}">
                    </div>
                @endif

                <div class="article-body text-secondary" style="font-size: 1.05rem; line-height: 1.95;">
                    @if(strip_tags($berita->isi) !== $berita->isi)
                        {!! strip_tags($berita->isi, '<p><br><strong><b><em><i><u><ul><ol><li><a><blockquote><h1><h2><h3><h4><h5><h6>') !!}
                    @else
                        {!! nl2br(e($berita->isi)) !!}
                    @endif
                </div>

                <hr class="my-4">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <a href="{{ route('berita') }}" class="btn-executive-back">
                        Kembali ke Indeks Berita
                    </a>

                    <!-- SHARE BUTTONS -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-muted me-1 fw-bold">Bagikan:</span>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Bagikan ke WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Bagikan ke Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
