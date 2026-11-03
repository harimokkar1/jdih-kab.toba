@extends('layouts.app')

@section('title', 'Sejarah JDIH - Pemerintah Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Sejarah JDIH</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-clock-history text-primary me-2"></i> Sejarah JDIH Kabupaten Toba</h2>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('logo.png') }}" alt="Logo Toba" height="80" class="mb-3">
                    <h4 class="fw-bold text-primary">Jaringan Dokumentasi dan Informasi Hukum</h4>
                    <h5 class="fw-normal text-muted">Kabupaten Toba, Provinsi Sumatera Utara</h5>
                    <hr class="my-4 mx-auto" style="width: 100px; height: 3px; background-color: var(--jdih-accent);">
                </div>

                <div class="content-text" style="line-height: 2; font-size: 1.05rem; color: #334155;">
                    <p>
                        Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kabupaten Toba dibentuk berdasarkan amanat Peraturan Presiden Nomor 33 Tahun 2012 tentang Jaringan Dokumentasi dan Informasi Hukum Nasional. Wadah ini dibangun sebagai pusat layanan penyebarluasan informasi hukum daerah yang tertib, terpadu, dan berkesinambungan.
                    </p>
                    <p>
                        Pemerintah Kabupaten Toba melalui Bagian Hukum Sekretariat Daerah terus berkomitmen meningkatkan tata kelola dokumentasi peraturan perundang-undangan, mulai dari Peraturan Daerah, Peraturan Bupati, hingga Keputusan Bupati agar mudah diakses oleh seluruh elemen masyarakat secara transparan, akuntabel, dan digital.
                    </p>
                    <p>
                        Seiring perkembangan teknologi informasi, portal JDIH Kabupaten Toba telah terintegrasi dengan portal JDIHN (Pusat JDIH Nasional) yang dikelola oleh Badan Pembinaan Hukum Nasional (BPHN) Kementerian Hukum dan HAM Republik Indonesia, memastikan standarisasi metadata hukum nasional terpenuhi dengan baik.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
