@extends('layouts.admin')

@section('title', 'Klasifikasi Jenis Peraturan')
@section('breadcrumb', 'Jenis Peraturan')
@section('page-title', 'Klasifikasi Jenis Peraturan')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Klasifikasi Jenis Peraturan</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Standar BPHN &amp; SPBE 2.4
            </span>
        </div>
        <p class="admin-page-subtitle">Kelola master data klasifikasi kategori dan hierarki tata urutan produk hukum daerah</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahJenis">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Jenis Peraturan</span>
        </button>
    </div>
</div>

<!-- ============================================================
     EXECUTIVE SUMMARY KPI CHIPS
     ============================================================ -->
<div class="row g-3 mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="admin-stat-card stat-card-blue">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Jenis Kategori</span>
                <div class="stat-card-icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">{{ count($jenisPeraturans) }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-check2-circle text-primary"></i> Klasifikasi regulasi terkonfigurasi
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="admin-stat-card stat-card-emerald">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Produk Hukum Terdata</span>
                <div class="stat-card-icon">
                    <i class="bi bi-file-earmark-check"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">{{ $jenisPeraturans->sum('peraturans_count') }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-shield-check text-success"></i> Dokumen peraturan tersimpan di sistem
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="admin-stat-card stat-card-amber">
            <div class="stat-card-top">
                <span class="stat-card-label">Status Hierarki</span>
                <div class="stat-card-icon">
                    <i class="bi bi-diagram-3"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value" style="color: #b45309;">Sesuai UU 12/2011</div>
                <div class="stat-card-subtext">
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Perda &bull; Perbup &bull; Kepbup &bull; Inbup</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     TABEL JENIS PERATURAN
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Klasifikasi &amp; Tata Urutan Regulasi</h6>
            <span class="badge bg-light text-dark border px-2">{{ count($jenisPeraturans) }} Kategori</span>
        </div>
        <span class="admin-header-badge d-none d-sm-inline-flex">
            <i class="bi bi-patch-check-fill text-primary"></i>
            Metadata Terintegrasi JDIHN
        </span>
    </div>

    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 70px;">Urutan</th>
                    <th>Nama Jenis Peraturan</th>
                    <th style="width: 120px;">Singkatan</th>
                    <th>Slug URL</th>
                    <th>Deskripsi</th>
                    <th class="text-center" style="width: 140px;">Total Dokumen</th>
                    <th class="text-end pe-4" style="width: 110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisPeraturans as $item)
                    @php
                        $singk = strtoupper($item->singkatan ?? '');
                        $badgeClass = 'badge-tag-default';
                        if ($singk === 'PERDA') $badgeClass = 'badge-tag-perda';
                        elseif ($singk === 'PERBUP') $badgeClass = 'badge-tag-perbup';
                        elseif ($singk === 'KEPBUP') $badgeClass = 'badge-tag-kepbup';
                        elseif ($singk === 'INBUP') $badgeClass = 'badge-tag-inbup';
                        elseif ($singk === 'SE') $badgeClass = 'badge-tag-se';
                    @endphp
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $item->urutan }}</span>
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $item->nama }}</strong>
                        </td>
                        <td>
                            <span class="{{ $badgeClass }}">{{ $item->singkatan ?: '-' }}</span>
                        </td>
                        <td>
                            <code class="small text-secondary bg-white px-2 py-1 rounded border">{{ $item->slug }}</code>
                        </td>
                        <td>
                            <span class="small text-muted">{{ Str::limit($item->deskripsi, 65) ?: '-' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-semibold">
                                {{ $item->peraturans_count }} Dokumen
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}" title="Edit Jenis Peraturan">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}" title="Hapus Jenis Peraturan">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.jenis-peraturan.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom py-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                            <h6 class="modal-title fw-bold mb-0">Edit Jenis Peraturan</h6>
                                        </div>
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
                                    <div class="modal-footer border-top py-2">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-admin-primary px-3">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL HAPUS -->
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.jenis-peraturan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Jenis
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Apakah Anda yakin ingin menghapus klasifikasi jenis peraturan berikut?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3">
                                            <strong class="text-dark d-block">{{ $item->nama }}</strong>
                                            <span class="badge bg-light text-muted border mt-1">{{ $item->singkatan ?: '-' }}</span>
                                        </div>
                                        @if($item->peraturans_count > 0)
                                            <div class="alert alert-warning small mb-0 text-start">
                                                <i class="bi bi-info-circle me-1"></i> Klasifikasi ini masih memiliki <strong>{{ $item->peraturans_count }} dokumen peraturan</strong>. Pindahkan atau hapus dokumen tersebut terlebih dahulu.
                                            </div>
                                        @else
                                            <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer border-top py-2">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-danger px-3" {{ $item->peraturans_count > 0 ? 'disabled' : '' }}>Ya, Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-tags fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada master jenis peraturan terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH JENIS -->
<div class="modal fade" id="modalTambahJenis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.jenis-peraturan.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle text-primary"></i>
                        <h6 class="modal-title fw-bold mb-0">Tambah Jenis Peraturan Baru</h6>
                    </div>
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
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Simpan Jenis</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
