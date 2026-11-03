@extends('layouts.app')

@section('title', 'JDIH Kabupaten Toba - Jaringan Dokumentasi dan Informasi Hukum')

@section('content')

<!-- ============================================================
     CAROUSEL SLIDER BANNER
     ============================================================ -->
@if(isset($carousels) && $carousels->count() > 0)
<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($carousels as $index => $c)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($carousels as $index => $c)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="max-height: 480px; background: #000;">
                <img src="{{ asset('carousel/' . $c->image) }}" class="d-block w-100" style="object-fit: cover; max-height: 480px; opacity: 0.85;" alt="{{ $c->title }}">
                <div class="carousel-caption d-none d-md-block text-start pb-5">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">JDIH KABUPATEN TOBA</span>
                    <h2 class="display-6 fw-bold text-white shadow-sm">{{ $c->title }}</h2>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif

<!-- ============================================================
     HERO MULTI-PARAMETER SEARCH BAR (Requirement #1)
     Ref: jdih.sumutprov.go.id
     ============================================================ -->
<section class="hero-search-wrapper">
    <div class="container">
        <div class="text-center mb-4">
            <span class="badge bg-light text-primary px-3 py-1 rounded-pill fw-bold mb-2 text-uppercase" style="letter-spacing: 1px;">Portal Dokumentasi Hukum</span>
            <h1 class="fw-bold mb-2">Temukan Informasi Produk Hukum Kabupaten Toba</h1>
            <p class="text-light opacity-75 mb-0">Cari Peraturan Daerah, Peraturan Bupati, Keputusan Bupati, dan produk hukum lainnya</p>
        </div>

        <div class="hero-search-card">
            <form action="{{ route('user.cari') }}" method="GET">
                <div class="row g-3">
                    <!-- 1. Judul Peraturan -->
                    <div class="col-lg-6 col-md-12">
                        <label class="form-label"><i class="bi bi-file-earmark-font me-1"></i> Judul Peraturan</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan kata kunci judul peraturan..." value="{{ request('judul') }}">
                    </div>

                    <!-- 2. Jenis Dokumen (Dropdown) -->
                    <div class="col-lg-6 col-md-12">
                        <label class="form-label"><i class="bi bi-tags me-1"></i> Jenis Dokumen</label>
                        <select name="jenis_peraturan_id" class="form-select">
                            <option value="">-- Semua Jenis Dokumen --</option>
                            @foreach($jenisPeraturans as $jp)
                                <option value="{{ $jp->id }}" {{ request('jenis_peraturan_id') == $jp->id ? 'selected' : '' }}>
                                    {{ $jp->nama }} ({{ $jp->singkatan }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 3. Nomor Peraturan -->
                    <div class="col-lg-4 col-md-4">
                        <label class="form-label"><i class="bi bi-hash me-1"></i> Nomor Peraturan</label>
                        <input type="text" name="nomor_peraturan" class="form-control" placeholder="Contoh: 12" value="{{ request('nomor_peraturan') }}">
                    </div>

                    <!-- 4. Tahun Penetapan -->
                    <div class="col-lg-4 col-md-4">
                        <label class="form-label"><i class="bi bi-calendar3 me-1"></i> Tahun</label>
                        <select name="tahun" class="form-select">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($tahunList as $th)
                                <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 5. Status Peraturan -->
                    <div class="col-lg-4 col-md-4">
                        <label class="form-label"><i class="bi bi-check-circle me-1"></i> Status</label>
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="BERLAKU" {{ request('status') == 'BERLAKU' ? 'selected' : '' }}>Berlaku</option>
                            <option value="TIDAK BERLAKU" {{ request('status') == 'TIDAK BERLAKU' ? 'selected' : '' }}>Tidak Berlaku</option>
                        </select>
                    </div>

                    <!-- Tombol Cari -->
                    <div class="col-12 text-center pt-2">
                        <button type="submit" class="btn btn-search-jdih btn-lg px-5 shadow-sm">
                            <i class="bi bi-search me-2"></i> Cari Produk Hukum
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- ============================================================
     STATISTIK PRODUK HUKUM DINAMIS (Requirement #4)
     Setiap jenis produk hukum yang ditambahkan admin otomatis tampil di sini
     ============================================================ -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill fw-bold text-uppercase">Koleksi Peraturan</span>
            <h2 class="fw-bold mt-2">Dokumentasi Produk Hukum Daerah</h2>
            <p class="text-muted">Akses cepat ke seluruh jenis produk hukum Pemerintah Kabupaten Toba</p>
        </div>

        <div class="row g-4 justify-content-center">
            @forelse($jenisPeraturans as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-legal">
                        <div>
                            <div class="stat-icon">
                                <i class="bi bi-journal-bookmark-fill"></i>
                            </div>
                            <div class="stat-count">{{ number_format($item->peraturans_count, 0, ',', '.') }}</div>
                            <div class="stat-title">{{ $item->nama }}</div>
                            <p class="small text-muted mt-2 mb-0" style="line-height: 1.5;">
                                {{ Str::limit($item->deskripsi, 90, '...') ?: 'Koleksi resmi ' . $item->nama . ' Kabupaten Toba.' }}
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top">
                            <a href="{{ route('user.produk-hukum.jenis', $item->slug) }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 fw-semibold">
                                Lihat {{ $item->singkatan ?: $item->nama }} <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Belum ada kategori jenis produk hukum yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ============================================================
     PRODUK HUKUM TERBARU
     ============================================================ -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <div>
                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill fw-bold text-uppercase">Terbaru</span>
                <h3 class="fw-bold mt-2 mb-0">Produk Hukum Terbaru</h3>
            </div>
            <a href="{{ route('user.produk-hukum.global') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                Lihat Semua Dokumen ({{ $totalDokumen }}) <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($produkHukumTerbaru as $ph)
                <div class="col-lg-6">
                    <div class="doc-card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2 gap-2">
                                <span class="badge-jenis">{{ $ph->jenisPeraturan->nama ?? 'Peraturan' }}</span>
                                <span class="{{ $ph->status === 'BERLAKU' ? 'badge-status-berlaku' : 'badge-status-tidak' }}">
                                    {{ $ph->status }}
                                </span>
                            </div>
                            <h5 class="fw-bold mb-2">
                                <a href="{{ route('user.produk-hukum.detail', $ph->id) }}" class="text-decoration-none text-dark hover-primary">
                                    {{ $ph->judul }}
                                </a>
                            </h5>
                            <div class="small text-muted mb-3 d-flex flex-wrap gap-3">
                                <span><i class="bi bi-hash text-primary"></i> No. {{ $ph->nomor_peraturan ?? '-' }}</span>
                                <span><i class="bi bi-calendar-event text-primary"></i> Tahun {{ $ph->tahun ?? '-' }}</span>
                                <span><i class="bi bi-building text-primary"></i> {{ $ph->tempat_penetapan ?? 'Balige' }}</span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-2">
                            <span class="small text-muted"><i class="bi bi-eye me-1"></i> {{ $ph->view_count }} kali dilihat</span>
                            <div class="d-flex gap-2">
                                <a href="{{ route('user.produk-hukum.detail', $ph->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                                <a href="{{ route('user.produk-hukum.download', $ph->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3" title="Unduh PDF">
                                    <i class="bi bi-download"></i> Unduh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    Belum ada produk hukum yang diunggah.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ============================================================
     BERITA & PENGUMUMAN
     ============================================================ -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-5">
            <!-- BERITA -->
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0"><i class="bi bi-newspaper text-primary me-2"></i> Berita Hukum</h4>
                    <a href="{{ route('berita') }}" class="small text-primary text-decoration-none fw-semibold">Semua Berita <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($beritas as $b)
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden p-3 hover-shadow transition">
                            <div class="row g-3 align-items-center">
                                @if($b->gambar)
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/berita/' . $b->gambar) }}" class="img-fluid rounded-2 w-100" style="height: 120px; object-fit: cover;" alt="{{ $b->judul }}">
                                    </div>
                                @endif
                                <div class="{{ $b->gambar ? 'col-sm-8' : 'col-12' }}">
                                    <small class="text-muted"><i class="bi bi-calendar3 me-1"></i> {{ $b->created_at ? $b->created_at->translatedFormat('d F Y') : '-' }}</small>
                                    <h6 class="fw-bold mt-1 mb-2">
                                        <a href="{{ route('berita.detail', $b->id) }}" class="text-decoration-none text-dark">
                                            {{ Str::limit($b->judul, 70) }}
                                        </a>
                                    </h6>
                                    <p class="small text-muted mb-0">{{ Str::limit(strip_tags($b->isi), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">Belum ada berita yang diterbitkan.</p>
                    @endforelse
                </div>
            </div>

            <!-- PENGUMUMAN -->
            <div class="col-lg-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0"><i class="bi bi-megaphone-fill text-danger me-2"></i> Pengumuman</h4>
                    <a href="{{ route('pengumuman.index') }}" class="small text-primary text-decoration-none fw-semibold">Semua Pengumuman <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($pengumumans as $p)
                        <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                            <small class="text-muted"><i class="bi bi-calendar me-1"></i> {{ $p->tanggal_upload ? $p->tanggal_upload->translatedFormat('d F Y') : '-' }}</small>
                            <h6 class="fw-bold mt-1 mb-1">
                                <a href="{{ route('pengumuman.show', $p->id) }}" class="text-decoration-none text-dark">
                                    {{ $p->judul }}
                                </a>
                            </h6>
                            <a href="{{ route('pengumuman.show', $p->id) }}" class="small text-primary text-decoration-none">Lihat Pengumuman <i class="bi bi-chevron-right"></i></a>
                        </div>
                    @empty
                        <p class="text-muted small">Belum ada pengumuman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     BANNER TENTANG JDIH
     ============================================================ -->
<section class="py-5 bg-light border-top">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <img src="{{ asset('logo.png') }}" alt="Logo Toba" height="70" class="mb-3">
                <h3 class="fw-bold">Pemerintah Kabupaten Toba</h3>
                <p class="text-muted leading-relaxed">
                    Bagian Hukum Sekretariat Daerah Kabupaten Toba berkomitmen menyediakan kemudahan akses terhadap seluruh peraturan perundang-undangan dan produk hukum daerah bagi seluruh masyarakat dan instansi.
                </p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('visi') }}" class="btn btn-outline-primary rounded-pill px-4">Visi & Misi</a>
                    <a href="{{ route('struktur') }}" class="btn btn-outline-primary rounded-pill px-4">Struktur Organisasi</a>
                    <a href="{{ route('kontak') }}" class="btn btn-primary rounded-pill px-4">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
