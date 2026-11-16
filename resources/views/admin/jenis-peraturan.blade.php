@extends('layouts.admin')

@section('title', 'Klasifikasi Jenis Peraturan')
@section('breadcrumb', 'Jenis Peraturan')
@section('page-title', 'Klasifikasi Jenis Peraturan')

@section('content')

<!-- ============================================================
     1. PAGE HEADER (CLEAN & EXECUTIVE)
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Klasifikasi Jenis Peraturan</h4>
            <span class="stat-pill stat-pill-slate">
                <span class="pulse-dot-emerald me-1"></span>
                Standar BPHN Permenkumham 8/2019
            </span>
        </div>
        <p class="admin-page-subtitle">Kelola master data klasifikasi kategori dan hierarki tata urutan perundang-undangan daerah</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahJenis">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Jenis Peraturan</span>
        </button>
    </div>
</div>

<!-- ============================================================
     2. BALANCED EXECUTIVE STAT CARDS (3-COLUMN KPI)
     ============================================================ -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Klasifikasi -->
    <div class="col-lg-4 col-md-6">
        <div class="admin-stat-card stat-card-blue">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Jenis Kategori</span>
                <div class="stat-card-icon">
                    <i class="bi bi-tags"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">{{ $totalKategori ?? count($jenisPeraturans) }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-check2-circle text-primary"></i> Klasifikasi regulasi terkonfigurasi
                </p>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Produk Terdata -->
    <div class="col-lg-4 col-md-6">
        <div class="admin-stat-card stat-card-emerald">
            <div class="stat-card-top">
                <span class="stat-card-label">Total Naskah Regulasi</span>
                <div class="stat-card-icon">
                    <i class="bi bi-file-earmark-check"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value">{{ $totalDokumen ?? $jenisPeraturans->sum('peraturans_count') }}</div>
                <p class="stat-card-subtext">
                    <i class="bi bi-shield-check text-success"></i> Dokumen aktif tersimpan di pangkalan data
                </p>
            </div>
        </div>
    </div>

    <!-- Card 3: Kategori Terbanyak -->
    <div class="col-lg-4 col-md-12">
        <div class="admin-stat-card stat-card-purple">
            <div class="stat-card-top">
                <span class="stat-card-label">Kategori Paling Aktif</span>
                <div class="stat-card-icon">
                    <i class="bi bi-bar-chart-steps"></i>
                </div>
            </div>
            <div>
                <div class="stat-card-value text-truncate" style="font-size: 1.45rem;">
                    {{ $topKategori ? ($topKategori->singkatan ?: Str::limit($topKategori->nama, 15)) : '-' }}
                </div>
                <p class="stat-card-subtext text-truncate">
                    <i class="bi bi-folder-check text-purple"></i> 
                    @if($topKategori)
                        {{ $topKategori->peraturans_count }} naskah ({{ $totalDokumen > 0 ? round(($topKategori->peraturans_count / $totalDokumen) * 100) : 0 }}% dari total dokumen)
                    @else
                        Belum ada dokumen
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     3. TABEL KLASIFIKASI REGULASI (REGISTRY TABLE)
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Klasifikasi &amp; Tata Urutan Regulasi</h6>
            <span class="badge bg-light text-dark border px-2">{{ count($jenisPeraturans) }} Master Kategori</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table admin-table-registry align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 75px;">Urutan</th>
                    <th>Nama Klasifikasi &amp; Slug Sistem</th>
                    <th style="width: 130px;">Singkatan</th>
                    <th>Deskripsi Regulasi</th>
                    <th class="text-center" style="width: 170px;">Total Dokumen</th>
                    <th class="text-end pe-4" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisPeraturans as $item)
                    @php
                        $singk = strtoupper($item->singkatan ?? '');
                        $pillClass = 'pill-type-default';
                        if ($singk === 'PERDA') $pillClass = 'pill-type-perda';
                        elseif ($singk === 'PERBUP') $pillClass = 'pill-type-perbup';
                        elseif ($singk === 'KEPBUP') $pillClass = 'pill-type-kepbup';
                        elseif ($singk === 'INBUP') $pillClass = 'pill-type-inbup';
                    @endphp
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip" title="Prioritas Urutan Hierarki">
                                #{{ $item->urutan }}
                            </span>
                        </td>
                        <td>
                            <span class="d-block fw-semibold text-dark mb-1" style="font-size: 0.875rem;">{{ $item->nama }}</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="registry-doc-badge font-monospace" style="font-size: 0.7rem;">
                                    <i class="bi bi-link-45deg me-1"></i>/kategori/{{ $item->slug }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <span class="pill-type-badge {{ $pillClass }}">
                                {{ $item->singkatan ?: '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="text-muted small" style="line-height: 1.45; display: block; max-width: 380px;">
                                {{ $item->deskripsi ?: 'Tidak ada keterangan tambahan.' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.peraturan.index', ['jenis_id' => $item->id]) }}" class="badge-reg-link" title="Buka dan filter dokumen {{ $item->nama }}">
                                <i class="bi bi-folder2-open"></i>
                                <span>{{ $item->peraturans_count }} Dokumen</span>
                                <i class="bi bi-arrow-up-right small"></i>
                            </a>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}" title="Edit Master Jenis">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}" title="Hapus Master Jenis">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT JENIS -->
                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-modern-md">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.jenis-peraturan.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header d-flex align-items-center justify-content-between py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="modal-header-icon-squircle icon-squircle-amber">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                            <div>
                                                <h6 class="modal-title fw-semibold text-dark mb-0">Edit Klasifikasi Regulasi</h6>
                                                <span class="text-muted" style="font-size: 0.72rem;">Perbarui singkatan, hierarki, dan deskripsi yuridis</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-dark">Nama Jenis Peraturan <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold text-dark">Singkatan Dokumen</label>
                                                <input type="text" name="singkatan" class="form-control" value="{{ $item->singkatan }}" placeholder="Contoh: PERDA">
                                                <small class="text-muted" style="font-size: 0.72rem;">Maksimal 50 karakter.</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-semibold text-dark">Urutan Hierarki</label>
                                                <input type="number" name="urutan" class="form-control" value="{{ $item->urutan }}">
                                                <small class="text-muted" style="font-size: 0.72rem;">Nomor tata urutan UU.</small>
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-semibold text-dark">Deskripsi &amp; Cakupan</label>
                                            <textarea name="deskripsi" class="form-control" rows="3">{{ $item->deskripsi }}</textarea>
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

                    <!-- MODAL HAPUS JENIS -->
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.jenis-peraturan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0 d-flex align-items-center gap-2">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <span>Konfirmasi Hapus Klasifikasi</span>
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Apakah Anda yakin ingin menghapus klasifikasi jenis peraturan berikut?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block">{{ $item->nama }}</strong>
                                            <span class="badge bg-light text-muted border mt-1">{{ $item->singkatan ?: '-' }}</span>
                                        </div>
                                        @if($item->peraturans_count > 0)
                                            <div class="alert alert-warning small mb-0 text-start border-0 shadow-xs">
                                                <i class="bi bi-info-circle-fill me-1 text-warning"></i> Klasifikasi ini masih memiliki <strong>{{ $item->peraturans_count }} dokumen peraturan</strong>. Pindahkan atau hapus dokumen tersebut terlebih dahulu.
                                            </div>
                                        @else
                                            <p class="text-danger small mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer border-top p-3">
                                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-sm btn-danger px-3 fw-semibold" {{ $item->peraturans_count > 0 ? 'disabled' : '' }}>Ya, Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-tags fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada master jenis peraturan terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ============================================================
     4. MODAL TAMBAH JENIS BARU
     ============================================================ -->
<div class="modal fade" id="modalTambahJenis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-modern-md">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.jenis-peraturan.store') }}" method="POST">
                @csrf
                <div class="modal-header d-flex align-items-center justify-content-between py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="modal-header-icon-squircle icon-squircle-blue">
                            <i class="bi bi-tags"></i>
                        </div>
                        <div>
                            <h6 class="modal-title fw-semibold text-dark mb-0">Tambah Jenis Peraturan Baru</h6>
                            <span class="text-muted" style="font-size: 0.72rem;">Konfigurasikan klasifikasi master regulasi daerah</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-dark">Nama Jenis Peraturan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" placeholder="Contoh: Instruksi Bupati" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-dark">Singkatan Dokumen</label>
                            <input type="text" name="singkatan" class="form-control" placeholder="Contoh: INBUP">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold text-dark">Urutan Hierarki</label>
                            <input type="number" name="urutan" class="form-control" value="0">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-dark">Deskripsi &amp; Landasan Yuridis</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan mengenai jenis peraturan ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top p-3">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Simpan Master Jenis</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
