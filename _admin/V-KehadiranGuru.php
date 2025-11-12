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
            <strong class="card-title"><span class="fa fa-clipboard-list"></span> Daftar Riwayat Kehadiran Guru</strong>
        </div>
        <div class="card-body">
            <small class="text-danger">T.A. Aktif: **<?php echo $tahun_ajaran_aktif ? $tahun_ajaran_aktif : 'Tidak Ditemukan'; ?>**</small>
            
            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal & Keterangan</th> 
                        <th scope="col">Nama Guru</th> 
                        <th scope="col">Status</th> 
                        <th scope="col">Waktu Masuk</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no=1;
                    // Kondisi WHERE berdasarkan Tahun Ajaran Aktif (jika ditemukan)
                    $where_tajaran = $id_tajaran_aktif ? " WHERE kh.id_tajaran = '$id_tajaran_aktif'" : "";

                    // Query mengambil data kehadiran guru dari tb_kehadiran_guru
                    $sqlKehadiran = mysqli_query($con, "
                        SELECT 
                            kh.id_kehadiran,
                            kh.tanggal_kehadiran,
                            kh.status_kehadiran,
                            kh.waktu_masuk,
                            kh.keterangan,
                            g.nama_guru
                        FROM tb_kehadiran_guru kh
                        INNER JOIN tb_guru g ON kh.id_guru = g.id_guru
                        " . $where_tajaran . "
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
                        <th scope="row"><?=$no++?>. </th>
                        <td>
                            <strong><?= date('d M Y', strtotime($data['tanggal_kehadiran'])); ?></strong><br>
                            <small>(<?= $data['keterangan'] ? $data['keterangan'] : '-';?>)</small>
                        </td> 
                        <td><?=$data['nama_guru'];?></td> 
                        <td>
                            <span class="<?=$status_class?>">
                                <?= $data['status_kehadiran'];?>
                            </span>
                        </td>     
                        <td>
                            <span class="text-info">
                                **<?= $data['waktu_masuk'] ? date('H:i', strtotime($data['waktu_masuk'])) : '-'; ?>**
                            </span>
                        </td>
                        <td>
                            <a href="?page=e_kehadiran_guru&idk=<?=$data['id_kehadiran'];?>" class="btn btn-warning btn-sm" title="Edit Kehadiran"> 
                                <span class="fa fa-edit"></span>
                            </a>
                            <a href="?page=d_kehadiran_guru&idk=<?=$data['id_kehadiran'];?>" class="btn btn-danger btn-sm" title="Hapus Kehadiran" onclick="return confirm('Yakin hapus data kehadiran ini?')"> 
                                <span class="fa fa-trash"></span>
                            </a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center">Tidak Ada Riwayat Kehadiran Guru yang Tercatat Saat Ini.</td></tr>';
                    }
                    ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>