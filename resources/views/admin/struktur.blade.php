@extends('layouts.admin')

@section('title', 'Kelola Struktur Organisasi')
@section('page-title', 'Struktur Organisasi Bagian Hukum')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <p class="text-muted small mb-0">Kelola daftar pejabat dan staf Bagian Hukum Sekretariat Daerah Kabupaten Toba</p>
    </div>
    <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStruktur">
        <i class="bi bi-plus-lg me-1"></i> Tambah Pejabat / Staf
    </button>
</div>

<!-- TABEL STRUKTUR ORGANISASI -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 50px;">No</th>
                    <th style="width: 80px;">Foto</th>
                    <th>Nama Pejabat / Staf</th>
                    <th>Jabatan</th>
                    <th>Atasan (Parent)</th>
                    <th class="text-center" style="width: 100px;">Tingkat</th>
                    <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($struktur as $index => $item)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $struktur->firstItem() + $index }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="rounded-circle border" width="46" height="46" style="object-fit: cover;" alt="{{ $item->nama }}">
                            @else
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 46px; height: 46px;">
                                    <i class="bi bi-person"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $item->nama }}</strong>
                            <small class="text-muted">Urutan: {{ $item->urutan ?? 0 }}</small>
                        </td>
                        <td><span class="badge bg-light text-primary border fs-6">{{ $item->jabatan }}</span></td>
                        <td><small class="text-muted">{{ $item->parent->jabatan ?? '-' }}</small></td>
                        <td class="text-center"><span class="badge bg-secondary rounded-pill px-3">Level {{ $item->tingkat }}</span></td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <button type="button" class="btn btn-sm btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#modalEditStruktur{{ $item->id }}" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapusStruktur{{ $item->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEditStruktur{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.struktur.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold">Edit Pejabat / Staf</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Jabatan <span class="text-danger">*</span></label>
                                            <input type="text" name="jabatan" class="form-control" value="{{ $item->jabatan }}" required>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold">Tingkat Hierarki <span class="text-danger">*</span></label>
                                                <input type="number" name="tingkat" class="form-control" value="{{ $item->tingkat }}" min="1" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold">Urutan Posisi</label>
                                                <input type="number" name="urutan" class="form-control" value="{{ $item->urutan ?? 0 }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Atasan Langsung (Parent)</label>
                                            <select name="parent_id" class="form-select">
                                                <option value="">-- Paling Atas (Root) --</option>
                                                @foreach($allParents as $p)
                                                    @if($p->id !== $item->id)
                                                        <option value="{{ $p->id }}" {{ $item->parent_id == $p->id ? 'selected' : '' }}>
                                                            {{ $p->jabatan }} ({{ $p->nama }})
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Ganti Foto Profil</label>
                                            <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
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
                    <div class="modal fade" id="modalHapusStruktur{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.struktur.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <i class="bi bi-exclamation-triangle text-danger display-4 mb-3 d-block"></i>
                                        <p class="mb-1">Hapus pejabat/staf berikut dari bagan struktur:</p>
                                        <h6 class="fw-bold">{{ $item->nama }}</h6>
                                        <small class="text-muted">{{ $item->jabatan }}</small>
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
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada data struktur organisasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $struktur->links() }}
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="modalTambahStruktur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold">Tambah Pejabat / Staf Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Drs. Antonius Simanjuntak, M.H." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Kepala Bagian Hukum" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tingkat Hierarki <span class="text-danger">*</span></label>
                            <input type="number" name="tingkat" class="form-control" value="1" min="1" required>
                            <small class="text-muted">1 = Pimpinan Tertinggi</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Urutan Posisi</label>
                            <input type="number" name="urutan" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Atasan Langsung (Parent)</label>
                        <select name="parent_id" class="form-select">
                            <option value="">-- Paling Atas (Root) --</option>
                            @foreach($allParents as $p)
                                <option value="{{ $p->id }}">{{ $p->jabatan }} ({{ $p->nama }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Foto Profil (Opsional)</label>
                        <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted">Format gambar JPG, PNG, WEBP. Maks 3 MB.</small>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
