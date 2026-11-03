@extends('layouts.app')

@section('title', $pengumuman->judul . ' - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 300px;">{{ $pengumuman->judul }}</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-2">{{ $pengumuman->judul }}</h2>
        <div class="small text-muted d-flex align-items-center gap-3">
            <span><i class="bi bi-calendar3 text-primary me-1"></i> Dipublikasikan: {{ $pengumuman->tanggal_upload ? $pengumuman->tanggal_upload->translatedFormat('l, d F Y') : '-' }}</span>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <div class="{{ $pengumuman->file_pdf ? 'col-lg-7' : 'col-lg-9' }}">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle me-2"></i> Isi Pengumuman</h5>
                <div class="article-body text-dark" style="font-size: 1.05rem; line-height: 1.9;">
                    {!! nl2br(e($pengumuman->isi)) !!}
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Pengumuman
                    </a>

                    @if($pengumuman->file_pdf)
                        <a href="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" target="_blank" class="btn btn-danger btn-sm rounded-pill px-3">
                            <i class="bi bi-download me-1"></i> Unduh Berkas PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($pengumuman->file_pdf)
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden sticky-top" style="top: 90px;">
                    <div class="card-header bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center">
                        <span class="fw-bold"><i class="bi bi-file-earmark-pdf me-2"></i> Pratinjau Berkas</span>
                        <a href="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" target="_blank" class="btn btn-sm btn-light rounded-pill px-3 py-1 text-primary fw-semibold">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <iframe src="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" width="100%" height="520px" style="border: none;"></iframe>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
