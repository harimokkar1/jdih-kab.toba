<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>JDIH Kabupaten Toba</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        /* =========================================================
   STRUKTUR ORGANISASI - MAIN CONTENT
========================================================= */

        .struktur-section {
            background: #f5f7fb;
            min-height: calc(100vh - 70px);
            padding: 70px 0 90px;
        }

        /* HEADER */
        .struktur-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 45px;
        }

        .struktur-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #e8f1ff;
            color: #0d6efd;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: 15px;
        }

        .struktur-header h1 {
            font-size: 42px;
            font-weight: 800;
            color: #172033;
            margin-bottom: 12px;
        }

        .struktur-header h1 span {
            color: #0d6efd;
        }

        .struktur-header p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.8;
            margin: 0;
        }

        /* GARIS BAWAH JUDUL */
        .title-line {
            width: 65px;
            height: 4px;
            background: #0d6efd;
            border-radius: 10px;
            margin: 18px auto 0;
        }

        /* INFO CARD */
        .struktur-info {
            max-width: 1100px;
            margin: 0 auto 35px;
            display: flex;
            gap: 20px;
        }

        .info-card {
            flex: 1;
            background: white;
            border-radius: 16px;
            padding: 22px 25px;
            border: 1px solid #e9edf3;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .info-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;
            border-radius: 14px;
            background: #eaf2ff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .info-card h6 {
            margin: 0 0 4px;
            font-weight: 700;
            color: #172033;
        }

        .info-card p {
            margin: 0;
            font-size: 13px;
            color: #7b8494;
        }

        /* CONTAINER BAGAN */
        .struktur-container {
            max-width: 1400px;
            margin: auto;
            background: #ffffff;
            border-radius: 22px;
            border: 1px solid #e7ebf1;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .06);
            overflow: hidden;
        }

        .struktur-title {
            padding: 25px 30px;
            border-bottom: 1px solid #edf0f4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .struktur-title h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 750;
            color: #172033;
        }

        .struktur-title p {
            margin: 5px 0 0;
            color: #7b8494;
            font-size: 13px;
        }

        .struktur-title-icon {
            width: 45px;
            height: 45px;
            background: #0d6efd;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* AREA TREE */
        .struktur-wrapper {
            padding: 50px 35px 60px;
            overflow-x: auto;
            overflow-y: hidden;
        }

        .struktur-wrapper::-webkit-scrollbar {
            height: 8px;
        }

        .struktur-wrapper::-webkit-scrollbar-track {
            background: #f1f3f6;
            border-radius: 10px;
        }

        .struktur-wrapper::-webkit-scrollbar-thumb {
            background: #c5ccd6;
            border-radius: 10px;
        }

        .tree {
            width: max-content;
            min-width: 100%;
            margin: auto;
        }

        .tree ul {
            padding-top: 35px;
            position: relative;
            display: flex;
            justify-content: center;
            margin: 0;
            padding-left: 0;
        }

        .tree>ul {
            padding-top: 0;
        }

        .tree li {
            list-style: none;
            position: relative;
            padding: 35px 15px 0;
            text-align: center;
        }

        /* GARIS VERTIKAL DARI PARENT */
        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            width: 50%;
            height: 35px;
            border-top: 2px solid #d6dce5;
        }

        .tree li::before {
            right: 50%;
        }

        .tree li::after {
            left: 50%;
            border-left: 2px solid #d6dce5;
        }

        /* HILANGKAN GARIS PADA ROOT */
        .tree>ul>li {
            padding-top: 0;
        }

        .tree>ul>li::before,
        .tree>ul>li::after {
            display: none;
        }

        /* HILANGKAN GARIS KIRI PADA NODE PERTAMA */
        .tree li:first-child::before {
            border-top: none;
        }

        /* HILANGKAN GARIS KANAN PADA NODE TERAKHIR */
        .tree li:last-child::after {
            border-top: none;
        }

        /* GARIS TENGAH KE ANAK */
        .tree li>ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            height: 35px;
            border-left: 2px solid #d6dce5;
        }

        /* NODE */
        .struktur-node {
            width: 230px;
            min-height: 235px;
            background: #ffffff;
            border: 1px solid #e2e7ef;
            border-radius: 18px;
            padding: 22px 18px 18px;
            position: relative;
            box-shadow: 0 8px 25px rgba(20, 35, 60, .08);
            transition: all .3s ease;
            margin: auto;
        }

        .struktur-node:hover {
            transform: translateY(-7px);
            border-color: #0d6efd;
            box-shadow: 0 15px 35px rgba(13, 110, 253, .15);
        }

        /* FOTO */
        .struktur-foto,
        .struktur-foto-default {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: block;
            object-fit: cover;
            border: 4px solid #eaf2ff;
            background: #f1f5f9;
        }

        .struktur-foto-default {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            color: #94a3b8;
        }

        /* NAMA */
        .struktur-nama {
            color: #172033;
            font-size: 16px;
            font-weight: 750;
            line-height: 1.4;
            margin-bottom: 7px;
        }

        /* JABATAN */
        .struktur-jabatan {
            color: #0d6efd;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
            min-height: 39px;
        }

        /* LEVEL */
        .struktur-level {
            display: inline-block;
            margin-top: 12px;
            padding: 5px 11px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
        }

        /* EMPTY STATE */
        .empty-struktur {
            max-width: 700px;
            margin: 30px auto;
            padding: 70px 30px;
            text-align: center;
            background: white;
            border: 1px solid #e5eaf0;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .05);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #eef4ff;
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
        }

        .empty-struktur h4 {
            font-weight: 750;
            color: #172033;
            margin-bottom: 10px;
        }

        .empty-struktur p {
            color: #7b8494;
            margin: 0;
        }

        /* RESPONSIVE */
        @media(max-width: 768px) {

            .struktur-section {
                padding: 45px 0 60px;
            }

            .struktur-header {
                padding: 0 20px;
                margin-bottom: 30px;
            }

            .struktur-header h1 {
                font-size: 30px;
            }

            .struktur-header p {
                font-size: 14px;
            }

            .struktur-info {
                flex-direction: column;
                padding: 0 15px;
            }

            .info-card {
                padding: 18px;
            }

            .struktur-container {
                border-radius: 15px;
                margin: 0 10px;
            }

            .struktur-title {
                padding: 20px;
            }

            .struktur-title h3 {
                font-size: 17px;
            }

            .struktur-wrapper {
                padding: 40px 20px 50px;
            }

            .struktur-node {
                width: 205px;
                min-height: 220px;
            }
        }

        /* GLOBAL */
        body {
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
            /* biar konten tidak ketutup navbar */
            background: #f8f9fa;
        }

        /* NAVBAR */
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

        /* DROPDOWN */
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

        /* CAROUSEL */
        .carousel-img {
            height: 600px;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, .2),
                    rgba(0, 0, 0, .75));
        }

        /* CAPTION */
        .carousel-caption {
            position: absolute;
            left: 8%;
            right: auto;
            bottom: 15%;
            width: 45%;
            text-align: left;
            z-index: 2;
        }

        .carousel-caption h1 {
            display: inline-block;
            padding: 12px 22px;
            background: rgba(0, 0, 0, .5);
            border-radius: 10px;
            font-size: 45px;
            font-weight: 700;
            color: white;
            animation: slideDown 1s ease;
        }

        /* ANIMATION */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        /* WELCOME */
        .welcome h2 {
            font-weight: 700;
            color: #333;
        }

        /* FEATURE CARD */
        .feature-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }

        .feature-card h4 {
            font-size: 40px;
        }

        /* FOOTER */
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

        /* RESPONSIVE */
        @media(max-width:768px) {

            .carousel-img {
                height: 400px;
            }

            .carousel-caption {
                left: 5%;
                width: 90%;
                bottom: 10%;
            }

            .carousel-caption h1 {
                font-size: 28px;
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
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/home">

                <img
                    src="{{ asset('logo_jdihn-toba.png') }}"
                    alt="Logo JDIH Toba"
                    style="height: 45px; width: auto; margin-right: 10px;">

            </a> <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home"> Home </a>
                    </li>

                    <!-- MENU 2 -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Profil
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/sejarah">Sejarah</a></li>
                            <li><a class="dropdown-item" href="/visi">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="/organisasi">Struktur Organisasi</a></li>
                        </ul>
                    </li>

                    <!-- MENU 3 -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Produk Hukum
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/peraturan-daerah">Peraturan Daerah</a></li>
                            <li><a class="dropdown-item" href="/peraturan-bupati">Peraturan Bupati</a></li>
                            <li><a class="dropdown-item" href="/keputusan-bupati">Keputusan Bupati</a></li>
                        </ul>
                    </li>

                    <!-- MENU 4 -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            Informasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/berita">Berita</a></li>
                            <li><a class="dropdown-item" href="/pengumuman"> Pengumuman </a> </li>
                        </ul>
                    </li>

                    <!-- MENU 5 -->
                    <li class="nav-item">
                        <a class="nav-link" href="/kontak"> Kontak </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CAROUSEL -->
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($carousels as $key => $c)
            <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                <img src="/carousel/{{ $c->image }}" class="d-block w-100 carousel-img">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <h1> {{ $c->title }} </h1>
                </div>
            </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    <div class="container-fluid py-5">
        <!-- =========================
         JUDUL
    ========================== -->
        <div class="struktur-header">
            <h1> Struktur Organisasi </h1>
            <p> Struktur organisasi dan susunan jabatan </p>
        </div>

        <!-- =========================
         DATA STRUKTUR
    ========================== -->
        @if($struktur->count() > 0)

        @php
        /*
        |--------------------------------------------------------------------------
        | Fungsi Recursive
        |--------------------------------------------------------------------------
        |
        | Fungsi ini digunakan untuk menampilkan struktur organisasi
        | berdasarkan hubungan parent_id.
        |
        | Tidak membutuhkan file partial.
        |
        */

        $tampilkanStruktur = function ($item) use (&$tampilkanStruktur) {
        echo '<li>';
            /*
            |--------------------------------------------------------------------------
            | NODE
            |--------------------------------------------------------------------------
            */
            echo '<div class="struktur-node">';
                /*
                | FOTO
                */
                if ($item->foto) {
                echo '<img
                    src="' . asset('storage/' . $item->foto) . '"
                    alt="' . e($item->nama) . '"
                    class="struktur-foto">';

                } else {
                echo '<div class="struktur-foto-default">
                    👤
                </div>';
                }

                /*
                | NAMA
                */

                echo '<div class="struktur-nama">'
                    . e($item->nama) .
                    '</div>';


                /*
                | JABATAN
                */

                echo '<div class="struktur-jabatan">'
                    . e($item->jabatan) .
                    '</div>';

                /*
                | TINGKAT
                */

                echo '<div class="struktur-level">
                    Tingkat ' . e($item->tingkat) . '
                </div>';
                echo '</div>';

            /*
            |--------------------------------------------------------------------------
            | ANAK / BAWAHAN
            |--------------------------------------------------------------------------
            */
            if ($item->children && $item->children->count() > 0) {
            echo '<ul>';
                foreach ($item->children as $child) {
                $tampilkanStruktur($child);
                }
                echo '</ul>';
            }
            echo '</li>';
        };

        @endphp
        <!-- =========================
             BAGAN
        ========================== -->
        <div class="struktur-container">
            <div class="struktur-wrapper">
                <div class="tree">
                    <ul>
                        @foreach($struktur as $item)
                        @php
                        $tampilkanStruktur($item);
                        @endphp
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        @else

        <!-- =========================
             DATA KOSONG
        ========================== -->
        <div class="empty-struktur">
            <div style="font-size: 60px;"> 🏢 </div>
            <h4> Struktur Organisasi Belum Tersedia </h4>
            <p> Data struktur organisasi belum ditambahkan. </p>
        </div>

        @endif
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.addEventListener("scroll", function() {
            let nav = document.querySelector(".custom-navbar");
            if (window.scrollY > 50) {
                nav.classList.add("scrolled");
            } else {
                nav.classList.remove("scrolled");
            }
        });

        const carousel = document.querySelector('#carouselExample');
        if (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 5000,
                pause: false
            });
        }
    </script>
</body>

</html>