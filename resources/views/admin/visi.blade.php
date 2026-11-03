@extends('layouts.admin')

@section('title', 'Kelola Visi & Misi')
@section('page-title', 'Visi & Misi Pemerintah Kabupaten Toba')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="mb-4">
                <h5 class="fw-bold text-primary mb-1"><i class="bi bi-compass me-2"></i> Pengaturan Konten Visi & Misi</h5>
                <p class="text-muted small mb-0">Teks visi dan misi yang tampil di halaman profil publik portal JDIH Kabupaten Toba</p>
            </div>

            <form action="{{ route('admin.visi.save') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold">Visi Daerah <span class="text-danger">*</span></label>
                    <textarea name="visi" class="form-control @error('visi') is-invalid @enderror" rows="4" placeholder="Tuliskan pernyataan Visi Kabupaten Toba..." required>{{ old('visi', $data->visi ?? '') }}</textarea>
                    @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Misi Daerah <span class="text-danger">*</span></label>
                    <textarea name="misi" class="form-control @error('misi') is-invalid @enderror" rows="8" placeholder="Tuliskan poin-poin Misi Kabupaten Toba..." required>{{ old('misi', $data->misi ?? '') }}</textarea>
                    <small class="text-muted">Gunakan baris baru untuk memisahkan setiap poin misi.</small>
                    @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="{{ route('visi') }}" target="_blank" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-eye me-1"></i> Pratinjau Publik
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                        <i class="bi bi-check-lg me-1"></i> Simpan Visi & Misi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
