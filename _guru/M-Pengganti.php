<?php
// File: m-pengganti.php (Processor Aksi Pengajuan Guru)

// Pastikan koneksi database ($con) tersedia
if (!isset($con)) {
    // Jika act.php tidak menyediakan $con, Anda harus mendefinisikannya di sini
    // atau memastikan act.php sudah meng-include file koneksi.
    // Contoh: die("Koneksi database tidak tersedia.");
}

// Cek apakah tombol submit 'ajukan_pengganti' telah ditekan
if (isset($_POST['ajukan_pengganti'])) {

    // Ambil data dari form (sesuai field name di modal)
    $id_jadwal            = mysqli_real_escape_string($con, $_POST['id_jadwal']);
    $id_guru_piket_asli   = mysqli_real_escape_string($con, $_POST['id_guru_piket_asli']);
    $id_guru_pengganti    = mysqli_real_escape_string($con, $_POST['id_guru_pengganti']);
    $catatan              = mysqli_real_escape_string($con, $_POST['catatan_penggantian']);

    $status_pengganti     = 'Ya'; // Status: Pengganti telah ditetapkan

    // Validasi
    if (empty($id_jadwal) || empty($id_guru_pengganti) || empty($catatan)) {
        echo "<script>alert('Gagal! Semua kolom wajib diisi.'); window.location='?page=v_ajukan_pengganti';</script>";
        exit;
    }

    // Query UPDATE data di tb_jadwal_piket
    $sql_update = "
        UPDATE
            tb_jadwal_piket
        SET
            id_guru_pengganti = '$id_guru_pengganti',
            status_pengganti = '$status_pengganti',
            catatan_penggantian = '$catatan'
        WHERE
            id_jadwal = '$id_jadwal'
            AND id_guru = '$id_guru_piket_asli'
    ";

    $query_run = mysqli_query($con, $sql_update);

    if ($query_run) {
        echo "<script>alert('Pengajuan Guru Pengganti Berhasil dikirim! Menunggu persetujuan Administrator.'); window.location='?page=v_ajukan_pengganti';</script>";
    } else {
        $error_msg = mysqli_error($con);
        echo "<script>alert('ERROR: Gagal memproses pengajuan. Detail: " . $error_msg . "'); window.location='?page=v_ajukan_pengganti';</script>";
    }

}
?>