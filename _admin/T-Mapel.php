<div class="card">
    <div class="card-header">
        <strong><i class="fa fa-plus"></i> Tambah Mata Pelajaran Baru</strong>
    </div>
    <div class="card-body">
        <form action="proses.php" method="post">
            
            <div class="form-group">
                <label>Nama Mata Pelajaran</label>
                <select name="nama_mapel" class="form-control" required>
                    <option value="">- Pilih Mata Pelajaran -</option>
                    <?php
                    // Ambil Data dari Master Mapel
                    $qMapel = mysqli_query($con, "SELECT * FROM tb_mastermapel");
                    while($m = mysqli_fetch_array($qMapel)){
                        echo "<option value='$m[mapel]'>$m[mapel]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="idkelas" class="form-control" required>
                    <option value="">- Pilih Kelas -</option>
                    <?php
                    $qKelas = mysqli_query($con, "SELECT * FROM tb_kelas ORDER BY kelas ASC");
                    while($k = mysqli_fetch_array($qKelas)){
                        echo "<option value='$k[idkelas]'>$k[kelas]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Guru Pengampu</label>
                <select name="id_guru" class="form-control" required>
                    <option value="">- Pilih Guru -</option>
                    <?php
                    $qGuru = mysqli_query($con, "SELECT * FROM tb_guru ORDER BY nama_guru ASC");
                    while($g = mysqli_fetch_array($qGuru)){
                        echo "<option value='$g[id_guru]'>$g[nama_guru]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat" class="form-control" required>
                    <option value="">- Pilih Tingkat -</option>
                    <option value="VII">Kelas VII (7)</option>
                    <option value="VIII">Kelas VIII (8)</option>
                    <option value="IX">Kelas IX (9)</option>
                </select>
            </div>

            <input type="hidden" name="jurusan" value="-">

            <hr>
            <button type="submit" name="Tmapel" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Data
            </button>
            <a href="?page=v_mapel" class="btn btn-warning">Kembali</a>
        </form>
    </div>
</div>