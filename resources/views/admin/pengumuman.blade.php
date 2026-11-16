@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')
@section('breadcrumb', 'Pengumuman')
@section('page-title', 'Kelola Pengumuman')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Pengumuman &amp; Maklumat Resmi</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Pemberitahuan Publik
            </span>
        </div>
        <p class="admin-page-subtitle">Publikasi pengumuman kedinasan, surat edaran, dan maklumat resmi Bagian Hukum Sekretariat Daerah Kabupaten Toba</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <button type="button" class="btn btn-outline-primary btn-sm px-3 py-2 fw-semibold rounded-3 d-flex align-items-center gap-1.5" data-bs-toggle="modal" data-bs-target="#modalKelolaKategori">
            <i class="bi bi-tags"></i>
            <span>Kelola Kategori</span>
        </button>
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengumuman">
            <i class="bi bi-plus-lg"></i>
            <span>Buat Pengumuman Baru</span>
        </button>
    </div>
</div>

<!-- ============================================================
     TABEL PENGUMUMAN
     ============================================================ -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="d-flex align-items-center gap-2">
            <h6 class="admin-card-title mb-0">Daftar Maklumat &amp; Edaran Publik</h6>
            <span class="badge bg-light text-dark border px-2">{{ $pengumumans->total() }} Pengumuman</span>
        </div>
        <span class="admin-header-badge d-none d-sm-inline-flex">
            <i class="bi bi-megaphone text-primary"></i>
            Papan Informasi Resmi
        </span>
    </div>

    <div class="table-responsive">
        <table class="table admin-table align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4 text-center" style="width: 50px;">No</th>
                    <th>Judul Maklumat / Edaran</th>
                    <th style="width: 170px;">Kategori</th>
                    <th style="width: 160px;">Tanggal Terbit</th>
                    <th style="width: 130px;">Berkas PDF</th>
                    <th class="text-end pe-4" style="width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumumans as $index => $p)
                    <tr>
                        <td class="ps-4 text-center">
                            <span class="table-rank-chip">{{ $pengumumans->firstItem() + $index }}</span>
                        </td>
                        <td>
                            <strong class="text-dark d-block">{{ $p->judul }}</strong>
                            <small class="text-muted d-block mt-1">{{ Str::limit(strip_tags($p->isi), 95) }}</small>
                        </td>
                        <td>
                            @if($p->kategori)
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 small rounded-2">
                                    {{ $p->kategori->nama }}
                                </span>
                            @else
                                <span class="badge bg-light text-muted border px-2 py-1 small rounded-2">
                                    Tanpa Kategori
                                </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark small d-block"><i class="bi bi-calendar3 me-1 text-muted"></i>{{ $p->tanggal_upload ? $p->tanggal_upload->format('d/m/Y') : '-' }}</span>
                            <small class="text-muted">Publikasi Resmi</small>
                        </td>
                        <td>
                            @if($p->file_pdf)
                                <a href="{{ asset('uploads/pengumuman/' . $p->file_pdf) }}" target="_blank" class="badge-doc-pdf" title="Buka File Lampiran PDF">
                                    <i class="bi bi-file-earmark-pdf"></i> Unduh PDF
                                </a>
                            @else
                                <span class="badge bg-light text-muted border">Tanpa PDF</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('pengumuman.show', $p->id) }}" target="_blank" class="btn-action-icon btn-action-view" title="Pratinjau Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <button type="button" class="btn-action-icon btn-action-edit" data-bs-toggle="modal" data-bs-target="#modalEditPengumuman{{ $p->id }}" title="Edit Pengumuman">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn-action-icon btn-action-delete" data-bs-toggle="modal" data-bs-target="#modalHapusPengumuman{{ $p->id }}" title="Hapus Pengumuman">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL EDIT -->
                    <div class="modal fade" id="modalEditPengumuman{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.pengumuman.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom py-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                            <h6 class="modal-title fw-bold mb-0">Edit Pengumuman</h6>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                                            <input type="text" name="judul" class="form-control" value="{{ $p->judul }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Kategori Pengumuman</label>
                                            <select name="kategori_id" class="form-select">
                                                <option value="">-- Tanpa Kategori --</option>
                                                @foreach($kategoriList as $kat)
                                                    <option value="{{ $kat->id }}" {{ $p->kategori_id == $kat->id ? 'selected' : '' }}>
                                                        {{ $kat->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Tanggal Publikasi <span class="text-danger">*</span></label>
                                            <input type="date" name="tanggal_upload" class="form-control" value="{{ $p->tanggal_upload ? $p->tanggal_upload->format('Y-m-d') : date('Y-m-d') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Ganti Berkas PDF Lampiran (Opsional)</label>
                                            <input type="file" name="file_pdf" class="form-control form-control-sm" accept=".pdf">
                                            <small class="text-muted">Biarkan kosong jika tetap menggunakan file lampiran saat ini.</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                                            <textarea name="isi" class="form-control" rows="6" required>{{ $p->isi }}</textarea>
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
                    <div class="modal fade" id="modalHapusPengumuman{{ $p->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
                            <div class="modal-content rounded-3 border-0 shadow">
                                <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom py-3">
                                        <h6 class="modal-title fw-bold text-danger mb-0">
                                            <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Pengumuman
                                        </h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <p class="text-muted small mb-2">Hapus pengumuman berikut secara permanen?</p>
                                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                                            <strong class="text-dark d-block small">{{ $p->judul }}</strong>
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-megaphone fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada pengumuman yang diterbitkan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengumumans->hasPages())
        <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="small text-muted">
                Menampilkan {{ $pengumumans->firstItem() }} - {{ $pengumumans->lastItem() }} dari {{ $pengumumans->total() }} pengumuman
            </span>
            <div>
                {{ $pengumumans->links() }}
            </div>
        </div>
    @endif
</div>

<!-- MODAL TAMBAH PENGUMUMAN -->
<div class="modal fade" id="modalTambahPengumuman" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-bottom py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-megaphone text-primary"></i>
                        <h6 class="modal-title fw-bold mb-0">Buat Pengumuman Baru</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" placeholder="Tuliskan judul maklumat atau surat edaran..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kategori Pengumuman</label>
                        <select name="kategori_id" class="form-select">
                            <option value="">-- Tanpa Kategori --</option>
                            @foreach($kategoriList as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tanggal Publikasi <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_upload" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Berkas PDF Lampiran (Opsional)</label>
                        <input type="file" name="file_pdf" class="form-control form-control-sm" accept=".pdf">
                        <small class="text-muted">Maksimal 10 MB (Format PDF resmi).</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control" rows="6" placeholder="Tuliskan uraian lengkap pengumuman di sini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top py-2">
                    <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Terbitkan Pengumuman</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL KELOLA KATEGORI PENGUMUMAN -->
<div class="modal fade" id="modalKelolaKategori" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3 border-0 shadow">
            <div class="modal-header border-bottom py-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-tags text-primary"></i>
                    <h6 class="modal-title fw-bold mb-0">Kelola Kategori Pengumuman</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- FORM TAMBAH KATEGORI BARU -->
                <div class="card border rounded-3 p-3 bg-light mb-4">
                    <h6 class="fw-bold text-dark small mb-2 d-flex align-items-center gap-1.5">
                        <i class="bi bi-plus-circle text-primary"></i>
                        <span>Tambah Kategori Baru</span>
                    </h6>
                    <form action="{{ route('admin.pengumuman.kategori.store') }}" method="POST">
                        @csrf
                        <div class="row g-2 align-items-center">
                            <div class="col-md-9">
                                <input type="text" name="nama" class="form-control" placeholder="Nama kategori baru (contoh: Siaran Pers, Surat Edaran)..." required>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-admin-primary w-100">
                                    <i class="bi bi-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- DAFTAR KATEGORI SAAT INI -->
                <h6 class="fw-bold text-dark small mb-2">Daftar Kategori Terdaftar ({{ count($kategoriList) }})</h6>
                <div class="table-responsive border rounded-3 bg-white">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-3 text-center" style="width: 50px;">No</th>
                                <th>Nama Kategori</th>
                                <th style="width: 170px;">Jumlah Pengumuman</th>
                                <th class="text-end pe-3" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoriList as $kIndex => $kat)
                                <tr>
                                    <td class="ps-3 text-center small text-muted">{{ $kIndex + 1 }}</td>
                                    <td>
                                        <strong class="text-dark d-block small">{{ $kat->nama }}</strong>
                                        <code class="text-muted" style="font-size: 0.75rem;">slug: {{ $kat->slug }}</code>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border px-2 py-1 small rounded-2">
                                            {{ $kat->pengumumans_count }} Pengumuman
                                        </span>
                                    </td>
                                    <td class="text-end pe-3">
                                        <div class="d-flex justify-content-end gap-1">
                                            <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1" data-bs-toggle="modal" data-bs-target="#modalEditKategori{{ $kat->id }}" title="Edit Kategori">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" data-bs-toggle="modal" data-bs-target="#modalHapusKategori{{ $kat->id }}" title="Hapus Kategori">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">
                                        Belum ada kategori yang dibuat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-top py-2">
                <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT & HAPUS PER KATEGORI -->
@foreach($kategoriList as $kat)
    <!-- MODAL EDIT KATEGORI -->
    <div class="modal fade" id="modalEditKategori{{ $kat->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content rounded-3 border-0 shadow">
                <form action="{{ route('admin.pengumuman.kategori.update', $kat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-bottom py-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-pencil-square text-warning"></i>
                            <h6 class="modal-title fw-bold mb-0">Edit Kategori Pengumuman</h6>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ $kat->nama }}" required>
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

    <!-- MODAL HAPUS KATEGORI -->
    <div class="modal fade" id="modalHapusKategori{{ $kat->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content rounded-3 border-0 shadow">
                <form action="{{ route('admin.pengumuman.kategori.destroy', $kat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header border-bottom py-3">
                        <h6 class="modal-title fw-bold text-danger mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i> Konfirmasi Hapus Kategori
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <p class="text-muted small mb-2">Hapus kategori pengumuman berikut?</p>
                        <div class="p-3 bg-light rounded-3 border my-3 text-start">
                            <strong class="text-dark d-block small">{{ $kat->nama }}</strong>
                            <small class="text-muted">{{ $kat->pengumumans_count }} pengumuman tertaut</small>
                        </div>
                        <p class="text-danger small mb-0">Pengumuman pada kategori ini akan tetap tersimpan (menjadi tanpa kategori).</p>
                    </div>
                    <div class="modal-footer border-top py-2">
                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-danger px-3">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
