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

        /* CARD ITEM KONTAK */
        .contact-card-item {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            transition: .3s;
            height: 100%;
        }

        .contact-card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, .15);
        }

        .contact-card-item h6 {
            font-weight: 600;
            margin-bottom: 5px;
            color: #0d6efd;
        }

        .contact-card-item p {
            margin: 0;
            font-size: 14px;
            color: #555;
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

            </a>

            <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/home">
                            Home
                        </a>
                    </li>

                    <!-- MENU 2 -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">
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
                        <a class="nav-link dropdown-toggle"
                            href="#"
                            data-bs-toggle="dropdown">
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
                        <a class="nav-link" href="/kontak">
                            Kontak
                        </a>
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
                    <h1>
                        {{ $c->title }}
                    </h1>
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

    <!-- WELCOME -->
    <section class="welcome py-5">
        <div class="container text-center">
            <h2>
                Selamat Datang di JDIH Kabupaten Toba
            </h2>
            <p class="text-muted mt-3">
                Portal resmi dokumentasi dan informasi hukum Kabupaten Toba
            </p>
        </div>
    </section>

    <!-- KONTAK KAMI -->
    <section class="contact-section py-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <h2 class="mb-4 text-center">Kontak Kami</h2>

                    <div class="row g-3">

                        <div class="col-12">
                            <div class="contact-card-item p-3">
                                <h6>Alamat</h6>
                                <p>Jl. Sutomo, Pagar Batu, Balige 22385
                        Kabupaten Toba, Provinsi Sumatera Utara</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-card-item p-3">
                                <h6>Telepon</h6>
                                <p>0813-6244-4195</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="contact-card-item p-3">
                                <h6>Email</h6>
                                <p>hukumtobasamosirkab@gmail.com</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="contact-card-item p-3">
                                <h6>Jam Operasional</h6>
                                <p>Senin - Kamis (08.00 - 16.00)</p>
                                <p>Jumat (08.00 - 16.30)</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

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