@extends('layouts.app')

@section('title', 'Katalog Regulasi Produk Hukum - JDIH Kabupaten Toba')

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
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">Katalog Regulasi Produk Hukum</h1>
            <p class="text-white-50 small mb-0">Daftar lengkap dokumentasi dan arsip peraturan perundang-undangan Pemerintah Kabupaten Toba</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         UNIFIED EXECUTIVE CONSOLE (1 POOL BG PUTIH)
         Menggabungkan Kategori Summary Card & Filter Bar Terpadu
         ============================================================ -->
    <div class="unified-filter-console">
        <!-- 1. Kategori Summary Pills / Cards (PERDA, PERBUP, KEPBUP, INBUP, SE) -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-2.5">
            @forelse($jenisPeraturans as $item)
                @php
                    $slug = Str::slug($item->nama);
                    $iconClass = 'bi-folder2-open';
                    $themeClass = 'theme-default';

                    if (str_contains($slug, 'perda') || str_contains($slug, 'daerah')) {
                        $iconClass = 'bi-bank2';
                        $themeClass = 'theme-perda';
                    } elseif (str_contains($slug, 'perbup') || str_contains($slug, 'peraturan-bupati')) {
                        $iconClass = 'bi-journal-bookmark-fill';
                        $themeClass = 'theme-perbup';
                    } elseif (str_contains($slug, 'kepbup') || str_contains($slug, 'keputusan')) {
                        $iconClass = 'bi-file-earmark-check-fill';
                        $themeClass = 'theme-kepbup';
                    } elseif (str_contains($slug, 'inbup') || str_contains($slug, 'instruksi')) {
                        $iconClass = 'bi-megaphone-fill';
                        $themeClass = 'theme-inbup';
                    } elseif (str_contains($slug, 'edaran') || str_contains($slug, 'surat')) {
                        $iconClass = 'bi-file-earmark-text-fill';
                        $themeClass = 'theme-edaran';
                    }
                    $isActive = (string)request('jenis_id') === (string)$item->id;
                @endphp
                <div class="col">
                    <a href="{{ route('user.produk-hukum.global', array_merge(request()->except('page'), ['jenis_id' => $isActive ? null : $item->id])) }}" 
                       class="rekap-summary-pill {{ $themeClass }} {{ $isActive ? 'active' : '' }}"
                       title="{{ $item->nama }}">
                        <div class="rekap-pill-icon">
                            <i class="bi {{ $iconClass }}"></i>
                        </div>
                        <div class="rekap-pill-info">
                            <span class="rekap-pill-title">{{ $item->singkatan ?: $item->nama }}</span>
                            <span class="rekap-pill-sub" title="{{ $item->nama }}">{{ $item->nama }}</span>
                        </div>
                        <div class="rekap-pill-counter {{ $item->peraturans_count > 0 ? 'has-data' : 'is-zero' }}">
                            <span class="rekap-counter-val">{{ number_format($item->peraturans_count, 0, ',', '.') }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-2">
                    Belum ada data klasifikasi produk hukum.
                </div>
            @endforelse
        </div>

        <!-- Pemisah Halus Antara Kategori dan Input Filter -->
        <div class="unified-filter-divider"></div>

        <!-- 2. Form Filter Bar Pencarian Multi-Parameter -->
        <form action="{{ route('user.produk-hukum.global') }}" method="GET">
            <div class="row g-3 align-items-end">
                <!-- Kata Kunci Judul / Nomor -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label small fw-bold text-muted mb-1.5">Kata Kunci Judul / Nomor</label>
                    <div class="input-group modern-filter-input-group">
                        <span class="input-group-text"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Ketik nomor, judul, atau kata kunci..." value="{{ request('search') }}">
                    </div>
                </div>

                @php
                    $activeJenisId = request('jenis_id');
                    $activeJenisObj = $jenisPeraturans->firstWhere('id', $activeJenisId);
                    $jenisBtnText = $activeJenisObj 
                        ? ($activeJenisObj->singkatan ? $activeJenisObj->nama . ' (' . $activeJenisObj->singkatan . ')' : $activeJenisObj->nama) 
                        : 'Semua Jenis Regulasi';
                @endphp
                <!-- Jenis Peraturan -->
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small fw-bold text-muted mb-1.5">Jenis Peraturan</label>
                    <div class="modern-select-dropdown dropdown">
                        <input type="hidden" name="jenis_id" value="{{ $activeJenisId }}">
                        <button type="button" 
                                class="modern-select-btn dropdown-toggle" 
                                id="dropdownJenisPeraturan" 
                                data-bs-toggle="dropdown" 
                                data-bs-offset="0,8"
                                data-bs-auto-close="true"
                                aria-expanded="false">
                            <span class="modern-select-label text-truncate">{{ $jenisBtnText }}</span>
                            <i class="bi bi-chevron-down modern-select-chevron"></i>
                        </button>
                        <ul class="dropdown-menu modern-select-menu shadow-lg w-100" aria-labelledby="dropdownJenisPeraturan" style="min-width: 250px;">
                            <li>
                                <button type="button" 
                                        class="dropdown-item modern-select-item {{ empty($activeJenisId) ? 'active' : '' }}"
                                        data-value=""
                                        data-label="Semua Jenis Regulasi">
                                    <span class="text-truncate">Semua Jenis Regulasi</span>
                                </button>
                            </li>
                            @foreach($jenisPeraturans as $jp)
                                @php
                                    $isJpActive = ((string)$activeJenisId === (string)$jp->id);
                                    $jpDisplayLabel = $jp->nama . ($jp->singkatan ? ' (' . $jp->singkatan . ')' : '');
                                @endphp
                                <li>
                                    <button type="button" 
                                            class="dropdown-item modern-select-item {{ $isJpActive ? 'active' : '' }}"
                                            data-value="{{ $jp->id }}"
                                            data-label="{{ $jpDisplayLabel }}">
                                        <span class="text-truncate">{{ $jp->nama }}</span>
                                        @if($jp->singkatan)
                                            <span class="badge bg-light text-secondary border px-1.5 py-0.5 ms-auto" style="font-size: 10px; font-weight: 700;">{{ $jp->singkatan }}</span>
                                        @endif
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @php
                    $activeTahun = request('tahun');
                    $tahunBtnText = $activeTahun ? 'Tahun ' . $activeTahun : 'Semua Tahun';
                @endphp
                <!-- Tahun Terbit -->
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="form-label small fw-bold text-muted mb-1.5">Tahun Terbit</label>
                    <div class="modern-select-dropdown dropdown">
                        <input type="hidden" name="tahun" value="{{ $activeTahun }}">
                        <button type="button" 
                                class="modern-select-btn dropdown-toggle" 
                                id="dropdownTahunTerbit" 
                                data-bs-toggle="dropdown" 
                                data-bs-offset="0,8"
                                data-bs-auto-close="true"
                                aria-expanded="false">
                            <span class="modern-select-label text-truncate">{{ $tahunBtnText }}</span>
                            <i class="bi bi-chevron-down modern-select-chevron"></i>
                        </button>
                        <ul class="dropdown-menu modern-select-menu shadow-lg w-100" aria-labelledby="dropdownTahunTerbit" style="min-width: 170px; max-height: 280px; overflow-y: auto;">
                            <li>
                                <button type="button" 
                                        class="dropdown-item modern-select-item {{ empty($activeTahun) ? 'active' : '' }}"
                                        data-value=""
                                        data-label="Semua Tahun">
                                    <span>Semua Tahun</span>
                                </button>
                            </li>
                            @foreach($tahunList as $th)
                                @php $isThActive = ((string)$activeTahun === (string)$th); @endphp
                                <li>
                                    <button type="button" 
                                            class="dropdown-item modern-select-item {{ $isThActive ? 'active' : '' }}"
                                            data-value="{{ $th }}"
                                            data-label="Tahun {{ $th }}">
                                        <span>Tahun {{ $th }}</span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @php
                    $activeStatus = request('status');
                    $statusLabel = empty($activeStatus) ? 'Semua Status' : ($activeStatus === 'BERLAKU' ? 'Berlaku' : 'Tidak Berlaku');
                @endphp
                <!-- Status Hukum -->
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="form-label small fw-bold text-muted mb-1.5">Status Hukum</label>
                    <div class="modern-select-dropdown dropdown">
                        <input type="hidden" name="status" value="{{ $activeStatus }}">
                        <button type="button" 
                                class="modern-select-btn dropdown-toggle" 
                                id="dropdownStatusHukum" 
                                data-bs-toggle="dropdown" 
                                data-bs-offset="0,8"
                                data-bs-auto-close="true"
                                aria-expanded="false">
                            <span class="modern-select-label text-truncate">{{ $statusLabel }}</span>
                            <i class="bi bi-chevron-down modern-select-chevron"></i>
                        </button>
                        <ul class="dropdown-menu modern-select-menu shadow-lg w-100" aria-labelledby="dropdownStatusHukum" style="min-width: 170px;">
                            <li>
                                <button type="button" 
                                        class="dropdown-item modern-select-item {{ empty($activeStatus) ? 'active' : '' }}"
                                        data-value=""
                                        data-label="Semua Status">
                                    <span>Semua Status</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" 
                                        class="dropdown-item modern-select-item {{ $activeStatus === 'BERLAKU' ? 'active' : '' }}"
                                        data-value="BERLAKU"
                                        data-label="Berlaku">
                                    <span>Berlaku</span>
                                </button>
                            </li>
                            <li>
                                <button type="button" 
                                        class="dropdown-item modern-select-item {{ $activeStatus === 'TIDAK BERLAKU' ? 'active' : '' }}"
                                        data-value="TIDAK BERLAKU"
                                        data-label="Tidak Berlaku">
                                    <span>Tidak Berlaku</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tombol Filter -->
                <div class="col-lg-1 col-md-4 col-12 d-grid">
                    <button type="submit" class="btn btn-filter-submit-modern" title="Terapkan Filter">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Active Filter Chips (Jika ada filter aktif) -->
            @if(request()->hasAny(['search', 'jenis_id', 'tahun', 'status']))
                <div class="active-filters-bar mt-3 pt-3">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <span class="active-filters-label">
                            <i class="bi bi-funnel text-gold me-1"></i> Filter Aktif:
                        </span>
                        @if(request('search'))
                            <span class="active-filter-chip">
                                <span class="chip-text"><i class="bi bi-search me-1 text-muted"></i> "{{ Str::limit(request('search'), 25) }}"</span>
                                <a href="{{ route('user.produk-hukum.global', request()->except(['search', 'page'])) }}" class="chip-remove" title="Hapus pencarian">
                                    <i class="bi bi-x"></i>
                                </a>
                            </span>
                        @endif
                        @if(request('jenis_id'))
                            @php $activeJenis = $jenisPeraturans->firstWhere('id', request('jenis_id')); @endphp
                            @if($activeJenis)
                                <span class="active-filter-chip">
                                    <span class="chip-text"><i class="bi bi-journal-text me-1 text-muted"></i> {{ $activeJenis->singkatan ? $activeJenis->nama . ' (' . $activeJenis->singkatan . ')' : $activeJenis->nama }}</span>
                                    <a href="{{ route('user.produk-hukum.global', request()->except(['jenis_id', 'page'])) }}" class="chip-remove" title="Hapus filter jenis peraturan">
                                        <i class="bi bi-x"></i>
                                    </a>
                                </span>
                            @endif
                        @endif
                        @if(request('tahun'))
                            <span class="active-filter-chip">
                                <span class="chip-text"><i class="bi bi-calendar3 me-1 text-muted"></i> Tahun {{ request('tahun') }}</span>
                                <a href="{{ route('user.produk-hukum.global', request()->except(['tahun', 'page'])) }}" class="chip-remove" title="Hapus filter tahun">
                                    <i class="bi bi-x"></i>
                                </a>
                            </span>
                        @endif
                        @if(request('status'))
                            <span class="active-filter-chip">
                                <span class="chip-text"><i class="bi bi-shield-check me-1 text-muted"></i> Status: {{ request('status') === 'BERLAKU' ? 'Berlaku' : 'Tidak Berlaku' }}</span>
                                <a href="{{ route('user.produk-hukum.global', request()->except(['status', 'page'])) }}" class="chip-remove" title="Hapus filter status">
                                    <i class="bi bi-x"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('user.produk-hukum.global') }}" class="active-filter-reset-btn" title="Hapus semua filter">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- ============================================================
         DAFTAR DOKUMEN PRODUK HUKUM (PREMIUM SIGNATURE CARDS)
         ============================================================ -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <div>
            <h4 class="section-title mb-0 fs-5">Koleksi <span class="text-gold">Dokumen Regulasi</span></h4>
            <span class="text-muted small">Menampilkan <strong>{{ number_format($peraturans->total(), 0, ',', '.') }}</strong> dokumen peraturan resmi Pemerintah Kabupaten Toba</span>
        </div>
    </div>

    <div class="d-flex flex-column gap-3">
        @forelse($peraturans as $p)
            @php
                $jpSlug = Str::slug($p->jenisPeraturan->nama ?? '');
                $themeClass = 'theme-default';

                if (str_contains($jpSlug, 'perda') || str_contains($jpSlug, 'daerah')) {
                    $themeClass = 'theme-perda';
                } elseif (str_contains($jpSlug, 'perbup') || str_contains($jpSlug, 'peraturan-bupati')) {
                    $themeClass = 'theme-perbup';
                } elseif (str_contains($jpSlug, 'kepbup') || str_contains($jpSlug, 'keputusan')) {
                    $themeClass = 'theme-kepbup';
                } elseif (str_contains($jpSlug, 'inbup') || str_contains($jpSlug, 'instruksi')) {
                    $themeClass = 'theme-inbup';
                } elseif (str_contains($jpSlug, 'edaran') || str_contains($jpSlug, 'surat')) {
                    $themeClass = 'theme-edaran';
                }
            @endphp
            <div class="modern-doc-card {{ $themeClass }}">
                <!-- Card Top: Badges & Tanggal -->
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge-doc-type {{ $themeClass }}">{{ $p->jenisPeraturan->singkatan ?? 'REGULASI' }}</span>
                        @if(($p->status ?? 'BERLAKU') === 'BERLAKU')
                            <span class="badge-status-active">
                                Berlaku
                            </span>
                        @else
                            <span class="badge-status-inactive">
                                {{ $p->status }}
                            </span>
                        @endif
                    </div>
                    @if($p->tanggal_penetapan)
                        <span class="doc-date-chip text-muted small">
                            <i class="bi bi-calendar3 me-1.5 text-muted"></i> Penetapan: {{ $p->tanggal_penetapan->translatedFormat('d F Y') }}
                        </span>
                    @endif
                </div>

                <!-- Document Title -->
                <h5 class="doc-title mb-2">
                    <a href="{{ route('user.produk-hukum.detail', $p->id) }}">
                        {{ strtoupper($p->judul) }}
                    </a>
                </h5>

                <!-- Meta Details Chips -->
                <div class="doc-meta-chips mb-2.5">
                    <span class="doc-meta-chip">
                        <i class="bi bi-file-earmark-text text-muted me-1"></i>
                        <span>{{ $p->jenisPeraturan->nama ?? 'Peraturan' }} <strong>Nomor {{ $p->nomor_peraturan ?: '-' }}</strong></span>
                    </span>
                    <span class="doc-meta-chip">
                        <i class="bi bi-calendar-event text-muted me-1"></i>
                        <span>Tahun: <strong>{{ $p->tahun ?: '-' }}</strong></span>
                    </span>
                    <span class="doc-meta-chip">
                        <i class="bi bi-building text-muted me-1"></i>
                        <span>Pemrakarsa: <strong>{{ $p->teu_badan ?: 'Pemerintah Kabupaten Toba' }}</strong></span>
                    </span>
                </div>

                <!-- Abstract Snippet -->
                <p class="doc-snippet-text mb-3">
                    {{ Str::limit(strip_tags($p->abstrak ?? $p->subjek ?? ''), 220) ?: 'Dokumen resmi peraturan perundang-undangan Bagian Hukum Sekretariat Daerah Pemerintah Kabupaten Toba.' }}
                </p>

                <!-- Footer: Stats + Buttons (Executive Civic Buttons) -->
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                    <div class="d-flex align-items-center gap-3 text-muted small">
                        <span title="Jumlah Kali Dilihat"><i class="bi bi-eye me-1 text-muted"></i> {{ number_format($p->view_count ?? 0, 0, ',', '.') }}x dilihat</span>
                        <span title="Jumlah Unduhan"><i class="bi bi-download me-1 text-muted"></i> {{ number_format($p->download_count ?? 0, 0, ',', '.') }}x diunduh</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('user.produk-hukum.detail', $p->id) }}" class="btn-doc-detail">
                            <i class="bi bi-info-circle text-muted"></i> Rincian
                        </a>
                        @if(!empty($p->file_dokumen))
                            <button type="button" class="btn-doc-preview" 
                                data-bs-toggle="modal" 
                                data-bs-target="#pdfPreviewModal" 
                                data-pdf-url="{{ route('user.produk-hukum.preview', $p->id) }}" 
                                data-pdf-title="{{ $p->judul }}"
                                data-pdf-download="{{ route('user.produk-hukum.download', $p->id) }}">
                                <i class="bi bi-eye text-muted"></i> Pratinjau
                            </button>
                        @endif
                        <a href="{{ route('user.produk-hukum.download', $p->id) }}" class="btn-doc-download">
                            <i class="bi bi-download text-white-50"></i> Unduh PDF
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
    <div class="mt-4 d-flex justify-content-end">
        {{ $peraturans->links() }}
    </div>
</div>
@endsection
