<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Struktur Organisasi - Admin JDIH</title>

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


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #212529;
            color: #fff;
            z-index: 1000;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
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

        .logout-area {
            position: absolute;
            left: 12px;
            right: 12px;
            bottom: 20px;
        }

        .logout-area button {
            font-size: 14px;
        }


        /* =========================================
           MAIN CONTENT
        ========================================= */

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 25px 30px;
        }


        /* =========================================
           TOPBAR
        ========================================= */

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


        /* =========================================
           PAGE HEADER
        ========================================= */

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .page-title h2 {
            margin: 0 0 5px;
            font-size: 25px;
            font-weight: 700;
        }

        .page-title p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }

        .btn-add {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }


        /* =========================================
           ALERT
        ========================================= */

        .alert {
            border: none;
            border-radius: 9px;
            font-size: 14px;
        }


        /* =========================================
           TABLE CARD
        ========================================= */

        .table-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
        }

        .table-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f3;
        }

        .table-card-header h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .table-card-header span {
            color: #6c757d;
            font-size: 13px;
        }

        .table {
            margin: 0;
        }

        .table thead th {
            padding: 14px 16px;
            background: #f8f9fb;
            color: #6c757d;
            border-bottom: 1px solid #e9ecef;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f1f3;
            font-size: 14px;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }


        /* =========================================
           FOTO
        ========================================= */

        .foto-wrapper {
            width: 48px;
            height: 48px;
        }

        .foto-struktur {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e1e5eb;
        }

        .foto-default {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f0f2f5;
            color: #8a9199;
            font-size: 20px;
        }


        /* =========================================
           DATA TEXT
        ========================================= */

        .nama {
            font-weight: 600;
            color: #212529;
        }

        .jabatan {
            color: #495057;
        }

        .atasan-name {
            color: #212529;
            font-weight: 500;
        }

        .atasan-jabatan {
            margin-top: 2px;
            color: #8a9199;
            font-size: 12px;
        }


        /* =========================================
           BADGE
        ========================================= */

        .badge-tingkat {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #e8f1ff;
            color: #0d6efd;
            font-size: 11px;
            font-weight: 600;
        }

        .urutan {
            color: #6c757d;
            font-weight: 600;
        }


        /* =========================================
           ACTION BUTTON
        ========================================= */

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 7px;
        }


        /* =========================================
           PAGINATION
        ========================================= */

        .pagination-wrapper {
            padding: 18px 20px;
            border-top: 1px solid #edf0f3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .pagination-info {
            color: #6c757d;
            font-size: 13px;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            margin: 0 2px;
            border: 1px solid #dee2e6;
            color: #495057;
            font-size: 13px;
        }

        .pagination .page-item.active .page-link {
            background: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #f8f9fa;
        }

        .pagination .page-link:hover {
            background: #e9f2ff;
            color: #0d6efd;
        }


        /* =========================================
           EMPTY DATA
        ========================================= */

        .empty-data {
            padding: 70px 20px !important;
            text-align: center;
            color: #6c757d;
        }

        .empty-data i {
            font-size: 45px;
            color: #adb5bd;
        }

        .empty-data h5 {
            margin-top: 15px;
            color: #343a40;
            font-weight: 600;
        }


        /* =========================================
           MODAL
        ========================================= */

        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .12);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid #edf0f3;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
        }

        .modal-subtitle {
            display: block;
            margin-top: 3px;
            color: #8a9199;
            font-size: 12px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 15px 24px;
            border-top: 1px solid #edf0f3;
        }

        .form-label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border-radius: 8px;
            border-color: #dfe3e8;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .10);
        }

        .form-text {
            font-size: 11px;
            color: #8a9199;
        }

        .current-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }


        /* =========================================
           DELETE MODAL
        ========================================= */

        .delete-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff0f0;
            color: #dc3545;
            font-size: 27px;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 992px) {

            .sidebar {
                width: 210px;
            }

            .main-content {
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

            .main-content {
                margin-left: 70px;
                padding: 18px;
            }

            .page-header {
                align-items: flex-start;
                gap: 15px;
            }

            .page-title h2 {
                font-size: 21px;
            }

            .topbar-title {
                display: none;
            }

            .user-info span {
                display: none;
            }

            .pagination-wrapper {
                justify-content: center;
            }

            .pagination-info {
                width: 100%;
                text-align: center;
            }
        }

    </style>

</head>


<body>


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside class="sidebar">

        <div class="sidebar-brand">

            <i class="bi bi-bank me-2 fs-5"></i>

            <div>

                <h5>Admin JDIH</h5>

                <small>Kabupaten Toba</small>

            </div>

        </div>


        <div class="sidebar-menu">

            <div class="menu-title">
                Menu Utama
            </div>


            <a href="/admin">

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

            <a href="/admin/carousel">

                <i class="bi bi-images"></i>

                <span>
                    Carousel
                </span>

            </a>


            <!-- VISI MISI -->

            <a href="/admin/visi">

                <i class="bi bi-bullseye"></i>

                <span>
                    Visi & Misi
                </span>

            </a>


            <!-- STRUKTUR -->

            <a href="/admin/struktur" class="active">

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

            <a href="{{ route('admin.pengumuman.index') }}">

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

                <button class="btn btn-danger w-100">

                    <i class="bi bi-box-arrow-right me-2"></i>

                    Logout

                </button>

            </form>

        </div>

    </aside>


    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->

    <main class="main-content">


        <!-- TOPBAR -->

        <div class="topbar">

            <div class="topbar-title">
                Struktur Organisasi
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

            <div class="page-title">

                <h2>
                    Struktur Organisasi
                </h2>

                <p>
                    Kelola susunan jabatan dan struktur organisasi JDIH.
                </p>

            </div>


            <button
                type="button"
                class="btn btn-primary btn-add"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

                <i class="bi bi-plus-lg me-1"></i>

                Tambah Struktur

            </button>

        </div>


        <!-- =====================================================
             ALERT SUCCESS
        ====================================================== -->

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


        <!-- =====================================================
             ALERT ERROR
        ====================================================== -->

        @if($errors->any())

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert">

            <strong>
                Data belum dapat disimpan.
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        @endif


        <!-- =====================================================
             TABLE
        ====================================================== -->

        <div class="table-card">


            <!-- TABLE HEADER -->

            <div class="table-card-header">

                <div>

                    <h5>
                        Data Struktur
                    </h5>

                    <span>
                        Daftar jabatan dalam struktur organisasi
                    </span>

                </div>


                <!-- TOTAL DATA -->

                <span>
                    {{ $struktur->total() }} data
                </span>

            </div>


            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th width="80">
                                Foto
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Jabatan
                            </th>

                            <th>
                                Tingkat
                            </th>

                            <th>
                                Atasan
                            </th>

                            <th width="80">
                                Urutan
                            </th>

                            <th width="110">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse($struktur as $item)

                        <tr>


                            <!-- NO -->

                            <td>

                                {{ $struktur->firstItem() + $loop->index }}

                            </td>


                            <!-- FOTO -->

                            <td>

                                @if($item->foto)

                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="foto-struktur">

                                @else

                                <div class="foto-default">

                                    <i class="bi bi-person"></i>

                                </div>

                                @endif

                            </td>


                            <!-- NAMA -->

                            <td>

                                <div class="nama">

                                    {{ $item->nama }}

                                </div>

                            </td>


                            <!-- JABATAN -->

                            <td>

                                <div class="jabatan">

                                    {{ $item->jabatan }}

                                </div>

                            </td>


                            <!-- TINGKAT -->

                            <td>

                                <span class="badge-tingkat">

                                    Tingkat {{ $item->tingkat }}

                                </span>

                            </td>


                            <!-- ATASAN -->

                            <td>

                                @if($item->parent)

                                <div class="atasan-name">

                                    {{ $item->parent->nama }}

                                </div>

                                <div class="atasan-jabatan">

                                    {{ $item->parent->jabatan }}

                                </div>

                                @else

                                <span class="text-muted">

                                    Pimpinan Utama

                                </span>

                                @endif

                            </td>


                            <!-- URUTAN -->

                            <td>

                                <span class="urutan">

                                    {{ $item->urutan }}

                                </span>

                            </td>


                            <!-- AKSI -->

                            <td>

                                <div class="action-buttons">


                                    <!-- EDIT -->

                                    <button
                                        type="button"
                                        class="btn btn-warning btn-action text-white"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}"
                                        title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </button>


                                    <!-- DELETE -->

                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-action"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalHapus{{ $item->id }}"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                    </button>


                                </div>

                            </td>

                        </tr>


                        @empty


                        <tr>

                            <td
                                colspan="8"
                                class="empty-data">

                                <i class="bi bi-diagram-3"></i>

                                <h5>
                                    Belum Ada Data
                                </h5>

                                <p>
                                    Belum ada struktur organisasi yang ditambahkan.
                                </p>

                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalTambah">

                                    <i class="bi bi-plus-lg me-1"></i>

                                    Tambah Struktur

                                </button>

                            </td>

                        </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>


            <!-- =====================================================
                 PAGINATION
            ====================================================== -->

            @if($struktur->hasPages())

            <div class="pagination-wrapper">


                <!-- INFO -->

                <div class="pagination-info">

                    Menampilkan

                    <strong>
                        {{ $struktur->firstItem() }}
                    </strong>

                    sampai

                    <strong>
                        {{ $struktur->lastItem() }}
                    </strong>

                    dari

                    <strong>
                        {{ $struktur->total() }}
                    </strong>

                    data

                </div>


                <!-- PAGINATION -->

                <div>

                    {{ $struktur->links('pagination::bootstrap-5') }}

                </div>


            </div>

            @endif


        </div>


    </main>


    <!-- =====================================================
         MODAL TAMBAH
    ====================================================== -->

    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <form
                    action="{{ route('admin.struktur.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf


                    <div class="modal-header">

                        <div>

                            <div class="modal-title">
                                Tambah Struktur Organisasi
                            </div>

                            <span class="modal-subtitle">
                                Tambahkan jabatan baru ke dalam struktur organisasi.
                            </span>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>


                    <div class="modal-body">

                        <div class="row g-3">


                            <!-- NAMA -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nama

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    placeholder="Masukkan nama"
                                    required>

                            </div>


                            <!-- JABATAN -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Jabatan

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="jabatan"
                                    class="form-control"
                                    placeholder="Contoh: Kepala Dinas"
                                    required>

                            </div>


                            <!-- TINGKAT -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Tingkat

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <select
                                    name="tingkat"
                                    class="form-select"
                                    required>

                                    <option value="">
                                        Pilih tingkat
                                    </option>

                                    @for($i = 1; $i <= 10; $i++)

                                    <option value="{{ $i }}">

                                        Tingkat {{ $i }}

                                    </option>

                                    @endfor

                                </select>


                                <div class="form-text">

                                    Tingkat 1 adalah pimpinan tertinggi.

                                </div>

                            </div>


                            <!-- ATASAN -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Atasan

                                </label>

                                <select
                                    name="parent_id"
                                    class="form-select">

                                    <option value="">

                                        Tidak ada / Pimpinan Utama

                                    </option>

                                    @foreach($struktur as $parent)

                                    <option value="{{ $parent->id }}">

                                        Tingkat {{ $parent->tingkat }}

                                        -

                                        {{ $parent->jabatan }}

                                        -

                                        {{ $parent->nama }}

                                    </option>

                                    @endforeach

                                </select>


                                <div class="form-text">

                                    Pilih jabatan yang menjadi atasan.

                                </div>

                            </div>


                            <!-- URUTAN -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Urutan

                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control"
                                    value="0"
                                    min="0">

                                <div class="form-text">

                                    Menentukan posisi tampilan.

                                </div>

                            </div>


                            <!-- FOTO -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Foto

                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp">

                                <div class="form-text">

                                    JPG, PNG, atau WEBP. Maksimal 2 MB.

                                </div>

                            </div>


                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-save me-1"></i>

                            Simpan

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    <!-- =====================================================
         MODAL EDIT & DELETE
    ====================================================== -->

    @foreach($struktur as $item)


    <!-- =========================
         MODAL EDIT
    ========================== -->

    <div
        class="modal fade"
        id="modalEdit{{ $item->id }}"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <form
                    action="{{ route('admin.struktur.update', $item->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    @method('PUT')


                    <div class="modal-header">

                        <div>

                            <div class="modal-title">

                                Edit Struktur Organisasi

                            </div>

                            <span class="modal-subtitle">

                                Perbarui informasi jabatan.

                            </span>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>


                    <div class="modal-body">

                        <div class="row g-3">


                            <!-- NAMA -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nama

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    value="{{ $item->nama }}"
                                    required>

                            </div>


                            <!-- JABATAN -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Jabatan

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    name="jabatan"
                                    class="form-control"
                                    value="{{ $item->jabatan }}"
                                    required>

                            </div>


                            <!-- TINGKAT -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Tingkat

                                    <span class="text-danger">
                                        *
                                    </span>

                                </label>

                                <select
                                    name="tingkat"
                                    class="form-select"
                                    required>

                                    @for($i = 1; $i <= 10; $i++)

                                    <option
                                        value="{{ $i }}"
                                        {{ $item->tingkat == $i ? 'selected' : '' }}>

                                        Tingkat {{ $i }}

                                    </option>

                                    @endfor

                                </select>

                            </div>


                            <!-- ATASAN -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Atasan

                                </label>

                                <select
                                    name="parent_id"
                                    class="form-select">

                                    <option value="">

                                        Tidak ada / Pimpinan Utama

                                    </option>


                                    @foreach($struktur as $parent)

                                    @if($parent->id != $item->id)

                                    <option
                                        value="{{ $parent->id }}"
                                        {{ $item->parent_id == $parent->id ? 'selected' : '' }}>

                                        Tingkat {{ $parent->tingkat }}

                                        -

                                        {{ $parent->jabatan }}

                                        -

                                        {{ $parent->nama }}

                                    </option>

                                    @endif

                                    @endforeach

                                </select>

                            </div>


                            <!-- URUTAN -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Urutan

                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control"
                                    value="{{ $item->urutan }}"
                                    min="0">

                            </div>


                            <!-- FOTO -->

                            <div class="col-md-6">

                                <label class="form-label">

                                    Ganti Foto

                                </label>

                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control"
                                    accept="image/jpeg,image/png,image/webp">

                                <div class="form-text">

                                    Kosongkan jika tidak ingin mengganti foto.

                                </div>

                            </div>


                            <!-- FOTO SAAT INI -->

                            @if($item->foto)

                            <div class="col-12">

                                <label class="form-label d-block">

                                    Foto Saat Ini

                                </label>

                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    class="current-photo">

                            </div>

                            @endif


                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-check-lg me-1"></i>

                            Simpan Perubahan

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    <!-- =========================
         MODAL DELETE
    ========================== -->

    <div
        class="modal fade"
        id="modalHapus{{ $item->id }}"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form
                    action="{{ route('admin.struktur.destroy', $item->id) }}"
                    method="POST">

                    @csrf

                    @method('DELETE')


                    <div class="modal-header">

                        <div>

                            <div class="modal-title">

                                Hapus Struktur

                            </div>

                            <span class="modal-subtitle">

                                Data yang dihapus tidak dapat dikembalikan.

                            </span>

                        </div>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                        </button>

                    </div>


                    <div class="modal-body text-center py-4">

                        <div class="delete-icon">

                            <i class="bi bi-trash"></i>

                        </div>


                        <h5 class="fw-bold">

                            Hapus data ini?

                        </h5>


                        <p class="text-muted mb-0">

                            <strong>
                                {{ $item->nama }}
                            </strong>

                            <br>

                            {{ $item->jabatan }}

                        </p>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-danger">

                            <i class="bi bi-trash me-1"></i>

                            Ya, Hapus

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>


    @endforeach


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>