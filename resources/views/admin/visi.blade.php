@extends('layouts.admin')

@section('title', 'Kelola Visi & Misi')
@section('breadcrumb', 'Visi & Misi')
@section('page-title', 'Pengaturan Visi & Misi')

@section('content')

<!-- ============================================================
     PAGE HEADER WITH EXECUTIVE ACCENT
     ============================================================ -->
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Visi &amp; Misi Pemerintah Kabupaten Toba</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Pedoman RPJMD Daerah
            </span>
        </div>
        <p class="admin-page-subtitle">Pengaturan narasi visi pembangunan hukum dan misi strategis yang dipublikasikan pada profil portal publik JDIH</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('visi') }}" target="_blank" class="btn btn-sm btn-light border px-3">
            <i class="bi bi-box-arrow-up-right me-1 text-primary"></i>
            <span>Pratinjau Publik</span>
        </a>
    </div>
</div>

<!-- ============================================================
     FORM KONTEN VISI & MISI
     ============================================================ -->
<div class="row justify-content-center">
    <div class="col-xl-9 col-lg-10">
        <div class="admin-card">
            <div class="admin-card-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-text-fill text-primary"></i>
                    <h6 class="admin-card-title mb-0">Formulir Pernyataan Visi &amp; Misi Resmi</h6>
                </div>
                <span class="badge-status-pill status-active">
                    <span class="status-dot status-dot-emerald"></span>
                    Publikasi Aktif
                </span>
            </div>

            <div class="p-4">
                <form action="{{ route('admin.visi.save') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Visi Daerah Kabupaten Toba <span class="text-danger">*</span></label>
                        <textarea name="visi" class="form-control p-3 @error('visi') is-invalid @enderror" style="line-height: 1.6;" rows="4" placeholder="Tuliskan pernyataan Visi resmi Kabupaten Toba..." required>{{ old('visi', $data->visi ?? '') }}</textarea>
                        <small class="text-muted mt-2 d-flex align-items-center gap-1">
                            <i class="bi bi-info-circle text-secondary"></i> Pernyataan komprehensif arah pembangunan jangka panjang Pemerintah Kabupaten Toba.
                        </small>
                        @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Misi Daerah Kabupaten Toba <span class="text-danger">*</span></label>
                        <textarea name="misi" class="form-control p-3 @error('misi') is-invalid @enderror" style="line-height: 1.6;" rows="8" placeholder="Tuliskan butir-butir Misi strategis..." required>{{ old('misi', $data->misi ?? '') }}</textarea>
                        <small class="text-muted mt-2 d-flex align-items-center gap-1">
                            <i class="bi bi-info-circle text-secondary"></i> Gunakan baris baru untuk memisahkan setiap butir misi.
                        </small>
                        @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4 flex-wrap gap-2">
                        <span class="small text-muted">
                            <i class="bi bi-check-circle text-success me-1"></i> Perubahan akan langsung tampil di halaman publik portal JDIH.
                        </span>
                        <div class="d-flex gap-2">
                            <a href="{{ route('visi') }}" target="_blank" class="btn btn-sm btn-light border px-3">
                                Pratinjau
                            </a>
                            <button type="submit" class="btn btn-admin-primary px-4">
                                <i class="bi bi-check2-circle me-1"></i> Simpan Visi &amp; Misi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
