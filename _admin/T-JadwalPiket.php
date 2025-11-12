<?php
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> <span class="fa fa-calendar-plus"></span> Form</strong> Tambah Jadwal Piket
        </div>
        <div class="card-body card-block">
            <form action="proses.php" method="post" class="form-horizontal">
                
                <input type="hidden" name="id_tajaran" value="<?php echo $id_tahun_ajaran_aktif; ?>">
                <input type="hidden" name="act" value="simpan_jadwal_piket">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="static-input" class="form-control-label">T.A. Aktif</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static text-danger">
                            **<?php echo $tahun_ajaran_aktif ? $tahun_ajaran_aktif : 'Tidak Ditemukan'; ?>**
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="date-input" class=" form-control-label">Tanggal Piket</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="date" id="date-input" name="tanggal_piket" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select-hari" class=" form-control-label">Hari Piket</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="hari_piket" id="select-hari" class="form-control" required>
                            <option value="">Pilih Hari</option>
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
                    <div class="col col-md-3">
                        <label for="select-guru" class=" form-control-label">Guru Piket</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="id_guru" id="select-guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            <?php 
                            // Pastikan $sqlGuru sudah dieksekusi sebelum mencapai bagian ini
                            // Kita reset pointer query jika diperlukan (optional)
                            // mysqli_data_seek($sqlGuru, 0); 
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                echo "<option value='".$g['id_guru']."'>".$g['nama_guru']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="textarea-input" class=" form-control-label">Keterangan</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea name="keterangan" id="textarea-input" rows="3" placeholder="Keterangan Piket..." class="form-control" required></textarea>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <button type="submit" form="form-horizontal" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>
            <button type="reset" class="btn btn-danger">
                <i class="fa fa-ban"></i> Reset
            </button>
            <a href="javascript:history.back()" class="btn btn-warning"> 
                <span class="fa fa-chevron-left"></span> Kembali 
            </a>
        </div>
    </div>
</div>