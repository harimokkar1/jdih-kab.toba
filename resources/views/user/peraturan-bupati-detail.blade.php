<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $peraturanBupati->judul }} - JDIH Kabupaten Toba</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"   rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
           PAGE
        ===================================================== */
        .page-wrapper {
            width: 100%;
            padding: 25px;
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
           LEFT COLUMN
        ===================================================== */
        .left-column {
            width: 100%;
        }

        /* =====================================================
           CARD
        ===================================================== */
        .info-card {
            background: #ffffff;
            border-radius: 8px;
            margin-bottom: 18px;
            border: 1px solid #eeeeee;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* =====================================================
           CARD TITLE
        ===================================================== */
        .card-title-custom {
            padding: 17px 18px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 18px;
            font-weight: 600;
            color: #17365d;
        }

        /* =====================================================
           STATUS
        ===================================================== */
        .status-box {
            padding: 15px;
        }

        .status-alert {
            padding: 10px 12px;
            margin-bottom: 12px;
            border-radius: 4px;
            font-size: 12px;
        }

        .status-info {
            border: 1px dashed #d8d8d8;
            background: #fafafa;
            padding: 13px 10px;
            text-align: center;
            color: #888;
            font-size: 11px;
            line-height: 1.5;
        }


        /* =====================================================
           METADATA
        ===================================================== */
        .metadata-wrapper {
            padding: 8px 10px 10px;
        }

        .metadata-table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .metadata-table tr {
            border-bottom: 1px solid #dfe3e8;
        }

        .metadata-table tr:last-child {
            border-bottom: none;
        }

        .metadata-table td {
            padding: 10px 5px;
            font-size: 12px;
            line-height: 1.5;
            vertical-align: top;
            overflow-wrap: anywhere;
            word-break: break-word;
            white-space: normal;
        }

        .metadata-table td:first-child {
            width: 34%;
            padding-right: 12px;
            font-weight: 600;
            color: #17365d;
        }

        .metadata-table td:last-child {
            width: 66%;
            color: #4b5563;
            overflow-wrap: anywhere;
            word-break: break-word;
        }


        /* =====================================================
           LINK FILE
        ==================================================== */
        .metadata-table a {
            color: #0d6efd;
            text-decoration: none;
            word-break: break-all;
        }

        .metadata-table a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           PDF AREA
        ===================================================== */
        .pdf-card {
            width: 100%;
            background: #222;
            border-radius: 3px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }


        /* =====================================================
           PDF TOOLBAR
        ===================================================== */
        .pdf-toolbar {
            height: 55px;
            background: #333333;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 18px;
            gap: 22px;
        }

        .pdf-toolbar a {
            color: #ffffff;
            text-decoration: none;
            font-size: 19px;
            transition: .2s;
        }

        .pdf-toolbar a:hover {
            opacity: .7;
        }


        /* =====================================================
           PDF VIEWER
        ===================================================== */
        .pdf-viewer {
            display: block;
            width: 100%;
            height: 800px;
            border: none;
            background: #222222;
        }


        /* =====================================================
           EMPTY PDF
        ===================================================== */
        .empty-pdf {
            width: 100%;
            height: 800px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            text-align: center;
            padding: 20px;
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
           DESKTOP
        ===================================================== */
        @media (min-width: 1200px) {

            .page-wrapper {
                padding: 25px 30px;
            }

            .left-column {
                max-width: 350px;
            }

        }

        /* =====================================================
           TABLET
        ===================================================== */
        @media (max-width: 991px) {

            .custom-navbar .nav-link {
                padding: 10px 0;
            }

            .page-wrapper {
                padding: 15px;
            }

            .pdf-card {
                margin-top: 5px;
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
                padding: 10px;
            }

            .card-title-custom {
                font-size: 16px;
                padding: 14px;
            }

            .metadata-wrapper {
                padding: 5px 8px;
            }

            .metadata-table td {
                font-size: 11px;
                padding: 9px 4px;
            }

            .metadata-table td:first-child {
                width: 38%;
                padding-right: 8px;
            }

            .metadata-table td:last-child {
                width: 62%;
            }
            .pdf-viewer {
                height: 650px;
            }
            .empty-pdf {
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
<a class="navbar-brand fw-bold d-flex align-items-center" href="/home">

                <img
                    src="{{ asset('logo_jdihn-toba.png') }}"
                    alt="Logo JDIH Toba"
                    style="height: 45px; width: auto; margin-right: 10px;">

            </a>        <button class="navbar-toggler"   type="button"  data-bs-toggle="collapse"  data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div  class="collapse navbar-collapse"  id="navbarMenu">
            <ul class="navbar-nav ms-auto">
                <!-- HOME -->
                <li class="nav-item">
                    <a class="nav-link" href="/home"> Home </a>
                </li>

                <!-- PROFIL -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#"  data-bs-toggle="dropdown">  Profil  </a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="/sejarah"> Sejarah </a>
                        </li>
                        <li> <a class="dropdown-item" href="/visi">Visi Misi </a>  </li>
                        <li>  <a  class="dropdown-item"  href="/organisasi"> Struktur Organisasi </a> </li>
                    </ul>
                </li>

                <!-- PRODUK HUKUM -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">   Produk Hukum  </a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item"  href="/peraturan-daerah"> Peraturan Daerah</a></li>
                        <li>  <a class="dropdown-item" href="/peraturan-bupati"> Peraturan Bupati  </a> </li>
                        <li> <a class="dropdown-item"href="/keputusan-bupati"> Keputusan Bupati  </a> </li>
                    </ul>
                </li>

                <!-- INFORMASI -->
                <li class="nav-item dropdown">
                    <a  class="nav-link dropdown-toggle"   href="#"  data-bs-toggle="dropdown">  Informasi   </a>
                    <ul class="dropdown-menu">
                        <li>  <a class="dropdown-item" href="/berita"> Berita </a></li>
                            <li><a class="dropdown-item" href="/pengumuman"> Pengumuman </a> </li>
                    </ul>
                </li>

                <!-- KONTAK -->
                <li class="nav-item">

                    <a  class="nav-link"   href="/kontak"> Kontak  </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="container-fluid page-wrapper">
    <!-- =================================================
         BACK
    ================================================== -->
    <div class="back-button">
        <a   href="{{ route('user.peraturan-bupati') }}"  class="btn btn-outline-secondary btn-sm back-link">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali ke Peraturan Bupati
        </a>
    </div>

    <!-- =================================================
         MAIN CONTENT
    ================================================== -->
    <div class="row g-4">
        <!-- =================================================
             LEFT
        ================================================== -->
        <div class="col-lg-4 col-xl-4 left-column">
            <!-- =================================================
                 STATUS
            ================================================== -->
            <div class="info-card">
                <div class="card-title-custom">
                    Riwayat Status
                </div>

                <div class="status-box">
                    @if($peraturanBupati->status == 'BERLAKU')
                        <div class="status-alert alert alert-success">
                            <strong>Status:</strong>
                            <span class="badge bg-success ms-1">
                                BERLAKU
                            </span>
                        </div>

                    @else

                        <div class="status-alert alert alert-danger">
                            <strong>Status:</strong>
                            <span class="badge bg-danger ms-1">
                                TIDAK BERLAKU
                            </span>
                        </div>
                    @endif

                    <div class="status-info">
                        <i class="bi bi-info-circle me-1"></i>
                        Tidak ada riwayat hubungan peraturan
                        untuk dokumen ini.
                    </div>
                </div>
            </div>

            <!-- =================================================
                 METADATA
            ================================================== -->
            <div class="info-card">
                <div class="card-title-custom">  Metadata Dokumen  </div>
                <div class="metadata-wrapper">
                    <table class="metadata-table">
                        <!-- TIPE DOKUMEN -->
                        <tr>
                            <td>  Tipe Dokumen  </td>
                            <td>  {{ $peraturanBupati->tipe_dokumen ?? 'Peraturan Perundang-Undangan' }}  </td>
                        </tr>

                        <!-- JENIS -->
                        <tr>
                            <td> Jenis  </td>
                            <td>  {{ $peraturanBupati->jenis ?? 'Peraturan Bupati' }}  </td>
                        </tr>

                        <!-- JUDUL -->
                        <tr>
                            <td>  Judul </td>
                            <td>  {{ $peraturanBupati->judul }}   </td>
                        </tr>

                        <!-- TEU -->
                        <tr>
                            <td>  T.E.U Badan / Pengarang  </td>
                            <td>   {{ $peraturanBupati->teu_badan ?? '-' }}  </td>
                        </tr>

                        <!-- TANGGAL UPLOAD -->
                        <tr>
                            <td> Tanggal Upload </td>
                            <td>
                                @if($peraturanBupati->tanggal_upload)
                                    {{ $peraturanBupati->tanggal_upload->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        <!-- NOMOR -->
                        <tr>
                            <td> Nomor Peraturan </td>
                            <td> {{ $peraturanBupati->nomor_peraturan ?? '-' }}  </td>
                        </tr>

                        <!-- JENIS PERATURAN -->
                        <tr>
                            <td>  Jenis Peraturan   </td>
                            <td> {{ $peraturanBupati->jenis_peraturan ?? 'Peraturan Bupati' }}  </td>
                        </tr>

                        <!-- SINGKATAN -->
                        <tr>
                            <td>   Singkatan  </td>
                            <td> {{ $peraturanBupati->singkatan ?? 'PERBUP' }} </td>
                        </tr>

                        <!-- TEMPAT -->
                        <tr>
                            <td>  Tempat Penetapan  </td>
                            <td> {{ $peraturanBupati->tempat_penetapan ?? '-' }} </td>
                        </tr>

                        <!-- TAHUN -->
                        <tr>
                            <td>  Tahun </td>
                            <td> {{ $peraturanBupati->tahun ?? '-' }}  </td>
                        </tr>

                        <!-- TANGGAL PENETAPAN -->
                        <tr>
                            <td>  Tanggal Penetapan  </td>
                            <td>
                                @if($peraturanBupati->tanggal_penetapan)
                                    {{ $peraturanBupati->tanggal_penetapan->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        <!-- TANGGAL PENGUNDANGAN -->
                        <tr>
                            <td>  Tanggal Pengundangan  </td>
                            <td>
                                @if($peraturanBupati->tanggal_pengundangan)

                                    {{ $peraturanBupati->tanggal_pengundangan->translatedFormat('d F Y') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        <!-- SUMBER -->
                        <tr>
                            <td> Sumber </td>
                            <td>  {!! nl2br(e($peraturanBupati->sumber ?? '-')) !!} </td>
                        </tr>

                        <!-- SUBJEK -->
                        <tr>
                            <td>  Subjek  </td>
                            <td>  {!! nl2br(e($peraturanBupati->subjek ?? '-')) !!} </td>
                        </tr>

                        <!-- BAHASA -->
                        <tr>
                            <td>  Bahasa </td>
                            <td> {{ $peraturanBupati->bahasa ?? '-' }}  </td>
                        </tr>

                        <!-- LOKASI -->
                        <tr>
                            <td> Lokasi   </td>
                            <td>  {{ $peraturanBupati->lokasi ?? '-' }} </td>
                        </tr>

                        <!-- BIDANG HUKUM -->
                        <tr>
                            <td>  Bidang Hukum </td>
                            <td> {{ $peraturanBupati->bidang_hukum ?? '-' }}  </td>
                        </tr>

                        <!-- ABSTRAK -->
                        <tr>
                            <td>  Abstrak </td>
                            <td>
                                @if($peraturanBupati->abstrak)
                                    {!! nl2br(e($peraturanBupati->abstrak)) !!}
                                @else
                                    Tidak Ada
                                @endif
                            </td>
                        </tr>

                        <!-- ENGLISH VERSION -->
                        <tr>
                            <td> English Version </td>
                            <td>
                                @if($peraturanBupati->english_version)
                                    <a href="{{ asset('uploads/peraturan-bupati/english/' . $peraturanBupati->english_version) }}" target="_blank">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Lihat File
                                    </a>
                                @else
                                    Tidak Ada File
                                @endif
                            </td>
                        </tr>

                        <!-- BRAILLE -->
                        <tr>
                            <td> Braille  </td>
                            <td>
                                @if($peraturanBupati->braille)
                                    <a href="{{ asset('uploads/peraturan-bupati/braille/' . $peraturanBupati->braille) }}"  target="_blank">
                                        <i class="bi bi-file-earmark-text me-1"></i>
                                        Lihat File
                                    </a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                        </tr>

                        <!-- ALIH SUARA -->
                        <tr>
                            <td>  Alih Suara </td>
                            <td>
                                @if($peraturanBupati->alih_suara)

                                    <a href="{{ asset('uploads/peraturan-bupati/audio/' . $peraturanBupati->alih_suara) }}"  target="_blank">
                                        <i class="bi bi-volume-up me-1"></i>
                                        Dengarkan
                                    </a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- =================================================
             RIGHT - PDF
        ================================================== -->
        <div class="col-lg-8 col-xl-8">
            <div class="pdf-card">
                <!-- PDF TOOLBAR -->
                <div class="pdf-toolbar">
                    @if($peraturanBupati->file_dokumen)
                        <!-- OPEN -->
                        <a  href="{{ asset('uploads/peraturan-bupati/' . $peraturanBupati->file_dokumen) }}"  target="_blank" title="Buka PDF">
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>

                        <!-- DOWNLOAD -->
                        <a  href="{{ asset('uploads/peraturan-bupati/' . $peraturanBupati->file_dokumen) }}"  download title="Download">
                            <i class="bi bi-download"></i>
                        </a>


                        <!-- PRINT -->
                        <a href="{{ asset('uploads/peraturan-bupati/' . $peraturanBupati->file_dokumen) }}" target="_blank" title="Cetak PDF">
                            <i class="bi bi-printer"></i>
                        </a>
                    @endif
                </div>

                <!-- PDF VIEWER -->
                @if($peraturanBupati->file_dokumen)
                    <iframe
                        src="{{ asset('uploads/peraturan-bupati/' . $peraturanBupati->file_dokumen) }}"
                        class="pdf-viewer"
                        title="Dokumen Peraturan Bupati">
                    </iframe>
                @else

                    <div class="empty-pdf">
                        <div>
                            <i class="bi bi-file-earmark-x"  style="font-size: 60px;">  </i>
                            <h5 class="mt-3"> Dokumen PDF Tidak Tersedia  </h5>
                            <p class="mb-0"> File Peraturan Bupati belum tersedia. </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- =====================================================
     FOOTER
==================================================== -->
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
<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>

<!-- =====================================================
     NAVBAR SCROLL
===================================================== -->
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