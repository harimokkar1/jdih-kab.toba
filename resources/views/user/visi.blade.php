<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDIH Kabupaten Toba</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* GLOBAL */
        body {
            font-family: 'Segoe UI', sans-serif;
            padding-top: 75px;
            /* biar tidak ketutup navbar */
            background: #f8f9fa;
        }

        /* NAVBAR */
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

        /* NAV LINK */
        .navbar-nav .nav-link {
            color: white !important;
            margin-left: 12px;
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }

        /* DROPDOWN */
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

        /* CAROUSEL */
        .carousel-img {
            height: 600px;
            object-fit: cover;
            filter: brightness(85%);
        }

        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.2),
                    rgba(0, 0, 0, 0.75));
        }

        /* CAPTION */
        .carousel-caption {
            position: absolute;
            left: 8%;
            bottom: 15%;
            width: 45%;
            text-align: left;
            z-index: 2;
        }

        .carousel-caption h1 {
            display: inline-block;
            padding: 12px 25px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 12px;
            font-size: 42px;
            font-weight: 700;
            color: #fff;
            animation: slideDown 1s ease;
        }

        /* ANIMASI */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* SECTION TITLE */
        h2 {
            color: #222;
        }

        /* CARD VISI MISI */
        .card {
            border-radius: 20px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* TEXT */
        .text-muted {
            color: #666 !important;
        }

        /* FOOTER */
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

        /* ALERT */
        .alert {
            border-radius: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            body {
                padding-top: 65px;
            }

            .carousel-img {
                height: 400px;
            }

            .carousel-caption {
                left: 5%;
                width: 90%;
                bottom: 10%;
            }

            .carousel-caption h1 {
                font-size: 26px;
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
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Profil </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/sejarah">Sejarah</a></li>
                            <li><a class="dropdown-item" href="/visi">Visi Misi</a></li>
                            <li><a class="dropdown-item" href="/organisasi">Struktur Organisasi</a></li>
                        </ul>
                    </li>


                    <!-- MENU 3 -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Produk Hukum </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/peraturan-daerah">Peraturan Daerah</a></li>
                            <li><a class="dropdown-item" href="/peraturan-bupati">Peraturan Bupati</a></li>
                            <li><a class="dropdown-item" href="/keputusan-bupati">Keputusan Bupati</a></li>
                        </ul>
                    </li>

                    <!-- MENU 4 -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">
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
    <div id="carouselExample"
        class="carousel slide carousel-fade"
        data-bs-ride="carousel">

        <div class="carousel-inner">
            @foreach($carousels as $key => $c)
            <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                <img src="/carousel/{{ $c->image }}"
                    class="d-block w-100 carousel-img">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <h1> {{ $c->title }} </h1>
                </div>
            </div>
            @endforeach
        </div>

        <button class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>


    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Visi & Misi</h2>
            <p class="text-muted">Informasi resmi dari admin</p>
            <hr style="width:80px; margin:auto; border:2px solid #0d6efd;">
        </div>

        @if($data)

        <!-- VISI -->
        <div class="card border-0 shadow-lg mb-4" style="border-radius:20px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="mb-0 fw-bold text-primary">Visi</h4>
                </div>
                <p class="text-muted" style="font-size:17px; line-height:1.8;"> {{ $data->visi }} </p>
            </div>
        </div>

        <!-- MISI -->
        <div class="card border-0 shadow-lg" style="border-radius:20px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="mb-0 fw-bold text-success">Misi</h4>
                </div>
                <div class="text-muted" style="font-size:17px; line-height:1.8;">
                    {!! nl2br(e($data->misi)) !!}
                </div>
            </div>
        </div>

        @else

        <div class="alert alert-secondary text-center p-4" style="border-radius:15px;">
            <h5 class="mb-0">Data visi & misi belum tersedia</h5>
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