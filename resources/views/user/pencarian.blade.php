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

                    <!-- INSTANSI / PEMRAKARSA -->
                    <div class="filter-group">
                        <label class="filter-group-label">INSTANSI</label>
                        <select name="instansi" class="form-select form-select-sm">
                            <option value="">Pilih instansi...</option>
                            <option value="Pemerintah Kabupaten Toba" selected>Pemerintah Kab. Toba</option>
                            <option value="DPRD Kabupaten Toba">DPRD Kab. Toba</option>
                            <option value="Sekretariat Daerah">Sekretariat Daerah</option>
                        </select>
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
                    <label class="small text-muted mb-0 d-none d-sm-inline">Urutkan:</label>
                    <select class="form-select form-select-sm rounded-pill" onchange="window.location.href=this.value" style="width: auto; min-width: 140px;">
                        <option value="{{ route('user.cari', array_merge(request()->all(), ['sort' => 'terbaru'])) }}" {{ ($sort ?? 'terbaru') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="{{ route('user.cari', array_merge(request()->all(), ['sort' => 'populer'])) }}" {{ ($sort ?? '') === 'populer' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="{{ route('user.cari', array_merge(request()->all(), ['sort' => 'terlama'])) }}" {{ ($sort ?? '') === 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
            </div>

            @if($peraturans->count() > 0)
                <div class="d-flex flex-column gap-3">
                    @foreach($peraturans as $p)
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
                                {{ Str::limit(strip_tags($p->abstrak ?: $p->subjek), 220) ?: 'Dokumen resmi perundang-undangan Pemerintah Kabupaten Toba.' }}
                            </p>

                            <!-- Footer: Stats + Buttons -->
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                                <div class="d-flex align-items-center gap-3 text-muted small">
                                    <span title="Dilihat"><i class="bi bi-eye-fill me-1 text-primary"></i> {{ number_format($p->view_count, 0, ',', '.') }}x dilihat</span>
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
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
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
