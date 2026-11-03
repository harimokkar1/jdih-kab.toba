@extends('layouts.admin')

@section('title', 'Kelola Carousel Slider')
@section('page-title', 'Kelola Banner Slider Beranda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted small mb-0">Kelola gambar banner slider yang tampil di bagian atas halaman beranda portal</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBanner">
        <i class="bi bi-plus-lg me-1"></i> Tambah Banner Baru
    </button>
</div>

<div class="row g-4">
    @forelse($carousels as $c)
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <div class="position-relative" style="height: 180px; background: #000;">
                    <img src="{{ asset('carousel/' . $c->image) }}" class="w-100 h-100" style="object-fit: cover; opacity: 0.85;" alt="{{ $c->title }}">
                </div>
                <div class="card-body p-3 d-flex flex-column justify-content-between">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">{{ $c->title }}</h6>
                        <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $c->created_at ? $c->created_at->format('d/m/Y') : '-' }}</small>
                    </div>
                    <div class="d-flex justify-content-end gap-2 border-top pt-3 mt-3">
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $c->id }}">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $c->id }}">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDIT -->
        <div class="modal fade" id="modalEdit{{ $c->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <form action="{{ route('carousel.update', $c->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-bottom">
                            <h5 class="modal-title fw-bold">Edit Banner Slider</h5>
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
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MODAL HAPUS -->
        <div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow">
                    <form action="{{ route('carousel.delete', $c->id) }}" method="POST">
                        @csrf
                        <div class="modal-header border-bottom">
                            <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Banner</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-center">
                            <i class="bi bi-exclamation-triangle text-danger display-4 mb-3 d-block"></i>
                            <p class="mb-1">Hapus banner slider:</p>
                            <h6 class="fw-bold">{{ $c->title }}?</h6>
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 bg-white rounded-4 border text-muted">
            <i class="bi bi-images display-4 text-secondary mb-2 d-block"></i>
            <h6 class="fw-bold">Belum ada banner slider</h6>
            <p class="small mb-0">Klik tombol "Tambah Banner Baru" untuk mengunggah banner slider beranda.</p>
        </div>
    @endforelse
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahBanner" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tambah Banner Slider Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul Banner <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Teks judul banner slider..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Pilih Gambar Banner <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp" required>
                        <small class="text-muted">Format gambar JPG, PNG, WEBP. Maksimal ukuran 5 MB.</small>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Unggah Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
