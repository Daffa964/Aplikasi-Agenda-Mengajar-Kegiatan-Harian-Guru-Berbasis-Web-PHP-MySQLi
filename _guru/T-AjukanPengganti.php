<?php 
// File: t-ajukanpengganti.php
// Skrip untuk memproses pengajuan guru pengganti.

// Pastikan koneksi dan ID Guru tersedia
if (!isset($con) || !isset($sesi)) {
    echo "<script>alert('Akses tidak valid.'); window.location='index.php';</script>";
    exit;
}

if (isset($_POST['t_ajukan_pengganti'])) {
    
    $id_jadwal          = mysqli_real_escape_string($con, $_POST['id_jadwal']);
    $id_guru_pengganti  = mysqli_real_escape_string($con, $_POST['id_guru_pengganti']);
    $catatan            = mysqli_real_escape_string($con, $_POST['catatan_penggantian']);
    
    // Validasi sederhana
    if (empty($id_jadwal) || empty($id_guru_pengganti) || empty($catatan)) {
        echo "<script>alert('Semua kolom wajib diisi.'); window.location='?page=v_ajukan_pengganti';</script>";
        exit;
    }

    // Status awal pengajuan adalah 'Tidak' (Menunggu persetujuan Admin/Kepsek)
    $sql_update = mysqli_query($con, "
        UPDATE tb_jadwal_piket SET 
            id_guru_pengganti = '$id_guru_pengganti', 
            status_pengganti = 'Tidak', 
            catatan_penggantian = '$catatan' 
        WHERE id_jadwal = '$id_jadwal'
    ") or die(mysqli_error($con));

    if ($sql_update) {
        // Arahkan kembali ke halaman tampilan daftar jadwal
        echo "<script>alert('Pengajuan Guru Pengganti berhasil dikirim! Menunggu persetujuan Administrator.'); window.location='?page=v_ajukan_pengganti';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pengajuan. Silakan coba lagi.'); window.location='?page=v_ajukan_pengganti';</script>";
    }

} else {
    // Jika diakses tanpa submit form
    echo "<script>alert('Akses tidak valid.'); window.location='?page=v_ajukan_pengganti';</script>";
}
?>