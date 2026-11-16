@extends('layouts.admin')

@section('title', 'Kelola Struktur Organisasi')
@section('breadcrumb', 'Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Struktur Organisasi Bagian Hukum</h4>
            <span class="stat-pill stat-pill-slate">
                <span class="pulse-dot-emerald me-1"></span>
                Bagan Tata Kerja Setdakab Toba
            </span>
        </div>
        <p class="admin-page-subtitle">Kelola susunan hierarki pimpinan, koordinator sub-bagian, dan aparatur Bagian Hukum Sekretariat Daerah</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('struktur') }}" target="_blank" class="btn btn-sm btn-outline-secondary px-3 py-2 fw-semibold rounded-3 d-flex align-items-center gap-2" style="height: 38px;">
            <i class="bi bi-eye"></i>
            <span>Pratinjau Publik</span>
        </a>
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahStruktur">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Pejabat / Staf</span>
        </button>
    </div>
</div>

<!-- ============================================================
     2. HIERARCHY LEVEL REFERENCE CHIPS
     ============================================================ -->
<div class="row g-3 mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="p-3 bg-white rounded-3 border d-flex align-items-center gap-3 shadow-xs">
            <span class="badge-level-1">Level 1</span>
            <div>
                <span class="d-block small fw-semibold text-dark" style="font-size: 0.78rem;">Pimpinan Tertinggi (Root)</span>
                <span class="text-muted" style="font-size: 0.7rem;">Kepala Bagian Hukum</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="p-3 bg-white rounded-3 border d-flex align-items-center gap-3 shadow-xs">
            <span class="badge-level-2">Level 2</span>
            <div>
                <span class="d-block small fw-semibold text-dark" style="font-size: 0.78rem;">Koordinator Sub-bagian</span>
                <span class="text-muted" style="font-size: 0.7rem;">Subkoordinator &amp; Perancang Utama</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="p-3 bg-white rounded-3 border d-flex align-items-center gap-3 shadow-xs">
            <span class="badge-level-3">Level 3+</span>
            <div>
                <span class="d-block small fw-semibold text-dark" style="font-size: 0.78rem;">Pelaksana &amp; Staf Teknis</span>
                <span class="text-muted" style="font-size: 0.7rem;">Pengelola JDIH &amp; Administrasi</span>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     3. TABEL STRUKTUR ORGANISASI
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Aparatur &amp; Susunan Hierarki</h6>
            <span class="badge bg-light text-dark border px-2">{{ $struktur->total() }} Personel</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table admin-table-registry align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 60px;">No</th>
                    <th style="width: 70px;">Profil</th>
                    <th>Nama Pejabat / Staf</th>
                    <th>Jabatan Kedinasan</th>
                    <th>Atasan Langsung (Parent)</th>
                    <th class="text-center" style="width: 140px;">Tingkat</th>
                    <th class="text-end pe-4" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($struktur as $index => $item)
                    @php
                        $initial = strtoupper(substr($item->nama, 0, 1));
                    @endphp
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $struktur->firstItem() + $index }}</span>
                        </td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="admin-avatar-person" alt="{{ $item->nama }}">
                            @else
                                <div class="admin-avatar-initial-circle level-{{ min($item->tingkat, 3) }}" title="{{ $item->nama }}">
                                    {{ $initial }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <span class="d-block fw-semibold text-dark" style="font-size: 0.875rem;">{{ $item->nama }}</span>
                            <span class="registry-doc-badge mt-1" style="font-size: 0.68rem;">
                                Urutan Tampilan: #{{ $item->urutan ?? 0 }}
                            </span>
                        </td>
                        <td>
                            <span class="fw-medium text-dark small d-block">{{ $item->jabatan }}</span>
                        </td>
                        <td>
                            @if($item->parent)
                                <div class="d-flex align-items-center gap-2 small text-dark">
                                    <i class="bi bi-arrow-return-right text-primary" style="font-size: 0.75rem;"></i>
                                    <span>{{ $item->parent->jabatan }}</span>
                                </div>
                                <span class="text-muted d-block" style="font-size: 0.7rem; padding-left: 14px;">({{ $item->parent->nama }})</span>
                            @else
                                <span class="badge bg-light text-muted border px-3 py-1 small rounded-pill">
                                    Pimpinan Utama (Root)
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->tingkat == 1)
                                <span class="badge-level-1">Level 1 (Pimpinan)</span>
                            @elseif($item->tingkat == 2)
                                <span class="badge-level-2">Level 2 (Koordinator)</span>
                            @else
                                <span class="badge-level-3">Level {{ $item->tingkat }} (Staf)</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEditStruktur{{ $item->id }}" title="Edit Aparatur">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapusStruktur{{ $item->id }}" title="Hapus Aparatur">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT STRUKTUR -->
                    <div class="modal fade" id="modalEditStruktur{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.struktur.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header d-flex align-items-center justify-content-between py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="modal-header-icon-squircle icon-squircle-amber">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                            <div>
                                                <h6 class="modal-title fw-semibold text-dark mb-0">Edit Pejabat / Staf</h6>
                                                <span class="text-muted" style="font-size: 0.72rem;">Perbarui data aparatur, gelar, dan posisi hierarki</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold text-dark">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                                                    <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold text-dark">Nama Jabatan Kedinasan <span class="text-danger">*</span></label>
                                                    <input type="text" name="jabatan" class="form-control" value="{{ $item->jabatan }}" required>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label class="form-label small fw-semibold text-dark">Tingkat Hierarki <span class="text-danger">*</span></label>
                                                        <input type="number" name="tingkat" class="form-control" value="{{ $item->tingkat }}" min="1" required>
                                                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem; line-height: 1.2;">1: Pimpinan, 2: Koord, 3+: Staf</small>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label small fw-semibold text-dark">Urutan Posisi</label>
                                                        <input type="number" name="urutan" class="form-control" value="{{ $item->urutan ?? 0 }}">
                                                        <small class="text-muted d-block mt-1" style="font-size: 0.7rem; line-height: 1.2;">Angka urut tampil</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label small fw-semibold text-dark">Atasan Langsung (Parent)</label>
                                                    <select name="parent_id" class="form-select">
                                                        <option value="">-- Paling Atas (Root) --</option>
                                                        @php
                                                            $availableParents = $allParents->where('id', '!=', $item->id);
                                                            $lvl1 = $availableParents->where('tingkat', 1);
                                                            $lvl2 = $availableParents->where('tingkat', 2);
                                                            $lvl3 = $availableParents->where('tingkat', '>=', 3);
                                                        @endphp
                                                        @if($lvl1->count())
                                                            <optgroup label="Tingkat 1 &bull; Pimpinan Utama">
                                                                @foreach($lvl1 as $p)
                                                                    <option value="{{ $p->id }}" {{ $item->parent_id == $p->id ? 'selected' : '' }}>
                                                                        {{ $p->jabatan }} ({{ $p->nama }})
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                        @if($lvl2->count())
                                                            <optgroup label="Tingkat 2 &bull; Koordinator / Sub-Bagian">
                                                                @foreach($lvl2 as $p)
                                                                    <option value="{{ $p->id }}" {{ $item->parent_id == $p->id ? 'selected' : '' }}>
                                                                        {{ $p->jabatan }} ({{ $p->nama }})
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                        @if($lvl3->count())
                                                            <optgroup label="Tingkat 3+ &bull; Staf / Pelaksana">
                                                                @foreach($lvl3 as $p)
                                                                    <option value="{{ $p->id }}" {{ $item->parent_id == $p->id ? 'selected' : '' }}>
                                                                        {{ $p->jabatan }} ({{ $p->nama }})
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endif
                                                    </select>
                                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Pilih atasan langsung dalam rantai komando</small>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label small fw-semibold text-dark">Ganti Foto Profil (Opsional)</label>
                                                    @if($item->foto)
                                                        <div class="d-flex align-items-center gap-2 mb-2 p-2 bg-light rounded-3 border">
                                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}" style="width: 38px; height: 38px; object-fit: cover; border-radius: 8px;">
                                                            <span class="small text-muted text-truncate">Foto saat ini tersimpan</span>
                                                        </div>
                                                    @endif
                                                    <input type="file" name="foto" class="form-control form-control-sm" accept="image/*">
                                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">JPG, PNG, WEBP &bull; Maks 3 MB</small>
                                                </div>
                                            </div>
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

                    <!-- MODAL HAPUS STRUKTUR -->
                    <div class="modal fade" id="modalHapusStruktur{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.struktur.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0 d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <span>Konfirmasi Hapus Aparatur</span>
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus aparatur berikut dari bagan struktur organisasi?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small">{{ $item->nama }}</strong>
                                            <span class="badge bg-light text-muted border mt-1">{{ $item->jabatan }}</span>
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-diagram-3 fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada data struktur organisasi terdaftar.
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

<!-- ============================================================
     4. MODAL TAMBAH STRUKTUR
     ============================================================ -->
<div class="modal fade" id="modalTambahStruktur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-modern-wide">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-header-icon-squircle icon-squircle-blue">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-semibold text-dark mb-0">Tambah Pejabat / Staf Baru</h6>
                            <span class="text-muted" style="font-size: 0.72rem;">Susun hierarki aparatur bagian hukum dan tentukan atasan</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <!-- Kolom Kiri: Identitas & Jabatan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-dark">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" placeholder="Contoh: Drs. Antonius Simanjuntak, M.H." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-dark">Nama Jabatan Kedinasan <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Kepala Bagian Hukum" required>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label small fw-semibold text-dark">Tingkat Hierarki <span class="text-danger">*</span></label>
                                    <input type="number" name="tingkat" class="form-control" value="1" min="1" required>
                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem; line-height: 1.2;">1: Pimpinan, 2: Koord, 3+: Staf</small>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-semibold text-dark">Urutan Posisi</label>
                                    <input type="number" name="urutan" class="form-control" value="0">
                                    <small class="text-muted d-block mt-1" style="font-size: 0.7rem; line-height: 1.2;">Angka urut tampil</small>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Atasan & Foto Profil -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-dark">Atasan Langsung (Parent)</label>
                                <select name="parent_id" class="form-select">
                                    <option value="">-- Paling Atas (Root) --</option>
                                    @php
                                        $lvl1 = $allParents->where('tingkat', 1);
                                        $lvl2 = $allParents->where('tingkat', 2);
                                        $lvl3 = $allParents->where('tingkat', '>=', 3);
                                    @endphp
                                    @if($lvl1->count())
                                        <optgroup label="Tingkat 1 &bull; Pimpinan Utama">
                                            @foreach($lvl1 as $p)
                                                <option value="{{ $p->id }}">{{ $p->jabatan }} ({{ $p->nama }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                    @if($lvl2->count())
                                        <optgroup label="Tingkat 2 &bull; Koordinator / Sub-Bagian">
                                            @foreach($lvl2 as $p)
                                                <option value="{{ $p->id }}">{{ $p->jabatan }} ({{ $p->nama }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                    @if($lvl3->count())
                                        <optgroup label="Tingkat 3+ &bull; Staf / Pelaksana">
                                            @foreach($lvl3 as $p)
                                                <option value="{{ $p->id }}">{{ $p->jabatan }} ({{ $p->nama }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                </select>
                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Pilih atasan langsung dalam rantai komando</small>
                            </div>
                            <div class="mb-0">
                                <label class="form-label small fw-semibold text-dark">Foto Profil (Opsional)</label>
                                <div class="modern-file-uploader uploader-compact">
                                    <input type="file" name="foto" id="input_struktur_foto" class="uploader-native-input" accept="image/*" onchange="handleFileSelected(this, 'preview_struktur_foto')">
                                    <label for="input_struktur_foto" class="uploader-drop-area">
                                        <div class="uploader-icon-squircle">
                                            <i class="bi bi-person-bounding-box"></i>
                                        </div>
                                        <div class="uploader-text-wrapper">
                                            <span class="uploader-title">Pilih Pasfoto Aparatur</span>
                                            <span class="uploader-hint">JPG, PNG, WEBP &bull; Maksimal 3 MB</span>
                                        </div>
                                        <span class="uploader-browse-btn">Pilih Foto</span>
                                    </label>
                                    <div id="preview_struktur_foto" class="uploader-file-pill d-none">
                                        <i class="bi bi-person-check text-success me-2"></i>
                                        <span class="uploader-file-name text-truncate"></span>
                                        <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                                        <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_struktur_foto', 'preview_struktur_foto')">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3 fw-semibold"><i class="bi bi-check2 me-1"></i> Simpan Data Aparatur</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
