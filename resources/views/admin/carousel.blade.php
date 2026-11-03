<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta  name="viewport"  content="width=device-width, initial-scale=1.0">
    <title>Carousel - Admin JDIH</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial,Helvetica,sans-serif;
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
            border-bottom:
                1px solid rgba(255, 255, 255, .08);
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
        }

        .menu-title {
            margin:12px 10px 8px;
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
            padding:11px 13px;
            margin-bottom: 4px;
            color: #adb5bd;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: .2s ease;
        }

        .sidebar-menu a i {
            width: 20px;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-menu a:hover {
            background: #343a40;
            color: white;
        }

        .sidebar-menu a.active {
            background: #0d6efd;
            color: white;
        }

        /* LOGOUT */
        .logout-area {
            position: absolute;
            left: 12px;
            right: 12px;
            bottom: 20px;
        }

        .logout-area button {
            font-size: 14px;
        }

        /* =====================================================
           CONTENT
        ===================================================== */
        .content {
            margin-left: 250px;
            min-height: 100vh;
            padding:25px 30px;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */
        .navbar-custom {
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding:12px 20px;
            margin-bottom: 25px;
            border-radius: 12px;
            box-shadow:0 2px 10px rgba(0, 0, 0, .04);
        }


        .navbar-title {
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .page-title h2 {
            margin:   0 0 5px;
            font-size: 25px;
            font-weight: 700;
        }

        .page-title p {
            margin: 0;
            color: #6c757d;
            font-size: 14px;
        }

        /* =====================================================
           ALERT
        ==================================================== */
        .alert {
            border: none;
            border-radius: 9px;
            font-size: 14px;
        }

        /* =====================================================
           CARD
        ===================================================== */
        .card-custom {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 18px 20px;
            border-bottom:1px solid #edf0f3;
        }

        .card-header-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #e8f1ff;
            color: #0d6efd;
            font-size: 18px;
        }

        .card-header-custom h5 {
            margin: 0 0 4px;
            font-size: 16px;
            font-weight: 700;
        }

        .card-header-custom p {
            margin: 0;
            color: #8a9199;
            font-size: 12px;
        }

        .card-body-custom {
            padding: 22px;
        }

        /* =====================================================
           FORM
        ==================================================== */
        .form-label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control {
            min-height: 42px;
            border-color: #dfe3e8;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .10);
        }

        .form-text {
            color: #8a9199;
            font-size: 11px;
        }

        .btn-upload {
            min-height: 44px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        /* =====================================================
           UPLOAD BOX
        ===================================================== */
        .upload-box {
            padding: 18px;
            background: #f8f9fb;
            border: 1px dashed #ced4da;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .upload-icon {
            width: 52px;
            height: 52px;
            margin:  0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f1ff;
            color: #0d6efd;
            border-radius: 50%;
            font-size: 22px;
        }

        .upload-box h6 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .upload-box p {
            margin: 0;
            color: #8a9199;
            font-size: 12px;
        }

        /* =====================================================
           TABLE
        ===================================================== */
        .table {
            margin: 0;
        }

        .table thead th {
            padding:14px 16px;
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
            padding:14px 16px;
            vertical-align: middle;
            border-bottom:  1px solid #f0f1f3;
            font-size: 14px;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }

        /* =====================================================
           IMAGE PREVIEW
        ===================================================== */
        .carousel-preview {
            width: 130px;
            height: 72px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e1e5eb;
            background: #f1f3f5;
        }


        .carousel-title {
            font-weight: 600;
            color: #343a40;
        }


        .no-image {
            width: 130px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f2f5;
            color: #8a9199;
            border-radius: 8px;
            font-size: 22px;
        }

        /* =====================================================
           ACTION
        ===================================================== */
        .action-buttons {
            display: flex;
            gap: 6px;
        }


        .btn-action {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 7px;
        }

        /* ====================================================
           EMPTY
        ===================================================== */
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

        .empty-data p {
            margin-bottom: 0;
            font-size: 14px;
        }

        /* =====================================================
           MODAL
        ===================================================== */
        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .12);
        }

        .modal-header {
            padding:  20px 24px;
            border-bottom:   1px solid #edf0f3;
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
            border-top:  1px solid #edf0f3;
        }

        .current-image {
            width: 240px;
            height: 135px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #dee2e6;
        }

        /* =====================================================
           DELETE MODAL
        ===================================================== */
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

            .sidebar-brand i {
                margin: 0;
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

            .navbar-title {
                display: none;
            }
            .user-info span {
                display: none;
            }

            .page-title h2 {
                font-size: 21px;
            }

            .page-title p {
                font-size: 13px;
            }

            .carousel-preview,
            .no-image {
                width: 100px;
                height: 58px;
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
                <h5> Admin JDIH </h5>
                <small>  Kabupaten Toba </small>
            </div>
        </div>

        <!-- MENU -->
        <div class="sidebar-menu">
            <div class="menu-title">  Menu Utama </div>
            <a href="/admin">
                <i class="bi bi-grid-1x2"></i>
                <span>  Dashboard  </span>
            </a>

            <!-- PERATURAN DAERAH -->
        <a
            href="{{ route('admin.peraturan-daerah') }}">
            <i class="bi bi-file-earmark-ruled"></i>
            <span> Peraturan Daerah </span>
        </a>
        <!-- PERATURAN BUPATI -->
            <a href="{{ route('admin.peraturan-bupati.index') }}">
                <i class="bi bi-file-earmark-richtext"></i>
                <span> Peraturan Bupati  </span>
            </a>

            <a  href="{{ route('admin.keputusan-bupati') }}">
                <i class="bi bi-file-earmark-check"></i>
                <span>  Keputusan Bupati </span>
            </a>

            <a href="/admin/carousel" class="active">
                <i class="bi bi-images"></i>
                <span>  Carousel </span>
            </a>

            <a href="/admin/visi">
                <i class="bi bi-bullseye"></i>
                <span> Visi & Misi </span>
            </a>

            <a href="/admin/struktur">
                <i class="bi bi-diagram-3"></i>
                <span> Struktur Organisasi </span>
            </a>
            <a href="{{ route('admin.berita') }}"> <i class="bi bi-newspaper"></i>  Berita </a>

            <a href="{{ route('admin.pengumuman.index') }}" >  <i class="bi bi-megaphone"></i> <span>   Pengumuman </span> </a>

        </div>

        <!-- LOGOUT -->
        <div class="logout-area">
            <form  method="POST"  action="/logout">
                @csrf
                <button type="submit"  class="btn btn-danger w-100"> <i class="bi bi-box-arrow-right me-2"></i> Logout  </button>
            </form>
        </div>
    </aside>

    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <main class="content">
        <!-- TOPBAR -->
        <div class="navbar-custom">
            <div class="navbar-title"> Kelola Carousel  </div>
            <div class="user-info">
                    <div class="user-avatar"> {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}  </div>
                <span> {{ auth()->user()->name }} </span>
            </div>
        </div>

        <!-- =================================================
             PAGE HEADER
        ================================================== -->
        <div class="page-header">
            <div class="page-title">
                <h2>  Carousel  </h2>
                <p> Kelola gambar banner yang ditampilkan pada halaman utama. </p>
            </div>
        </div>

        <!-- =================================================
             SUCCESS
        ================================================== -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button  type="button"  class="btn-close"  data-bs-dismiss="alert">
            </button>
        </div>
        @endif

        <!-- =================================================
             ERROR
        ================================================== -->
        @if($errors->any())
        <div  class="alert alert-danger alert-dismissible fade show"  role="alert">
            <strong>  Data belum dapat diproses. </strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>  {{ $error }} </li>
                @endforeach

            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"> </button>
        </div>

        @endif

        <!-- =================================================
             UPLOAD + DATA
        ================================================== -->
        <div class="row g-4">
            <!-- =================================================
                 UPLOAD
            ================================================== -->
            <div class="col-lg-4">
                <div class="card-custom">
                    <!-- HEADER -->
                    <div class="card-header-custom">
                        <div class="card-header-wrapper">
                            <div class="card-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <div>
                                <h5>Upload Carousel</h5>
                                <p>Tambahkan gambar banner baru. </p>
                            </div>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="card-body-custom">
                        <form  method="POST"  action="/carousel/store" enctype="multipart/form-data">
                            @csrf
                            <!-- UPLOAD INFO -->
                            <div class="upload-box">
                                <div class="upload-icon"> <i class="bi bi-image"></i> </div>
                                <h6> Tambahkan Gambar </h6>
                                <p> Pilih gambar untuk carousel halaman utama. </p>
                            </div>

                            <!-- JUDUL -->
                            <div class="mb-4">
                                <label class="form-label"> Judul </label>
                                <input type="text"  name="title" class="form-control" placeholder="Masukkan judul carousel">
                                <div class="form-text mt-2">Judul dapat dikosongkan jika tidak diperlukan.</div>
                            </div>

                            <!-- GAMBAR -->
                            <div class="mb-4">
                                <label class="form-label"> Gambar<span class="text-danger">*</span> </label>

                                <input type="file"  name="image" class="form-control"  accept="image/jpeg,image/png,image/webp" required>
                                <div class="form-text mt-2"> Format JPG, PNG, atau WEBP. </div>
                            </div>
                            <!-- BUTTON -->
                            <button type="submit"class="btn btn-primary btn-upload w-100"><i class="bi bi-cloud-arrow-up me-2"></i>  Upload Carousel
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- =================================================
                 DATA
            ================================================== -->
            <div class="col-lg-8">
                <div class="card-custom">
                    <!-- HEADER -->
                    <div class="card-header-custom">
                        <div class="card-header-wrapper">
                            <div class="card-icon"><i class="bi bi-images"></i> </div>
                            <div>
                                <h5>  Data Carousel </h5>
                                <p> Daftar banner yang tersedia pada halaman utama. </p>
                            </div>
                        </div>
                    </div>

                    <!-- TABLE -->
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th width="60">   No </th>
                                    <th width="160">  Gambar  </th>
                                    <th> Judul </th>
                                    <th width="110"> Aksi </th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($carousels as $c)
                                <tr>
                                    <!-- NO -->
                                    <td> {{ $loop->iteration }} </td>

                                    <!-- GAMBAR -->
                                    <td>
                                        @if($c->image)
                                        <img src="/carousel/{{ $c->image }}" alt="{{ $c->title }}" class="carousel-preview">
                                        @else

                                        <div class="no-image"><i class="bi bi-image"></i></div>
                                        @endif
                                    </td>


                                    <!-- JUDUL -->
                                    <td>
                                        @if($c->title)
                                        <span class="carousel-title"> {{ $c->title }}</span>
                                        @else
                                        <span class="text-muted"> Tanpa judul </span>
                                        @endif
                                    </td>


                                    <!-- AKSI -->
                                    <td>
                                        <div class="action-buttons">
                                            <!-- EDIT -->
                                            <button type="button"  class="btn btn-warning btn-action text-white"  data-bs-toggle="modal"  data-bs-target="#modalEdit{{ $c->id }}"  title="Edit">  <i class="bi bi-pencil"></i> </button>
                                            <!-- DELETE -->
                                            <button  type="button" class="btn btn-outline-danger btn-action"  data-bs-toggle="modal"  data-bs-target="#modalHapus{{ $c->id }}"  title="Hapus">

                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                <tr>
                                    <td  colspan="4" class="empty-data"> 
                                        <i class="bi bi-images"></i>
                                        <h5>  Belum Ada Carousel </h5>
                                        <p> Belum ada gambar carousel yang ditambahkan.  </p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- =====================================================
         MODAL EDIT & DELETE
    ====================================================== -->
    @foreach($carousels as $c)

    <!-- =================================================
             MODAL EDIT
        ================================================== -->
    <div class="modal fade" id="modalEdit{{ $c->id }}"  tabindex="-1"  aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form  method="POST" action="/carousel/update/{{ $c->id }}" enctype="multipart/form-data">
                    @csrf

                    @method('PUT')

                    <!-- HEADER -->
                    <div class="modal-header">
                        <div>
                            <div class="modal-title">  Edit Carousel </div>
                            <span class="modal-subtitle"> Perbarui judul atau gambar carousel. </span>
                        </div>
                        <button  type="button"   class="btn-close"  data-bs-dismiss="modal"> </button>

                    </div>

                    <!-- BODY -->
                    <div class="modal-body">
                        <!-- JUDUL -->
                        <div class="mb-4">
                            <label class="form-label"> Judul </label>
                            <input  type="text"  name="title"  class="form-control"  value="{{ $c->title }}"  placeholder="Masukkan judul carousel">
                        </div>

                        <!-- GAMBAR SEKARANG -->
                        <div class="mb-4">
                            <label class="form-label d-block">  Gambar Saat Ini </label>

                            @if($c->image)
                            <img  src="/carousel/{{ $c->image }}"  alt="{{ $c->title }}"  class="current-image">

                            @endif
                        </div>


                        <!-- GANTI GAMBAR -->
                        <div>
                            <label class="form-label"> Ganti Gambar  </label>
                            <input type="file" name="image"  class="form-control" accept="image/jpeg,image/png,image/webp">
                            <div class="form-text mt-2">  Kosongkan jika tidak ingin mengganti gambar. </div>
                        </div>
                    </div>


                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button  type="button"  class="btn btn-light" data-bs-dismiss="modal">  Batal </button>
                        <button type="submit"  class="btn btn-primary">  <i class="bi bi-check-lg me-1"></i>  Simpan Perubahan  </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- =================================================
             MODAL DELETE
        ================================================== -->
    <div class="modal fade" id="modalHapus{{ $c->id }}"  tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="/carousel/delete/{{ $c->id }}">
                    @csrf
                    <!-- HEADER -->
                    <div class="modal-header">
                        <div>
                            <div class="modal-title">  Hapus Carousel  </div>
                            <span class="modal-subtitle"> Data yang dihapus tidak dapat dikembalikan. </span>
                        </div>
                        <button  type="button"  class="btn-close" data-bs-dismiss="modal"> </button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body text-center py-4">
                        <div class="delete-icon"> <i class="bi bi-trash"></i> </div>
                        <h5 class="fw-bold">  Hapus carousel ini?  </h5>
                        <p class="text-muted mb-0">
                            @if($c->title)
                            <strong>  {{ $c->title }}  </strong>
                            @else
                            <strong> Carousel tanpa judul  </strong>
                            @endif
                        </p>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button  type="button" class="btn btn-light"  data-bs-dismiss="modal">  Batal </button>
                        <button  type="submit" class="btn btn-danger"> <i class="bi bi-trash me-1"></i>  Ya, Hapus  </button>
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