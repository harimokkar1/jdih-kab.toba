@extends('layouts.app')

@section('title', $peraturan->judul . ' - JDIH Kabupaten Toba')

@section('content')

<!-- ============================================================
     CURVED DARK NAVY BANNER
     ============================================================ -->
<div class="inner-header-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.produk-hukum.global') }}">Produk Hukum</a></li>
                @if($peraturan->jenisPeraturan)
                    <li class="breadcrumb-item"><a href="{{ route('user.produk-hukum.jenis', $peraturan->jenisPeraturan->slug) }}">{{ $peraturan->jenisPeraturan->nama }}</a></li>
                @endif
                <li class="breadcrumb-item active text-truncate" style="max-width: 320px;">{{ $peraturan->judul }}</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <span class="badge bg-light text-dark fw-bold px-3 py-1.5 rounded-pill border">
                        {{ $peraturan->jenisPeraturan->nama ?? 'Peraturan' }}
                    </span>
                    <span class="{{ $peraturan->status === 'BERLAKU' ? 'badge-status-active' : 'badge-status-inactive' }}">
                        {{ $peraturan->status }}
                    </span>
                </div>
                <h1 class="h4 fw-bold text-white mb-2" style="line-height: 1.45;">
                    {{ $peraturan->judul }}
                </h1>
                <div class="small text-white-50 d-flex flex-wrap gap-3">
                    <span><i class="bi bi-hash text-warning"></i> Nomor: <strong>{{ $peraturan->nomor_peraturan ?? '-' }}</strong></span>
                    <span><i class="bi bi-calendar-event text-warning"></i> Tahun: <strong>{{ $peraturan->tahun ?? '-' }}</strong></span>
                    <span><i class="bi bi-eye text-warning"></i> Dilihat: <strong>{{ number_format($peraturan->view_count, 0, ',', '.') }}x</strong></span>
                    <span><i class="bi bi-download text-warning"></i> Diunduh: <strong>{{ number_format($peraturan->download_count, 0, ',', '.') }}x</strong></span>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0 align-self-start">
                <a href="{{ route('user.produk-hukum.download', $peraturan->id) }}" class="btn btn-warning text-dark rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-download"></i> Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">
        <!-- METADATA & ABSTRAK -->
        <div class="col-lg-7">
            <!-- TABEL METADATA RESMI -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-info-circle-fill text-primary me-2"></i> Metadata Dokumen</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="copyCurrentUrl()" title="Salin Tautan">
                        <i class="bi bi-share me-1"></i> Bagikan
                    </button>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-metadata mb-0">
                        <tbody>
                            <tr><th class="ps-4" style="width: 220px;">Tipe Dokumen</th><td>{{ $peraturan->tipe_dokumen ?? 'Peraturan Perundang-undangan' }}</td></tr>
                            <tr><th class="ps-4">Jenis Peraturan</th><td class="fw-bold text-primary">{{ $peraturan->jenisPeraturan->nama ?? '-' }}</td></tr>
                            <tr><th class="ps-4">Nomor Peraturan</th><td class="font-monospace fw-bold">{{ $peraturan->nomor_peraturan ?? '-' }}</td></tr>
                            <tr><th class="ps-4">Tahun Penerbitan</th><td>{{ $peraturan->tahun ?? '-' }}</td></tr>
                            <tr><th class="ps-4">T.E.U. Badan / Pemrakarsa</th><td>{{ $peraturan->teu_badan ?? 'Pemerintah Kabupaten Toba' }}</td></tr>
                            <tr><th class="ps-4">Tempat Penetapan</th><td>{{ $peraturan->tempat_penetapan ?? 'Balige' }}</td></tr>
                            <tr><th class="ps-4">Tanggal Penetapan</th><td>{{ $peraturan->tanggal_penetapan ? $peraturan->tanggal_penetapan->translatedFormat('d F Y') : '-' }}</td></tr>
                            <tr><th class="ps-4">Tanggal Pengundangan</th><td>{{ $peraturan->tanggal_pengundangan ? $peraturan->tanggal_pengundangan->translatedFormat('d F Y') : '-' }}</td></tr>
                            <tr><th class="ps-4">Sumber Regulasi</th><td>{{ $peraturan->sumber ?? '-' }}</td></tr>
                            <tr><th class="ps-4">Subjek / Klasifikasi</th><td>{{ $peraturan->subjek ?? '-' }}</td></tr>
                            <tr><th class="ps-4">Status Keberlakuan</th><td><span class="{{ $peraturan->status === 'BERLAKU' ? 'badge-status-active' : 'badge-status-inactive' }}">{{ $peraturan->status }}</span></td></tr>
                            <tr><th class="ps-4">Bahasa Naskah</th><td>{{ $peraturan->bahasa ?? 'Indonesia' }}</td></tr>
                            <tr><th class="ps-4">Lokasi Fisik Arsip</th><td>{{ $peraturan->lokasi ?? 'Bagian Hukum Setdakab Toba, Balige' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ABSTRAK -->
            @if($peraturan->abstrak)
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-file-text-fill text-primary me-2"></i> Abstrak Peraturan</h5>
                    <div class="text-secondary" style="line-height: 1.85; font-size: 0.94rem;">
                        {!! nl2br(e($peraturan->abstrak)) !!}
                    </div>
                </div>
            @endif

            <!-- AKSESIBILITAS -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="bi bi-universal-access-circle text-primary me-2"></i> Aksesibilitas Format Lainnya</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 text-center h-100 bg-light d-flex flex-column justify-content-between">
                            <div>
                                <i class="bi bi-translate text-primary fs-3 d-block mb-1"></i>
                                <span class="small fw-bold d-block text-dark">English Version</span>
                            </div>
                            <div class="mt-2">
                                @if($peraturan->english_version)
                                    <a href="{{ route('user.produk-hukum.download', ['id' => $peraturan->id, 'type' => 'english']) }}" class="btn btn-sm btn-outline-primary rounded-pill w-100 fw-bold">Unduh</a>
                                @else
                                    <span class="badge bg-white text-muted border">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 text-center h-100 bg-light d-flex flex-column justify-content-between">
                            <div>
                                <i class="bi bi-eye-slash text-warning fs-3 d-block mb-1"></i>
                                <span class="small fw-bold d-block text-dark">Format Braille</span>
                            </div>
                            <div class="mt-2">
                                @if($peraturan->braille)
                                    <a href="{{ route('user.produk-hukum.download', ['id' => $peraturan->id, 'type' => 'braille']) }}" class="btn btn-sm btn-outline-warning rounded-pill w-100 fw-bold">Unduh</a>
                                @else
                                    <span class="badge bg-white text-muted border">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 text-center h-100 bg-light d-flex flex-column justify-content-between">
                            <div>
                                <i class="bi bi-volume-up text-success fs-3 d-block mb-1"></i>
                                <span class="small fw-bold d-block text-dark">Audio / Alih Suara</span>
                            </div>
                            <div class="mt-2">
                                @if($peraturan->alih_suara)
                                    <a href="{{ route('user.produk-hukum.download', ['id' => $peraturan->id, 'type' => 'audio']) }}" class="btn btn-sm btn-outline-success rounded-pill w-100 fw-bold">Dengar</a>
                                @else
                                    <span class="badge bg-white text-muted border">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PRATINJAU PDF & DOKUMEN TERKAIT -->
        <div class="col-lg-5">
            <div class="pdf-viewer-card mb-4 sticky-top" style="top: 85px;">
                <div class="pdf-viewer-header">
                    <span class="fw-bold small"><i class="bi bi-file-earmark-pdf me-1 text-danger"></i> Pratinjau Naskah Digital</span>
                    <a href="{{ $peraturan->file_url }}" target="_blank" class="btn btn-sm btn-light rounded-pill px-3 py-1 text-dark fw-bold" style="font-size: 0.78rem;">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Layar Penuh
                    </a>
                </div>
                <div class="p-0">
                    <iframe src="{{ $peraturan->file_url }}" class="pdf-viewer-frame">
                        <div class="p-4 text-center">
                            <p class="text-muted">Peramban Anda tidak mendukung pratinjau PDF langsung.</p>
                            <a href="{{ route('user.produk-hukum.download', $peraturan->id) }}" class="btn btn-primary rounded-pill px-4">
                                Unduh Naskah Dokumen
                            </a>
                        </div>
                    </iframe>
                </div>
            </div>

            <!-- REGULASI TERKAIT -->
            @if(isset($terkait) && $terkait->count() > 0)
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-bold text-dark mb-3"><i class="bi bi-collection-fill text-primary me-2"></i> Dokumen Terkait</h6>
                    <div class="d-flex flex-column gap-3">
                        @foreach($terkait as $t)
                            <div class="pb-2 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> Tahun {{ $t->tahun ?? '-' }}</small>
                                    <span class="badge bg-light text-dark border" style="font-size: 10px;">{{ $t->nomor_peraturan ? 'No. ' . $t->nomor_peraturan : '-' }}</span>
                                </div>
                                <h6 class="small fw-bold mb-0">
                                    <a href="{{ route('user.produk-hukum.detail', $t->id) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ Str::limit($t->judul, 75) }}
                                    </a>
                                </h6>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyCurrentUrl() {
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Tautan dokumen berhasil disalin ke papan klip!');
        });
    }
</script>
@endpush
