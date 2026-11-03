@extends('layouts.app')

@section('title', 'Pengumuman - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Pengumuman</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-megaphone-fill text-danger me-2"></i> Pengumuman Resmi</h2>
        <p class="text-muted small mb-0 mt-1">Daftar pengumuman, surat edaran, dan informasi penting Bagian Hukum Kabupaten Toba</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        @forelse($pengumumans as $item)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100 d-flex flex-column justify-content-between hover-shadow transition border-top border-4 border-primary">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ $item->tanggal_upload ? $item->tanggal_upload->translatedFormat('d F Y') : '-' }}</small>
                            @if($item->file_pdf)
                                <span class="badge bg-danger" title="Ada Lampiran PDF"><i class="bi bi-paperclip"></i> PDF</span>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-2">
                            <a href="{{ route('pengumuman.show', $item->id) }}" class="text-decoration-none text-dark hover-primary">
                                {{ $item->judul }}
                            </a>
                        </h5>
                        <p class="small text-muted mb-0" style="line-height: 1.6;">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>
                    </div>

                    <div class="pt-3 mt-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('pengumuman.show', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                            Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        @if($item->file_pdf)
                            <a href="{{ asset('uploads/pengumuman/' . $item->file_pdf) }}" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-2" title="Unduh PDF">
                                <i class="bi bi-download"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5 bg-white rounded-4 border text-muted">
                <i class="bi bi-megaphone display-4 text-secondary mb-2 d-block"></i>
                <h6 class="fw-bold">Belum ada pengumuman</h6>
            </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $pengumumans->links() }}
    </div>
</div>
@endsection
