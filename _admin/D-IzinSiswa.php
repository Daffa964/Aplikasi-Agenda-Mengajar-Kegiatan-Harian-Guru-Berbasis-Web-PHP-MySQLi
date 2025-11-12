<?php
// Pastikan file koneksi sudah di-include
include '../koneksi.php';

// Cek apakah parameter ID Izin (idi) ada di URL
if (isset($_GET['idi'])) {
    // Ambil dan bersihkan nilai idi
    $idi = trim(mysqli_real_escape_string($con, $_GET['idi']));

    // Query DELETE
    $query_delete = mysqli_query($con, "DELETE FROM tb_izin_siswa WHERE id_izin='$idi'");

    // Cek hasil query
    if ($query_delete) {
        // Berhasil dihapus
        echo " <script>
                alert('Data Perizinan Siswa Berhasil Dihapus !!');
                window.location='?page=v_izin_siswa';
               </script> ";
    } else {
        // Gagal dihapus
        echo " <script>
                alert('Data Perizinan Siswa GAGAL Dihapus !! Error: " . mysqli_error($con) . "');
                window.location='?page=v_izin_siswa';
               </script> ";
    }
} else {
    // Parameter tidak ditemukan
    echo " <script>
            alert('Akses Ilegal! ID Izin Tidak Ditemukan.');
            window.location='?page=v_izin_siswa';
           </script> ";
}
?>