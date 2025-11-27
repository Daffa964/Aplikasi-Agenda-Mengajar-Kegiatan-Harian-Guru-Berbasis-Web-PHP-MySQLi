<?php
// Ambil Tahun Ajaran Aktif untuk input otomatis
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Y' OR status='Aktif' LIMIT 1");
$dataTa = mysqli_fetch_array($sqlTa);
$id_tajaran_aktif = $dataTa['id_tajaran'];
$tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong><i class="fa fa-plus"></i> Tambah Jadwal & Agenda Guru Piket</strong>
        </div>
        <div class="card-body card-block">
            <form action="proses.php" method="post" class="form-horizontal">
                
                <input type="hidden" name="id_tajaran" value="<?= $id_tajaran_aktif; ?>">

                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Tahun Ajaran</label></div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static"><strong><?= $tahun_ajaran_aktif; ?></strong></p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Tanggal</label></div>
                    <div class="col-12 col-md-9">
                        <input type="date" name="tanggal_piket" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Hari</label></div>
                    <div class="col-12 col-md-9">
                        <select name="hari_piket" class="form-control" required>
                            <option value="">- Pilih Hari -</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Guru Piket</label></div>
                    <div class="col-12 col-md-9">
                        <select name="id_guru" class="form-control select2" required>
                            <option value="">- Pilih Guru Piket -</option>
                            <?php 
                            $sqlGuru = mysqli_query($con, "SELECT * FROM tb_guru ORDER BY nama_guru ASC");
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                echo "<option value='$g[id_guru]'>$g[nama_guru]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label class=" form-control-label">Agenda / Keterangan</label></div>
                    <div class="col-12 col-md-9">
                        <textarea name="keterangan" rows="4" placeholder="Contoh: Membunyikan bel, Mencatat siswa terlambat, Keliling kelas..." class="form-control" required></textarea>
                    </div>
                </div>

                <hr>
                <div class="form-actions form-group">
                    <button type="submit" name="simpan_jadwal" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="?page=v_jadwal_piket" class="btn btn-warning btn-sm">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>