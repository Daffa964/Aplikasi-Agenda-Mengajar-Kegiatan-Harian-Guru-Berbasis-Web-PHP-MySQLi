<?php
include '../koneksi.php';

if (isset($_POST['mapel'])) {
    $nama = $_POST['nama_mapel'];
    mysqli_query($con, " INSERT INTO tb_mastermapel (id_mMapel,mapel) VALUES ('','$nama') ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimapan !!');window.location='?page=v_mapel';</script> ";
} elseif (isset($_POST['Emapel'])) {
    $id         = $_POST['id'];
    $nama_mapel = mysqli_real_escape_string($con, $_POST['nama_mapel']);
    $idkelas    = $_POST['idkelas'];
    $tingkat    = $_POST['tingkat'];
    $jurusan    = '-'; // Default strip karena SMP/MTS tidak ada jurusan

    // Query Update
    $update = mysqli_query($con, "UPDATE tb_mapel SET 
        nama_mapel = '$nama_mapel',
        idkelas    = '$idkelas',
        tingkat    = '$tingkat',
        jurusan    = '$jurusan'
        WHERE id_mapel = '$id'
    ");

    if ($update) {
        echo "<script>alert('Data Berhasil Diubah !!'); window.location='index.php?page=v_mapel';</script>";
    } else {
        echo "<script>alert('Gagal Mengubah Data: " . mysqli_error($con) . "'); window.location='index.php?page=v_mapel';</script>";
    }
} elseif (isset($_POST['ta'])) {
    $tahun  = $_POST['tahun_ajaran'];
    $status = $_POST['status'];
    mysqli_query($con, " INSERT INTO tb_tajaran (id_tajaran,tahun_ajaran,status) VALUES ('','$tahun','$status') ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimapan !!');window.location='?page=v_tajaran';</script> ";
} elseif (isset($_POST['eta'])) {
    $idt    = $_POST['idt'];
    $tahun  = trim(mysqli_real_escape_string($con, $_POST['tahun_ajaran']));
    $status = trim(mysqli_real_escape_string($con, $_POST['status']));
    mysqli_query($con, "UPDATE tb_tajaran SET tahun_ajaran='$tahun',status='$status' WHERE id_tajaran='$idt' ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimapan !!');
    window.location='?page=v_tajaran';</script> ";
} elseif (isset($_POST['skelas'])) {
    $kelas = $_POST['kelas'];
    mysqli_query($con, " INSERT INTO tb_kelas (idkelas,kelas) VALUES ('','$kelas') ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_kejur';</script> ";
} elseif (isset($_POST['ekelas'])) {
    $idk   = $_POST['idk'];
    $kelas = trim(mysqli_real_escape_string($con, $_POST['kelas']));
    mysqli_query($con, "UPDATE tb_kelas SET kelas='$kelas' WHERE idkelas='$idk' ") or die(mysqli_error($con));
    echo " <script>alert('Data Telah Diubah !!');
    window.location='?page=v_kejur';</script> ";
} elseif (isset($_POST['sguru'])) {
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
    $move      = move_uploaded_file($tmp_file, '../images/' . $filename);
    mysqli_query($con, " INSERT INTO tb_guru (id_guru,nama_guru,nip,kelamin,alamat,telp,username,password,gelar,tempat,tgl,agama,email,photo) VALUES ('','$nama_guru','$nip','$kelamin','$alamat','$telp','$username','$password','$gelar','$tempat','$tgl','$agama','$email','$filename') ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_guru';</script> ";
} elseif (isset($_POST['eguru'])) {
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
        WHERE id_guru='$idg' ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Diubah !!');window.location='?page=v_guru';</script> ";
} elseif (isset($_POST['EuserG'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $pass      = $_POST['pass'];

    mysqli_query($con, " UPDATE tb_guru SET username='$user',password='$pass'
        WHERE id_guru='$id' ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Diubah !!');window.location='?page=v_user';</script> ";
} elseif (isset($_POST['EuserA'])) {
    $id = $_POST['id'];
    $user = $_POST['user'];
    $pass      = $_POST['pass'];

    mysqli_query($con, " UPDATE tb_user SET username='$user',password='$pass'
        WHERE id_admin='$id' ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Diubah !!');window.location='?page=v_user';</script> ";
} elseif (isset($_POST['sUserAdmin'])) {
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    // Untuk Gambar
    $filename12  = $_FILES['foto12']['name'];
    $tmp_file  = $_FILES['foto12']['tmp_name'];
    $move      = move_uploaded_file($tmp_file, '../images/' . $filename12);

    mysqli_query($con, " INSERT INTO tb_user (id_admin,nama,username,password,foto) VALUES ('','$nama','$user','$pass','$filename12') ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_user';</script> ";
} elseif (isset($_POST['SKepsek'])) {
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    // Untuk Gambar
    $filenamek  = $_FILES['photok']['name'];
    $tmp_file  = $_FILES['photok']['tmp_name'];
    $move      = move_uploaded_file($tmp_file, '../images/' . $filenamek);

    mysqli_query($con, " INSERT INTO tb_kepsek (id_kepsek,nama,username,password,photok) VALUES ('','$nama','$user','$pass','$filenamek') ") or die(mysqli_error($con));
    echo " <script>alert('Data Berhasil Disimpan !!');window.location='?page=v_user';</script> ";
} elseif (isset($_POST['simpan_jadwal'])) {
    // 1. Ambil Data
    $id_tajaran    = trim(mysqli_real_escape_string($con, $_POST['id_tajaran']));
    $tanggal_piket = trim(mysqli_real_escape_string($con, $_POST['tanggal_piket']));
    $hari_piket    = trim(mysqli_real_escape_string($con, $_POST['hari_piket']));
    $id_guru       = trim(mysqli_real_escape_string($con, $_POST['id_guru']));
    $keterangan    = trim(mysqli_real_escape_string($con, $_POST['keterangan']));

    // 2. Query Insert
    $insert = mysqli_query($con, "
        INSERT INTO tb_jadwal_piket 
        (id_tajaran, tanggal_piket, hari_piket, id_guru, keterangan)
        VALUES ('$id_tajaran', '$tanggal_piket', '$hari_piket', '$id_guru', '$keterangan')
    ");

    if ($insert) {
        echo " <script>alert('Jadwal Piket Baru Berhasil Disimpan !!');
            window.location='index.php?page=v_jadwal_piket';
        </script> ";
    } else {
        echo " <script>
            alert('Gagal Menyimpan: " . mysqli_error($con) . "');
            window.location='index.php?page=add-jadwal';
        </script> ";
    }

    // --- TAMBAH MAPEL (ADMIN) ---
} elseif (isset($_POST['Tmapel'])) {
    $nama_mapel = mysqli_real_escape_string($con, $_POST['nama_mapel']);
    $idkelas    = $_POST['idkelas'];
    $id_guru    = $_POST['id_guru'];
    $tingkat    = $_POST['tingkat'];
    $jurusan    = '-';

    $save = mysqli_query($con, "INSERT INTO tb_mapel (nama_mapel, idkelas, id_guru, tingkat, jurusan) VALUES ('$nama_mapel', '$idkelas', '$id_guru', '$tingkat', '$jurusan')");

    if ($save) {
        echo "<script>alert('Mata Pelajaran Berhasil Ditambahkan!'); window.location='index.php?page=v_mapel';</script>";
    } else {
        echo "<script>alert('Gagal Menambahkan!'); window.location='index.php?page=add-mapel';</script>";
    }

    // --- BLOK EDIT JADWAL PIKET ---
} elseif (isset($_POST['ejadwalpiket'])) {
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
} elseif (isset($_POST['egurupengganti'])) {

    $id_jadwal           = trim(mysqli_real_escape_string($con, $_POST['id_jadwal']));
    // Cek jika id_guru_pengganti kosong
    $id_guru_pengganti   = empty($_POST['id_guru_pengganti']) ? 'NULL' : "'" . trim(mysqli_real_escape_string($con, $_POST['id_guru_pengganti'])) . "'";
    $status_pengganti    = trim(mysqli_real_escape_string($con, $_POST['status_pengganti']));
    $catatan_penggantian = trim(mysqli_real_escape_string($con, $_POST['catatan_penggantian']));

    // Jika ditolak/tidak ada pengganti, kosongkan catatan querynya
    if ($id_guru_pengganti === 'NULL') {
        $catatan_sql = 'NULL';
    } else {
        $catatan_sql = "'" . $catatan_penggantian . "'";
    }

    // Query Update
    $query = mysqli_query($con, "UPDATE tb_jadwal_piket SET 
        id_guru_pengganti   = $id_guru_pengganti,
        status_pengganti    = '$status_pengganti',
        catatan_penggantian = $catatan_sql
        WHERE id_jadwal     = '$id_jadwal'
    ");

    if ($query) {
        echo "<script>
                alert('Data Guru Pengganti Berhasil Disimpan!');
                // Pastikan ada 'index.php' di depannya
                window.location='index.php?page=v_guru_pengganti'; 
              </script>";
    } else {
        echo "<script>
                alert('Gagal Menyimpan: " . mysqli_error($con) . "');
                window.location='index.php?page=v_guru_pengganti';
              </script>";
    }

    // --- START: BLOK EDIT KEHADIRAN GURU (ukehadiranguru) ---
} elseif (isset($_POST['ukehadiranguru'])) {

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
} elseif (isset($_POST['s_izin_siswa'])) {

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
} elseif (isset($_POST['e_izin_siswa'])) {

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
// --- PROSES ADMIN MENYETUJUI GURU PENGGANTI ---
elseif (isset($_POST['approve_pengganti'])) {
    $id_jadwal = $_POST['id_jadwal'];

    // Update status menjadi Disetujui
    $update = mysqli_query($con, "UPDATE tb_jadwal_piket SET status_pengganti='Disetujui' WHERE id_jadwal='$id_jadwal'");

    if ($update) {
        // PERHATIKAN: window.location harus ke 'index.php?page=v_guru_pengganti'
        echo "<script>
                alert('Pengajuan Disetujui!');
                window.location='index.php?page=v_guru_pengganti';
              </script>";
    } else {
        echo "<script>
                alert('Gagal Mengupdate: " . mysqli_error($con) . "');
                window.location='index.php?page=v_guru_pengganti';
              </script>";
    }
}
if (isset($_POST['simpan_agenda_lain'])) {
    $tanggal       = mysqli_real_escape_string($con, $_POST['tanggal']);
    $nama_kegiatan = mysqli_real_escape_string($con, $_POST['nama_kegiatan']);
    $id_guru       = mysqli_real_escape_string($con, $_POST['id_guru']);
    $jam_mulai     = mysqli_real_escape_string($con, $_POST['jam_mulai']);
    $jam_selesai   = mysqli_real_escape_string($con, $_POST['jam_selesai']);
    $keterangan    = mysqli_real_escape_string($con, $_POST['keterangan']);

    // Jika id_guru adalah 0 (kegiatan umum), kita tetap simpan
    if($id_guru == '0') {
        $id_guru = 0; // Tidak ada guru khusus
    }

    $save = mysqli_query($con, "INSERT INTO tb_agenda_lain
        (id_guru, nama_kegiatan, tanggal, jam_mulai, jam_selesai, keterangan)
        VALUES ('$id_guru', '$nama_kegiatan', '$tanggal', '$jam_mulai', '$jam_selesai', '$keterangan')");

    if ($save) {
        echo "<script>
            alert('Data Kegiatan Berhasil Disimpan');
            window.location='index.php?page=v_aglain';
        </script>";
    } else {
        echo "<script>
            alert('Gagal Menyimpan Data: " . mysqli_error($con) . "');
            window.location='?page=add-agenda-lain';
        </script>";
    }
}

elseif (isset($_POST['upload_guru_csv'])) {
    if ($_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error saat upload file. Pastikan file terupload dengan benar.'); window.history.back();</script>";
        exit();
    }

    $file_path = $_FILES['csv_file']['tmp_name'];
    $file_handle = fopen($file_path, "r");
    $delimiter = ';'; // Delimiter titik koma (;)
    
    // Lewati baris header
    fgetcsv($file_handle, 1000, $delimiter);

    $success_count = 0;
    $update_count = 0;
    $insert_count = 0;
    $error_count = 0;
    $error_messages = [];

    // Looping membaca data baris per baris
    while (($data = fgetcsv($file_handle, 1000, $delimiter)) !== FALSE) {
        // Cek apakah jumlah kolom minimal 8 (untuk id_guru hingga password)
        if (count($data) < 8) {
            $error_count++;
            $error_messages[] = "Baris data tidak lengkap (Kolom kurang dari 8). Data: " . implode(', ', $data);
            continue;
        }

        // --- Mapping Kolom CSV ke Kolom DB yang ada ---
        $id_guru       = mysqli_real_escape_string($con, $data[0]);   // Kolom 1 CSV -> id_guru (DB)
        $nama_guru     = mysqli_real_escape_string($con, $data[3]);   // Kolom 4 CSV -> nama_guru (DB)
        $nip           = mysqli_real_escape_string($con, $data[4]);   // Kolom 5 CSV -> nip (DB)
        $username      = mysqli_real_escape_string($con, $data[5]);   // Kolom 6 CSV -> username (DB)
        $password      = mysqli_real_escape_string($con, $data[7]);   // Kolom 8 CSV -> password (DB)
        
        // Kolom CSV yang diabaikan: kode_sekolah (index 1), kode_guru (index 2), pass (index 6), penugasan (index 8).

        if (empty($id_guru)) {
            $error_count++;
            $error_messages[] = "Baris dilewati karena ID Guru kosong.";
            continue;
        }

        // Cek apakah id_guru sudah ada di database
        $check = mysqli_query($con, "SELECT id_guru FROM tb_guru WHERE id_guru='$id_guru'");
        
        // Kolom DB yang TIDAK ADA di CSV (kelamin, alamat, telp, gelar, tempat, tgl, agama, email, photo)
        // Kolom ini akan menggunakan nilai DEFAULT/NULL yang sudah disetel di DB.

        $columns_to_update = "
            nama_guru='$nama_guru',
            nip='$nip',
            username='$username',
            password='$password'
        ";
        
        if (mysqli_num_rows($check) > 0) {
            // Data sudah ada, lakukan UPDATE
            $query = "UPDATE tb_guru SET 
                $columns_to_update
                WHERE id_guru='$id_guru'";
            $update_count++;
        } else {
            // Data belum ada, lakukan INSERT
            $query = "INSERT INTO tb_guru 
                (id_guru, nama_guru, nip, username, password) 
                VALUES 
                ('$id_guru', '$nama_guru', '$nip', '$username', '$password')";
            $insert_count++;
        }

        $result = mysqli_query($con, $query);
        
        if ($result) {
            $success_count++;
        } else {
            $error_count++;
            $error_messages[] = "Gagal memproses ID: $id_guru. Error Database: " . mysqli_error($con);
        }
    }

    fclose($file_handle);

    $message = "Proses Import Selesai. Total Data Berhasil: $success_count.";
    $message .= "\nData Baru Ditambahkan: " . ($insert_count) . ".";
    $message .= "\nData Diperbarui: " . ($update_count) . ".";
    $message .= "\nData Gagal Diproses: $error_count.";

    if ($error_count > 0) {
        $message .= "\n\n5 Detail Error Pertama:\n" . implode("\n", array_slice($error_messages, 0, 5));
    }
    
    echo "<script>
        alert('$message');
        window.location='index.php?page=v_guru'; 
    </script>";
}

// 2. Ubah/Edit Kegiatan
elseif (isset($_POST['ubah_agenda_lain'])) {
    $id_lain       = $_POST['id_lain'];
    $tanggal       = mysqli_real_escape_string($con, $_POST['tanggal']);
    $nama_kegiatan = mysqli_real_escape_string($con, $_POST['nama_kegiatan']);
    $id_guru       = mysqli_real_escape_string($con, $_POST['id_guru']);
    $jam_mulai     = mysqli_real_escape_string($con, $_POST['jam_mulai']);
    $jam_selesai   = mysqli_real_escape_string($con, $_POST['jam_selesai']);
    $keterangan    = mysqli_real_escape_string($con, $_POST['keterangan']);

    $update = mysqli_query($con, "UPDATE tb_agenda_lain SET
        id_guru       = '$id_guru',
        nama_kegiatan = '$nama_kegiatan',
        tanggal       = '$tanggal',
        jam_mulai     = '$jam_mulai',
        jam_selesai   = '$jam_selesai',
        keterangan    = '$keterangan'
        WHERE id_lain = '$id_lain' ");

    if ($update) {
        echo "<script>
            alert('Data Kegiatan Berhasil Diperbarui');
            window.location='index.php?page=v_aglain';
        </script>";
    } else {
        echo "<script>
            alert('Gagal Mengubah Data: " . mysqli_error($con) . "');
            window.history.back();
        </script>";
    }
} else {
    // Tambahkan ini untuk menangani kasus di mana tidak ada kondisi yang cocok
    // Jika tidak ada POST action yang dikenali, kembali ke halaman utama atau tampilkan error
    // Tapi karena ini akan menyebabkan header setelah output, kita harus menggunakan javascript redirect
    echo "<script>
        alert('Tidak ada aksi yang dikenali atau data tidak lengkap');
        window.history.back();
    </script>";
} 