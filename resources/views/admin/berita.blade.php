@extends('layouts.admin')

@section('title', 'Kelola Berita Hukum')
@section('breadcrumb', 'Berita Hukum')
@section('page-title', 'Kelola Berita Hukum')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Kelola Berita &amp; Warta Hukum</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Warta Resmi Setdakab Toba
            </span>
        </div>
        <p class="admin-page-subtitle">Publikasi warta kegiatan, sosialisasi peraturan daerah, dan liputan hukum Pemerintah Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
            <i class="bi bi-plus-lg"></i>
            <span>Tulis Berita Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     SEARCH & FILTER BAR
     ============================================================ -->
<div class="admin-card mb-4">
    <div class="p-3 p-md-4">
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-search text-primary"></i>
            <span class="small fw-bold text-dark">Penelusuran Artikel Berita</span>
        </div>
        <form action="{{ route('admin.berita') }}" method="GET" class="d-flex gap-2 align-items-center">
            <div class="position-relative flex-grow-1">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted small"></i>
                <input type="text" name="search" class="form-control form-control-sm ps-5" placeholder="Cari judul berita atau isi warta..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="btn btn-sm btn-admin-primary px-3">
                <i class="bi bi-search me-1"></i> Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.berita') }}" class="btn btn-sm btn-light border px-3" title="Reset Pencarian">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            @endif
        </form>
    </div>
</div>

<!-- ============================================================
     TABEL BERITA HUKUM
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Publikasi Berita</h6>
            <span class="badge bg-light text-dark border px-2">{{ $beritas->total() }} Artikel</span>
        </div>
        <span class="admin-header-badge d-none d-sm-inline-flex">
            <i class="bi bi-broadcast text-primary"></i>
            Kanal Komunikasi Publik
        </span>
    </div>

    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 50px;">No</th>
                    <th style="width: 90px;">Sampul</th>
                    <th>Judul Berita &amp; Cuplikan</th>
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
                                <img src="{{ asset('uploads/berita/' . $b->gambar) }}" class="admin-table-thumb" alt="Sampul">
                            @else
                                <div class="admin-table-thumb d-flex align-items-center justify-content-center text-muted small">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $b->judul }}</strong>
                            <small class="text-muted d-block mt-1">{{ Str::limit(strip_tags($b->isi), 95) }}</small>
                        </td>
                        <td>
                            <span class="text-dark small d-block"><i class="bi bi-calendar3 me-1 text-muted"></i>{{ $b->created_at ? $b->created_at->format('d/m/Y') : '-' }}</span>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $b->created_at ? $b->created_at->format('H:i') : '' }} WIB</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('berita.detail', $b->id) }}" target="_blank" class="btn-action-icon btn-action-view" title="Pratinjau Publik">
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
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEditBerita{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.berita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom py-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                            <h6 class="modal-title fw-bold mb-0">Edit Berita Hukum</h6>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" value="{{ $b->judul }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Ganti Foto Sampul (Opsional)</label>
                                            <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted">Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Isi Berita <span class="text-danger">*</span></label>
                                            <textarea name="isi" class="form-control" rows="8" required>{{ $b->isi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top py-2">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-admin-primary px-3">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL HAPUS -->
                    <div class="modal fade" id="modalHapusBerita{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Berita
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus artikel berita hukum berikut secara permanen?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small">{{ $b->judul }}</strong>
                                        </div>
                                        <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                    </div>
                                    <div class="modal-footer border-top py-2">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-danger px-3">Ya, Hapus</button>
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

<!-- MODAL TAMBAH BERITA -->
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-newspaper text-primary"></i>
                        <h6 class="modal-title fw-bold mb-0">Tulis Berita Hukum Baru</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Contoh: Rapat Harmonisasi Ranperda Tata Ruang Wilayah Toba..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Foto Sampul Utama (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="8" placeholder="Tulis rincian narasi berita di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Publikasikan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
