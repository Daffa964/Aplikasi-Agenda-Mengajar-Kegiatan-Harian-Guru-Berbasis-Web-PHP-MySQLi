<?php
// Ambil ID dari URL
$id = $_GET['id'];
$edit = mysqli_query($con, "SELECT * FROM tb_agenda_lain WHERE id_lain='$id'");
$d = mysqli_fetch_array($edit);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-edit"></i> Edit Kegiatan Lainnya</strong>
            </div>
            <div class="card-body card-block">
                <form action="?page=act" method="post" class="form-horizontal">

                    <input type="hidden" name="id_lain" value="<?=$d['id_lain'];?>">

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Tanggal</label></div>
                        <div class="col-12 col-md-9">
                            <input type="date" name="tanggal" class="form-control" value="<?=$d['tanggal'];?>" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Nama Kegiatan</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="nama_kegiatan" class="form-control" value="<?=$d['nama_kegiatan'];?>" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Pelaksana</label></div>
                        <div class="col-12 col-md-9">
                            <select name="id_guru" class="form-control standardSelect">
                                <option value="0">Kegiatan Umum / Sekolah</option>
                                <?php
                                $guru = mysqli_query($con, "SELECT * FROM tb_guru ORDER BY nama_guru ASC");
                                while ($g = mysqli_fetch_array($guru)) {
                                    // Cek jika guru ini yang dipilih sebelumnya
                                    $selected = ($g['id_guru'] == $d['id_guru']) ? "selected" : "";
                                    echo "<option value='$g[id_guru]' $selected>$g[nama_guru]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Waktu</label></div>
                        <div class="col-12 col-md-4">
                            <input type="time" name="jam_mulai" class="form-control" value="<?=$d['jam_mulai'];?>" required>
                            <small>Mulai</small>
                        </div>
                        <div class="col-12 col-md-4">
                            <input type="time" name="jam_selesai" class="form-control" value="<?=$d['jam_selesai'];?>" required>
                            <small>Selesai</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Keterangan</label></div>
                        <div class="col-12 col-md-9">
                            <textarea name="keterangan" rows="4" class="form-control"><?=$d['keterangan'];?></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-actions form-group">
                        <button type="submit" name="ubah_agenda_lain" class="btn btn-success btn-sm">
                            <i class="fa fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="?page=v_aglain" class="btn btn-secondary btn-sm">
                            <i class="fa fa-ban"></i> Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>