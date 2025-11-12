<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

// Koneksi database
include '../koneksi.php';

$sesi = $_SESSION['admin'];
$sql = mysqli_query($con, "SELECT * FROM tb_user WHERE id_admin = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Jurnal || Page Administrator</title>
    <meta name="description" content="E-Jurnal || Page Administrator">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="../images/logo.jpg">

    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/scss/style.css">
    <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="../assets/css/lib/chosen/chosen.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

    <aside id="left-panel" class="left-panel" style="font-family: sans-serif;">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"> E-Harian Guru</a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse" style="font-family: sans-serif;">
                <ul class="nav navbar-nav">
                    <li> 
                        <br>
                        <center>
                            <img src="../images/<?php echo $data['foto']; ?>" class="img-responsive" style=" border:2px dashed silver; border-radius:100%; height: 80px;width: 80px;">
                            <p> <code><b><?php echo $data['nama']; ?></b> </code> </p>
                        </center>
                    </li> 
                    <hr style="border:1px solid white; width: 100%;">
                    
                    <h3 class="menu-title">Menu Utama</h3>
                    
                    <li class="<?php echo (@$_GET['page'] == '') ? 'active' : ''; ?>">
                        <a href="?page=" > 
                            <i class="menu-icon fa fa-home" style="font-size: 23px;color: #40c4ff;"></i>Dashboard 
                        </a>
                    </li> 

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-gears" style="font-size: 23px;color: #40c4ff;"></i> Data Master
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-folder-open-o" style="font-size: 20px;color: #f50057 ;"></i>
                                <a href="?page=v_mapel"> Mata Pelajaran</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-folder-open-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_tajaran"> Tahun Ajaran</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-folder-open-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_kejur"> Kelas / Jurusan</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-folder-open-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_guru"> Data Guru</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-folder-open-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_jadwal_piket"> Jadwal Piket</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-calendar-check-o" style="font-size: 23px;color: #40c4ff;"></i> Piket & Kehadiran
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-refresh" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_guru_pengganti"> Guru Pengganti</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-user" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_kehadiran_guru"> Presensi Guru</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-clock-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_keterlambatan_siswa"> Keterlambatan</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-file-text" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_izin_siswa"> Izin Siswa</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-tasks" style="font-size: 23px;color: #40c4ff;"></i> Agenda & Kegiatan
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-history" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_agenda"> History Agenda</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-database" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_lapid"> Bank Data Agenda</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-calendar-plus-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_aglain"> Agenda Lainnya</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="?page=v_file"> 
                            <i class="menu-icon fa fa-file-text-o" style="font-size: 23px;color:#40c4ff;"></i> File Perangkat 
                        </a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-line-chart" style="font-size: 23px;color: #40c4ff;"></i> Laporan
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-file-text" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_laporan_harian"> Laporan Harian</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-file-text" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_laporan_bulanan"> Laporan Bulanan</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-download" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_export_data"> Export Data</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="?page=v_user"> 
                            <i class="menu-icon fa fa-user-md" style="font-size: 23px;color:#40c4ff ;"></i> Manage User 
                        </a>
                    </li>  

                </ul>
            </div>
        </nav>
    </aside>

    <div id="right-panel" class="right-panel">

        <header id="header" class="header" style="background-color: #40c4ff ;">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../images/<?php echo $data['foto']; ?>" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="?page=profil"><i class="fa fa-user"></i> My Profile</a>
                            <hr>
                            <a class="nav-link" href="?page=profil"><i class="fa fa-cog"></i> Settings</a>
                            <hr>
                            <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1> <span class="fa fa-home"></span> Halaman Administrator</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Selamat Datang ..<b style="color: red;"><?php echo $data['nama']; ?></b></li>
                            <li class="active">Hari ini : <?php echo date("d F Y"); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12"> 
                        <?php
                        error_reporting(0);
                        $page = @$_GET['page'];
                        
                        // DASHBOARD
                        if ($page == '') {
                            include 'dashboard.php';
                        }
                        // DATA MASTER
                        elseif ($page == 'v_mapel') {
                            include 'V-Mapel.php';
                        }
                        elseif ($page == 'v_tajaran') {
                            include 'V-TAjaran.php';
                        }
                        elseif ($page == 'v_kejur') {
                            include 'V-Kejur.php';
                        }
                        elseif ($page == 'v_guru') {
                            include 'V-Guru.php';
                        }
                        // MANAJEMEN PIKET - FILE BARU
                        elseif ($page == 'v_jadwal_piket') {
                            include 'V-JadwalPiket.php';
                        }
                        elseif ($page == 'v_guru_pengganti') {
                            include 'V-GuruPengganti.php';
                        }
                        elseif ($page == 'v_kehadiran_guru') {
                            include 'V-KehadiranGuru.php';
                        }
                        elseif ($page == 'v_keterlambatan_siswa') {
                            include 'V-Keterlambatan.php';
                        }
                        elseif ($page == 'v_izin_siswa') {
                            include 'V-IzinSiswa.php';
                        }
                        // AGENDA & KEGIATAN
                        elseif ($page == 'v_agenda') {
                            include 'V-Agenda.php';
                        }
                        elseif ($page == 'v_lapid') {
                            include 'V-LaporanID.php';
                        }
                        elseif ($page == 'v_aglain') {
                            include 'V-AgendaLain.php';
                        }
                        // FILE & DOKUMEN
                        elseif ($page == 'v_file') {
                            include 'V-perangkat.php';
                        }
                        // LAPORAN - FILE BARU
                        elseif ($page == 'v_laporan_harian') {
                            include 'V-LaporanHarian.php';
                        }
                        elseif ($page == 'v_laporan_bulanan') {
                            include 'V-LaporanBulanan.php';
                        }
                        elseif ($page == 'v_export_data') {
                            include 'V-ExportData.php';
                        }
                        // MANAJEMEN USER
                        elseif ($page == 'v_user') {
                            include 'V-User.php';
                        }
                        // PENGATURAN
                        elseif ($page == 'profil') {
                            include 'profil.php';
                        }
                        // ACTION PAGES
                        elseif ($page == 'act') {
                            include 'proses.php';
                        }
                        
                        // ===================================
                        // EDIT & DELETE PAGES (JADWAL PIKET)
                        // ===================================
                        elseif ($page == 'e_jadwal') {
                            // Asumsikan nama file Edit Jadwal adalah E-JadwalPiket.php
                            include 'E-JadwalPiket.php'; 
                        }
                        elseif ($page == 'd_jadwal') {
                            // Asumsikan nama file Delete Jadwal adalah D-JadwalPiket.php
                            include 'D-JadwalPiket.php'; 
                        }
                        elseif ($page == 'e_kehadiran_guru') {
                        include 'E-KehadiranGuru.php'; 
                        }
                        elseif ($page == 'd_kehadiran_guru') {
                        include 'D-KehadiranGuru.php'; 
                        }
                        elseif ($page == 'd_keterlambatan_siswa') {
                        include 'D-KeterlambatanSiswa.php'; 
                        }
                        // ===================================

                        elseif ($page == 'e_gurupengganti') {
                        include 'E-GuruPengganti.php'; 
                        }
                        // END: TAMBAHAN KODE INI
                        elseif ($page == 'e_jadwal') {
                        include 'E-JadwalPiket.php'; 
                        }
                        
                        // EDIT & DELETE PAGES (existing)
                        elseif ($page == 'e_mapel') {
                            include 'E-Mapel.php';
                        }
                        elseif ($page == 'e_tajaran') {
                            include 'E-TAjaran.php';
                        }
                        elseif ($page == 'e_kejur') {
                            include 'E-Kejur.php';
                        }
                        elseif ($page == 'e_guru') {
                            include 'E-Guru.php';
                        }
                        elseif ($page == 'e_izin_siswa') {
                            include 'E-IzinSiswa.php';
                        }
                        elseif ($page == 'd_izin_siswa') {
                            include 'D-IzinSiswa.php';
                        }
                        elseif ($page == 'edit-agenda') {
                            include 'E-Agenda.php';
                        }
                        elseif ($page == 'eaglain') {
                            include 'E-AgendaLain.php';
                        }
                        elseif ($page == 'd_mapel') {
                            include 'D-Mapel.php';
                        }
                        elseif ($page == 'd_tajaran') {
                            include 'D-TAjaran.php';
                        }
                        elseif ($page == 'd_kejur') {
                            include 'D-Kejur.php';
                        }
                        elseif ($page == 'd_guru') {
                            include 'D-Guru.php';
                        }
                        elseif ($page == 'del-agenda') {
                            include 'D-Agenda.php';
                        }
                        elseif ($page == 'daglain') {
                            include 'D-AgendaLain.php';
                        }
                        elseif ($page == 'd_admin') {
                            include 'D-UserA.php';
                        }
                        elseif ($page == 'd_kepsek') {
                            include 'D-Kepsek.php';
                        }
                        elseif ($page == 't_guru') {
                            include 'T-Guru.php';
                        }
                        elseif ($page == 't_kehadiran_guru') {
                            include 'T-KehadiranGuru.php';
                        }
                        elseif ($page == 't_keterlambatansiswa') {
                            include 'T-KeterlambatanSiswa.php';
                        }
                        elseif ($page == 't_izin_siswa') {
                            include 'T-IzinSiswa.php';
                        }
                        elseif ($page == 'l_guru') {
                            include 'L-Guru.php';
                        }
                        elseif ($page == 'h_guru') {
                            include 'D-Guru.php';
                        }
                        elseif ($page == 'v_mapeld') {
                            include 'V-MapelID.php';
                        }
                        elseif ($page == 'v_mapelagenda') {
                            include 'V-MapelAgenda.php';
                        }
                        elseif ($page == 'v_filemapel') {
                            include 'T-FilePerangkat.php';
                        }
                        elseif ($page == 'add-file') {
                            include 'T-FilePerangkat.php';
                        }
                        elseif ($page == 'view-file') {
                            include 'Detail-File.php';
                        }
                        elseif ($page == 't_admin') {
                            include 'T-UserA.php';
                        }
                        elseif ($page == 't_kepsek') {
                            include 'T-Kepsek.php';
                        }
                        elseif ($page == 'e_user') {
                            include 'E-UserG.php';
                        }
                        elseif ($page == 'e_admin') {
                            include 'E-UserA.php';
                        }
                        // DEFAULT - HALAMAN TIDAK DITEMUKAN
                        else {
                            echo "<center> <h3><b> Maaf Halaman Tidak Tersedia !!</b></h3> </center>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/lib/data-table/datatables.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="../assets/js/lib/data-table/jszip.min.js"></script>
    <script src="../assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="../assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="../assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="../assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="../assets/js/lib/data-table/datatables-init.js"></script>
    <script src="../assets/js/lib/chosen/chosen.jquery.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Data Tidak Ada didatabase!",
                width: "100%"
            });
        });
        
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
            $('#bootstrap-data-table-export1').DataTable();
        });
    </script>

</body>
</html>