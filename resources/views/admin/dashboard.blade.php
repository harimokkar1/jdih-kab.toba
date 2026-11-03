<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin JDIH</title>

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
            font-family:  Arial,Helvetica, sans-serif;
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
            color: white;
            z-index: 1000;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            border-bottom:1px solid rgba(255,255,255,.08);

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

        /* =========================================
           CONTENT
        ========================================= */
        .content {
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
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
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

       /* =========================================
   STATISTIC CARD
========================================= */
.stat-card {
    background: #fff;
    border-radius: 16px;
    padding: 22px;
    border: 1px solid #edf0f5;
    box-shadow: 0 4px 15px rgba(0,0,0,.04);
    transition: all .25s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

/* GARIS ATAS */
.stat-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
}

/* TOP */
.stat-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

/* TITLE */
.stat-title {
    color: #6c757d;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}

/* NUMBER */
.stat-number {
    font-size: 34px;
    font-weight: 700;
    line-height: 1;
    color: #212529;
}

/* DESCRIPTION */
.stat-description {
    margin-top: 8px;
    font-size: 12px;
    color: #9aa1a9;
}

/* ICON */
.stat-icon {
    width: 55px;
    height: 55px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
}

/* LINK */
.stat-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 22px;
    padding-top: 14px;
    border-top: 1px solid #edf0f5;
    color: #6c757d;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: .2s;
}

.stat-link:hover {
    color: #0d6efd;
}

.stat-link i {
    font-size: 15px;
}

/* =========================================
   BLUE
========================================= */
.stat-blue::before {
    background: #0d6efd;
}

.stat-blue .stat-icon {
    background: #e7f1ff;
    color: #0d6efd;
}

/* =========================================
   GREEN
========================================= */
.stat-green::before {
    background: #198754;
}

.stat-green .stat-icon {
    background: #e8f7ef;
    color: #198754;
}

/* =========================================
   ORANGE
========================================= */
.stat-orange::before {
    background: #fd7e14;
}

.stat-orange .stat-icon {
    background: #fff1e6;
    color: #fd7e14;
}

/* =========================================
   PURPLE
========================================= */
.stat-purple::before {
    background: #6f42c1;
}
.stat-purple .stat-icon {
    background: #f0eaff;
    color: #6f42c1;
}

/* =========================================
   CYAN
========================================= */
.stat-cyan::before {
    background: #0dcaf0;
}
.stat-cyan .stat-icon {
    background: #e7faff;
    color: #0dcaf0;
}

/* =========================================
   RED
========================================= */
.stat-red::before {
    background: #dc3545;
}
.stat-red .stat-icon {
    background: #fdebed;
    color: #dc3545;

}

        /* =========================================
           RESPONSIVE
        ========================================= */
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
        <div> <h5> Admin JDIH</h5> <small> Kabupaten Toba</small></div>
    </div>

    <!-- MENU -->
    <div class="sidebar-menu">
        <div class="menu-title"> Menu Utama</div>
        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"  class="active">
            <i class="bi bi-grid-1x2"></i>
            <span> Dashboard  </span>
        </a>

        <!-- PERATURAN DAERAH -->
        <a
            href="{{ route('admin.peraturan-daerah') }}">
            <i class="bi bi-file-earmark-ruled"></i>
            <span> Peraturan Daerah</span>

        </a>
        <!-- PERATURAN BUPATI -->

            <a href="{{ route('admin.peraturan-bupati.index') }}">
                <i class="bi bi-file-earmark-richtext"></i>
                <span> Peraturan Bupati</span>
            </a>

            <a
                href="{{ route('admin.keputusan-bupati') }}">
                <i class="bi bi-file-earmark-check"></i>
                <span>Keputusan Bupati</span>
            </a>

        <!-- CAROUSEL -->
        <a href="{{ route('admin.carousel') }}">
            <i class="bi bi-images"></i>
            <span>Carousel </span>
        </a>

        <!-- VISI MISI -->
        <a href="{{ route('admin.visi') }}">
            <i class="bi bi-bullseye"></i>
            <span>  Visi & Misi </span>
        </a>

        <!-- STRUKTUR -->
        <a href="{{ route('admin.struktur') }}">
            <i class="bi bi-diagram-3"></i>
            <span> Struktur Organisasi </span>
        </a>

        <!-- BERITA -->
        <a href="{{ route('admin.berita') }}">
            <i class="bi bi-newspaper"></i>
            <span> Berita </span>
        </a>

        <a href="{{ route('admin.pengumuman.index') }}" >  <i class="bi bi-megaphone"></i> <span>   Pengumuman </span> </a>

    </div>

    <!-- LOGOUT -->
    <div class="logout-area">
        <form  method="POST" action="/logout">
            @csrf
            <button  type="submit" class="btn btn-danger w-100"> <i class="bi bi-box-arrow-right me-2"></i>Logout </button>
        </form>
    </div>
</aside>

<!-- =====================================================
     MAIN CONTENT
====================================================== -->
<main class="content">
    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-title"> Dashboard</div>
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span> {{ auth()->user()->name }}</span>
        </div>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h2> Dashboard</h2>
        <p> Ringkasan informasi website JDIH Kabupaten Toba. </p>
    </div>

   <!-- =====================================================
     STATISTICS
====================================================== -->
<div class="row g-4">
    <!-- PERATURAN DAERAH -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card stat-blue">
            <div class="stat-top">
                <div>
                    <div class="stat-title">  Peraturan Daerah </div>
                    <div class="stat-number">  {{ $totalPeraturanDaerah }}  </div>
                    <div class="stat-description"> Total Peraturan Daerah </div>
                </div>
                <div class="stat-icon">  <i class="bi bi-file-earmark-ruled"></i>  </div>
            </div>

            <a href="{{ route('admin.peraturan-daerah') }}" class="stat-link">  Kelola Peraturan Daerah <i class="bi bi-arrow-right"></i>  </a>
        </div>
    </div>

    <!-- PERATURAN BUPATI -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card stat-green">
            <div class="stat-top">
                <div>
                    <div class="stat-title"> Peraturan Bupati  </div>
                    <div class="stat-number">  {{ $totalPeraturanBupati }}  </div>
                    <div class="stat-description"> Total Peraturan Bupati </div>
                </div>
                <div class="stat-icon"> <i class="bi bi-file-earmark-richtext"></i>  </div>
            </div>
            <a  href="{{ route('admin.peraturan-bupati.index') }}" class="stat-link">Kelola Peraturan Bupati<i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- KEPUTUSAN BUPATI -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card stat-orange">
            <div class="stat-top">
                <div>
                    <div class="stat-title"> Keputusan Bupati  </div>
                    <div class="stat-number"> {{ $totalKeputusanBupati }}  </div>
                    <div class="stat-description"> Total Keputusan Bupati </div>
                </div>
                <div class="stat-icon"> <i class="bi bi-file-earmark-check"></i> </div>
            </div>
            <a href="{{ route('admin.keputusan-bupati') }}" class="stat-link">Kelola Keputusan Bupati <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <!-- BERITA -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card stat-purple">
            <div class="stat-top">
                <div>
                    <div class="stat-title">Berita</div>
                    <div class="stat-number"> {{ $totalBerita }}</div>
                    <div class="stat-description">Total berita</div>
                </div>
                <div class="stat-icon"><i class="bi bi-newspaper"></i></div>
            </div>
            <a href="{{ route('admin.berita') }}" class="stat-link"> Kelola Berita <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <!-- STRUKTUR -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card stat-cyan">
            <div class="stat-top">
                <div>
                    <div class="stat-title">Struktur Organisasi</div>
                    <div class="stat-number"> {{ $totalStruktur }}</div>
                    <div class="stat-description">Jumlah anggota struktur</div>
                </div>
                <div class="stat-icon"> <i class="bi bi-diagram-3"></i></div>
            </div>
            <a  href="{{ route('admin.struktur') }}" class="stat-link">  Kelola Struktur <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <!-- CAROUSEL -->
    <div class="col-xl-4 col-md-6">
        <div class="stat-card stat-red">
            <div class="stat-top">
                <div>
                    <div class="stat-title">  Carousel </div>
                    <div class="stat-number">  {{ $totalCarousel }}   </div>
                    <div class="stat-description"> Carousel halaman utama</div>
                </div>
                <div class="stat-icon"> <i class="bi bi-images"></i></div>
            </div>
            <a href="{{ route('admin.carousel') }}"  class="stat-link">  Kelola Carousel <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>

    <!-- PENGUMUMAN -->
<div class="col-xl-4 col-md-6">
    <div class="stat-card stat-red">

        <div class="stat-top">

            <div>

                <div class="stat-title">
                    Pengumuman
                </div>

                <div class="stat-number">
                    {{ $totalPengumuman }}
                </div>

                <div class="stat-description">
                    Total Pengumuman
                </div>

            </div>

            <div class="stat-icon">
                <i class="bi bi-megaphone"></i>
            </div>

        </div>

        <a
            href="{{ route('admin.pengumuman.index') }}"
            class="stat-link">

            Kelola Pengumuman

            <i class="bi bi-arrow-right"></i>

        </a>

    </div>
</div>
</div>
</main>
</body>
</html>