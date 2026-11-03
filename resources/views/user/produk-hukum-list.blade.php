@extends('layouts.app')

@section('title', $jenis->nama . ' - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.produk-hukum.global') }}">Produk Hukum</a></li>
                <li class="breadcrumb-item active">{{ $jenis->nama }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-1"><i class="bi bi-folder-fill text-primary me-2"></i> {{ $jenis->nama }}</h2>
                <p class="text-muted small mb-0">{{ $jenis->deskripsi ?: 'Kumpulan dokumen resmi ' . $jenis->nama . ' Kabupaten Toba' }}</p>
            </div>
            <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill d-none d-md-inline-block">
                {{ $peraturans->total() }} Dokumen
            </span>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- FILTER -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
        <form action="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" method="GET">
            <div class="row g-2 align-items-end">
                <div class="col-lg-6 col-md-5">
                    <label class="form-label small fw-bold mb-1">Cari Judul / Nomor</label>
                    <input type="text" name="search" class="form-control" placeholder="Kata kunci..." value="{{ request('search') }}">
                </div>
                <div class="col-lg-3 col-md-3">
                    <label class="form-label small fw-bold mb-1">Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunList as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label small fw-bold mb-1">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                        <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                    </select>
                </div>
                <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                    <button type="submit" class="btn btn-primary px-4 rounded-pill btn-sm">
                        <i class="bi bi-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('user.produk-hukum.jenis', $jenis->slug) }}" class="btn btn-outline-secondary px-3 rounded-pill btn-sm">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- DAFTAR DOKUMEN -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted small text-uppercase">
                    <tr>
                        <th class="ps-4" style="width: 50px;">No</th>
                        <th>Judul Dokumen Peraturan</th>
                        <th style="width: 130px;">Nomor & Tahun</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 100px;">Dilihat</th>
                        <th class="text-end pe-4" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peraturans as $index => $item)
                        <tr>
                            <td class="ps-4 fw-bold text-muted">{{ $peraturans->firstItem() + $index }}</td>
                            <td>
                                <a href="{{ route('user.produk-hukum.detail', $item->id) }}" class="fw-bold text-dark text-decoration-none hover-primary d-block">
                                    {{ $item->judul }}
                                </a>
                                @if($item->teu_badan)
                                    <small class="text-muted"><i class="bi bi-building me-1"></i> {{ $item->teu_badan }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold">No. {{ $item->nomor_peraturan ?? '-' }}</span><br>
                                <small class="text-muted">Thn {{ $item->tahun ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="{{ $item->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td><small class="text-muted">{{ $item->view_count }}x</small></td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('user.produk-hukum.detail', $item->id) }}" class="btn btn-sm btn-primary rounded-pill px-3" title="Detail">
                                        Detail
                                    </a>
                                    <a href="{{ route('user.produk-hukum.download', $item->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-2" title="Unduh PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                Belum ada peraturan untuk kategori ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $peraturans->links() }}
    </div>
</div>
@endsection
