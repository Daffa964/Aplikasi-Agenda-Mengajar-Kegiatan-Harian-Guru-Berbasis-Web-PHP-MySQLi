<?php
// Ambil ID Guru yang sedang login
$sesi = $_SESSION['guru'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-calendar-check-o"></span> Jadwal Piket Saya</strong>
                <a href="?page=add-jadwal" class="btn btn-primary float-right btn-sm">
                    <i class="fa fa-plus"></i> Tambah Piket
                </a>
            </div>
            <div class="card-body">
                
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Tabel ini menampilkan jadwal piket asli Anda dan tugas pengganti yang sudah disetujui.
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal / Hari</th>
                                <th>Keterangan / Agenda</th>
                                <th>Status Tugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            
                            // --- QUERY PERBAIKAN ---
                            // Mengambil jadwal sendiri ATAU jadwal sebagai pengganti (Disetujui/Ya)
                            $sql = mysqli_query($con, "
                                SELECT jp.*, g_asal.nama_guru as nama_guru_asal
                                FROM tb_jadwal_piket jp
                                LEFT JOIN tb_guru g_asal ON jp.id_guru = g_asal.id_guru
                                WHERE 
                                    -- Kondisi 1: Jadwal milik saya sendiri
                                    jp.id_guru = '$sesi' 
                                    OR 
                                    -- Kondisi 2: Saya jadi pengganti DAN statusnya sudah disetujui
                                    (
                                        jp.id_guru_pengganti = '$sesi' 
                                        AND (jp.status_pengganti = 'Disetujui' OR jp.status_pengganti = 'Ya')
                                    )
                                ORDER BY jp.tanggal_piket DESC
                            ");

                            while ($row = mysqli_fetch_array($sql)) {
                                $tanggal = date('d-m-Y', strtotime($row['tanggal_piket']));
                                $is_owner = ($row['id_guru'] == $sesi); // Cek apakah ini jadwal asli
                            ?>
                            
                            <tr style="<?= (!$is_owner) ? 'background-color: #d1ecf1;' : ''; ?>">
                                <td><?= $no++; ?></td>
                                <td>
                                    <strong><?= $tanggal; ?></strong> <br>
                                    <small>(<?= $row['hari_piket']; ?>)</small>
                                </td>
                                <td>
                                    <?= $row['keterangan']; ?>
                                    
                                    <?php if (!$is_owner) { ?>
                                        <hr style="margin: 5px 0; border-top: 1px dashed #b1bbc4;">
                                        <small class="text-danger" style="font-weight:bold;">
                                            <i class="fa fa-exchange"></i> Menggantikan: <?= $row['nama_guru_asal']; ?>
                                        </small>
                                        <?php if(!empty($row['catatan_penggantian'])) { ?>
                                            <br>
                                            <small class="text-muted">
                                                <em>Catatan: "<?= $row['catatan_penggantian']; ?>"</em>
                                            </small>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php 
                                    if ($is_owner) {
                                        // Logika tampilan untuk pemilik jadwal asli
                                        if ($row['id_guru_pengganti'] != NULL && ($row['status_pengganti'] == 'Disetujui' || $row['status_pengganti'] == 'Ya')) {
                                            echo "<span class='badge badge-warning'>Digantikan Orang Lain</span>";
                                        } else {
                                            echo "<span class='badge badge-success'>Piket Asli</span>";
                                        }
                                    } else {
                                        // Logika tampilan untuk guru pengganti
                                        echo "<span class='badge badge-info'>Tugas Pengganti</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>