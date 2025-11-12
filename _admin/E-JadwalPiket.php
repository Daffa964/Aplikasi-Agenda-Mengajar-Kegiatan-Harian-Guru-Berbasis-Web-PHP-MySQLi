<?php
// Pastikan variabel koneksi database ($con) sudah tersedia

// Ambil ID Jadwal dari URL (parameter 'idj' dari link edit)
$id_jadwal_edit = @$_GET['idj'];

if (empty($id_jadwal_edit)) {
    echo "<script>alert('ID Jadwal tidak ditemukan.'); window.location='?page=v_jadwal_piket';</script>";
    exit;
}

// --- 1. Ambil Data Jadwal yang akan Diedit ---
$sqlEdit = mysqli_query($con, "
    SELECT 
        jp.*, 
        g.nama_guru,
        ta.tahun_ajaran
    FROM tb_jadwal_piket jp
    LEFT JOIN tb_guru g ON jp.id_guru = g.id_guru
    LEFT JOIN tb_tajaran ta ON jp.id_tajaran = ta.id_tajaran
    WHERE jp.id_jadwal='$id_jadwal_edit'
") or die(mysqli_error($con));

$dataEdit = mysqli_fetch_array($sqlEdit);

if (mysqli_num_rows($sqlEdit) == 0) {
    echo "<script>alert('Data Jadwal Piket tidak ditemukan.'); window.location='?page=v_jadwal_piket';</script>";
    exit;
}

// Query untuk mengambil daftar Guru (untuk dropdown)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");
$hari_piket_options = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; // Opsi Hari
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong> <span class="fa fa-edit"></span> Form</strong> Edit Jadwal Piket
        </div>
        <div class="card-body card-block">
            <form action="?page=act" method="post" class="form-horizontal" id="form-edit-jadwal">
                
                <input type="hidden" name="id_jadwal" value="<?php echo $dataEdit['id_jadwal']; ?>">
                <input type="hidden" name="id_tajaran" value="<?php echo $dataEdit['id_tajaran']; ?>">

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="static-input" class="form-control-label">T.A. Saat Ini</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <p class="form-control-static text-danger">
                            **<?php echo $dataEdit['tahun_ajaran'] ? $dataEdit['tahun_ajaran'] : 'Tidak Ditemukan'; ?>**
                        </p>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="date-input" class=" form-control-label">Tanggal Piket</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="date" id="date-input" name="tanggal_piket" 
                               value="<?php echo $dataEdit['tanggal_piket']; ?>" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select-hari" class=" form-control-label">Hari Piket</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="hari_piket" id="select-hari" class="form-control" required>
                            <option value="">Pilih Hari</option>
                            <?php foreach ($hari_piket_options as $hari) { 
                                $selected = ($dataEdit['hari_piket'] == $hari) ? 'selected' : '';
                                echo "<option value='".$hari."' ".$selected.">".$hari."</option>";
                            } ?>
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
                            mysqli_data_seek($sqlGuru, 0); 
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                $selected = ($g['id_guru'] == $dataEdit['id_guru']) ? 'selected' : '';
                                echo "<option value='".$g['id_guru']."' ".$selected.">".$g['nama_guru']."</option>";
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
                        <textarea name="keterangan" id="textarea-input" rows="3" placeholder="Keterangan Piket..." 
                                  class="form-control" required><?php echo $dataEdit['keterangan']; ?></textarea>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <button type="submit" form="form-edit-jadwal" class="btn btn-warning" name="ejadwalpiket">
                <i class="fa fa-save"></i> **Update Data**
            </button>
            <a href="?page=v_jadwal_piket" class="btn btn-secondary"> 
                <span class="fa fa-chevron-left"></span> Batal
            </a>
        </div>
    </div>
</div>