@extends('layouts.app')

@section('title', $peraturan->judul . ' - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.produk-hukum.global') }}">Produk Hukum</a></li>
                @if($peraturan->jenisPeraturan)
                    <li class="breadcrumb-item"><a href="{{ route('user.produk-hukum.jenis', $peraturan->jenisPeraturan->slug) }}">{{ $peraturan->jenisPeraturan->nama }}</a></li>
                @endif
                <li class="breadcrumb-item active text-truncate" style="max-width: 300px;">{{ $peraturan->judul }}</li>
            </ol>
        </nav>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-2">
            <div>
                <span class="badge-jenis me-2">{{ $peraturan->jenisPeraturan->nama ?? 'Peraturan' }}</span>
                <span class="{{ $peraturan->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                    {{ $peraturan->status }}
                </span>
                <h3 class="fw-bold mt-2 mb-1">{{ $peraturan->judul }}</h3>
                <div class="small text-muted d-flex flex-wrap gap-3">
                    <span><i class="bi bi-hash"></i> No: {{ $peraturan->nomor_peraturan ?? '-' }}</span>
                    <span><i class="bi bi-calendar-event"></i> Tahun: {{ $peraturan->tahun ?? '-' }}</span>
                    <span><i class="bi bi-eye"></i> Dilihat: {{ $peraturan->view_count }} kali</span>
                    <span><i class="bi bi-download"></i> Diunduh: {{ $peraturan->download_count }} kali</span>
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <a href="{{ route('user.produk-hukum.download', $peraturan->id) }}" class="btn btn-success rounded-pill px-4 shadow-sm">
                    <i class="bi bi-download me-1"></i> Unduh PDF
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">
        <!-- DETAIL METADATA -->
        <div class="col-lg-7">
            <!-- TABEL METADATA -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white py-3 px-4 border-bottom">
                    <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-info-circle me-2"></i> Metadata Peraturan</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0 small">
                        <tbody>
                            <tr>
                                <th class="ps-4" style="width: 220px;">Tipe Dokumen</th>
                                <td>{{ $peraturan->tipe_dokumen ?? 'Peraturan Perundang-undangan' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Jenis Peraturan</th>
                                <td>{{ $peraturan->jenisPeraturan->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Nomor Peraturan</th>
                                <td>{{ $peraturan->nomor_peraturan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Tahun</th>
                                <td>{{ $peraturan->tahun ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">T.E.U. Badan</th>
                                <td>{{ $peraturan->teu_badan ?? 'Pemerintah Kabupaten Toba' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Tempat Penetapan</th>
                                <td>{{ $peraturan->tempat_penetapan ?? 'Balige' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Tanggal Penetapan</th>
                                <td>{{ $peraturan->tanggal_penetapan ? $peraturan->tanggal_penetapan->translatedFormat('d F Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Tanggal Pengundangan</th>
                                <td>{{ $peraturan->tanggal_pengundangan ? $peraturan->tanggal_pengundangan->translatedFormat('d F Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Sumber</th>
                                <td>{{ $peraturan->sumber ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Subjek</th>
                                <td>{{ $peraturan->subjek ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Status Hukum</th>
                                <td>
                                    <span class="{{ $peraturan->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                        {{ $peraturan->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="ps-4">Bahasa</th>
                                <td>{{ $peraturan->bahasa ?? 'Bahasa Indonesia' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Lokasi Fisik</th>
                                <td>{{ $peraturan->lokasi ?? 'Bagian Hukum Setdakab Toba' }}</td>
                            </tr>
                            <tr>
                                <th class="ps-4">Bidang Hukum</th>
                                <td>{{ $peraturan->bidang_hukum ?? 'Hukum Umum' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ABSTRAK -->
            @if($peraturan->abstrak)
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-text me-2"></i> Abstrak</h5>
                    <div class="text-muted small" style="line-height: 1.8;">
                        {!! nl2br(e($peraturan->abstrak)) !!}
                    </div>
                </div>
            @endif

            <!-- LAMPIRAN KHUSUS / AKSESIBILITAS -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold text-primary mb-3"><i class="bi bi-paperclip me-2"></i> Aksesibilitas & Versi Dokumen Lainnya</h5>
                <div class="row g-2">
                    <!-- ENGLISH -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <i class="bi bi-translate text-primary fs-3 d-block mb-1"></i>
                                <span class="small fw-bold d-block">English Version</span>
                            </div>
                            <div class="mt-2">
                                @if($peraturan->english_version)
                                    <a href="{{ route('user.produk-hukum.download', ['id' => $peraturan->id, 'type' => 'english']) }}" class="btn btn-sm btn-outline-primary rounded-pill w-100">
                                        Unduh
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- BRAILLE -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <i class="bi bi-eye-slash text-warning fs-3 d-block mb-1"></i>
                                <span class="small fw-bold d-block">Format Braille</span>
                            </div>
                            <div class="mt-2">
                                @if($peraturan->braille)
                                    <a href="{{ route('user.produk-hukum.download', ['id' => $peraturan->id, 'type' => 'braille']) }}" class="btn btn-sm btn-outline-primary rounded-pill w-100">
                                        Unduh
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- ALIH SUARA -->
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <i class="bi bi-volume-up text-success fs-3 d-block mb-1"></i>
                                <span class="small fw-bold d-block">Alih Suara (Audio)</span>
                            </div>
                            <div class="mt-2">
                                @if($peraturan->alih_suara)
                                    <a href="{{ route('user.produk-hukum.download', ['id' => $peraturan->id, 'type' => 'audio']) }}" class="btn btn-sm btn-outline-success rounded-pill w-100">
                                        Dengar / Unduh
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border">Tidak Tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- VIEWER PDF & TERKAIT -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 sticky-top" style="top: 90px;">
                <div class="card-header bg-primary text-white py-3 px-4 d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><i class="bi bi-file-earmark-pdf me-2"></i> Pratinjau Dokumen</span>
                    <a href="{{ $peraturan->file_url }}" target="_blank" class="btn btn-sm btn-light rounded-pill px-3 py-1 text-primary fw-semibold" title="Buka di Tab Baru">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Penuh
                    </a>
                </div>
                <div class="card-body p-0">
                    <iframe src="{{ $peraturan->file_url }}" width="100%" height="560px" style="border: none;">
                        <p>Browser Anda tidak mendukung iframe PDF. Silakan <a href="{{ route('user.produk-hukum.download', $peraturan->id) }}">unduh dokumen di sini</a>.</p>
                    </iframe>
                </div>
            </div>

            <!-- PERATURAN TERKAIT -->
            @if(isset($terkait) && $terkait->count() > 0)
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h6 class="fw-bold text-primary mb-3"><i class="bi bi-collection me-2"></i> Peraturan Terkait Lainnya</h6>
                    <div class="d-flex flex-column gap-3">
                        @foreach($terkait as $t)
                            <div class="pb-2 border-bottom last-border-0">
                                <small class="text-muted"><i class="bi bi-calendar me-1"></i> Tahun {{ $t->tahun }}</small>
                                <h6 class="small fw-bold mt-1 mb-1">
                                    <a href="{{ route('user.produk-hukum.detail', $t->id) }}" class="text-decoration-none text-dark hover-primary">
                                        {{ Str::limit($t->judul, 70) }}
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
