@extends('layouts.app')

@section('title', $jenis->nama . ' - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     CURVED DARK NAVY BANNER
     ============================================================ -->
<div class="inner-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.produk-hukum.global') }}">Produk Hukum</a></li>
                <li class="breadcrumb-item active">{{ $jenis->nama }}</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">{{ $jenis->nama }}</h1>
                <p class="text-white-50 small mb-0">{{ $jenis->deskripsi ?: 'Kumpulan dokumentasi naskah resmi ' . $jenis->nama . ' Kabupaten Toba' }}</p>
            </div>
            <div>
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold fs-6">
                    {{ number_format($peraturans->total(), 0, ',', '.') }} Dokumen
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- FILTER EXECUTIVE CONSOLE -->
    <div class="filter-executive-card">
        <form action="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-lg-5 col-md-12">
                    <label class="filter-field-label">
                        <i class="bi bi-search text-gold me-1"></i> Kata Kunci / Judul / Nomor
                    </label>
                    <input type="text" name="search" class="form-control filter-input" placeholder="Ketik nomor, judul, atau kata kunci..." value="{{ request('search') }}">
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="filter-field-label">
                        <i class="bi bi-calendar3 me-1"></i> Tahun
                    </label>
                    <select name="tahun" class="form-select filter-select">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="filter-field-label">
                        <i class="bi bi-shield-check me-1"></i> Status
                    </label>
                    <select name="status" class="form-select filter-select">
                        <option value="">Semua Status</option>
                        <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                        <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4 col-12 d-flex gap-2 justify-content-lg-end">
                    @if(request()->hasAny(['search', 'tahun', 'status']))
                        <a href="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" class="btn btn-filter-reset" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                    <button type="submit" class="btn btn-filter-submit w-100">
                        <i class="bi bi-funnel-fill me-1"></i> Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- RESULT META BAR -->
    <div class="result-meta-bar d-flex justify-content-between align-items-center mb-3">
        <span class="result-count-badge">
            <i class="bi bi-file-earmark-check text-gold me-1"></i> Total: <strong>{{ number_format($peraturans->total(), 0, ',', '.') }}</strong> Dokumen
        </span>
        <span class="result-page-info">
            Halaman <strong>{{ $peraturans->currentPage() }}</strong> dari {{ $peraturans->lastPage() }}
        </span>
    </div>

    <!-- EXECUTIVE DATA TABLE -->
    <div class="table-executive-card">
        <div class="table-responsive">
            <table class="table-executive">
                <thead>
                    <tr>
                        <th class="ps-4 text-center" style="width: 55px;">No</th>
                        <th>Dokumen Peraturan</th>
                        <th style="width: 170px;">Nomor &amp; Tahun</th>
                        <th class="text-center" style="width: 140px;">Status</th>
                        <th class="text-end pe-4" style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peraturans as $index => $item)
                        <tr>
                            <td class="ps-4 text-center">
                                <span class="row-index-circle">{{ $peraturans->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-start gap-2">
                                    <span class="badge-table-type">{{ $jenis->singkatan ?: 'PERDA' }}</span>
                                    <div class="flex-grow-1">
                                        <a href="{{ route('user.produk-hukum.detail', $item->id) }}" class="table-doc-title">
                                            {{ $item->judul }}
                                        </a>
                                        <div class="table-doc-submeta">
                                            <span class="meta-item"><i class="bi bi-building text-gold me-1"></i> {{ $item->teu_badan ?: 'Pemerintah Kabupaten Toba' }}</span>
                                            @if($item->tanggal_penetapan)
                                                <span class="meta-sep">&bull;</span>
                                                <span class="meta-item"><i class="bi bi-calendar-check text-muted me-1"></i> Penetapan: {{ $item->tanggal_penetapan->translatedFormat('d M Y') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="table-nomor-box">
                                    <span class="nomor-line">No. {{ $item->nomor_peraturan ?? '-' }}</span>
                                    <span class="tahun-line">Tahun {{ $item->tahun ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if(($item->status ?? 'BERLAKU') === 'BERLAKU')
                                    <span class="badge-status-pill status-active">
                                        <i class="bi bi-check-circle-fill"></i> Berlaku
                                    </span>
                                @else
                                    <span class="badge-status-pill status-inactive">
                                        <i class="bi bi-x-circle-fill"></i> {{ $item->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <a href="{{ route('user.produk-hukum.detail', $item->id) }}" class="btn-action-pill" title="Lihat Rincian">
                                        <i class="bi bi-info-circle me-1"></i> Rincian
                                    </a>
                                    @if(!empty($item->file_dokumen))
                                        <button type="button" class="btn-action-icon btn-action-preview" title="Pratinjau PDF Cepat"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#pdfPreviewModal" 
                                            data-pdf-url="{{ route('user.produk-hukum.preview', $item->id) }}" 
                                            data-pdf-title="{{ $item->judul }}"
                                            data-pdf-download="{{ route('user.produk-hukum.download', $item->id) }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    @endif
                                    <a href="{{ route('user.produk-hukum.download', $item->id) }}" class="btn-action-icon btn-action-download" title="Unduh Berkas PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-4 d-block mb-2 text-secondary"></i>
                                <h6 class="fw-bold text-dark">Belum ada peraturan yang cocok untuk kriteria ini.</h6>
                                <p class="small text-muted mb-0">Coba atur ulang filter pencarian Anda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $peraturans->links() }}
    </div>
</div>
@endsection
