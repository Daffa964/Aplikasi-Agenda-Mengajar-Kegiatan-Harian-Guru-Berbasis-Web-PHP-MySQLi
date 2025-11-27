<?php
// Ambil ID Guru yang sedang login
$sesi = $_SESSION['guru'];
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-exchange"></span> Jadwal Piket & Pengajuan Pengganti</strong>
                
                <a href="?page=t_ajukan_pengganti" class="btn btn-primary float-right btn-sm">
                    <i class="fa fa-plus"></i> Buat Pengajuan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan Piket</th> <th>Guru Pengganti</th>
                                <th>Status Pengajuan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // REVISI QUERY: Hapus filter status != 'Tidak' agar semua jadwal muncul
                            $sql = mysqli_query($con, "
                                SELECT jp.*, g.nama_guru as nama_pengganti
                                FROM tb_jadwal_piket jp
                                LEFT JOIN tb_guru g ON jp.id_guru_pengganti = g.id_guru
                                WHERE jp.id_guru = '$sesi' 
                                ORDER BY jp.tanggal_piket DESC
                            ");

                            if(mysqli_num_rows($sql) == 0){
                                echo "<tr><td colspan='6' class='text-center text-danger'>Belum ada jadwal piket untuk Anda.</td></tr>";
                            }

                            while ($row = mysqli_fetch_array($sql)) {
                                // Tentukan Label Status
                                $status = $row['status_pengganti'];
                                if ($status == 'Tidak' || empty($status)) {
                                    $label_status = "-";
                                } elseif ($status == 'Menunggu') {
                                    $label_status = "<span class='badge badge-warning'>Menunggu</span>";
                                } elseif ($status == 'Disetujui') {
                                    $label_status = "<span class='badge badge-success'>Disetujui</span>";
                                } elseif ($status == 'Ditolak') {
                                    $label_status = "<span class='badge badge-danger'>Ditolak</span>";
                                } else {
                                    $label_status = $status;
                                }
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <strong><?= date('d-m-Y', strtotime($row['tanggal_piket'])); ?></strong><br>
                                    <small>(<?= $row['hari_piket']; ?>)</small>
                                </td>
                                
                                <td><?= $row['keterangan']; ?></td>
                                
                                <td>
                                    <?php 
                                        echo !empty($row['nama_pengganti']) ? $row['nama_pengganti'] : "-"; 
                                    ?>
                                </td>
                                
                                <td><?= $label_status; ?></td>
                                
                                <td>
                                    <?php if ($status == 'Tidak' || empty($status)) { ?>
                                        <a href="?page=t_ajukan_pengganti&id=<?=$row['id_jadwal'];?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-hand-o-right"></i> Ajukan
                                        </a>
                                    <?php } elseif ($status == 'Menunggu') { ?>
                                        <a href="?page=act&act=batal_pengganti&id=<?=$row['id_jadwal'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Batalkan pengajuan ini?')">
                                            <i class="fa fa-times"></i> Batal
                                        </a>
                                    <?php } else { ?>
                                        <i class="fa fa-check text-success"></i> Selesai
                                    <?php } ?>
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