<?php
// Ambil ID Jadwal dan Tanggal dari URL
$id_jadwal = $_GET['id'] ?? null;
$tanggal = $_GET['tgl'] ?? null;

// (Opsional tapi disarankan) Anda bisa tambahkan kueri untuk mengambil detail data
// $dataJadwal = mysqli_query($con, "SELECT * FROM tb_jadwal_piket WHERE id_jadwal_piket = '$id_jadwal'");
// $jadwal = mysqli_fetch_assoc($dataJadwal);
// ... (tampilkan nama guru yg piket, dll jika perlu) ...

?>

<div class="card">
    <div class="card-header">
        <strong><i class="fa fa-user-plus"></i> Ajukan Guru Pengganti</strong>
    </div>
    <div class="card-body card-block">
        
        <form action="?page=act" method="POST">

            <input type="hidden" name="id_jadwal" value="<?php echo htmlspecialchars($id_jadwal); ?>">
            <input type="hidden" name="tgl_piket" value="<?php echo htmlspecialchars($tanggal); ?>">
            
            <div class="form-group">
                <label for="tanggal">Tanggal Piket</label>
                <input type="text" id="tanggal" class="form-control" value="<?php echo htmlspecialchars($tanggal); ?>" readonly>
            </div>

            <div class="form-group">
                <label for="id_guru_pengganti">Pilih Guru Pengganti</label>
                <select name="id_guru_pengganti" id="id_guru_pengganti" class="form-control" required>
                    <option value="">-- Pilih Guru --</option>
                    <?php
                    // Ambil semua guru (kecuali guru yg sedang login/piket)
                    $sql_guru = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru != '$sesi'"); // $sesi dari index.php
                    while ($g = mysqli_fetch_array($sql_guru)) {
                        echo "<option value='{$g['id_guru']}'>{$g['nama_guru']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="ajukan_pengganti" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Pengajuan
            </button>
            <a href="?page=v_ajukan_pengganti" class="btn btn-danger">
                <i class="fa fa-times"></i> Batal
            </a>
        </form>
    </div>
</div>