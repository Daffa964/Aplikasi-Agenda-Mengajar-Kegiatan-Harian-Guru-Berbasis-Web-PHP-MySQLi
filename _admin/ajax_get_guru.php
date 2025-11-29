<?php
include '../koneksi.php';

// Ambil semua guru dengan gelar
$sqlGuru = mysqli_query($con, "SELECT *,
    CASE
        WHEN gelar IS NOT NULL AND gelar != '' THEN CONCAT(nama_guru, ', ', gelar)
        ELSE nama_guru
    END as nama_guru_dengan_gelar
    FROM tb_guru ORDER BY nama_guru ASC");
$options = '';

while($guru = mysqli_fetch_array($sqlGuru)) {
    $options .= '<option value="'.$guru['id_guru'].'">'.$guru['nama_guru_dengan_gelar'].'</option>';
}

echo $options;
?>