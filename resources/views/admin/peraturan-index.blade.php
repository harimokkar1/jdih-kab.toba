@extends('layouts.admin')

@section('title', 'Dokumen Produk Hukum')
@section('breadcrumb', 'Dokumen Peraturan')
@section('page-title', 'Dokumen Produk Hukum')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Dokumen Produk Hukum</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Satu Data JDIHN BPHN
            </span>
        </div>
        <p class="admin-page-subtitle">Kelola arsip peraturan daerah, keputusan bupati, instruksi, dan naskah hukum resmi Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('admin.peraturan.create') }}" class="btn-admin-primary">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Peraturan Baru</span>
        </a>
    </div>
</div>

<!-- ============================================================
     FILTER & PENCARIAN DOKUMEN
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="p-3 p-md-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-funnel-fill text-primary"></i>
            <span class="small fw-bold text-dark">Filter &amp; Penelusuran Dokumen</span>
        </div>
        <form action="{{ route('admin.peraturan.index') }}" method="GET">
            <div class="row g-2 align-items-end">
                <div class="col-lg-5 col-md-4">
                    <label class="form-label small fw-semibold text-secondary mb-1">Cari Judul / Nomor</label>
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
                        <input type="text" name="search" class="form-control form-control-sm ps-5" placeholder="Kata kunci judul, nomor, atau tahun..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Jenis Peraturan</label>
                    <select name="jenis_id" class="form-select form-select-sm">
                        <option value="">Semua Jenis Klasifikasi</option>
                        @foreach($jenisList as $j)
                            <option value="{{ $j->id }}" {{ request('jenis_id') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2">
                    <label class="form-label small fw-semibold text-secondary mb-1">Status Keberlakuan</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Semua Status</option>
                        <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                        <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-admin-primary flex-grow-1 justify-content-center">
                        <i class="bi bi-funnel"></i>
                        <span>Filter</span>
                    </button>
                    @if(request()->hasAny(['search', 'jenis_id', 'status']))
                        <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-light border px-3" title="Reset Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     TABEL DOKUMEN PRODUK HUKUM
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Naskah Regulasi Daerah</h6>
            <span class="badge bg-light text-dark border px-2">{{ $peraturans->total() }} Dokumen</span>
        </div>
        <span class="admin-header-badge d-none d-sm-inline-flex">
            <i class="bi bi-patch-check-fill text-primary"></i>
            Standar BPHN Kemenkumham RI
        </span>
    </div>

    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 50px;">No</th>
                    <th>Judul Peraturan</th>
                    <th style="width: 170px;">Klasifikasi</th>
                    <th style="width: 170px;">Nomor &amp; Tahun</th>
                    <th style="width: 130px;">Status</th>
                    <th style="width: 110px;">Lampiran</th>
                    <th class="text-end pe-4" style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peraturans as $index => $item)
                    @php
                        $jenisSlug = Str::slug($item->jenisPeraturan->nama ?? '');
                        $badgeClass = 'badge-tag-default';
                        if (str_contains($jenisSlug, 'daerah') || str_contains($jenisSlug, 'perda')) {
                            $badgeClass = 'badge-tag-perda';
                        } elseif (str_contains($jenisSlug, 'perbup') || str_contains($jenisSlug, 'peraturan-bupati')) {
                            $badgeClass = 'badge-tag-perbup';
                        } elseif (str_contains($jenisSlug, 'kepbup') || str_contains($jenisSlug, 'keputusan')) {
                            $badgeClass = 'badge-tag-kepbup';
                        } elseif (str_contains($jenisSlug, 'inbup') || str_contains($jenisSlug, 'instruksi')) {
                            $badgeClass = 'badge-tag-inbup';
                        }
                    @endphp
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $peraturans->firstItem() + $index }}</span>
                        </td>
                        <td>
                            <strong class="text-dark d-block" title="{{ $item->judul }}">
                                {{ Str::limit($item->judul, 72) }}
                            </strong>
                            <div class="d-flex align-items-center gap-2 mt-1 small text-muted">
                                <span><i class="bi bi-calendar3 me-1"></i>{{ $item->tanggal_upload ? $item->tanggal_upload->format('d/m/Y') : '-' }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-eye me-1"></i>{{ number_format($item->view_count) }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-download me-1"></i>{{ number_format($item->download_count) }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="{{ $badgeClass }}">
                                {{ $item->jenisPeraturan->nama ?? 'Peraturan' }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-bold text-dark small d-block">No. {{ $item->nomor_peraturan ?? '-' }}</span>
                            <small class="text-muted">Tahun {{ $item->tahun ?? '-' }}</small>
                        </td>
                        <td>
                            @if($item->status === 'BERLAKU')
                                <span class="badge-status-pill status-active">
                                    <span class="status-dot status-dot-emerald"></span>
                                    Berlaku
                                </span>
                            @else
                                <span class="badge-status-pill status-inactive">
                                    <span class="status-dot status-dot-rose"></span>
                                    Tidak Berlaku
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                <span class="badge-doc-pdf" title="Naskah PDF Utama">
                                    <i class="bi bi-file-earmark-pdf"></i> PDF
                                </span>
                                @if($item->english_version)
                                    <span class="badge bg-light text-primary border" title="English Version">EN</span>
                                @endif
                                @if($item->braille)
                                    <span class="badge bg-light text-warning-emphasis border" title="Akses Braille">BRL</span>
                                @endif
                                @if($item->alih_suara)
                                    <span class="badge bg-light text-success border" title="Alih Suara (Audio)">AUD</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('user.produk-hukum.detail', $item->id) }}" target="_blank" class="btn-action-icon btn-action-view" title="Pratinjau Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.peraturan.edit', $item->id) }}" class="btn-action-icon btn-action-edit" title="Edit Dokumen">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}" title="Hapus Dokumen">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                        </td>
                    </tr>

                    <!-- MODAL HAPUS -->
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.peraturan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Dokumen
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus naskah peraturan hukum berikut beserta berkas lampirannya?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small mb-1">{{ $item->judul }}</strong>
                                            <span class="badge bg-light text-muted border">No. {{ $item->nomor_peraturan }} / {{ $item->tahun }}</span>
                                        </div>
                                        <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                    </div>
                                    <div class="modal-footer border-top py-2">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-danger px-3">Ya, Hapus Dokumen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-x fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada dokumen peraturan yang sesuai kriteria pencarian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($peraturans->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="small text-muted">
                Menampilkan data {{ $peraturans->firstItem() }} - {{ $peraturans->lastItem() }} dari {{ $peraturans->total() }} peraturan
            </span>
            <div>
                {{ $peraturans->links() }}
            </div>
        </div>
    @endif
</div>

@endsection
