<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - SMP Negeri 1 Kaliwungu</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="images/logoEsaka.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary-color: #0066cc;
            --secondary-color: #ff6600;
            --accent-color: #2c3e50;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --gray-color: #6c757d;
            --light-gray: #e9ecef;
        }

        body {
            font-family: 'Open Sans', Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
        }
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
        }
        .navbar.scrolled {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px;
            border-radius: 4px;
        }
        .nav-link {
            position: relative;
            padding: 10px 15px !important;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white !important;
        }
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            height: 3px;
            background-color: var(--secondary-color);
        }
        .btn-custom {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #e65c00;
            border-color: #e65c00;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 102, 0, 0.3);
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/sekolah-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0 100px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 40%, rgba(255, 102, 0, 0.1) 100%);
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
        .section {
            padding: 80px 0;
        }
        .section-title {
            position: relative;
            margin-bottom: 50px;
            text-align: center;
        }
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 15px;
            font-weight: 700;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            background-color: white;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }
        .card .card-body {
            padding: 30px;
        }
        .feature-icon {
            font-size: 3.5em;
            margin-bottom: 20px;
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
        }
        .feature-icon.bg-primary-light {
            background-color: rgba(0, 123, 255, 0.1);
            color: var(--primary-color);
        }
        .feature-icon.bg-success-light {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }
        .feature-icon.bg-info-light {
            background-color: rgba(23, 162, 184, 0.1);
            color: var(--info-color);
        }
        .feature-icon.bg-warning-light {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }
        .feature-icon.bg-danger-light {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }
        .feature-icon.bg-secondary-light {
            background-color: rgba(108, 117, 125, 0.1);
            color: var(--gray-color);
        }
        .footer {
            background: linear-gradient(135deg, var(--accent-color), #1a1e24);
            color: white;
            padding: 60px 0 20px;
            margin-top: 50px;
        }
        .footer a {
            color: #adb5bd;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer a:hover {
            color: white;
        }
        .footer h5 {
            color: white;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--secondary-color);
        }
        .social-icons {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            transition: all 0.3s ease;
        }
        .social-icons a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }
        .about-image {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        .about-image img {
            transition: transform 0.5s ease;
        }
        .about-image:hover img {
            transform: scale(1.05);
        }
        .info-card {
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-color);
            padding-left: 20px;
        }
        .testimonial-section {
            background-color: var(--light-color);
            padding: 60px 0;
        }
        .testimonial-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            margin: 20px;
        }
        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 4rem;
            color: var(--light-gray);
            font-family: Georgia, serif;
            line-height: 1;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .counter-section {
            background: linear-gradient(135deg, var(--primary-color), #004a99);
            color: white;
            padding: 50px 0;
        }
        .counter-box {
            text-align: center;
            padding: 20px;
        }
        .counter-box h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .counter-box p {
            font-size: 1.1rem;
            margin: 0;
        }
        .highlight-section {
            background-color: white;
        }
        .section-subtitle {
            text-align: center;
            color: var(--gray-color);
            margin-bottom: 40px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/logo-smp.png" width="45" height="45" class="d-inline-block align-top" alt="Logo">
                SMP Negeri 1 Kaliwungu
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fa fa-home mr-1"></i> Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang"><i class="fa fa-info-circle mr-1"></i> Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur"><i class="fa fa-cube mr-1"></i> Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak"><i class="fa fa-phone mr-1"></i> Kontak</a>
                    </li>
                    <li class="nav-item ml-2">
                        <a class="nav-link btn btn-custom" href="login.php"><i class="fa fa-sign-in mr-1"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 mb-3 animate__animated animate__fadeInDown">Selamat Datang di SMP Negeri 1 Kaliwungu</h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">Sistem Informasi Jurnal Pembelajaran dan Kegiatan Guru Berbasis Web</p>
                    <div class="animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                        <a href="login.php" class="btn btn-light btn-lg mr-2">Masuk ke Sistem <i class="fa fa-sign-in ml-1"></i></a>
                        <a href="#fitur" class="btn btn-custom btn-lg">Pelajari Fitur <i class="fa fa-arrow-down ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Sekolah -->
    <section id="tentang" class="section highlight-section">
        <div class="container">
            <div class="section-title animate__animated animate__fadeInUp">
                <h2>Tentang SMP Negeri 1 Kaliwungu</h2>
                <p class="section-subtitle">Sejarah dan Identitas Sekolah Kami</p>
            </div>
            <div class="row align-items-center animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="about-image">
                        <img src="images/logo-smp.png" alt="SMP Negeri 1 Kaliwungu" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-4">
                        <h4 class="mb-4 animate__animated animate__fadeInRight"><i class="fa fa-history text-primary mr-2"></i>Sejarah Singkat</h4>
                        <p class="animate__animated animate__fadeInRight" style="animation-delay: 0.2s;">SMP Negeri 1 Kaliwungu berdiri sejak tahun 1985 dan telah menjadi lembaga pendidikan yang terpercaya dalam membentuk karakter dan meningkatkan kualitas pendidikan di wilayah Kaliwungu, Kudus.</p>
                        <p class="animate__animated animate__fadeInRight" style="animation-delay: 0.3s;">Dengan komitmen terhadap pendidikan yang berkualitas, kami terus berupaya memberikan pelayanan pendidikan terbaik bagi peserta didik.</p>

                        <h4 class="mt-4 mb-3 animate__animated animate__fadeInRight" style="animation-delay: 0.4s;"><i class="fa fa-eye text-info mr-2"></i>Visi & Misi</h4>
                        <div class="info-card animate__animated animate__fadeInRight" style="animation-delay: 0.5s;">
                            <h5>Visi:</h5>
                            <p class="mb-0"><strong>Menjadi sekolah unggulan yang berprestasi, berbudi luhur, dan berwawasan lingkungan.</strong></p>
                        </div>
                        <div class="info-card animate__animated animate__fadeInRight" style="animation-delay: 0.6s;">
                            <h5>Misi:</h5>
                            <p class="mb-0"><strong>Menyelenggarakan pendidikan yang bermutu, mencetak lulusan yang beriman, bertakwa, dan berakhlak mulia.</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Sistem -->
    <section id="fitur" class="section bg-light">
        <div class="container">
            <div class="section-title animate__animated animate__fadeInUp">
                <h2>Fitur Sistem Jurnal Guru</h2>
                <p class="section-subtitle">Fitur Lengkap untuk Manajemen Kegiatan Pembelajaran</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature-icon bg-primary-light">
                                <i class="fa fa-book"></i>
                            </div>
                            <h5 class="mt-3 mb-3">Pencatatan Agenda</h5>
                            <p>Catatan harian kegiatan pembelajaran dan non pembelajaran secara digital yang memudahkan monitoring kegiatan guru.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature-icon bg-success-light">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <h5 class="mt-3 mb-3">Jadwal Piket</h5>
                            <p>Pengelolaan jadwal piket mingguan dan harian guru secara efektif dengan sistem notifikasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature-icon bg-info-light">
                                <i class="fa fa-file-text"></i>
                            </div>
                            <h5 class="mt-3 mb-3">Laporan Harian</h5>
                            <p>Pembuatan laporan harian kegiatan sekolah dengan cepat dan akurat untuk kebutuhan administrasi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.5s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature-icon bg-warning-light">
                                <i class="fa fa-users"></i>
                            </div>
                            <h5 class="mt-3 mb-3">Presensi Guru</h5>
                            <p>Pencatatan kehadiran guru dan pengelolaan data presensi dengan sistem absensi digital.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature-icon bg-danger-light">
                                <i class="fa fa-file-pdf-o"></i>
                            </div>
                            <h5 class="mt-3 mb-3">Cetak Laporan</h5>
                            <p>Mencetak berbagai laporan dalam format PDF untuk arsip dan dokumentasi resmi sekolah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.7s;">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="feature-icon bg-secondary-light">
                                <i class="fa fa-database"></i>
                            </div>
                            <h5 class="mt-3 mb-3">Manajemen Data</h5>
                            <p>Pengelolaan data guru, mata pelajaran, dan kelas secara terintegrasi dan mudah diakses.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Counter Section -->
    <section class="counter-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4 mb-md-0 animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                    <div class="counter-box">
                        <h3><i class="fa fa-graduation-cap mr-2"></i>800+</h3>
                        <p>Siswa</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0 animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                    <div class="counter-box">
                        <h3><i class="fa fa-user mr-2"></i>45+</h3>
                        <p>Guru</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
                    <div class="counter-box">
                        <h3><i class="fa fa-building mr-2"></i>24</h3>
                        <p>Rombel</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                    <div class="counter-box">
                        <h3><i class="fa fa-trophy mr-2"></i>25+</h3>
                        <p>Prestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Sekolah -->
    <section class="section">
        <div class="container">
            <div class="section-title animate__animated animate__fadeInUp">
                <h2>Informasi Sekolah</h2>
                <p class="section-subtitle">Data dan Kontak SMP Negeri 1 Kaliwungu</p>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 animate__animated animate__fadeInLeft" style="animation-delay: 0.2s;">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-map-marker text-primary mr-2"></i>Alamat Sekolah</h5>
                            <p class="card-text">Jl. Raya Kedungdowo No. 1, Kaliwungu, Kabupaten Kudus, Jawa Tengah 59361</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 animate__animated animate__fadeInRight" style="animation-delay: 0.3s;">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-phone text-success mr-2"></i>Kontak Kami</h5>
                            <p class="card-text">Telp: (0291) 438068<br>Email: smpn1kaliwungu.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6 mb-4 animate__animated animate__fadeInLeft" style="animation-delay: 0.4s;">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-users text-info mr-2"></i>Jumlah Siswa</h5>
                            <p class="card-text">Saat ini SMP Negeri 1 Kaliwungu memiliki sekitar 800 siswa yang terbagi dalam 24 rombongan belajar.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 animate__animated animate__fadeInRight" style="animation-delay: 0.5s;">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-user text-warning mr-2"></i>Jumlah Guru</h5>
                            <p class="card-text">Sekolah kami didukung oleh 45 tenaga pendidik yang profesional dan berpengalaman.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5><i class="fa fa-school text-warning mr-2"></i> SMP Negeri 1 Kaliwungu</h5>
                    <p>Sistem Informasi Jurnal Pembelajaran dan Kegiatan Guru Berbasis Web</p>
                    <p>Meningkatkan kualitas pendidikan melalui dokumentasi kegiatan pembelajaran yang efektif dan efisien.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Tautan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-light"><i class="fa fa-chevron-right mr-2"></i> Beranda</a></li>
                        <li class="mb-2"><a href="#tentang" class="text-light"><i class="fa fa-chevron-right mr-2"></i> Tentang Kami</a></li>
                        <li class="mb-2"><a href="#fitur" class="text-light"><i class="fa fa-chevron-right mr-2"></i> Fitur Sistem</a></li>
                        <li class="mb-2"><a href="#kontak" class="text-light"><i class="fa fa-chevron-right mr-2"></i> Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5>Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fa fa-map-marker mr-2"></i> Kedungdowo, Kaliwungu, Kudus</li>
                        <li class="mb-2"><i class="fa fa-phone mr-2"></i> (0291) 438068</li>
                        <li class="mb-2"><i class="fa fa-envelope mr-2"></i> smpn1kaliwungu.sch.id</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Jam Operasional</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fa fa-clock-o mr-2"></i> Senin - Jumat</li>
                        <li class="mb-2">07:00 - 15:00 WIB</li>
                        <li class="mb-2"><i class="fa fa-clock-o mr-2"></i> Sabtu</li>
                        <li class="mb-2">07:00 - 12:00 WIB</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4 bg-secondary">
            <div class="text-center">
                <p>&copy; 2025 SMP Negeri 1 Kaliwungu. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth scrolling for navigation links
        $(document).ready(function() {
            // Smooth scrolling for all anchor links
            $("a[href^='#']").on('click', function(event) {
                if (this.pathname === window.location.pathname) {
                    var target = $(this.getAttribute("href"));
                    if (target.length) {
                        event.preventDefault();
                        var offset = target.offset().top - 70; // Adjust for fixed navbar
                        $('html, body').animate({
                            scrollTop: offset
                        }, 800);
                    }
                }
            });

            // Add scroll effect to navbar
            $(window).scroll(function() {
                if ($(document).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });

            // Animation on scroll
            function animateOnScroll() {
                $('.card, .about-image, .counter-box').each(function() {
                    var imagePos = $(this).offset().top;
                    var topOfWindow = $(window).scrollTop();
                    var windowHeight = $(window).height();

                    if (imagePos < topOfWindow + windowHeight - 100) {
                        $(this).addClass('animate__animated animate__fadeInUp');
                    }
                });
            }

            // Initialize animations on page load
            animateOnScroll();

            // Trigger animations on scroll
            $(window).scroll(function() {
                animateOnScroll();
            });
        });
    </script>
</body>
</html>