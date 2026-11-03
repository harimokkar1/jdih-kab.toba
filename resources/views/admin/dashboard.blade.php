@extends('layouts.admin')

@section('title', 'Dasbor Utama')
@section('page-title', 'Dasbor Administrasi')

@section('content')
<!-- KARTU STATISTIK UTAMA -->
<div class="row g-3 mb-4">
    <!-- TOTAL PRODUK HUKUM -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-semibold">Total Produk Hukum</span>
                    <h3 class="fw-bold text-primary mb-0 mt-1">{{ number_format($totalPeraturan, 0, ',', '.') }}</h3>
                    <small class="text-success"><i class="bi bi-tags me-1"></i> {{ $totalJenis }} Kategori Jenis</small>
                </div>
                <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary fs-3">
                    <i class="bi bi-file-earmark-ruled-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- TOTAL BERITA -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-semibold">Berita Hukum</span>
                    <h3 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalBerita, 0, ',', '.') }}</h3>
                    <small class="text-muted">Artikel dipublikasikan</small>
                </div>
                <div class="rounded-3 bg-info bg-opacity-10 p-3 text-info fs-3">
                    <i class="bi bi-newspaper"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- TOTAL PENGUMUMAN -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-semibold">Pengumuman</span>
                    <h3 class="fw-bold text-dark mb-0 mt-1">{{ number_format($totalPengumuman, 0, ',', '.') }}</h3>
                    <small class="text-muted">Informasi publik</small>
                </div>
                <div class="rounded-3 bg-warning bg-opacity-10 p-3 text-warning fs-3">
                    <i class="bi bi-megaphone-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- PENGUNJUNG TOTAL -->
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small fw-semibold">Total Pengunjung</span>
                    <h3 class="fw-bold text-success mb-0 mt-1">{{ number_format($visitorStats['total'] ?? 0, 0, ',', '.') }}</h3>
                    <small class="text-muted"><span class="text-success fw-bold">{{ $visitorStats['online'] ?? 1 }}</span> Online saat ini</small>
                </div>
                <div class="rounded-3 bg-success bg-opacity-10 p-3 text-success fs-3">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QUICK ACTIONS & STATISTIK KUNJUNGAN -->
<div class="row g-4 mb-4">
    <!-- STATISTIK KUNJUNGAN DETIL -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-bar-chart-line text-primary me-2"></i> Rekapitulasi Pengunjung (Web JDIH)</h6>
            <div class="list-group list-group-flush">
                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2 border-0">
                    <span class="text-muted"><i class="bi bi-circle-fill text-success me-2" style="font-size: 8px;"></i> Sedang Online</span>
                    <span class="fw-bold text-success">{{ $visitorStats['online'] ?? 1 }} Pengguna</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                    <span class="text-muted"><i class="bi bi-calendar-check text-info me-2"></i> Kunjungan Hari Ini</span>
                    <span class="fw-bold">{{ number_format($visitorStats['hari_ini'] ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                    <span class="text-muted"><i class="bi bi-calendar-minus text-secondary me-2"></i> Kunjungan Kemarin</span>
                    <span class="fw-bold">{{ number_format($visitorStats['kemarin'] ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                    <span class="text-muted"><i class="bi bi-calendar3 text-warning me-2"></i> Kunjungan Minggu Ini</span>
                    <span class="fw-bold">{{ number_format($visitorStats['minggu_ini'] ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                    <span class="text-muted"><i class="bi bi-globe text-primary me-2"></i> Total Akumulasi Kunjungan</span>
                    <span class="fw-bold text-primary">{{ number_format($visitorStats['total'] ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="mt-4 pt-2 border-top">
                <a href="{{ route('api.jdihn.index') }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill w-100">
                    <i class="bi bi-code-slash me-1"></i> Cek Endpoint JSON API JDIHN
                </a>
            </div>
        </div>
    </div>

    <!-- PINTASAN AKSI CEPAT -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
            <h6 class="fw-bold text-dark mb-3"><i class="bi bi-lightning-charge text-warning me-2"></i> Akses Cepat Kelola Dokumen</h6>
            <div class="row g-3">
                <div class="col-sm-6">
                    <a href="{{ route('admin.peraturan.create') }}" class="p-3 border rounded-3 d-flex align-items-center gap-3 text-decoration-none text-dark hover-shadow bg-light">
                        <div class="rounded-circle bg-primary text-white p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-plus-lg fs-5"></i>
                        </div>
                        <div>
                            <span class="fw-bold d-block">Tambah Peraturan</span>
                            <small class="text-muted">Upload dokumen baru</small>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.jenis-peraturan.index') }}" class="p-3 border rounded-3 d-flex align-items-center gap-3 text-decoration-none text-dark hover-shadow bg-light">
                        <div class="rounded-circle bg-success text-white p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-tags fs-5"></i>
                        </div>
                        <div>
                            <span class="fw-bold d-block">Jenis Peraturan</span>
                            <small class="text-muted">Kelola jenis hukum</small>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.berita') }}" class="p-3 border rounded-3 d-flex align-items-center gap-3 text-decoration-none text-dark hover-shadow bg-light">
                        <div class="rounded-circle bg-info text-white p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-newspaper fs-5"></i>
                        </div>
                        <div>
                            <span class="fw-bold d-block">Kelola Berita</span>
                            <small class="text-muted">Publikasi artikel</small>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.carousel') }}" class="p-3 border rounded-3 d-flex align-items-center gap-3 text-decoration-none text-dark hover-shadow bg-light">
                        <div class="rounded-circle bg-danger text-white p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-images fs-5"></i>
                        </div>
                        <div>
                            <span class="fw-bold d-block">Kelola Carousel</span>
                            <small class="text-muted">Banner halaman depan</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DOKUMEN PERATURAN TERAKHIR DITAMBAHKAN -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-bold text-dark"><i class="bi bi-clock-history me-2 text-primary"></i> Dokumen Peraturan Terakhir Diunggah</h6>
        <a href="{{ route('admin.peraturan.index') }}" class="small text-primary text-decoration-none fw-semibold">Lihat Semua Peraturan &rarr;</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4">Judul Dokumen</th>
                    <th>Jenis</th>
                    <th>Nomor & Tahun</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peraturanTerbaru as $pt)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-dark d-block">{{ Str::limit($pt->judul, 70) }}</span>
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Upload: {{ $pt->tanggal_upload ? $pt->tanggal_upload->format('d/m/Y') : '-' }}</small>
                        </td>
                        <td><span class="badge-jenis">{{ $pt->jenisPeraturan->nama ?? 'Peraturan' }}</span></td>
                        <td>
                            <span class="fw-semibold">{{ $pt->nomor_peraturan ?? '-' }}</span><br>
                            <small class="text-muted">Thn {{ $pt->tahun ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="{{ $pt->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                {{ $pt->status }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('user.produk-hukum.detail', $pt->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Buka Pratinjau">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.peraturan.edit', $pt->id) }}" class="btn btn-sm btn-outline-warning text-dark" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data dokumen peraturan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
