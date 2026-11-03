<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        {{ $pengumuman->judul }}
        - JDIH Kabupaten Toba
    </title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        * {
            box-sizing: border-box;
        }


        /* =====================================================
           GLOBAL
        ===================================================== */

        body {

            margin: 0;

            background: #f5f6f8;

            font-family: 'Segoe UI', Arial, sans-serif;

            color: #17365d;

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

            box-shadow:
                0 5px 15px rgba(0, 0, 0, .15);

        }


        .custom-navbar .nav-link {

            color: rgba(255, 255, 255, .9);

            transition: .2s;

            margin-left: 10px;

            font-weight: 500;

        }


        .custom-navbar .nav-link:hover {

            color: #ffc107;

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

            border-radius: 10px;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, .12);

        }


        .dropdown-item {

            padding: 10px 16px;

        }


        .dropdown-item:hover {

            background: #0d6efd;

            color: white;

        }


        /* =====================================================
           PAGE
        ===================================================== */

        .page-wrapper {

            width: 100%;

            padding: 35px 20px 50px;

        }


        /* =====================================================
           BACK BUTTON
        ===================================================== */

        .back-button {

            margin-bottom: 20px;

        }


        .back-link {

            text-decoration: none;

            font-size: 13px;

        }


        /* =====================================================
           MAIN CARD
        ===================================================== */

        .announcement-detail-card {

            background: #ffffff;

            border-radius: 12px;

            border: 1px solid #eeeeee;

            box-shadow:
                0 5px 25px rgba(0, 0, 0, .06);

            overflow: hidden;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .announcement-header {

            padding: 35px 40px 30px;

            border-bottom: 1px solid #eeeeee;

        }


        .announcement-icon {

            width: 58px;

            height: 58px;

            border-radius: 12px;

            background: #eaf2ff;

            color: #0d6efd;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

            margin-bottom: 20px;

        }


        .announcement-date {

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 12px;

        }


        .announcement-date i {

            color: #0d6efd;

        }


        .announcement-title {

            font-size: 32px;

            line-height: 1.35;

            font-weight: 700;

            color: #17365d;

            margin: 0;

        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .announcement-content {

            padding: 35px 40px 40px;

        }


        .content-label {

            font-size: 15px;

            font-weight: 700;

            color: #17365d;

            margin-bottom: 18px;

            padding-bottom: 10px;

            border-bottom: 2px solid #0d6efd;

            display: inline-block;

        }


        .announcement-text {

            color: #4b5563;

            font-size: 16px;

            line-height: 1.9;

            white-space: normal;

            word-break: break-word;

        }


        .announcement-text p {

            margin-bottom: 18px;

        }


        /* =====================================================
           PDF SECTION
        ===================================================== */

        .pdf-section {

            margin-top: 35px;

            padding-top: 30px;

            border-top: 1px solid #eeeeee;

        }


        .pdf-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-bottom: 15px;

        }


        .pdf-title {

            font-size: 18px;

            font-weight: 700;

            color: #17365d;

            margin: 0;

        }


        .pdf-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            background: #dc3545;

            color: white;

            padding: 9px 15px;

            border-radius: 7px;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition: .2s;

        }


        .pdf-button:hover {

            background: #bb2d3b;

            color: white;

        }


        /* =====================================================
           PDF VIEWER
        ===================================================== */

        .pdf-card {

            width: 100%;

            background: #222;

            border-radius: 7px;

            overflow: hidden;

            box-shadow:
                0 3px 12px rgba(0, 0, 0, .10);

        }


        .pdf-toolbar {

            height: 52px;

            background: #333;

            display: flex;

            align-items: center;

            justify-content: flex-end;

            padding: 0 18px;

            gap: 22px;

        }


        .pdf-toolbar a {

            color: white;

            text-decoration: none;

            font-size: 19px;

            transition: .2s;

        }


        .pdf-toolbar a:hover {

            opacity: .7;

        }


        .pdf-viewer {

            display: block;

            width: 100%;

            height: 800px;

            border: none;

            background: #222;

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
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .custom-navbar .nav-link {

                padding: 10px 0;

            }


            .page-wrapper {

                padding: 25px 15px 40px;

            }


            .announcement-header {

                padding: 30px;

            }


            .announcement-content {

                padding: 30px;

            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 576px) {

            body {

                padding-top: 65px;

            }


            .page-wrapper {

                padding: 15px 10px 30px;

            }


            .custom-navbar .navbar-nav {

                background: #0d6efd;

                padding: 10px;

                border-radius: 10px;

            }


            .announcement-header {

                padding: 25px 20px;

            }


            .announcement-content {

                padding: 25px 20px;

            }


            .announcement-icon {

                width: 50px;

                height: 50px;

                font-size: 24px;

            }


            .announcement-title {

                font-size: 24px;

            }


            .announcement-text {

                font-size: 14px;

                line-height: 1.8;

            }


            .pdf-header {

                align-items: flex-start;

                flex-direction: column;

            }


            .pdf-viewer {

                height: 650px;

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


        <!-- LOGO -->

        <a
            class="navbar-brand fw-bold d-flex align-items-center"
            href="/home">

            <img
                src="{{ asset('logo_jdihn-toba.png') }}"
                alt="Logo JDIH Toba"
                style="
                    height: 45px;
                    width: auto;
                    margin-right: 10px;
                ">

        </a>


        <!-- TOGGLER -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- MENU -->

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
                        class="nav-link dropdown-toggle active"
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

                        <li>

                            <a
                                class="dropdown-item"
                                href="#">

                                Galeri

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



<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<main>

    <div class="container page-wrapper">


        <!-- =================================================
             BACK
        ================================================== -->

        <div class="back-button">

            <a
                href="/pengumuman"
                class="btn btn-outline-secondary btn-sm back-link">

                <i class="bi bi-arrow-left me-1"></i>

                Kembali ke Pengumuman

            </a>

        </div>



        <!-- =================================================
             DETAIL CARD
        ================================================== -->

        <article class="announcement-detail-card">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="announcement-header">



                <!-- DATE -->

                <div class="announcement-date">

                    <i class="bi bi-calendar3 me-1"></i>

                    @if($pengumuman->tanggal_upload)

                        {{ $pengumuman->tanggal_upload->translatedFormat('d F Y') }}

                    @else

                        -

                    @endif

                </div>


                <!-- TITLE -->

                <h1 class="announcement-title">

                    {{ $pengumuman->judul }}

                </h1>

            </div>



            <!-- =================================================
                 CONTENT
            ================================================== -->

            <div class="announcement-content">


                <div class="content-label">

                    Isi Pengumuman

                </div>


                <div class="announcement-text">

                    {!! nl2br(e($pengumuman->isi)) !!}

                </div>



                <!-- =================================================
                     PDF
                     HANYA MUNCUL JIKA ADA FILE
                ================================================== -->

                @if($pengumuman->file_pdf)

                    <div class="pdf-section">


                        <div class="pdf-header">


                            <h3 class="pdf-title">

                                <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>

                                Dokumen Pengumuman

                            </h3>


                            <!-- DOWNLOAD -->

                            <a
                                href="{{ asset(
                                    'uploads/pengumuman/' .
                                    $pengumuman->file_pdf
                                ) }}"
                                download
                                class="pdf-button">

                                <i class="bi bi-download"></i>

                                Download PDF

                            </a>

                        </div>



                        <!-- PDF VIEWER -->

                        <div class="pdf-card">


                            <!-- TOOLBAR -->

                            <div class="pdf-toolbar">


                                <!-- OPEN -->

                                <a
                                    href="{{ asset(
                                        'uploads/pengumuman/' .
                                        $pengumuman->file_pdf
                                    ) }}"
                                    target="_blank"
                                    title="Buka PDF">

                                    <i class="bi bi-box-arrow-up-right"></i>

                                </a>


                                <!-- DOWNLOAD -->

                                <a
                                    href="{{ asset(
                                        'uploads/pengumuman/' .
                                        $pengumuman->file_pdf
                                    ) }}"
                                    download
                                    title="Download PDF">

                                    <i class="bi bi-download"></i>

                                </a>


                                <!-- PRINT -->

                                <a
                                    href="{{ asset(
                                        'uploads/pengumuman/' .
                                        $pengumuman->file_pdf
                                    ) }}"
                                    target="_blank"
                                    title="Cetak PDF">

                                    <i class="bi bi-printer"></i>

                                </a>


                            </div>


                            <!-- VIEWER -->

                            <iframe
                                src="{{ asset(
                                    'uploads/pengumuman/' .
                                    $pengumuman->file_pdf
                                ) }}"
                                class="pdf-viewer"
                                title="Dokumen Pengumuman">
                            </iframe>


                        </div>

                    </div>

                @endif


            </div>

        </article>

    </div>

</main>



<!-- =====================================================
     FOOTER
===================================================== -->

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
                    Kabupaten Toba.

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



<!-- =====================================================
     BOOTSTRAP JS
===================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>



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