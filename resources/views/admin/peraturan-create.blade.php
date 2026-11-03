@extends('layouts.admin')

@section('title', 'Tambah Dokumen Peraturan')
@section('page-title', 'Tambah Dokumen Produk Hukum')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.peraturan.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
</div>

<form action="{{ route('admin.peraturan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-4">
        <!-- KOLOM KIRI: METADATA UTAMA -->
        <div class="col-lg-8">
            <!-- 1. INFORMASI DASAR -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle me-2"></i> 1. Informasi Utama</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Jenis Peraturan <span class="text-danger">*</span></label>
                        <select name="jenis_peraturan_id" class="form-select @error('jenis_peraturan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Peraturan --</option>
                            @foreach($jenisList as $j)
                                <option value="{{ $j->id }}" {{ old('jenis_peraturan_id') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }} ({{ $j->singkatan }})
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_peraturan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Tipe Dokumen</label>
                        <input type="text" name="tipe_dokumen" class="form-control" value="{{ old('tipe_dokumen', 'Peraturan Perundang-undangan') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold">Judul Lengkap Peraturan <span class="text-danger">*</span></label>
                        <textarea name="judul" class="form-control @error('judul') is-invalid @enderror" rows="3" placeholder="Masukkan judul lengkap peraturan..." required>{{ old('judul') }}</textarea>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">T.E.U. Badan / Pemrakarsa</label>
                        <input type="text" name="teu_badan" class="form-control" value="{{ old('teu_badan', 'Pemerintah Kabupaten Toba') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Bidang Hukum</label>
                        <input type="text" name="bidang_hukum" class="form-control" placeholder="Contoh: Hukum Administrasi Negara" value="{{ old('bidang_hukum') }}">
                    </div>
                </div>
            </div>

            <!-- 2. DETAIL PENETAPAN -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-calendar3 me-2"></i> 2. Penomoran & Tanggal</h5>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Nomor Peraturan <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_peraturan" class="form-control @error('nomor_peraturan') is-invalid @enderror" placeholder="Contoh: 15" value="{{ old('nomor_peraturan') }}" required>
                        @error('nomor_peraturan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', date('Y')) }}" required>
                        @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tempat Penetapan</label>
                        <input type="text" name="tempat_penetapan" class="form-control" value="{{ old('tempat_penetapan', 'Balige') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Penetapan</label>
                        <input type="date" name="tanggal_penetapan" class="form-control" value="{{ old('tanggal_penetapan') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Pengundangan</label>
                        <input type="date" name="tanggal_pengundangan" class="form-control" value="{{ old('tanggal_pengundangan') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Upload</label>
                        <input type="date" name="tanggal_upload" class="form-control" value="{{ old('tanggal_upload', date('Y-m-d')) }}">
                    </div>
                </div>
            </div>

            <!-- 3. DESKRIPSI & ABSTRAK -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-text me-2"></i> 3. Abstrak & Deskripsi</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Sumber</label>
                        <input type="text" name="sumber" class="form-control" placeholder="Contoh: Lembaran Daerah Tahun 2026 No. 1" value="{{ old('sumber') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Subjek Peraturan</label>
                        <input type="text" name="subjek" class="form-control" placeholder="Contoh: Pajak Daerah, Tata Ruang" value="{{ old('subjek') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Bahasa</label>
                        <input type="text" name="bahasa" class="form-control" value="{{ old('bahasa', 'Bahasa Indonesia') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Lokasi Fisik Dokumen</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', 'Bagian Hukum Setdakab Toba') }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold">Abstrak Peraturan</label>
                        <textarea name="abstrak" class="form-control" rows="4" placeholder="Ringkasan atau pokok-pokok isi peraturan...">{{ old('abstrak') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: STATUS & BERKAS LAMPIRAN -->
        <div class="col-lg-4">
            <!-- STATUS -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h6 class="fw-bold text-dark mb-3">Status Keberlakuan</h6>
                <div class="mb-3">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="status" id="statusBerlaku" value="BERLAKU" {{ old('status', 'BERLAKU') === 'BERLAKU' ? 'checked' : '' }}>
                        <label class="form-check-label text-success fw-bold" for="statusBerlaku">
                            <i class="bi bi-check-circle-fill me-1"></i> BERLAKU
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="statusTidak" value="TIDAK BERLAKU" {{ old('status') === 'TIDAK BERLAKU' ? 'checked' : '' }}>
                        <label class="form-check-label text-danger fw-bold" for="statusTidak">
                            <i class="bi bi-x-circle-fill me-1"></i> TIDAK BERLAKU
                        </label>
                    </div>
                </div>
            </div>

            <!-- UNGGAH FILE -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-paperclip me-1"></i> Berkas Lampiran</h6>

                <!-- FILE UTAMA -->
                <div class="mb-3">
                    <label class="form-label small fw-bold text-primary">File PDF Dokumen Utama <span class="text-danger">*</span></label>
                    <input type="file" name="file_dokumen" class="form-control form-control-sm @error('file_dokumen') is-invalid @enderror" accept=".pdf" required>
                    <small class="text-muted d-block mt-1">Maksimal 30 MB (Wajib format PDF).</small>
                    @error('file_dokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr class="my-3">

                <!-- ENGLISH VERSION -->
                <div class="mb-3">
                    <label class="form-label small fw-bold">English Version (Opsional)</label>
                    <input type="file" name="english_version" class="form-control form-control-sm" accept=".pdf">
                    <small class="text-muted">PDF bahasa Inggris bila tersedia.</small>
                </div>

                <!-- BRAILLE -->
                <div class="mb-3">
                    <label class="form-label small fw-bold">Format Braille (Opsional)</label>
                    <input type="file" name="braille" class="form-control form-control-sm" accept=".pdf">
                    <small class="text-muted">PDF format braille bagi disabilitas.</small>
                </div>

                <!-- AUDIO ALIH SUARA -->
                <div class="mb-3">
                    <label class="form-label small fw-bold">Alih Suara / Audio (Opsional)</label>
                    <input type="file" name="alih_suara" class="form-control form-control-sm" accept=".mp3,.wav,.m4a,.ogg">
                    <small class="text-muted">File audio rekaman (MP3/WAV/OGG).</small>
                </div>
            </div>

            <!-- SUBMIT ACTION -->
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <button type="submit" class="btn btn-primary rounded-pill w-100 py-2 fw-bold shadow-sm mb-2">
                    <i class="bi bi-cloud-arrow-up-fill me-1"></i> Simpan Dokumen
                </button>
                <a href="{{ route('admin.peraturan.index') }}" class="btn btn-light rounded-pill w-100">Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection
