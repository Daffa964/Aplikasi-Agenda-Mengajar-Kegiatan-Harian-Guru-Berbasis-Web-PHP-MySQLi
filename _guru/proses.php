<?php
session_start();
include '../koneksi.php';

if (isset($_POST['euser'])) {
       $id_guru = $_POST['id_guru'];
       $user = trim(mysqli_real_escape_string($con, $_POST['user']));
       $pass = trim(mysqli_real_escape_string($con, $_POST['pass']));

       mysqli_query($con, "UPDATE  tb_guru SET username='$user',password='$pass' WHERE id_guru='$id_guru' ") or die(mysqli_error($con)) ;
       echo " <script>
       alert('Data Berhasil Diubah !!');
       window.location='?page=profil';

       </script> ";
       exit();
} elseif (isset($_POST['Tmapel'])) {

    $id_guru    = mysqli_real_escape_string($con, $_POST['id_guru']);
    $nama_mapel = trim(mysqli_real_escape_string($con, $_POST['nama_mapel']));
    $jurusan    = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
    $tingkat    = trim(mysqli_real_escape_string($con, $_POST['tingkat']));
    $kelas      = trim(mysqli_real_escape_string($con, $_POST['kelas']));

    // Validasi semua field penting (tambahkan kelas juga)
    if ($nama_mapel == '' || $jurusan == '' || $tingkat == '' || $kelas == '') {
        echo "<script>
                alert('Form Isian Belum Lengkap !!');
                window.location='?page=add-mapel';
              </script>";
        exit();
    } else {
        // Asumsikan id_mapel adalah AUTO_INCREMENT, jadi jangan masukkan kolomnya
        $simpan = mysqli_query($con, "
            INSERT INTO tb_mapel (id_guru, idkelas, nama_mapel, jurusan, tingkat)
            VALUES ('$id_guru', '$kelas', '$nama_mapel', '$jurusan', '$tingkat')
        ");

        if (!$simpan) {
            // tampilkan error SQL agar jelas
            die("Error MySQL: " . mysqli_error($con));
        } else {
            echo "<script>
                    alert('Data Berhasil Disimpan !!');
                    window.location='?page=mapel';
                  </script>";
            exit();
        }
    }



}elseif (isset($_POST['Emapel'])) {
       $id = $_POST['id'];
       $nama_mapel = trim(mysqli_real_escape_string($con, $_POST['nama_mapel']));
       $jurusan = trim(mysqli_real_escape_string($con, $_POST['jurusan']));
       $tingkat = trim(mysqli_real_escape_string($con, $_POST['tingkat']));

       mysqli_query($con, "UPDATE  tb_mapel SET nama_mapel='$nama_mapel',jurusan='$jurusan',tingkat='$tingkat' WHERE id_mapel='$id' ") or die(mysqli_error($con)) ;

       echo " <script>
       alert('Data Berhasil Diubah !!');
       window.location='?page=mapel';

       </script> ";
       exit();

// Query Simapan ke tb_agenda
}elseif (isset($_POST['save-agenda'])) {

        $id_guru = $_POST['id_guru'];
        $id_mapel = $_POST['id_mapel'];
        $jam = $_POST['jam'];
        $tgl = $_POST['tgl'];
        $materi = $_POST['materi'];
        $absen = $_POST['absen'];
        $ket = $_POST['ket'];



          // simpan ke tb_agenda
     $result = mysqli_query($con, " INSERT INTO tb_agenda (id_guru,id_mapel,tgl,jam,materi,absen,ket)
      VALUES('$id_guru','$id_mapel','$tgl','$jam','$materi','$absen','$ket') ") or die(mysqli_error($con)) ;

     if($result) {
         echo "<script>
                 alert('Data Berhasil Disimpan !!');
                 window.location='?page=add-agenda&idg=".$id_mapel."';
               </script>";
         exit();
     } else {
         echo "<script>
                 alert('Gagal menyimpan data !!');
                 window.location='?page=add-agenda&idg=".$id_mapel."';
               </script>";
         exit();
     }


     // echo "
     //  <script>
     //  alert('Data Berhasil Diubah !!');
     //  window.location='?page=add-agenda&idg&=$id_mapel;

     //  </script> ";
}
// KODE BARU UNTUK PROSES AJUKAN PENGGANTI

if (isset($_POST['ajukan_pengganti'])) {

    // Ambil data dari form T-AjukanPengganti.php
    $id_jadwal = mysqli_real_escape_string($con, $_POST['id_jadwal']);
    $id_guru_pengganti = mysqli_real_escape_string($con, $_POST['id_guru_pengganti']);

    // PERBAIKAN: Ambil ID guru piket langsung dari SESSION
    // $sesi tidak terbaca di file ini, tapi $_SESSION['guru'] pasti ada.
    $id_guru_piket_login = $_SESSION['guru'];

    // Query untuk UPDATE tb_jadwal_piket - also update status_pengganti to 'Ya' to show the schedule to the substitute
    $update_query = "UPDATE tb_jadwal_piket
                     SET id_guru_pengganti = '$id_guru_pengganti',
                         status_pengganti = 'Ya'
                     WHERE id_jadwal = '$id_jadwal'";

    $result = mysqli_query($con, $update_query);

    if ($result) {
        // Jika berhasil
        echo "
            <script>
                alert('Pengajuan guru pengganti telah berhasil dikirim.');
                window.location.href = '?page=v_ajukan_pengganti';
            </script>
        ";
        exit();
    } else {
        // Jika gagal, TAMPILKAN ERROR SQL-nya
        $error_msg = mysqli_error($con);
        echo "
            <script>
                alert('GAGAL: Terjadi kesalahan database. Error: " . addslashes($error_msg) . "');
                window.location.href = '?page=v_ajukan_pengganti';
            </script>
        ";
        exit();
    }
}

// KODE BARU UNTUK PROSES INPUT KEHADIRAN GURU
if (isset($_POST['save_kehadiran_guru'])) {

    $id_guru = mysqli_real_escape_string($con, $_POST['id_guru']);
    $id_tajaran = mysqli_real_escape_string($con, $_POST['id_tajaran']);
    $tanggal = mysqli_real_escape_string($con, $_POST['tanggal_kehadiran']);
    $status = mysqli_real_escape_string($con, $_POST['status_kehadiran']);
    $keterangan = mysqli_real_escape_string($con, $_POST['keterangan']);

    // Waktu Masuk: Hanya diisi jika status Hadir atau Terlambat
    $waktu_masuk_input = $_POST['waktu_masuk'];

    // Tentukan nilai waktu_masuk untuk query SQL
    if ($status == 'Hadir' || $status == 'Terlambat') {
        // Jika status Hadir/Terlambat, gunakan waktu yang diinput, atau NULL jika kosong
        if (!empty($waktu_masuk_input)) {
             $waktu_masuk_sql = "'" . mysqli_real_escape_string($con, $waktu_masuk_input) . "'";
        } else {
             $waktu_masuk_sql = 'NULL';
        }
    } else {
        // Jika status lain (Izin, Sakit, Alpa), pastikan waktu_masuk adalah NULL
        $waktu_masuk_sql = 'NULL';
    }

    // Cek apakah sudah ada data kehadiran untuk tanggal yang sama
    $cek_kehadiran = mysqli_query($con, "SELECT id_kehadiran FROM tb_kehadiran_guru
                                         WHERE id_guru = '$id_guru'
                                         AND tanggal_kehadiran = '$tanggal'");

    if (mysqli_num_rows($cek_kehadiran) > 0) {
        // Jika sudah ada, tampilkan pesan error
        echo "
            <script>
                alert('Data kehadiran untuk tanggal ini sudah pernah diinput!');
                window.location.href = '?page=t_kehadiran';
            </script>
        ";
        exit();
    } else {
        // Insert data kehadiran ke database
        $query_simpan = mysqli_query($con, "
            INSERT INTO tb_kehadiran_guru
            (id_tajaran, id_guru, tanggal_kehadiran, status_kehadiran, waktu_masuk, keterangan)
            VALUES
            ('$id_tajaran', '$id_guru', '$tanggal', '$status', $waktu_masuk_sql, '$keterangan')
        ");

        if ($query_simpan) {
            echo "
                <script>
                    alert('Data kehadiran berhasil disimpan!');
                    window.location.href = '?page=v_kehadiran';
                </script>
            ";
            exit();
        } else {
            $error_msg = mysqli_error($con);
            echo "
                <script>
                    alert('GAGAL: Terjadi kesalahan saat menyimpan kehadiran. Error: " . addslashes($error_msg) . "');
                    window.location.href = '?page=t_kehadiran';
                </script>
            ";
            exit();
        }
    }
}

// KODE BARU UNTUK PROSES INPUT KETERLAMBATAN SISWA
elseif (isset($_POST['keterlambatan_siswa'])) {

    // 1. Ambil data dari form input (sesuai T-KeterlambatanSiswa.php)
    $id_siswa       = mysqli_real_escape_string($con, $_POST['id_siswa']);
    $tanggal        = mysqli_real_escape_string($con, $_POST['tanggal']);
    $waktu_masuk_input = mysqli_real_escape_string($con, $_POST['waktu_masuk']); // Mengambil input Waktu Masuk (HH:MM)
    $keterangan     = mysqli_real_escape_string($con, $_POST['keterangan']);

    // 2. Tentukan Batas Waktu Masuk Sekolah (07:00:00)
    $batas_waktu_masuk = '07:00:00';

    // 3. Konversi Waktu dan Hitung Durasi Keterlambatan (Dalam Menit)
    // Menggabungkan tanggal dan waktu untuk perhitungan yang akurat
    $waktu_masuk_siswa_dt = strtotime($tanggal . ' ' . $waktu_masuk_input);
    $batas_waktu_dt      = strtotime($tanggal . ' ' . $batas_waktu_masuk);

    // Hitung selisih hanya jika siswa masuk setelah batas waktu
    if ($waktu_masuk_siswa_dt > $batas_waktu_dt) {
        $selisih_detik = $waktu_masuk_siswa_dt - $batas_waktu_dt;
        $waktu_terlambat_menit = round($selisih_detik / 60); // Konversi ke menit
    } else {
        $waktu_terlambat_menit = 0; // Tepat Waktu atau lebih awal
    }

    // 4. Ambil ID Guru Piket (Sesuai perbaikan Foreign Key ke tb_guru)
    // Dari session guru yang sedang login
    $id_guru_piket = $_SESSION['guru']; // Ambil dari session guru yang login

    // Jika id_guru_piket kosong (misal: admin umum yang login), tetapkan ke NULL
    $id_guru_piket_sql = is_null($id_guru_piket) ? 'NULL' : "'".mysqli_real_escape_string($con, $id_guru_piket)."'";

    // 5. Query INSERT
    // Perhatikan: Kolom disesuaikan dengan struktur tb_keterlambatan
    $query_insert = "
        INSERT INTO tb_keterlambatan
        (id_siswa, tanggal, waktu_terlambat, keterangan, id_guru_piket)
        VALUES
        ('$id_siswa', '$tanggal', '$waktu_terlambat_menit', '$keterangan', $id_guru_piket_sql)
    ";

    $result = mysqli_query($con, $query_insert);
    if (!$result) {
        die(mysqli_error($con));
    }

    // 6. Redirect dan Tampilkan Pesan Sukses
    // Ambil nama guru dari session
    $sqlGuru = mysqli_query($con, "SELECT nama_guru FROM tb_guru WHERE id_guru = '$id_guru_piket'");
    $dataGuru = mysqli_fetch_array($sqlGuru);
    $nama_guru_piket = $dataGuru['nama_guru'] ?? 'Guru Piket'; // Gunakan nama untuk pesan

    echo " <script>alert('Data Keterlambatan Berhasil Disimpan oleh $nama_guru_piket! Durasi: $waktu_terlambat_menit Menit.');window.location='?page=v_keterlambatan_siswa';</script> ";
    exit();
}

// KODE BARU UNTUK PROSES INPUT IZIN SISWA
elseif (isset($_POST['s_izin_siswa'])) {

    // 1. Ambil data dari form input (T-IzinSiswa.php)
    $id_siswa       = mysqli_real_escape_string($con, $_POST['id_siswa']);
    $tanggal_izin   = mysqli_real_escape_string($con, $_POST['tanggal_izin']);
    $jenis_izin     = mysqli_real_escape_string($con, $_POST['jenis_izin']);
    $keterangan     = mysqli_real_escape_string($con, $_POST['keterangan']);

    // Status awal selalu 'Menunggu'
    $status_izin    = 'Menunggu';
    // ID Guru Piket diisi dengan ID guru yang sedang login
    $id_guru_piket  = $_SESSION['guru']; // Ambil dari session guru yang login
    $id_guru_piket_sql = "'".mysqli_real_escape_string($con, $id_guru_piket)."'";

    // Cek apakah sudah ada data izin untuk tanggal yang sama
    $cek_izin = mysqli_query($con, "SELECT id_izin FROM tb_izin_siswa
                                  WHERE id_siswa = '$id_siswa'
                                  AND tanggal_izin = '$tanggal_izin'");

    if (mysqli_num_rows($cek_izin) > 0) {
        // Jika sudah ada, tampilkan pesan error
        echo "
            <script>
                alert('Data izin untuk tanggal ini sudah pernah diinput!');
                window.location.href = '?page=t_izin_siswa';
            </script>
        ";
        exit();
    } else {
        // 2. Query INSERT
        $query_insert_izin = "
            INSERT INTO tb_izin_siswa
            (id_siswa, tanggal_izin, jenis_izin, keterangan, status_izin, id_guru_piket)
            VALUES
            ('$id_siswa', '$tanggal_izin', '$jenis_izin', '$keterangan', '$status_izin', $id_guru_piket_sql)
        ";

        $result = mysqli_query($con, $query_insert_izin);
        if ($result) {
            // 3. Redirect dan Tampilkan Pesan Sukses
            echo " <script>alert('Pengajuan Izin Siswa Berhasil Disimpan! Menunggu Persetujuan.');window.location='?page=v_izin_siswa';</script> ";
            exit();
        } else {
            $error_msg = mysqli_error($con);
            echo " <script>alert('GAGAL: Terjadi kesalahan saat menyimpan izin siswa. Error: " . addslashes($error_msg) . "');window.location='?page=t_izin_siswa';</script> ";
            exit();
        }
    }
}
?>
