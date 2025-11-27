<?php
$id = $_GET['id'];
// Ambil data mapel yang mau diedit
$sql = mysqli_query($con, "SELECT * FROM tb_mapel WHERE id_mapel='$id'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong class="card-title"> <span class="fa fa-edit"></span> Edit Mata Pelajaran</strong>
        </div>
        <div class="card-body">
            
            <form action="proses.php" method="post">
                
                <input type="hidden" name="id" value="<?=$data['id_mapel'];?>">
                
                <input type="hidden" name="jurusan" value="-">

                <div class="form-group">
                    <label>Guru Pengampu</label>
                    <select name="id_guru" class="form-control" required>
                        <option value="">- Pilih Guru -</option>
                        <?php
                        // Menampilkan nama guru, bukan ID saja
                        $sqlGuru = mysqli_query($con, "SELECT * FROM tb_guru ORDER BY nama_guru ASC");
                        while($g=mysqli_fetch_array($sqlGuru)){
                            $selected = ($g['id_guru'] == $data['id_guru']) ? 'selected' : '';
                            echo "<option value='$g[id_guru]' $selected>$g[nama_guru]</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mata Pelajaran</label>
                    <select name="nama_mapel" class="form-control" required>
                        <option value="<?=$data['nama_mapel'];?>"><?=$data['nama_mapel'];?> (Saat Ini)</option>
                        <?php
                        $sqlMapel = mysqli_query($con, "SELECT * FROM tb_mastermapel");
                        while($m=mysqli_fetch_array($sqlMapel)){
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
                        // Menampilkan daftar kelas baru (VII, VIII, IX)
                        $sqlKelas = mysqli_query($con, "SELECT * FROM tb_kelas ORDER BY idkelas ASC");
                        while($k=mysqli_fetch_array($sqlKelas)){
                            $selected = ($k['idkelas'] == $data['idkelas']) ? 'selected' : '';
                            echo "<option value='$k[idkelas]' $selected>$k[kelas]</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tingkat</label>
                    <select name="tingkat" class="form-control" required>
                        <option value="<?=$data['tingkat'];?>">Kelas <?=$data['tingkat'];?> (Saat Ini)</option>
                        <option value="VII">Kelas VII</option>
                        <option value="VIII">Kelas VIII</option>
                        <option value="IX">Kelas IX</option>
                    </select>
                </div>

                <hr>
                <button type="submit" name="Emapel" class="btn btn-warning"> <i class="fa fa-save"></i> Simpan Perubahan</button>
                <a href="?page=mapel" class="btn btn-secondary"> <i class="fa fa-chevron-left"></i> Batal</a>
            </form>

        </div>
    </div>
</div>