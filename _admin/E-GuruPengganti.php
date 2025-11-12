<?php
// Pastikan variabel koneksi database ($con) sudah tersedia

// Ambil ID Jadwal dari URL (parameter 'idj' dari link edit)
$id_jadwal_edit = @$_GET['idj'];

if (empty($id_jadwal_edit)) {
    echo "<script>alert('ID Jadwal tidak ditemukan.'); window.location='?page=v_guru_pengganti';</script>";
    exit;
}

// --- 1. Ambil Data Jadwal yang akan Diedit, termasuk Guru Utama dan Pengganti ---
$sqlEdit = mysqli_query($con, "
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
    INNER JOIN tb_guru gu ON jp.id_guru = gu.id_guru  -- Guru Utama (Wajib ada)
    LEFT JOIN tb_guru gp ON jp.id_guru_pengganti = gp.id_guru -- Guru Pengganti (Bisa NULL)
    WHERE jp.id_jadwal='$id_jadwal_edit'
") or die(mysqli_error($con));

$dataEdit = mysqli_fetch_array($sqlEdit);

if (mysqli_num_rows($sqlEdit) == 0) {
    echo "<script>alert('Data Jadwal Piket tidak ditemukan.'); window.location='?page=v_guru_pengganti';</script>";
    exit;
}

// Query untuk mengambil daftar semua Guru (untuk dropdown Guru Pengganti)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");

// Opsi Status Pengganti berdasarkan skema tabel (Ya, Tidak)
$status_options = ['Ya', 'Tidak']; 
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> <span class="fa fa-edit"></span> Form</strong> Edit Guru Pengganti
        </div>
        <div class="card-body card-block">
            <form action="?page=act" method="post" class="form-horizontal" id="form-edit-pengganti">
                
                <input type="hidden" name="id_jadwal" value="<?php echo $dataEdit['id_jadwal']; ?>">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class="form-control-label">Jadwal Asli</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static">
                            **<?= date('d M Y', strtotime($dataEdit['tanggal_piket'])); ?>** (<?= $dataEdit['hari_piket'];?>)
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label class="form-control-label">Guru Utama (Piket)</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static text-info">
                            **<?php echo $dataEdit['guru_utama']; ?>**
                        </p>
                    </div>
                </div>

                <hr>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select-pengganti" class=" form-control-label">Guru Pengganti</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="id_guru_pengganti" id="select-pengganti" class="form-control">
                            <option value="">-- Pilih Guru Pengganti (Kosongkan jika tidak ada) --</option>
                            <?php 
                            // Pastikan kursor kembali ke awal set data
                            mysqli_data_seek($sqlGuru, 0); 
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                $selected = ($g['id_guru'] == $dataEdit['id_guru_pengganti']) ? 'selected' : '';
                                echo "<option value='".$g['id_guru']."' ".$selected.">".$g['nama_guru']."</option>";
                            }
                            ?>
                        </select>
                        <small class="form-text text-muted">Guru yang akan menggantikan tugas piket.</small>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select-status" class=" form-control-label">Status Pengganti</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="status_pengganti" id="select-status" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <?php foreach ($status_options as $status) { 
                                $selected = ($dataEdit['status_pengganti'] == $status) ? 'selected' : '';
                                echo "<option value='".$status."' ".$selected.">".$status."</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="textarea-catatan" class=" form-control-label">Catatan Penggantian</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea name="catatan_penggantian" id="textarea-catatan" rows="3" placeholder="Contoh: Sakit, Cuti, dll." 
                                 class="form-control"><?php echo $dataEdit['catatan_penggantian']; ?></textarea>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <button type="submit" form="form-edit-pengganti" class="btn btn-warning" name="egurupengganti">
                <i class="fa fa-save"></i> **Update Pengganti**
            </button>
            <a href="?page=v_guru_pengganti" class="btn btn-secondary"> 
                <span class="fa fa-chevron-left"></span> Batal
            </a>
        </div>
    </div>
</div>