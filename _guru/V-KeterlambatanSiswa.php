<?php
session_start();
include '../koneksi.php';

// Pastikan guru sudah login
if (!isset($_SESSION['guru'])) {
    header('location:login.php');
    exit();
}

// Ambil ID Guru dari SESSION
$id_guru_login = $_SESSION['guru'];

// Ambil data keterlambatan siswa dari database untuk guru ini
$queryKeterlambatan = mysqli_query($con, "
    SELECT
        a.id_keterlambatan,
        a.tanggal,
        a.waktu_terlambat,
        a.keterangan,
        b.nama_siswa,
        b.nis,
        c.kelas
    FROM
        tb_keterlambatan a
    INNER JOIN
        tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN
        tb_kelas c ON b.idkelas = c.idkelas
    WHERE
        a.id_guru_piket = '$id_guru_login'
    ORDER BY
        a.tanggal DESC
") or die(mysqli_error($con));
?>

<div class="col-lg-12">
    <div class="card" style="border-radius:10px;">
        <div class="card-header">
            <strong class="card-title"><span class="fa fa-clipboard-list"></span> Riwayat Keterlambatan Siswa</strong>
        </div>
        <div class="card-body">
            <small class="text-danger">Keterlambatan yang telah Anda catat</small>

            <a href="?page=t_keterlambatan_siswa" class="btn btn-info mb-3"> <span class="fa fa-plus-circle"></span> Tambah Keterlambatan Siswa </a>

            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Siswa / NIS / Kelas</th>
                        <th scope="col">Durasi Keterlambatan</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($queryKeterlambatan) > 0) {
                        while ($dataKeterlambatan = mysqli_fetch_array($queryKeterlambatan)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $no++; ?>. </th>
                        <td><strong><?php echo date('d M Y', strtotime($dataKeterlambatan['tanggal'])); ?></strong></td>
                        <td>
                            <strong><?php echo $dataKeterlambatan['nama_siswa']; ?></strong><br>
                            <small><?php echo $dataKeterlambatan['nis']; ?> - <?php echo $dataKeterlambatan['kelas']; ?></small>
                        </td>
                        <td>
                            <?php
                            $menit = $dataKeterlambatan['waktu_terlambat'];
                            if ($menit > 0) {
                                $jam = floor($menit / 60);
                                $sisa_menit = $menit % 60;
                                echo $jam . " jam " . $sisa_menit . " menit";
                            } else {
                                echo "Tepat waktu";
                            }
                            ?>
                        </td>
                        <td><?php echo $dataKeterlambatan['keterangan'] ? $dataKeterlambatan['keterangan'] : '-'; ?></td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">Tidak Ada Riwayat Keterlambatan Siswa yang Tercatat Saat Ini.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>