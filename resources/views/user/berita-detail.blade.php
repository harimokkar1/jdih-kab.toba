@extends('layouts.app')

@section('title', $berita->judul . ' - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita Hukum</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 320px;">{{ $berita->judul }}</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-2">{{ $berita->judul }}</h2>
        <div class="small text-muted d-flex align-items-center gap-3">
            <span><i class="bi bi-calendar3 text-primary me-1"></i> {{ $berita->created_at ? $berita->created_at->translatedFormat('l, d F Y - H:i') : '-' }} WIB</span>
            <span><i class="bi bi-person-fill text-primary me-1"></i> Admin Bagian Hukum</span>
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

                <div class="article-body text-dark" style="font-size: 1.05rem; line-height: 1.9;">
                    {!! nl2br(e($berita->isi)) !!}
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('berita') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Berita
                    </a>

                    <!-- SHARE BUTTONS -->
                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-muted me-1">Bagikan:</span>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-circle" style="width: 34px; height: 34px;" title="WhatsApp">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle" style="width: 34px; height: 34px;" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
