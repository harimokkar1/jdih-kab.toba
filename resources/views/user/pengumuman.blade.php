<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pengumuman - JDIH Kabupaten Toba</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <style>

        /* ========================================
           GLOBAL
        ======================================== */

        body {
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
            background: #f8f9fa;
        }


        /* ========================================
           NAVBAR
        ======================================== */

        .custom-navbar {
            top: 0;
            background: rgba(0, 0, 0, .35);
            backdrop-filter: blur(10px);
            transition: .3s;
            padding: 10px 0;
        }

        .custom-navbar.scrolled {
            background: #0d6efd;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .2);
        }

        .navbar-nav .nav-link {
            color: white !important;
            margin-left: 10px;
            font-weight: 500;
            transition: .2s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }


        /* ========================================
           DROPDOWN
        ======================================== */

        .dropdown-menu {
            border-radius: 10px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }

        .dropdown-item {
            transition: .2s;
        }

        .dropdown-item:hover {
            background: #0d6efd;
            color: white;
        }


        /* ========================================
           PENGUMUMAN SECTION
        ======================================== */

        .pengumuman-section {
            padding: 70px 0;
            min-height: 600px;
        }


        /* ========================================
           SECTION TITLE
        ======================================== */

        .section-title {
            text-align: center;
            margin-bottom: 45px;
        }

        .section-title h2 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #6c757d;
            margin: 0;
        }

        .title-line {
            width: 60px;
            height: 4px;
            background: #0d6efd;
            margin: 15px auto 0;
            border-radius: 10px;
        }


        /* ========================================
           PENGUMUMAN CARD
        ======================================== */

        .pengumuman-card {
            height: 100%;
            background: #fff;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .pengumuman-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }


        /* ========================================
           CARD TOP
        ======================================== */

        .pengumuman-top {
            height: 150px;
            background: linear-gradient(
                135deg,
                #0d6efd,
                #084298
            );

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;
        }

        .pengumuman-top i {
            font-size: 65px;
        }


        /* ========================================
           BODY
        ======================================== */

        .pengumuman-body {
            padding: 22px;
        }


        /* ========================================
           DATE
        ======================================== */

        .pengumuman-date {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .pengumuman-date i {
            color: #0d6efd;
        }


        /* ========================================
           TITLE
        ======================================== */

        .pengumuman-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
            color: #212529;
            margin-bottom: 12px;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }


        /* ========================================
           EXCERPT
        ======================================== */

        .pengumuman-excerpt {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 18px;

            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }


        /* ========================================
           BUTTON
        ======================================== */

        .pengumuman-buttons {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }


        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: #0d6efd;

            text-decoration: none;

            font-size: 14px;
            font-weight: 600;

            transition: .2s;
        }

        .btn-detail:hover {
            color: #084298;
            gap: 10px;
        }


        .btn-pdf {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            background: #dc3545;
            color: white;

            padding: 8px 13px;

            border-radius: 7px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: .2s;
        }

        .btn-pdf:hover {
            background: #bb2d3b;
            color: white;
        }


        /* ========================================
           PAGINATION
        ======================================== */

        .pagination {
            margin-top: 50px;
        }

        .pagination .page-link {
            border: none;
            margin: 0 3px;
            border-radius: 8px;
            color: #0d6efd;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        }

        .pagination .page-item.active .page-link {
            background: #0d6efd;
            color: white;
        }

        .pagination .page-link:hover {
            background: #0d6efd;
            color: white;
        }


        /* ========================================
           EMPTY
        ======================================== */

        .empty-announcement {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-announcement i {
            font-size: 60px;
            color: #adb5bd;
            display: block;
            margin-bottom: 15px;
        }


        /* ========================================
           FOOTER
        ======================================== */

        footer {
            background: #111827;
            color: white;
            padding: 50px 0 20px;
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer a {
            color: #ddd;
            text-decoration: none;
        }

        footer a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .2);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
        }


        /* ========================================
           RESPONSIVE
        ======================================== */

        @media(max-width: 768px) {

            .pengumuman-section {
                padding: 45px 15px;
            }

            .pengumuman-top {
                height: 130px;
            }

            .pengumuman-top i {
                font-size: 55px;
            }

            .navbar-nav {
                background: #0d6efd;
                padding: 10px;
                border-radius: 10px;
            }

        }

    </style>

</head>


<body>


    <!-- ========================================
         NAVBAR
    ======================================== -->

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

        <div class="container">

            <a
                class="navbar-brand fw-bold d-flex align-items-center"
                href="/home">

                <img
                    src="{{ asset('logo_jdihn-toba.png') }}"
                    alt="Logo JDIH Toba"
                    style="height: 45px; width: auto; margin-right: 10px;">

            </a>


            <button
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">

                <span class="navbar-toggler-icon"></span>

            </button>


            <div
                class="collapse navbar-collapse"
                id="navbarMenu">

                <ul class="navbar-nav ms-auto">


                    <!-- HOME -->

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="/home">

                            Home

                        </a>

                    </li>


                    <!-- PROFIL -->

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">

                            Profil

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/sejarah">

                                    Sejarah

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/visi">

                                    Visi Misi

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/organisasi">

                                    Struktur Organisasi

                                </a>
                            </li>

                        </ul>

                    </li>


                    <!-- PRODUK HUKUM -->

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">

                            Produk Hukum

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/peraturan-daerah">

                                    Peraturan Daerah

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/peraturan-bupati">

                                    Peraturan Bupati

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/keputusan-bupati">

                                    Keputusan Bupati

                                </a>
                            </li>

                        </ul>

                    </li>


                    <!-- INFORMASI -->

                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">

                            Informasi

                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="/berita">

                                    Berita

                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item active"
                                    href="/pengumuman">

                                    Pengumuman

                                </a>
                            </li>

                        </ul>

                    </li>


                    <!-- KONTAK -->

                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="/kontak">

                            Kontak

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>


    <!-- ========================================
         PENGUMUMAN
    ======================================== -->

    <main>

        <section class="pengumuman-section">

            <div class="container">


                <!-- TITLE -->

                <div class="section-title">

                    <h2>
                        Pengumuman
                    </h2>

                    <p>
                        Informasi dan pengumuman terbaru
                        JDIH Kabupaten Toba
                    </p>

                    <div class="title-line"></div>

                </div>


                @if($pengumumans->count() > 0)


                    <!-- ========================================
                         GRID PENGUMUMAN
                    ======================================== -->

                    <div class="row g-4">

                        @foreach($pengumumans as $pengumuman)

                            <div class="col-lg-4 col-md-6">


                                <article class="pengumuman-card">


                                    <!-- BODY -->

                                    <div class="pengumuman-body">


                                        <!-- TANGGAL -->

                                        <div class="pengumuman-date">

                                            <i class="bi bi-calendar3 me-1"></i>

                                            {{ $pengumuman->tanggal_upload
                                                ? $pengumuman->tanggal_upload->translatedFormat('d F Y')
                                                : '-' }}

                                        </div>


                                        <!-- JUDUL -->

                                        <h3 class="pengumuman-title">

                                            {{ $pengumuman->judul }}

                                        </h3>


                                        <!-- ISI -->

                                        <div class="pengumuman-excerpt">

                                            {{ \Illuminate\Support\Str::limit(
                                                strip_tags($pengumuman->isi),
                                                150
                                            ) }}

                                        </div>


                                        <!-- BUTTON -->

                                        <div class="pengumuman-buttons">


                                            <!-- DETAIL -->

                                            <a
                                                href="{{ route(
                                                    'pengumuman.show',
                                                    $pengumuman->id
                                                ) }}"
                                                class="btn-detail">

                                                Lihat Detail

                                                <i class="bi bi-arrow-right"></i>

                                            </a>


                                            <!-- PDF -->

                                            @if($pengumuman->file_pdf)

                                                <a
                                                    href="{{ asset(
                                                        'uploads/pengumuman/' .
                                                        $pengumuman->file_pdf
                                                    ) }}"
                                                    target="_blank"
                                                    class="btn-pdf">

                                                    <i class="bi bi-file-earmark-pdf-fill"></i>

                                                    PDF

                                                </a>

                                            @endif


                                        </div>

                                    </div>

                                </article>

                            </div>

                        @endforeach

                    </div>


                    <!-- ========================================
                         PAGINATION
                    ======================================== -->

                    <div class="d-flex justify-content-center">

                        {{ $pengumumans->links('pagination::bootstrap-5') }}

                    </div>


                @else


                    <!-- ========================================
                         BELUM ADA PENGUMUMAN
                    ======================================== -->

                    <div class="empty-announcement">

                        <i class="bi bi-megaphone"></i>

                        <h4>
                            Belum Ada Pengumuman
                        </h4>

                        <p>
                            Belum ada pengumuman yang dipublikasikan.
                        </p>

                    </div>


                @endif

            </div>

        </section>

    </main>


    <!-- ========================================
         FOOTER
    ======================================== -->

    <footer>

        <div class="container">

            <div class="row">


                <!-- ABOUT -->

                <div class="col-md-4">

                    <h5>
                        JDIH Kabupaten Toba
                    </h5>

                    <p>

                        JDIH (Jaringan Dokumentasi dan Informasi Hukum)
                        Kabupaten Toba merupakan sistem pendokumentasian
                        Produk Hukum yang ada pada lingkungan Pemerintah
                        Kabupaten Toba

                    </p>

                </div>


                <!-- MENU -->

                <div class="col-md-4">

                    <h5>
                        Menu Cepat
                    </h5>

                    <ul>

                        <li>
                            <a href="/home">
                                Home
                            </a>
                        </li>

                        <li>
                            <a href="/peraturan-daerah">
                                Peraturan Daerah
                            </a>
                        </li>

                        <li>
                            <a href="/peraturan-bupati">
                                Peraturan Bupati
                            </a>
                        </li>

                        <li>
                            <a href="/keputusan-bupati">
                                Keputusan Bupati
                            </a>
                        </li>

                        <li>
                            <a href="/pengumuman">
                                Pengumuman
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- KONTAK -->

                <div class="col-md-4">

                    <h5>
                        Kontak
                    </h5>

                    <p>
                        0813-6244-4195
                    </p>

                    <p>
                        hukumtobasamosirkab@gmail.com
                    </p>

                    <p>
                        Jl. Sutomo, Pagar Batu, Balige 22385
                        Kabupaten Toba, Provinsi Sumatera Utara
                    </p>

                </div>

            </div>


            <div class="footer-bottom">

                © 2026 JDIH Kabupaten Toba.
                All Rights Reserved.

            </div>

        </div>

    </footer>


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- NAVBAR SCROLL -->

    <script>

        window.addEventListener("scroll", function() {

            let nav = document.querySelector(".custom-navbar");

            if (window.scrollY > 50) {

                nav.classList.add("scrolled");

            } else {

                nav.classList.remove("scrolled");

            }

        });

    </script>


</body>

</html>