<?php
// Pastikan variabel koneksi database ($con) sudah tersedia

// --- 1. Ambil Tahun Ajaran Aktif ---
$id_tajaran_aktif = 0;
$tahun_ajaran_aktif = '';

// Query mengambil ID dan Nama Tahun Ajaran Aktif dari tb_tajaran
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif' OR status='Y' LIMIT 1");
if ($sqlTa && mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}
?>

<div class="col-lg-12">
    <div class="card" style="border-radius:10px;">
        <div class="card-header">
            <strong class="card-title"><span class="fa fa-users"></span> Daftar Guru yang Digantikan</strong>
        </div>
        <div class="card-body">
            <small class="text-danger">T.A. Aktif: **<?php echo $tahun_ajaran_aktif ? $tahun_ajaran_aktif : 'Tidak Ditemukan'; ?>**</small>
            
            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal</th> 
                        <th scope="col">Guru Utama (Piket)</th> 
                        <th scope="col">Guru Pengganti</th> 
                        <th scope="col">Status</th>     
                        <th scope="col">Catatan</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    // Kondisi WHERE berdasarkan Tahun Ajaran Aktif (jika ditemukan)
                    $where_tajaran = $id_tajaran_aktif ? "AND jp.id_tajaran = '$id_tajaran_aktif'" : "";

                    // Query mengambil data dari tb_jadwal_piket, hanya yang memiliki guru pengganti
                    $sqlPengganti = mysqli_query($con, "
                        SELECT 
                            jp.id_jadwal,
                            jp.tanggal_piket,
                            jp.hari_piket,
                            jp.id_guru,
                            jp.id_guru_pengganti,
                            jp.status_pengganti,
                            jp.catatan_penggantian,
                            gu.nama_guru AS guru_utama,
                            gp.nama_guru AS guru_pengganti
                        FROM tb_jadwal_piket jp
                        INNER JOIN tb_guru gu ON jp.id_guru = gu.id_guru
                        LEFT JOIN tb_guru gp ON jp.id_guru_pengganti = gp.id_guru 
                        -- HANYA ambil data yang sudah diisi guru pengganti (id_guru_pengganti TIDAK NULL)
                        WHERE jp.id_guru_pengganti IS NOT NULL 
                        " . $where_tajaran . "
                        ORDER BY jp.tanggal_piket DESC
                    ") or die(mysqli_error($con));

                    if (mysqli_num_rows($sqlPengganti) > 0) {
                        while ($data = mysqli_fetch_array($sqlPengganti)) {
                            // Tentukan warna status
                            $status_class = '';
                            if ($data['status_pengganti'] == 'Ya') {
                                $status_class = 'badge badge-success';
                            } else {
                                $status_class = 'badge badge-warning';
                            }
                    ?>
                    <tr>
                        <th scope="row"><?=$no++?>. </th>
                        <td>
                            <strong><?= date('d M Y', strtotime($data['tanggal_piket'])); ?></strong><br>
                            <small>(<?= $data['hari_piket'];?>)</small>
                        </td> 
                        <td><?=$data['guru_utama'];?></td> 
                        <td>
                            <span class="text-info">
                                **<?=$data['guru_pengganti'] ? $data['guru_pengganti'] : 'Belum Ditunjuk' ;?>**
                            </span>
                        </td>     
                        <td>
                            <span class="<?=$status_class?>">
                                <?= $data['status_pengganti'];?>
                            </span>
                        </td>
                        <td><?= $data['catatan_penggantian'] ? $data['catatan_penggantian'] : '-';?></td>
                        <td>
                            <a href="?page=e_gurupengganti&idj=<?=$data['id_jadwal'];?>" class="btn btn-warning btn-sm" title="Edit Pengganti"> 
                                <span class="fa fa-edit"></span>
                            </a>
                            </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center">Tidak Ada Jadwal Piket yang Memiliki Guru Pengganti Saat Ini.</td></tr>';
                    }
                    ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>