<?php
include '../koneksi.php';

if (isset($_POST['mapel'])) {
  $nama = $_POST['nama_mapel'];
  mysqli_query($con, " INSERT INTO tb_mastermapel (id_mMapel,mapel) VALUES ('','$nama') ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Disimapan !!');window.location='?page=v_mapel';</script> ";

}elseif (isset($_POST['emapel'])) {
    $idmap      = $_POST['idmap'];
    $nama_mapel = trim(mysqli_real_escape_string($con, $_POST['nama_mapel']));
    mysqli_query($con, "UPDATE tb_mastermapel SET mapel='$nama_mapel' WHERE id_mMapel='$idmap' ") or die(mysqli_error($con)) ;
    echo " <script>alert('Data Telah Diubah !!');
    window.location='?page=v_mapel';</script> ";

}elseif (isset($_POST['ta'])) {
      $tahun  = $_POST['tahun_ajaran'];
      $status = $_POST['status'];
      mysqli_query($con, " INSERT INTO tb_tajaran (id_tajaran,tahun_ajaran,status) VALUES ('','$tahun','$status') ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Disimapan !!');window.location='?page=v_tajaran';</script> ";

}elseif (isset($_POST['eta'])) {
      $idt    = $_POST['idt'];
      $tahun  = trim(mysqli_real_escape_string($con, $_POST['tahun_ajaran']));
      $status = trim(mysqli_real_escape_string($con, $_POST['status']));
      mysqli_query($con, "UPDATE tb_tajaran SET tahun_ajaran='$tahun',status='$status' WHERE id_tajaran='$idt' ") or die(mysqli_error($con)) ;
      echo " <script>alert('Data Berhasil Disimapan !!');
    window.location='?page=v_tajaran';</script> ";

}elseif (isset($_POST['skelas'])) {
      $kelas = $_POST['kelas'];
      mysqli_query($con, " INSERT INTO tb_kelas (idkelas,kelas) VALUES ('','$kelas') ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_kejur';</script> ";

}elseif (isset($_POST['ekelas'])) {
      $idk   = $_POST['idk'];
      $kelas = trim(mysqli_real_escape_string($con, $_POST['kelas']));
      mysqli_query($con, "UPDATE tb_kelas SET kelas='$kelas' WHERE idkelas='$idk' ") or die(mysqli_error($con)) ;
      echo " <script>alert('Data Telah Diubah !!');
    window.location='?page=v_kejur';</script> ";

}elseif (isset($_POST['sguru'])) {
      $nama_guru = $_POST['nama_guru'];
      $nip       = $_POST['nip'];
      $kelamin   = $_POST['kelamin'];
      // $mapel     = $_POST['mapel'];
      // $kelas     = $_POST['kelas'];
      $alamat    = $_POST['alamat'];
      $telp      = $_POST['telp'];
      $username  = $_POST['username'];
      $password  = $_POST['password'];
      $gelar     = $_POST['gelar'];
      $tempat    = $_POST['tempat'];
      $tgl       = $_POST['tgl'];
      $agama     = $_POST['agama'];
      $email     = $_POST['email'];
      // Untuk Gambar
      $filename  = $_FILES['photo']['name'];
      $tmp_file  = $_FILES['photo']['tmp_name'];
      $move      = move_uploaded_file($tmp_file,'../images/'.$filename);
      mysqli_query($con, " INSERT INTO tb_guru (id_guru,nama_guru,nip,kelamin,alamat,telp,username,password,gelar,tempat,tgl,agama,email,photo) VALUES ('','$nama_guru','$nip','$kelamin','$alamat','$telp','$username','$password','$gelar','$tempat','$tgl','$agama','$email','$filename') ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_guru';</script> ";

}elseif (isset($_POST['eguru'])) {
      $idg = $_POST['idg'];
      $nama_guru = $_POST['nama_guru'];
      $nip       = $_POST['nip'];
      $kelamin   = $_POST['kelamin'];
      // $mapel     = $_POST['mapel'];
      // $kelas     = $_POST['kelas'];
      $alamat    = $_POST['alamat'];
      $telp      = $_POST['telp'];
      $username  = $_POST['username'];
      $password  = $_POST['password'];
      $gelar     = $_POST['gelar'];
      $tempat    = $_POST['tempat'];
      $tgl       = $_POST['tgl'];
      $agama     = $_POST['agama'];
      $email     = $_POST['email'];

      mysqli_query($con, " UPDATE tb_guru SET nama_guru='$nama_guru',nip='$nip',kelamin='$kelamin',alamat='$alamat',telp='$telp',username='$username',password='$password',gelar='$gelar',tempat='$tempat',tgl='$tgl',agama='$agama',email='$email'
        WHERE id_guru='$idg' ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Diubah !!');window.location='?page=v_guru';</script> ";

}elseif (isset($_POST['EuserG'])) {
      $id = $_POST['id'];
      $user = $_POST['user'];
      $pass      = $_POST['pass'];

      mysqli_query($con, " UPDATE tb_guru SET username='$user',password='$pass'
        WHERE id_guru='$id' ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Diubah !!');window.location='?page=v_user';</script> ";

}elseif (isset($_POST['EuserA'])) {
      $id = $_POST['id'];
      $user = $_POST['user'];
      $pass      = $_POST['pass'];

      mysqli_query($con, " UPDATE tb_user SET username='$user',password='$pass'
        WHERE id_admin='$id' ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Diubah !!');window.location='?page=v_user';</script> ";

}elseif (isset($_POST['sUserAdmin'])) {
      $nama = $_POST['nama'];
      $user = $_POST['user'];
      $pass = $_POST['pass'];
          // Untuk Gambar
      $filename12  = $_FILES['foto12']['name'];
      $tmp_file  = $_FILES['foto12']['tmp_name'];
      $move      = move_uploaded_file($tmp_file,'../images/'.$filename12);

      mysqli_query($con, " INSERT INTO tb_user (id_admin,nama,username,password,foto) VALUES ('','$nama','$user','$pass','$filename12') ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_user';</script> ";

}elseif (isset($_POST['SKepsek'])) {
      $nama = $_POST['nama'];
      $user = $_POST['user'];
      $pass = $_POST['pass'];
      // Untuk Gambar
      $filenamek  = $_FILES['photok']['name'];
      $tmp_file  = $_FILES['photok']['tmp_name'];
      $move      = move_uploaded_file($tmp_file,'../images/'.$filenamek);

      mysqli_query($con, " INSERT INTO tb_kepsek (id_kepsek,nama,username,password,photok) VALUES ('','$nama','$user','$pass','$filenamek') ") or die(mysqli_error($con)) ;
  echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_user';</script> ";

}elseif (isset($_POST['simpan_jadwal'])) {
    // Data diambil dari form di v_jadwal_piket.php
    $id_tajaran    = trim(mysqli_real_escape_string($con, $_POST['id_tajaran']));
    $tanggal_piket = trim(mysqli_real_escape_string($con, $_POST['tanggal_piket']));
    $hari_piket    = trim(mysqli_real_escape_string($con, $_POST['hari_piket']));
    $id_guru       = trim(mysqli_real_escape_string($con, $_POST['id_guru']));
    $keterangan    = trim(mysqli_real_escape_string($con, $_POST['keterangan']));

    // Query INSERT
    mysqli_query($con, "
        INSERT INTO tb_jadwal_piket
        (id_tajaran, tanggal_piket, hari_piket, id_guru, keterangan)
        VALUES ('$id_tajaran', '$tanggal_piket', '$hari_piket', '$id_guru', '$keterangan')
    ") or die(mysqli_error($con));

    // Notifikasi dan Redirect
    echo " <script>alert('Jadwal Piket Baru Berhasil Disimpan !!');
    window.location='?page=v_jadwal_piket';</script> ";

// --- BLOK EDIT JADWAL PIKET ---
}elseif (isset($_POST['ejadwalpiket'])) {
    // Diasumsikan form edit (di file e_jadwal.php) mengirimkan data berikut:
    $id_jadwal     = trim(mysqli_real_escape_string($con, $_POST['id_jadwal'])); // ID Jadwal (Primary Key)
    $id_tajaran    = trim(mysqli_real_escape_string($con, $_POST['id_tajaran']));
    $tanggal_piket = trim(mysqli_real_escape_string($con, $_POST['tanggal_piket']));
    $hari_piket    = trim(mysqli_real_escape_string($con, $_POST['hari_piket']));
    $id_guru       = trim(mysqli_real_escape_string($con, $_POST['id_guru']));
    $keterangan    = trim(mysqli_real_escape_string($con, $_POST['keterangan']));

    // Query UPDATE
    $query_update = mysqli_query($con, "
        UPDATE tb_jadwal_piket SET
            id_tajaran      = '$id_tajaran',
            tanggal_piket   = '$tanggal_piket',
            hari_piket      = '$hari_piket',
            id_guru         = '$id_guru',
            keterangan      = '$keterangan'
        WHERE id_jadwal = '$id_jadwal'
    ");

    if ($query_update) {
        // Notifikasi dan Redirect berhasil
        echo " <script>alert('Jadwal Piket Berhasil Diubah !!');
        window.location='?page=v_jadwal_piket';</script> ";
    } else {
        // Notifikasi GAGAL dan tampilkan error
        echo " <script>alert('Jadwal Piket Gagal Diubah: " . mysqli_error($con) . "');
        window.location='?page=v_jadwal_piket';</script> ";
    }

// --- BLOK EDIT GURU PENGGANTI ---
}elseif (isset($_POST['egurupengganti'])) {

    // 1. Ambil data dari form edit
    $id_jadwal               = trim(mysqli_real_escape_string($con, $_POST['id_jadwal']));
    // Menggunakan operator null coalescing (??) atau ternary operator untuk menangani kasus input kosong
    $id_guru_pengganti       = empty($_POST['id_guru_pengganti']) ? 'NULL' : "'".trim(mysqli_real_escape_string($con, $_POST['id_guru_pengganti']))."'";
    $status_pengganti        = trim(mysqli_real_escape_string($con, $_POST['status_pengganti']));
    $catatan_penggantian     = trim(mysqli_real_escape_string($con, $_POST['catatan_penggantian']));

    // Jika id_guru_pengganti dikosongkan (diatur ke NULL), maka catatan_penggantian juga dibuat NULL
    if ($id_guru_pengganti === 'NULL') {
        $catatan_penggantian_sql = 'NULL';
        // Saat guru pengganti dikosongkan, status pengganti juga perlu disesuaikan (misal: 'Tidak')
        // Namun, jika form membiarkan user memilih status, kita ikuti inputnya.
        // Jika Anda ingin memaksa status menjadi 'Tidak' saat guru pengganti NULL, tambahkan:
        // $status_pengganti = 'Tidak';
    } else {
        $catatan_penggantian_sql = "'".$catatan_penggantian."'";
    }

    // 2. Query UPDATE
    $query_update_pengganti = mysqli_query($con, "
        UPDATE tb_jadwal_piket
        SET
            id_guru_pengganti   = $id_guru_pengganti,
            status_pengganti    = '$status_pengganti',
            catatan_penggantian = $catatan_penggantian_sql
        WHERE id_jadwal = '$id_jadwal'
    ");

    if ($query_update_pengganti) {
        // 3. Notifikasi dan Redirect
        echo "<script>alert('Data Guru Pengganti Berhasil Diubah !!');</script>";
        echo "<script>window.location='?page=v_guru_pengganti';</script>";
    } else {
         echo "<script>alert('Data Guru Pengganti GAGAL Diubah: " . mysqli_error($con) . "');</script>";
         echo "<script>window.location='?page=v_guru_pengganti';</script>";
    }

// --- START: BLOK EDIT KEHADIRAN GURU (ukehadiranguru) ---
}elseif (isset($_POST['ukehadiranguru'])) {

    // Ambil dan bersihkan data dari form
    $id_kehadiran = mysqli_real_escape_string($con, $_POST['id_kehadiran']);
    $id_guru      = mysqli_real_escape_string($con, $_POST['id_guru']);
    $tanggal      = mysqli_real_escape_string($con, $_POST['tanggal_kehadiran']);
    $status       = mysqli_real_escape_string($con, $_POST['status_kehadiran']);
    $keterangan   = mysqli_real_escape_string($con, $_POST['keterangan']);

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

    // Query UPDATE
    $update_kehadiran = mysqli_query($con, "
        UPDATE tb_kehadiran_guru SET
            id_guru = '$id_guru',
            tanggal_kehadiran = '$tanggal',
            status_kehadiran = '$status',
            waktu_masuk = $waktu_masuk_sql,
            keterangan = '$keterangan'
        WHERE id_kehadiran = '$id_kehadiran'
    "); // Menghilangkan 'or die(mysqli_error($con))' agar bisa memberikan pesan error yang lebih baik

    // Cek hasil query
    if ($update_kehadiran) {
        // Redirect dengan pesan sukses
        echo '<script>alert("Data kehadiran guru berhasil diperbarui."); window.location="?page=v_kehadiran_guru";</script>';
    } else {
        // Redirect dengan pesan gagal
        echo '<script>alert("Data kehadiran guru GAGAL diperbarui! Error: ' . mysqli_error($con) . '"); window.location="?page=e_kehadiran_guru&idk=' . $id_kehadiran . '";</script>';
    }

}
// --- BLOK INSERT DATA KETERLAMBATAN SISWA (keterlambatan_siswa) ---
elseif (isset($_POST['keterlambatan_siswa'])) {

    // 1. Ambil data dari form input (sesuai T-KeterlambatanSiswa.php)
    $id_siswa       = mysqli_real_escape_string($con, $_POST['id_siswa']);
    $tanggal        = mysqli_real_escape_string($con, $_POST['tanggal']);
    $waktu_masuk_str = mysqli_real_escape_string($con, $_POST['waktu_masuk']); // Mengambil input Waktu Masuk (HH:MM)
    $id_guru_piket  = mysqli_real_escape_string($con, $_POST['id_guru_piket']); // Ambil ID guru piket dari form
    $keterangan     = mysqli_real_escape_string($con, $_POST['keterangan']);

    // 2. Tentukan Batas Waktu Masuk Sekolah (07:00:00)
    $batas_waktu_masuk = '07:00:00';

    // 3. Konversi Waktu dan Hitung Durasi Keterlambatan (Dalam Menit)
    // Menggabungkan tanggal dan waktu untuk perhitungan yang akurat
    $waktu_masuk_siswa_dt = strtotime($tanggal . ' ' . $waktu_masuk_str);
    $batas_waktu_dt      = strtotime($tanggal . ' ' . $batas_waktu_masuk);

    // Hitung selisih hanya jika siswa masuk setelah batas waktu
    if ($waktu_masuk_siswa_dt > $batas_waktu_dt) {
        $selisih_detik = $waktu_masuk_siswa_dt - $batas_waktu_dt;
        $waktu_terlambat_menit = round($selisih_detik / 60); // Konversi ke menit
    } else {
        $waktu_terlambat_menit = 0; // Tepat Waktu atau lebih awal
    }

    // 4. Tentukan ID Guru Piket untuk disimpan
    // Jika admin memilih guru piket, gunakan ID tersebut; jika tidak, simpan sebagai NULL
    if (!empty($id_guru_piket)) {
        $id_guru_piket_sql = "'$id_guru_piket'";
        // Ambil nama guru untuk pesan konfirmasi
        $sqlGuru = mysqli_query($con, "SELECT nama_guru FROM tb_guru WHERE id_guru = '$id_guru_piket'");
        $dataGuru = mysqli_fetch_array($sqlGuru);
        $nama_guru_piket = $dataGuru['nama_guru'] ?? 'Guru Tidak Dikenal';
    } else {
        $id_guru_piket_sql = 'NULL';
        $nama_guru_piket = 'Admin'; // Gunakan 'Admin' jika tidak ada guru piket yang ditentukan
    }

    // 5. Query INSERT
    // Perhatikan: Kolom 'guru_piket' (nama) diganti menjadi 'id_guru_piket' (ID)
    $query_insert = "
        INSERT INTO tb_keterlambatan
        (id_siswa, tanggal, waktu_terlambat, keterangan, id_guru_piket)
        VALUES
        ('$id_siswa', '$tanggal', '$waktu_terlambat_menit', '$keterangan', $id_guru_piket_sql)
    ";

    mysqli_query($con, $query_insert) or die(mysqli_error($con));

    // 6. Redirect dan Tampilkan Pesan Sukses
    echo " <script>alert('Data Keterlambatan Berhasil Disimpan oleh $nama_guru_piket! Durasi: $waktu_terlambat_menit Menit.');window.location='?page=v_keterlambatan_siswa';</script> ";
}
elseif (isset($_POST['s_izin_siswa'])) {

    // 1. Ambil data dari form input (T-IzinSiswa.php)
    $id_siswa       = mysqli_real_escape_string($con, $_POST['id_siswa']);
    $tanggal_izin   = mysqli_real_escape_string($con, $_POST['tanggal_izin']);
    $jenis_izin     = mysqli_real_escape_string($con, $_POST['jenis_izin']);
    $keterangan     = mysqli_real_escape_string($con, $_POST['keterangan']);

    // Status awal selalu 'Menunggu'
    $status_izin    = 'Menunggu';
    // ID Guru Piket diisi NULL pada pengajuan awal
    $id_guru_piket_sql = 'NULL';

    // 2. Query INSERT
    $query_insert_izin = "
        INSERT INTO tb_izin_siswa
        (id_siswa, tanggal_izin, jenis_izin, keterangan, status_izin, id_guru_piket)
        VALUES
        ('$id_siswa', '$tanggal_izin', '$jenis_izin', '$keterangan', '$status_izin', $id_guru_piket_sql)
    ";

    mysqli_query($con, $query_insert_izin) or die(mysqli_error($con));

    // 3. Redirect dan Tampilkan Pesan Sukses
    echo " <script>alert('Pengajuan Izin Siswa Berhasil Disimpan! Menunggu Persetujuan.');window.location='?page=v_izin_siswa';</script> ";
}
elseif (isset($_POST['e_izin_siswa'])) {

    // 1. Ambil data dari form input (E-IzinSiswa.php)
    $id_izin        = mysqli_real_escape_string($con, $_POST['id_izin']);
    $status_izin    = mysqli_real_escape_string($con, $_POST['status_izin']);
    $catatan_proses = mysqli_real_escape_string($con, $_POST['catatan_proses']);

    // 2. Ambil ID Guru yang sedang login untuk keperluan catatan proses
    $id_user_login  = $_SESSION['admin'] ?? null; // Asumsi session admin

    // Tentukan catatan proses. Kita akan menggabungkannya dengan keterangan yang sudah ada.
    $catatan_proses_bersih = '';
    if (!empty($catatan_proses)) {
        // Format catatan baru
        $nama_pemroses = $_SESSION['nama'] ?? 'Admin';
        $waktu_proses = date('d/m/Y H:i:s');

        $catatan_baru = "\n\n--- Status Diperbarui ---\n[Oleh: $nama_pemroses pada $waktu_proses]\nCatatan: $catatan_proses";
        $catatan_proses_bersih = mysqli_real_escape_string($con, $catatan_baru);
    }

    // 3. Query UPDATE - Hanya update status dan keterangan, jangan ganti id_guru_piket
    $query_update_izin = "
        UPDATE tb_izin_siswa
        SET
            status_izin = '$status_izin',
            -- id_guru_piket tidak di-update agar tetap merujuk pada guru yang mencatat izin
            -- Menggabungkan keterangan lama dengan keterangan baru/catatan proses
            keterangan = CONCAT(keterangan, '$catatan_proses_bersih')
        WHERE
            id_izin = '$id_izin'
    ";

    mysqli_query($con, $query_update_izin) or die(mysqli_error($con));

    // 4. Redirect dan Tampilkan Pesan Sukses
    $nama_admin = $_SESSION['nama'] ?? 'Admin';
    echo " <script>alert('Status Izin Siswa Berhasil Diperbarui menjadi $status_izin oleh $nama_admin.');window.location='?page=v_izin_siswa';</script> ";
}
?>