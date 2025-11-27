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
                    <i class="fa fa-info-circle"></i> Tabel ini menampilkan jadwal piket asli Anda dan jadwal di mana Anda menjadi <b>Guru Pengganti</b>.
                </div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal / Hari</th>
                            <th>Keterangan / Agenda</th>
                            <th>Status Piket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        
                        // LOGIKA QUERY:
                        // 1. Ambil jadwal milik sendiri (id_guru = sesi)
                        // 2. ATAU jadwal orang lain di mana saya jadi pengganti (id_guru_pengganti = sesi) DAN Statusnya Disetujui
                        
                        $sql = mysqli_query($con, "
                            SELECT jp.*, g_asal.nama_guru as nama_guru_asal
                            FROM tb_jadwal_piket jp
                            LEFT JOIN tb_guru g_asal ON jp.id_guru = g_asal.id_guru
                            WHERE 
                                jp.id_guru = '$sesi' 
                                OR 
                                (jp.id_guru_pengganti = '$sesi' AND jp.status_pengganti = 'Disetujui')
                            ORDER BY jp.tanggal_piket DESC
                        ");

                        while ($row = mysqli_fetch_array($sql)) {
                            $tanggal = date('d-m-Y', strtotime($row['tanggal_piket']));
                            $hari = $row['hari_piket'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <strong><?= $tanggal; ?></strong> <br>
                                <small>(<?= $hari; ?>)</small>
                            </td>
                            <td>
                                <?= $row['keterangan']; ?>
                                <?php 
                                // Jika ini jadwal pengganti, tampilkan info tambahan
                                if ($row['id_guru'] != $sesi) {
                                    echo "<br><small class='text-primary'><em>*Menggantikan: " . $row['nama_guru_asal'] . "</em></small>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                if ($row['id_guru'] == $sesi) {
                                    // Ini jadwal asli guru tersebut
                                    if ($row['id_guru_pengganti'] != NULL && $row['status_pengganti'] == 'Disetujui') {
                                        echo "<span class='badge badge-warning'>Digantikan Orang Lain</span>";
                                    } else {
                                        echo "<span class='badge badge-success'>Piket Asli</span>";
                                    }
                                } else {
                                    // Ini jadwal pengganti
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