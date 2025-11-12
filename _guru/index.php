<?php
session_start();
// Pastikan hanya user dengan sesi 'guru' yang bisa mengakses
if (!isset($_SESSION['guru'])) {
    header("Location: ../index.php"); // Arahkan ke index jika sesi tidak ada (seperti Admin)
    exit();
}

// Koneksi database
include '../koneksi.php';

$sesi = $_SESSION['guru']; // Menggunakan $_SESSION['guru']
$sql = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Jurnal || Page Guru</title>
    <meta name="description" content="E-Jurnal Agenda Harian Guru Piket">
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
                <a class="navbar-brand" href="./"> E -Harian Guru</a>
                <a class="navbar-brand hidden" href="./"><img src="../images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse" style="font-family: sans-serif;">
                <ul class="nav navbar-nav">
                    <li> 
                        <br>
                        <center>
                            <img src="../images/<?php echo htmlspecialchars($data['photo']); ?>" class="img-responsive" style=" border:2px dashed silver; border-radius:100%; height: 80px;width: 80px;">
                            <p> <code><b><?php echo htmlspecialchars($data['nama_guru']); ?></b> </code> </p>
                        </center>
                    </li> 
                    <hr style="border:1px solid white; width: 100%;">
                    
                    <h3 class="menu-title">Menu Utama</h3>
                    
                    <li class="<?php echo (@$_GET['page'] == '' || @$_GET['page'] == 'cover') ? 'active' : ''; ?>">
                        <a href="?page=cover" > 
                            <i class="menu-icon fa fa-home" style="font-size: 23px;color: #40c4ff;"></i>Dashboard 
                        </a>
                    </li> 

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-calendar-check-o" style="font-size: 23px;color: #40c4ff;"></i> Tugas Piket
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-calendar" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_jadwal_saya"> Jadwal Piket Saya</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-user-plus" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_ajukan_pengganti"> Ajukan Guru Pengganti</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-user" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=t_presensi_guru"> Presensi Kehadiran</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-users" style="font-size: 23px;color:#40c4ff ;"></i> Kedisiplinan Siswa
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-file-text" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_izin_siswa"> Catat Izin Siswa</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-clock-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=v_keterlambatan"> Catat Keterlambatan</a>
                            </li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Data & Laporan</h3> 
                    
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-tasks" style="font-size: 23px;color: #40c4ff;"></i> Agenda Harian
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="menu-icon fa fa-book" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=mapel"> Mata Pelajaran</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-calendar" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=jurnal"> Agenda Pengajaran</a>
                            </li>
                            <li>
                                <i class="menu-icon fa fa-calendar-o" style="font-size: 20px;color:#f50057 ;"></i>
                                <a href="?page=aglain"> Kegiatan Lainnya</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="?page=file"> 
                            <i class="menu-icon fa fa-folder-open" style="font-size: 23px;color: #40c4ff;"></i> File Pengajaran 
                        </a>
                    </li>
                    <li>
                        <a href="?page=lap-harian"> 
                            <i class="menu-icon fa fa-print" style="font-size: 23px;color: #40c4ff;"></i> Laporan Harian 
                        </a>
                    </li>

                    <h3 class="menu-title">Pengaturan</h3> 
                    <li>
                        <a href="?page=profil"> 
                            <i class="menu-icon fa fa-cog" style="font-size: 23px;color: #40c4ff;"></i> My Profile
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
                            <img class="user-avatar rounded-circle" src="../images/<?php echo htmlspecialchars($data['photo']); ?>" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="?page=profil"><i class="fa fa-user"></i> My Profile</a>
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
                        <h1> <span class="fa fa-home"></span> Halaman Guru</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Selamat Datang <b style="color: red;"><?php echo htmlspecialchars($data['nama_guru']); ?></b></li>
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
                        // Gunakan error_reporting(0) seperti di Admin untuk konsistensi
                        error_reporting(0);
                        $page = @$_GET['page'];
                        
                        // DASHBOARD
                        if ($page == '' || $page == 'cover') {
                            include 'cover.php';
                        }
                        // PENGATURAN & ACTION
                        elseif ($page == 'profil') {
                            include 'profil.php';
                        }
                        elseif ($page == 'act') {
                            include 'proses.php'; // Halaman proses untuk aksi CRUD
                        }
                        
                        // TUGAS GURU PIKET
                        elseif ($page == 'v_jadwal_saya') {
                            include 'V-JadwalSaya.php';
                        }
                        elseif ($page == 'v_ajukan_pengganti') {
                            include 'V-AjukanPengganti.php';
                        }
                        elseif ($page == 't_ajukan_pengganti') {
                            include 'T-AjukanPengganti.php';
                        }
                        elseif ($page == 't_presensi_guru') {
                            include 'T-PresensiGuru.php'; // Tambah Presensi
                        }
                        
                        // KEDISIPLINAN SISWA
                        elseif ($page == 'v_izin_siswa') {
                            include 'V-IzinSiswa.php';
                        }
                        elseif ($page == 'v_keterlambatan') {
                            include 'V-KeterlambatanSiswa.php'; // Asumsi file yang spesifik
                        }

                        // DATA AGENDA - MATA PELAJARAN
                        elseif ($page == 'mapel') {
                            include 'V-Mapel.php';
                        }
                        // EDIT & DELETE MAPEL (Jika Guru diizinkan)
                        elseif ($page == 'edit-mapel') {
                            include 'E-Mapel.php';
                        }
                        elseif ($page == 'hapus-mapel') {
                            include 'D-Mapel.php';
                        }
                        
                        // DATA AGENDA - AGENDA PENGAJARAN (JURNAL)
                        elseif ($page == 'jurnal') {
                            include 'V-Jurnal.php';
                        }
                        elseif ($page == 'add-agenda') {
                            include 'T-Agenda.php';
                        }
                        elseif ($page == 'edit-agenda') {
                            include 'E-Agenda.php';
                        }
                        elseif ($page == 'del-agenda') {
                            include 'D-Agenda.php';
                        }
                        
                        // DATA AGENDA - KEGIATAN LAINNYA
                        elseif ($page == 'aglain') {
                            include 'V-AgendaLain.php';
                        }
                        elseif ($page == 'taglain') {
                            include 'T-AgendaLain.php';
                        }
                        elseif ($page == 'eaglain') {
                            include 'E-AgendaLain.php';
                        }
                        elseif ($page == 'daglain') {
                            include 'D-AgendaLain.php';
                        }
                        
                        // FILE PERANGKAT
                        elseif ($page == 'file') {
                            include 'V-Upload-File.php';
                        }
                        elseif ($page == 'add-file') {
                            include 'T-FilePerangkat.php';
                        }
                        elseif ($page == 'view-file') {
                            include 'Detail-File.php';
                        }
                        elseif ($page == 'del-file') {
                            include 'D-File.php';
                        }
                        
                        // LAPORAN
                        elseif ($page == 'lap-harian') {
                            include 'L-Harian.php'; // Asumsi nama file laporan harian
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
        // Script untuk Chosen Select dan DataTable
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