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
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">{{ $jenis->nama }}</h1>
            <p class="text-white-50 small mb-0">{{ $jenis->deskripsi ?: 'Kumpulan dokumentasi naskah resmi ' . $jenis->nama . ' Kabupaten Toba' }}</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- FILTER EXECUTIVE CONSOLE -->
    <div class="filter-executive-card">
        <form action="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-lg-5 col-md-12">
                    <label class="filter-field-label">Kata Kunci / Judul / Nomor</label>
                    <input type="text" name="search" class="form-control filter-input" placeholder="Ketik nomor, judul, atau kata kunci..." value="{{ request('search') }}">
                </div>
                @php
                    $activeTahun = request('tahun');
                    $tahunBtnText = $activeTahun ? 'Tahun ' . $activeTahun : 'Semua Tahun';
                @endphp
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="filter-field-label">Tahun</label>
                    <div class="modern-select-dropdown dropdown">
                        <input type="hidden" name="tahun" value="{{ $activeTahun }}">
                        <button type="button" 
                                class="modern-select-btn dropdown-toggle" 
                                id="dropdownListTahun" 
                                data-bs-toggle="dropdown" 
                                data-bs-offset="0,8"
                                data-bs-auto-close="true"
                                aria-expanded="false">
                            <span class="modern-select-label text-truncate">{{ $tahunBtnText }}</span>
                            <i class="bi bi-chevron-down modern-select-chevron"></i>
                        </button>
                        <ul class="dropdown-menu modern-select-menu shadow-lg w-100" aria-labelledby="dropdownListTahun" style="min-width: 170px; max-height: 280px; overflow-y: auto;">
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
                <div class="col-lg-2 col-md-4 col-6">
                    <label class="filter-field-label">Status</label>
                    <div class="modern-select-dropdown dropdown">
                        <input type="hidden" name="status" value="{{ $activeStatus }}">
                        <button type="button" 
                                class="modern-select-btn dropdown-toggle" 
                                id="dropdownListStatus" 
                                data-bs-toggle="dropdown" 
                                data-bs-offset="0,8"
                                data-bs-auto-close="true"
                                aria-expanded="false">
                            <span class="modern-select-label text-truncate">{{ $statusLabel }}</span>
                            <i class="bi bi-chevron-down modern-select-chevron"></i>
                        </button>
                        <ul class="dropdown-menu modern-select-menu shadow-lg w-100" aria-labelledby="dropdownListStatus" style="min-width: 170px;">
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
                <div class="col-lg-3 col-md-4 col-12 d-flex gap-2 justify-content-lg-end">
                    <button type="submit" class="btn btn-filter-submit w-100">
                        <i class="bi bi-funnel-fill me-1"></i> Terapkan Filter
                    </button>
                </div>
            </div>

            @if(request()->hasAny(['search', 'tahun', 'status']))
                <div class="active-filters-bar">
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <span class="active-filters-label">
                            <i class="bi bi-funnel text-gold me-1"></i> Filter Aktif:
                        </span>
                        @if(request('search'))
                            <span class="active-filter-chip">
                                <span class="chip-text"><i class="bi bi-search me-1 text-muted"></i> "{{ Str::limit(request('search'), 25) }}"</span>
                                <a href="{{ route('user.produk-hukum.jenis', array_merge(['slug' => $jenis->slug], request()->except(['search', 'page']))) }}" class="chip-remove" title="Hapus filter kata kunci" aria-label="Hapus kata kunci">
                                    <i class="bi bi-x"></i>
                                </a>
                            </span>
                        @endif
                        @if(request('tahun'))
                            <span class="active-filter-chip">
                                <span class="chip-text"><i class="bi bi-calendar3 me-1 text-muted"></i> Tahun {{ request('tahun') }}</span>
                                <a href="{{ route('user.produk-hukum.jenis', array_merge(['slug' => $jenis->slug], request()->except(['tahun', 'page']))) }}" class="chip-remove" title="Hapus filter tahun" aria-label="Hapus filter tahun">
                                    <i class="bi bi-x"></i>
                                </a>
                            </span>
                        @endif
                        @if(request('status'))
                            <span class="active-filter-chip">
                                <span class="chip-text"><i class="bi bi-shield-check me-1 text-muted"></i> Status: {{ request('status') === 'BERLAKU' ? 'Berlaku' : 'Tidak Berlaku' }}</span>
                                <a href="{{ route('user.produk-hukum.jenis', array_merge(['slug' => $jenis->slug], request()->except(['status', 'page']))) }}" class="chip-remove" title="Hapus filter status" aria-label="Hapus filter status">
                                    <i class="bi bi-x"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                    <a href="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" class="active-filter-reset-btn" title="Hapus semua filter">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filter
                    </a>
                </div>
            @endif
        </form>
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
                        <th class="text-center" style="width: 130px;">Status</th>
                        <th class="text-end pe-4" style="width: 250px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peraturans as $index => $item)
                        @php
                            $slug = Str::slug($jenis->nama ?? '');
                            $themeClass = 'theme-default';

                            if (str_contains($slug, 'perda') || str_contains($slug, 'daerah')) {
                                $themeClass = 'theme-perda';
                            } elseif (str_contains($slug, 'perbup') || str_contains($slug, 'peraturan-bupati')) {
                                $themeClass = 'theme-perbup';
                            } elseif (str_contains($slug, 'kepbup') || str_contains($slug, 'keputusan')) {
                                $themeClass = 'theme-kepbup';
                            } elseif (str_contains($slug, 'inbup') || str_contains($slug, 'instruksi')) {
                                $themeClass = 'theme-inbup';
                            } elseif (str_contains($slug, 'edaran') || str_contains($slug, 'surat')) {
                                $themeClass = 'theme-edaran';
                            }
                        @endphp
                        <tr>
                            <td class="ps-4 text-center">
                                <span class="row-num">{{ $peraturans->firstItem() + $index }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                    <span class="badge-cat-pill {{ $themeClass }}">
                                        {{ $jenis->singkatan ?: ($jenis->nama ?? 'REGULASI') }}
                                    </span>
                                    <a href="{{ route('user.produk-hukum.detail', $item->id) }}" class="table-doc-title">
                                        {{ strtoupper($item->judul) }}
                                    </a>
                                </div>
                                <div class="table-doc-submeta">
                                    <span>{{ $item->teu_badan ?: 'Pemerintah Kabupaten Toba' }}</span>
                                    @if($item->tanggal_penetapan)
                                        <span class="meta-sep">&bull;</span>
                                        <span>Penetapan: {{ $item->tanggal_penetapan->translatedFormat('d M Y') }}</span>
                                    @endif
                                </div>
                                @if(!empty($item->abstrak) || !empty($item->subjek))
                                    <p class="table-doc-snippet mb-0 mt-1">
                                        {{ Str::limit(strip_tags($item->abstrak ?: $item->subjek), 140) }}
                                    </p>
                                @endif
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
                                        Berlaku
                                    </span>
                                @else
                                    <span class="badge-status-pill status-inactive">
                                        {{ $item->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end align-items-center gap-2">
                                    <a href="{{ route('user.produk-hukum.detail', $item->id) }}" class="btn-table-action btn-table-detail" title="Lihat Rincian Dokumen">
                                        <i class="bi bi-info-circle text-muted"></i> Rincian
                                    </a>
                                    @if(!empty($item->file_dokumen))
                                        <button type="button" class="btn-table-action btn-table-preview" title="Pratinjau PDF Cepat"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#pdfPreviewModal" 
                                            data-pdf-url="{{ route('user.produk-hukum.preview', $item->id) }}" 
                                            data-pdf-title="{{ $item->judul }}"
                                            data-pdf-download="{{ route('user.produk-hukum.download', $item->id) }}">
                                            <i class="bi bi-eye text-muted"></i> Pratinjau
                                        </button>
                                    @endif
                                    <a href="{{ route('user.produk-hukum.download', $item->id) }}" class="btn-table-action btn-table-download" title="Unduh Berkas PDF">
                                        <i class="bi bi-download text-white-50"></i> Unduh PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x display-4 d-block mb-3 text-secondary"></i>
                                <h6 class="fw-bold text-dark">Tidak ada peraturan yang cocok untuk kriteria ini.</h6>
                                <p class="small text-muted mb-3">Silakan sesuaikan kata kunci atau atur ulang filter pencarian.</p>
                                <a href="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-4">
                                    Reset Pencarian
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $peraturans->links() }}
    </div>
</div>
@endsection
