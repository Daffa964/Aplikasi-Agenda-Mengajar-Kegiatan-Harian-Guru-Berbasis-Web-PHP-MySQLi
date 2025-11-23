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

// Ambil data izin siswa dari database untuk guru ini
$queryIzin = mysqli_query($con, "
    SELECT
        a.id_izin,
        a.tanggal_izin,
        a.jenis_izin,
        a.keterangan,
        a.status_izin,
        b.nama_siswa,
        b.nis,
        c.kelas
    FROM
        tb_izin_siswa a
    INNER JOIN
        tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN
        tb_kelas c ON b.idkelas = c.idkelas
    WHERE
        a.id_guru_piket = '$id_guru_login'
    ORDER BY
        a.tanggal_izin DESC
") or die(mysqli_error($con));
?>

<div class="col-lg-12">
    <div class="card" style="border-radius:10px;">
        <div class="card-header">
            <strong class="card-title"><span class="fa fa-clipboard-list"></span> Riwayat Perizinan Siswa</strong>
        </div>
        <div class="card-body">
            <small class="text-danger">Perizinan yang telah Anda catat</small>

            <a href="?page=t_izin_siswa" class="btn btn-info mb-3"> <span class="fa fa-plus-circle"></span> Tambah Izin Siswa </a>

            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal & Keterangan</th>
                        <th scope="col">Siswa / NIS / Kelas</th>
                        <th scope="col">Jenis Izin</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($queryIzin) > 0) {
                        while ($dataIzin = mysqli_fetch_array($queryIzin)) {
                            // Tentukan warna status
                            $status = $dataIzin['status_izin'];
                            $status_class = '';
                            if ($status == 'Disetujui') $status_class = 'badge badge-success';
                            else if ($status == 'Ditolak') $status_class = 'badge badge-danger';
                            else $status_class = 'badge badge-warning'; // Menunggu
                    ?>
                    <tr>
                        <th scope="row"><?php echo $no++; ?>. </th>
                        <td>
                            <strong><?php echo date('d M Y', strtotime($dataIzin['tanggal_izin'])); ?></strong><br>
                            <small><?php echo $dataIzin['keterangan']; ?></small>
                        </td>
                        <td>
                            <strong><?php echo $dataIzin['nama_siswa']; ?></strong><br>
                            <small><?php echo $dataIzin['nis']; ?> - <?php echo $dataIzin['kelas']; ?></small>
                        </td>
                        <td><?php echo $dataIzin['jenis_izin']; ?></td>
                        <td>
                            <span class="<?php echo $status_class; ?>">
                                <?php echo $dataIzin['status_izin']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">Tidak Ada Riwayat Perizinan Siswa yang Tercatat Saat Ini.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>