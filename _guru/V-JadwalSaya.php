<?php 
// File: v-jadwal-saya.php
// Halaman untuk menampilkan jadwal piket guru yang sedang login (Muhammad Abduh)

// PENTING: Variabel $sesi sudah diambil dari $_SESSION['guru'] di file induk (index guru)
// Kita akan menggunakan variabel $sesi tersebut.
$id_guru_sesi = $sesi ?? null; 

// Pengecekan koneksi dan sesi
// Variabel $con dijamin ada karena sudah di-include di file induk.
if (!$id_guru_sesi) {
    // Jika $sesi kosong, tampilkan pesan error yang lebih spesifik
    echo "<div class='alert alert-danger'>Kesalahan: ID Guru (Sesi \$sesi) tidak ditemukan. Pastikan sesi 'guru' diatur dengan benar di halaman login.</div>";
    return;
}
// Variabel $con tetap digunakan, meskipun pengecekan !isset($con) tidak diperlukan
// karena file index guru sudah meng-include 'koneksi.php' di atasnya.

// 1. Ambil Tahun Ajaran Aktif
$id_tajaran_aktif = 0;
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif' OR status='Y' LIMIT 1");
if ($sqlTa && mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong class="card-title"> 
                <span class="fa fa-calendar-alt"></span> Jadwal Piket Saya
            </strong>
        </div>
        <div class="card-body">
            
            <p class="text-secondary small">
                ID Guru yang Sedang Dicari: **<?= htmlspecialchars($id_guru_sesi); ?>**
            </p>
            <h5 class="text-danger">
                T.A. Aktif: **<?php echo htmlspecialchars($tahun_ajaran_aktif); ?>**
            </h5>
            <hr>

            <div class="table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Tanggal Piket</th>
                            <th>Hari Piket</th>
                            <th>Guru Pengganti</th>
                            <th>Status Pengganti</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        // Query Jadwal Piket: Filter berdasarkan ID Guru yang sedang login ($sesi)
                        $sqlJadwalSaya = mysqli_query($con, "
                            SELECT 
                                jp.*, 
                                gp.nama_guru AS nama_guru_pengganti
                            FROM 
                                tb_jadwal_piket jp
                            LEFT JOIN 
                                tb_guru gp ON jp.id_guru_pengganti = gp.id_guru
                            WHERE 
                                jp.id_guru = '" . mysqli_real_escape_string($con, $id_guru_sesi) . "'
                                " . ($id_tajaran_aktif ? "AND jp.id_tajaran = '$id_tajaran_aktif'" : "") . "
                            ORDER BY 
                                jp.tanggal_piket DESC
                        "); 
                        
                        // Pengecekan Error Query
                        if (!$sqlJadwalSaya) {
                            echo "<tr><td colspan='6' class='text-center text-danger'>SQL ERROR: " . mysqli_error($con) . "</td></tr>";
                            return;
                        }

                        if (mysqli_num_rows($sqlJadwalSaya) > 0):
                            while ($data = mysqli_fetch_array($sqlJadwalSaya)) {
                                $badge_class = 'badge-secondary';
                                if ($data['status_pengganti'] == 'Ya') {
                                    $badge_class = 'badge-success';
                                } elseif ($data['status_pengganti'] == 'Tidak') {
                                     $badge_class = 'badge-danger';
                                }
                                ?>
                                <tr>
                                    <td><center><?= $no++; ?>.</center></td>
                                    <td>
                                        <strong><?= date('d F Y', strtotime($data['tanggal_piket'])); ?></strong>
                                    </td>
                                    <td>**<?= htmlspecialchars($data['hari_piket']); ?>**</td>
                                    <td>
                                        <?php 
                                            echo htmlspecialchars($data['nama_guru_pengganti'] ?? 'Tidak Ada');
                                            if (!empty($data['catatan_penggantian'])) {
                                                echo '<br><small class="text-muted">Catatan: ' . htmlspecialchars($data['catatan_penggantian']) . '</small>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <span class="badge <?= $badge_class; ?>">
                                            <?= htmlspecialchars($data['status_pengganti']); ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($data['keterangan']); ?></td>
                                </tr>
                            <?php 
                            }
                        else:
                            ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    <span class="fa fa-exclamation-circle"></span> Anda belum memiliki jadwal piket yang tercatat untuk T.A. ini.
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>