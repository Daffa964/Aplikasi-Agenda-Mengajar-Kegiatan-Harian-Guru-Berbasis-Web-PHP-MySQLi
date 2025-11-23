<?php
session_start();
include '../koneksi.php';

// Pastikan guru sudah login
if (!isset($_SESSION['guru'])) {
    header('location:login.php');
    exit();
}

// Ambil ID Guru dari SESSION
$id_guru_login = $_SESSION['guru'];

// Ambil tahun ajaran aktif
$sqlTahunAjaran = mysqli_query($con, "SELECT * FROM tb_tajaran WHERE status='Y' OR status='Aktif' LIMIT 1");
$dataTahunAjaran = mysqli_fetch_array($sqlTahunAjaran);
$id_tajaran_aktif = $dataTahunAjaran['id_tajaran'];

// Ambil data siswa dan kelas untuk dropdown
$querySiswa = mysqli_query($con, "
    SELECT
        a.id_siswa,
        a.nis,
        a.nama_siswa,
        b.kelas
    FROM
        tb_siswa a
    INNER JOIN
        tb_kelas b ON a.idkelas = b.idkelas
    ORDER BY
        b.kelas, a.nama_siswa
") or die(mysqli_error($con));
?>

<div class="card">
    <div class="card-header">
        <strong class="card-title">
            <span class="fa fa-clock-o"></span> Input Keterlambatan Siswa
        </strong>
    </div>
    <div class="card-body">

        <form action="?page=act" method="POST">
            <div class="form-group">
                <label for="tanggal">Tanggal Keterlambatan</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="id_siswa">Nama Siswa / NIS / Kelas</label>
                <select name="id_siswa" id="id_siswa" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php
                    // Loop data siswa dari database
                    while($dataSiswa = mysqli_fetch_array($querySiswa)) { ?>
                        <option value="<?=$dataSiswa['id_siswa']?>">
                            <?=$dataSiswa['nama_siswa']?> (<?=$dataSiswa['nis']?>) - <?=$dataSiswa['kelas']?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="waktu_masuk">Waktu Kedatangan Siswa</label>
                <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control" required>
                <small class="form-text text-muted">Contoh: 07:15. Waktu siswa tiba di sekolah.</small>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan / Alasan Keterlambatan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Contoh: Bangun kesiangan, Macet di jalan..."></textarea>
            </div>

            <input type="hidden" name="id_guru_piket" value="<?=$id_guru_login?>">

            <hr>

            <button type="submit" name="keterlambatan_siswa" class="btn btn-success">
                <span class="fa fa-save"></span> Simpan Keterlambatan
            </button>
            <button type="reset" class="btn btn-danger">
                <span class="fa fa-refresh"></span> Reset
            </button>
            <a href="?page=v_keterlambatan" class="btn btn-warning">
                <span class="fa fa-chevron-left"></span> Kembali
            </a>
        </form>

    </div>
</div>