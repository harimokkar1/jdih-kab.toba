<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - JDIH Kabupaten Toba</title>
    
    <!-- Bootstrap -->
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        /* GLOBAL */
        body {
            font-family: 'Segoe UI', sans-serif;
            padding-top: 70px;
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

        /* BERITA SECTION */
        .berita-section {
            padding: 70px 0;
            min-height: 600px;
        }

        /* SECTION TITLE */
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

        /* BERITA CARD */
        .berita-card {
            height: 100%;
            background: #fff;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .berita-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
        }

        /* IMAGE */
        .berita-image-wrapper {
            width: 100%;
            height: 230px;
            overflow: hidden;
            background: #e9ecef;
        }

        .berita-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s ease;
        }

        .berita-card:hover .berita-image {
            transform: scale(1.05);
        }

        .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 55px;
        }

        /* BODY */
        .berita-body {
            padding: 22px;
        }

        .berita-date {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .berita-date i {
            color: #0d6efd;
        }

        .berita-title {
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

        .berita-excerpt {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 18px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* BUTTON */
        .btn-baca {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0d6efd;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-baca:hover {
            color: #084298;
            gap: 10px;
        }

        /* PAGINATION */
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

        /* EMPTY */
        .empty-news {
            text-align: center;
            padding: 80px 20px;
            color: #6c757d;
        }

        .empty-news i {
            font-size: 60px;
            color: #adb5bd;
            display: block;
            margin-bottom: 15px;
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
        @media(max-width: 768px) {
            .berita-section {
                padding: 45px 15px;
            }

            .berita-image-wrapper {
                height: 200px;
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

            </a>            <button class="navbar-toggler"  data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">
                    <!-- HOME -->
                    <li class="nav-item">
                        <a class="nav-link"  href="/home">   Home  </a>
                    </li>

                    <!-- PROFIL -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Profil </a>
                        <ul class="dropdown-menu">
                            <li> <a  class="dropdown-item"  href="/sejarah"> Sejarah </a>  </li>
                            <li> <a  class="dropdown-item" href="/visi">   Visi Misi  </a>  </li>
                            <li> <a class="dropdown-item" href="/organisasi">  Struktur Organisasi </a>  </li>
                        </ul>
                    </li>

                    <!-- PRODUK HUKUM -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  href="#" data-bs-toggle="dropdown">  Produk Hukum </a>
                        <ul class="dropdown-menu">
                            <li> <a class="dropdown-item" href="/peraturan-daerah"> Peraturan Daerah  </a> </li>
                            <li>  <a class="dropdown-item" href="/peraturan-bupati"> Peraturan Bupati   </a> </li>
                            <li><a class="dropdown-item" href="/keputusan-bupati">  Keputusan Bupati  </a>  </li>
                        </ul>
                    </li>

                    <!-- INFORMASI -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"   href="#"  data-bs-toggle="dropdown">  Informasi  </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item active"href="/berita"> Berita </a> </li>
                            <li><a class="dropdown-item" href="/pengumuman"> Pengumuman </a> </li>
                        </ul>
                    </li>

                    <!-- KONTAK -->
                    <li class="nav-item">
                        <a class="nav-link"  href="/kontak">
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- BERITA -->
    <main>
        <section class="berita-section">
            <div class="container">
                <!-- TITLE -->
                <div class="section-title">
                    <h2> Berita  </h2>
                    <p>  Informasi dan berita terbaru JDIH Kabupaten Toba  </p>
                    <div class="title-line"></div>
                </div>

                @if($beritas->count() > 0)
                    <!-- GRID BERITA -->
                    <div class="row g-4">
                        @foreach($beritas as $berita)
                            <div class="col-lg-4 col-md-6">
                                <article class="berita-card">
                                    <!-- GAMBAR -->
                                    <div class="berita-image-wrapper">
                                        @if($berita->gambar)
                                            <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-image">
                                        @else
                                            <div class="no-image">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="berita-body">
                                        <!-- TANGGAL -->
                                        <div class="berita-date"> <i class="bi bi-calendar3 me-1"></i> {{ $berita->created_at->format('d F Y') }}  </div>
                                        <!-- JUDUL -->
                                        <h3 class="berita-title"> {{ $berita->judul }} </h3>
                                        <!-- EXCERPT -->
                                        <div class="berita-excerpt">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 150) }}
                                        </div>

                                        <!-- DETAIL -->
                                        <a href="{{ route('berita.detail', $berita->id) }}" class="btn-baca">
                                            Baca Selengkapnya
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    <!-- PAGINATION -->
                    <div class="d-flex justify-content-center">
                        {{ $beritas->links('pagination::bootstrap-5') }}
                    </div>

                @else
                    <!-- BELUM ADA BERITA -->
                    <div class="empty-news">
                        <i class="bi bi-newspaper"></i>
                        <h4>Belum Ada Berita </h4>
                        <p>  Belum ada berita yang dipublikasikan.   </p>
                    </div>
                @endif
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">  </script>
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