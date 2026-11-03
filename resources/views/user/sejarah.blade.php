<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sejarah JDIHN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ================= GLOBAL ================= */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* ================= NAVBAR ================= */
        .custom-navbar {
            background: rgba(13, 110, 253, 0.9);
            backdrop-filter: blur(8px);
            transition: 0.3s;
            padding: 12px 0;
        }

        .custom-navbar.scrolled {
            background: #0d6efd;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 20px;
            letter-spacing: 1px;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            margin-left: 10px;
            font-weight: 500;
            transition: 0.2s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd369 !important;
        }

        /* ================= DROPDOWN ================= */
        .dropdown-menu {
            border-radius: 12px;
            border: none;
            padding: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .dropdown-item {
            border-radius: 8px;
            transition: 0.2s;
        }

        .dropdown-item:hover {
            background: #0d6efd;
            color: white;
        }

        /* ================= HERO ================= */
        .hero {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 100px 20px 70px;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .hero p {
            opacity: 0.9;
            font-size: 16px;
        }

        /* ================= CONTENT CARD ================= */
        .card-content {
            margin-top: -60px;
            border-radius: 20px;
            padding: 35px;
            background: white;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        /* PARAGRAPH */
        .card-content p {
            text-align: justify;
            line-height: 1.9;
            font-size: 15.8px;
            color: #444;
            margin-bottom: 16px;
        }

        /* TITLE SECTION */
        .section-title {
            font-weight: 700;
            font-size: 18px;
            color: #0d6efd;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        /* ================= LIST ================= */
        .card-content ol {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .card-content ul {
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .card-content li {
            margin-bottom: 8px;
            line-height: 1.7;
            color: #444;
        }

        /* NESTED LIST */
        .card-content ol ol {
            margin-top: 8px;
        }

        /* ================= FOOTER ================= */
        footer {
            background:  #111827;
            color: white;
            padding: 50px 0 20px;
            margin-top: 50px;
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
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            font-size: 14px;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {

            .hero {
                padding: 80px 15px 60px;
            }

            .hero h1 {
                font-size: 26px;
            }

            .card-content {
                margin-top: -40px;
                padding: 25px;
            }

            .card-content p {
                font-size: 14.5px;
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

    <div class="hero">
        <h1>Sejarah JDIHN</h1>
        <p>Jaringan Dokumentasi dan Informasi Hukum Nasional</p>
    </div>

    <div class="container mb-5">
        <div class="card card-content p-4 bg-white">

            <p>
                Ide membentuk Jaringan Dokumentasi dan Informasi Hukum Nasional (JDIHN), secara historis melekat erat dengan pembangunan hukum nasional dalam upaya mewujudkan supremasi hukum. Dikatakan demikian karena embrio pembentukan JDIHN adalah salah satu rekomendasi dari kegiatan pembangunan hukum nasional yaitu Seminar Hukum Nasional III tahun 1974 di Surabaya. Seminar hukum tersebut diselenggarakan oleh Badan Pembinaan Hukum Nasional dalam upaya membedah semua unsur pembangunan hukum dalam rangka mengidentifikasi permasalahan dan menemukan solusi pemecahannya.
            </p>

            <p>
                Pada saat membedah dokumentasi hukum, para peserta seminar mengetahui bahwa dukungan dokumentasi hukum terhadap pembangunan hukum nasional masih sangat lemah. Dokumentasi hukum belum mampu menyediakan dokumen dan informasi hukum dengan cepat dan tepat pada saat dibutuhkan. Dokumentasi hukum belum mampu menyediakan akses informasi hukum yang efektif, sehingga dokumen/informasi hukum sulit dicari dan ditemukan kembali pada saat dibutuhkan untuk mendukung pelaksanaan kegiatan pembangunan hukum, seperti: penelitian hukum, perencanaan hukum, penyusunan naskah akademis, penyusunan rancangan peraturan perundang-undangan, pembentukan kebijakan pimpinan dan lain-lain.
            </p>

            <p class="section-title">Faktor Penyebab:</p>
            <ol>
                <li>Dokumen hukum potensial, tersebar luas di instansi pemerintah di pusat sampai daerah dengan wilayah kepulauan yang sangat luas;</li>
                <li>Dokumen-dokumen hukum tersebut belum semuanya dikelola dengan baik dalam suatu sistem;</li>
                <li>Tenaga pengelola yang ada sangat kurang;</li>
                <li>Perhatian terhadap keberadaan dokumentasi dan perpustakaan hukum masih sangat kurang.</li>
            </ol>

            <p>
                Peserta seminar berpendapat bahwa cara yang paling efektif untuk mengatasi kelemahan dokumentasi hukum ini adalah membentuk kerja sama antar unit pengelola dokumen hukum itu sendiri dalam suatu jaringan dokumentasi dan informasi hukum.
            </p>

            <p class="section-title">Rekomendasi Seminar:</p>
            <ol>
                <li>Perlu adanya suatu kebijakan nasional untuk mulai menyusun sistem jaringan dokumentasi dan informasi hukum agar segera dapat berfungsi;</li>
                <li>Dalam tahap permulaan ada dua hal yang perlu dilakukan:
                    <ul>
                        <li>Mempermudah pencarian dan penemuan kembali peraturan perundang-undangan, yurisprudensi, serta bahan lainnya;</li>
                        <li>Mendayagunakan semua informasi yang ada dengan menyusun sistem jaringan dokumentasi hukum.</li>
                    </ul>
                </li>
            </ol>

            <p> Sambil menunggu terbitnya kebijakan nasional termaksud, BPHN (Badan Pembinaan Hukum Nasional) sebagai pengemban tugas pembinaan hukum nasional, segera menyelenggarakan serangkaian lokakarya dan berhasil mempersiapkan sarana (infrastruktur) jaringan agar bisa operasional. Lokakarya tersebut adalah Lokakarya tentang :</p>

            <ul>
                <li>Lokakarya tentang “Jaringan Dokumentasi dan Informasi Hukum” di Jakarta (1975)</li>
                <li>Lokakarya tentang “Sistem Penemuan Kembali Peraturan Perundang-undangan” di Malang (1977)</li>
                <li>Lokakarya tentang “Sistem Penyebarluasan Peraturan Perundang-undangan” di Pontianak (1977)</li>
                <li>Lokakarya tentang “Organisasi dan Komunikasi Sistem Jaringan Dokumentasi dan Informasi Hukum” di Jakarta (1978)</li>
            </ul>

            <p>
                Lokakarya Tahun 1978 sepakat menunjuk BPHN sebagai Pusat Jaringan dan diberi tugas sebagai penyelenggara latihan pembinaan tenaga, tempat konsultasi, penelitian dan pengembangan sistem jaringan, serta koordinator kegiatan unit-unit jaringan dalam rangka pengembangan jaringan. Dalam rangka melaksanakan tugas tersebut pada tahun 1988 BPHN sebagai Pusat JDIH mengeluarkan pedoman pengelolaaan dokumen hukum yang diberi nama ”Manual Unit Jaringan Dokumentasi dan Informasi Hukum” yang terdiri dari IV modul yaitu :
            </p>
            <ol>
                <li><strong>Modul I</strong> : Pedoman Prosedur Kerja Pusat Jaringan Dokumentasi dan Informasi Hukum.</li>
                <li><strong>Modul II</strong> : Pedoman Pengumpulan Bahan (Kegiatan Prakatalogan).</li>
                <li><strong>Modul III</strong> : Pedoman Pengolahan
                    <ol type="a">
                        <li> <strong>Sub-Modul III A</strong> : Pedoman Teknis Pengkatalogan Bahan Pustaka dan Pascakatalogan (berdasarkan UDC).</li>
                        <li><strong>Sub-Modul III B</strong> : Pedoman Teknis Pengkatalogan Peraturan Perundang-undangan.</li>
                        <li><strong>Sub-Modul III C</strong> : Pedoman Teknis Pengkatalogan Bahan Pustaka dan Pascakatalogan (berdasarkan DDC).</li>
                    </ol>
                </li>
                <li><strong>Modul IV</strong> : Pedoman Pelayanan Informasi.</li>
                <li><strong>Modul V</strong> : Sarana Kerja Unit Jaringan Dokumentasi dan Informasi Hukum.</li>
            </ol>

            <p>Dari tahun 1978 – 1999, BPHN melakukan pembinaan dan pengembangan JDIH hanya berdasarkan kesepakatan tersebut. Banyak upaya pembinaan dan pengembangan yang telah dilakukan, namun temu kembali informasi belum dapat dilakukan dengan cepat, tepat, dan pendayagunaan informasi belum dapat terselenggara dengan baik.</p>
            <p>Selama Pemerintahan Orde Baru rekomendasi untuk membentuk JDIHN kurang mendapat perhatian. Jaringan Dokumentasi dan Informasi Hukum disebut dalam GBHN 1993 bidang pembangunan hukum sektor sarana dan prasarana sebagai sarana penunjang pembangunan hukum. Namun dalam era Pemerintahan Reformasi rekomendasi termaksud langsung diwujudkan dengan mengundangkan Keputusan Presiden Nomor 91 Tahun 1999 tentang Jaringan Dokumentasi dan Informasi Hukum Nasional dalam Lembaran Negara No. 135. Kemudian dalam rangka melaksanakan . Instruksi Presiden Nomor 9 Tahun 2011 tentang Rencana Aksi Pencegahan dan Pemerantasan Korupsi Tahun 2011, Keputusan Presiden tersebut direvitalisasi dan diganti dengan Peraturan Presiden Nomor 33 Tahun 2012 tentang Jaringan Dokumentasi dan Informasi Hukum Nasional, Lembaran Negara No 82. Untuk menyesuaikan dengan perkembangan ilmu pengetahuan dan teknologi, Manual Unit Jaringan Dokumentasi dan Informasi Hukum juga telah direvisi dan dikembangkan oleh Pusat Jaringan dan dijadikan lampiran yang tidak terpisahkan dari Peraturan Menteri Hukum dan HAM Nomor 02 Tahun 2013 Tentang Standardisasi Pengelolaan Teknis Dokumentasi Dan Informasi Hukum, yang terdiri dari: </p>
            <ol>
                <li>Standardisasi Pengadaan Dokumen Hukum;</li>
                <li>Standardisasi Pembuatan Daftar Inventarisasi Peraturan Per-uu-an dan Instrumen Hukum lainnya;</li>
                <li>Standardisasi Pembuatan Katalog Peraturan Per-uu-an dan Instrumen Hukum lainnya;</li>
                <li>Standardisasi Pembuatan Abstrak Peraturan per-uu-an;</li>
                <li>Standardisasi Pembuatan Katalog Monografi Hukum;</li>
                <li>Standardisasi Penyusunan Indeks Majalah Hukum;</li>
                <li>Standardisasi Penyusunan Indeks Kliping Koran;</li>
                <li>Standardisasi Pelayanan Informasi Hukum;</li>
                <li>Standardisasi Website JDIHN;</li>
                <li>Standardisasi Monev Pengelolaan JDIHN;</li>
                <li>Standardisasi Pelaporan Penyelenggaraan JDIHN.</li>
            </ol>

            <p>Pasal 4 Peraturan Presiden Nomor 33 Tahun 2012 menetapkan kembali BPHN sebagai Pusat JDIHN dan Anggota JDIHN terdiri dari:</p>
            <ol>
                <li>
                    Biro Hukum dan/atau unit kerja yang tugas dan fungsinya menyelenggarakan kegiatan yang berkaitan dengan dokumen hukum pada:
                    <ol type="a">
                        <li>Kementerian Negara;</li>
                        <li>Sekretariat Lembaga Negara;</li>
                        <li>Lembaga Pemerintah Non Kementerian;</li>
                        <li>Pemerintah Provinsi;</li>
                        <li>Pemerintah Kabupaten/Kota; dan</li>
                        <li>Sekretariat Dewan Perwakilan Rakyat Daerah Tingkat Provinsi dan Kabupaten/Kota.</li>
                    </ol>
                </li>
                <li>Perpustakaan pada perguruan tinggi negeri dan perguruan tinggi swasta;</li>
                <li>Lembaga lain yang bergerak di bidang pengembangan dokumentasi dan informasi hukum yang ditetapkan oleh Menteri.</li>
            </ol>
            <p>Pasal 3 Peraturan Presiden Nomor 33 Tahun 2012 menegaskan bahwa tujuan dari JDIHN adalah:</p>
            <ol type="a">
                <li>Menjamin terciptanya Pengelolaan Dokumentasi dan Informasi Hukum yang terpadu dan terintegrasi di berbagai instansi pemerintah dan institusi lainnya;</li>
                <li>Menjamin ketersediaan dokumentasi dan informasi hukum yang lengkap dan akurat, serta dapat diakses secara cepat dan mudah;</li>
                <li>Mengembangkan kerja sama yang efektif antara Pusat Jaringan dan Anggota Jaringan serta antar sesama Anggota Jaringan dalam rangka penyediaan dokumentasi dan informasi hukum; dan</li>
                <li>Meningkatkan kualitas pembangunan hukum nasional dan pelayanan kepada publik sebagai salah satu wujud ketatapemerintahan yang baik, transparan, efektif, efisien, dan bertanggung jawab.</li>
            </ol>
            <p>Sejarah pembentukan JDIHN di atas menunjukkan betapa pentingnya kerjasama pengelolaan dokumen dan informasi hukum untuk mempercepat pembangunan hukum nasional yang berkualitas. Untuk membangun akses informasi hukum yang terintegrasi, secara nasional semua Anggota JDIHN wajib mengelola dokumen dan informasi hukum yang ada dalam kewenangannya dengan menggunakan modul/standar yang ada dan meningkatkan akselerasinya dengan memanfaatkan kecanggihan teknologi informasi dan komunikasi. Tersedianya akses informasi hukum bagi semua warga negara merupakan conditio sine quanon dalam mewujudkan supremasi hukum. Sementara menyediakan akses informasi hukum adalah tugas dari dokumentasi hukum Anggota Jaringan. </p>
        </div>
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