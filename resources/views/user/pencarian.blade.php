@extends('layouts.app')

@section('title', 'Pencarian Produk Hukum - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     CURVED DARK NAVY HEADER (JDIHN.GO.ID EXACT STYLE)
     ============================================================ -->
<div class="inner-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Pencarian Dokumen</li>
            </ol>
        </nav>
        <div class="text-center mb-3">
            <h1 class="h3 fw-bold text-white mb-1">
                Pencarian Produk Hukum
            </h1>
            <p class="text-white-50 small mb-0">Temukan peraturan perundang-undangan Pemerintah Kabupaten Toba secara cepat dan akurat</p>
        </div>

        <!-- Search Bar Pill -->
        <div class="hero-smart-search-card mx-auto mt-3" style="max-width: 720px;">
            <form action="{{ route('user.cari') }}" method="GET" id="searchTopForm">
                <div class="smart-search-input-group">
                    <input type="text" name="judul" class="smart-search-input" placeholder="Lakukan pencarian dokumen" value="{{ request('judul') ?? request('q') }}" autocomplete="off">
                    <button type="submit" class="btn-smart-search-submit" title="Cari Dokumen">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- HORIZONTAL CATEGORY PILL TABS -->
    <div class="category-pill-tabs mb-4">
        <a href="{{ route('user.cari', request()->except('jenis_peraturan_id')) }}" class="category-pill-tab {{ !request('jenis_peraturan_id') ? 'active' : '' }}">
            Semua
        </a>
        @foreach($jenisPeraturans as $jpTab)
            <a href="{{ route('user.cari', array_merge(request()->all(), ['jenis_peraturan_id' => $jpTab->id])) }}" class="category-pill-tab {{ request('jenis_peraturan_id') == $jpTab->id ? 'active' : '' }}">
                {{ $jpTab->singkatan ?: $jpTab->nama }}
            </a>
        @endforeach
        <a href="{{ route('berita') }}" class="category-pill-tab">
            Berita
        </a>
        <a href="{{ route('pengumuman.index') }}" class="category-pill-tab">
            Pengumuman
        </a>
    </div>

    <!-- MAIN TWO-COLUMN LAYOUT -->
    <div class="row g-4">
        <!-- ============================================================
             LEFT SIDEBAR FILTER (JDIHN.GO.ID EXACT STRUCTURE)
             ============================================================ -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <div class="filter-sidebar-header d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark">Filter</h6>
                    <a href="{{ route('user.cari') }}" class="text-muted small text-decoration-none d-flex align-items-center gap-1">
                        <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </a>
                </div>

                <form action="{{ route('user.cari') }}" method="GET" id="filterForm">
                    @if(request('judul'))
                        <input type="hidden" name="judul" value="{{ request('judul') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <!-- INSTANSI / PEMRAKARSA -->
                    @php
                        $activeInstansi = request()->has('instansi') ? request('instansi') : 'Pemerintah Kabupaten Toba';
                        $instansiOptions = [
                            '' => [
                                'label' => 'Semua Instansi',
                                'sub' => 'Tampilkan seluruh pemrakarsa regulasi',
                                'icon' => 'bi-collection',
                                'color' => 'text-secondary',
                                'badge' => 'bg-secondary-subtle',
                            ],
                            'Pemerintah Kabupaten Toba' => [
                                'label' => 'Pemerintah Kab. Toba',
                                'sub' => 'Pemerintah Kabupaten Toba',
                                'icon' => 'bi-building',
                                'color' => 'text-primary',
                                'badge' => 'bg-primary-subtle',
                            ],
                            'DPRD Kabupaten Toba' => [
                                'label' => 'DPRD Kab. Toba',
                                'sub' => 'Dewan Perwakilan Rakyat Daerah',
                                'icon' => 'bi-bank',
                                'color' => 'text-success',
                                'badge' => 'bg-success-subtle',
                            ],
                            'Sekretariat Daerah' => [
                                'label' => 'Sekretariat Daerah',
                                'sub' => 'Sekretariat Daerah Kab. Toba',
                                'icon' => 'bi-shield-check',
                                'color' => 'text-info',
                                'badge' => 'bg-info-subtle',
                            ],
                        ];
                        $currInstansi = $instansiOptions[$activeInstansi] ?? [
                            'label' => $activeInstansi ?: 'Semua Instansi',
                            'sub' => 'Instansi Pemrakarsa',
                            'icon' => 'bi-building',
                            'color' => 'text-primary',
                            'badge' => 'bg-primary-subtle',
                        ];
                    @endphp

                    <div class="filter-group">
                        <label class="filter-group-label d-flex justify-content-between align-items-center">
                            <span>INSTANSI</span>
                            @if(!empty($activeInstansi))
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-1.5 py-0.5" style="font-size: 10px; font-weight: 700;">Terpilih</span>
                            @endif
                        </label>
                        <div class="modern-select-dropdown dropdown" id="instansiDropdownWrapper">
                            <input type="hidden" name="instansi" id="inputFilterInstansi" value="{{ $activeInstansi }}">
                            <button type="button" 
                                    class="modern-select-btn dropdown-toggle" 
                                    id="instansiDropdownBtn"
                                    data-bs-toggle="dropdown" 
                                    data-bs-offset="0,8"
                                    data-bs-auto-close="true"
                                    aria-expanded="false">
                                <span class="d-flex align-items-center gap-2 text-truncate">
                                    <i class="bi {{ $currInstansi['icon'] }} modern-select-prefix" id="instansiCurrentIcon"></i>
                                    <span class="modern-select-label" id="instansiCurrentLabel">{{ $currInstansi['label'] }}</span>
                                </span>
                                <i class="bi bi-chevron-down modern-select-chevron"></i>
                            </button>
                            <ul class="dropdown-menu modern-select-menu shadow-lg w-100" aria-labelledby="instansiDropdownBtn">
                                @foreach($instansiOptions as $val => $data)
                                    @php $isSelected = ($activeInstansi === (string)$val); @endphp
                                    <li>
                                        <button type="button" 
                                                class="dropdown-item modern-select-item {{ $isSelected ? 'active' : '' }}"
                                                data-value="{{ $val }}"
                                                data-label="{{ $data['label'] }}"
                                                data-icon="{{ $data['icon'] }}">
                                            <span class="d-flex align-items-center gap-2 text-truncate">
                                                <i class="bi {{ $data['icon'] }} select-item-icon"></i>
                                                <span class="text-truncate">{{ $data['label'] }}</span>
                                            </span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- TAHUN -->
                    <div class="filter-group">
                        <label class="filter-group-label">TAHUN</label>
                        <input type="text" name="tahun" class="form-control form-control-sm" placeholder="Contoh: 2024" value="{{ request('tahun') }}">
                    </div>

                    <!-- JENIS PERATURAN WITH COUNTS -->
                    <div class="filter-group">
                        <label class="filter-group-label">JENIS PERATURAN</label>
                        <div class="filter-checkbox-list">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_peraturan_id" value="" id="jenisSemua" {{ !request('jenis_peraturan_id') ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                                <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="jenisSemua">
                                    <span>Semua</span>
                                    <span class="badge bg-light text-muted border" style="font-size: 11px;">{{ number_format($totalPeraturans ?? 0, 0, ',', '.') }}</span>
                                </label>
                            </div>
                            @foreach($jenisPeraturans as $jp)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_peraturan_id" value="{{ $jp->id }}" id="jenis{{ $jp->id }}" {{ request('jenis_peraturan_id') == $jp->id ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                                    <label class="form-check-label d-flex justify-content-between align-items-center w-100" for="jenis{{ $jp->id }}">
                                        <span>{{ $jp->nama }}</span>
                                        <span class="badge bg-light text-muted border" style="font-size: 11px;">{{ number_format($jp->peraturans_count ?? 0, 0, ',', '.') }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- NOMOR PERATURAN -->
                    <div class="filter-group">
                        <label class="filter-group-label">NOMOR PERATURAN</label>
                        <input type="text" name="nomor_peraturan" class="form-control form-control-sm" placeholder="Contoh: 12" value="{{ request('nomor_peraturan') }}">
                    </div>

                    <!-- STATUS KEBERLAKUAN -->
                    <div class="filter-group">
                        <label class="filter-group-label">STATUS KEBERLAKUAN</label>
                        <div class="filter-checkbox-list">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="" id="statusSemua" {{ !request('status') ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusSemua">Semua Status</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="BERLAKU" id="statusBerlaku" {{ request('status') == 'BERLAKU' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusBerlaku">Berlaku</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="TIDAK BERLAKU" id="statusTidak" {{ request('status') == 'TIDAK BERLAKU' ? 'checked' : '' }}>
                                <label class="form-check-label" for="statusTidak">Tidak Berlaku</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-filter-apply w-100 mt-2">
                        Terapkan Filter
                    </button>
                </form>
            </div>
        </div>

        <!-- ============================================================
             RIGHT RESULTS COLUMN
             ============================================================ -->
        <div class="col-lg-9">
            <!-- Results Header Count & Sort -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Hasil Penelusuran Dokumen</h5>
                    <span class="text-muted small">Menampilkan <strong>{{ number_format($peraturans->total(), 0, ',', '.') }}</strong> hasil</span>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted mb-0 fw-semibold d-none d-sm-inline">Urutkan:</label>
                    @php
                        $sortCurrent = $sort ?? 'terbaru';
                        $sortMap = [
                            'terbaru' => [
                                'label' => 'Terbaru',
                                'desc' => 'Ditetapkan paling mutakhir',
                                'icon' => 'bi-clock-history',
                                'color' => 'text-primary',
                                'badge' => 'bg-primary-subtle',
                            ],
                            'populer' => [
                                'label' => 'Terpopuler',
                                'desc' => 'Paling banyak dilihat & diunduh',
                                'icon' => 'bi-fire',
                                'color' => 'text-danger',
                                'badge' => 'bg-danger-subtle',
                            ],
                            'terlama' => [
                                'label' => 'Terlama',
                                'desc' => 'Arsip regulasi awal',
                                'icon' => 'bi-calendar-event',
                                'color' => 'text-secondary',
                                'badge' => 'bg-secondary-subtle',
                            ],
                        ];
                        $currSort = $sortMap[$sortCurrent] ?? $sortMap['terbaru'];
                    @endphp

                    <div class="dropdown custom-sort-dropdown">
                        <button type="button" 
                                class="custom-sort-btn dropdown-toggle" 
                                id="sortDropdownBtn" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                            <span class="custom-sort-icon-box {{ $currSort['badge'] }} {{ $currSort['color'] }}">
                                <i class="bi {{ $currSort['icon'] }}"></i>
                            </span>
                            <span class="fw-semibold text-dark">{{ $currSort['label'] }}</span>
                            <i class="bi bi-chevron-down custom-dropdown-caret ms-1"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown-menu shadow-lg" aria-labelledby="sortDropdownBtn" style="min-width: 260px;">
                            <li class="dropdown-header px-3 py-2 text-uppercase text-muted fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">
                                Urutkan Hasil Dokumen
                            </li>
                            @foreach($sortMap as $key => $opt)
                                @php $isSortActive = ($sortCurrent === $key); @endphp
                                <li>
                                    <a class="dropdown-item custom-dropdown-item {{ $isSortActive ? 'active' : '' }}" 
                                       href="{{ route('user.cari', array_merge(request()->all(), ['sort' => $key])) }}">
                                        <span class="d-flex align-items-center gap-2.5">
                                            <span class="custom-dropdown-icon-box {{ $opt['badge'] }} {{ $opt['color'] }}">
                                                <i class="bi {{ $opt['icon'] }}"></i>
                                            </span>
                                            <span class="d-flex flex-column">
                                                <span class="option-title">{{ $opt['label'] }}</span>
                                                <span class="option-subtitle">{{ $opt['desc'] }}</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            @if($peraturans->count() > 0)
                <div class="d-flex flex-column gap-3">
                    @foreach($peraturans as $p)
                        @php
                            $jpSearchSlug = Str::slug($p->jenisPeraturan->nama ?? '');
                            $themeClass = 'theme-default';

                            if (str_contains($jpSearchSlug, 'perda') || str_contains($jpSearchSlug, 'daerah')) {
                                $themeClass = 'theme-perda';
                            } elseif (str_contains($jpSearchSlug, 'perbup') || str_contains($jpSearchSlug, 'peraturan-bupati')) {
                                $themeClass = 'theme-perbup';
                            } elseif (str_contains($jpSearchSlug, 'kepbup') || str_contains($jpSearchSlug, 'keputusan')) {
                                $themeClass = 'theme-kepbup';
                            } elseif (str_contains($jpSearchSlug, 'inbup') || str_contains($jpSearchSlug, 'instruksi')) {
                                $themeClass = 'theme-inbup';
                            } elseif (str_contains($jpSearchSlug, 'edaran') || str_contains($jpSearchSlug, 'surat')) {
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

                            <!-- Title -->
                            <h5 class="doc-title mb-2">
                                <a href="{{ route('user.produk-hukum.detail', $p->id) }}">
                                    {{ strtoupper($p->judul) }}
                                </a>
                            </h5>

                            <!-- Meta Chips -->
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

                            <!-- Snippet -->
                            <p class="doc-snippet-text mb-3">
                                {{ Str::limit(strip_tags($p->abstrak ?: $p->subjek), 220) ?: 'Dokumen resmi perundang-undangan Pemerintah Kabupaten Toba.' }}
                            </p>

                            <!-- Footer: Stats + Buttons -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                                <div class="d-flex align-items-center gap-3 text-muted small">
                                    <span title="Dilihat"><i class="bi bi-eye me-1 text-muted"></i> {{ number_format($p->view_count, 0, ',', '.') }}x dilihat</span>
                                    <span title="Diunduh"><i class="bi bi-download me-1 text-muted"></i> {{ number_format($p->download_count ?? 0, 0, ',', '.') }}x diunduh</span>
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
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-end">
                    {{ $peraturans->links() }}
                </div>
            @else
                <div class="text-center py-5 bg-white rounded-3 border">
                    <i class="bi bi-search text-muted display-4 mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">Tidak ada dokumen yang cocok</h5>
                    <p class="text-muted small mb-3">Coba gunakan kata kunci yang lebih umum atau atur ulang filter pencarian Anda.</p>
                    <a href="{{ route('user.cari') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Pencarian
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
