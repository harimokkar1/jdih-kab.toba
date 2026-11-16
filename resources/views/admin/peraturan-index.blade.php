@extends('layouts.admin')

@section('title', 'Dokumen Produk Hukum')
@section('breadcrumb', 'Dokumen Peraturan')
@section('page-title', 'Dokumen Produk Hukum')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Dokumen Produk Hukum</h4>
            <span class="stat-pill stat-pill-slate" title="Standar Satu Data JDIHN BPHN">
                <span class="pulse-dot-emerald me-1"></span>
                Satu Data JDIHN BPHN
            </span>
        </div>
        <p class="admin-page-subtitle">Pusat inventarisasi, audit naskah digital, dan pengelolaan produk hukum daerah Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('admin.peraturan.create') }}" class="btn btn-admin-primary">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Peraturan Baru</span>
        </a>
    </div>
</div>

<!-- ============================================================
     2. FILTER & PENCARIAN TERPADU (COMPACT & INTUITIVE)
     ============================================================ -->
<div class="admin-card filter-card mb-4">
    <div class="p-3 p-md-3">
        <form action="{{ route('admin.peraturan.index') }}" method="GET" id="filterForm">
            <div class="row g-2 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label text-muted small fw-semibold mb-1">Cari Judul / Nomor</label>
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 0.8rem;"></i>
                        <input type="text" name="search" class="form-control form-control-sm ps-5" placeholder="Kata kunci judul, nomor, atau tahun..." value="{{ request('search') }}" style="border-radius: 8px;">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <label class="form-label text-muted small fw-semibold mb-1">Klasifikasi Regulasi</label>
                    <select name="jenis_id" class="form-select form-select-sm" style="border-radius: 8px;">
                        <option value="">Semua Jenis ({{ $totalAll ?? 0 }})</option>
                        @foreach($jenisList as $j)
                            <option value="{{ $j->id }}" {{ request('jenis_id') == $j->id ? 'selected' : '' }}>{{ $j->nama }} ({{ $j->singkatan }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-3">
                    <label class="form-label text-muted small fw-semibold mb-1">Status Keberlakuan</label>
                    <select name="status" class="form-select form-select-sm" style="border-radius: 8px;">
                        <option value="">Semua Status</option>
                        <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                        <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku / Dicabut</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-12 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary flex-grow-1 fw-medium d-inline-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; height: 35px;">
                        <i class="bi bi-funnel"></i>
                        <span>Terapkan Filter</span>
                    </button>
                    @if(request()->hasAny(['search', 'jenis_id', 'status', 'has_file']))
                        <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-outline-secondary px-3 d-inline-flex align-items-center" style="border-radius: 8px; height: 35px;" title="Reset Semua Filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     3. TABEL REGULASI MASTER (STANDARD EXECUTIVE REGISTRY)
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="admin-card-header card-header-compact">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0" style="font-size: 0.875rem;">
                <i class="bi bi-journal-text text-primary me-2"></i>Daftar Naskah Regulasi Daerah
            </h6>
            <span class="stat-pill stat-pill-slate py-0 px-2" style="font-size: 0.7rem; font-weight: 700;">
                {{ $peraturans->total() }} Dokumen
            </span>
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
                    <th style="width: 190px;" class="text-end pe-3">Aksi Cepat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peraturans as $item)
                    @php
                        $jenisSlug = Str::slug($item->jenisPeraturan->nama ?? '');
                        $pillClass = 'pill-type-default';
                        if (str_contains($jenisSlug, 'daerah') || str_contains($jenisSlug, 'perda')) {
                            $pillClass = 'pill-type-perda';
                        } elseif (str_contains($jenisSlug, 'perbup') || str_contains($jenisSlug, 'peraturan-bupati')) {
                            $pillClass = 'pill-type-perbup';
                        } elseif (str_contains($jenisSlug, 'kepbup') || str_contains($jenisSlug, 'keputusan')) {
                            $pillClass = 'pill-type-kepbup';
                        } elseif (str_contains($jenisSlug, 'inbup') || str_contains($jenisSlug, 'instruksi')) {
                            $pillClass = 'pill-type-inbup';
                        }
                    @endphp
                    <tr>
                        <td>
                            <span class="pill-type-badge {{ $pillClass }}">
                                {{ $item->jenisPeraturan->singkatan ?? 'REGULASI' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="registry-doc-badge">
                                    <i class="bi bi-hash text-primary"></i>Nomor {{ $item->nomor_peraturan ?: '-' }}
                                </span>
                                @if($item->tahun && !Str::contains((string)$item->nomor_peraturan, (string)$item->tahun))
                                    <span class="registry-doc-year-tag">&bull; Tahun {{ $item->tahun }}</span>
                                @endif
                            </div>
                            <a href="{{ route('admin.peraturan.edit', $item->id) }}" class="registry-title-link" title="{{ $item->judul }}">
                                {{ $item->judul }}
                            </a>
                            <div class="registry-meta-row">
                                <span><i class="bi bi-calendar3 me-1"></i>Ditetapkan: {{ $item->tanggal_penetapan ? $item->tanggal_penetapan->translatedFormat('d M Y') : '-' }}</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-eye me-1"></i>{{ number_format($item->view_count) }}x lihat</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-download me-1"></i>{{ number_format($item->download_count) }}x unduh</span>
                                @if($item->english_version || $item->braille || $item->alih_suara)
                                    <span>&bull;</span>
                                    <span class="d-inline-flex align-items-center gap-1">
                                        @if($item->english_version)<span class="badge bg-light text-primary border py-0 px-1" style="font-size: 0.65rem;">EN</span>@endif
                                        @if($item->braille)<span class="badge bg-light text-warning-emphasis border py-0 px-1" style="font-size: 0.65rem;">BRL</span>@endif
                                        @if($item->alih_suara)<span class="badge bg-light text-success border py-0 px-1" style="font-size: 0.65rem;">AUD</span>@endif
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">
                            @if($item->file_dokumen)
                                <span class="badge-pdf-pill-success" title="Naskah PDF Utama Tersedia">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i>PDF Siap
                                </span>
                            @else
                                <a href="{{ route('admin.peraturan.edit', $item->id) }}" class="badge-pdf-pill-danger" title="Klik untuk mengunggah berkas PDF">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Upload PDF
                                </a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status === 'BERLAKU')
                                <span class="badge-status-pill-active">
                                    <span class="pulse-dot-emerald me-1"></span>Berlaku
                                </span>
                            @else
                                <span class="badge-status-pill-inactive">
                                    <i class="bi bi-dash-circle me-1"></i>Dicabut
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                @if($item->file_dokumen)
                                    <button type="button" class="btn-reg-action btn-reg-preview" 
                                        onclick="openPdfPreview('{{ route('user.produk-hukum.preview', $item->id) }}', '{{ addslashes($item->judul) }}', '{{ route('user.produk-hukum.download', $item->id) }}', '{{ route('admin.peraturan.edit', $item->id) }}')"
                                        title="Pratinjau Dokumen Naskah PDF">
                                        <i class="bi bi-eye me-1"></i> Pratinjau
                                    </button>
                                @endif
                                <a href="{{ route('admin.peraturan.edit', $item->id) }}" class="btn-reg-action btn-reg-edit" title="Edit Regulasi">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger py-1 px-2" style="font-size: 0.72rem; border-radius: 6px;" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}" title="Hapus Dokumen">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade text-start" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                                                <p class="text-danger small mb-0">Tindakan ini permanen dan tidak dapat dibatalkan.</p>
                                            </div>
                                            <div class="modal-footer border-top py-2">
                                                <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-sm btn-danger px-3">Ya, Hapus Dokumen</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-x fs-1 d-block mb-2 text-slate-300"></i>
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
                Menampilkan <strong>{{ $peraturans->firstItem() }} - {{ $peraturans->lastItem() }}</strong> dari <strong>{{ $peraturans->total() }}</strong> peraturan
            </span>
            <div>
                {{ $peraturans->links() }}
            </div>
        </div>
    @endif
</div>

<!-- ============================================================
     4. MODAL PRATINJAU PDF INSTAN (IN-PAGE VIEWER)
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body p-0" style="height: 75vh; background: #0b1727;">
                <iframe id="adminPdfIframe" src="about:blank" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
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
</script>
@endpush
