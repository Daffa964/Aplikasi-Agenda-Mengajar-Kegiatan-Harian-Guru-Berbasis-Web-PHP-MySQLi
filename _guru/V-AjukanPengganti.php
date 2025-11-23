<?php
// File: v-ajukanpengganti.php
// Menampilkan daftar jadwal piket guru yang sedang login dan form pengajuan pengganti.

// Pastikan $con (koneksi) dan $sesi (ID Guru) tersedia
$id_guru_sesi = $sesi ?? null;

if (!isset($con) || !$id_guru_sesi) {
    echo "<div class='alert alert-danger'>Kesalahan: Koneksi database atau ID Guru (Sesi) tidak ditemukan!</div>";
    return;
}

// 1. Ambil Tahun Ajaran Aktif
$id_tajaran_aktif = 0;
$tahun_ajaran_aktif = 'T.A Tidak Aktif';
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif' OR status='Y' LIMIT 1");
if ($sqlTa && mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}

// 2. Query Guru untuk Dropdown di Modal (Guru yang BUKAN diri sendiri)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru WHERE id_guru != '" . mysqli_real_escape_string($con, $id_guru_sesi) . "' ORDER BY nama_guru ASC");
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong class="card-title">
                <span class="fa fa-user-plus"></span> Ajukan Guru Pengganti
            </strong>
        </div>
        <div class="card-body">

            <p class="text-secondary small">
                T.A. Aktif: **<?php echo htmlspecialchars($tahun_ajaran_aktif); ?>**
            </p>
            <hr>

            <h5>Jadwal Piket Anda yang Belum Memiliki Pengganti</h5>

            <?php
            // 3. Query Jadwal yang Belum Disetujui ('Ya') dan Belum Lewat Hari Ini
            $sqlJadwal = mysqli_query($con, "
                SELECT
                    id_jadwal,
                    tanggal_piket,
                    hari_piket,
                    status_pengganti
                FROM
                    tb_jadwal_piket
                WHERE
                    id_guru = '" . mysqli_real_escape_string($con, $id_guru_sesi) . "'
                    AND status_pengganti != 'Ya'
                    AND tanggal_piket >= CURDATE()
                    " . ($id_tajaran_aktif ? "AND id_tajaran = '$id_tajaran_aktif'" : "") . "
                ORDER BY
                    tanggal_piket ASC
            ") or die(mysqli_error($con));

            $ada_data_jadwal = (mysqli_num_rows($sqlJadwal) > 0);

            if ($ada_data_jadwal):
            ?>
                <div class="table-responsive">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th>Tanggal & Hari Piket</th>
                                <th>Status Pengganti</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_array($sqlJadwal)) {
                                $id_jadwal = htmlspecialchars($data['id_jadwal']);
                                $tgl_piket = date('d/m/Y', strtotime($data['tanggal_piket']));

                                $status = $data['status_pengganti'] ?: 'Belum Diajukan';
                                $badge_class = ($status == 'Tidak' ? 'badge-danger' : 'badge-warning');
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++; ?>.</center>
                                    </td>
                                    <td>
                                        <strong><?= date('d F Y', strtotime($data['tanggal_piket'])); ?></strong>
                                        <br><small>(<?= htmlspecialchars($data['hari_piket']); ?>)</small>
                                    </td>
                                    <td>
                                        <span class="badge <?= $badge_class ?>">
                                            <?= htmlspecialchars($status); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="?page=t_ajukan_pengganti&id=<?php echo $data['id_jadwal']; ?>&tgl=<?php echo $data['tanggal_piket']; ?>"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-user-plus"></i> Ajukan
                                        </a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            <?php
            else:
            ?>
                <div class="alert alert-success text-center">
                    <span class="fa fa-check-circle"></span> Semua jadwal piket Anda sudah selesai atau telah memiliki status pengganti.
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // ... (Kode JS yang sudah benar) ...
    });
</script>