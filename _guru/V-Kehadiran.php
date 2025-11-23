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

// Ambil data guru dari database
$sqlGuru = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru='$id_guru_login'");
$dataGuru = mysqli_fetch_array($sqlGuru);

?>

<div class="col-lg-12">
    <div class="card" style="border-radius:10px;">
        <div class="card-header">
            <strong class="card-title"><span class="fa fa-clipboard-list"></span> Riwayat Kehadiran Saya</strong>
        </div>
        <div class="card-body">
            <p>Nama Guru: <strong><?php echo $dataGuru['nama_guru']; ?></strong></p>

            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    
                    // Query mengambil data kehadiran guru dari tb_kehadiran_guru untuk Guru yang login
                    $sqlKehadiran = mysqli_query($con, "
                        SELECT
                            kh.id_kehadiran,
                            kh.tanggal_kehadiran,
                            kh.status_kehadiran,
                            kh.waktu_masuk,
                            kh.keterangan
                        FROM tb_kehadiran_guru kh
                        WHERE kh.id_guru = '$id_guru_login'
                        ORDER BY kh.tanggal_kehadiran DESC
                    ") or die(mysqli_error($con));

                    if (mysqli_num_rows($sqlKehadiran) > 0) {
                        while ($data = mysqli_fetch_array($sqlKehadiran)) {
                            // Tentukan warna status
                            $status = $data['status_kehadiran'];
                            $status_class = '';
                            if ($status == 'Hadir') $status_class = 'badge badge-success';
                            else if ($status == 'Terlambat') $status_class = 'badge badge-warning';
                            else if ($status == 'Izin' || $status == 'Sakit') $status_class = 'badge badge-info';
                            else $status_class = 'badge badge-danger'; // Alpa/Lainnya
                    ?>
                    <tr>
                        <th scope="row"><?php echo $no++; ?>. </th>
                        <td>
                            <strong><?php echo date('d M Y', strtotime($data['tanggal_kehadiran'])); ?></strong>
                        </td>
                        <td>
                            <span class="<?php echo $status_class; ?>">
                                <?php echo $data['status_kehadiran']; ?>
                            </span>
                        </td>
                        <td>
                            <span class="text-info">
                                **<?php echo $data['waktu_masuk'] ? date('H:i', strtotime($data['waktu_masuk'])) : '-'; ?>**
                            </span>
                        </td>
                        <td>
                            <?php echo $data['keterangan'] ? $data['keterangan'] : '-'; ?>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">Tidak Ada Riwayat Kehadiran Anda yang Tercatat Saat Ini.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>