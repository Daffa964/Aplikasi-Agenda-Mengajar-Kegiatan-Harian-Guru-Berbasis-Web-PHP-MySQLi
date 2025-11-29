<?php
// Pastikan sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

include '../koneksi.php';

// Ambil ID hari dari parameter URL
$id_mingguan = @$_GET['id'];

if (empty($id_mingguan)) {
    echo "<script>alert('ID Hari tidak ditemukan!'); window.location='?page=v_jadwal_piket_mingguan';</script>";
    exit;
}

// Ambil nama hari
$sqlHari = mysqli_query($con, "SELECT * FROM tb_piket_mingguan WHERE id_mingguan = '$id_mingguan'");
$hari = mysqli_fetch_array($sqlHari);

if (!$hari) {
    echo "<script>alert('Data hari tidak ditemukan!'); window.location='?page=v_jadwal_piket_mingguan';</script>";
    exit;
}

$nama_hari = $hari['hari'];
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-info-circle"></span> Detail Guru Piket - <?php echo $nama_hari; ?></strong>
                <a href="?page=v_jadwal_piket_mingguan" class="btn btn-primary float-right btn-sm">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Berikut adalah daftar guru yang bertugas pada hari: <strong><?php echo $nama_hari; ?></strong>
                </div>

                <!-- Tabel Detail Guru -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Guru</th>
                                <th>NIP</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil data guru yang bertugas di hari tersebut
                            $sqlGuru = mysqli_query($con, "
                                SELECT p_guru.*, g.nama_guru, g.gelar, g.nip, g.kelamin, g.alamat, g.telp, g.email
                                FROM tb_piket_mingguan_guru p_guru
                                LEFT JOIN tb_guru g ON p_guru.id_guru = g.id_guru
                                WHERE p_guru.id_mingguan = '$id_mingguan'
                                ORDER BY g.nama_guru ASC
                            ");

                            $no = 1;
                            if(mysqli_num_rows($sqlGuru) == 0) {
                                echo "<tr><td colspan='7' class='text-center'><i class='fa fa-info-circle'></i> Tidak ada guru yang bertugas pada hari ini.</td></tr>";
                            } else {
                                while($guru = mysqli_fetch_array($sqlGuru)) {
                                    $nama_guru = $guru['nama_guru'];
                                    $guru_gelar = $guru['gelar'];
                                    if($nama_guru) {
                                        if($guru_gelar && $guru_gelar !== '') {
                                            $nama_guru = $guru['nama_guru'] . ', ' . $guru['gelar'];
                                        }
                                    } else {
                                        $nama_guru = '<span class="text-danger">Data Guru Terhapus</span>';
                                    }
                                    $nip = $guru['nip'] ? $guru['nip'] : '-';
                                    $kelamin = $guru['kelamin'] ? $guru['kelamin'] : '-';
                                    $alamat = $guru['alamat'] ? $guru['alamat'] : '-';
                                    $telp = $guru['telp'] ? $guru['telp'] : '-';
                                    $email = $guru['email'] ? $guru['email'] : '-';
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++; ?></td>
                                        <td><?php echo $nama_guru; ?></td>
                                        <td><?php echo $nip; ?></td>
                                        <td><?php echo $kelamin; ?></td>
                                        <td><?php echo $alamat; ?></td>
                                        <td><?php echo $telp; ?></td>
                                        <td><?php echo $email; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>