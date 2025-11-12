<?php
// Pastikan path koneksi.php sudah benar relatif terhadap lokasi file ini
include '../koneksi.php'; 

// Ambil ID Jadwal dari URL (menggunakan parameter 'id')
$id_jadwal_hapus = @$_GET['id'];

// Cek apakah ID Jadwal ditemukan
if (empty($id_jadwal_hapus)) {
    echo " <script>alert('ID Jadwal tidak ditemukan!');
    window.location='?page=v_jadwal_piket';</script> ";
    exit;
}

// Lakukan Query DELETE data dari tabel tb_jadwal_piket
$query_hapus = mysqli_query($con, "
    DELETE FROM tb_jadwal_piket 
    WHERE id_jadwal = '$id_jadwal_hapus'
") or die(mysqli_error($con));

// Cek hasil query dan berikan notifikasi
if ($query_hapus) {
    echo " <script>alert('Data Jadwal Piket Berhasil Dihapus !!');
    window.location='?page=v_jadwal_piket';</script> ";
} else {
    echo " <script>alert('Data Gagal Dihapus! Silakan coba lagi.');
    window.location='?page=v_jadwal_piket';</script> ";
}
?>