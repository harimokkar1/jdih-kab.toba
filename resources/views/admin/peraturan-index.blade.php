@extends('layouts.admin')

@section('title', 'Dokumen Produk Hukum')
@section('page-title', 'Submenu 2: Isi Dokumen Peraturan')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <p class="text-muted small mb-0">Kelola arsip dokumen peraturan daerah Kabupaten Toba dan berkas lampirannya</p>
    </div>
    <a href="{{ route('admin.peraturan.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Dokumen Peraturan
    </a>
</div>

<!-- FILTER SEARCH -->
<div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
    <form action="{{ route('admin.peraturan.index') }}" method="GET">
        <div class="row g-2 align-items-end">
            <div class="col-lg-5 col-md-4">
                <label class="form-label small fw-bold mb-1">Cari Judul / Nomor</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Kata kunci..." value="{{ request('search') }}">
            </div>
            <div class="col-lg-3 col-md-3">
                <label class="form-label small fw-bold mb-1">Jenis Peraturan</label>
                <select name="jenis_id" class="form-select form-select-sm">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}" {{ request('jenis_id') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2 col-md-2">
                <label class="form-label small fw-bold mb-1">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                    <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 w-100">
                    <i class="bi bi-search me-1"></i> Filter
                </button>
                <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Reset</a>
            </div>
        </div>
    </form>
</div>

<!-- TABEL DOKUMEN -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 50px;">No</th>
                    <th>Judul Peraturan</th>
                    <th>Jenis</th>
                    <th>Nomor & Tahun</th>
                    <th>Status</th>
                    <th>Lampiran</th>
                    <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peraturans as $index => $item)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $peraturans->firstItem() + $index }}</td>
                        <td>
                            <strong class="text-dark d-block">{{ Str::limit($item->judul, 75) }}</strong>
                            <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Upload: {{ $item->tanggal_upload ? $item->tanggal_upload->format('d/m/Y') : '-' }} | <i class="bi bi-eye"></i> {{ $item->view_count }} | <i class="bi bi-download"></i> {{ $item->download_count }}</small>
                        </td>
                        <td><span class="badge-jenis">{{ $item->jenisPeraturan->nama ?? '-' }}</span></td>
                        <td>
                            <span class="fw-semibold">No. {{ $item->nomor_peraturan ?? '-' }}</span><br>
                            <small class="text-muted">Tahun {{ $item->tahun ?? '-' }}</small>
                        </td>
                        <td>
                            <span class="{{ $item->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <span class="badge bg-danger" title="PDF Utama"><i class="bi bi-file-pdf"></i></span>
                                @if($item->english_version)
                                    <span class="badge bg-primary" title="English"><i class="bi bi-translate"></i></span>
                                @endif
                                @if($item->braille)
                                    <span class="badge bg-warning text-dark" title="Braille"><i class="bi bi-eye-slash"></i></span>
                                @endif
                                @if($item->alih_suara)
                                    <span class="badge bg-success" title="Audio"><i class="bi bi-volume-up"></i></span>
                                @endif
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('user.produk-hukum.detail', $item->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Pratinjau Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.peraturan.edit', $item->id) }}" class="btn btn-sm btn-outline-warning text-dark" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- MODAL HAPUS -->
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.peraturan.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold text-danger">Konfirmasi Hapus Dokumen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4 text-center">
                                        <i class="bi bi-exclamation-triangle text-danger display-4 mb-3 d-block"></i>
                                        <p class="mb-1">Hapus dokumen peraturan hukum berikut beserta seluruh file lampirannya?</p>
                                        <h6 class="fw-bold mt-2">{{ $item->judul }}</h6>
                                        <small class="text-muted">Nomor {{ $item->nomor_peraturan }} Tahun {{ $item->tahun }}</small>
                                    </div>
                                    <div class="modal-footer border-top">
                                        <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger rounded-pill px-4">Ya, Hapus Dokumen</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-file-earmark-x fs-2 d-block mb-2 text-secondary"></i>
                            Belum ada dokumen peraturan yang sesuai.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $peraturans->links() }}
</div>
@endsection
