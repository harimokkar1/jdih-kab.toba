@extends('layouts.admin')

@section('title', 'Kelola Struktur Organisasi')
@section('breadcrumb', 'Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Struktur Organisasi Bagian Hukum</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Bagan Tata Kerja Setdakab Toba
            </span>
        </div>
        <p class="admin-page-subtitle">Kelola susunan hierarki pejabat, kepemimpinan, dan aparatur Bagian Hukum Sekretariat Daerah Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahStruktur">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Pejabat / Staf</span>
        </button>
    </div>
</div>

<!-- ============================================================
     TABEL STRUKTUR ORGANISASI
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Aparatur &amp; Susunan Hierarki</h6>
            <span class="badge bg-light text-dark border px-2">{{ $struktur->total() }} Personel</span>
        </div>
        <span class="admin-header-badge d-none d-sm-inline-flex">
            <i class="bi bi-diagram-3 text-primary"></i>
            Hierarki Bertingkat (Root &amp; Sub-bagian)
        </span>
    </div>

    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 50px;">No</th>
                    <th style="width: 70px;">Foto</th>
                    <th>Nama Pejabat / Staf</th>
                    <th>Jabatan Kedinasan</th>
                    <th>Atasan Langsung</th>
                    <th class="text-center" style="width: 140px;">Tingkat</th>
                    <th class="text-end pe-4" style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($struktur as $index => $item)
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $struktur->firstItem() + $index }}</span>
                        </td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="admin-avatar-person" alt="{{ $item->nama }}">
                            @else
                                <div class="admin-avatar-placeholder">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $item->nama }}</strong>
                            <small class="text-muted">Urutan Penomoran: {{ $item->urutan ?? 0 }}</small>
                        </td>
                        <td>
                            <span class="badge bg-white text-dark border shadow-xs">{{ $item->jabatan }}</span>
                        </td>
                        <td>
                            <span class="small text-muted">{{ $item->parent->jabatan ?? 'Pimpinan Tertinggi (Root)' }}</span>
                        </td>
                        <td class="text-center">
                            @if($item->tingkat == 1)
                                <span class="badge-level-1">Level 1 (Pimpinan)</span>
                            @elseif($item->tingkat == 2)
                                <span class="badge-level-2">Level 2 (Koordinator)</span>
                            @else
                                <span class="badge-level-3">Level {{ $item->tingkat }}</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEditStruktur{{ $item->id }}" title="Edit Pejabat">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapusStruktur{{ $item->id }}" title="Hapus Pejabat">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEditStruktur{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.struktur.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom py-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                            <h6 class="modal-title fw-bold mb-0">Edit Pejabat / Staf</h6>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
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
                                            <label class="form-label small fw-bold">Ganti Foto Profil (Opsional)</label>
                                            <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
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
                    <div class="modal fade" id="modalHapusStruktur{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.struktur.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Pejabat
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus aparatur berikut dari bagan organisasi?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small">{{ $item->nama }}</strong>
                                            <span class="badge bg-light text-muted border">{{ $item->jabatan }}</span>
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-diagram-3 fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada data struktur organisasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($struktur->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="small text-muted">
                Menampilkan {{ $struktur->firstItem() }} - {{ $struktur->lastItem() }} dari {{ $struktur->total() }} personel
            </span>
            <div>
                {{ $struktur->links() }}
            </div>
        </div>
    @endif
</div>

<!-- MODAL TAMBAH STRUKTUR -->
<div class="modal fade" id="modalTambahStruktur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-plus text-primary"></i>
                        <h6 class="modal-title fw-bold mb-0">Tambah Pejabat / Staf Baru</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
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
                            <small class="text-muted">1 = Pimpinan Utama</small>
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
                        <small class="text-muted">Format gambar JPG, PNG, WEBP. Maksimal 3 MB.</small>
                    </div>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
