<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDIH Kabupaten Toba</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ========================================
       GLOBAL
    ======================================== */
        body {
            margin: 0;
            padding-top: 70px;
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        /* ========================================
       NAVBAR
    ======================================== */
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

        /* ========================================
       DROPDOWN
    ======================================== */
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .15);
        }

        .dropdown-item {
            transition: .2s;
        }

        .dropdown-item:hover {
            background: #0d6efd;
            color: white;
        }

        /* ========================================
       CAROUSEL
    ======================================== */
        .carousel-img {
            width: 100%;
            height: 600px;
            object-fit: cover;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(0, 0, 0, .2),
                    rgba(0, 0, 0, .75));
        }

        /* ========================================
       CAROUSEL CAPTION
    ======================================== */
        .carousel-caption {
            position: absolute;
            left: 8%;
            right: auto;
            bottom: 15%;
            width: 45%;
            text-align: left;
            z-index: 2;
        }

        .carousel-caption h1 {
            display: inline-block;
            padding: 12px 22px;
            background: rgba(0, 0, 0, .5);
            border-radius: 10px;
            font-size: 45px;
            font-weight: 700;
            color: white;
            animation: slideDown 1s ease;
        }

        /* ========================================
       ANIMATION
    ======================================== */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================
       HOME INFORMATION
    ======================================== */
        .home-information {
            background: #f8f9fa;
            padding: 70px 0;
        }

        /* ========================================
       APA ITU JDIH
    ======================================== */
        .jdih-about {
            background: white;
            padding: 35px;
            border-radius: 18px;
            height: auto;
            align-self: flex-start;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        }

        .section-label {
            display: inline-block;
            margin-bottom: 8px;
            color: #0d6efd;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .jdih-about h2,
        .news-heading {
            margin-bottom: 10px;
            color: #1f2937;
            font-weight: 700;
        }

        .jdih-about p {
            margin-bottom: 15px;
            color: #6c757d;
            font-size: 15px;
            line-height: 1.8;
        }

        .title-line-left {
            width: 60px;
            height: 4px;
            margin-bottom: 22px;
            background: #0d6efd;
            border-radius: 10px;
        }

        /* ========================================
       BERITA TERBARU
    ======================================== */
        .latest-news-container {
            background: white;
            padding: 10px 25px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
        }

        .latest-news-item {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .latest-news-item:last-child {
            border-bottom: none;
        }

        /* ========================================
       GAMBAR BERITA
    ======================================== */
        .latest-news-image {
            width: 150px;
            height: 110px;
            flex-shrink: 0;
            overflow: hidden;
            background: #e9ecef;
            border-radius: 10px;
        }

        .latest-news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .3s;
        }

        .latest-news-item:hover .latest-news-image img {
            transform: scale(1.05);
        }

        .latest-no-image {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 35px;
        }

        /* ========================================
       CONTENT BERITA
    ======================================== */
        .latest-news-content {
            flex: 1;
            min-width: 0;
        }

        .latest-news-content .home-news-date {
            margin-bottom: 6px;
            color: #6c757d;
            font-size: 12px;
        }

        .latest-news-content .home-news-date i {
            color: #0d6efd;
        }

        .latest-news-content h5 {
            margin-bottom: 6px;
            color: #212529;
            font-size: 17px;
            font-weight: 700;
            line-height: 1.4;
        }

        .latest-news-content p {
            margin-bottom: 8px;
            color: #6c757d;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ========================================
       LINK BERITA
    ======================================== */
        .home-news-link {
            color: #0d6efd;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
        }

        .home-news-link:hover {
            color: #084298;
        }

        /* ========================================
       FOOTER
    ======================================== */
        footer {
            padding: 50px 0 20px;
            background: #111827;
            color: white;
        }

        footer h5 {
            margin-bottom: 20px;
            font-weight: 700;
        }

        footer ul {
            padding: 0;
            list-style: none;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer a {
            color: #ddd;
            text-decoration: none;
            transition: .2s;
        }

        footer a:hover {
            color: white;
        }

        .footer-bottom {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, .2);
            text-align: center;
        }

        /* ========================================
       PRODUK HUKUM - STATISTIK
    ======================================== */
        .legal-statistics {
            position: relative;
            padding: 75px 0 70px;
            background: #f8fafc;
            overflow: hidden;
        }

        /* BACKGROUND DECORATION */
        .legal-statistics::before {
            content: "";
            position: absolute;
            width: 350px;
            height: 350px;
            top: -180px;
            right: -100px;
            background: rgba(13, 110, 253, .05);
            border-radius: 50%;
        }

        .legal-statistics::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            bottom: -150px;
            left: -100px;
            background: rgba(13, 110, 253, .04);
            border-radius: 50%;
        }

        .legal-statistics .container {
            position: relative;
            z-index: 2;
        }

        /* ========================================
       STATISTIC HEADER
    ======================================== */
        .legal-section-heading {
            max-width: 650px;
            margin: 0 auto 45px;
            text-align: center;
        }

        .legal-section-heading .section-label {
            margin-bottom: 10px;
        }

        .legal-section-heading h2 {
            margin-bottom: 12px;
            color: #172033;
            font-size: 32px;
            font-weight: 750;
        }

        .legal-section-heading p {
            margin: 0;
            color: #6c757d;
            font-size: 15px;
        }

        /* ========================================
       STATISTIC CARD
    ======================================== */
        .legal-stat-card {
            position: relative;
            min-height: 230px;
            padding: 30px;
            background: white;
            border: 1px solid #eef1f5;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .06);
            overflow: hidden;
            transition: all .3s ease;
        }

        .legal-stat-card:hover {
            transform: translateY(-8px);
            border-color: rgba(13, 110, 253, .2);
            box-shadow: 0 18px 40px rgba(15, 23, 42, .11);
        }

        /* AKSEN ATAS */
        .legal-stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #0d6efd;
        }

        /* ========================================
       STATISTIC ICON
    ======================================== */
        .legal-stat-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
            background: #eef5ff;
            color: #0d6efd;
            border-radius: 16px;
            font-size: 27px;
            transition: .3s;
        }

        .legal-stat-card:hover .legal-stat-icon {
            background: #0d6efd;
            color: white;
            transform: scale(1.05);
        }

        /* ========================================
       ANGKA
    ======================================== */
        .legal-stat-number {
            display: flex;
            align-items: baseline;
            gap: 7px;
            margin-bottom: 3px;
        }

        .legal-stat-number h3 {
            margin: 0;
            color: #172033;
            font-size: 40px;
            line-height: 1;
            font-weight: 800;
        }

        .legal-stat-number span {
            color: #9aa4b2;
            font-size: 13px;
            font-weight: 500;
        }

        /* ========================================
       STATISTIC TITLE
    ======================================== */
        .legal-stat-title {
            margin-bottom: 18px;
            color: #596273;
            font-size: 15px;
            font-weight: 600;
        }

        /* ========================================
       STATISTIC LINK
    ======================================== */
        .legal-stat-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #0d6efd;
            font-size: 13px;
            font-weight: 650;
            text-decoration: none;
            transition: .2s;
        }

        .legal-stat-link i {
            transition: .2s;
        }

        .legal-stat-link:hover {
            color: #084298;
        }

        .legal-stat-link:hover i {
            transform: translateX(4px);
        }

        /* ========================================
   PRODUK HUKUM TERBARU
======================================== */

        .latest-legal-section {
            padding: 80px 0;
            background: #f8f9fa;
        }


        /* LABEL */

        .section-label {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 50px;
            background: rgba(13, 110, 253, 0.08);
            color: #0d6efd;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }


        /* JUDUL SECTION */

        .news-heading {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
        }


        /* LIST */

        .legal-document-list {
            width: 100%;
        }


        /* ========================================
   CARD
======================================== */

        .legal-document-card {
            width: 100%;
            background: #ffffff;
            border: 1px solid #e1e5ea;
            border-radius: 14px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.25s ease;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
        }


        .legal-document-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border-color: #cfd6df;
        }


        /* ========================================
   CONTENT
======================================== */

        .legal-card-content {
            padding: 22px 25px 18px;
        }


        /* ========================================
   BADGES
======================================== */

        .legal-card-badges {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }


        .legal-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            padding: 4px 10px;

            border-radius: 50px;

            font-size: 11px;
            font-weight: 600;
        }

        /* =========================
   STATUS BERLAKU
========================= */
        .legal-status-badge.status-berlaku {
            background: rgba(25, 135, 84, 0.08);
            border: 1px solid rgba(25, 135, 84, 0.25);
            color: #198754;
        }


        /* =========================
   STATUS TIDAK BERLAKU
========================= */
        .legal-status-badge.status-tidak-berlaku {
            background: rgba(220, 53, 69, 0.08);
            border: 1px solid rgba(220, 53, 69, 0.25);
            color: #dc3545;
        }


        .legal-category-badge {
            display: inline-flex;
            align-items: center;

            padding: 4px 10px;

            border-radius: 50px;

            background: #f8f9fa;
            border: 1px solid #e5e7eb;

            color: #6b7280;

            font-size: 10px;
            font-weight: 600;

            letter-spacing: 0.3px;
        }


        /* ========================================
   JUDUL
======================================== */

        .legal-document-title {
            margin: 0 0 6px;

            color: #111827;

            font-size: 18px;
            font-weight: 700;

            line-height: 1.45;
        }


        /* ========================================
   NOMOR
======================================== */

        .legal-document-number {
            color: #4b5563;

            font-size: 13px;

            margin-bottom: 6px;
        }


        .legal-document-number i {
            color: #6b7280;
        }


        /* ========================================
   TANGGAL
======================================== */

        .legal-document-date {
            display: flex;
            align-items: center;
            gap: 6px;

            color: #6b7280;

            font-size: 12px;

            margin-bottom: 8px;
        }


        .legal-document-date i {
            color: #0d6efd;
        }


        /* ========================================
   DESKRIPSI
======================================== */

        .legal-document-description {
            margin: 0;

            color: #6b7280;

            font-size: 13px;

            line-height: 1.7;

            max-width: 100%;
        }


        /* ========================================
   FOOTER CARD
======================================== */

        .legal-document-footer {
            display: flex;

            align-items: center;
            justify-content: space-between;

            padding: 14px 25px;

            border-top: 1px solid #edf0f2;

            background: #fafbfc;
        }


        /* META */

        .legal-document-meta {
            color: #6b7280;

            font-size: 12px;
        }


        .legal-document-meta i {
            margin-right: 5px;
        }


        /* ========================================
   ACTIONS
======================================== */

        .legal-document-actions {
            display: flex;

            align-items: center;

            gap: 10px;
        }


        /* DETAIL */

        .legal-detail-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            padding: 8px 15px;

            border-radius: 8px;

            border: 1px solid #d8dde3;

            background: #ffffff;

            color: #374151;

            text-decoration: none;

            font-size: 12px;
            font-weight: 600;

            transition: all 0.2s ease;
        }


        .legal-detail-btn:hover {
            background: #f1f3f5;

            color: #0d6efd;

            border-color: #0d6efd;
        }


        /* DOWNLOAD */

        .legal-download-btn {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            padding: 8px 15px;

            border-radius: 8px;

            background: #0d6efd;

            border: 1px solid #0d6efd;

            color: #ffffff;

            text-decoration: none;

            font-size: 12px;

            font-weight: 600;

            transition: all 0.2s ease;
        }


        .legal-download-btn:hover {
            background: #0b5ed7;

            border-color: #0b5ed7;

            color: #ffffff;
        }


        /* ========================================
   EMPTY STATE
======================================== */

        .legal-empty-state {
            text-align: center;

            padding: 60px 20px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 14px;
        }


        .legal-empty-icon {
            font-size: 50px;

            color: #adb5bd;

            margin-bottom: 15px;
        }


        .legal-empty-state h5 {
            font-weight: 700;

            color: #374151;
        }


        .legal-empty-state p {
            color: #6b7280;

            margin-bottom: 0;
        }

        /* ========================================
   TAUTAN WEBSITE TERKAIT
======================================== */

        .related-links-section {
            padding: 70px 0;
            background: #f8f9fa;
        }


        /* HEADER */

        .related-links-title {
            margin-bottom: 10px;
            color: #172033;
            font-size: 32px;
            font-weight: 750;
        }


        /* CARD */

        .related-link-card {
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;

            min-height: 150px;
            padding: 25px;

            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;

            text-decoration: none;

            box-shadow: 0 8px 25px rgba(15, 23, 42, .06);

            transition: all .3s ease;
        }


        .related-link-card:hover {
            transform: translateY(-6px);

            border-color: rgba(13, 110, 253, .25);

            box-shadow: 0 15px 35px rgba(15, 23, 42, .12);
        }


        /* ========================================
   LOGO
======================================== */

        .related-logo-wrapper {
            width: 95px;
            height: 95px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 8px;

            background: #ffffff;

            border-radius: 15px;

            border: 1px solid #eef1f5;
        }


        .related-logo {
            width: 80px;
            height: 80px;

            object-fit: contain;

            transition: .3s ease;
        }


        .related-link-card:hover .related-logo {
            transform: scale(1.08);
        }


        /* ========================================
   TEXT
======================================== */

        .related-link-content {
            flex: 1;
            min-width: 0;
        }


        .related-link-content h5 {
            margin: 0 0 7px;

            color: #172033;

            font-size: 16px;
            font-weight: 700;

            line-height: 1.4;
        }


        .related-link-content span {
            display: block;

            color: #6b7280;

            font-size: 12px;

            line-height: 1.5;
        }


        /* ========================================
   ARROW
======================================== */

        .related-arrow {
            position: absolute;

            top: 18px;
            right: 18px;

            color: #0d6efd;

            font-size: 16px;

            transition: .3s ease;
        }


        .related-link-card:hover .related-arrow {
            transform: translate(3px, -3px);
        }


        /* ========================================
   RESPONSIVE
======================================== */

        @media (max-width: 768px) {

            .related-links-section {
                padding: 55px 15px;
            }

            .related-links-title {
                font-size: 26px;
            }

            .related-link-card {
                min-height: 130px;
                padding: 20px;
                gap: 15px;
            }

            .related-logo-wrapper {
                width: 80px;
                height: 80px;
            }

            .related-logo {
                width: 68px;
                height: 68px;
            }

            .related-link-content h5 {
                font-size: 14px;
            }

            .related-link-content span {
                font-size: 11px;
            }

        }


        /* ========================================
   RESPONSIVE
======================================== */

        @media (max-width: 768px) {

            .latest-legal-section {
                padding: 60px 15px;
            }


            .news-heading {
                font-size: 26px;
            }


            .legal-card-content {
                padding: 20px;
            }


            .legal-document-title {
                font-size: 16px;
            }


            .legal-document-footer {
                padding: 14px 20px;

                align-items: flex-start;

                gap: 15px;

                flex-direction: column;
            }


            .legal-document-actions {
                width: 100%;
            }


            .legal-detail-btn,
            .legal-download-btn {
                flex: 1;
            }

        }

        /* ========================================
       TABLET
    ======================================== */
        @media (max-width: 991px) {
            .jdih-about {
                height: auto;
                margin-bottom: 10px;
            }

            .carousel-caption {
                width: 60%;
            }

            .latest-legal-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* ========================================
       MOBILE
    ======================================== */
        @media (max-width: 768px) {
            body {
                padding-top: 65px;
            }

            /* NAVBAR */
            .navbar-nav {
                margin-top: 10px;
                padding: 10px;
                background: #0d6efd;
                border-radius: 10px;
            }

            .navbar-nav .nav-link {
                margin-left: 0;
            }

            /* CAROUSEL */
            .carousel-img {
                height: 400px;
            }

            .carousel-caption {
                left: 5%;
                bottom: 10%;
                width: 90%;
            }

            .carousel-caption h1 {
                padding: 10px 15px;
                font-size: 28px;
            }

            /* HOME */
            .home-information {
                padding: 45px 0;
            }

            .jdih-about {
                padding: 25px;
            }

            /* BERITA */
            .latest-news-container {
                padding: 10px 18px;
            }

            .latest-news-item {
                gap: 12px;
            }

            .latest-news-image {
                width: 110px;
                height: 90px;
            }

            .latest-news-content h5 {
                font-size: 15px;
            }

            .latest-news-content p {
                display: none;
            }

            /* STATISTIK */
            .legal-statistics {
                padding: 55px 0 45px;
            }

            .legal-section-heading {
                margin-bottom: 30px;
            }

            .legal-section-heading h2 {
                font-size: 26px;
            }

            .legal-stat-card {
                min-height: auto;
                padding: 25px;
            }

            .legal-stat-number h3 {
                font-size: 34px;
            }

            /* PRODUK HUKUM */
            .latest-legal-section {
                padding: 55px 0 65px;
            }

            .latest-legal-heading {
                margin-bottom: 30px;
            }

            .latest-legal-heading h2 {
                font-size: 26px;
            }

            .latest-legal-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }


            .legal-document-card {
                padding: 24px;
            }

            .legal-document-title {
                min-height: auto;
                font-size: 16px;
            }
        }

        /* ========================================
       EXTRA SMALL MOBILE
    ======================================== */
        @media (max-width: 480px) {
            .latest-news-image {
                width: 90px;
                height: 75px;
            }

            .latest-news-content h5 {
                font-size: 14px;
            }

            .latest-news-content .home-news-date {
                font-size: 11px;
            }

            .home-news-link {
                font-size: 12px;
            }

            /* STATISTIC */
            .legal-stat-card {
                padding: 22px;
            }

            .legal-stat-icon {
                width: 52px;
                height: 52px;
            }

            .legal-stat-number h3 {
                font-size: 32px;
            }

            /* LEGAL CARD */
            .legal-card-top {
                align-items: flex-start;
            }

            .legal-document-icon {
                width: 52px;
                height: 52px;
                font-size: 23px;
            }

            .legal-document-badge {
                max-width: 150px;
                white-space: normal;
                text-align: right;
                line-height: 1.4;
            }

            .legal-document-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .legal-detail-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* ========================================
   JDIH NASIONAL
======================================== */
        .jdihn-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            transition: .3s ease;
        }

        .jdihn-logo {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .jdihn-text {
            font-size: 14px;
            font-weight: 600;
        }

        .jdihn-link:hover {
            color: #ffc107;
            transform: translateY(-2px);
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
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
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

    <!-- CAROUSEL -->
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($carousels as $key => $c)
            <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                <img src="/carousel/{{ $c->image }}"
                    class="d-block w-100 carousel-img">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <h1> {{ $c->title }} </h1>
                </div>
            </div>
            @endforeach
        </div>

        <button class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- WELCOME -->
    <section class="welcome py-5">
        <div class="container text-center">
            <h2>
                Selamat Datang di JDIH Kabupaten Toba
            </h2>
            <p class="text-muted mt-3">
                Portal resmi dokumentasi dan informasi hukum Kabupaten Toba
            </p>
        </div>
    </section>

    <!-- ========================================
     STATISTIK PRODUK HUKUM
======================================== -->
    <section class="legal-statistics">
        <div class="container">
            <div class="legal-section-heading text-center">
                <span class="section-label"> PRODUK HUKUM</span>
                <h2> Dokumentasi Hukum</h2>
                <p>
                    Akses dan temukan berbagai produk hukum
                    Pemerintah Kabupaten Toba.
                </p>
            </div>


            <div class="row g-4">
                <!-- PERATURAN DAERAH -->
                <div class="col-lg-4 col-md-6">
                    <div class="legal-stat-card">
                        <div class="legal-stat-icon">
                            <i class="bi bi-bank"></i>
                        </div>

                        <div class="legal-stat-number">
                            <h3> {{ $jumlahPeraturanDaerah }} </h3>
                            <span>Dokumen</span>
                        </div>

                        <div class="legal-stat-title"> Peraturan Daerah </div>
                        <a href="/peraturan-daerah" class="legal-stat-link">
                            Lihat Peraturan Daerah
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- PERATURAN BUPATI -->
                <div class="col-lg-4 col-md-6">
                    <div class="legal-stat-card">
                        <div class="legal-stat-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <div class="legal-stat-number">
                            <h3> {{ $jumlahPeraturanBupati }}</h3>
                            <span>Dokumen</span>
                        </div>
                        <div class="legal-stat-title"> Peraturan Bupati </div>
                        <a href="/peraturan-bupati" class="legal-stat-link">
                            Lihat Peraturan Bupati
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- KEPUTUSAN BUPATI -->
                <div class="col-lg-4 col-md-6">
                    <div class="legal-stat-card">
                        <div class="legal-stat-icon">
                            <i class="bi bi-file-earmark-check"></i>
                        </div>
                        <div class="legal-stat-number">
                            <h3> {{ $jumlahKeputusanBupati }} </h3>
                            <span>Dokumen</span>
                        </div>
                        <div class="legal-stat-title"> Keputusan Bupati </div>
                        <a href="/keputusan-bupati" class="legal-stat-link">
                            Lihat Keputusan Bupati
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURE -->
    <!-- APA ITU JDIH + BERITA TERBARU -->
    <section class="home-information py-5">
        <div class="container">
            <div class="row g-5">
                <!-- KIRI : APA ITU JDIH -->
                <div class="col-lg-5">
                    <div class="jdih-about">
                        <span class="section-label">TENTANG JDIH </span>
                        <h2>Apa itu JDIH? </h2>
                        <div class="title-line-left"></div>
                        <p>
                            Jaringan Dokumentasi dan Informasi Hukum atau JDIH
                            merupakan wadah pendayagunaan bersama atas dokumen
                            dan informasi hukum secara tertib, terpadu, dan
                            berkesinambungan.
                        </p>
                        <p>
                            JDIH Kabupaten Toba hadir untuk memberikan kemudahan
                            kepada masyarakat dalam memperoleh informasi dan
                            dokumentasi hukum yang tersedia di lingkungan
                            Pemerintah Kabupaten Toba.
                        </p>
                    </div>
                </div>

                <!-- KANAN : BERITA TERBARU -->
                <div class="col-lg-7">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <span class="section-label"> INFORMASI </span>
                            <h2 class="news-heading"> Berita Terbaru </h2>
                        </div>
                        <a href="/berita" class="btn btn-outline-primary">Lihat Semua </a>
                    </div>

                    @if($beritas->count() > 0)
                    <!-- SATU CONTAINER UNTUK SEMUA BERITA -->
                    <div class="latest-news-container">
                        @foreach($beritas as $berita)
                        <article class="latest-news-item">
                            <!-- GAMBAR -->
                            <div class="latest-news-image">
                                @if($berita->gambar)
                                <img src="{{ asset('uploads/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">

                                @else
                                <div class="latest-no-image">
                                    <i class="bi bi-image"></i>
                                </div>
                                @endif
                            </div>

                            <!-- INFORMASI BERITA -->
                            <div class="latest-news-content">
                                <div class="home-news-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $berita->created_at->format('d F Y') }}
                                </div>
                                <h5> {{ \Illuminate\Support\Str::limit($berita->judul, 80) }} </h5>
                                <p> {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 100) }} </p>
                                <a href="{{ route('berita.detail', $berita->id) }}" class="home-news-link">
                                    Baca Berita
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    @else

                    <div class="latest-news-container">
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-newspaper fs-1"></i>
                            <h5 class="mt-3"> Belum Ada Berita </h5>
                            <p class="mb-0">Belum ada berita yang dipublikasikan. </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ========================================
     PRODUK HUKUM TERBARU
======================================== -->
    <section class="latest-legal-section">

        <div class="container">

            <!-- HEADER -->
            <div class="text-center mb-5">

                <span class="section-label">
                    INFORMASI HUKUM
                </span>

                <h2 class="news-heading mb-2">
                    Produk Hukum Terbaru
                </h2>

                <p class="text-muted mb-0">
                    Informasi produk hukum terbaru yang tersedia di JDIH Kabupaten Toba
                </p>

            </div>


            @if($produkHukumTerbaru->count() > 0)

            <!-- LIST PRODUK HUKUM -->
            <div class="legal-document-list">

                @foreach($produkHukumTerbaru as $produk)

                <div class="legal-document-card">

                    <!-- =========================
                             BAGIAN ATAS
                        ========================== -->

                    <div class="legal-card-content">

                        <!-- BADGE -->
                        <div class="legal-card-badges">
                            @if($produk->status === 'BERLAKU')

                            <span class="legal-status-badge status-berlaku">
                                <i class="bi bi-check-circle"></i>
                                Berlaku
                            </span>

                            @elseif($produk->status === 'TIDAK BERLAKU')

                            <span class="legal-status-badge status-tidak-berlaku">
                                <i class="bi bi-x-circle"></i>
                                Tidak Berlaku
                            </span>


                            @else

                            <span class="legal-status-badge">
                                <i class="bi bi-question-circle"></i>
                                Belum Ditentukan
                            </span>

                            @endif

                            <span class="legal-category-badge">
                                {{ strtoupper($produk->kategori_produk) }}
                            </span>

                        </div>


                        <!-- JUDUL -->
                        <h4 class="legal-document-title">

                            {{ $produk->judul ?? 'Dokumen Hukum' }}

                        </h4>


                        <!-- NOMOR -->
                        @if(isset($produk->nomor_peraturan) && $produk->nomor_peraturan)

                        <div class="legal-document-number">

                            <i class="bi bi-hash"></i>

                            Nomor
                            {{ $produk->nomor_peraturan }}

                        </div>

                        @elseif(isset($produk->nomor) && $produk->nomor)

                        <div class="legal-document-number">

                            <i class="bi bi-hash"></i>

                            Nomor
                            {{ $produk->nomor }}

                        </div>

                        @endif


                        <!-- TANGGAL -->
                        <div class="legal-document-date">

                            <i class="bi bi-calendar3"></i>

                            {{ $produk->created_at->format('d F Y') }}

                        </div>



                    </div>


                    <!-- =========================
                             BAGIAN BAWAH
                        ========================== -->

                    <div class="legal-document-footer">

                        <div class="legal-document-meta">

                            <span>
                                <i class="bi bi-file-earmark-text"></i>
                                Dokumen Hukum
                            </span>

                        </div>


                        <div class="legal-document-actions">

                            <a
                                href="{{ $produk->url_produk }}"
                                class="legal-detail-btn">

                                Lihat Detail

                            </a>

                            @php
                            $folderProduk = match ($produk->kategori_produk) {
                            'Peraturan Daerah' => 'peraturan-daerah',
                            'Peraturan Bupati' => 'peraturan-bupati',
                            'Keputusan Bupati' => 'keputusan-bupati',
                            default => null,
                            };
                            @endphp

                            @if($produk->file_dokumen && $folderProduk)

                            <a
                                href="{{ asset('uploads/' . $folderProduk . '/' . $produk->file_dokumen) }}"
                                target="_blank"
                                class="legal-download-btn">

                                <i class="bi bi-download"></i>
                                Unduh

                            </a>

                            @endif

                        </div>

                    </div>

                </div>

                @endforeach

            </div>


            @else

            <!-- EMPTY STATE -->

            <div class="legal-empty-state">

                <div class="legal-empty-icon">

                    <i class="bi bi-file-earmark-x"></i>

                </div>

                <h5>
                    Belum Ada Produk Hukum
                </h5>

                <p>
                    Belum ada produk hukum yang dipublikasikan.
                </p>

            </div>

            @endif

        </div>

    </section>

    <!-- ========================================
     LINK WEBSITE TERKAIT
======================================== -->
    <section class="related-links-section">
        <div class="container">

            <div class="text-center mb-4">
                <span class="section-label">TAUTAN TERKAIT</span>
                <h2 class="related-links-title">
                    Website Terkait
                </h2>
                <p class="text-muted mb-0">
                    Akses berbagai layanan dan informasi resmi terkait
                </p>
            </div>

            <div class="row justify-content-center g-4">

                <!-- JDIH NASIONAL -->
                <div class="col-lg-4 col-md-6">
                    <a href="https://jdihn.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="related-link-card">

                        <div class="related-logo-wrapper">
                            <img
                                src="{{ asset('logo-jdihn.jpg') }}"
                                alt="JDIH Nasional"
                                class="related-logo">
                        </div>

                        <div class="related-link-content">
                            <h5>JDIH Nasional</h5>
                            <span>
                                Jaringan Dokumentasi dan Informasi Hukum Nasional
                            </span>
                        </div>

                        <i class="bi bi-arrow-up-right related-arrow"></i>

                    </a>
                </div>

                 <!-- JDIH Provinsi -->
                <div class="col-lg-4 col-md-6">
                    <a href="https://jdih.sumutprov.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="related-link-card">

                        <div class="related-logo-wrapper">
                            <img
                                src="{{ asset('PROVINSI.jpg') }}"
                                alt="JDIH Provinsi"
                                class="related-logo">
                        </div>

                        <div class="related-link-content">
                            <h5>JDIH Provinsi Sumatera Utara</h5>
                            <span>
                                Jaringan Dokumentasi dan Informasi Hukum Provinsi Sumatera Utara
                            </span>
                        </div>

                        <i class="bi bi-arrow-up-right related-arrow"></i>

                    </a>
                </div>

                 <!-- E-REPORT JDIH-->
                <div class="col-lg-4 col-md-6">
                    <a href="https://e-report.jdihn.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="related-link-card">

                        <div class="related-logo-wrapper">
                            <img
                                src="{{ asset('e-report.jpg') }}"
                                alt="E-REPORT JDIH"
                                class="related-logo">
                        </div>

                        <div class="related-link-content">
                            <h5>E-REPORT JDIH</h5>
                            <span>
                                Pelaporan Pengelolaan JDIH (e-Report)
                            </span>
                        </div>

                        <i class="bi bi-arrow-up-right related-arrow"></i>

                    </a>
                </div>


                <!-- PEMERINTAH KABUPATEN TOBA -->
                <div class="col-lg-4 col-md-6">
                    <a href="https://tobakab.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="related-link-card">

                        <div class="related-logo-wrapper">
                            <img
                                src="{{ asset('logo toba.png') }}"
                                alt="Pemerintah Kabupaten Toba"
                                class="related-logo">
                        </div>

                        <div class="related-link-content">
                            <h5>Pemerintah Kabupaten Toba</h5>
                            <span>
                                Website Resmi Pemerintah Kabupaten Toba
                            </span>
                        </div>

                        <i class="bi bi-arrow-up-right related-arrow"></i>

                    </a>
                </div>


                <!-- SPAN LAPOR -->
                <div class="col-lg-4 col-md-6">
                    <a href="https://span.lapor.go.id/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="related-link-card">

                        <div class="related-logo-wrapper">
                            <img
                                src="{{ asset('lapor.png') }}"
                                alt="SPAN Lapor"
                                class="related-logo">
                        </div>

                        <div class="related-link-content">
                            <h5>SPAN Lapor</h5>
                            <span>
                                Layanan Aspirasi dan Pengaduan Masyarakat
                            </span>
                        </div>

                        <i class="bi bi-arrow-up-right related-arrow"></i>

                    </a>
                </div>

            </div>
        </div>
    </section>

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