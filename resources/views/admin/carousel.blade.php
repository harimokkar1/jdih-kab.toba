@extends('layouts.admin')

@section('title', 'Kelola Carousel Slider')
@section('breadcrumb', 'Carousel Slider')
@section('page-title', 'Carousel Banner Beranda')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Carousel Banner Beranda</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Spanduk Visual Utama
            </span>
        </div>
        <p class="admin-page-subtitle">Kelola gambar banner slider dan sorotan informasi yang tampil di bagian atas halaman beranda portal JDIH</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBanner">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Banner Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     BANNER GRID
     ============================================================ -->
<div class="row g-3">
    @forelse($carousels as $c)
        <div class="col-lg-4 col-md-6">
            <div class="carousel-grid-card">
                <div class="carousel-media-wrapper">
                    <div class="carousel-floating-badge">
                        <span class="status-dot status-dot-emerald"></span>
                        Banner #{{ $loop->iteration }}
                    </div>
                    <img src="{{ asset('carousel/' . $c->image) }}" alt="{{ $c->title }}">
                </div>
                <div class="carousel-card-body">
                    <div>
                        <strong class="text-dark d-block mb-1" title="{{ $c->title }}">
                            {{ Str::limit($c->title, 48) }}
                        </strong>
                        <small class="text-muted d-flex align-items-center gap-1">
                            <i class="bi bi-clock text-secondary"></i>
                            <span>Diunggah: {{ $c->created_at ? $c->created_at->format('d/m/Y') : '-' }}</span>
                        </small>
                    </div>
                    <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-3">
                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $c->id }}">
                            <i class="bi bi-pencil me-1 text-warning"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-light border text-danger px-3" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $c->id }}">
                            <i class="bi bi-trash3 me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="modalEdit{{ $c->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-3 border-0 shadow">
                    <form action="{{ route('carousel.update', $c->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-bottom py-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-pencil-square text-warning"></i>
                                <h6 class="modal-title fw-bold mb-0">Edit Banner Slider</h6>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Judul Banner <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ $c->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Ganti Gambar Banner (Opsional)</label>
                                <input type="file" name="image" class="form-control form-control-sm" accept="image/jpeg,image/png,image/jpg,image/webp">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar (Maks. 5 MB).</small>
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
        <div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                <div class="modal-content rounded-3 border-0 shadow">
                    <form action="{{ route('carousel.delete', $c->id) }}" method="POST">
                        @csrf
                        <div class="modal-header border-bottom py-3">
                            <h6 class="modal-title fw-bold text-danger mb-0">
                                <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Banner
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-center">
                            <p class="text-muted small mb-2">Hapus banner slider berikut dari beranda?</p>
                            <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                <strong class="text-dark d-block small">{{ $c->title }}</strong>
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
        <div class="col-12 text-center py-5 bg-white rounded-3 border text-muted">
            <i class="bi bi-images fs-1 text-secondary mb-2 d-block"></i>
            <h6 class="fw-bold">Belum ada banner slider</h6>
            <p class="small mb-0">Klik tombol "Tambah Banner Baru" untuk mengunggah spanduk visual di beranda.</p>
        </div>
    @endforelse
</div>

<!-- MODAL TAMBAH BANNER -->
<div class="modal fade" id="modalTambahBanner" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-images text-primary"></i>
                        <h6 class="modal-title fw-bold mb-0">Tambah Banner Slider Baru</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul Banner <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Teks judul atau topik banner..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Berkas Gambar <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/jpeg,image/png,image/jpg,image/webp" required>
                        <small class="text-muted">Rekomendasi rasio 16:9 (1920x1080 px). Maksimal 5 MB.</small>
                    </div>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Unggah Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
