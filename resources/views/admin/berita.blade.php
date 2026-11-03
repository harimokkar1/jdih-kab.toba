@extends('layouts.admin')

@section('title', 'Kelola Berita Hukum')
@section('page-title', 'Kelola Berita Hukum')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <p class="text-muted small mb-0">Publikasi artikel berita kegiatan dan sosialisasi hukum Pemerintah Kabupaten Toba</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBerita">
        <i class="bi bi-plus-lg me-1"></i> Tulis Berita Baru
    </button>
</div>

<!-- SEARCH -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <form action="{{ route('admin.berita') }}" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul berita atau isi..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Cari</button>
        <a href="{{ route('admin.berita') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Reset</a>
    </form>
</div>

<!-- TABEL BERITA -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 50px;">No</th>
                    <th style="width: 100px;">Foto</th>
                    <th>Judul Berita</th>
                    <th>Tanggal Terbit</th>
                    <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $index => $b)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $beritas->firstItem() + $index }}</td>
                        <td>
                            @if($b->gambar)
                                <img src="{{ asset('uploads/berita/' . $b->gambar) }}" class="rounded-2" width="70" height="50" style="object-fit: cover;" alt="Foto">
                            @else
                                <span class="badge bg-light text-muted border">No Img</span>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $b->judul }}</strong>
                            <small class="text-muted">{{ Str::limit(strip_tags($b->isi), 90) }}</small>
                        </td>
                        <td><small class="text-muted">{{ $b->created_at ? $b->created_at->format('d/m/Y H:i') : '-' }}</small></td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('berita.detail', $b->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#modalEditBerita{{ $b->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusBerita{{ $b->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEditBerita{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.berita.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold">Edit Berita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Judul Berita <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" value="{{ $b->judul }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Ganti Foto Utama (Opsional)</label>
                                            <input type="file" name="gambar" class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted">Format JPG, PNG, WEBP. Maks 2 MB.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Isi Berita <span class="text-danger">*</span></label>
                                            <textarea name="isi" class="form-control" rows="8" required>{{ $b->isi }}</textarea>
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
                    <div class="modal fade" id="modalHapusBerita{{ $b->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Berita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <i class="bi bi-exclamation-triangle text-danger display-4 mb-3 d-block"></i>
                                        <p class="mb-1">Hapus artikel berita:</p>
                                        <h6 class="fw-bold">{{ $b->judul }}?</h6>
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
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada artikel berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $beritas->links() }}
</div>

<!-- MODAL TAMBAH BERITA -->
<div class="modal fade" id="modalTambahBerita" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tulis Berita Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul berita..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Foto Berita (Opsional)</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Format JPG, JPEG, PNG, WEBP. Maks 2 MB.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Isi Berita Lengkap <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="8" placeholder="Tulis isi berita di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Publikasikan Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
