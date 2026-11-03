@extends('layouts.app')

@section('title', 'Pencarian Dokumen Hukum - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Pencarian Dokumen</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-search text-primary me-2"></i> Pencarian Produk Hukum</h2>
    </div>
</div>

<div class="container py-4">
    <!-- FILTER BOX -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <form action="{{ route('user.cari') }}" method="GET">
            <div class="row g-3">
                <div class="col-lg-5 col-md-12">
                    <label class="form-label small fw-bold">Judul / Kata Kunci</label>
                    <input type="text" name="judul" class="form-control" placeholder="Cari judul..." value="{{ request('judul') ?? request('q') }}">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label small fw-bold">Jenis Dokumen</label>
                    <select name="jenis_peraturan_id" class="form-select">
                        <option value="">-- Semua Jenis --</option>
                        @foreach($jenisPeraturans as $jp)
                            <option value="{{ $jp->id }}" {{ request('jenis_peraturan_id') == $jp->id ? 'selected' : '' }}>
                                {{ $jp->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-3">
                    <label class="form-label small fw-bold">Nomor</label>
                    <input type="text" name="nomor_peraturan" class="form-control" placeholder="Nomor..." value="{{ request('nomor_peraturan') }}">
                </div>
                <div class="col-lg-2 col-md-3">
                    <label class="form-label small fw-bold">Tahun</label>
                    <select name="tahun" class="form-select">
                        <option value="">-- Semua --</option>
                        @foreach($tahunList as $th)
                            <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label small fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                        <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                    </select>
                </div>
                <div class="col-lg-9 col-md-8 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary px-4 fw-semibold rounded-pill">
                        <i class="bi bi-funnel me-1"></i> Terapkan Filter
                    </button>
                    <a href="{{ route('user.cari') }}" class="btn btn-outline-secondary px-3 rounded-pill">Reset</a>
                </div>
            </div>
        </form>
    </div>

    <!-- HASIL PENCARIAN -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Ditemukan {{ $peraturans->total() }} Dokumen</h5>
    </div>

    @if($peraturans->count() > 0)
        <div class="row g-3">
            @foreach($peraturans as $p)
                <div class="col-12">
                    <div class="doc-card">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-2 mb-2">
                            <div>
                                <span class="badge-jenis me-2">{{ $p->jenisPeraturan->nama ?? 'Peraturan' }}</span>
                                <span class="{{ $p->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                    {{ $p->status }}
                                </span>
                            </div>
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Ditetapkan: {{ $p->tanggal_penetapan ? $p->tanggal_penetapan->translatedFormat('d M Y') : ($p->tahun ?? '-') }}</small>
                        </div>
                        <h5 class="fw-bold mb-2">
                            <a href="{{ route('user.produk-hukum.detail', $p->id) }}" class="text-decoration-none text-dark hover-primary">
                                {{ $p->judul }}
                            </a>
                        </h5>
                        <p class="small text-muted mb-3">{{ Str::limit(strip_tags($p->abstrak ?: $p->subjek), 180) }}</p>
                        <div class="d-flex justify-content-between align-items-center border-top pt-2">
                            <div class="small text-muted d-flex gap-3">
                                <span><strong>No:</strong> {{ $p->nomor_peraturan ?? '-' }}</span>
                                <span><strong>Tahun:</strong> {{ $p->tahun ?? '-' }}</span>
                                <span><i class="bi bi-eye"></i> {{ $p->view_count }}</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('user.produk-hukum.detail', $p->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Detail</a>
                                <a href="{{ route('user.produk-hukum.download', $p->id) }}" class="btn btn-sm btn-success rounded-pill px-3"><i class="bi bi-download"></i> Unduh</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $peraturans->links() }}
        </div>
    @else
        <div class="text-center py-5 bg-white rounded-4 border">
            <i class="bi bi-search text-muted display-4 mb-3 d-block"></i>
            <h5 class="fw-bold">Tidak ada dokumen yang sesuai kriteria pencarian</h5>
            <p class="text-muted small">Coba gunakan kata kunci yang lebih umum atau atur ulang filter pencarian.</p>
            <a href="{{ route('user.cari') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Reset Pencarian</a>
        </div>
    @endif
</div>
@endsection
