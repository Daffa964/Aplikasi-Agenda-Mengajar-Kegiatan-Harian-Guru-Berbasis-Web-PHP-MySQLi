<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong><i class="fa fa-plus"></i> Tambah Kegiatan Lainnya</strong>
            </div>
            <div class="card-body card-block">
                <form action="proses.php" method="post" enctype="multipart/form-data" class="form-horizontal">

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Tanggal Kegiatan</label></div>
                        <div class="col-12 col-md-9">
                            <input type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d');?>" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Nama Kegiatan</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="nama_kegiatan" class="form-control" placeholder="Contoh: Rapat Dewan Guru, Upacara, dll" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Pelaksana (Guru)</label></div>
                        <div class="col-12 col-md-9">
                            <select name="id_guru" class="form-control standardSelect">
                                <option value="0">- Kegiatan Umum / Sekolah -</option>
                                <?php
                                // Ambil data guru untuk opsi pelaksana
                                $guru = mysqli_query($con, "SELECT * FROM tb_guru ORDER BY nama_guru ASC");
                                while ($g = mysqli_fetch_array($guru)) {
                                    echo "<option value='$g[id_guru]'>$g[nama_guru]</option>";
                                }
                                ?>
                            </select>
                            <small class="help-block form-text">Pilih nama guru jika kegiatan perorangan, atau biarkan kosong jika kegiatan sekolah.</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Waktu Mulai</label></div>
                        <div class="col-12 col-md-9">
                            <input type="time" name="jam_mulai" class="form-control" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Waktu Selesai</label></div>
                        <div class="col-12 col-md-9">
                            <input type="time" name="jam_selesai" class="form-control" required>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label class="form-control-label">Keterangan</label></div>
                        <div class="col-12 col-md-9">
                            <textarea name="keterangan" rows="4" class="form-control" placeholder="Deskripsi singkat kegiatan..."></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-actions form-group">
                        <button type="submit" name="simpan_agenda_lain" class="btn btn-primary btn-sm">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                        <a href="?page=v_aglain" class="btn btn-warning btn-sm">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>