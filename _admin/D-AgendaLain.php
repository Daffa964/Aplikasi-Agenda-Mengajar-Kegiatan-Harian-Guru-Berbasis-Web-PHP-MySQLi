<?php
$id = $_GET['id'];

// Query Hapus
$hapus = mysqli_query($con, "DELETE FROM tb_agenda_lain WHERE id_lain='$id'");

if ($hapus) {
    echo "<script>
        alert('Data Berhasil Dihapus');
        window.location='?page=v_aglain';
    </script>";
} else {
    echo "<script>
        alert('Gagal Menghapus Data: " . mysqli_error($con) . "');
        window.location='?page=v_aglain';
    </script>";
}
?>