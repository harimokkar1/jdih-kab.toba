<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>{{ $berita->judul }} - JDIH Kabupaten Toba</title>


    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <style>

        /* =========================
           GLOBAL
        ========================= */

        body {
            background: #f8f9fa;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #212529;
            padding-top: 75px;
        }


        /* =========================
           NAVBAR
        ========================= */

        .custom-navbar {
            top: 0;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            padding: 12px 0;
        }


        .custom-navbar.scrolled {
            background: #0d6efd;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }


        .navbar-nav .nav-link {
            color: white !important;
            margin-left: 12px;
            font-weight: 500;
            transition: 0.3s;
        }


        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }


        .dropdown-menu {
            border-radius: 12px;
            border: none;
            padding: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }


        .dropdown-item {
            border-radius: 8px;
            padding: 8px 12px;
            transition: 0.2s;
        }


        .dropdown-item:hover {
            background: #0d6efd;
            color: white;
        }


        /* =========================
           DETAIL BERITA
        ========================= */

        .detail-section {
            padding: 70px 0;
        }


        .detail-container {
            max-width: 900px;
            margin: 0 auto;
        }


        .detail-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
        }


        /* =========================
           GAMBAR BERITA
        ========================= */

        .detail-image-wrapper {
            width: 100%;
            max-height: 500px;
            overflow: hidden;
            background: #e9ecef;
        }


        .detail-image {
            width: 100%;
            height: 100%;
            max-height: 500px;
            object-fit: cover;
            display: block;
        }


        .no-image {
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 80px;
        }


        /* =========================
           CONTENT
        ========================= */

        .detail-content {
            padding: 40px;
        }


        .detail-date {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 15px;
        }


        .detail-date i {
            color: #0d6efd;
        }


        .detail-title {
            font-size: 34px;
            font-weight: 700;
            line-height: 1.3;
            color: #111827;
            margin-bottom: 25px;
        }


        .title-line {
            width: 65px;
            height: 4px;
            background: #0d6efd;
            border-radius: 10px;
            margin-bottom: 30px;
        }


        /* =========================
           ISI BERITA
        ========================= */

        .detail-text {
            font-size: 16px;
            line-height: 1.9;
            color: #374151;
            white-space: normal;
        }


        .detail-text p {
            margin-bottom: 20px;
        }


        /* =========================
           BACK BUTTON
        ========================= */

        .back-wrapper {
            margin-top: 25px;
        }


        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            background: #ffffff;
            color: #495057;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }


        .btn-back:hover {
            background: #0d6efd;
            border-color: #0d6efd;
            color: #ffffff;
        }


        /* =========================
           FOOTER
        ========================= */

        footer {
            background:  #111827;
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
            transition: 0.2s;
        }


        footer a:hover {
            color: #fff;
        }


        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            body {
                padding-top: 65px;
            }


            .detail-section {
                padding: 40px 15px;
            }


            .detail-content {
                padding: 25px 20px;
            }


            .detail-title {
                font-size: 26px;
            }


            .detail-text {
                font-size: 15px;
                line-height: 1.8;
            }


            .detail-image-wrapper {
                max-height: 350px;
            }


            .detail-image {
                max-height: 350px;
            }


            .navbar-nav {
                background: #0d6efd;
                padding: 12px;
                border-radius: 10px;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

        <div class="container">
<a class="navbar-brand fw-bold d-flex align-items-center" href="/home">

                <img
                    src="{{ asset('logo_jdihn-toba.png') }}"
                    alt="Logo JDIH Toba"
                    style="height: 45px; width: auto; margin-right: 10px;">

            </a>


            <button
                class="navbar-toggler"
                type="button"
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
                            <li><a class="dropdown-item" href="/pengumuman"> Pengumuman </a> </li>

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
         DETAIL BERITA
    ====================================================== -->

    <main>

        <section class="detail-section">

            <div class="container">

                <div class="detail-container">


                    <!-- DETAIL CARD -->

                    <article class="detail-card">


                        <!-- GAMBAR -->

                        <div class="detail-image-wrapper">

                            @if($berita->gambar)

                                <img
                                    src="{{ asset('uploads/berita/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}"
                                    class="detail-image">

                            @else

                                <div class="no-image">

                                    <i class="bi bi-image"></i>

                                </div>

                            @endif

                        </div>



                        <!-- CONTENT -->

                        <div class="detail-content">


                            <!-- TANGGAL -->

                            <div class="detail-date">

                                <i class="bi bi-calendar3"></i>

                                <span>

                                    {{ $berita->created_at->format('d F Y') }}

                                </span>

                            </div>



                            <!-- JUDUL -->

                            <h1 class="detail-title">

                                {{ $berita->judul }}

                            </h1>


                            <div class="title-line"></div>



                            <!-- ISI BERITA -->

                            <div class="detail-text">

                                {!! nl2br(e($berita->isi)) !!}

                            </div>


                        </div>


                    </article>



                    <!-- KEMBALI -->

                    <div class="back-wrapper">

                        <a
                            href="{{ route('berita') }}"
                            class="btn-back">

                            <i class="bi bi-arrow-left"></i>

                            Kembali ke Berita

                        </a>

                    </div>


                </div>

            </div>

        </section>

    </main>



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



    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>



    <!-- Navbar Scroll Effect -->

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