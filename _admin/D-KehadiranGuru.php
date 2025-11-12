<?php
// Pastikan path koneksi.php sudah benar relatif terhadap lokasi file ini
include '../koneksi.php'; 

// Ambil ID Kehadiran dari URL (menggunakan parameter 'idk')
$id_kehadiran_hapus = @$_GET['idk'];

// Cek apakah ID Kehadiran ditemukan
if (empty($id_kehadiran_hapus)) {
    echo " <script>alert('ID Kehadiran tidak ditemukan!');
    window.location='?page=v_kehadiran_guru';</script> ";
    exit;
}

// Lakukan Query DELETE data dari tabel tb_kehadiran_guru
// Catatan: Pastikan tabel tb_kehadiran_guru tidak memiliki relasi foreign key CASCADE DELETE
// yang dapat menyebabkan penghapusan data lain secara tidak sengaja.
$query_hapus = mysqli_query($con, "
    DELETE FROM tb_kehadiran_guru 
    WHERE id_kehadiran = '$id_kehadiran_hapus'
") or die(mysqli_error($con));

// Cek hasil query dan berikan notifikasi
if ($query_hapus) {
    echo " <script>alert('Data Kehadiran Guru Berhasil Dihapus !!');
    window.location='?page=v_kehadiran_guru';</script> ";
} else {
    // Jika gagal, tampilkan pesan error database
    echo " <script>alert('Data Gagal Dihapus! Error: " . mysqli_error($con) . "');
    window.location='?page=v_kehadiran_guru';</script> ";
}
?>