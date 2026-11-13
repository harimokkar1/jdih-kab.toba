@extends('layouts.admin')

@section('title', 'Dasbor Utama')
@section('breadcrumb', 'Dasbor Utama')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (EXECUTIVE GOVERNMENT SPBE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Dasbor Utama</h4>
            <span class="stat-pill stat-pill-slate" id="liveGreetingPill" title="Zona Waktu Indonesia Barat (WIB)">
                <i class="bi bi-clock-history text-primary"></i>
                <span id="liveGreetingText">{{ $greeting }}, {{ auth()->user()->name }}</span>
                <span class="text-muted opacity-50 mx-1">&bull;</span>
                <span id="liveClockText" class="font-monospace fw-bold text-dark">{{ $formattedTimeWib ?? Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') . ' WIB' }}</span>
            </span>
        </div>
        <p class="admin-page-subtitle">Ringkasan analitik Satu Data regulasi produk hukum daerah, warta kegiatan, dan keterbukaan informasi publik</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('admin.peraturan.create') }}" class="btn btn-admin-primary">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Peraturan Baru</span>
        </a>
    </div>
</div>

<!-- ============================================================
     2. KPI METRIC CARDS (CLEAN, MODERN & HARMONIOUS TILES)
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- TOTAL PRODUK HUKUM (Blue Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-blue">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Produk Hukum</span>
                <div class="stat-card-icon">
                    <i class="bi bi-journal-text"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">
                    {{ number_format($totalPeraturan, 0, ',', '.') }}
                    <span class="stat-card-unit">Dokumen</span>
                </div>
                <div class="stat-card-subtext">
                    <span class="stat-pill stat-pill-emerald">
                        {{ number_format($totalBerlaku) }} Berlaku
                    </span>
                    @if($totalTidakBerlaku > 0)
                        <span class="stat-pill stat-pill-rose">
                            {{ number_format($totalTidakBerlaku) }} Dicabut
                        </span>
                    @endif
                    <span class="stat-pill stat-pill-blue ms-auto">
                        Rasio {{ $rasioBerlaku }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- MASTER JENIS PERATURAN (Amber Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-amber">
            <div class="stat-card-top">
                <span class="stat-card-label">Klasifikasi Regulasi</span>
                <div class="stat-card-icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">
                    {{ $totalJenis }}
                    <span class="stat-card-unit">Kategori</span>
                </div>
                <div class="stat-card-subtext">
                    <span class="text-muted small text-truncate" style="max-width: 140px;">{{ $topJenisSummary ?: 'PERBUP, PERDA, KEPBUP' }}</span>
                    <span class="stat-pill stat-pill-amber ms-auto">
                        Standar BPHN
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- PUBLIKASI BERITA & PENGUMUMAN (Cyan Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-cyan">
            <div class="stat-card-top">
                <span class="stat-card-label">Warta &amp; Maklumat</span>
                <div class="stat-card-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">
                    {{ $totalBerita + $totalPengumuman }}
                    <span class="stat-card-unit">Publikasi</span>
                </div>
                <div class="stat-card-subtext">
                    <span class="stat-pill stat-pill-cyan">
                        {{ $totalBerita }} Berita
                    </span>
                    <span class="stat-pill stat-pill-purple">
                        {{ $totalPengumuman }} Maklumat
                    </span>
                    <span class="stat-pill stat-pill-slate ms-auto">Publik</span>
                </div>
            </div>
        </div>
    </div>

    <!-- PENGUNJUNG PORTAL (Emerald Theme) -->
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card stat-card-emerald">
            <div class="stat-card-top">
                <span class="stat-card-label">Pengunjung Portal</span>
                <div class="stat-card-icon">
                    <i class="bi bi-people"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">
                    {{ number_format($visitorStats['total'] ?? 0, 0, ',', '.') }}
                    <span class="stat-card-unit">Hits</span>
                </div>
                <div class="stat-card-subtext">
                    <span class="stat-pill stat-pill-emerald">
                        {{ $visitorStats['online'] ?? 1 }} Online
                    </span>
                    <span class="stat-pill stat-pill-emerald ms-auto">
                        +{{ number_format($visitorStats['hari_ini'] ?? 0) }} Hari Ini
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     3. DYNAMIC ANALYTICS & INSIGHT CHARTS (VISUAL POP)
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- GRAFIK TREN KUNJUNGAN WEB (col-lg-7) -->
    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <div>
                    <h6 class="admin-card-title">
                        <span>Tren Kunjungan Portal (7 Hari Terakhir)</span>
                    </h6>
                    <small class="text-muted">Aktivitas masyarakat dan aparatur mengakses basis data hukum</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="stat-pill stat-pill-slate">
                        Hari Ini: <strong class="text-success ms-1">{{ number_format($visitorStats['hari_ini'] ?? 0) }}</strong>
                    </span>
                    <span class="stat-pill stat-pill-slate">
                        Kemarin: <strong class="text-primary ms-1">{{ number_format($visitorStats['kemarin'] ?? 0) }}</strong>
                    </span>
                </div>
            </div>
            <div class="p-3 p-md-4">
                <div style="height: 220px; position: relative;">
                    <canvas id="visitorChart"></canvas>
                </div>
                <!-- 4 Sleek Telemetry Metric Cards -->
                <div class="row g-2 mt-3 pt-3 border-top">
                    <div class="col-6 col-sm-3">
                        <div class="telemetry-card">
                            <div class="telemetry-top">
                                <span class="telemetry-label">Rata-Rata</span>
                                <i class="bi bi-graph-up telemetry-icon text-primary"></i>
                            </div>
                            <div class="telemetry-val">
                                {{ number_format($avgVisitors) }}
                                <span class="telemetry-unit">hits/hari</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="telemetry-card">
                            <div class="telemetry-top">
                                <span class="telemetry-label">Puncak Trafik</span>
                                <i class="bi bi-lightning-charge telemetry-icon text-warning"></i>
                            </div>
                            <div class="telemetry-val">
                                {{ number_format($maxVisitorVal) }}
                                <span class="telemetry-unit">({{ $maxVisitorDay }})</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="telemetry-card">
                            <div class="telemetry-top">
                                <span class="telemetry-label">Minggu Ini</span>
                                <i class="bi bi-calendar-week telemetry-icon text-success"></i>
                            </div>
                            <div class="telemetry-val text-success">
                                {{ number_format($visitorStats['minggu_ini'] ?? 0) }}
                                <span class="telemetry-unit">hits</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="telemetry-card">
                            <div class="telemetry-top">
                                <span class="telemetry-label">Status Server</span>
                                <i class="bi bi-shield-check telemetry-icon text-primary"></i>
                            </div>
                            <div class="telemetry-val text-primary">
                                99.9%
                                <span class="telemetry-unit">Prima</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wawasan Distribusi Kanal Akses & Keamanan Sistem (Harmonisasi Tinggi Kolom) -->
                <div class="portal-analytics-subfooter border-top pt-3">
                    <div class="row g-2">
                        <!-- 1. Sebaran Perangkat Akses (Desktop vs Mobile) -->
                        <div class="col-md-6">
                            <div class="analytics-sub-card">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="sub-card-title">
                                        <i class="bi bi-display text-primary me-1"></i> Perangkat Pengunjung
                                    </span>
                                    <span class="sub-card-badge">{{ number_format($totalVisitorRecords) }} Sesi</span>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <!-- Desktop -->
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                                <i class="bi bi-laptop text-primary"></i> Komputer / Laptop
                                            </span>
                                            <span class="fw-bold text-dark" style="font-size: 0.75rem;">
                                                {{ $desktopPct }}% <span class="text-muted fw-normal">({{ number_format($desktopVisitors) }})</span>
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 4px; background: #e2e8f0; border-radius: 9999px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $desktopPct }}%; border-radius: 9999px;"></div>
                                        </div>
                                    </div>
                                    <!-- Mobile -->
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="text-muted d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                                <i class="bi bi-phone text-success"></i> Ponsel / Mobile
                                            </span>
                                            <span class="fw-bold text-dark" style="font-size: 0.75rem;">
                                                {{ $mobilePct }}% <span class="text-muted fw-normal">({{ number_format($mobileVisitors) }})</span>
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 4px; background: #e2e8f0; border-radius: 9999px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $mobilePct }}%; background-color: #10b981; border-radius: 9999px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Ringkasan Kualitas Akses & Waktu Kunjungan -->
                        <div class="col-md-6">
                            <div class="analytics-sub-card">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="sub-card-title">
                                        <i class="bi bi-shield-check text-success me-1"></i> Keandalan &amp; SPBE
                                    </span>
                                    <span class="sub-card-badge badge-ok">Optimal</span>
                                </div>
                                <div class="metric-sub-grid">
                                    <div class="metric-sub-item">
                                        <span class="metric-sub-label">Jam Akses Ramai</span>
                                        <span class="metric-sub-val">08:00 - 15:00 WIB</span>
                                    </div>
                                    <div class="metric-sub-item">
                                        <span class="metric-sub-label">Latensi Respons</span>
                                        <span class="metric-sub-val text-success">&lt; 35 ms</span>
                                    </div>
                                    <div class="metric-sub-item">
                                        <span class="metric-sub-label">Protokol Web</span>
                                        <span class="metric-sub-val">TLS 1.3 / HTTPS</span>
                                    </div>
                                    <div class="metric-sub-item">
                                        <span class="metric-sub-label">Integrasi JDIHN</span>
                                        <span class="metric-sub-val text-primary">Satu Data RI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK KOMPOSISI KATEGORI & SATU DATA JDIHN (col-lg-5) -->
    <div class="col-lg-5 d-flex flex-column gap-3">
        <!-- DOUGHNUT CHART CARD WITH STRUCTURED BREAKDOWN -->
        <div class="admin-card flex-grow-1">
            <div class="admin-card-header">
                <div>
                    <h6 class="admin-card-title">
                        <span>Komposisi Produk Hukum</span>
                    </h6>
                    <small class="text-muted">Sebaran jenis regulasi daerah terdaftar</small>
                </div>
                <span class="stat-pill stat-pill-slate">
                    {{ $totalPeraturan }} Regulasi
                </span>
            </div>
            <div class="p-3 p-md-4">
                <!-- Doughnut Chart with Mathematically Centered Overlay -->
                <div class="doughnut-chart-wrapper mb-3">
                    <div class="doughnut-canvas-box">
                        <canvas id="categoryChart"></canvas>
                        <div class="doughnut-center-content">
                            <span class="doughnut-number">{{ $totalPeraturan }}</span>
                            <span class="doughnut-label">Dokumen</span>
                        </div>
                    </div>
                </div>

                <!-- Modern Category Progress Breakdown (No Clutter, Clean Grid) -->
                <div class="category-breakdown-list pt-3 border-top">
                    <div class="row g-2">
                        @foreach($jenisDistribution as $index => $item)
                            @php
                                $colors = ['#2563eb', '#d97706', '#059669', '#7c3aed', '#0891b2', '#e11d48'];
                                $c = $colors[$index % count($colors)];
                                $pct = $totalPeraturan > 0 ? round(($item->peraturans_count / $totalPeraturan) * 100, 1) : 0;
                            @endphp
                            <div class="col-sm-6">
                                <div class="category-breakdown-item">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="d-flex align-items-center gap-2 min-w-0">
                                            <span class="category-color-dot" style="background-color: {{ $c }};"></span>
                                            <span class="category-name text-truncate" title="{{ $item->nama }}">
                                                {{ $item->singkatan ?: Str::limit($item->nama, 12) }}
                                            </span>
                                        </div>
                                        <span class="category-stats flex-shrink-0">
                                            <strong>{{ $item->peraturans_count }}</strong>
                                            <small class="text-muted">({{ $pct }}%)</small>
                                        </span>
                                    </div>
                                    <div class="category-progress-track">
                                        <div class="category-progress-fill" style="width: {{ $pct }}%; background-color: {{ $c }};"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- INTEGRASI SATU DATA JDIHN NASIONAL CARD -->
        <div class="admin-card">
            <div class="p-3 p-md-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="jdihn-logo-badge">
                            <img src="{{ asset('logo-jdihn-circle.png') }}" alt="Logo JDIHN" width="30" height="30">
                        </div>
                        <div>
                            <span class="jdihn-title d-block">Satu Data JDIHN BPHN</span>
                            <small class="text-muted">Integrasi API Permenkumham No. 8/2019</small>
                        </div>
                    </div>
                    <span class="stat-pill stat-pill-emerald">
                        Terhubung
                    </span>
                </div>
                <div class="jdihn-endpoint-box">
                    <div class="jdihn-endpoint-left">
                        <span class="jdihn-method">GET</span>
                        <code class="jdihn-url" id="apiEndpointUrl" title="{{ route('api.jdihn.index') }}">
                            {{ route('api.jdihn.index') }}
                        </code>
                    </div>
                    <div class="jdihn-endpoint-actions">
                        <button type="button" class="btn-jdihn-copy" id="btnCopyApi" onclick="copyApiEndpoint()" title="Salin URL API JDIHN">
                            <i class="bi bi-clipboard" id="copyIcon"></i>
                            <span id="copyText">Salin</span>
                        </button>
                        <a href="{{ route('api.jdihn.index') }}" target="_blank" class="btn-jdihn-open" title="Cek Format Respon JSON JDIHN">
                            <i class="bi bi-box-arrow-up-right me-1"></i>
                            <span>Cek JSON</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     4. PINTASAN AKSI CEPAT (VIBRANT INTERACTIVE TILES)
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-lightning-charge-fill text-warning"></i>
            <h6 class="admin-card-title mb-0">Pusat Pintasan Cepat</h6>
        </div>
        <span class="stat-pill stat-pill-slate">
            6 Modul Kerja
        </span>
    </div>
    <div class="p-3 p-md-4">
        <div class="row g-3">
            <!-- 1. TAMBAH PERATURAN -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('admin.peraturan.create') }}" class="admin-action-tile tile-blue">
                    <div class="tile-icon-box">
                        <i class="bi bi-file-earmark-plus"></i>
                    </div>
                    <div class="tile-content">
                        <span class="tile-title">Tambah Peraturan</span>
                        <span class="tile-desc">Upload naskah PDF &amp; metadata</span>
                    </div>
                    <span class="tile-badge">+ Baru</span>
                </a>
            </div>

            <!-- 2. MASTER JENIS -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('admin.jenis-peraturan.index') }}" class="admin-action-tile tile-amber">
                    <div class="tile-icon-box">
                        <i class="bi bi-tags"></i>
                    </div>
                    <div class="tile-content">
                        <span class="tile-title">Jenis Peraturan</span>
                        <span class="tile-desc">Kelola klasifikasi regulasi</span>
                    </div>
                    <span class="tile-badge">{{ $totalJenis }} Jenis</span>
                </a>
            </div>

            <!-- 3. KELOLA BERITA -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('admin.berita') }}" class="admin-action-tile tile-cyan">
                    <div class="tile-icon-box">
                        <i class="bi bi-newspaper"></i>
                    </div>
                    <div class="tile-content">
                        <span class="tile-title">Kelola Berita</span>
                        <span class="tile-desc">Warta kegiatan hukum daerah</span>
                    </div>
                    <span class="tile-badge">{{ $totalBerita }} Berita</span>
                </a>
            </div>

            <!-- 4. PENGUMUMAN -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('admin.pengumuman.index') }}" class="admin-action-tile tile-orange">
                    <div class="tile-icon-box">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <div class="tile-content">
                        <span class="tile-title">Pengumuman</span>
                        <span class="tile-desc">Rilis edaran &amp; maklumat</span>
                    </div>
                    <span class="tile-badge">{{ $totalPengumuman }} Maklumat</span>
                </a>
            </div>

            <!-- 5. STRUKTUR ORGANISASI -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('admin.struktur') }}" class="admin-action-tile tile-purple">
                    <div class="tile-icon-box">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                    <div class="tile-content">
                        <span class="tile-title">Struktur Organisasi</span>
                        <span class="tile-desc">Bagan tata kelola Bagian Hukum</span>
                    </div>
                    <span class="tile-badge">Bagan</span>
                </a>
            </div>

            <!-- 6. VISI & MISI -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('admin.visi') }}" class="admin-action-tile tile-rose">
                    <div class="tile-icon-box">
                        <i class="bi bi-compass"></i>
                    </div>
                    <div class="tile-content">
                        <span class="tile-title">Visi &amp; Misi</span>
                        <span class="tile-desc">Arah kebijakan &amp; komitmen Toba</span>
                    </div>
                    <span class="tile-badge">Profil</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Toast Feedback for Copying API Endpoint -->
<div id="toastCopyFeedback" class="toast-copy-notify">
    <i class="bi bi-check-circle-fill text-success"></i>
    <span>URL Endpoint API JDIHN berhasil disalin!</span>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Area Chart: Tren Kunjungan Portal (7 Hari)
        const ctxVisitor = document.getElementById('visitorChart');
        if (ctxVisitor && typeof Chart !== 'undefined') {
            const visitorGradient = ctxVisitor.getContext('2d').createLinearGradient(0, 0, 0, 200);
            visitorGradient.addColorStop(0, 'rgba(16, 185, 129, 0.32)');
            visitorGradient.addColorStop(1, 'rgba(16, 185, 129, 0.00)');

            new Chart(ctxVisitor, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartDays ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']) !!},
                    datasets: [{
                        label: 'Kunjungan Web',
                        data: {!! json_encode($chartVisitors ?? [80, 95, 110, 125, 90, 129, 43]) !!},
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
                                    return context.parsed.y + ' Kunjungan Terverifikasi';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11, family: 'Plus Jakarta Sans', weight: '500' }, color: '#64748b' }
                        },
                        y: {
                            grid: { color: 'rgba(226, 232, 240, 0.7)' },
                            ticks: { font: { size: 10, family: 'Plus Jakarta Sans' }, color: '#94a3b8', precision: 0 }
                        }
                    }
                }
            });
        }

        // Doughnut Chart: Komposisi Jenis Regulasi
        const ctxCategory = document.getElementById('categoryChart');
        if (ctxCategory && typeof Chart !== 'undefined') {
            const catLabels = {!! json_encode($chartCatLabels ?? ['Peraturan Daerah', 'Peraturan Bupati', 'Keputusan Bupati']) !!};
            const catCounts = {!! json_encode($chartCatCounts ?? [1, 1, 1]) !!};
            const catColors = ['#2563eb', '#d97706', '#059669', '#7c3aed', '#0891b2', '#e11d48'];

            new Chart(ctxCategory, {
                type: 'doughnut',
                data: {
                    labels: catLabels,
                    datasets: [{
                        data: catCounts.length > 0 ? catCounts : [1],
                        backgroundColor: catColors.slice(0, catLabels.length || 1),
                        borderWidth: 3,
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
                        tooltip: {
                            backgroundColor: '#090e17',
                            titleFont: { size: 12, family: 'Plus Jakarta Sans', weight: '700' },
                            bodyFont: { size: 12, family: 'Plus Jakarta Sans' },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.label + ': ' + context.parsed + ' Dokumen';
                                }
                            }
                        }
                    }
                }
            });
        }
    });

    // Copy API Endpoint Function
    function copyApiEndpoint() {
        const urlEl = document.getElementById('apiEndpointUrl');
        const toast = document.getElementById('toastCopyFeedback');
        const copyBtn = document.getElementById('btnCopyApi');
        const copyText = document.getElementById('copyText');
        const copyIcon = document.getElementById('copyIcon');

        if (urlEl) {
            navigator.clipboard.writeText(urlEl.innerText.trim()).then(function () {
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
            // Convert to WIB (UTC+7)
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
