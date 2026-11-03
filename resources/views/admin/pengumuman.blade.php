<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Pengumuman - Admin JDIH</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial, Helvetica, sans-serif;
            color: #212529;
        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #212529;
            color: white;
            z-index: 1000;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sidebar-brand i {
            font-size: 20px;
            margin-right: 10px;
        }

        .sidebar-brand h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar-brand small {
            display: block;
            margin-top: 2px;
            color: #adb5bd;
            font-size: 11px;
        }

        .sidebar-menu {
            padding: 18px 12px;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: #495057;
            border-radius: 10px;
        }

        .menu-title {
            margin: 12px 10px 8px;
            color: #6c757d;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 13px;
            margin-bottom: 4px;
            color: #adb5bd;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar-menu a i {
            width: 20px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-menu a:hover {
            background: #343a40;
            color: #fff;
        }

        .sidebar-menu a.active {
            background: #0d6efd;
            color: #fff;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .logout-area {
            position: absolute;
            left: 12px;
            right: 12px;
            bottom: 20px;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 25px 30px;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 12px 20px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
        }

        .topbar-title {
            font-size: 16px;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e7f1ff;
            color: #0d6efd;
            font-weight: 700;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {
            margin-bottom: 20px;
        }

        .page-header h2 {
            margin: 0 0 5px;
            font-size: 25px;
            font-weight: 700;
        }

        .page-header p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }


        /* =====================================================
           CONTENT CARD
        ===================================================== */

        .content-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            overflow: hidden;
        }


        /* =====================================================
           CARD HEADER
        ===================================================== */

        .card-header-custom {
            padding: 18px 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .card-header-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .card-header-subtitle {
            color: #6c757d;
            font-size: 12px;
            margin-top: 3px;
        }

        .btn-add {
            border-radius: 8px;
            padding: 9px 15px;
            font-size: 13px;
        }


        /* =====================================================
           SEARCH
        ===================================================== */

        .search-wrapper {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .search-box {
            max-width: 500px;
        }

        .search-box .form-control {
            height: 40px;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table {
            margin-bottom: 0;
        }

        .table th {
            background: #f8fafc;
            color: #495057;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            border-bottom: 1px solid #dee2e6;
            padding: 13px 12px;
        }

        .table td {
            vertical-align: middle;
            font-size: 13px;
            padding: 13px 12px;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        .judul-pengumuman {
            font-weight: 600;
            color: #212529;
            max-width: 350px;
            line-height: 1.5;
        }

        .isi-pengumuman {
            color: #6c757d;
            max-width: 400px;
            line-height: 1.5;
        }

        .tanggal-upload {
            white-space: nowrap;
            color: #495057;
        }


        /* =====================================================
           PDF BUTTON
        ===================================================== */

        .pdf-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dc3545;
            color: #fff;
            text-decoration: none;
            padding: 7px 11px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
        }

        .pdf-btn:hover {
            background: #bb2d3b;
            color: #fff;
        }


        /* =====================================================
           ACTION BUTTON
        ===================================================== */

        .action-btn {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
        }


        /* =====================================================
           EMPTY DATA
        ===================================================== */

        .empty-data {
            padding: 60px 20px;
            text-align: center;
            color: #6c757d;
        }

        .empty-data i {
            font-size: 45px;
            color: #adb5bd;
            margin-bottom: 12px;
        }

        .empty-data h6 {
            color: #343a40;
            font-weight: 600;
        }


        /* =====================================================
           PAGINATION
        ===================================================== */

        .pagination-wrapper {
            padding: 14px 20px;
            border-top: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            min-height: 60px;
        }

        .pagination-wrapper nav {
            margin: 0 !important;
            padding: 0 !important;
            width: auto !important;
        }

        .pagination {
            margin: 0 !important;
            padding: 0 !important;
            display: flex !important;
            flex-wrap: nowrap !important;
            align-items: center;
            justify-content: flex-end;
            gap: 4px;
        }

        .pagination .page-item {
            margin: 0 !important;
            padding: 0 !important;
        }

        .pagination .page-link {
            width: 32px;
            min-width: 32px;
            height: 32px;
            padding: 0 !important;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6 !important;
            border-radius: 6px !important;
            background: #fff;
            color: #495057;
            font-size: 12px;
            font-weight: 500;
            line-height: 1;
            box-shadow: none !important;
        }

        .pagination .page-link:hover {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #0d6efd !important;
        }

        .pagination .page-item.active .page-link {
            background: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #fff !important;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            background: #f8f9fa !important;
            border-color: #e9ecef !important;
            color: #adb5bd !important;
        }

        .pagination svg {
            width: 14px !important;
            height: 14px !important;
            display: block;
        }

        .pagination-wrapper .small {
            display: none !important;
        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal-lg {
            max-width: 850px;
        }

        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: #f8fafc;
            padding: 18px 24px;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-header .modal-title {
            font-size: 17px;
            font-weight: 700;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            padding: 15px 25px;
            border-top: 1px solid #e5e7eb;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-section-title {
            font-size: 15px;
            font-weight: 600;
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            color: #0d6efd;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
        }

        .form-control {
            font-size: 14px;
            border-radius: 7px;
            border-color: #d1d5db;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 160px;
        }


        /* =====================================================
           CURRENT FILE
        ===================================================== */

        .current-file {
            margin-top: 8px;
            padding: 8px 10px;
            background: #f8fafc;
            border-radius: 6px;
            font-size: 12px;
            color: #6c757d;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 992px) {

            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
            }

        }


        @media (max-width: 768px) {

            .sidebar {
                width: 70px;
            }

            .sidebar-brand {
                justify-content: center;
                padding: 0;
            }

            .sidebar-brand div {
                display: none;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 12px;
            }

            .sidebar-menu a span {
                display: none;
            }

            .menu-title {
                display: none;
            }

            .logout-area {
                left: 8px;
                right: 8px;
            }

            .logout-area button {
                font-size: 0;
            }

            .logout-area i {
                font-size: 16px;
            }

            .content {
                margin-left: 70px;
                padding: 18px;
            }

            .topbar-title {
                display: none;
            }

            .user-info span {
                display: none;
            }

            .card-header-custom {
                align-items: flex-start;
                flex-direction: column;
            }

            .pagination-wrapper {
                justify-content: center;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar">


        <!-- BRAND -->

        <div class="sidebar-brand">

            <i class="bi bi-bank"></i>

            <div>

                <h5>
                    Admin JDIH
                </h5>

                <small>
                    Kabupaten Toba
                </small>

            </div>

        </div>


        <!-- MENU -->

        <div class="sidebar-menu">


            <div class="menu-title">
                Menu Utama
            </div>


            <!-- DASHBOARD -->

            <a href="{{ route('admin.dashboard') }}">

                <i class="bi bi-grid-1x2"></i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- PERATURAN DAERAH -->

            <a href="{{ route('admin.peraturan-daerah') }}">

                <i class="bi bi-file-earmark-ruled"></i>

                <span>
                    Peraturan Daerah
                </span>

            </a>


            <!-- PERATURAN BUPATI -->

            <a href="{{ route('admin.peraturan-bupati.index') }}">

                <i class="bi bi-file-earmark-richtext"></i>

                <span>
                    Peraturan Bupati
                </span>

            </a>


            <!-- KEPUTUSAN BUPATI -->

            <a href="{{ route('admin.keputusan-bupati') }}">

                <i class="bi bi-file-earmark-check"></i>

                <span>
                    Keputusan Bupati
                </span>

            </a>


            <!-- CAROUSEL -->

            <a href="{{ route('admin.carousel') }}">

                <i class="bi bi-images"></i>

                <span>
                    Carousel
                </span>

            </a>


            <!-- VISI MISI -->

            <a href="{{ route('admin.visi') }}">

                <i class="bi bi-bullseye"></i>

                <span>
                    Visi & Misi
                </span>

            </a>


            <!-- STRUKTUR -->

            <a href="{{ route('admin.struktur') }}">

                <i class="bi bi-diagram-3"></i>

                <span>
                    Struktur Organisasi
                </span>

            </a>


            <!-- BERITA -->

            <a href="{{ route('admin.berita') }}">

                <i class="bi bi-newspaper"></i>

                <span>
                    Berita
                </span>

            </a>


            <!-- PENGUMUMAN -->

            <a
                href="{{ route('admin.pengumuman.index') }}"
                class="active">

                <i class="bi bi-megaphone"></i>

                <span>
                    Pengumuman
                </span>

            </a>


        </div>


        <!-- LOGOUT -->

        <div class="logout-area">

            <form
                method="POST"
                action="/logout">

                @csrf

                <button
                    type="submit"
                    class="btn btn-danger w-100">

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Logout

                </button>

            </form>

        </div>

    </aside>



    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <main class="content">


        <!-- TOPBAR -->

        <div class="topbar">

            <div class="topbar-title">
                Pengumuman
            </div>


            <div class="user-info">

                <div class="user-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

                <span>
                    {{ auth()->user()->name }}
                </span>

            </div>

        </div>



        <!-- PAGE HEADER -->

        <div class="page-header">

            <h2>
                Pengumuman
            </h2>

            <p>
                Kelola pengumuman JDIH Kabupaten Toba.
            </p>

        </div>



        <!-- ALERT SUCCESS -->

        @if(session('success'))

            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif



        <!-- ALERT ERROR -->

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>

                    <i class="bi bi-exclamation-triangle me-1"></i>

                    Terjadi kesalahan:

                </strong>


                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif



        <!-- =====================================================
             CONTENT CARD
        ====================================================== -->

        <div class="content-card">


            <!-- CARD HEADER -->

            <div class="card-header-custom">

                <div>

                    <h5 class="card-header-title">

                        <i class="bi bi-megaphone me-2 text-primary"></i>

                        Data Pengumuman

                    </h5>


                    <div class="card-header-subtitle">

                        Daftar pengumuman JDIH Kabupaten Toba

                    </div>

                </div>


                <!-- TAMBAH -->

                <button
                    type="button"
                    class="btn btn-primary btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#tambahModal">

                    <i class="bi bi-plus-lg me-1"></i>

                    Tambah Pengumuman

                </button>

            </div>



            <!-- =====================================================
                 SEARCH
            ====================================================== -->

            <div class="search-wrapper">

                <form
                    action="{{ route('admin.pengumuman.index') }}"
                    method="GET"
                    class="search-box">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari judul atau isi pengumuman...">


                        <button
                            type="submit"
                            class="btn btn-outline-primary">

                            <i class="bi bi-search"></i>

                        </button>


                        @if(request('search'))

                            <a
                                href="{{ route('admin.pengumuman.index') }}"
                                class="btn btn-outline-secondary">

                                <i class="bi bi-x-lg"></i>

                            </a>

                        @endif

                    </div>

                </form>

            </div>



            <!-- =====================================================
                 TABLE
            ====================================================== -->

            <div class="table-responsive">

                <table class="table table-hover">


                    <thead>

                        <tr>

                            <th class="px-3">
                                No
                            </th>

                            <th>
                                Judul Pengumuman
                            </th>

                            <th>
                                Isi
                            </th>

                            <th>
                                Tanggal Upload
                            </th>

                            <th>
                                File PDF
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        @forelse($pengumumans as $pengumuman)


                            <tr>


                                <!-- NO -->

                                <td class="px-3">

                                    {{ $pengumumans->firstItem() + $loop->index }}

                                </td>



                                <!-- JUDUL -->

                                <td>

                                    <div class="judul-pengumuman">

                                        {{ $pengumuman->judul }}

                                    </div>

                                </td>



                                <!-- ISI -->

                                <td>

                                    <div class="isi-pengumuman">

                                        {{ \Illuminate\Support\Str::limit(
                                            strip_tags($pengumuman->isi),
                                            120
                                        ) }}

                                    </div>

                                </td>



                                <!-- TANGGAL -->

                                <td>

                                    <div class="tanggal-upload">

                                        @if($pengumuman->tanggal_upload)

                                            {{ \Carbon\Carbon::parse(
                                                $pengumuman->tanggal_upload
                                            )->format('d-m-Y') }}

                                        @else

                                            -

                                        @endif

                                    </div>

                                </td>



                                <!-- FILE PDF -->

                                <td>

                                    @if($pengumuman->file_pdf)

                                        <a
                                            href="{{ asset(
                                                'uploads/pengumuman/' .
                                                $pengumuman->file_pdf
                                            ) }}"
                                            target="_blank"
                                            class="pdf-btn">

                                            <i class="bi bi-file-earmark-pdf-fill"></i>

                                            Lihat PDF

                                        </a>

                                    @else

                                        <span class="text-muted">

                                            Tidak ada file

                                        </span>

                                    @endif

                                </td>



                                <!-- AKSI -->

                                <td class="text-center">


                                    <!-- EDIT -->

                                    <button
                                        type="button"
                                        class="btn btn-warning btn-sm action-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $pengumuman->id }}"
                                        title="Edit">

                                        <i class="bi bi-pencil-square"></i>

                                    </button>



                                    <!-- DELETE -->

                                    <form
                                        action="{{ route(
                                            'admin.pengumuman.destroy',
                                            $pengumuman->id
                                        ) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm(
                                            'Yakin ingin menghapus pengumuman ini?'
                                        )">

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm action-btn"
                                            title="Hapus">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>


                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td
                                    colspan="6"
                                    class="p-0">

                                    <div class="empty-data">

                                        <i class="bi bi-megaphone d-block"></i>


                                        <h6>
                                            Belum Ada Pengumuman
                                        </h6>


                                        <p class="mb-0">

                                            Silakan tambahkan pengumuman
                                            menggunakan tombol di atas.

                                        </p>

                                    </div>

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>



            <!-- =====================================================
                 PAGINATION
            ====================================================== -->

            @if($pengumumans->hasPages())

                <div class="pagination-wrapper">

                    {{ $pengumumans
                        ->withQueryString()
                        ->links('pagination::bootstrap-5') }}

                </div>

            @endif


        </div>


    </main>



    <!-- =====================================================
         MODAL TAMBAH
    ====================================================== -->

    <div
        class="modal fade"
        id="tambahModal"
        tabindex="-1"
        aria-labelledby="tambahModalLabel"
        aria-hidden="true">


        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">


                <!-- HEADER -->

                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="tambahModalLabel">

                            <i class="bi bi-megaphone-fill me-2 text-primary"></i>

                            Tambah Pengumuman

                        </h5>


                        <small class="text-muted">

                            Tambahkan pengumuman baru JDIH Kabupaten Toba

                        </small>

                    </div>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>



                <!-- FORM -->

                <form
                    action="{{ route('admin.pengumuman.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf


                    <div class="modal-body">


                        <!-- INFORMASI -->

                        <div class="form-section">


                            <div class="form-section-title">

                                <i class="bi bi-info-circle"></i>

                                Informasi Pengumuman

                            </div>


                            <!-- JUDUL -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Judul Pengumuman

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>


                                <input
                                    type="text"
                                    name="judul"
                                    class="form-control"
                                    value="{{ old('judul') }}"
                                    placeholder="Masukkan judul pengumuman..."
                                    required>

                            </div>



                            <!-- ISI -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Isi Pengumuman

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>


                                <textarea
                                    name="isi"
                                    class="form-control"
                                    rows="7"
                                    placeholder="Masukkan isi pengumuman..."
                                    required>{{ old('isi') }}</textarea>

                            </div>



                            <!-- TANGGAL -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Tanggal Upload

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>


                                <input
                                    type="date"
                                    name="tanggal_upload"
                                    class="form-control"
                                    value="{{ old(
                                        'tanggal_upload',
                                        date('Y-m-d')
                                    ) }}"
                                    required>


                                <small class="text-muted">

                                    Tanggal pengumuman diunggah ke sistem.

                                </small>

                            </div>


                        </div>



                        <!-- FILE -->

                        <div class="form-section mt-4">


                            <div class="form-section-title">

                                <i class="bi bi-file-earmark-pdf"></i>

                                File Pengumuman

                            </div>


                            <div class="mb-3">


                                <label class="form-label">

                                    File PDF

                                </label>


                                <input
                                    type="file"
                                    name="file_pdf"
                                    class="form-control"
                                    accept=".pdf,application/pdf">


                                <small class="text-muted">

                                    Format PDF, maksimal 10 MB.

                                </small>

                            </div>


                        </div>



                        <!-- INFO BOX -->

                        <div class="alert alert-info mb-0">

                            <i class="bi bi-info-circle me-2"></i>

                            Pastikan judul dan isi pengumuman
                            sudah benar sebelum disimpan.

                        </div>


                    </div>



                    <!-- FOOTER -->

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-check-lg me-1"></i>

                            Simpan Pengumuman

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>



    <!-- =====================================================
         MODAL EDIT
    ====================================================== -->

    @foreach($pengumumans as $pengumuman)


        <div
            class="modal fade"
            id="editModal{{ $pengumuman->id }}"
            tabindex="-1"
            aria-labelledby="editModalLabel{{ $pengumuman->id }}"
            aria-hidden="true">


            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content">


                    <!-- HEADER -->

                    <div class="modal-header">

                        <div>

                            <h5
                                class="modal-title"
                                id="editModalLabel{{ $pengumuman->id }}">

                                <i class="bi bi-pencil-square me-2 text-primary"></i>

                                Edit Pengumuman

                            </h5>


                            <small class="text-muted">

                                Ubah informasi pengumuman

                            </small>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>



                    <!-- FORM -->

                    <form
                        action="{{ route(
                            'admin.pengumuman.update',
                            $pengumuman->id
                        ) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @method('PUT')


                        <div class="modal-body">


                            <!-- INFORMASI -->

                            <div class="form-section">


                                <div class="form-section-title">

                                    <i class="bi bi-info-circle"></i>

                                    Informasi Pengumuman

                                </div>


                                <!-- JUDUL -->

                                <div class="mb-3">

                                    <label class="form-label">

                                        Judul Pengumuman

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        name="judul"
                                        class="form-control"
                                        value="{{ $pengumuman->judul }}"
                                        required>

                                </div>



                                <!-- ISI -->

                                <div class="mb-3">

                                    <label class="form-label">

                                        Isi Pengumuman

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <textarea
                                        name="isi"
                                        class="form-control"
                                        rows="8"
                                        required>{{ $pengumuman->isi }}</textarea>

                                </div>



                                <!-- TANGGAL -->

                                <div class="mb-3">

                                    <label class="form-label">

                                        Tanggal Upload

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="date"
                                        name="tanggal_upload"
                                        class="form-control"
                                        value="{{ $pengumuman->tanggal_upload
                                            ? \Carbon\Carbon::parse(
                                                $pengumuman->tanggal_upload
                                            )->format('Y-m-d')
                                            : '' }}"
                                        required>

                                </div>


                            </div>



                            <!-- FILE -->

                            <div class="form-section mt-4">


                                <div class="form-section-title">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                    File Pengumuman

                                </div>


                                @if($pengumuman->file_pdf)


                                    <div class="current-file mb-3">

                                        <i class="bi bi-file-earmark-pdf me-1 text-danger"></i>

                                        File saat ini:

                                        <strong>

                                            {{ $pengumuman->file_pdf }}

                                        </strong>


                                        <a
                                            href="{{ asset(
                                                'uploads/pengumuman/' .
                                                $pengumuman->file_pdf
                                            ) }}"
                                            target="_blank"
                                            class="ms-2">

                                            Lihat File

                                        </a>

                                    </div>

                                @endif



                                <div class="mb-3">

                                    <label class="form-label">

                                        Ganti File PDF

                                    </label>


                                    <input
                                        type="file"
                                        name="file_pdf"
                                        class="form-control"
                                        accept=".pdf,application/pdf">


                                    <small class="text-muted">

                                        Kosongkan jika tidak ingin
                                        mengganti file.
                                        Maksimal 10 MB.

                                    </small>

                                </div>


                            </div>


                        </div>



                        <!-- FOOTER -->

                        <div class="modal-footer">


                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Batal

                            </button>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-save me-1"></i>

                                Simpan Perubahan

                            </button>


                        </div>


                    </form>

                </div>

            </div>

        </div>


    @endforeach



    <!-- =====================================================
         BOOTSTRAP JS
    ====================================================== -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>