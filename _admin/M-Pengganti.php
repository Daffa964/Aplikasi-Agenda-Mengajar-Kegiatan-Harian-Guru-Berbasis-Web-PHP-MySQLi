<form action="?page=act" method="post" accept-charset="utf-8">
    <input type="hidden" name="id_jadwal" value="<?=$id_jadwal_yang_mau_diganti?>">
    <input type="hidden" name="id_guru_piket_asli" value="<?=$id_guru_asli?>">
    
    <div class="form-group">
        <label>Guru Yang Menggantikan</label>
        <select name="id_guru_pengganti" class="form-control" required>
            <option value="">-- Pilih Guru Pengganti --</option>
            <?php 
            // Query untuk semua guru, kecuali guru piket asli
            $sqlGanti = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru WHERE id_guru != '$id_guru_asli' ORDER BY nama_guru ASC");
            while ($g = mysqli_fetch_array($sqlGanti)) {
                echo "<option value='".$g['id_guru']."'>".$g['nama_guru']."</option>";
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Catatan Alasan Penggantian</label>
        <textarea name="catatan" class="form-control" required></textarea>
    </div>

    <button class="btn btn-success" type="submit" name="simpan_pengganti">
        <span class="fa fa-sync-alt"></span> Konfirmasi Penggantian
    </button>
</form>