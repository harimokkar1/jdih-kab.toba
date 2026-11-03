<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visi & Misi - Admin JDIH</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"  rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"   rel="stylesheet">

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
            transition: .2s ease;
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
            padding: 25px 30px;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */
        .navbar-custom {
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
            margin: 0 0 5px;

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
        ===================================================== */
        .alert {
            border: none;
            border-radius: 9px;

            font-size: 14px;
        }

        /* =====================================================
           CARD
        ===================================================== */
        .card-custom {
            height: 100%;

            background: #fff;

            border: none;
            border-radius: 12px;

            box-shadow: 0 2px 10px rgba(0, 0, 0, .04);

            overflow: hidden;
        }

        .card-header-custom {
            padding: 18px 20px;

            border-bottom: 1px solid #edf0f3;
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
        ===================================================== */
        .form-label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control {
            border-color: #dfe3e8;
            border-radius: 8px;
            font-size: 14px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: #86b7fe;

            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .10);
        }

        .visi-input {
            min-height: 130px;
        }

        .misi-input {
            min-height: 220px;
        }

        .form-text {
            color: #8a9199;
            font-size: 11px;
        }

        .btn-save {
            min-height: 44px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        /* =====================================================
           ICON HEADER
        ===================================================== */
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

        .card-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* =====================================================
           PREVIEW VISI
        ===================================================== */
        .preview-section {
            margin-bottom: 25px;
        }

        .preview-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #343a40;
        }

        .preview-label i {
            color: #0d6efd;
        }

        .preview-box {
            padding: 18px;
            background: #f8f9fb;
            border: 1px solid #edf0f3;
            border-radius: 9px;
            color: #495057;
            font-size: 14px;
            line-height: 1.7;
        }

        .preview-visi {
            font-size: 15px;
            font-weight: 500;
            color: #343a40;
        }

        /* =====================================================
           PREVIEW MISI
        ===================================================== */
        .misi-list {
            margin: 0;
            padding-left: 20px;
        }

        .misi-list li {
            margin-bottom: 8px;
        }

        .misi-list li:last-child {
            margin-bottom: 0;
        }

        /* =====================================================
           EMPTY DATA
        ===================================================== */
        .empty-data {
            padding: 55px 20px;
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
            margin: 0;

            font-size: 14px;
        }

        /* =====================================================
           INFO BOX
        ===================================================== */

        .info-box {
            margin-top: 20px;
            padding: 13px 15px;
            background: #f0f7ff;
            border: 1px solid #d9ebff;
            border-radius: 8px;
            color: #495057;
            font-size: 12px;
            line-height: 1.6;
        }

        .info-box i {
            color: #0d6efd;
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
                <small>  Kabupaten Toba  </small>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title"> Menu Utama </div>
            <a href="/admin">
                <i class="bi bi-grid-1x2"></i>
                <span>  Dashboard </span>
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
                <span>   Peraturan Bupati </span>
            </a>

            <a  href="{{ route('admin.keputusan-bupati') }}">
                <i class="bi bi-file-earmark-check"></i>
                <span>  Keputusan Bupati </span>
            </a>

            <a href="/admin/carousel">
                <i class="bi bi-images"></i>
                <span> Carousel </span>
            </a>

            <a href="/admin/visi" class="active">
                <i class="bi bi-bullseye"></i>
                <span> Visi & Misi  </span>
            </a>

            <a href="/admin/struktur">
                <i class="bi bi-diagram-3"></i>
                <span>  Struktur Organisasi  </span>
            </a>
            <a href="{{ route('admin.berita') }}">
                <i class="bi bi-newspaper"></i>
                Berita
            </a>
                        <a href="{{ route('admin.pengumuman.index') }}" >  <i class="bi bi-megaphone"></i> <span>   Pengumuman </span> </a>

        </div>

        <!-- LOGOUT -->
        <div class="logout-area">
            <form   method="POST"  action="/logout">
                @csrf
                <button class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <main class="content">
        <!-- TOPBAR -->
        <div class="navbar-custom">
            <div class="navbar-title"> Kelola Visi & Misi  </div>
            <div class="user-info">
                <div class="user-avatar"> {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}   </div>
                <span>  {{ auth()->user()->name }}  </span>
            </div>
        </div>

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div class="page-title">
                <h2> Visi & Misi   </h2>
                <p>  Kelola informasi visi dan misi JDIH Kabupaten Toba. </p>
            </div>
        </div>


        <!-- =====================================================
             SUCCESS MESSAGE
        ====================================================== -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button  type="button"   class="btn-close"  data-bs-dismiss="alert">  </button>
            </div>
        @endif


        <!-- =====================================================
             VALIDATION ERROR
        ====================================================== -->
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>  Data belum dapat disimpan. </strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>  {{ $error }} </li>
                    @endforeach
                </ul>
                <button  type="button"  class="btn-close"  data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        <!-- =====================================================
             FORM & PREVIEW
        ====================================================== -->
        <div class="row g-4">
            <!-- =================================================
                 FORM VISI MISI
            ================================================== -->
            <div class="col-lg-6">
                <div class="card-custom">
                    <!-- HEADER -->
                    <div class="card-header-custom">
                        <div class="card-title-wrapper">
                            <div class="card-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <div>
                                <h5> Form Visi & Misi </h5>
                                <p>  Masukkan informasi yang akan ditampilkan pada halaman publik. </p>
                            </div>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="card-body-custom">
                        <form  method="POST"  action="/admin/visi">
                            @csrf

                            <!-- VISI -->
                            <div class="mb-4">
                                <label class="form-label">   Visi
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea  name="visi"  class="form-control visi-input"  placeholder="Masukkan visi organisasi..." required>{{ old('visi', $data->visi ?? '') }}</textarea>
                                <div class="form-text mt-2">
                                    Tuliskan visi organisasi secara singkat dan jelas.
                                </div>
                            </div>


                            <!-- MISI -->
                            <div class="mb-4">
                                <label class="form-label">
                                    Misi
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea name="misi" class="form-control misi-input"  placeholder="Masukkan misi organisasi..."  required>{{ old('misi', $data->misi ?? '') }}</textarea>
                                <div class="form-text mt-2">
                                    Gunakan baris baru untuk setiap poin misi.
                                </div>
                            </div>

                            <!-- BUTTON -->
                            <button  type="submit"  class="btn btn-primary btn-save w-100">
                                <i class="bi bi-save me-2"></i>
                                Simpan Perubahan
                            </button>

                            <!-- INFO -->
                            <div class="info-box">
                                <i class="bi bi-info-circle me-1"></i>
                                Data yang disimpan akan langsung digunakan
                                untuk menampilkan Visi & Misi pada halaman pengguna.
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- =================================================
                 PREVIEW
            ================================================== -->
            <div class="col-lg-6">
                <div class="card-custom">

                    <!-- HEADER -->
                    <div class="card-header-custom">
                        <div class="card-title-wrapper">
                            <div class="card-icon"> <i class="bi bi-eye"></i>  </div>
                            <div>
                                <h5>  Data Visi & Misi  </h5>
                                <p>  Informasi yang saat ini tersimpan. </p>
                            </div>
                        </div>
                    </div>

                    <!-- BODY -->
                    <div class="card-body-custom">
                        @if($data)
                            <!-- VISI -->
                            <div class="preview-section">
                                <div class="preview-label">
                                    <i class="bi bi-bullseye"></i>
                                    Visi
                                </div>
                                <div class="preview-box preview-visi"> {{ $data->visi }}  </div>
                            </div>


                            <!-- MISI -->
                            <div class="preview-section mb-0">
                                <div class="preview-label">
                                    <i class="bi bi-list-check"></i>
                                    Misi
                                </div>
                                <div class="preview-box">  {!! nl2br(e($data->misi)) !!}  </div>
                            </div>
                        @else

                            <!-- EMPTY -->
                            <div class="empty-data">
                                <i class="bi bi-file-earmark-text"></i>
                                <h5>Belum Ada Data  </h5>
                                <p>  Data visi & misi belum ditambahkan.  </p>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> </script>
</body>
</html>