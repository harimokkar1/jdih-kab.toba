@extends('layouts.admin')

@section('title', 'Edit Dokumen Peraturan')
@section('breadcrumb', 'Edit Peraturan')
@section('page-title', 'Edit Dokumen Produk Hukum')

@section('content')
<div class="admin-page-header">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
            <h4 class="admin-page-title mb-0">Edit Dokumen Produk Hukum</h4>
            <span class="admin-header-badge">
                <span class="badge-dot"></span>
                Metadata Standar BPHN
            </span>
        </div>
        <p class="admin-page-subtitle">Perbarui data peraturan, nomor ketetapan, dan berkas lampiran naskah hukum daerah</p>
    </div>
    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
        <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-light border px-3">
            <i class="bi bi-arrow-left me-1"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>
</div>

<form action="{{ route('admin.peraturan.update', $peraturan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <!-- METADATA UTAMA -->
        <div class="col-lg-8">
            <!-- 1. INFORMASI DASAR -->
            <div class="admin-card form-card p-4 mb-4">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-info-circle me-2"></i> 1. Informasi Utama</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Jenis Peraturan <span class="text-danger">*</span></label>
                        <select name="jenis_peraturan_id" class="form-select @error('jenis_peraturan_id') is-invalid @enderror" required>
                            @foreach($jenisList as $j)
                                <option value="{{ $j->id }}" {{ old('jenis_peraturan_id', $peraturan->jenis_peraturan_id) == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama }} ({{ $j->singkatan }})
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_peraturan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Tipe Dokumen</label>
                        <input type="text" name="tipe_dokumen" class="form-control" value="{{ old('tipe_dokumen', $peraturan->tipe_dokumen) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold">Judul Lengkap Peraturan <span class="text-danger">*</span></label>
                        <textarea name="judul" class="form-control @error('judul') is-invalid @enderror" rows="3" required>{{ old('judul', $peraturan->judul) }}</textarea>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">T.E.U. Badan / Pemrakarsa</label>
                        <input type="text" name="teu_badan" class="form-control" value="{{ old('teu_badan', $peraturan->teu_badan) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Bidang Hukum</label>
                        <input type="text" name="bidang_hukum" class="form-control" value="{{ old('bidang_hukum', $peraturan->bidang_hukum) }}">
                    </div>
                </div>
            </div>

            <!-- 2. DETAIL PENETAPAN -->
            <div class="admin-card p-4 mb-4">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-calendar3 me-2"></i> 2. Penomoran & Tanggal</h5>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Nomor Peraturan <span class="text-danger">*</span></label>
                        <input type="text" name="nomor_peraturan" class="form-control @error('nomor_peraturan') is-invalid @enderror" value="{{ old('nomor_peraturan', $peraturan->nomor_peraturan) }}" required>
                        @error('nomor_peraturan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', $peraturan->tahun) }}" required>
                        @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tempat Penetapan</label>
                        <input type="text" name="tempat_penetapan" class="form-control" value="{{ old('tempat_penetapan', $peraturan->tempat_penetapan) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Penetapan</label>
                        <input type="date" name="tanggal_penetapan" class="form-control" value="{{ old('tanggal_penetapan', $peraturan->tanggal_penetapan ? $peraturan->tanggal_penetapan->format('Y-m-d') : '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Pengundangan</label>
                        <input type="date" name="tanggal_pengundangan" class="form-control" value="{{ old('tanggal_pengundangan', $peraturan->tanggal_pengundangan ? $peraturan->tanggal_pengundangan->format('Y-m-d') : '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Tanggal Upload</label>
                        <input type="date" name="tanggal_upload" class="form-control" value="{{ old('tanggal_upload', $peraturan->tanggal_upload ? $peraturan->tanggal_upload->format('Y-m-d') : '') }}">
                    </div>
                </div>
            </div>

            <!-- 3. DESKRIPSI & ABSTRAK -->
            <div class="admin-card p-4">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-text me-2"></i> 3. Abstrak & Deskripsi</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Sumber</label>
                        <input type="text" name="sumber" class="form-control" value="{{ old('sumber', $peraturan->sumber) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Subjek Peraturan</label>
                        <input type="text" name="subjek" class="form-control" value="{{ old('subjek', $peraturan->subjek) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Bahasa</label>
                        <input type="text" name="bahasa" class="form-control" value="{{ old('bahasa', $peraturan->bahasa) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Lokasi Fisik Dokumen</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $peraturan->lokasi) }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-bold">Abstrak Peraturan</label>
                        <textarea name="abstrak" class="form-control" rows="4">{{ old('abstrak', $peraturan->abstrak) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATUS & FILE -->
        <div class="col-lg-4">
            <!-- STATUS -->
            <div class="admin-card p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-semibold text-dark mb-0">Status Keberlakuan</h6>
                    <span class="text-muted" style="font-size: 0.72rem;">Efektivitas Hukum</span>
                </div>
                
                <div class="segmented-status-group">
                    <input type="radio" class="btn-check" name="status" id="statusBerlaku" value="BERLAKU" autocomplete="off" {{ old('status', $peraturan->status) === 'BERLAKU' ? 'checked' : '' }}>
                    <label class="segmented-status-card status-card-berlaku" for="statusBerlaku">
                        <div class="d-flex align-items-center gap-2.5">
                            <span class="status-indicator-dot"></span>
                            <div>
                                <div class="status-title">BERLAKU</div>
                                <div class="status-desc">Regulasi aktif &amp; mengikat</div>
                            </div>
                        </div>
                        <i class="bi bi-check2-circle status-check-icon"></i>
                    </label>

                    <input type="radio" class="btn-check" name="status" id="statusTidak" value="TIDAK BERLAKU" autocomplete="off" {{ old('status', $peraturan->status) === 'TIDAK BERLAKU' ? 'checked' : '' }}>
                    <label class="segmented-status-card status-card-tidak" for="statusTidak">
                        <div class="d-flex align-items-center gap-2.5">
                            <span class="status-indicator-dot"></span>
                            <div>
                                <div class="status-title">TIDAK BERLAKU</div>
                                <div class="status-desc">Dicabut / tidak aktif</div>
                            </div>
                        </div>
                        <i class="bi bi-x-circle status-check-icon"></i>
                    </label>
                </div>
            </div>

            <!-- UNGGAH FILE -->
            <div class="admin-card p-4 mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-semibold text-dark mb-0"><i class="bi bi-paperclip text-primary me-1"></i> Berkas Lampiran</h6>
                    <span class="badge bg-light text-muted border" style="font-size: 0.68rem;">PDF &bull; Max 30MB</span>
                </div>

                <!-- FILE UTAMA -->
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-dark">Ganti PDF Utama (Biarkan kosong jika tetap)</label>
                    @if($peraturan->file_dokumen)
                        <div class="p-2 border rounded-2 bg-light mb-2 small d-flex justify-content-between align-items-center">
                            <span class="text-truncate" style="max-width: 180px;"><i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i> {{ basename($peraturan->file_dokumen) }}</span>
                            <a href="{{ $peraturan->file_url }}" target="_blank" class="badge bg-primary text-decoration-none">Lihat</a>
                        </div>
                    @endif
                    <div class="modern-file-uploader @error('file_dokumen') is-invalid @enderror">
                        <input type="file" name="file_dokumen" id="input_file_dokumen" class="uploader-native-input" accept=".pdf" onchange="handleFileSelected(this, 'preview_file_dokumen')">
                        <label for="input_file_dokumen" class="uploader-drop-area">
                            <div class="uploader-icon-squircle">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <div class="uploader-text-wrapper">
                                <span class="uploader-title">{{ $peraturan->file_dokumen ? 'Ganti Naskah PDF Utama' : 'Pilih Berkas PDF Utama' }}</span>
                                <span class="uploader-hint">Format .PDF &bull; Maksimal 30 MB</span>
                            </div>
                            <span class="uploader-browse-btn">Jelajahi</span>
                        </label>
                        <div id="preview_file_dokumen" class="uploader-file-pill d-none">
                            <i class="bi bi-file-earmark-pdf-fill text-danger me-2 fs-6"></i>
                            <span class="uploader-file-name text-truncate"></span>
                            <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                            <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_file_dokumen', 'preview_file_dokumen')" title="Hapus berkas terpilih">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                    @error('file_dokumen') <div class="invalid-feedback d-block mt-1">{{ $message }}</div> @enderror
                </div>

                <hr class="my-3 opacity-25">

                <!-- ENGLISH -->
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">English Version</label>
                    @if($peraturan->english_version)
                        <div class="small text-success mb-1 d-flex align-items-center gap-1">
                            <i class="bi bi-check-circle-fill"></i> <span>Berkas terunggah</span>
                        </div>
                    @endif
                    <div class="modern-file-uploader uploader-compact">
                        <input type="file" name="english_version" id="input_english_version" class="uploader-native-input" accept=".pdf" onchange="handleFileSelected(this, 'preview_english_version')">
                        <label for="input_english_version" class="uploader-drop-area">
                            <div class="uploader-icon-squircle">
                                <i class="bi bi-translate"></i>
                            </div>
                            <div class="uploader-text-wrapper">
                                <span class="uploader-title">PDF Versi Bahasa Inggris</span>
                                <span class="uploader-hint">Ganti atau unggah baru</span>
                            </div>
                            <span class="uploader-browse-btn">Pilih</span>
                        </label>
                        <div id="preview_english_version" class="uploader-file-pill d-none">
                            <i class="bi bi-file-earmark-pdf-fill text-primary me-2"></i>
                            <span class="uploader-file-name text-truncate"></span>
                            <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                            <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_english_version', 'preview_english_version')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- BRAILLE -->
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-muted">Format Braille</label>
                    @if($peraturan->braille)
                        <div class="small text-success mb-1 d-flex align-items-center gap-1">
                            <i class="bi bi-check-circle-fill"></i> <span>Berkas terunggah</span>
                        </div>
                    @endif
                    <div class="modern-file-uploader uploader-compact">
                        <input type="file" name="braille" id="input_braille" class="uploader-native-input" accept=".pdf" onchange="handleFileSelected(this, 'preview_braille')">
                        <label for="input_braille" class="uploader-drop-area">
                            <div class="uploader-icon-squircle">
                                <i class="bi bi-eye-slash"></i>
                            </div>
                            <div class="uploader-text-wrapper">
                                <span class="uploader-title">Naskah Format Braille</span>
                                <span class="uploader-hint">Layanan disabilitas netra</span>
                            </div>
                            <span class="uploader-browse-btn">Pilih</span>
                        </label>
                        <div id="preview_braille" class="uploader-file-pill d-none">
                            <i class="bi bi-file-earmark-pdf-fill text-purple me-2"></i>
                            <span class="uploader-file-name text-truncate"></span>
                            <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                            <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_braille', 'preview_braille')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- AUDIO -->
                <div class="mb-2">
                    <label class="form-label small fw-semibold text-muted">Alih Suara (Audio)</label>
                    @if($peraturan->alih_suara)
                        <div class="small text-success mb-1 d-flex align-items-center gap-1">
                            <i class="bi bi-check-circle-fill"></i> <span>Berkas terunggah</span>
                        </div>
                    @endif
                    <div class="modern-file-uploader uploader-compact">
                        <input type="file" name="alih_suara" id="input_alih_suara" class="uploader-native-input" accept=".mp3,.wav,.m4a,.ogg" onchange="handleFileSelected(this, 'preview_alih_suara')">
                        <label for="input_alih_suara" class="uploader-drop-area">
                            <div class="uploader-icon-squircle">
                                <i class="bi bi-volume-up"></i>
                            </div>
                            <div class="uploader-text-wrapper">
                                <span class="uploader-title">Rekaman Narasi Suara</span>
                                <span class="uploader-hint">MP3, WAV, atau OGG</span>
                            </div>
                            <span class="uploader-browse-btn">Pilih</span>
                        </label>
                        <div id="preview_alih_suara" class="uploader-file-pill d-none">
                            <i class="bi bi-music-note-beamed text-success me-2"></i>
                            <span class="uploader-file-name text-truncate"></span>
                            <span class="uploader-file-size badge bg-white text-muted ms-2 border"></span>
                            <button type="button" class="btn-clear-file ms-auto" onclick="clearSelectedFile('input_alih_suara', 'preview_alih_suara')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SUBMIT -->
            <div class="admin-card p-4">
                <button type="submit" class="btn btn-admin-primary w-100 justify-content-center py-2 mb-2">
                    <i class="bi bi-check-lg me-2"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-light border w-100 py-2">Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection

