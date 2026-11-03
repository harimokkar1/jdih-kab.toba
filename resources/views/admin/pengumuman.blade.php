@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <p class="text-muted small mb-0">Publikasi pengumuman resmi dan surat edaran publik Bagian Hukum Kabupaten Toba</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPengumuman">
        <i class="bi bi-plus-lg me-1"></i> Buat Pengumuman Baru
    </button>
</div>

<!-- TABEL PENGUMUMAN -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 50px;">No</th>
                    <th>Judul Pengumuman</th>
                    <th>Tanggal Publikasi</th>
                    <th>File PDF</th>
                    <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumumans as $index => $p)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $pengumumans->firstItem() + $index }}</td>
                        <td>
                            <strong class="text-dark d-block">{{ $p->judul }}</strong>
                            <small class="text-muted">{{ Str::limit(strip_tags($p->isi), 90) }}</small>
                        </td>
                        <td><small class="text-muted">{{ $p->tanggal_upload ? $p->tanggal_upload->format('d/m/Y') : '-' }}</small></td>
                        <td>
                            @if($p->file_pdf)
                                <a href="{{ asset('uploads/pengumuman/' . $p->file_pdf) }}" target="_blank" class="badge bg-danger text-decoration-none">
                                    <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                                </a>
                            @else
                                <span class="badge bg-light text-muted border">Tanpa PDF</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('pengumuman.show', $p->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#modalEditPengumuman{{ $p->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusPengumuman{{ $p->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEditPengumuman{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.pengumuman.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold">Edit Pengumuman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" value="{{ $p->judul }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Tanggal Upload <span class="text-danger">*</span></label>
                                            <input type="date" name="tanggal_upload" class="form-control" value="{{ $p->tanggal_upload ? $p->tanggal_upload->format('Y-m-d') : date('Y-m-d') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Ganti File Lampiran PDF (Opsional)</label>
                                            <input type="file" name="file_pdf" class="form-control form-control-sm" accept=".pdf">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file PDF.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                                            <textarea name="isi" class="form-control" rows="6" required>{{ $p->isi }}</textarea>
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
                    <div class="modal fade" id="modalHapusPengumuman{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Pengumuman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <i class="bi bi-exclamation-triangle text-danger display-4 mb-3 d-block"></i>
                                        <p class="mb-1">Hapus pengumuman berikut:</p>
                                        <h6 class="fw-bold">{{ $p->judul }}?</h6>
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
                        <td colspan="5" class="text-center py-5 text-muted">Belum ada pengumuman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $pengumumans->links() }}
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahPengumuman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Buat Pengumuman Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Tuliskan judul pengumuman..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tanggal Publikasi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_upload" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Berkas PDF Lampiran (Opsional)</label>
                        <input type="file" name="file_pdf" class="form-control form-control-sm" accept=".pdf">
                        <small class="text-muted">Maksimal 10 MB (Format PDF).</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="6" placeholder="Tuliskan deskripsi lengkap pengumuman..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Terbitkan Pengumuman</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
