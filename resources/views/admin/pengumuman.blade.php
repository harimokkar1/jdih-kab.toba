@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('breadcrumb', 'Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Pengumuman &amp; Maklumat Resmi</h4>
            <span class="stat-pill stat-pill-slate">
                <span class="pulse-dot-emerald me-1"></span>
                Papan Informasi Publik
            </span>
        </div>
        <p class="admin-page-subtitle">Publikasi pengumuman kedinasan, surat edaran, uji publik, dan maklumat resmi Bagian Hukum Sekretariat Daerah</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn btn-sm btn-outline-secondary px-3 py-2 fw-semibold rounded-3 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalKelolaKategori" style="height: 38px;">
            <i class="bi bi-tags"></i>
            <span>Kelola Kategori</span>
        </button>
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengumuman">
            <i class="bi bi-plus-lg"></i>
            <span>Buat Pengumuman Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     2. FILTER & PENELUSURAN MAKLUMAT
     ============================================================ -->
<div class="admin-card filter-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.pengumuman.index') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-lg-6 col-md-5">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 0.8rem;"></i>
                        <input type="text" name="search" class="form-control form-control-sm ps-5" placeholder="Cari judul maklumat atau isi pengumuman..." value="{{ request('search') }}" style="border-radius: 8px;">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <select name="kategori_id" class="form-select form-select-sm" style="border-radius: 8px;">
                        <option value="">Semua Kategori ({{ $totalPengumuman ?? 0 }})</option>
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }} ({{ $kat->pengumumans_count }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary flex-grow-1 fw-medium d-inline-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; height: 35px;">
                        <i class="bi bi-funnel me-1"></i>
                        <span>Filter</span>
                    </button>
                    @if(request()->hasAny(['search', 'kategori_id']))
                        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary px-3 d-inline-flex align-items-center" style="border-radius: 8px; height: 35px;" title="Reset Pencarian">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     3. TABEL DAFTAR PENGUMUMAN
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Maklumat &amp; Edaran Publik</h6>
            <span class="badge bg-light text-dark border px-2">{{ $pengumumans->total() }} Pengumuman</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table admin-table-registry align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 60px;">No</th>
                    <th>Judul Maklumat &amp; Ringkasan</th>
                    <th style="width: 170px;">Kategori</th>
                    <th style="width: 160px;">Tanggal Terbit</th>
                    <th style="width: 140px;">Berkas PDF</th>
                    <th class="text-end pe-4" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumumans as $index => $p)
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $pengumumans->firstItem() + $index }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pengumuman.show', $p->id) }}" target="_blank" class="registry-title-link mb-1" title="Lihat Pratinjau Publik">
                                {{ $p->judul }}
                            </a>
                            <p class="text-muted small mb-0" style="line-height: 1.48; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width: 580px;">
                                {{ Str::limit(strip_tags($p->isi), 120) }}
                            </p>
                        </td>
                        <td>
                            @if($p->kategori)
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 small fw-medium rounded-pill">
                                    {{ $p->kategori->nama }}
                                </span>
                            @else
                                <span class="badge bg-light text-muted border px-3 py-1 small rounded-pill">
                                    Umum / Lainnya
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark small fw-medium d-block">
                                <i class="bi bi-calendar-event me-1 text-muted"></i>{{ $p->tanggal_upload ? $p->tanggal_upload->isoFormat('D MMMM Y') : '-' }}
                            </span>
                            <span class="text-muted" style="font-size: 0.72rem;">Publikasi Terverifikasi</span>
                        </td>
                        <td>
                            @if($p->file_pdf)
                                <a href="{{ asset('uploads/pengumuman/' . $p->file_pdf) }}" target="_blank" class="badge-pdf-pill-success" title="Buka File Lampiran PDF">
                                    <i class="bi bi-file-earmark-pdf me-1"></i>
                                    <span>Unduh PDF</span>
                                </a>
                            @else
                                <span class="text-muted small d-inline-flex align-items-center gap-1" style="font-size: 0.735rem;">
                                    <i class="bi bi-dash-circle text-secondary"></i> Tanpa PDF
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('pengumuman.show', $p->id) }}" target="_blank" class="btn-action-icon btn-action-view" title="Pratinjau Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEditPengumuman{{ $p->id }}" title="Edit Pengumuman">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapusPengumuman{{ $p->id }}" title="Hapus Pengumuman">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT PENGUMUMAN -->
                    <div class="modal fade" id="modalEditPengumuman{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.pengumuman.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header d-flex align-items-center justify-content-between py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="modal-header-icon-squircle icon-squircle-amber">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                            <div>
                                                <h6 class="modal-title fw-semibold text-dark mb-0">Edit Pengumuman / Maklumat</h6>
                                                <span class="text-muted" style="font-size: 0.72rem;">Perbarui judul, kategori, dan berkas lampiran naskah</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-dark">Judul Pengumuman <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" value="{{ $p->judul }}" required>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold text-dark">Kategori Pengumuman</label>
                                                <select name="kategori_id" class="form-select">
                                                    <option value="">-- Tanpa Kategori --</option>
                                                    @foreach($kategoriList as $kat)
                                                        <option value="{{ $kat->id }}" {{ $p->kategori_id == $kat->id ? 'selected' : '' }}>
                                                            {{ $kat->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold text-dark">Tanggal Publikasi <span class="text-danger">*</span></label>
                                                <input type="date" name="tanggal_upload" class="form-control" value="{{ $p->tanggal_upload ? $p->tanggal_upload->format('Y-m-d') : date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-dark">Ganti Berkas PDF Lampiran (Opsional)</label>
                                            @if($p->file_pdf)
                                                <div class="mb-2">
                                                    <span class="badge bg-light text-muted border">
                                                        <i class="bi bi-file-earmark-pdf text-danger me-1"></i>Lampiran saat ini: {{ $p->file_pdf }}
                                                    </span>
                                                </div>
                                            @endif
                                            <input type="file" name="file_pdf" class="form-control form-control-sm" accept=".pdf">
                                            <small class="text-muted" style="font-size: 0.72rem;">Maksimal 10 MB (Format PDF resmi).</small>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold text-dark">Isi Uraian Pengumuman <span class="text-danger">*</span></label>
                                            <textarea name="isi" class="form-control" rows="6" required>{{ $p->isi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top p-3">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-primary px-3 fw-semibold">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL HAPUS PENGUMUMAN -->
                    <div class="modal fade" id="modalHapusPengumuman{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0 d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <span>Konfirmasi Hapus Pengumuman</span>
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus pengumuman berikut secara permanen?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small" style="line-height: 1.45;">{{ $p->judul }}</strong>
                                        </div>
                                        <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                    </div>
                                    <div class="modal-footer border-top p-3">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-danger px-3 fw-semibold">Ya, Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-megaphone fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada pengumuman yang diterbitkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengumumans->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="small text-muted">
                Menampilkan {{ $pengumumans->firstItem() }} - {{ $pengumumans->lastItem() }} dari {{ $pengumumans->total() }} pengumuman
            </span>
            <div>
                {{ $pengumumans->links() }}
            </div>
        </div>
    @endif
</div>

<!-- ============================================================
     4. MODAL TAMBAH PENGUMUMAN
     ============================================================ -->
<div class="modal fade" id="modalTambahPengumuman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-header-icon-squircle icon-squircle-cyan">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-semibold text-dark mb-0">Buat Pengumuman Baru</h6>
                            <span class="text-muted" style="font-size: 0.72rem;">Terbitkan maklumat resmi, siaran pers, atau edaran publik</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Tuliskan judul maklumat atau surat edaran..." required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-dark">Kategori Pengumuman</label>
                            <select name="kategori_id" class="form-select">
                                <option value="">-- Tanpa Kategori --</option>
                                @foreach($kategoriList as $kat)
                                    <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-dark">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_upload" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Berkas PDF Lampiran (Opsional)</label>
                        <div class="modern-file-uploader uploader-compact">
                            <input type="file" name="file_pdf" id="input_pengumuman_pdf" class="uploader-native-input" accept=".pdf" onchange="handleFileSelected(this, 'preview_pengumuman_pdf')">
                            <label for="input_pengumuman_pdf" class="uploader-drop-area">
                                <div class="uploader-icon-squircle">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </div>
                                <div class="uploader-text-wrapper">
                                    <span class="uploader-title">Pilih Berkas PDF Resmi</span>
                                    <span class="uploader-hint">Format .PDF &bull; Maksimal 10 MB</span>
                                </div>
                                <span class="uploader-browse-btn">Pilih Berkas</span>
                            </label>
                            <div id="preview_pengumuman_pdf" class="uploader-file-pill d-none">
                                <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
                                <span class="uploader-file-name text-truncate"></span>
                                <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                                <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_pengumuman_pdf', 'preview_pengumuman_pdf')">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-dark">Isi Uraian Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="6" placeholder="Tuliskan uraian lengkap pengumuman di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3 fw-semibold"><i class="bi bi-send me-1"></i> Terbitkan Pengumuman</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================================================
     5. MODAL KELOLA KATEGORI PENGUMUMAN
     ============================================================ -->
<div class="modal fade" id="modalKelolaKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
        <div class="modal-content rounded-3 border-0 shadow">
            <div class="modal-header d-flex align-items-center justify-content-between py-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="modal-header-icon-squircle icon-squircle-purple">
                        <i class="bi bi-bookmarks"></i>
                    </div>
                    <div>
                        <h6 class="modal-title fw-semibold text-dark mb-0">Kelola Kategori Pengumuman</h6>
                        <span class="text-muted" style="font-size: 0.72rem;">Master label kelompok warta maklumat publik</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- FORM TAMBAH KATEGORI BARU -->
                <div class="card border rounded-3 p-3 bg-light mb-4">
                    <h6 class="fw-bold text-dark small mb-2 d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle text-primary"></i>
                        <span>Tambah Kategori Baru</span>
                    </h6>
                    <form action="{{ route('admin.pengumuman.kategori.store') }}" method="POST">
                        @csrf
                        <div class="row g-2 align-items-center">
                            <div class="col-md-9">
                                <input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama kategori baru (contoh: Siaran Pers, Uji Publik)..." required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-primary w-100 fw-semibold">
                                    <i class="bi bi-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- DAFTAR KATEGORI SAAT INI -->
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold text-dark small mb-0">Daftar Kategori Terdaftar</h6>
                    <span class="badge bg-light text-dark border">{{ count($kategoriList) }} Kategori</span>
                </div>
                <div class="table-responsive border rounded-3 bg-white">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 text-center" style="width: 50px;">No</th>
                                <th>Nama Kategori</th>
                                <th style="width: 170px;">Jumlah Terkait</th>
                                <th class="text-end pe-3" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoriList as $kIndex => $kat)
                                <tr>
                                    <td class="ps-3 text-center small text-muted">{{ $kIndex + 1 }}</td>
                                    <td>
                                        <span class="text-dark d-block fw-semibold small">{{ $kat->nama }}</span>
                                        <span class="registry-doc-badge font-monospace" style="font-size: 0.68rem;">slug: {{ $kat->slug }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 small rounded-pill fw-medium">
                                            {{ $kat->pengumumans_count }} Pengumuman
                                        </span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1" data-bs-toggle="modal" data-bs-target="#modalEditKategori{{ $kat->id }}" title="Edit Kategori">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" data-bs-toggle="modal" data-bs-target="#modalHapusKategori{{ $kat->id }}" title="Hapus Kategori">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">
                                        Belum ada kategori yang dibuat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top p-3">
                <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT & HAPUS PER KATEGORI -->
@foreach($kategoriList as $kat)
    <!-- MODAL EDIT KATEGORI -->
    <div class="modal fade" id="modalEditKategori{{ $kat->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content rounded-3 border-0 shadow">
                <form action="{{ route('admin.pengumuman.kategori.update', $kat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-bottom py-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-pencil-square text-warning fs-5"></i>
                            <h6 class="modal-title fw-bold mb-0">Edit Kategori Pengumuman</h6>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ $kat->nama }}" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top p-3">
                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary px-3 fw-semibold">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL HAPUS KATEGORI -->
    <div class="modal fade" id="modalHapusKategori{{ $kat->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content rounded-3 border-0 shadow">
                <form action="{{ route('admin.pengumuman.kategori.destroy', $kat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header border-bottom py-3">
                        <h6 class="modal-title fw-bold text-danger mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span>Konfirmasi Hapus Kategori</span>
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <p class="text-muted small mb-2">Hapus kategori pengumuman berikut?</p>
                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                            <strong class="text-dark d-block small">{{ $kat->nama }}</strong>
                            <small class="text-muted">{{ $kat->pengumumans_count }} pengumuman tertaut</small>
                        </div>
                        <p class="text-danger small mb-0">Pengumuman pada kategori ini akan tetap tersimpan (menjadi tanpa kategori).</p>
                    </div>
                    <div class="modal-footer border-top p-3">
                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-danger px-3 fw-semibold">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
