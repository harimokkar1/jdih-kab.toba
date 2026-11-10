@extends('layouts.app')

@section('title', 'Katalog Produk Hukum - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     CURVED DARK NAVY BANNER
     ============================================================ -->
<div class="inner-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Produk Hukum</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">Produk Hukum Kabupaten Toba</h1>
                <p class="text-white-50 small mb-0">Daftar lengkap klasifikasi regulasi resmi dan dokumentasi peraturan perundang-undangan daerah</p>
            </div>
            <div>
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold fs-6 shadow-sm">
                    <i class="bi bi-file-earmark-text me-1"></i> {{ number_format($peraturans->total(), 0, ',', '.') }} Dokumen Ditemukan
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         REKAPITULASI KLASIFIKASI REGULASI (INTERACTIVE SUMMARY CARDS)
         ============================================================ -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold text-dark mb-0">
                <i class="bi bi-grid-fill text-primary me-2"></i> Rekapitulasi Jenis Produk Hukum
            </h6>
            <span class="text-muted small">
                Total Koleksi: <strong>{{ number_format($jenisPeraturans->sum('peraturans_count'), 0, ',', '.') }}</strong> Naskah
            </span>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
            @forelse($jenisPeraturans as $item)
                @php
                    $slug = Str::slug($item->nama);
                    $iconClass = 'bi-folder2-open';
                    if (str_contains($slug, 'perda') || str_contains($slug, 'daerah')) {
                        $iconClass = 'bi-building-fill-check text-primary';
                    } elseif (str_contains($slug, 'perbup') || str_contains($slug, 'peraturan-bupati')) {
                        $iconClass = 'bi-award-fill text-indigo';
                    } elseif (str_contains($slug, 'kepbup') || str_contains($slug, 'keputusan')) {
                        $iconClass = 'bi-file-earmark-check-fill text-warning';
                    } elseif (str_contains($slug, 'inbup') || str_contains($slug, 'instruksi')) {
                        $iconClass = 'bi-lightning-charge-fill text-success';
                    } else {
                        $iconClass = 'bi-envelope-paper-fill text-secondary';
                    }
                    $isActive = request('jenis_id') == $item->id;
                @endphp
                <div class="col">
                    <a href="{{ route('user.produk-hukum.global', array_merge(request()->except('page'), ['jenis_id' => $isActive ? null : $item->id])) }}" 
                       class="rekap-summary-pill {{ $isActive ? 'active' : '' }}"
                       title="{{ $item->nama }}">
                        <div class="rekap-pill-icon">
                            <i class="bi {{ $iconClass }}"></i>
                        </div>
                        <div class="rekap-pill-info">
                            <div class="rekap-pill-title">{{ $item->singkatan ?: $item->nama }}</div>
                            <div class="rekap-pill-count">
                                <strong>{{ number_format($item->peraturans_count, 0, ',', '.') }}</strong> Regulasi
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-2">
                    Belum ada data klasifikasi produk hukum.
                </div>
            @endforelse
        </div>
    </div>

    <!-- ============================================================
         FILTER BAR PENCARIAN TERPADU
         ============================================================ -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
        <form action="{{ route('user.produk-hukum.global') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label small fw-bold text-muted">Kata Kunci Judul / Nomor</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Ketik kata kunci atau nomor..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small fw-bold text-muted">Jenis Peraturan</label>
                    <select name="jenis_id" class="form-select">
                        <option value="">Semua Jenis Regulasi</option>
                        @foreach($jenisPeraturans as $jp)
                            <option value="{{ $jp->id }}" {{ request('jenis_id') == $jp->id ? 'selected' : '' }}>
                                {{ $jp->nama }} ({{ $jp->singkatan ?: '-' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="form-label small fw-bold text-muted">Tahun Terbit</label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="form-label small fw-bold text-muted">Status Hukum</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                        <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                    </select>
                </div>
                <div class="col-lg-1 col-md-4 col-12 d-grid">
                    <button type="submit" class="btn btn-dark rounded-pill fw-bold" style="background-color: var(--navy-primary); border-color: var(--navy-primary);" title="Terapkan Filter">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                </div>
            </div>

            @if(request()->hasAny(['search', 'jenis_id', 'tahun', 'status']))
                <div class="mt-3 pt-2 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="small text-muted"><i class="bi bi-funnel me-1"></i> Filter Aktif:</span>
                        @if(request('search'))
                            <span class="badge bg-light text-dark border">Kata Kunci: "{{ request('search') }}"</span>
                        @endif
                        @if(request('jenis_id'))
                            @php $activeJenis = $jenisPeraturans->firstWhere('id', request('jenis_id')); @endphp
                            <span class="badge bg-light text-dark border">{{ $activeJenis->nama ?? 'Jenis' }}</span>
                        @endif
                        @if(request('tahun'))
                            <span class="badge bg-light text-dark border">Tahun {{ request('tahun') }}</span>
                        @endif
                        @if(request('status'))
                            <span class="badge bg-light text-dark border">Status: {{ request('status') }}</span>
                        @endif
                    </div>
                    <a href="{{ route('user.produk-hukum.global') }}" class="btn btn-sm btn-outline-danger rounded-pill py-0 px-3 small">
                        <i class="bi bi-x-circle me-1"></i> Reset Semua Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- ============================================================
         DAFTAR DOKUMEN PRODUK HUKUM
         ============================================================ -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0 text-dark">
            Koleksi Dokumen Regulasi
            <span class="badge bg-light text-dark border ms-2 small fw-normal">{{ number_format($peraturans->total(), 0, ',', '.') }} Naskah</span>
        </h5>
        <small class="text-muted">Halaman {{ $peraturans->currentPage() }} dari {{ $peraturans->lastPage() }}</small>
    </div>

    <div class="d-flex flex-column gap-3">
        @forelse($peraturans as $p)
            <div class="modern-doc-card">
                <!-- Card Top: Badges & Tanggal -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge-doc-type">{{ $p->jenisPeraturan->singkatan ?? 'REGULASI' }}</span>
                        @if(($p->status ?? 'BERLAKU') !== 'BERLAKU')
                            <span class="badge-status-inactive">
                                <i class="bi bi-x-circle me-1"></i> {{ $p->status }}
                            </span>
                        @endif
                    </div>
                    @if($p->tanggal_penetapan)
                        <span class="text-muted small">
                            <i class="bi bi-calendar-check me-1"></i> Ditetapkan: {{ $p->tanggal_penetapan->translatedFormat('d F Y') }}
                        </span>
                    @endif
                </div>

                <!-- Title -->
                <h5 class="doc-title mb-2">
                    <a href="{{ route('user.produk-hukum.detail', $p->id) }}">
                        {{ strtoupper($p->judul) }}
                    </a>
                </h5>

                <!-- Meta Chips -->
                <div class="doc-meta-chips mb-2">
                    <span class="doc-meta-chip">
                        <i class="bi bi-file-earmark-text text-primary"></i>
                        <span>{{ $p->jenisPeraturan->nama ?? 'Peraturan' }} <strong>Nomor {{ $p->nomor_peraturan ?: '-' }}</strong></span>
                    </span>
                    <span class="doc-meta-chip">
                        <i class="bi bi-calendar3 text-warning"></i>
                        <span>Tahun: <strong>{{ $p->tahun ?: '-' }}</strong></span>
                    </span>
                    <span class="doc-meta-chip">
                        <i class="bi bi-building text-secondary"></i>
                        <span>Pemrakarsa: <strong>{{ $p->teu_badan ?: 'Pemerintah Kabupaten Toba' }}</strong></span>
                    </span>
                </div>

                <!-- Snippet -->
                <p class="doc-snippet-text">
                    {{ Str::limit(strip_tags($p->abstrak ?? $p->subjek ?? ''), 220) ?: 'Dokumen resmi peraturan perundang-undangan Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba.' }}
                </p>

                <!-- Footer: Stats + Buttons -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                    <div class="d-flex align-items-center gap-3 text-muted small">
                        <span title="Dilihat"><i class="bi bi-eye-fill me-1 text-primary"></i> {{ number_format($p->view_count ?? 0, 0, ',', '.') }}x dilihat</span>
                        <span title="Diunduh"><i class="bi bi-download me-1 text-success"></i> {{ number_format($p->download_count ?? 0, 0, ',', '.') }}x diunduh</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('user.produk-hukum.detail', $p->id) }}" class="btn-doc-detail">
                            <i class="bi bi-info-circle me-1"></i> Rincian
                        </a>
                        @if(!empty($p->file_dokumen))
                            <button type="button" class="btn-doc-preview" 
                                data-bs-toggle="modal" 
                                data-bs-target="#pdfPreviewModal" 
                                data-pdf-url="{{ route('user.produk-hukum.preview', $p->id) }}" 
                                data-pdf-title="{{ $p->judul }}"
                                data-pdf-download="{{ route('user.produk-hukum.download', $p->id) }}">
                                <i class="bi bi-file-earmark-pdf text-danger"></i> Pratinjau
                            </button>
                        @endif
                        <a href="{{ route('user.produk-hukum.download', $p->id) }}" class="btn-doc-download">
                            <i class="bi bi-download"></i> Unduh PDF
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 bg-white rounded-3 border text-muted">
                <i class="bi bi-folder-x display-4 mb-3 d-block text-secondary"></i>
                <h6 class="fw-bold text-dark">Tidak ada dokumen yang cocok dengan kriteria pencarian</h6>
                <p class="small text-muted mb-3">Silakan sesuaikan kata kunci atau atur ulang filter pencarian.</p>
                <a href="{{ route('user.produk-hukum.global') }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Pencarian
                </a>
            </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $peraturans->links() }}
    </div>
</div>
@endsection
