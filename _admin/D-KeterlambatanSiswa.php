<?php
// Pastikan file koneksi sudah di-include
include '../koneksi.php';

// Cek apakah parameter ID Keterlambatan (idk) ada di URL
if (isset($_GET['idk'])) {
    // Ambil dan bersihkan nilai idk
    $idk = trim(mysqli_real_escape_string($con, $_GET['idk']));

    // Query DELETE
    $query_delete = mysqli_query($con, "DELETE FROM tb_keterlambatan WHERE id_keterlambatan='$idk'");

    // Cek hasil query
    if ($query_delete) {
        // Berhasil dihapus
        echo " <script>
                alert('Data Keterlambatan Berhasil Dihapus !!');
                window.location='?page=v_keterlambatan_siswa';
               </script> ";
    } else {
        // Gagal dihapus
        echo " <script>
                alert('Data Keterlambatan GAGAL Dihapus !! Error: " . mysqli_error($con) . "');
                window.location='?page=v_keterlambatan_siswa';
               </script> ";
    }
} else {
    // Parameter tidak ditemukan
    echo " <script>
            alert('Akses Ilegal! ID Keterlambatan Tidak Ditemukan.');
            window.location='?page=v_keterlambatan_siswa';
           </script> ";
}
?>