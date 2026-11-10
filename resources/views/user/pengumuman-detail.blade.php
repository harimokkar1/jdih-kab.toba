@extends('layouts.app')

@section('title', $pengumuman->judul . ' - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     EXECUTIVE HEADER BANNER
     ============================================================ -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 320px;">{{ $pengumuman->judul }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2 mb-2">
            <span class="badge bg-danger text-white px-2.5 py-1 rounded-pill small fw-bold">
                <i class="bi bi-megaphone-fill me-1"></i> PENGUMUMAN RESMI
            </span>
        </div>
        <h1 class="h3 fw-bold text-white mb-2" style="line-height: 1.45;">{{ $pengumuman->judul }}</h1>
        <div class="small text-white-50 d-flex align-items-center gap-3">
            <span><i class="bi bi-calendar3 text-warning me-1"></i> Tanggal Terbit: {{ $pengumuman->tanggal_upload ? $pengumuman->tanggal_upload->translatedFormat('l, d F Y') : '-' }}</span>
            <span><i class="bi bi-shield-check text-warning me-1"></i> Bagian Hukum Setdakab Toba</span>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <div class="{{ $pengumuman->file_pdf ? 'col-lg-7' : 'col-lg-9' }}">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-file-earmark-text-fill text-danger me-2"></i> Isi Maklumat &amp; Pengumuman</h5>
                <div class="article-body text-secondary" style="font-size: 1.05rem; line-height: 1.95;">
                    {!! nl2br(e($pengumuman->isi)) !!}
                </div>

                <hr class="my-4">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4 fw-bold">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pengumuman
                    </a>

                    @if($pengumuman->file_pdf)
                        <a href="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" target="_blank" class="btn btn-danger btn-sm rounded-pill px-4 fw-bold d-inline-flex align-items-center gap-2 shadow-sm">
                            <i class="bi bi-download"></i> Unduh Lampiran Resmi PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($pengumuman->file_pdf)
            <div class="col-lg-5">
                <div class="pdf-viewer-card sticky-top" style="top: 85px;">
                    <div class="pdf-viewer-header">
                        <span class="fw-bold small"><i class="bi bi-file-earmark-pdf text-danger me-1"></i> Pratinjau Lampiran</span>
                        <a href="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" target="_blank" class="btn btn-sm btn-light rounded-pill px-3 py-1 text-dark fw-bold" style="font-size: 0.78rem;">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka
                        </a>
                    </div>
                    <div class="p-0">
                        <iframe src="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" class="pdf-viewer-frame" style="height: 540px;"></iframe>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
