<?php
include '../koneksi.php';

// Periksa apakah parameter tabel diberikan
if (!isset($_GET['tabel'])) {
    die('Parameter tabel tidak ditemukan');
}

$tabel = $_GET['tabel'];

// Definisikan nama tabel yang diizinkan untuk mencegah SQL injection
$allowed_tables = [
    'tb_guru', 
    'tb_siswa', 
    'tb_izin_siswa', 
    'tb_keterlambatan', 
    'tb_agenda', 
    'tb_agendalain',
    'tb_kelas',
    'tb_mapel',
    'tb_kepsek',
    'tb_user',
    'tb_tajaran'
];

if (!in_array($tabel, $allowed_tables)) {
    die('Nama tabel tidak valid');
}

// Query data dari tabel yang diminta
$sql = "SELECT * FROM " . $tabel;
$result = mysqli_query($con, $sql);

if (!$result) {
    die('Query gagal: ' . mysqli_error($con));
}

// Dapatkan nama kolom
$columns = mysqli_fetch_fields($result);

// Set header untuk download file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=" . $tabel . "_export_" . date('Y-m-d') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Tulis header kolom
$column_names = [];
foreach ($columns as $column) {
    $column_names[] = $column->name;
}
echo implode("\t", $column_names) . "\n";

// Tulis data baris per baris
while ($row = mysqli_fetch_assoc($result)) {
    $row_data = [];
    foreach ($row as $value) {
        // Escape tab dan new line characters
        $value = str_replace("\t", " ", $value);
        $value = str_replace("\n", " ", $value);
        $value = str_replace("\r", " ", $value);
        $row_data[] = $value;
    }
    echo implode("\t", $row_data) . "\n";
}

// Tutup koneksi
mysqli_close($con);
exit();
?>