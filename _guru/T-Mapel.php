<?php
session_start();
include '../koneksi.php';

// Pastikan hanya user dengan sesi 'guru' yang bisa mengakses
if (!isset($_SESSION['guru'])) {
    header("Location: ../index.php");
    exit();
}

$sesi = $_SESSION['guru'];
$sql = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>

<div class="row">
    <div class="col-md-8 offset-md-3 mr-auto ml-auto">
        <div class="card" style="border-radius:10px;">
            <div class="card-header">
                <strong class="card-title"><span class="fa fa-plus"></span> Tambah Pelajaran</strong>
            </div>
            <div class="card-body">
                <form action="proses.php" method="post" accept-charset="utf-8">

                    <div class="form-group">
                        <input type="hidden" name="id_guru" value="<?php echo $data['id_guru']; ?>" class="form-control" readonly>
                        <input type="hidden" name="jurusan" value="-">
                    </div>

                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <select name="nama_mapel" class="form-control" required>
                            <option value="">- Pilih Matapelajaran -</option>
                            <?php
                            $sqlMapel = mysqli_query($con, "SELECT * FROM tb_mastermapel");
                            while($g = mysqli_fetch_array($sqlMapel)){
                                echo "<option value='$g[mapel]'>$g[mapel]</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control" required>
                            <option value="">- Pilih Kelas -</option>
                            <?php
                            // Mengambil data kelas baru yang sudah di-insert di Langkah 1
                            $sqlKelas = mysqli_query($con, "SELECT * FROM tb_kelas ORDER BY kelas ASC");
                            while($k = mysqli_fetch_array($sqlKelas)){
                                echo "<option value='$k[idkelas]'>$k[kelas]</option>";
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

                    <hr>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="Tmapel"> 
                            <span class="fa fa-save"></span> Simpan
                        </button>
                        <button class="btn btn-danger" type="reset"> 
                            <span class="fa fa-close"></span> Reset
                        </button>
                        <a href="javascript:history.back()" class="btn btn-warning"> 
                            <span class="fa fa-chevron-left"></span> Kembali 
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>