<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Agenda Harian Guru</title>
    <meta name="description" content="Aplikasi E-Jurnal Guru">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="images/logoEsaka.png">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body class="bg-dark" style="background-image: url(images/smp.jpg); background-size: cover; background-repeat: no-repeat; background-position: center center;">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content" style="background-color:rgba(0,0,0,0.6); border-radius: 20px;">
                <div class="login-logo">
                    <br>
                    <center><img src="images/logoEsaka.png" width="130" style="border-radius:100%;"></center>
                    <h2 style="color: #fff;">Aplikasi Agenda Harian Guru</h2>
                    <br> <b style="color: #fff;">SMP N 1 Kaliwungu</b>
                    <p style="color: #fff;">Kedungdowo, Kec. Kaliwungu, Kabupaten Kudus, Jawa Tengah 59361 <br> Telepon: (0291) 438068</p>
                </div>
                <div class="login-form">
                    <b>Login Aplikasi</b>
                    <hr>
                    <form method="post" action="">
                        <div class="form-group">
                            <input type="text" name="user" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <select name="level" class="form-control" required>
                                <option value="admin">Administrator</option>
                                <option value="guru">Guru</option>
                                <option value="kepsek">Kepala Sekolah</option>
                            </select>
                        </div>
                        <input type="submit" name="login" class="btn btn-primary btn-flat m-b-30 m-t-30" value="Login" style="background-color:#40c4ff;">
                    </form>

<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $user = trim(mysqli_real_escape_string($con, $_POST['user']));
    $pass = trim(mysqli_real_escape_string($con, $_POST['pass']));
    $level = trim(mysqli_real_escape_string($con, $_POST['level']));

    if ($level == 'admin') {
        $sql = mysqli_query($con, "SELECT * FROM tb_user WHERE username ='$user' AND password='$pass'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql);
        $cek = mysqli_num_rows($sql);

        if ($cek > 0) {
            $_SESSION['admin'] = $data['id_admin']; // Sesuaikan nama field id user
            echo "<script>
                alert('Login Admin Berhasil');
                window.location.href = '_admin/';
            </script>";
            exit;
        } else {
            echo "<div class='alert alert-danger alert-dismissible' style='background-color:red; color:white;'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h5 class='text-center'><i class='glyphicon glyphicon-ban-circle'></i> Gagal Login !!</h5>
                <p class='text-center'>Username / Password Tidak Valid !!</p>
                </div>";
        }
    } elseif ($level == 'guru') {
        $sql = mysqli_query($con, "SELECT * FROM tb_guru WHERE username ='$user' AND password='$pass'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql);
        $cek = mysqli_num_rows($sql);

        if ($cek > 0) {
            $_SESSION['guru'] = $data['id_guru']; // Sesuaikan nama field id user
            echo "<script>
                alert('Login Guru Berhasil');
                window.location.href = '_guru/';
            </script>";
            exit;
        } else {
            echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4 class='text-center'><i class='glyphicon glyphicon-ban-circle'></i> Gagal Login !!</h4>
                <p class='text-center'>Username / Password Tidak Valid !!</p>
                </div>";
        }
    } elseif ($level == 'kepsek') {
        $sql = mysqli_query($con, "SELECT * FROM tb_kepsek WHERE username ='$user' AND password='$pass'") or die(mysqli_error($con));
        $data = mysqli_fetch_array($sql);
        $cek = mysqli_num_rows($sql);

        if ($cek > 0) {
            $_SESSION['kepsek'] = $data['id_kepsek']; // Sesuaikan nama field id user
            echo "<script>
                alert('Login Kepala Sekolah Berhasil');
                window.location.href = '_kepsek/';
            </script>";
            exit;
        } else {
            echo "<div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4 class='text-center'><i class='glyphicon glyphicon-ban-circle'></i> Gagal Login !!</h4>
                <p class='text-center'>Username / Password Tidak Valid !!</p>
                </div>";
        }
    }
}
?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
