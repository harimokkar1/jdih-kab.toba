@extends('layouts.app')

@section('title', 'Berita Hukum - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Berita Hukum</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-newspaper text-primary me-2"></i> Berita & Kegiatan Hukum</h2>
        <p class="text-muted small mb-0 mt-1">Publikasi informasi, sosialisasi peraturan daerah, dan agenda Bagian Hukum Kabupaten Toba</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @forelse($beritas as $item)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-shadow transition">
                    @if($item->gambar)
                        <img src="{{ asset('uploads/berita/' . $item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $item->judul }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 200px;">
                            <i class="bi bi-newspaper fs-1"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : '-' }}
                            </small>
                            <h5 class="fw-bold mb-2">
                                <a href="{{ route('berita.detail', $item->id) }}" class="text-decoration-none text-dark hover-primary">
                                    {{ Str::limit($item->judul, 75) }}
                                </a>
                            </h5>
                            <p class="small text-muted mb-0" style="line-height: 1.6;">
                                {{ Str::limit(strip_tags($item->isi), 110) }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top">
                            <a href="{{ route('berita.detail', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-semibold">
                                Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white rounded-4 border text-muted">
                <i class="bi bi-newspaper display-4 text-secondary mb-2 d-block"></i>
                <h6 class="fw-bold">Belum ada berita yang dipublikasikan</h6>
            </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $beritas->links() }}
    </div>
</div>
@endsection
