<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peraturan Bupati - JDIH Kabupaten Toba</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =====================================================
           GLOBAL
        ===================================================== */
        body {
            background: #f6f8fb;
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */
        .custom-navbar {
            background: rgba(0, 0, 0, .35);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            transition: all .3s ease;
        }

        .custom-navbar.scrolled {
            background: #0d6efd;
        }

        .custom-navbar .nav-link {
            color: rgba(255, 255, 255, .9);
            transition: .2s;
        }

        .custom-navbar .nav-link:hover {
            color: #fff;
        }

        .custom-navbar .nav-link.active {
            color: #fff;
            font-weight: 600;
        }

        .navbar-brand {
            letter-spacing: .5px;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
        }

        .dropdown-item {
            padding: 10px 16px;
        }

        .dropdown-item:hover {
            background: #f1f5f9;
        }

        /* =====================================================
           PAGE HEADER
        ===================================================== */
        .page-header {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            color: white;
            padding: 60px 0 70px;
        }

        .page-header h1 {
            font-weight: 700;
        }

        /* =====================================================
           SEARCH
        ===================================================== */
        .search-box {
            margin-top: -30px;
            position: relative;
            z-index: 2;
        }

        .search-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .08);
        }

        .search-input {
            height: 48px;
            border-radius: 8px 0 0 8px;
        }

        .search-button {
            border-radius: 0 8px 8px 0;
        }


        /* =====================================================
           PERATURAN BUPATI CARD
        ===================================================== */
        .perbup-card {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .06);
            transition: .2s;
            height: 100%;
        }

        .perbup-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .10);
        }

        .perbup-title {
            font-weight: 600;
            color: #1f2937;
            line-height: 1.5;
        }

        .meta {
            color: #6b7280;
            font-size: 13px;
        }

        .badge-perbup {
            background: #e8f1ff;
            color: #0d6efd;
            font-size: 11px;
            padding: 6px 10px;
        }

        .btn-detail {
            border-radius: 7px;
        }

        /* =====================================================
           FOOTER
        ===================================================== */
        footer {
            background: #111827;
            color: #d1d5db;
            margin-top: 60px;
            padding: 50px 0 0;
        }

        footer h5 {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 18px;
        }

        footer p {
            color: #9ca3af;
            line-height: 1.7;
            font-size: 14px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer ul li a {
            color: #9ca3af;
            text-decoration: none;
            transition: .2s;
        }

        footer ul li a:hover {
            color: #ffffff;
            padding-left: 3px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .1);
            margin-top: 35px;
            padding: 20px 0;
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */
        @media (max-width: 991px) {
            .custom-navbar .nav-link {
                padding: 10px 0;
            }

        }


        @media (max-width: 576px) {
            body {
                padding-top: 65px;
            }

            .page-header {
                padding: 45px 0 60px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .search-card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- =====================================================
         NAVBAR
    ===================================================== -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
        <div class="container">
<a class="navbar-brand fw-bold d-flex align-items-center" href="/home">

            <img
                src="{{ asset('logo_jdihn-toba.png') }}"
                alt="Logo JDIH Toba"
                style="height: 45px; width: auto; margin-right: 10px;">

        </a>            <button class="navbar-toggler" data-bs-toggle="collapse"   data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto">
                    <!-- HOME -->
                    <li class="nav-item"><a class="nav-link"href="/home">Home</a>  </li>
                    <!-- PROFIL -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  href="#"  data-bs-toggle="dropdown"> Profil  </a>
                        <ul class="dropdown-menu">
                            <li>  <a class="dropdown-item"  href="/sejarah">  Sejarah  </a> </li>
                            <li> <a  class="dropdown-item"  href="/visi">  Visi Misi </a> </li>
                            <li>  <a class="dropdown-item"   href="/organisasi">  Struktur Organisasi  </a> </li>
                        </ul>
                    </li>

                    <!-- PRODUK HUKUM -->
                    <li class="nav-item dropdown">
                        <a  class="nav-link dropdown-toggle active"   href="#" data-bs-toggle="dropdown"> Produk Hukum  </a>
                        <ul class="dropdown-menu">
                            <li> <a class="dropdown-item"  href="/peraturan-daerah"> Peraturan Daerah   </a> </li>
                            <li>  <a class="dropdown-item"  href="/peraturan-bupati">  Peraturan Bupati </a>  </li>
                            <li>   <a class="dropdown-item"   href="/keputusan-bupati">  Keputusan Bupati </a>  </li>
                        </ul>
                    </li>

                    <!-- INFORMASI -->
                    <li class="nav-item dropdown">
                        <a  class="nav-link dropdown-toggle"  href="#"  data-bs-toggle="dropdown"> Informasi  </a>
                        <ul class="dropdown-menu">
                            <li>  <a  class="dropdown-item"  href="/berita">  Berita  </a>  </li>
                            <li><a class="dropdown-item" href="/pengumuman"> Pengumuman </a> </li>
                        </ul>
                    </li>

                    <!-- KONTAK -->
                    <li class="nav-item">
                        <a  class="nav-link" href="/kontak">  Kontak  </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- =====================================================
         PAGE HEADER
    ===================================================== -->
    <section class="page-header">
        <div class="container">
            <div class="text-center">
                <h1>  Peraturan Bupati </h1>
                <p class="mb-0 opacity-75">
                    Jaringan Dokumentasi dan Informasi Hukum
                    Kabupaten Toba
                </p>
            </div>
        </div>
    </section>

    <!-- =====================================================
         SEARCH
    ===================================================== -->
    <div class="container search-box">
        <div class="search-card">
            <form action="{{ route('user.peraturan-bupati') }}" method="GET">
                <div class="input-group">
                    <input  type="text"  name="search"  class="form-control search-input"  placeholder="Cari nomor, judul, tahun, atau subjek..."  value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary search-button">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- =====================================================
         CONTENT
    ===================================================== -->
    <main class="container py-5">
        <!-- HEADER DATA -->
        <div  class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-1">
                    Daftar Peraturan Bupati
                </h5>

                <div class="text-muted small">
                    @if(request('search'))
                        Hasil pencarian:
                        <strong>  "{{ request('search') }}"  </strong>
                    @else
                        Seluruh Peraturan Bupati
                    @endif
                </div>
            </div>

            <span class="badge bg-secondary">
                {{ $peraturanBupatis->total() }}
                Dokumen
            </span>
        </div>

        <!-- =================================================
             DATA
        ================================================= -->
        @if($peraturanBupatis->count() > 0)
            <div class="row g-4">
                @foreach($peraturanBupatis as $perbup)
                    <div class="col-lg-6">
                        <div class="card perbup-card">
                            <div class="card-body p-4">
                                <!-- BADGE -->
                                <div
                                    class="d-flex justify-content-between mb-3">
                                    <span class="badge badge-perbup">
                                        {{ $perbup->singkatan ?? 'PERBUP' }}
                                    </span>

                                    @if($perbup->status == 'BERLAKU')
                                        <span class="badge bg-success">
                                            BERLAKU
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            TIDAK BERLAKU
                                        </span>
                                    @endif
                                </div>

                                <!-- NOMOR -->
                                <div class="meta mb-2">
                                    Peraturan Bupati Nomor
                                    {{ $perbup->nomor_peraturan ?? '-' }}
                                    Tahun
                                    {{ $perbup->tahun ?? '-' }}
                                </div>

                                <!-- JUDUL -->
                                <h5 class="perbup-title mb-3">
                                    {{ $perbup->judul }}
                                </h5>

                                <!-- TANGGAL -->
                                @if($perbup->tanggal_penetapan)
                                    <div class="meta mb-2">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        Penetapan:
                                        {{ $perbup->tanggal_penetapan->format('d F Y') }}
                                    </div>
                                @endif

                                <!-- SUBJEK -->
                                @if($perbup->subjek)
                                    <div class="meta mb-3">
                                        <i class="bi bi-tag me-1"></i>
                                        {{ $perbup->subjek }}
                                    </div>
                                @endif

                                <!-- BUTTON -->
                                <div
                                    class="d-flex justify-content-between align-items-center mt-4">
                                    <small class="text-muted">
                                        <i class="bi bi-file-earmark-pdf me-1">    </i>
                                        Dokumen PDF
                                    </small>

                                    <a  href="{{ route('user.peraturan-bupati.detail', $perbup->id) }}" class="btn btn-primary btn-sm btn-detail">
                                        Lihat Detail
                                        <i  class="bi bi-arrow-right ms-1">  </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <!-- =================================================
                 DATA KOSONG
            ================================================= -->
            <div class="text-center py-5">
                <i  class="bi bi-file-earmark-x fs-1 text-muted">  </i>
                <h5 class="mt-3">  Data tidak ditemukan </h5>
                <p class="text-muted">  Belum ada Peraturan Bupati yang tersedia. </p>
            </div>
        @endif

        <!-- ================================================
             PAGINATION
        ================================================= -->
        @if($peraturanBupatis->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $peraturanBupatis->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </main>

    <!-- =====================================================
         FOOTER
    ===================================================== -->
    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>JDIH Kabupaten Toba </h5>
                    <p>JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kabupaten Toba merupakan sistem pendokumentasian Produk Hukum yang ada pada lingkungan Pemerintah Kabupaten Toba</p>
                </div>

                <div class="col-md-4">
                    <h5>Menu Cepat </h5>
                    <ul>
                        <li><a href="/home">Home</a></li>
                        <li> <a href="/peraturan-daerah">Peraturan Daerah</a> </li>
                        <li><a href="/peraturan-bupati">Peraturan Bupati</a> </li>
                        <li><a href="/keputusan-bupati">Keputusan Bupati</a> </li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h5>Kontak </h5>
                    <p> 0813-6244-4195</p>
                    <p>hukumtobasamosirkab@gmail.com</p>
                    <p>Jl. Sutomo, Pagar Batu, Balige 22385
                        Kabupaten Toba, Provinsi Sumatera Utara</p>
                </div>
            </div>

            <div class="footer-bottom">
                © 2026 JDIH Kabupaten Toba. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- =====================================================
         BOOTSTRAP JS
    ==================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">   </script>
    <!-- =====================================================
         NAVBAR SCROLL
    ===================================================== -->
    <script>
        window.addEventListener("scroll", function() {
            let nav =
                document.querySelector(".custom-navbar");
            if (window.scrollY > 50) {
                nav.classList.add("scrolled");
            } else {
                nav.classList.remove("scrolled");
            }
        });
    </script>
</body>
</html>