@extends('layouts.app')

@section('title', 'Pengumuman Resmi - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     EXECUTIVE HEADER BANNER
     ============================================================ -->
<div class="page-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item text-white-50">Informasi</li>
                <li class="breadcrumb-item active">Pengumuman</li>
            </ol>
        </nav>
        <div>
            <h1 class="h3 fw-bold mb-1 text-white">
                Pengumuman &amp; Maklumat <span class="text-gold">Resmi</span>
            </h1>
            <p class="text-white-50 small mb-0">Daftar pemberitahuan penting, surat edaran, dan maklumat resmi Bagian Hukum Pemerintah Kabupaten Toba</p>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- ============================================================
         MAIN TWO-COLUMN LAYOUT
         ============================================================ -->
    <div class="row g-4">
        <!-- LEFT SIDEBAR: FILTER KATEGORI, TAHUN & DOKUMEN -->
        <div class="col-lg-3 col-md-4">
            <div class="filter-sidebar">
                <form action="{{ route('pengumuman.index') }}" method="GET" id="filterSidebarForm">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <!-- GROUP 1: KATEGORI PENGUMUMAN -->
                    <div class="filter-group mb-4">
                        <label class="filter-group-label">Kategori Pengumuman</label>
                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('pengumuman.index', array_merge(request()->except(['kategori', 'page']))) }}" class="filter-category-link {{ empty(request('kategori')) ? 'active' : '' }}">
                                <span>Semua Kategori</span>
                                <span class="filter-count-badge">{{ $totalAll }}</span>
                            </a>
                            <a href="{{ route('pengumuman.index', array_merge(request()->except('page'), ['kategori' => 'uji-publik'])) }}" class="filter-category-link {{ request('kategori') === 'uji-publik' ? 'active' : '' }}">
                                <span>Uji Publik &amp; Konsultasi</span>
                                <span class="filter-count-badge">{{ $countUjiPublik }}</span>
                            </a>
                            <a href="{{ route('pengumuman.index', array_merge(request()->except('page'), ['kategori' => 'jadwal-pelayanan'])) }}" class="filter-category-link {{ request('kategori') === 'jadwal-pelayanan' ? 'active' : '' }}">
                                <span>Jadwal &amp; Pelayanan</span>
                                <span class="filter-count-badge">{{ $countJadwal }}</span>
                            </a>
                            <a href="{{ route('pengumuman.index', array_merge(request()->except('page'), ['kategori' => 'maklumat-edaran'])) }}" class="filter-category-link {{ request('kategori') === 'maklumat-edaran' ? 'active' : '' }}">
                                <span>Maklumat &amp; Edaran</span>
                                <span class="filter-count-badge">{{ $countMaklumat }}</span>
                            </a>
                            <a href="{{ route('pengumuman.index', array_merge(request()->except('page'), ['kategori' => 'sosialisasi'])) }}" class="filter-category-link {{ request('kategori') === 'sosialisasi' ? 'active' : '' }}">
                                <span>Sosialisasi Hukum</span>
                                <span class="filter-count-badge">{{ $countSosialisasi }}</span>
                            </a>
                        </div>
                    </div>

                    <!-- GROUP 2: TAHUN PENERBITAN -->
                    <div class="filter-group mb-4">
                        <label class="filter-group-label">Tahun Penerbitan</label>
                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('pengumuman.index', array_merge(request()->except(['tahun', 'page']))) }}" class="filter-category-link {{ empty(request('tahun')) ? 'active' : '' }}">
                                <span>Semua Tahun</span>
                                <span class="filter-count-badge">{{ $totalAll }}</span>
                            </a>
                            @foreach($availableYears as $yr => $cnt)
                                <a href="{{ route('pengumuman.index', array_merge(request()->except('page'), ['tahun' => $yr])) }}" class="filter-category-link {{ request('tahun') == $yr ? 'active' : '' }}">
                                    <span>Tahun {{ $yr }}</span>
                                    <span class="filter-count-badge">{{ $cnt }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- GROUP 3: BERKAS LAMPIRAN -->
                    <div class="filter-group mb-0">
                        <label class="filter-group-label">Berkas Lampiran</label>
                        <div class="filter-checkbox-item">
                            <input class="form-check-input filter-checkbox-control" type="checkbox" name="pdf" value="1" id="filterPdfCheck" {{ request('pdf') === '1' ? 'checked' : '' }} onchange="document.getElementById('filterSidebarForm').submit()">
                            <label class="filter-checkbox-label" for="filterPdfCheck">
                                <span>Hanya dengan PDF</span>
                                <span class="filter-count-badge">{{ $countWithPdf }}</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT COLUMN: RESULTS LIST -->
        <div class="col-lg-9 col-md-8">
            <!-- ============================================================
                 SEARCH & FILTER CONSOLE (TEPAT DI ATAS GAMBAR 4)
                 ============================================================ -->
            <div class="berita-search-wrapper mb-3">
                <form action="{{ route('pengumuman.index') }}" method="GET" id="searchPengumumanForm">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    @if(request('tahun'))
                        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                    @endif
                    @if(request('pdf'))
                        <input type="hidden" name="pdf" value="{{ request('pdf') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <div class="berita-search-bar">
                        <i class="bi bi-search berita-search-icon"></i>
                        <input type="text" name="search" class="berita-search-input" 
                               placeholder="Cari judul atau kata kunci pengumuman..." 
                               value="{{ request('search') }}"
                               autocomplete="off">
                        @if(request('search'))
                            <a href="{{ route('pengumuman.index', request()->except(['search', 'page'])) }}" class="berita-search-clear" title="Hapus Kata Kunci">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        @endif
                        <button class="btn-berita-search" type="submit">
                            Cari
                        </button>
                    </div>
                </form>

                @if(request('search'))
                    <div class="mt-2 pt-1 d-flex align-items-center justify-content-between flex-wrap gap-2 px-1">
                        <span class="small text-muted" style="font-size: 0.8rem;">
                            Menampilkan hasil untuk kata kunci: <strong>"{{ request('search') }}"</strong>
                        </span>
                        <a href="{{ route('pengumuman.index', request()->except(['search', 'page'])) }}" class="small text-danger text-decoration-none fw-semibold">
                            Reset Kata Kunci
                        </a>
                    </div>
                @endif
            </div>

            <!-- RESULT META STRIP: COUNTER, ACTIVE TAGS & SORTING (GAMBAR 4) -->
            @php
                $catLabels = [
                    'uji-publik' => 'Uji Publik & Konsultasi',
                    'jadwal-pelayanan' => 'Jadwal & Pelayanan',
                    'maklumat-edaran' => 'Maklumat & Edaran',
                    'sosialisasi' => 'Sosialisasi Hukum',
                ];
                $sortMap = [
                    'terbaru' => 'Terbaru',
                    'terlama' => 'Terlama',
                    'judul_asc' => 'Judul A - Z',
                    'judul_desc' => 'Judul Z - A',
                ];
                $currSortLabel = $sortMap[request('sort', 'terbaru')] ?? 'Terbaru';
            @endphp
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="text-muted small">
                        Menampilkan <strong>{{ number_format($pengumumans->total(), 0, ',', '.') }}</strong> pengumuman
                    </span>
                    @if(request('kategori') && isset($catLabels[request('kategori')]))
                        <span class="badge bg-light text-dark border fw-normal small d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                            Kategori: <strong>{{ $catLabels[request('kategori')] }}</strong>
                            <a href="{{ route('pengumuman.index', request()->except(['kategori', 'page'])) }}" class="text-danger ms-1 text-decoration-none">&times;</a>
                        </span>
                    @endif
                    @if(request('tahun'))
                        <span class="badge bg-light text-dark border fw-normal small d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                            Tahun: <strong>{{ request('tahun') }}</strong>
                            <a href="{{ route('pengumuman.index', request()->except(['tahun', 'page'])) }}" class="text-danger ms-1 text-decoration-none">&times;</a>
                        </span>
                    @endif
                    @if(request('pdf') === '1')
                        <span class="badge bg-light text-dark border fw-normal small d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                            Hanya PDF
                            <a href="{{ route('pengumuman.index', request()->except(['pdf', 'page'])) }}" class="text-danger ms-1 text-decoration-none">&times;</a>
                        </span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted mb-0 fw-semibold d-none d-sm-inline">Urutkan:</label>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-white border dropdown-toggle fw-semibold text-dark shadow-xs" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 8px; font-size: 0.82rem; padding: 6px 14px; background: #fff;">
                            {{ $currSortLabel }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="border-radius: 10px;">
                            @foreach($sortMap as $sKey => $sLabel)
                                <li>
                                    <a class="dropdown-item small {{ request('sort', 'terbaru') === $sKey ? 'active' : '' }}" href="{{ route('pengumuman.index', array_merge(request()->all(), ['sort' => $sKey])) }}">
                                        {{ $sLabel }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ANNOUNCEMENT CARD LIST (SESUAI GAMBAR 2) -->
            <div class="d-flex flex-column gap-3">
                @forelse($pengumumans as $item)
                    <article class="announcement-gov-card">
                        <!-- TOP ROW: BADGES & DATE -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-0.5 rounded-pill fw-semibold" style="font-size: 0.74rem;">
                                    Siaran Resmi
                                </span>
                                @if($item->file_pdf)
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-0.5 rounded-pill fw-semibold" style="font-size: 0.74rem;">
                                        Lampiran PDF
                                    </span>
                                @endif
                            </div>
                            <span class="text-muted small" style="font-size: 0.8rem;">
                                {{ $item->tanggal_upload ? $item->tanggal_upload->translatedFormat('d F Y') : '-' }}
                            </span>
                        </div>

                        <!-- TITLE -->
                        <h4 class="announcement-gov-title">
                            <a href="{{ route('pengumuman.show', $item->id) }}" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </a>
                        </h4>

                        <!-- EXCERPT -->
                        <p class="announcement-gov-excerpt">
                            {{ Str::limit(html_entity_decode(strip_tags($item->isi)), 160) ?: 'Maklumat dan pemberitahuan resmi Sekretariat Daerah Pemerintah Kabupaten Toba.' }}
                        </p>

                        <!-- FOOTER ACTIONS -->
                        <div class="announcement-gov-footer">
                            <span class="text-muted small" style="font-size: 0.78rem;">
                                Bagian Hukum Setdakab Toba
                            </span>

                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('pengumuman.show', $item->id) }}" class="btn-gov-detail">
                                    Lihat Rincian
                                </a>

                                @if($item->file_pdf)
                                    <a href="{{ asset('uploads/pengumuman/' . $item->file_pdf) }}" target="_blank" class="btn-gov-download" title="Unduh Berkas PDF">
                                        <i class="bi bi-download"></i> Unduh PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="text-center py-5 bg-white rounded-4 border text-muted shadow-xs">
                        <i class="bi bi-megaphone display-4 text-secondary mb-3 d-block"></i>
                        <h5 class="fw-bold text-dark">Tidak ada pengumuman yang sesuai</h5>
                        <p class="small text-muted mb-3">Coba ubah kata kunci pencarian atau reset filter untuk melihat seluruh arsip pengumuman.</p>
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-4">
                            Reset Filter
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- PAGINATION (SESUAI GAMBAR 2: RATA KANAN & BAHASA INDONESIA) -->
            @if($pengumumans->hasPages())
                <div class="mt-4 d-flex justify-content-end">
                    {{ $pengumumans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
