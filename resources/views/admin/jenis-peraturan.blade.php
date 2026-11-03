@extends('layouts.admin')

@section('title', 'Kelola Jenis Peraturan')
@section('page-title', 'Submenu 1: Jenis Peraturan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted small mb-0">Kelola master klasifikasi kategori produk hukum (Perda, Perbup, Kepbup, Inbup, SK, dll.)</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJenis">
        <i class="bi bi-plus-lg me-1"></i> Tambah Jenis Peraturan
    </button>
</div>

<!-- TABEL JENIS PERATURAN -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 60px;">Urutan</th>
                    <th>Nama Jenis Peraturan</th>
                    <th>Singkatan</th>
                    <th>Slug URL</th>
                    <th>Deskripsi</th>
                    <th class="text-center">Total Dokumen</th>
                    <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisPeraturans as $item)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $item->urutan }}</td>
                        <td>
                            <strong class="text-dark">{{ $item->nama }}</strong>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $item->singkatan ?: '-' }}</span></td>
                        <td><code class="small text-muted">{{ $item->slug }}</code></td>
                        <td class="small text-muted">{{ Str::limit($item->deskripsi, 60) ?: '-' }}</td>
                        <td class="text-center">
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                {{ $item->peraturans_count }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <button type="button" class="btn btn-sm btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.jenis-peraturan.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold">Edit Jenis Peraturan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Jenis Peraturan <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Singkatan</label>
                                            <input type="text" name="singkatan" class="form-control" value="{{ $item->singkatan }}">
                                            <small class="text-muted">Contoh: PERDA, PERBUP, KEPBUP, INBUP</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Urutan Tampilan</label>
                                            <input type="number" name="urutan" class="form-control" value="{{ $item->urutan }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
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
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.jenis-peraturan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <i class="bi bi-exclamation-triangle text-warning display-4 mb-3 d-block"></i>
                                        <p class="mb-1">Apakah Anda yakin ingin menghapus jenis peraturan:</p>
                                        <h6 class="fw-bold">{{ $item->nama }}?</h6>
                                        @if($item->peraturans_count > 0)
                                            <div class="alert alert-warning mt-3 small mb-0 text-start">
                                                <i class="bi bi-info-circle me-1"></i> Jenis ini saat ini memiliki <strong>{{ $item->peraturans_count }} dokumen peraturan</strong>. Harap pindahkan atau hapus dokumen tersebut terlebih dahulu.
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer border-top">
                                        <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger rounded-pill px-4" {{ $item->peraturans_count > 0 ? 'disabled' : '' }}>Ya, Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada data jenis peraturan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahJenis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.jenis-peraturan.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tambah Jenis Peraturan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Jenis Peraturan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Instruksi Bupati" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Singkatan</label>
                        <input type="text" name="singkatan" class="form-control" placeholder="Contoh: INBUP">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Urutan Nomor Tampilan</label>
                        <input type="number" name="urutan" class="form-control" value="0">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan mengenai jenis peraturan ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Jenis</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
