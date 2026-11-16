@extends('layouts.admin')

@section('title', 'Kelola Berita Hukum')
@section('breadcrumb', 'Berita Hukum')
@section('page-title', 'Kelola Berita Hukum')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Kelola Berita &amp; Warta Hukum</h4>
            <span class="stat-pill stat-pill-slate">
                <span class="pulse-dot-emerald me-1"></span>
                Warta Resmi Setdakab Toba
            </span>
        </div>
        <p class="admin-page-subtitle">Publikasi warta kedinasan, kegiatan perancangan peraturan, dan liputan hukum Pemerintah Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
            <i class="bi bi-plus-lg"></i>
            <span>Tulis Berita Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     2. FILTER & PENELUSURAN WARTA
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="p-3">
        <form action="{{ route('admin.berita') }}" method="GET">
            <div class="row g-2 align-items-center">
                <div class="col-md-9 col-sm-8">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted" style="font-size: 0.8rem;"></i>
                        <input type="text" name="search" class="form-control form-control-sm ps-5" placeholder="Cari judul berita, topik, atau isi narasi..." value="{{ request('search') }}" style="border-radius: 8px;">
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-primary flex-grow-1 fw-medium d-inline-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; height: 35px;">
                        <i class="bi bi-search me-1"></i>
                        <span>Cari Warta</span>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.berita') }}" class="btn btn-sm btn-outline-secondary px-3 d-inline-flex align-items-center" style="border-radius: 8px; height: 35px;" title="Reset Pencarian">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================
     3. TABEL DAFTAR PUBLIKASI BERITA
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Publikasi Berita Hukum</h6>
            <span class="badge bg-light text-dark border px-2">{{ $beritas->total() }} Artikel</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table admin-table-registry align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 60px;">No</th>
                    <th style="width: 100px;">Sampul</th>
                    <th>Judul Berita &amp; Rangkuman Isi</th>
                    <th style="width: 170px;">Tanggal Terbit</th>
                    <th class="text-end pe-4" style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $index => $b)
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $beritas->firstItem() + $index }}</span>
                        </td>
                        <td>
                            @if($b->gambar)
                                <img src="{{ asset('uploads/berita/' . $b->gambar) }}" class="admin-news-thumb" alt="Sampul Warta" onerror="this.onerror=null;this.src='{{ asset('logo.png') }}';">
                            @else
                                <div class="admin-news-thumb-placeholder" title="Tidak ada foto sampul">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('berita.detail', $b->id) }}" target="_blank" class="registry-title-link mb-1" title="Lihat Pratinjau Publik">
                                {{ $b->judul }}
                            </a>
                            <p class="text-muted small mb-2" style="line-height: 1.48; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width: 620px;">
                                {{ Str::limit(strip_tags($b->isi), 130) }}
                            </p>
                            <div class="registry-meta-row">
                                <span><i class="bi bi-person-check me-1 text-primary"></i>Redaksi Bagian Hukum</span>
                                <span>&bull;</span>
                                <span><i class="bi bi-clock-history me-1"></i>{{ $b->created_at ? $b->created_at->diffForHumans() : '-' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-dark small fw-medium d-block">
                                <i class="bi bi-calendar-event me-1 text-muted"></i>{{ $b->created_at ? $b->created_at->isoFormat('D MMMM Y') : '-' }}
                            </span>
                            <span class="text-muted" style="font-size: 0.72rem;">
                                <i class="bi bi-clock me-1"></i>{{ $b->created_at ? $b->created_at->format('H:i') : '' }} WIB
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('berita.detail', $b->id) }}" target="_blank" class="btn-action-icon btn-action-view" title="Buka Pratinjau Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEditBerita{{ $b->id }}" title="Edit Berita">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapusBerita{{ $b->id }}" title="Hapus Berita">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT BERITA -->
                    <div class="modal fade" id="modalEditBerita{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.berita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header d-flex align-items-center justify-content-between py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="modal-header-icon-squircle icon-squircle-amber">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                            <div>
                                                <h6 class="modal-title fw-semibold text-dark mb-0">Edit Berita Hukum</h6>
                                                <span class="text-muted" style="font-size: 0.72rem;">Perbarui judul warta, foto dokumentasi, dan isi narasi</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-dark">Judul Berita <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" value="{{ $b->judul }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-dark">Ganti Foto Sampul (Opsional)</label>
                                            <div class="d-flex align-items-center gap-3 mb-2">
                                                @if($b->gambar)
                                                    <img src="{{ asset('uploads/berita/' . $b->gambar) }}" class="admin-news-thumb" alt="Sampul Saat Ini">
                                                    <span class="text-muted small">Foto sampul saat ini terpasang.</span>
                                                @endif
                                            </div>
                                            <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted" style="font-size: 0.72rem;">Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.</small>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold text-dark">Isi Warta Berita <span class="text-danger">*</span></label>
                                            <textarea name="isi" class="form-control" rows="8" required>{{ $b->isi }}</textarea>
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

                    <!-- MODAL HAPUS BERITA -->
                    <div class="modal fade" id="modalHapusBerita{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0 d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <span>Konfirmasi Hapus Berita</span>
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus artikel berita hukum berikut secara permanen?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small" style="line-height: 1.45;">{{ $b->judul }}</strong>
                                        </div>
                                        <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                    </div>
                                    <div class="modal-footer border-top p-3">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-danger px-3 fw-semibold">Ya, Hapus Warta</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-newspaper fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada artikel berita yang dipublikasikan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($beritas->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="small text-muted">
                Menampilkan {{ $beritas->firstItem() }} - {{ $beritas->lastItem() }} dari {{ $beritas->total() }} berita
            </span>
            <div>
                {{ $beritas->links() }}
            </div>
        </div>
    @endif
</div>

<!-- ============================================================
     4. MODAL TAMBAH BERITA BARU
     ============================================================ -->
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-header-icon-squircle icon-squircle-indigo">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-semibold text-dark mb-0">Tulis Berita Hukum Baru</h6>
                            <span class="text-muted" style="font-size: 0.72rem;">Publikasikan warta kedinasan, agenda, dan liputan hukum daerah</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Rapat Harmonisasi Ranperda Tata Ruang Wilayah Toba..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Foto Sampul Utama (Opsional)</label>
                        <div class="modern-file-uploader uploader-compact">
                            <input type="file" name="gambar" id="input_berita_gambar" class="uploader-native-input" accept="image/*" onchange="handleFileSelected(this, 'preview_berita_gambar')">
                            <label for="input_berita_gambar" class="uploader-drop-area">
                                <div class="uploader-icon-squircle">
                                    <i class="bi bi-image"></i>
                                </div>
                                <div class="uploader-text-wrapper">
                                    <span class="uploader-title">Pilih Foto Sampul Berita</span>
                                    <span class="uploader-hint">Format JPG, JPEG, PNG, WEBP &bull; Maks 2 MB</span>
                                </div>
                                <span class="uploader-browse-btn">Pilih Foto</span>
                            </label>
                            <div id="preview_berita_gambar" class="uploader-file-pill d-none">
                                <i class="bi bi-image text-indigo me-2"></i>
                                <span class="uploader-file-name text-truncate"></span>
                                <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                                <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_berita_gambar', 'preview_berita_gambar')">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-dark">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="8" placeholder="Tulis rincian narasi berita di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3 fw-semibold"><i class="bi bi-send me-1"></i> Publikasikan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
