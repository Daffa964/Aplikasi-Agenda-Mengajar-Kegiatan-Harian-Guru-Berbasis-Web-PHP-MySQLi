<?php
// Pastikan variabel koneksi database ($con) sudah tersedia

// --- 1. Ambil Tahun Ajaran Aktif ---
$id_tajaran_aktif = 0;
$tahun_ajaran_aktif = '';

// Query mengambil ID dan Nama Tahun Ajaran Aktif (asumsi kolom status='Aktif' atau status='Y')
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif' OR status='Y' LIMIT 1");
if ($sqlTa && mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}

// Query untuk mengambil daftar Guru (untuk dropdown di form)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");
?>

<div class="row">
    
    <div class="col-lg-6">
        <div class="card" style="border-radius:10px;">
            <div class="card-header">
                <strong class="card-title"><span class="fa fa-calendar-alt"></span> Daftar Jadwal Piket</strong>
            </div>
            <div class="card-body">
                <small class="text-danger">T.A. Aktif: **<?php echo $tahun_ajaran_aktif ? $tahun_ajaran_aktif : 'Tidak Ditemukan'; ?>**</small>
                
                <table class="table table-dark table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal & Hari</th> 
                            <th scope="col">Guru Piket</th>       
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        // Query Jadwal Piket: JOIN tb_guru menggunakan id_guru
                        $sqlJadwal = mysqli_query($con, "
                            SELECT 
                                jp.id_jadwal,
                                jp.tanggal_piket,
                                jp.hari_piket,
                                g.nama_guru
                            FROM tb_jadwal_piket jp
                            INNER JOIN tb_guru g ON jp.id_guru = g.id_guru  
                            -- Filter berdasarkan tahun ajaran aktif
                            " . ($id_tajaran_aktif ? "WHERE jp.id_tajaran = '$id_tajaran_aktif'" : "") . "
                            ORDER BY jp.tanggal_piket DESC
                        ") or die(mysqli_error($con));

                        while ($data = mysqli_fetch_array($sqlJadwal)) {
                        ?>
                        <tr>
                            <th scope="row"><?=$no++?>. </th>
                            <td>
                                <strong><?= date('d M Y', strtotime($data['tanggal_piket'])); ?></strong><br>
                                <small>(<?= $data['hari_piket'];?>)</small>
                            </td> 
                            <td><?=$data['nama_guru'];?></td>        
                            <td>
                                <a href="?page=e_jadwal&idj=<?=$data['id_jadwal'];?>" class="btn btn-warning btn-sm" title="Edit Jadwal"> 
                                    <span class="fa fa-edit"></span>
                                </a>
                                <a href="?page=d_jadwal&id=<?=$data['id_jadwal'];?>" onclick="return confirm('Yakin !! Hapus Jadwal Tanggal [<?= date('d/m/Y', strtotime($data['tanggal_piket'])); ?>] ?')" class="btn btn-danger btn-sm" title="Hapus Jadwal">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card" style="border-radius:10px;">
            <div class="card-header">
                <strong class="card-title"><span class="fa fa-plus"></span> Tambah Jadwal Piket</strong>
            </div>
            <div class="card-body">
                <form action="?page=act" method="post" accept-charset="utf-8"> 
                    
                    <input type="hidden" name="id_tajaran" value="<?php echo $id_tajaran_aktif; ?>">

                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text" name="" placeholder="Tidak Perlu Diisi (Auto)" class="form-control" disabled="">
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Piket</label>
                        <input type="date" name="tanggal_piket" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Hari Piket</label>
                        <select name="hari_piket" class="form-control" required>
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Guru Piket</label>
                        <select name="id_guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            <?php 
                            mysqli_data_seek($sqlGuru, 0); 
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                echo "<option value='".$g['id_guru']."'>".$g['nama_guru']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" required></textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="simpan_jadwal"> 
                            <span class="fa fa-save"></span> Simpan
                        </button>  
                        <button class="btn btn-danger" type="reset"> 
                            <span class="fa fa-close"></span> Reset
                        </button> 
                        <a href="javascript:history.back()" class="btn btn-warning"> 
                            <span class="fa fa-chevron-left"></span> Kembali 
                        </a> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>