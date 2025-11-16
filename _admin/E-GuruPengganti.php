<?php 
// File: _admin/E-GuruPengganti.php
// Form untuk Admin menyetujui atau menolak pengajuan pengganti

// 1. Ambil ID Jadwal dari URL
$id_jadwal = $_GET['idj'] ?? null;

if (!$id_jadwal) {
    echo "<div class='alert alert-danger'>Kesalahan: ID Jadwal tidak ditemukan.</div>";
    return;
}

// 2. Query data pengajuan
$sql = mysqli_query($con, "
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
    WHERE jp.id_jadwal = '" . mysqli_real_escape_string($con, $id_jadwal) . "'
") or die(mysqli_error($con));

$data = mysqli_fetch_array($sql);

if (!$data) {
     echo "<div class='alert alert-danger'>Kesalahan: Data pengajuan tidak ditemukan.</div>";
    return;
}

// 3. Ambil daftar semua guru (untuk opsi jika ingin mengubah pengganti)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");

?>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"> 
                <span class="fa fa-check-square-o"></span> Persetujuan Guru Pengganti
            </strong>
        </div>
        <div class="card-body card-block">
            <form action="?page=proses" method="POST">
                
                <input type="hidden" name="id_jadwal" value="<?php echo htmlspecialchars($data['id_jadwal']); ?>">

                <div class="form-group">
                    <label class=" form-control-label">Tanggal Piket</label>
                    <input type="text" class="form-control" 
                           value="<?php echo date('d F Y', strtotime($data['tanggal_piket'])); ?> (<?php echo htmlspecialchars($data['hari_piket']); ?>)" 
                           disabled>
                </div>
                
                <div class="form-group">
                    <label class=" form-control-label">Guru Utama (Yang Mengajukan)</label>
                    <input type="text" class="form-control" 
                           value="<?php echo htmlspecialchars($data['guru_utama']); ?>" 
                           disabled>
                </div>

                <div class="form-group">
                    <label for="id_guru_pengganti" class=" form-control-label">Guru Pengganti (Yang Diajukan)</label>
                    <select name="id_guru_pengganti" id="id_guru_pengganti" class="form-control" required>
                        <option value="">-- Pilih Guru Pengganti --</option>
                        <?php 
                        if (mysqli_num_rows($sqlGuru) > 0) {
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                $selected = ($g['id_guru'] == $data['id_guru_pengganti']) ? 'selected' : '';
                                echo "<option value='".$g['id_guru']."' ".$selected.">".$g['nama_guru']."</option>";
                            }
                        }
                        ?>
                    </select>
                    <small class="form-text text-muted">Admin bisa mengubah guru pengganti jika diperlukan.</small>
                </div>

                <div class="form-group">
                    <label for="catatan_penggantian" class=" form-control-label">Alasan / Catatan dari Guru</label>
                    <textarea name="catatan_penggantian" id="catatan_penggantian" rows="3" class="form-control"><?php echo htmlspecialchars($data['catatan_penggantian']); ?></textarea>
                </div>

                <hr>

                <div class="form-group">
                    <label for="status_pengganti" class=" form-control-label">Status Persetujuan <small class="text-danger">*</small></label>
                    <select name="status_pengganti" id="status_pengganti" class="form-control" required>
                        <?php
                        // Menentukan status saat ini
                        $status_sekarang = $data['status_pengganti'];
                        ?>
                        <option value="Tidak" <?php echo ($status_sekarang == 'Tidak') ? 'selected' : ''; ?>>
                            Tolak (Tidak)
                        </option>
                        <option value="Ya" <?php echo ($status_sekarang == 'Ya') ? 'selected' : ''; ?>>
                            Setujui (Ya)
                        </option>
                    </select>
                </div>

                <div class="card-footer">
                    <button type="submit" name="egurupengganti" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="?page=v_guru_pengganti" class="btn btn-danger btn-sm">
                        <i class="fa fa-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div><?php 
// File: _admin/E-GuruPengganti.php
// Form untuk Admin menyetujui atau menolak pengajuan pengganti

// 1. Ambil ID Jadwal dari URL
$id_jadwal = $_GET['idj'] ?? null;

if (!$id_jadwal) {
    echo "<div class='alert alert-danger'>Kesalahan: ID Jadwal tidak ditemukan.</div>";
    return;
}

// 2. Query data pengajuan
$sql = mysqli_query($con, "
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
    WHERE jp.id_jadwal = '" . mysqli_real_escape_string($con, $id_jadwal) . "'
") or die(mysqli_error($con));

$data = mysqli_fetch_array($sql);

if (!$data) {
     echo "<div class='alert alert-danger'>Kesalahan: Data pengajuan tidak ditemukan.</div>";
    return;
}

// 3. Ambil daftar semua guru (untuk opsi jika ingin mengubah pengganti)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");

?>

<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"> 
                <span class="fa fa-check-square-o"></span> Persetujuan Guru Pengganti
            </strong>
        </div>
        <div class="card-body card-block">
            <form action="?page=proses" method="POST">
                
                <input type="hidden" name="id_jadwal" value="<?php echo htmlspecialchars($data['id_jadwal']); ?>">

                <div class="form-group">
                    <label class=" form-control-label">Tanggal Piket</label>
                    <input type="text" class="form-control" 
                           value="<?php echo date('d F Y', strtotime($data['tanggal_piket'])); ?> (<?php echo htmlspecialchars($data['hari_piket']); ?>)" 
                           disabled>
                </div>
                
                <div class="form-group">
                    <label class=" form-control-label">Guru Utama (Yang Mengajukan)</label>
                    <input type="text" class="form-control" 
                           value="<?php echo htmlspecialchars($data['guru_utama']); ?>" 
                           disabled>
                </div>

                <div class="form-group">
                    <label for="id_guru_pengganti" class=" form-control-label">Guru Pengganti (Yang Diajukan)</label>
                    <select name="id_guru_pengganti" id="id_guru_pengganti" class="form-control" required>
                        <option value="">-- Pilih Guru Pengganti --</option>
                        <?php 
                        if (mysqli_num_rows($sqlGuru) > 0) {
                            while ($g = mysqli_fetch_array($sqlGuru)) {
                                $selected = ($g['id_guru'] == $data['id_guru_pengganti']) ? 'selected' : '';
                                echo "<option value='".$g['id_guru']."' ".$selected.">".$g['nama_guru']."</option>";
                            }
                        }
                        ?>
                    </select>
                    <small class="form-text text-muted">Admin bisa mengubah guru pengganti jika diperlukan.</small>
                </div>

                <div class="form-group">
                    <label for="catatan_penggantian" class=" form-control-label">Alasan / Catatan dari Guru</label>
                    <textarea name="catatan_penggantian" id="catatan_penggantian" rows="3" class="form-control"><?php echo htmlspecialchars($data['catatan_penggantian']); ?></textarea>
                </div>

                <hr>

                <div class="form-group">
                    <label for="status_pengganti" class=" form-control-label">Status Persetujuan <small class="text-danger">*</small></label>
                    <select name="status_pengganti" id="status_pengganti" class="form-control" required>
                        <?php
                        // Menentukan status saat ini
                        $status_sekarang = $data['status_pengganti'];
                        ?>
                        <option value="Tidak" <?php echo ($status_sekarang == 'Tidak') ? 'selected' : ''; ?>>
                            Tolak (Tidak)
                        </option>
                        <option value="Ya" <?php echo ($status_sekarang == 'Ya') ? 'selected' : ''; ?>>
                            Setujui (Ya)
                        </option>
                    </select>
                </div>

                <div class="card-footer">
                    <button type="submit" name="egurupengganti" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="?page=v_guru_pengganti" class="btn btn-danger btn-sm">
                        <i class="fa fa-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>