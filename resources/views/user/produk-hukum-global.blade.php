@extends('layouts.app')

@section('title', 'Produk Hukum - JDIH Kabupaten Toba')

@section('content')
<!-- HEADER -->
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Produk Hukum</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-journal-text text-primary me-2"></i> Produk Hukum Kabupaten Toba</h2>
        <p class="text-muted small mb-0 mt-1">Daftar lengkap klasifikasi jenis produk hukum dan kumpulan dokumentasi peraturan daerah</p>
    </div>
</div>

<div class="container py-4">

    <!-- ============================================================
         TABEL JENIS PRODUK HUKUM & JUMLAH PERATURAN (Requirement #4)
         ============================================================ -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
        <div class="card-header bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="bi bi-grid-fill me-2"></i> Rekapitulasi Jenis Produk Hukum</h5>
            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">Total: {{ $jenisPeraturans->sum('peraturans_count') }} Dokumen</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4" style="width: 60px;">No</th>
                        <th>Jenis Produk Hukum</th>
                        <th>Singkatan</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width: 160px;">Jumlah Peraturan</th>
                        <th class="text-end pe-4" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisPeraturans as $index => $item)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('user.produk-hukum.jenis', $item->slug) }}" class="fw-bold text-dark text-decoration-none hover-primary">
                                    <i class="bi bi-folder2-open text-primary me-2"></i> {{ $item->nama }}
                                </a>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $item->singkatan ?: '-' }}</span></td>
                            <td class="small text-muted">{{ Str::limit($item->deskripsi, 80) ?: 'Dokumen ' . $item->nama . ' Kabupaten Toba' }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
                                    {{ number_format($item->peraturans_count, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('user.produk-hukum.jenis', $item->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    Buka Daftar <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data jenis produk hukum.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============================================================
         DAFTAR SEMUA DOKUMEN PRODUK HUKUM TERBARU
         ============================================================ -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
        <div>
            <h4 class="fw-bold mb-0">Seluruh Dokumen Peraturan</h4>
            <small class="text-muted">Menampilkan {{ $peraturans->firstItem() ?? 0 }} - {{ $peraturans->lastItem() ?? 0 }} dari total {{ $peraturans->total() }} peraturan</small>
        </div>

        <!-- Mini Search -->
        <form action="{{ route('user.produk-hukum.global') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul..." value="{{ request('search') }}">
            <button class="btn btn-sm btn-primary px-3 rounded-pill" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <div class="row g-3">
        @forelse($peraturans as $p)
            <div class="col-lg-6">
                <div class="doc-card h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge-jenis">{{ $p->jenisPeraturan->nama ?? 'Peraturan' }}</span>
                            <span class="{{ $p->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                {{ $p->status }}
                            </span>
                        </div>
                        <h6 class="fw-bold mb-2">
                            <a href="{{ route('user.produk-hukum.detail', $p->id) }}" class="text-decoration-none text-dark hover-primary">
                                {{ $p->judul }}
                            </a>
                        </h6>
                        <div class="small text-muted mb-2 d-flex flex-wrap gap-3">
                            <span><i class="bi bi-hash"></i> No: {{ $p->nomor_peraturan ?? '-' }}</span>
                            <span><i class="bi bi-calendar"></i> Tahun: {{ $p->tahun ?? '-' }}</span>
                            <span><i class="bi bi-eye"></i> {{ $p->view_count }}x dilihat</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 border-top pt-2 mt-2">
                        <a href="{{ route('user.produk-hukum.detail', $p->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                            Detail Peraturan
                        </a>
                        <a href="{{ route('user.produk-hukum.download', $p->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                            <i class="bi bi-download"></i> Unduh PDF
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-4 text-muted bg-white rounded-3 border">
                Tidak ada dokumen peraturan yang ditemukan.
            </div>
        @endforelse
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $peraturans->links() }}
    </div>

</div>
@endsection
