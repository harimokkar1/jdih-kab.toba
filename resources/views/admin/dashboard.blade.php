@extends('layouts.admin')

@section('title', 'Dasbor Utama')
@section('breadcrumb', 'Dasbor Utama')

@section('content')

<!-- ============================================================
     1. EXECUTIVE PAGE HEADER (CLEAN & STREAMLINED)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Dasbor Utama</h4>
            <span class="stat-pill stat-pill-slate" id="liveGreetingPill" title="Zona Waktu Indonesia Barat (WIB)">
                <span class="pulse-dot-emerald me-1"></span>
                <span id="liveGreetingText">{{ $greeting }}, {{ auth()->user()->name }}</span>
                <span class="text-muted opacity-50 mx-1">&bull;</span>
                <span id="liveClockText" class="font-monospace fw-bold text-dark">{{ $formattedTimeWib ?? Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') . ' WIB' }}</span>
            </span>
        </div>
        <p class="admin-page-subtitle">Pusat analitik Satu Data regulasi daerah, audit berkas BPHN, dan keterbukaan informasi hukum</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('admin.peraturan.create') }}" class="btn btn-admin-primary">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Peraturan Baru</span>
        </a>
    </div>
</div>

<!-- ============================================================
     2. BENTO METRIC TILES (4 SUBSTANTIAL KPI CARDS)
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- 1. TOTAL PRODUK HUKUM (Blue Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-blue h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="stat-card-top">
                    <span class="stat-card-label">Total Produk Hukum</span>
                    <div class="stat-card-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>
                </div>
                <div class="stat-card-value">
                    {{ number_format($totalPeraturan, 0, ',', '.') }}
                    <span class="stat-card-unit">Dokumen</span>
                </div>
            </div>
            <div>
                <div class="stat-card-subtext mb-2">
                    <span class="stat-pill stat-pill-slate" title="Peraturan Berstatus Berlaku">
                        <span class="pulse-dot-emerald me-1"></span>{{ number_format($totalBerlaku) }} Berlaku
                    </span>
                    @if($totalTidakBerlaku > 0)
                        <span class="stat-pill stat-pill-rose" title="Peraturan Dicabut / Tidak Berlaku">
                            {{ number_format($totalTidakBerlaku) }} Dicabut
                        </span>
                    @endif
                    <span class="stat-pill stat-pill-blue ms-auto" title="Rasio Keberlakuan">
                        {{ $rasioBerlaku }}% Aktif
                    </span>
                </div>
                <div class="progress" style="height: 4px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                    <div class="progress-bar bg-primary" style="width: {{ $rasioBerlaku }}%;" title="Persentase Regulasi Berlaku"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. KEPATUHAN BERKAS PDF (Standar BPHN / Amber-Emerald Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card {{ $totalWithoutPdf > 0 ? 'stat-card-amber' : 'stat-card-emerald' }} h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="stat-card-top">
                    <span class="stat-card-label">Kepatuhan Naskah PDF</span>
                    <div class="stat-card-icon">
                        <i class="bi bi-file-earmark-check"></i>
                    </div>
                </div>
                <div class="stat-card-value">
                    {{ $rasioPdf }}%
                    <span class="stat-card-unit">Lengkap</span>
                </div>
            </div>
            <div>
                <div class="stat-card-subtext mb-2">
                    <span class="stat-pill stat-pill-slate" title="Jumlah Dokumen Memiliki Berkas PDF">
                        {{ number_format($totalWithPdf) }}/{{ $totalPeraturan }} File
                    </span>
                    @if($totalWithoutPdf > 0)
                        <a href="{{ route('admin.peraturan.index', ['has_file' => '0']) }}" class="stat-pill stat-pill-rose text-decoration-none ms-auto" title="Klik untuk menyaring dan mengunggah PDF yang kurang">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $totalWithoutPdf }} Perlu PDF &rarr;
                        </a>
                    @else
                        <span class="stat-pill stat-pill-slate ms-auto" title="Seluruh Naskah Telah Memiliki Berkas PDF">
                            100% Sesuai BPHN
                        </span>
                    @endif
                </div>
                <div class="progress" style="height: 4px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                    <div class="progress-bar {{ $totalWithoutPdf > 0 ? 'bg-warning' : 'bg-success' }}" style="width: {{ $rasioPdf }}%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. PUBLIKASI WARTA & MAKLUMAT (Cyan Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-cyan h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="stat-card-top">
                    <span class="stat-card-label">Warta &amp; Maklumat</span>
                    <div class="stat-card-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>
                </div>
                <div class="stat-card-value">
                    {{ number_format($totalBerita + $totalPengumuman, 0, ',', '.') }}
                    <span class="stat-card-unit">Publikasi</span>
                </div>
            </div>
            <div>
                <div class="stat-card-subtext mb-2">
                    <span class="stat-pill stat-pill-cyan">
                        {{ $totalBerita }} Berita
                    </span>
                    <span class="stat-pill stat-pill-purple">
                        {{ $totalPengumuman }} Info
                    </span>
                    <a href="{{ route('admin.berita') }}" class="stat-pill stat-pill-slate ms-auto text-decoration-none" title="Kelola Warta Berita">
                        Kelola &rarr;
                    </a>
                </div>
                <div class="progress" style="height: 4px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                    <div class="progress-bar bg-info" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. PENGUNJUNG PORTAL (Emerald Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-emerald h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="stat-card-top">
                    <span class="stat-card-label">Pengunjung Portal</span>
                    <div class="stat-card-icon">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="stat-card-value">
                    {{ number_format($visitorStats['total'] ?? 0, 0, ',', '.') }}
                    <span class="stat-card-unit">Hits</span>
                </div>
            </div>
            <div>
                <div class="stat-card-subtext mb-2">
                    <span class="stat-pill stat-pill-emerald" title="Pengunjung aktif saat ini">
                        <span class="pulse-dot-emerald me-1"></span>
                        {{ $visitorStats['online'] ?? 1 }} Online
                    </span>
                    <span class="stat-pill stat-pill-slate ms-auto">
                        +{{ number_format($visitorStats['hari_ini'] ?? 0) }} Hari Ini
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between" style="font-size: 0.68rem; color: #64748b;">
                    <span>Komputer: <strong class="text-dark">{{ $desktopPct }}%</strong></span>
                    <span>Mobile: <strong class="text-dark">{{ $mobilePct }}%</strong></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     3. UNIFIED ANALYTICS SUITE (DEDICATED FULL-WIDTH CARD)
     Satu baris mandiri tanpa terpengaruh tinggi kartu lain!
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="admin-card-header card-header-compact">
        <div>
            <h6 class="admin-card-title mb-0" style="font-size: 0.875rem;">
                <i class="bi bi-graph-up-arrow text-primary me-2"></i>Tren Trafik Portal Pengunjung
            </h6>
            <small class="text-muted" style="font-size: 0.72rem;">Aktivitas masyarakat dan aparatur mengakses basis data regulasi Toba</small>
        </div>
        <!-- Time-Range Toggle Tabs -->
        <div class="chart-range-group">
            <button type="button" class="btn-chart-range active" id="btnRange7" onclick="switchChartRange('7d')">
                7 Hari
            </button>
            <button type="button" class="btn-chart-range" id="btnRange30" onclick="switchChartRange('30d')">
                30 Hari
            </button>
            <button type="button" class="btn-chart-range" id="btnRangeMonth" onclick="switchChartRange('month')">
                Per Bulan
            </button>
            <button type="button" class="btn-chart-range" id="btnRangeYear" onclick="switchChartRange('year')">
                Per Tahun
            </button>
        </div>
    </div>
    <div class="p-3">
        <div class="row g-3 align-items-center">
            <!-- Sisi Kiri: Line Chart Canvas (Lega & Proporsional) -->
            <div class="col-lg-9">
                <div style="height: 235px; position: relative;">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>

            <!-- Sisi Kanan: Panel Telemetri Terintegrasi (Bebas Empty Space!) -->
            <div class="col-lg-3 border-start-lg">
                <div class="d-flex flex-column gap-3 ps-lg-3 py-1">
                    <div class="chart-side-kpi-item">
                        <span class="text-muted text-uppercase fw-bold" id="telemetryAvgLabel" style="font-size: 0.65rem; letter-spacing: 0.05em;">Rata-Rata Kunjungan</span>
                        <div class="d-flex align-items-baseline gap-1 mt-1">
                            <span class="fs-4 fw-bold text-dark" id="telemetryAvg">{{ number_format($avgVisitors) }}</span>
                            <span class="text-muted small" id="telemetryAvgUnit">hits/hari</span>
                        </div>
                    </div>

                    <div class="chart-side-kpi-item">
                        <span class="text-muted text-uppercase fw-bold" id="telemetryMaxLabel" style="font-size: 0.65rem; letter-spacing: 0.05em;">Puncak Kunjungan</span>
                        <div class="d-flex align-items-baseline gap-1 mt-1">
                            <span class="fs-4 fw-bold text-dark" id="telemetryMax">{{ number_format($maxVisitorVal) }}</span>
                            <span class="text-muted small" id="telemetryMaxDay">({{ $maxVisitorDay }})</span>
                        </div>
                    </div>

                    <div class="chart-side-kpi-item">
                        <span class="text-muted text-uppercase fw-bold" id="telemetryCompareLabel" style="font-size: 0.65rem; letter-spacing: 0.05em;">Hari Ini vs Kemarin</span>
                        <div class="d-flex align-items-baseline gap-1 mt-1">
                            <span class="fs-4 fw-bold text-success" id="telemetryCompareCurrent">{{ number_format($visitorStats['hari_ini'] ?? 0) }}</span>
                            <span class="text-muted small" id="telemetryCompareUnit">/ {{ number_format($visitorStats['kemarin'] ?? 0) }} hits</span>
                        </div>
                    </div>

                    <div class="chart-side-kpi-item pt-2 border-top">
                        <div class="d-flex justify-content-between text-muted mb-1" style="font-size: 0.7rem;">
                            <span>PC: <strong class="text-dark">{{ $desktopPct }}%</strong></span>
                            <span>HP: <strong class="text-dark">{{ $mobilePct }}%</strong></span>
                        </div>
                        <div class="progress" style="height: 4px; border-radius: 999px; background: #e2e8f0; overflow: hidden;">
                            <div class="progress-bar bg-primary" style="width: {{ $desktopPct }}%;"></div>
                            <div class="progress-bar bg-success" style="width: {{ $mobilePct }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     4. 2-COLUMN BALANCED ROW: KOMPOSISI & PUBLIKASI TERKINI
     2 Kolom simetris proporsional tanpa gap kosong!
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- KARTU 1: KOMPOSISI PRODUK HUKUM (col-lg-6) -->
    <div class="col-lg-6">
        <div class="admin-card h-100 d-flex flex-column justify-content-between">
            <div class="admin-card-header card-header-compact">
                <div>
                    <h6 class="admin-card-title mb-0" style="font-size: 0.85rem;">
                        <i class="bi bi-pie-chart text-primary me-2"></i>Komposisi Produk Hukum
                    </h6>
                </div>
                <span class="stat-pill stat-pill-slate py-0 px-2" style="font-size: 0.68rem; font-weight: 700;">
                    {{ $totalPeraturan }} Regulasi
                </span>
            </div>
            <div class="p-3 flex-grow-1 d-flex align-items-center">
                <div class="row g-3 align-items-center w-100 m-0">
                    <!-- Sisi Kiri: Donut Canvas -->
                    <div class="col-sm-5 text-center p-0">
                        <div class="doughnut-box-centered" style="margin: 0 auto; width: 145px; height: 145px;">
                            <canvas id="categoryChart"></canvas>
                            <div class="doughnut-center-content-lg">
                                <span class="doughnut-number-lg" id="donutCenterNumber">{{ $totalPeraturan }}</span>
                                <span class="doughnut-label-lg" id="donutCenterLabel">Dokumen</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sisi Kanan: Distribusi Kategori Regulasi -->
                    <div class="col-sm-7 border-start-sm ps-sm-4 p-0">
                        <div class="d-flex flex-column gap-2">
                            @foreach($jenisDistribution as $index => $item)
                                @php
                                    $colors = ['#2563eb', '#d97706', '#059669', '#7c3aed', '#0891b2', '#e11d48'];
                                    $c = $colors[$index % count($colors)];
                                    $pct = $totalPeraturan > 0 ? round(($item->peraturans_count / $totalPeraturan) * 100, 1) : 0;
                                    $short = $item->singkatan ?: Str::limit($item->nama, 10);
                                @endphp
                                <div class="category-grid-item"
                                     id="catItem{{ $index }}"
                                     onmouseenter="focusCategory({{ $index }}, {{ $item->peraturans_count }}, '{{ $short }}', '{{ $c }}')"
                                     onmouseleave="unfocusCategory()">
                                    <div class="d-flex align-items-center justify-content-between mb-1.5">
                                        <div class="d-flex align-items-center min-w-0">
                                            <span class="category-color-dot" style="background-color: {{ $c }};"></span>
                                            <span class="category-name text-truncate" title="{{ $item->nama }}">
                                                {{ $short }}
                                            </span>
                                        </div>
                                        <span class="category-stats flex-shrink-0">
                                            <strong>{{ $item->peraturans_count }}</strong>
                                            <small>({{ $pct }}%)</small>
                                        </span>
                                    </div>
                                    <div class="progress" style="height: 4px; background: #e2e8f0; border-radius: 9999px;">
                                        <div class="progress-bar" style="width: {{ $pct }}%; background-color: {{ $c }}; border-radius: 9999px;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2 px-3 border-top bg-light-subtle d-flex align-items-center justify-content-between" style="font-size: 0.72rem;">
                <span class="text-muted"><i class="bi bi-info-circle me-1"></i>Arahkan kursor untuk menyorot kategori</span>
                <a href="{{ route('admin.jenis-peraturan.index') }}" class="text-decoration-none fw-semibold">Kelola Jenis &rarr;</a>
            </div>
        </div>
    </div>

    <!-- KARTU 2: PUBLIKASI TERKINI (col-lg-6) -->
    <div class="col-lg-6">
        <div class="admin-card h-100 d-flex flex-column justify-content-between">
            <div class="admin-card-header card-header-compact">
                <div>
                    <h6 class="admin-card-title mb-0" style="font-size: 0.85rem;">
                        <i class="bi bi-megaphone-fill text-primary me-2"></i>Publikasi Terkini
                    </h6>
                    <small class="text-muted" style="font-size: 0.7rem;">Warta dan pengumuman hukum</small>
                </div>
                <a href="{{ route('admin.berita') }}" class="btn btn-sm btn-link p-0 text-decoration-none fw-semibold" style="font-size: 0.72rem;">
                    Semua &rarr;
                </a>
            </div>
            <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                <!-- Clean Borderless Stream List (No Ugly Boxes-in-a-Box) -->
                <div class="pub-stream-list">
                    @forelse($recentBeritas->take(2) as $berita)
                        <a href="{{ route('admin.berita') }}" class="pub-stream-item">
                            <div class="pub-stream-avatar news">
                                <i class="bi bi-newspaper"></i>
                            </div>
                            <div class="min-w-0 flex-grow-1">
                                <span class="pub-stream-title">{{ $berita->judul }}</span>
                                <div class="pub-stream-meta">
                                    <span class="pub-tag-badge pub-tag-news">Berita</span>
                                    <span class="mx-1 text-muted">&bull;</span>
                                    <span>{{ $berita->created_at ? $berita->created_at->diffForHumans() : '-' }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse

                    @forelse($recentPengumumans->take(2) as $info)
                        <a href="{{ route('admin.pengumuman.index') }}" class="pub-stream-item">
                            <div class="pub-stream-avatar info">
                                <i class="bi bi-megaphone"></i>
                            </div>
                            <div class="min-w-0 flex-grow-1">
                                <span class="pub-stream-title">{{ $info->judul }}</span>
                                <div class="pub-stream-meta">
                                    <span class="pub-tag-badge pub-tag-info">
                                        {{ $info->kategori->nama ?? 'Pengumuman' }}
                                    </span>
                                    <span class="mx-1 text-muted">&bull;</span>
                                    <span>{{ $info->created_at ? $info->created_at->diffForHumans() : '-' }}</span>
                                </div>
                            </div>
                        </a>
                    @empty
                    @endforelse

                    @if($recentBeritas->isEmpty() && $recentPengumumans->isEmpty())
                        <div class="text-center text-muted py-4 small">
                            Belum ada riwayat publikasi berita atau pengumuman.
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-2 pt-3 border-top mt-auto">
                    <a href="{{ route('admin.berita') }}" class="btn btn-sm btn-outline-primary w-50 py-2 fw-medium d-inline-flex align-items-center justify-content-center gap-2" style="font-size: 0.76rem; height: 36px;">
                        <i class="bi bi-pencil-square"></i>+ Berita
                    </a>
                    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary w-50 py-2 fw-medium d-inline-flex align-items-center justify-content-center gap-2" style="font-size: 0.76rem; height: 36px;">
                        <i class="bi bi-megaphone"></i>+ Maklumat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     5. TABEL REGULASI TERBARU DIPERBARUI (FULL-WIDTH 12-COL)
     Lega, judul leluasa dibaca, dan sangat profesional!
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="admin-card-header card-header-compact">
        <div>
            <h6 class="admin-card-title mb-0" style="font-size: 0.875rem;">
                <i class="bi bi-journal-text text-primary me-2"></i>Regulasi Terbaru Diperbarui
            </h6>
            <small class="text-muted" style="font-size: 0.72rem;">Aktivitas inventarisasi dan pengelolaan naskah hukum terkini</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            @if($totalWithoutPdf > 0)
                <a href="{{ route('admin.peraturan.index', ['has_file' => '0']) }}" class="btn btn-sm btn-outline-danger py-1 px-2 fw-semibold" style="font-size: 0.72rem;">
                    <i class="bi bi-exclamation-triangle me-1"></i>{{ $totalWithoutPdf }} Perlu PDF
                </a>
            @endif
            <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-outline-primary py-1 px-3 fw-medium" style="font-size: 0.74rem;">
                Lihat Semua ({{ $totalPeraturan }}) &rarr;
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="admin-table-registry">
            <thead>
                <tr>
                    <th style="width: 110px;">Klasifikasi</th>
                    <th>Nomor &amp; Judul Regulasi</th>
                    <th style="width: 130px;" class="text-center">Naskah Digital</th>
                    <th style="width: 125px;" class="text-center">Status Hukum</th>
                    <th style="width: 175px;" class="text-end">Aksi Cepat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPeraturans as $p)
                    @php
                        $slug = Str::slug($p->jenisPeraturan->nama ?? '');
                        $pillClass = 'pill-type-default';
                        if (str_contains($slug, 'perda') || str_contains($slug, 'daerah')) {
                            $pillClass = 'pill-type-perda';
                        } elseif (str_contains($slug, 'perbup') || str_contains($slug, 'peraturan-bupati')) {
                            $pillClass = 'pill-type-perbup';
                        } elseif (str_contains($slug, 'kepbup') || str_contains($slug, 'keputusan')) {
                            $pillClass = 'pill-type-kepbup';
                        } elseif (str_contains($slug, 'inbup') || str_contains($slug, 'instruksi')) {
                            $pillClass = 'pill-type-inbup';
                        }
                    @endphp
                    <tr>
                        <td>
                            <span class="pill-type-badge {{ $pillClass }}">
                                {{ $p->jenisPeraturan->singkatan ?? 'REGULASI' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="registry-doc-badge">
                                    <i class="bi bi-hash text-primary"></i>Nomor {{ $p->nomor_peraturan ?: '-' }}
                                </span>
                                @if($p->tahun && !Str::contains((string)$p->nomor_peraturan, (string)$p->tahun))
                                    <span class="registry-doc-year-tag">&bull; Tahun {{ $p->tahun }}</span>
                                @endif
                            </div>
                            <a href="{{ route('admin.peraturan.edit', $p->id) }}" class="registry-title-link" title="{{ $p->judul }}">
                                {{ $p->judul }}
                            </a>
                            <div class="registry-meta-row">
                                <span><i class="bi bi-calendar3 me-1"></i>Ditetapkan: {{ $p->tanggal_penetapan ? $p->tanggal_penetapan->translatedFormat('d M Y') : '-' }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-eye me-1"></i>{{ number_format($p->view_count ?? 0) }}x diakses</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-building me-1"></i>{{ $p->teu_badan ?: 'Pemerintah Kabupaten Toba' }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($p->file_dokumen)
                                <span class="badge-pdf-pill-success" title="Naskah PDF Tersedia">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i>PDF Siap
                                </span>
                            @else
                                <a href="{{ route('admin.peraturan.edit', $p->id) }}" class="badge-pdf-pill-danger" title="Klik untuk mengunggah dokumen PDF">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Upload PDF
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($p->status === 'BERLAKU')
                                <span class="badge-status-pill-active"><span class="pulse-dot-emerald me-1"></span>Berlaku</span>
                            @else
                                <span class="badge-status-pill-inactive"><i class="bi bi-dash-circle me-1"></i>Dicabut</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                @if($p->file_dokumen)
                                    <button type="button" class="btn-reg-action btn-reg-preview" 
                                        onclick="openPdfPreview('{{ route('user.produk-hukum.preview', $p->id) }}', '{{ addslashes($p->judul) }}', '{{ route('user.produk-hukum.download', $p->id) }}', '{{ route('admin.peraturan.edit', $p->id) }}')"
                                        title="Pratinjau Dokumen Naskah PDF">
                                        <i class="bi bi-eye"></i> Pratinjau
                                    </button>
                                @endif
                                <a href="{{ route('admin.peraturan.edit', $p->id) }}" class="btn-reg-action btn-reg-edit" title="Edit Metadata Regulasi">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-folder2-open fs-1 d-block mb-2 text-slate-300"></i>
                            Belum ada riwayat dokumen peraturan yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================================
     6. ENDPOINT REST API JDIHN NASIONAL (EXECUTIVE INTEGRATION BANNER - PALING BAWAH)
     Proporsional, lega, berwibawa, dan 100% bebas dari kesan terhimpit!
     ============================================================ -->
<div class="jdihn-integration-banner mb-4">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <!-- Sisi Kiri: Branding JDIHN & Status BPHN -->
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" class="jdihn-banner-logo">
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h6 class="jdihn-banner-title">Endpoint REST API JDIHN Nasional</h6>
                    <span class="stat-pill stat-pill-emerald py-1 px-3" style="font-size: 0.72rem; font-weight: 500;">
                        <span class="pulse-dot-emerald me-2"></span> Terhubung
                    </span>
                </div>
                <div class="jdihn-banner-subtext">
                    <i class="bi bi-shield-check text-success me-1"></i>Integrasi basis data regulasi daerah ke Satu Data JDIHN BPHN
                </div>
            </div>
        </div>

        <!-- Sisi Tengah: Indikator Spesifikasi & Protokol BPHN (Visible pada layar besar) -->
        <div class="d-none d-xl-flex align-items-center jdihn-banner-meta-box">
            <div class="jdihn-meta-item">
                <div class="jdihn-meta-icon shield">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <span class="jdihn-meta-label">Standar Regulasi</span>
                    <div class="jdihn-meta-val">Permenkumham 8/2019</div>
                </div>
            </div>
            <div class="jdihn-meta-item">
                <div class="jdihn-meta-icon sync">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div>
                    <span class="jdihn-meta-label">Protokol Satu Data</span>
                    <div class="jdihn-meta-val">REST JSON Real-Time</div>
                </div>
            </div>
        </div>

        <!-- Sisi Kanan: Input Endpoint URL Bar + Tombol Salin & JSON -->
        <div class="d-flex align-items-center gap-2 flex-grow-1 flex-md-grow-0 justify-content-end" style="min-width: min(100%, 460px);">
            <div class="jdihn-banner-endpoint-bar flex-grow-1 mb-0">
                <span class="badge-get">GET</span>
                <input type="text" id="apiEndpointUrlInput" value="{{ route('api.jdihn.index') }}" readonly title="{{ route('api.jdihn.index') }}">
                <button type="button" class="jdihn-banner-btn-copy" id="btnCopyApi" onclick="copyApiEndpoint()" title="Salin URL Endpoint API JDIHN">
                    <i class="bi bi-clipboard" id="copyIcon"></i>
                    <span id="copyText">Salin</span>
                </button>
            </div>
            <a href="{{ route('api.jdihn.index') }}" target="_blank" class="jdihn-banner-btn-json" title="Cek Format Respon JSON Standar BPHN">
                <i class="bi bi-box-arrow-up-right"></i> JSON
            </a>
        </div>
    </div>
</div>

<!-- ============================================================
     6. MODAL PRATINJAU PDF INSTAN (IN-DASHBOARD VIEWER)
     ============================================================ -->
<div class="modal fade modal-admin-preview" id="adminPdfPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2 min-w-0">
                    <i class="bi bi-file-earmark-pdf text-danger fs-5"></i>
                    <h6 class="modal-title text-truncate fw-bold mb-0 text-white" id="adminPdfModalTitle">Pratinjau Dokumen Naskah</h6>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" id="btnModalDownloadPdf" target="_blank" class="btn btn-sm btn-light py-1 px-3 fw-medium" style="font-size: 0.75rem;">
                        <i class="bi bi-download me-1"></i>Unduh PDF
                    </a>
                    <a href="#" id="btnModalEditDoc" class="btn btn-sm btn-primary py-1 px-3 fw-medium" style="font-size: 0.75rem;">
                        <i class="bi bi-pencil-square me-1"></i>Edit Regulasi
                    </a>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-0 position-relative" style="min-height: 520px; background: #0f172a;">
                <iframe id="adminPdfIframe" src="about:blank" title="Pratinjau Naskah PDF"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Toast Feedback for Copying API Endpoint -->
<div id="toastCopyFeedback" class="toast-copy-notify">
    <i class="bi bi-check-circle-fill text-success"></i>
    <span>URL Endpoint API JDIHN berhasil disalin ke clipboard!</span>
</div>

@endsection

@push('scripts')
<script>
    // Data Dinamis 7 Hari, 30 Hari, Per Bulan, dan Per Tahun dari Server
    const chartData7Days = {
        labels: {!! json_encode($chartDays ?? []) !!},
        data: {!! json_encode($chartVisitors ?? []) !!},
        avg: '{{ number_format($avgVisitors) }}',
        avgUnit: 'hits/hari',
        avgLabel: 'Rata-Rata Kunjungan',
        max: '{{ number_format($maxVisitorVal) }}',
        maxDay: '({{ $maxVisitorDay }})',
        maxLabel: 'Puncak Kunjungan',
        compareLabel: 'Hari Ini vs Kemarin',
        currentVal: '{{ number_format($visitorStats['hari_ini'] ?? 0) }}',
        compareUnit: '/ {{ number_format($visitorStats['kemarin'] ?? 0) }} hits',
        chartLabel: 'Kunjungan Harian (7 Hari)'
    };

    const chartData30Days = {
        labels: {!! json_encode($chartDays30 ?? []) !!},
        data: {!! json_encode($chartVisitors30 ?? []) !!},
        avg: '{{ number_format($avgVisitors30) }}',
        avgUnit: 'hits/hari',
        avgLabel: 'Rata-Rata Harian (30 Hari)',
        max: '{{ number_format($maxVisitor30Val ?? 0) }}',
        maxDay: '({{ $maxVisitor30Day ?? "30 Hari" }})',
        maxLabel: 'Puncak Kunjungan',
        compareLabel: 'Hari Ini vs Kemarin',
        currentVal: '{{ number_format($visitorStats['hari_ini'] ?? 0) }}',
        compareUnit: '/ {{ number_format($visitorStats['kemarin'] ?? 0) }} hits',
        chartLabel: 'Kunjungan Harian (30 Hari)'
    };

    const chartDataMonths = {
        labels: {!! json_encode($chartMonths ?? []) !!},
        data: {!! json_encode($chartVisitorsMonth ?? []) !!},
        avg: '{{ number_format($avgVisitorsMonth ?? 0) }}',
        avgUnit: 'hits/bulan',
        avgLabel: 'Rata-Rata Bulanan (12 Bulan)',
        max: '{{ number_format($maxVisitorMonthVal ?? 0) }}',
        maxDay: '({{ $maxVisitorMonthLabel ?? "-" }})',
        maxLabel: 'Puncak Bulanan',
        compareLabel: 'Bulan Ini vs Lalu',
        currentVal: '{{ number_format($visitorsThisMonth ?? 0) }}',
        compareUnit: '/ {{ number_format($visitorsLastMonth ?? 0) }} hits',
        chartLabel: 'Kunjungan Bulanan (12 Bulan)'
    };

    const chartDataYears = {
        labels: {!! json_encode($chartYears ?? []) !!},
        data: {!! json_encode($chartVisitorsYear ?? []) !!},
        avg: '{{ number_format($avgVisitorsYear ?? 0) }}',
        avgUnit: 'hits/tahun',
        avgLabel: 'Rata-Rata Tahunan (5 Tahun)',
        max: '{{ number_format($maxVisitorYearVal ?? 0) }}',
        maxDay: '({{ $maxVisitorYearLabel ?? "-" }})',
        maxLabel: 'Puncak Tahunan',
        compareLabel: 'Tahun Ini vs Lalu',
        currentVal: '{{ number_format($visitorsThisYear ?? 0) }}',
        compareUnit: '/ {{ number_format($visitorsLastYear ?? 0) }} hits',
        chartLabel: 'Kunjungan Tahunan (5 Tahun)'
    };

    let visitorChartInstance = null;
    let categoryChartInstance = null;

    document.addEventListener('DOMContentLoaded', function () {
        // Area Chart: Tren Kunjungan Portal dengan Garis Halus & Dashed Grid
        const ctxVisitor = document.getElementById('visitorChart');
        if (ctxVisitor && typeof Chart !== 'undefined') {
            const visitorGradient = ctxVisitor.getContext('2d').createLinearGradient(0, 0, 0, 235);
            visitorGradient.addColorStop(0, 'rgba(16, 185, 129, 0.28)');
            visitorGradient.addColorStop(0.8, 'rgba(16, 185, 129, 0.04)');
            visitorGradient.addColorStop(1, 'rgba(16, 185, 129, 0.00)');

            visitorChartInstance = new Chart(ctxVisitor, {
                type: 'line',
                data: {
                    labels: chartData7Days.labels,
                    datasets: [{
                        label: 'Kunjungan Portal',
                        data: chartData7Days.data,
                        borderColor: '#10b981',
                        borderWidth: 2.8,
                        backgroundColor: visitorGradient,
                        fill: true,
                        tension: 0.38,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2.5,
                        pointRadius: 4.5,
                        pointHoverRadius: 7,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#090e17',
                            titleFont: { size: 12, family: 'Plus Jakarta Sans', weight: '700' },
                            bodyFont: { size: 12, family: 'Plus Jakarta Sans' },
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Sesi Kunjungan Terverifikasi';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11, family: 'Plus Jakarta Sans', weight: '600' }, color: '#64748b' }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { 
                                color: 'rgba(226, 232, 240, 0.7)',
                                borderDash: [4, 4]
                            },
                            ticks: { font: { size: 10, family: 'Plus Jakarta Sans' }, color: '#94a3b8', precision: 0 }
                        }
                    }
                }
            });
        }

        // Doughnut Chart: Komposisi Jenis Regulasi (Interactive Center Gauge)
        const ctxCategory = document.getElementById('categoryChart');
        if (ctxCategory && typeof Chart !== 'undefined') {
            const catLabels = {!! json_encode($chartCatLabels ?? []) !!};
            const catShorts = {!! json_encode($jenisDistribution->map(fn($j) => $j->singkatan ?: Str::limit($j->nama, 10))->toArray()) !!};
            const catCounts = {!! json_encode($chartCatCounts ?? []) !!};
            const catColors = ['#2563eb', '#d97706', '#059669', '#7c3aed', '#0891b2', '#e11d48'];
            const totalDocs = {{ $totalPeraturan }};

            const numEl = document.getElementById('donutCenterNumber');
            const lblEl = document.getElementById('donutCenterLabel');

            categoryChartInstance = new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: catLabels,
                    datasets: [{
                        data: catCounts.length > 0 ? catCounts : [1],
                        backgroundColor: catColors.slice(0, catLabels.length || 1),
                        borderWidth: 2.5,
                        borderColor: '#ffffff',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    },
                    onHover: function(event, activeElements) {
                        if (numEl && lblEl) {
                            if (activeElements && activeElements.length > 0) {
                                const idx = activeElements[0].index;
                                numEl.textContent = catCounts[idx] || 0;
                                numEl.style.color = catColors[idx % catColors.length];
                                lblEl.textContent = catShorts[idx] || 'Regulasi';
                                highlightListRow(idx);
                            } else {
                                numEl.textContent = totalDocs;
                                numEl.style.color = '#0b1727';
                                lblEl.textContent = 'Dokumen';
                                clearListRows();
                            }
                        }
                    }
                }
            });

            // Reset angka tengah ketika kursor keluar dari donat
            const donutBox = document.querySelector('.doughnut-box-centered, .doughnut-canvas-box-sm');
            if (donutBox) {
                donutBox.addEventListener('mouseleave', function() {
                    if (numEl) {
                        numEl.textContent = totalDocs;
                        numEl.style.color = '#0b1727';
                    }
                    if (lblEl) {
                        lblEl.textContent = 'Dokumen';
                    }
                    clearListRows();
                });
            }
        }
    });

    function highlightListRow(index) {
        document.querySelectorAll('.category-grid-item, .category-item-compact').forEach((el, i) => {
            if (i === index) {
                el.style.backgroundColor = '#eff6ff';
            } else {
                el.style.backgroundColor = 'transparent';
            }
        });
    }

    function clearListRows() {
        document.querySelectorAll('.category-grid-item, .category-item-compact').forEach((el) => {
            el.style.backgroundColor = 'transparent';
        });
    }

    function focusCategory(index, count, label, color) {
        const numEl = document.getElementById('donutCenterNumber');
        const lblEl = document.getElementById('donutCenterLabel');
        if (numEl) {
            numEl.textContent = count;
            numEl.style.color = color;
        }
        if (lblEl) {
            lblEl.textContent = label;
        }
        if (categoryChartInstance) {
            categoryChartInstance.setActiveElements([{ datasetIndex: 0, index: index }]);
            categoryChartInstance.render();
        }
    }

    function unfocusCategory() {
        const numEl = document.getElementById('donutCenterNumber');
        const lblEl = document.getElementById('donutCenterLabel');
        const totalDocs = {{ $totalPeraturan }};
        if (numEl) {
            numEl.textContent = totalDocs;
            numEl.style.color = '#0b1727';
        }
        if (lblEl) {
            lblEl.textContent = 'Dokumen';
        }
        if (categoryChartInstance) {
            categoryChartInstance.setActiveElements([]);
            categoryChartInstance.render();
        }
    }

    // Dynamic Chart Range Switcher (7 Hari, 30 Hari, Per Bulan, Per Tahun)
    function switchChartRange(mode) {
        const btn7 = document.getElementById('btnRange7');
        const btn30 = document.getElementById('btnRange30');
        const btnMonth = document.getElementById('btnRangeMonth');
        const btnYear = document.getElementById('btnRangeYear');

        [btn7, btn30, btnMonth, btnYear].forEach(b => { if (b) b.classList.remove('active'); });

        let dataset = chartData7Days;
        if (mode === '7d' || mode === 7) {
            if (btn7) btn7.classList.add('active');
            dataset = chartData7Days;
        } else if (mode === '30d' || mode === 30) {
            if (btn30) btn30.classList.add('active');
            dataset = chartData30Days;
        } else if (mode === 'month') {
            if (btnMonth) btnMonth.classList.add('active');
            dataset = chartDataMonths;
        } else if (mode === 'year') {
            if (btnYear) btnYear.classList.add('active');
            dataset = chartDataYears;
        }

        if (visitorChartInstance) {
            visitorChartInstance.data.labels = dataset.labels;
            visitorChartInstance.data.datasets[0].data = dataset.data;
            visitorChartInstance.data.datasets[0].label = dataset.chartLabel;
            visitorChartInstance.update();
        }

        // Update Side KPI Panel Dynamically
        const avgEl = document.getElementById('telemetryAvg');
        const avgUnitEl = document.getElementById('telemetryAvgUnit');
        const avgLabelEl = document.getElementById('telemetryAvgLabel');

        const maxEl = document.getElementById('telemetryMax');
        const maxDayEl = document.getElementById('telemetryMaxDay');
        const maxLabelEl = document.getElementById('telemetryMaxLabel');

        const compLabelEl = document.getElementById('telemetryCompareLabel');
        const compValEl = document.getElementById('telemetryCompareCurrent');
        const compUnitEl = document.getElementById('telemetryCompareUnit');

        if (avgEl) avgEl.innerText = dataset.avg;
        if (avgUnitEl) avgUnitEl.innerText = dataset.avgUnit;
        if (avgLabelEl) avgLabelEl.innerText = dataset.avgLabel;

        if (maxEl) maxEl.innerText = dataset.max;
        if (maxDayEl) maxDayEl.innerText = dataset.maxDay;
        if (maxLabelEl) maxLabelEl.innerText = dataset.maxLabel;

        if (compLabelEl) compLabelEl.innerText = dataset.compareLabel;
        if (compValEl) compValEl.innerText = dataset.currentVal;
        if (compUnitEl) compUnitEl.innerText = dataset.compareUnit;
    }

    // Modal Pratinjau PDF Instan
    function openPdfPreview(previewUrl, title, downloadUrl, editUrl) {
        const modalEl = document.getElementById('adminPdfPreviewModal');
        const iframe = document.getElementById('adminPdfIframe');
        const titleEl = document.getElementById('adminPdfModalTitle');
        const btnDownload = document.getElementById('btnModalDownloadPdf');
        const btnEdit = document.getElementById('btnModalEditDoc');

        if (titleEl) titleEl.textContent = title;
        if (iframe) iframe.src = previewUrl;
        if (btnDownload) btnDownload.href = downloadUrl;
        if (btnEdit) btnEdit.href = editUrl;

        if (modalEl && typeof bootstrap !== 'undefined') {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    }

    // Bersihkan src iframe saat modal ditutup agar hemat memory
    document.addEventListener('DOMContentLoaded', function () {
        const previewModal = document.getElementById('adminPdfPreviewModal');
        if (previewModal) {
            previewModal.addEventListener('hidden.bs.modal', function () {
                const iframe = document.getElementById('adminPdfIframe');
                if (iframe) iframe.src = 'about:blank';
            });
        }
    });

    // Copy API Endpoint Function
    function copyApiEndpoint() {
        const inputEl = document.getElementById('apiEndpointUrlInput');
        const toast = document.getElementById('toastCopyFeedback');
        const copyBtn = document.getElementById('btnCopyApi');
        const copyText = document.getElementById('copyText');
        const copyIcon = document.getElementById('copyIcon');

        if (inputEl) {
            navigator.clipboard.writeText(inputEl.value.trim()).then(function () {
                if (copyBtn && copyText && copyIcon) {
                    copyBtn.classList.add('copied');
                    copyIcon.className = 'bi bi-check2';
                    copyText.innerText = 'Tersalin!';
                    setTimeout(() => {
                        copyBtn.classList.remove('copied');
                        copyIcon.className = 'bi bi-clipboard';
                        copyText.innerText = 'Salin';
                    }, 2500);
                }
                if (toast) {
                    toast.classList.add('show');
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 2800);
                }
            });
        }
    }

    // Live Real-Time Dynamic Clock & Greeting (WIB / GMT+7)
    (function initLiveTimeTicker() {
        const greetingEl = document.getElementById('liveGreetingText');
        const clockEl = document.getElementById('liveClockText');
        const userName = @json(auth()->user()->name);

        function updateTime() {
            const now = new Date();
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const wibTime = new Date(utc + (3600000 * 7));

            const hours = wibTime.getHours();
            const minutes = String(wibTime.getMinutes()).padStart(2, '0');
            const seconds = String(wibTime.getSeconds()).padStart(2, '0');

            let greeting = 'Selamat Malam';
            if (hours >= 4 && hours < 11) {
                greeting = 'Selamat Pagi';
            } else if (hours >= 11 && hours < 15) {
                greeting = 'Selamat Siang';
            } else if (hours >= 15 && hours < 18) {
                greeting = 'Selamat Sore';
            }

            if (greetingEl) {
                greetingEl.textContent = `${greeting}, ${userName}`;
            }
            if (clockEl) {
                clockEl.textContent = `${String(hours).padStart(2, '0')}:${minutes}:${seconds} WIB`;
            }
        }

        updateTime();
        setInterval(updateTime, 1000);
    })();
</script>
@endpush
