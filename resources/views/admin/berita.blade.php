<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, initial-scale=1.0">
    <title>Berita - Admin JDIH</title>
    <!-- Bootstrap -->
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"  rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
            border-bottom: 1px solid rgba(255, 255, 255, .08);
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


        /* =========================================
           LOGOUT
        ========================================= */
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
           FOTO BERITA
        ========================================= */
        .berita-image {
            width: 90px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e1e5eb;
        }

        .foto-default {
            width: 90px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f0f2f5;
            color: #8a9199;
            font-size: 22px;
        }

        /* =========================================
           DATA BERITA
        ========================================= */
        .judul-berita {
            max-width: 500px;
            font-weight: 600;
            color: #212529;
        }

        .isi-preview {
            max-width: 500px;
            margin-top: 4px;
            color: #8a9199;
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tanggal {
            color: #6c757d;
            font-size: 13px;
        }

        /* =========================================
           ACTION
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

        .form-control {
            min-height: 42px;
            border-radius: 8px;
            border-color: #dfe3e8;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .10);
        }

        textarea.form-control {
            min-height: 220px;
            resize: vertical;
        }
        .form-text {
            font-size: 11px;
            color: #8a9199;
        }

        /* =========================================
           IMAGE PREVIEW
        ========================================= */
        .image-preview {
            width: 150px;
            height: 90px;
            object-fit: cover;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .current-photo {
            width: 150px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
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

            .sidebar-brand>i {
                margin: 0 !important;
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
                margin: 0 !important;
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
        }
        /* SEARCH BERITA */
        .search-berita {
            position: relative;
            width: 230px;
        }
        .search-berita i {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #8a9199;
            font-size: 14px;
        }
        .search-berita input {
            width: 100%;
            height: 36px;
            padding: 6px 12px 6px 34px;
            border: 1px solid #dee2e6;
            border-radius: 7px;
            font-size: 13px;
            outline: none;
        }
        .search-berita input:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .08);
        }
        @media (max-width: 768px) {
            .search-berita {
                width: 180px;
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
                <h5> Admin JDIH </h5>
                <small> Kabupaten Toba </small>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">  Menu Utama </div>
            <a href="/admin"> <i class="bi bi-grid-1x2"></i>  <span> Dashboard </span> </a> 
            <a href="{{ route('admin.peraturan-daerah') }}"> <i class="bi bi-file-earmark-ruled"></i> <span> Peraturan Daerah  </span>  </a>
            <!-- PERATURAN BUPATI -->
            <a href="{{ route('admin.peraturan-bupati.index') }}"> <i class="bi bi-file-earmark-richtext"></i> <span> Peraturan Bupati  </span>   </a> 
            <a href="{{ route('admin.keputusan-bupati') }}"> <i class="bi bi-file-earmark-check"></i> <span> Keputusan Bupati </span> </a> 
            <a href="/admin/carousel"> <i class="bi bi-images"></i> <span> Carousel </span> </a>
            <a href="/admin/visi"> <i class="bi bi-bullseye"></i> <span>  Visi & Misi </span> </a>
            <a href="/admin/struktur">  <i class="bi bi-diagram-3"></i> <span>  Struktur Organisasi </span>  </a>
            <a href="{{ route('admin.berita') }}" class="active">  <i class="bi bi-newspaper"></i> <span> Berita  </span>  </a>
            <!-- PENGUMUMAN -->

            <a href="{{ route('admin.pengumuman.index') }}" >  <i class="bi bi-megaphone"></i> <span>   Pengumuman </span> </a>
        </div>

        <!-- LOGOUT -->
        <div class="logout-area">
            <form  method="POST"  action="/logout">
                @csrf
                <button type="submit"  class="btn btn-danger w-100">  <i class="bi bi-box-arrow-right me-2"></i> Logout  </button>
            </form>
        </div>
    </aside>

    <!-- =====================================================
         MAIN CONTENT
    ====================================================== -->
    <main class="main-content">
        <!-- TOPBAR -->
        <div class="topbar">
            <div class="topbar-title">  Berita </div>
            <div class="user-info">
                <div class="user-avatar"> {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}   </div>
                <span> {{ auth()->user()->name }} </span>
            </div>
        </div>

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="page-title">
                <h2> Berita </h2>
                <p> Kelola berita dan informasi JDIH Kabupaten Toba.  </p>
            </div>

            <button  type="button"   class="btn btn-primary btn-add"   data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-1"></i>  Tambah Berita </button>
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
            <button  type="button" class="btn-close" data-bs-dismiss="alert">
            </button>
        </div>
        @endif

        <!-- =====================================================
             ALERT ERROR
        ====================================================== -->
        @if($errors->any())

        <div  class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>   Data belum dapat disimpan.  </strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
                @endforeach
            </ul>
            <button  type="button"  class="btn-close" data-bs-dismiss="alert">  </button>
        </div>
        @endif

        <!-- =====================================================
             TABLE
        ====================================================== -->

        <div class="table-card">
            <!-- TABLE HEADER -->
            <div class="table-card-header">
                <div>
                    <h5> Daftar Berita  </h5>
                    <span> Berita dan informasi JDIH Kabupaten Toba </span>
                </div>

                <div class="d-flex align-items-center gap-3">

                    <!-- SEARCH -->
                    <form action="{{ route('admin.berita') }}" method="GET" class="search-berita">
                        <i class="bi bi-search"></i>
                        <input  type="text"  name="search" value="{{ request('search') }}"  placeholder="Cari berita..."   autocomplete="off">
                    </form>

                    <!-- TOTAL -->
                    <span> Total {{ $beritas->total() }} berita </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="60">  No </th>
                            <th width="120">  Gambar  </th>
                            <th> Berita </th>
                            <th width="160"> Tanggal </th>
                            <th width="110">  </th>
                        </tr>
                    </thead>


                    <tbody>
                        @forelse($beritas as $berita)
                        <tr>
                            <!-- NO -->
                            <td>  {{ $beritas->firstItem() + $loop->index }}  </td>


                            <!-- GAMBAR -->
                            <td>
                                @if($berita->gambar)
                                <img src="{{ asset('uploads/berita/' . $berita->gambar) }}"  alt="{{ $berita->judul }}" class="berita-image">
                                @else
                                <div class="foto-default">
                                    <i class="bi bi-image"></i>
                                </div>
                                @endif

                            </td>


                            <!-- BERITA -->
                            <td>
                                <div class="judul-berita"> {{ $berita->judul }} </div>
                                <div class="isi-preview"> {{ Str::limit($berita->isi, 100) }} </div>
                            </td>

                            <!-- TANGGAL -->
                            <td>
                                <div class="tanggal">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $berita->created_at->format('d M Y') }}
                                </div>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <div class="action-buttons">
                                    <!-- EDIT -->
                                    <button type="button"  class="btn btn-warning btn-action text-white"   data-bs-toggle="modal"  data-bs-target="#modalEdit{{ $berita->id }}"  title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <!-- DELETE -->
                                    <button type="button"  class="btn btn-outline-danger btn-action"  data-bs-toggle="modal"  data-bs-target="#modalHapus{{ $berita->id }}" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td  colspan="5" lass="empty-data">
                                <i class="bi bi-newspaper"></i>
                                <h5>  Belum Ada Berita </h5>
                                <p> Belum ada berita yang ditambahkan. </p>
                            </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
                @if($beritas->hasPages())

                <div class="px-4 py-3 border-top">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="text-muted small">
                            Menampilkan
                            <strong>{{ $beritas->firstItem() }}</strong>
                            -
                            <strong>{{ $beritas->lastItem() }}</strong>
                            dari
                            <strong>{{ $beritas->total() }}</strong>
                            berita
                        </div>

                        <div>
                            {{ $beritas->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>


    <!-- =====================================================
         MODAL TAMBAH
    ====================================================== -->
    <div class="modal fade"  id="modalTambah"   tabindex="-1"  aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.berita.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <!-- HEADER -->
                    <div class="modal-header">
                        <div>
                            <div class="modal-title"> Tambah Berita  </div>
                            <span class="modal-subtitle">  Tambahkan berita baru ke website JDIH. </span>
                        </div>
                        <button  type="button"  class="btn-close" data-bs-dismiss="modal">  </button>
                    </div>


                    <!-- BODY -->
                    <div class="modal-body">
                        <!-- GAMBAR -->
                        <div class="mb-3">
                            <label class="form-label">   Gambar Berita  <span class="text-danger">*</span>   </label>
                            <input type="file" name="gambar"  id="gambar"  class="form-control"  accept="image/jpeg,image/png,image/webp"  onchange="previewImage(this)" required>
                            <div class="form-text"> JPG, PNG, atau WEBP. Maksimal 2 MB. </div>
                            <img id="imagePreview" class="image-preview d-none" alt="Preview">
                        </div>

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label class="form-label"> Judul Berita  <span class="text-danger">*</span> </label>
                            <input type="text"  name="judul" class="form-control" placeholder="Masukkan judul berita" required>
                        </div>

                        <!-- ISI -->
                        <div class="mb-3">
                            <label class="form-label">  Isi Berita <span class="text-danger">*</span>  </label>
                            <textarea name="isi" class="form-control" placeholder="Masukkan isi berita..." required></textarea>
                        </div>
                    </div>
                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">  Batal </button>
                        <button type="submit"  class="btn btn-primary"> <i class="bi bi-save me-1"></i> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- =====================================================
         MODAL EDIT & DELETE
    ====================================================== -->
    @foreach($beritas as $berita)

    <!-- =========================
             MODAL EDIT
        ========================== -->
    <div class="modal fade"  id="modalEdit{{ $berita->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.berita.update', $berita->id) }}"  method="POST"  enctype="multipart/form-data">

                    @csrf

                    @method('PUT')

                    <!-- HEADER -->
                    <div class="modal-header">
                        <div>
                            <div class="modal-title"> Edit Berita </div>
                            <span class="modal-subtitle"> Perbarui informasi berita. </span>
                        </div>

                        <button  type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body">
                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label class="form-label"> Judul Berita <span class="text-danger">*</span>  </label>
                            <input type="text" name="judul"  class="form-control" value="{{ $berita->judul }}" required>
                        </div>

                        <!-- GAMBAR -->
                        <div class="mb-3">
                            <label class="form-label">  Ganti Gambar </label>
                            <input type="file" name="gambar" class="form-control"  accept="image/jpeg,image/png,image/webp"  onchange="previewEditImage(this, {{ $berita->id }})">
                            <div class="form-text">  Kosongkan jika tidak ingin mengganti gambar. </div>

                            @if($berita->gambar)

                            <img id="editPreview{{ $berita->id }}" src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="Gambar berita" class="current-photo mt-2">

                            @else

                            <img  id="editPreview{{ $berita->id }}" class="current-photo mt-2 d-none"  alt="Preview">

                            @endif
                        </div>

                        <!-- ISI -->
                        <div class="mb-3">
                            <label class="form-label"> Isi Berita <span class="text-danger">*</span> </label>
                            <textarea  name="isi" class="form-control"  required>{{ $berita->isi }}</textarea>
                        </div>
                    </div>
                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button  type="button"  class="btn btn-light" data-bs-dismiss="modal"> Batal </button>
                        <button  type="submit" class="btn btn-primary"> <i class="bi bi-check-lg me-1"></i> Simpan Perubahan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- =========================
             MODAL DELETE
        ========================== -->
    <div class="modal fade" id="modalHapus{{ $berita->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST">

                    @csrf

                    @method('DELETE')

                    <!-- HEADER -->
                    <div class="modal-header">
                        <div>
                            <div class="modal-title"> Hapus Berita </div>

                            <span class="modal-subtitle">Data yang dihapus tidak dapat dikembalikan.  </span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body text-center py-4">
                        <div class="delete-icon"><i class="bi bi-trash"></i> </div>
                        <h5 class="fw-bold">Hapus berita ini?</h5>
                        <p class="text-muted mb-0">
                            <strong> {{ $berita->judul }}</strong>
                            <br>
                            Berita akan dihapus secara permanen.
                        </p>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal"> Batal </button>
                        <button type="submit" class="btn btn-danger"> <i class="bi bi-trash me-1"></i>Ya, Hapus</button>
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

    <!-- =====================================================
         PREVIEW GAMBAR
    ====================================================== -->
    <script>
        function previewImage(input) {
            const preview =
                document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.classList.add('d-none');
            }
        }

        function previewEditImage(input, id) {
            const preview =
                document.getElementById('editPreview' + id);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>