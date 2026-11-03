@extends('layouts.app')

@section('title', 'Kontak Kami - JDIH Kabupaten Toba')

@section('content')
<div class="py-4 bg-light border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Kontak Kami</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0"><i class="bi bi-telephone text-primary me-2"></i> Kontak & Informasi Pelayanan</h2>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <!-- KARTU KONTAK -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white h-100">
                <h4 class="fw-bold text-primary mb-4">Sekretariat JDIH Toba</h4>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 text-primary fs-4 flex-shrink-0">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Kantor</h6>
                        <p class="text-muted small mb-0">
                            Bagian Hukum Sekretariat Daerah Kabupaten Toba<br>
                            Jl. Sutomo, Pagar Batu, Balige 22385<br>
                            Kabupaten Toba, Provinsi Sumatera Utara
                        </p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 text-success fs-4 flex-shrink-0">
                        <i class="bi bi-telephone-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon / WhatsApp</h6>
                        <p class="text-muted small mb-0">0813-6244-4195</p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 text-warning fs-4 flex-shrink-0">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Email Resmi</h6>
                        <p class="text-muted small mb-0">hukumtobasamosirkab@gmail.com</p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 text-info fs-4 flex-shrink-0">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Jam Pelayanan</h6>
                        <p class="text-muted small mb-0">
                            Senin - Kamis: 08.00 - 16.30 WIB<br>
                            Jumat: 08.00 - 16.00 WIB
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- PETA / INFO TAMBAHAN -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                <div class="card-header bg-white p-4 border-bottom">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-map me-2 text-primary"></i> Lokasi Kantor Pemkab Toba</h5>
                </div>
                <div class="card-body p-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15944.38531776953!2d99.0558145!3d2.3364448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e043f2115682d%3A0xe6bf448cf822e11a!2sKantor%20Bupati%20Toba!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%"
                        height="420"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
