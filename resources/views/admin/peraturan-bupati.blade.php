<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Peraturan Bupati - Admin JDIH</title>

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
            max-width: 450px;
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

        .judul-perbup {
            font-weight: 600;
            color: #212529;
            max-width: 400px;
            line-height: 1.5;
        }

        .nomor-perbup {
            font-weight: 700;
            color: #0d6efd;
        }

        .badge-status {
            font-size: 10px;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

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

            box-shadow: none !important;
        }

        .pagination .page-link:hover {
            background: #f1f5f9 !important;
            color: #0d6efd !important;
        }

        .pagination .page-item.active .page-link {
            background: #0d6efd !important;
            border-color: #0d6efd !important;
            color: #fff !important;
        }

        .pagination .page-item.disabled .page-link {
            background: #f8f9fa !important;
            color: #adb5bd !important;
        }

        .pagination svg {
            width: 14px !important;
            height: 14px !important;
        }

        .pagination-wrapper .small {
            display: none !important;
        }

        /* =====================================================
           MODAL
        ===================================================== */

        .modal-xl {
            max-width: 1100px;
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

        .modal-tab-wrapper {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .nav-tabs {
            border-bottom: none;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6b7280;

            font-size: 13px;
            font-weight: 600;

            padding: 12px 18px;
            white-space: nowrap;
        }

        .nav-tabs .nav-link:hover {
            color: #0d6efd;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background: transparent;
            border-bottom: 3px solid #0d6efd;
        }

        /* =====================================================
           MODAL BODY
        ===================================================== */

        .modal-form-body,
        .modal-edit-body {
            max-height: 65vh;
            overflow-y: auto;
            padding: 25px;
        }

        .modal-form-body::-webkit-scrollbar,
        .modal-edit-body::-webkit-scrollbar {
            width: 7px;
        }

        .modal-form-body::-webkit-scrollbar-track,
        .modal-edit-body::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .modal-form-body::-webkit-scrollbar-thumb,
        .modal-edit-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
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

        .form-control,
        .form-select {
            font-size: 14px;
            border-radius: 7px;
            border-color: #d1d5db;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .1);
        }

        textarea.form-control {
            resize: vertical;
        }

        /* =====================================================
           INFO BOX
        ===================================================== */

        .form-info-box {
            background: #eff6ff;
            color: #1d4ed8;

            border-radius: 8px;
            padding: 12px 15px;

            font-size: 13px;

            display: flex;
            align-items: center;
        }

        /* =====================================================
           TAB NAVIGATION
        ===================================================== */

        .tab-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 30px;
            padding-top: 20px;

            border-top: 1px solid #e5e7eb;
        }

        /* =====================================================
           FILE
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

            .modal-form-body,
            .modal-edit-body {
                max-height: 70vh;
                padding: 18px;
            }

            .nav-tabs {
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .nav-tabs .nav-link {
                padding: 10px 13px;
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

        <div class="sidebar-brand">
            <i class="bi bi-bank"></i>

            <div>
                <h5>Admin JDIH</h5>
                <small>Kabupaten Toba</small>
            </div>
        </div>

        <div class="sidebar-menu">

            <div class="menu-title">
                Menu Utama
            </div>

            <a href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.peraturan-daerah') }}">
                <i class="bi bi-file-earmark-ruled"></i>
                <span>Peraturan Daerah</span>
            </a>

            <a
                href="{{ route('admin.peraturan-bupati.index') }}"
                class="active">
                <i class="bi bi-file-earmark-richtext"></i>
                <span>Peraturan Bupati</span>
            </a>

            <a href="{{ route('admin.keputusan-bupati') }}">
                <i class="bi bi-file-earmark-check"></i>
                <span>Keputusan Bupati</span>
            </a>

            <a href="{{ route('admin.carousel') }}">
                <i class="bi bi-images"></i>
                <span>Carousel</span>
            </a>

            <a href="{{ route('admin.visi') }}">
                <i class="bi bi-bullseye"></i>
                <span>Visi & Misi</span>
            </a>

            <a href="{{ route('admin.struktur') }}">
                <i class="bi bi-diagram-3"></i>
                <span>Struktur Organisasi</span>
            </a>

            <a href="{{ route('admin.berita') }}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>

                        <a href="{{ route('admin.pengumuman.index') }}" >  <i class="bi bi-megaphone"></i> <span>   Pengumuman </span> </a>


        </div>

        <!-- LOGOUT -->

        <div class="logout-area">

            <form
                method="POST"
                action="{{ url('/logout') }}">

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
                Peraturan Bupati
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
                Peraturan Bupati
            </h2>

            <p>
                Kelola data Peraturan Bupati Kabupaten Toba.
            </p>

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

        <div class="alert alert-danger">

            <strong>
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

                        <i class="bi bi-file-earmark-richtext me-2 text-primary"></i>

                        Data Peraturan Bupati

                    </h5>

                    <div class="card-header-subtitle">
                        Daftar Peraturan Bupati Kabupaten Toba
                    </div>

                </div>


                <button
                    type="button"
                    class="btn btn-primary btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambah">

                    <i class="bi bi-plus-lg me-1"></i>

                    Tambah Peraturan Bupati

                </button>

            </div>


            <!-- =====================================================
                 SEARCH
            ====================================================== -->

            <div class="search-wrapper">

                <form
                    action="{{ route('admin.peraturan-bupati.index') }}"
                    method="GET"
                    class="search-box">

                    <div class="input-group">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari nomor atau judul peraturan...">

                        <button
                            type="submit"
                            class="btn btn-outline-primary">

                            <i class="bi bi-search"></i>

                        </button>

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
                                Nomor
                            </th>

                            <th>
                                Judul Peraturan Bupati
                            </th>

                            <th>
                                Tahun
                            </th>
                            <th>
                                Tanggal Upload
                            </th>


                            <th>
                                Tanggal Penetapan
                            </th>

                            <th>
                                Status
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($peraturanBupatis as $item)

                        <tr>

                            <td class="px-3">
                                {{ $peraturanBupatis->firstItem() + $loop->index }}
                            </td>


                            <td>

                                <span class="nomor-perbup">
                                    {{ $item->nomor_peraturan ?? '-' }}
                                </span>

                            </td>


                            <td>

                                <div class="judul-perbup">
                                    {{ $item->judul }}
                                </div>

                                <small class="text-muted">
                                    {{ $item->jenis_peraturan ?? 'Peraturan Bupati' }}
                                </small>

                            </td>


                            <td>
                                {{ $item->tahun ?? '-' }}
                            </td>

                            <td>
    @if($item->tanggal_upload)
        {{ \Carbon\Carbon::parse($item->tanggal_upload)->format('d-m-Y') }}
    @else
        -
    @endif
</td>

                            <td>

                                @if($item->tanggal_penetapan)

                                {{ \Carbon\Carbon::parse($item->tanggal_penetapan)->format('d-m-Y') }}

                                @else

                                -

                                @endif

                            </td>


                            <td>

                                @if($item->status === 'BERLAKU')

                                <span class="badge bg-success badge-status">
                                    BERLAKU
                                </span>

                                @else

                                <span class="badge bg-danger badge-status">
                                    TIDAK BERLAKU
                                </span>

                                @endif

                            </td>


                            <td class="text-center">

                                <!-- EDIT -->

                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm action-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $item->id }}"
                                    title="Edit">

                                    <i class="bi bi-pencil-square"></i>

                                </button>


                                <!-- DELETE -->

                                <form
                                    action="{{ route('admin.peraturan-bupati.destroy', $item->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus Peraturan Bupati ini?')">

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
                                colspan="7"
                                class="p-0">

                                <div class="empty-data">

                                    <i class="bi bi-file-earmark-text d-block"></i>

                                    <h6>
                                        Belum Ada Peraturan Bupati
                                    </h6>

                                    <p class="mb-0">
                                        Silakan tambahkan Peraturan Bupati menggunakan tombol di atas.
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

            @if($peraturanBupatis->hasPages())

            <div class="pagination-wrapper">

                {{ $peraturanBupatis->withQueryString()->links('pagination::bootstrap-5') }}

            </div>

            @endif

        </div>

    </main>


    <!-- =====================================================
         MODAL EDIT
         DILETAKKAN DI LUAR TABLE
    ====================================================== -->

    @foreach($peraturanBupatis as $item)

    <div
        class="modal fade"
        id="modalEdit{{ $item->id }}"
        tabindex="-1"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content">

                <!-- HEADER -->

                <div class="modal-header">

                    <div>

                        <h5 class="modal-title">

                            <i class="bi bi-pencil-square me-2 text-primary"></i>

                            Edit Peraturan Bupati

                        </h5>

                        <small class="text-muted">
                            Ubah informasi Peraturan Bupati
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
                    action="{{ route('admin.peraturan-bupati.update', $item->id) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    <div class="modal-edit-body">

                        <!-- INFORMASI UTAMA -->

                        <div class="form-section">

                            <div class="form-section-title">

                                <i class="bi bi-info-circle"></i>

                                Informasi Utama

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Tipe Dokumen
                                    </label>

                                    <input
                                        type="text"
                                        name="tipe_dokumen"
                                        class="form-control"
                                        value="{{ $item->tipe_dokumen }}">

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Jenis
                                    </label>

                                    <input
                                        type="text"
                                        name="jenis"
                                        class="form-control"
                                        value="{{ $item->jenis ?? 'Peraturan Bupati' }}">

                                </div>


                                <div class="col-md-12 mb-3">

                                    <label class="form-label">
                                        Judul
                                        <span class="text-danger">*</span>
                                    </label>

                                    <textarea
                                        name="judul"
                                        class="form-control"
                                        rows="3"
                                        required>{{ $item->judul }}</textarea>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        T.E.U Badan / Pengarang
                                    </label>

                                    <input
                                        type="text"
                                        name="teu_badan"
                                        class="form-control"
                                        value="{{ $item->teu_badan }}">

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Nomor Peraturan
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="nomor_peraturan"
                                        class="form-control"
                                        value="{{ $item->nomor_peraturan }}"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                                Tanggal Upload
                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_upload"
                                                class="form-control"
                                                value="{{ date('Y-m-d') }}">

                                            <small class="text-muted">

                                                Jika dikosongkan,
                                                otomatis tanggal hari ini.

                                            </small>

                                </div>



                            </div>

                        </div>


                        <!-- DETAIL PERATURAN -->

                        <div class="form-section mt-4">

                            <div class="form-section-title">

                                <i class="bi bi-file-text"></i>

                                Detail Peraturan

                            </div>


                            <div class="row">

                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Jenis Peraturan
                                    </label>

                                    <input
                                        type="text"
                                        name="jenis_peraturan"
                                        class="form-control"
                                        value="{{ $item->jenis_peraturan ?? 'Peraturan Bupati' }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Singkatan
                                    </label>

                                    <input
                                        type="text"
                                        name="singkatan"
                                        class="form-control"
                                        value="{{ $item->singkatan ?? 'PERBUP' }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tahun
                                    </label>

                                    <input
                                        type="number"
                                        name="tahun"
                                        class="form-control"
                                        value="{{ $item->tahun }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tempat Penetapan
                                    </label>

                                    <input
                                        type="text"
                                        name="tempat_penetapan"
                                        class="form-control"
                                        value="{{ $item->tempat_penetapan }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tanggal Penetapan
                                    </label>

                                    <input
                                        type="date"
                                        name="tanggal_penetapan"
                                        class="form-control"
                                        value="{{ $item->tanggal_penetapan ? \Carbon\Carbon::parse($item->tanggal_penetapan)->format('Y-m-d') : '' }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Tanggal Pengundangan
                                    </label>

                                    <input
                                        type="date"
                                        name="tanggal_pengundangan"
                                        class="form-control"
                                        value="{{ $item->tanggal_pengundangan ? \Carbon\Carbon::parse($item->tanggal_pengundangan)->format('Y-m-d') : '' }}">

                                </div>

                            </div>

                        </div>


                        <!-- INFORMASI DOKUMEN -->

                        <div class="form-section mt-4">

                            <div class="form-section-title">

                                <i class="bi bi-folder2-open"></i>

                                Informasi Dokumen

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Sumber
                                    </label>

                                    <input
                                        type="text"
                                        name="sumber"
                                        class="form-control"
                                        value="{{ $item->sumber }}">

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Subjek
                                    </label>

                                    <input
                                        type="text"
                                        name="subjek"
                                        class="form-control"
                                        value="{{ $item->subjek }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Bahasa
                                    </label>

                                    <input
                                        type="text"
                                        name="bahasa"
                                        class="form-control"
                                        value="{{ $item->bahasa ?? 'Indonesia' }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Lokasi
                                    </label>

                                    <input
                                        type="text"
                                        name="lokasi"
                                        class="form-control"
                                        value="{{ $item->lokasi }}">

                                </div>


                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Bidang Hukum
                                    </label>

                                    <input
                                        type="text"
                                        name="bidang_hukum"
                                        class="form-control"
                                        value="{{ $item->bidang_hukum }}">

                                </div>


                                <div class="col-md-12 mb-3">

                                    <label class="form-label">
                                        Abstrak
                                    </label>

                                    <textarea
                                        name="abstrak"
                                        class="form-control"
                                        rows="5">{{ $item->abstrak }}</textarea>

                                </div>

                            </div>

                        </div>


                        <!-- STATUS & FILE -->

                        <div class="form-section mt-4">

                            <div class="form-section-title">

                                <i class="bi bi-toggle-on"></i>

                                Status & File

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Status
                                    </label>

                                    <select
                                        name="status"
                                        class="form-select">

                                        <option
                                            value="BERLAKU"
                                            {{ $item->status === 'BERLAKU' ? 'selected' : '' }}>
                                            BERLAKU
                                        </option>

                                        <option
                                            value="TIDAK BERLAKU"
                                            {{ $item->status === 'TIDAK BERLAKU' ? 'selected' : '' }}>
                                            TIDAK BERLAKU
                                        </option>

                                    </select>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        File Peraturan Bupati
                                    </label>

                                    <input
                                        type="file"
                                        name="file_dokumen"
                                        class="form-control"
                                        accept=".pdf">

                                    @if($item->file_dokumen)

                                    <div class="current-file">

                                        <i class="bi bi-file-earmark-pdf me-1 text-danger"></i>

                                        File saat ini:
                                        {{ $item->file_dokumen }}

                                    </div>

                                    @endif

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        English Version
                                    </label>

                                    <input type="file"
                                        name="english_version"
                                        class="form-control"
                                        accept=".pdf,application/pdf">

                                    <small class="text-muted d-block">
                                        PDF
                                    </small>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Braille
                                    </label>

                                    <input type="file"
                                        name="braille"
                                        class="form-control"
                                        accept=".pdf,application/pdf">

                                    <small class="text-muted d-block">
                                        PDF
                                    </small>

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Alih Suara
                                    </label>

                                    <input type="file"
                                        name="alih_suara"
                                        class="form-control"
                                        accept=".mp3,.wav,.m4a,.ogg">

                                    <small class="text-muted d-block">
                                        MP3, WAV, M4A, atau OGG.
                                    </small>
                                </div>

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
         MODAL TAMBAH
    ====================================================== -->

    <div
        class="modal fade"
        id="modalTambah"
        tabindex="-1"
        aria-labelledby="modalTambahLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content">

                <!-- HEADER -->

                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="modalTambahLabel">

                            <i class="bi bi-file-earmark-plus me-2 text-primary"></i>

                            Tambah Peraturan Bupati

                        </h5>

                        <small class="text-muted">
                            Lengkapi informasi Peraturan Bupati Kabupaten Toba
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
                    action="{{ route('admin.peraturan-bupati.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf


                    <!-- TAB HEADER -->

                    <div class="modal-tab-wrapper">

                        <ul
                            class="nav nav-tabs px-4 pt-3"
                            id="tambahPerbupTab"
                            role="tablist">

                            <li class="nav-item">

                                <button
                                    class="nav-link active"
                                    id="informasi-perbup-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#informasi-perbup"
                                    type="button">

                                    <i class="bi bi-info-circle me-1"></i>

                                    Informasi Utama

                                </button>

                            </li>


                            <li class="nav-item">

                                <button
                                    class="nav-link"
                                    id="detail-perbup-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#detail-perbup"
                                    type="button">

                                    <i class="bi bi-file-text me-1"></i>

                                    Detail Peraturan

                                </button>

                            </li>


                            <li class="nav-item">

                                <button
                                    class="nav-link"
                                    id="dokumen-perbup-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#dokumen-perbup"
                                    type="button">

                                    <i class="bi bi-folder2-open me-1"></i>

                                    Informasi Dokumen

                                </button>

                            </li>


                            <li class="nav-item">

                                <button
                                    class="nav-link"
                                    id="file-perbup-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#file-perbup"
                                    type="button">

                                    <i class="bi bi-file-earmark-pdf me-1"></i>

                                    Status & File

                                </button>

                            </li>

                        </ul>

                    </div>


                    <!-- BODY -->

                    <div class="modal-form-body">

                        <div
                            class="tab-content"
                            id="tambahPerbupTabContent">


                            <!-- =================================================
                                 TAB 1
                            ================================================== -->

                            <div
                                class="tab-pane fade show active"
                                id="informasi-perbup">

                                <div class="form-section">

                                    <div class="form-section-title">

                                        <i class="bi bi-info-circle"></i>

                                        Informasi Utama

                                    </div>


                                    <div class="row">

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Tipe Dokumen
                                            </label>

                                            <input
                                                type="text"
                                                name="tipe_dokumen"
                                                class="form-control"
                                                value="Peraturan Perundang-Undangan">

                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Jenis
                                            </label>

                                            <input
                                                type="text"
                                                name="jenis"
                                                class="form-control"
                                                value="Peraturan Bupati">

                                        </div>


                                        <div class="col-12 mb-3">

                                            <label class="form-label">

                                                Judul

                                                <span class="text-danger">
                                                    *
                                                </span>

                                            </label>

                                            <textarea
                                                name="judul"
                                                class="form-control"
                                                rows="4"
                                                placeholder="Contoh: Peraturan Bupati Kabupaten Toba Nomor 1 Tahun 2026 Tentang ..."
                                                required></textarea>

                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                T.E.U Badan / Pengarang
                                            </label>

                                            <input
                                                type="text"
                                                name="teu_badan"
                                                class="form-control"
                                                value="Pemerintah Kabupaten Toba">

                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">

                                                Nomor Peraturan

                                                <span class="text-danger">
                                                    *
                                                </span>

                                            </label>

                                            <input
                                                type="text"
                                                name="nomor_peraturan"
                                                class="form-control"
                                                placeholder="Contoh: 1"
                                                required>

                                        </div>

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Tanggal Upload
                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_upload"
                                                class="form-control"
                                                value="{{ date('Y-m-d') }}">

                                            <small class="text-muted">

                                                Jika dikosongkan,
                                                otomatis tanggal hari ini.

                                            </small>

                                        </div>

                                    </div>

                                </div>


                                <div class="form-info-box">

                                    <i class="bi bi-lightbulb me-2"></i>

                                    <span>
                                        Isi informasi utama Peraturan Bupati
                                        dengan lengkap dan benar.
                                    </span>

                                </div>


                                <div class="tab-navigation">

                                    <div></div>

                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        onclick="nextPerbupTab('detail-perbup-tab', 'informasi-perbup')">

                                        Selanjutnya

                                        <i class="bi bi-arrow-right ms-1"></i>

                                    </button>

                                </div>

                            </div>


                            <!-- =================================================
                                 TAB 2
                            ================================================== -->

                            <div
                                class="tab-pane fade"
                                id="detail-perbup">

                                <div class="form-section">

                                    <div class="form-section-title">

                                        <i class="bi bi-file-text"></i>

                                        Detail Peraturan

                                    </div>


                                    <div class="row">

                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Jenis Peraturan
                                            </label>

                                            <input
                                                type="text"
                                                name="jenis_peraturan"
                                                class="form-control"
                                                value="Peraturan Bupati">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Singkatan
                                            </label>

                                            <input
                                                type="text"
                                                name="singkatan"
                                                class="form-control"
                                                value="PERBUP">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">

                                                Tahun

                                                <span class="text-danger">
                                                    *
                                                </span>

                                            </label>

                                            <input
                                                type="number"
                                                name="tahun"
                                                class="form-control"
                                                value="{{ date('Y') }}"
                                                required>

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Tempat Penetapan
                                            </label>

                                            <input
                                                type="text"
                                                name="tempat_penetapan"
                                                class="form-control"
                                                value="Balige">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Tanggal Penetapan
                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_penetapan"
                                                class="form-control">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Tanggal Pengundangan
                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_pengundangan"
                                                class="form-control">

                                        </div>

                                    </div>

                                </div>


                                <div class="tab-navigation">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="nextPerbupTab('informasi-perbup-tab', 'detail-perbup')">

                                        <i class="bi bi-arrow-left me-1"></i>

                                        Kembali

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        onclick="nextPerbupTab('dokumen-perbup-tab', 'detail-perbup')">

                                        Selanjutnya

                                        <i class="bi bi-arrow-right ms-1"></i>

                                    </button>

                                </div>

                            </div>


                            <!-- =================================================
                                 TAB 3
                            ================================================== -->

                            <div
                                class="tab-pane fade"
                                id="dokumen-perbup">

                                <div class="form-section">

                                    <div class="form-section-title">

                                        <i class="bi bi-folder2-open"></i>

                                        Informasi Dokumen

                                    </div>


                                    <div class="row">

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Sumber
                                            </label>

                                            <input
                                                type="text"
                                                name="sumber"
                                                class="form-control"
                                                placeholder="Contoh: Berita Daerah Kabupaten Toba">

                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Subjek
                                            </label>

                                            <input
                                                type="text"
                                                name="subjek"
                                                class="form-control"
                                                placeholder="Contoh: Pemerintahan Daerah">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Bahasa
                                            </label>

                                            <input
                                                type="text"
                                                name="bahasa"
                                                class="form-control"
                                                value="Indonesia">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Lokasi
                                            </label>

                                            <input
                                                type="text"
                                                name="lokasi"
                                                class="form-control"
                                                value="Kabupaten Toba">

                                        </div>


                                        <div class="col-md-4 mb-3">

                                            <label class="form-label">
                                                Bidang Hukum
                                            </label>

                                            <input
                                                type="text"
                                                name="bidang_hukum"
                                                class="form-control">

                                        </div>


                                        <div class="col-12 mb-3">

                                            <label class="form-label">
                                                Abstrak
                                            </label>

                                            <textarea
                                                name="abstrak"
                                                class="form-control"
                                                rows="7"
                                                placeholder="Masukkan abstrak Peraturan Bupati..."></textarea>

                                        </div>

                                    </div>

                                </div>


                                <div class="tab-navigation">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="nextPerbupTab('detail-perbup-tab', 'dokumen-perbup')">

                                        <i class="bi bi-arrow-left me-1"></i>

                                        Kembali

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        onclick="nextPerbupTab('file-perbup-tab', 'dokumen-perbup')">

                                        Selanjutnya

                                        <i class="bi bi-arrow-right ms-1"></i>

                                    </button>

                                </div>

                            </div>


                            <!-- =================================================
                                 TAB 4
                            ================================================== -->

                            <div
                                class="tab-pane fade"
                                id="file-perbup">

                                <div class="form-section">

                                    <div class="form-section-title">

                                        <i class="bi bi-toggle-on"></i>

                                        Status Dokumen

                                    </div>


                                    <div class="row">

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Status
                                            </label>

                                            <select
                                                name="status"
                                                class="form-select">

                                                <option value="BERLAKU">
                                                    BERLAKU
                                                </option>

                                                <option value="TIDAK BERLAKU">
                                                    TIDAK BERLAKU
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>


                                <div class="form-section mt-4">

                                    <div class="form-section-title">

                                        <i class="bi bi-file-earmark-pdf"></i>

                                        File Dokumen

                                    </div>


                                    <div class="row">

                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">

                                                File Peraturan Bupati (PDF)

                                                <span class="text-danger">
                                                    *
                                                </span>

                                            </label>

                                            <input
                                                type="file"
                                                name="file_dokumen"
                                                class="form-control"
                                                accept=".pdf"
                                                required>

                                            <small class="text-muted">
                                                Format PDF, maksimal 20 MB.
                                            </small>

                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                English Version
                                            </label>
                                            <input type="file"
                                                name="english_version"
                                                class="form-control"
                                                accept=".pdf,application/pdf">

                                            <small class="text-muted d-block">
                                                PDF
                                            </small>
                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Braille
                                            </label>

                                            <input type="file"
                                                name="braille"
                                                class="form-control"
                                                accept=".pdf,application/pdf">

                                            <small class="text-muted d-block">
                                                PDF
                                            </small>
                                        </div>


                                        <div class="col-md-6 mb-3">

                                            <label class="form-label">
                                                Alih Suara
                                            </label>

                                            <input type="file"
                                                name="alih_suara"
                                                class="form-control"
                                                accept=".mp3,.wav,.m4a,.ogg">

                                            <small class="text-muted d-block">
                                                MP3, WAV, M4A, atau OGG.
                                            </small>
                                        </div>

                                    </div>

                                </div>


                                <div class="form-info-box mt-3">

                                    <i class="bi bi-info-circle me-2"></i>

                                    <span>
                                        Pastikan file PDF yang diunggah merupakan
                                        dokumen Peraturan Bupati yang benar.
                                    </span>

                                </div>


                                <div class="tab-navigation">

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="nextPerbupTab('dokumen-perbup-tab', 'file-perbup')">

                                        <i class="bi bi-arrow-left me-1"></i>

                                        Kembali

                                    </button>


                                    <button
                                        type="submit"
                                        class="btn btn-success">

                                        <i class="bi bi-check-lg me-1"></i>

                                        Simpan Peraturan Bupati

                                    </button>

                                </div>

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

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- =====================================================
         BOOTSTRAP JS
    ====================================================== -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>


    <!-- =====================================================
         TAB SCRIPT
    ====================================================== -->

    <script>
        function nextPerbupTab(tabId, currentTabId) {

            const currentTab =
                document.getElementById(currentTabId);

            if (!currentTab) {
                return;
            }


            const requiredFields =
                currentTab.querySelectorAll(
                    'input[required], textarea[required], select[required]'
                );


            let valid = true;
            let firstInvalidField = null;


            requiredFields.forEach(function(field) {

                if (!field.checkValidity()) {

                    valid = false;

                    if (!firstInvalidField) {
                        firstInvalidField = field;
                    }

                }

            });


            if (!valid) {

                firstInvalidField.reportValidity();
                firstInvalidField.focus();

                return;
            }


            const nextTab =
                document.getElementById(tabId);


            if (nextTab) {

                const tabInstance =
                    bootstrap.Tab.getOrCreateInstance(nextTab);

                tabInstance.show();

            }


            const modalBody =
                document.querySelector(
                    '#modalTambah .modal-form-body'
                );


            if (modalBody) {

                setTimeout(function() {

                    modalBody.scrollTop = 0;

                }, 100);

            }

        }


        /* =====================================================
           RESET TAB MODAL TAMBAH
        ====================================================== */

        const modalTambah =
            document.getElementById('modalTambah');


        if (modalTambah) {

            modalTambah.addEventListener(
                'shown.bs.modal',
                function() {

                    const firstTab =
                        document.getElementById(
                            'informasi-perbup-tab'
                        );


                    if (firstTab) {

                        bootstrap.Tab
                            .getOrCreateInstance(firstTab)
                            .show();

                    }


                    const modalBody =
                        modalTambah.querySelector(
                            '.modal-form-body'
                        );


                    if (modalBody) {

                        modalBody.scrollTop = 0;

                    }

                }
            );

        }


        /* =====================================================
           SCROLL MODAL EDIT KE ATAS
        ====================================================== */

        document
            .querySelectorAll('[id^="modalEdit"]')
            .forEach(function(modal) {

                modal.addEventListener(
                    'shown.bs.modal',
                    function() {

                        const body =
                            modal.querySelector(
                                '.modal-edit-body'
                            );


                        if (body) {

                            body.scrollTop = 0;

                        }

                    }
                );

            });
    </script>

</body>

</html>