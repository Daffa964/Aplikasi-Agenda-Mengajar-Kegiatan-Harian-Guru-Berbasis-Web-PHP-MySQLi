<?php
$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM tb_mapel WHERE id_mapel='$id'");
$data = mysqli_fetch_array($sql);
?>
<div class="card">
    <div class="card-header">
        <strong>Edit Pelajaran</strong>
    </div>
    <div class="card-body">
        <form action="proses.php" method="post">
            <input type="hidden" name="id" value="<?= $data['id_mapel']; ?>">
            <input type="hidden" name="jurusan" value="-">

            <div class="form-group">
                <label>Nama Mata Pelajaran</label>
                <select name="nama_mapel" class="form-control">
                    <option value="<?= $data['nama_mapel']; ?>"><?= $data['nama_mapel']; ?> (Sekarang)</option>
                    <?php
                    $q = mysqli_query($con, "SELECT * FROM tb_mastermapel");
                    while ($m = mysqli_fetch_array($q)) {
                        echo "<option value='$m[mapel]'>$m[mapel]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Kelas</label>
                <select name="idkelas" class="form-control">
                    <?php
                    // Menampilkan semua kelas (VII A, VII B, dst)
                    $k = mysqli_query($con, "SELECT * FROM tb_kelas ORDER BY kelas ASC");
                    while ($kls = mysqli_fetch_array($k)) {
                        $selected = ($kls['idkelas'] == $data['idkelas']) ? "selected" : "";
                        echo "<option value='$kls[idkelas]' $selected>$kls[kelas]</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tingkat</label>
                <select name="tingkat" class="form-control">
                    <option value="<?= $data['tingkat']; ?>">Kelas <?= $data['tingkat']; ?> (Sekarang)</option>
                    <option value="VII">Kelas VII (7)</option>
                    <option value="VIII">Kelas VIII (8)</option>
                    <option value="IX">Kelas IX (9)</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="Emapel" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update
                </button>
                <a href="javascript:history.back()" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>