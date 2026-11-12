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
            <span class="badge bg-gold-subtle text-gold px-2.5 py-1 rounded-pill small fw-bold">
                Pengumuman Resmi
            </span>
        </div>
        <h1 class="h3 fw-bold text-white mb-2" style="line-height: 1.45;">{{ $pengumuman->judul }}</h1>
        <div class="small text-white-50 d-flex align-items-center gap-3">
            <span>Tanggal Terbit: {{ $pengumuman->tanggal_upload ? $pengumuman->tanggal_upload->translatedFormat('l, d F Y') : '-' }}</span>
            <span class="opacity-50">&bull;</span>
            <span>Bagian Hukum Setdakab Toba</span>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <div class="{{ $pengumuman->file_pdf ? 'col-lg-7' : 'col-lg-9' }}">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                <h5 class="fw-bold text-dark mb-3">Isi Maklumat &amp; Pengumuman</h5>
                <div class="article-body text-secondary" style="font-size: 1.05rem; line-height: 1.95;">
                    {!! nl2br(e($pengumuman->isi)) !!}
                </div>

                <hr class="my-4">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <a href="{{ route('pengumuman.index') }}" class="btn-executive-back">
                        Kembali ke Daftar Pengumuman
                    </a>

                    @if($pengumuman->file_pdf)
                        <a href="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" target="_blank" class="btn-pdf-download-pill" style="padding: 8px 18px; font-size: 0.85rem;" title="Unduh Berkas PDF">
                            Unduh Lampiran Resmi PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($pengumuman->file_pdf)
            <div class="col-lg-5">
                <div class="pdf-viewer-card sticky-top" style="top: 85px;">
                    <div class="pdf-viewer-header d-flex justify-content-between align-items-center py-2 px-3">
                        <span class="fw-bold small text-white"><i class="bi bi-file-earmark-pdf text-danger me-1"></i> Pratinjau Lampiran</span>
                        
                        <button type="button" class="btn btn-sm btn-light rounded-pill px-2.5 py-1 text-dark fw-bold" style="font-size: 0.75rem;" 
                                data-bs-toggle="modal" data-bs-target="#pdfPreviewModal" 
                                data-pdf-url="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" 
                                data-pdf-title="{{ $pengumuman->judul }}" 
                                data-pdf-download="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}">
                            <i class="bi bi-arrows-fullscreen me-1"></i> Layar Penuh
                        </button>
                    </div>
                    <div class="p-0 position-relative text-center overflow-auto" id="pengumumanPdfContainer" style="height: 540px; background: #323639;">
                        <div id="pengumumanPdfLoading" class="position-absolute top-50 start-50 translate-middle text-center text-white">
                            <div class="spinner-border spinner-border-sm text-light mb-2" role="status"></div>
                            <p class="small text-white-50 mb-0" style="font-size: 0.78rem;">Memuat berkas...</p>
                        </div>
                        <div id="pengumumanPdfError" class="py-5 text-center text-white" style="display: none; padding-top: 130px !important;">
                            <i class="bi bi-file-earmark-x fs-1 text-warning mb-2 d-block"></i>
                            <h6 class="text-white mb-2 fs-6">Pratinjau Tidak Tersedia</h6>
                            <a href="{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}" class="btn btn-sm btn-primary rounded-pill px-4" download>
                                Unduh Lampiran
                            </a>
                        </div>
                        <div class="p-3 d-flex justify-content-center">
                            <canvas id="pengumumanPdfCanvas" class="shadow-lg mx-auto" style="display: none; max-width: 100%; height: auto; border-radius: 4px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
@if($pengumuman->file_pdf)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pdfUrl = "{{ asset('uploads/pengumuman/' . $pengumuman->file_pdf) }}";
        const canvas = document.getElementById('pengumumanPdfCanvas');
        if (!canvas || !pdfUrl || !window.pdfjsLib) return;

        const ctx = canvas.getContext('2d');
        const loading = document.getElementById('pengumumanPdfLoading');
        const errorBox = document.getElementById('pengumumanPdfError');

        pdfjsLib.getDocument({
            url: pdfUrl,
            cMapUrl: 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/cmaps/',
            cMapPacked: true,
        }).promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const viewport = page.getViewport({ scale: 1.1 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderCtx = { canvasContext: ctx, viewport: viewport };
                page.render(renderCtx).promise.then(function() {
                    if (loading) loading.style.display = 'none';
                    canvas.style.display = 'block';
                });
            });
        }).catch(function(err) {
            if (loading) loading.style.display = 'none';
            if (errorBox) errorBox.style.display = 'block';
        });
    });
</script>
@endif
@endpush
