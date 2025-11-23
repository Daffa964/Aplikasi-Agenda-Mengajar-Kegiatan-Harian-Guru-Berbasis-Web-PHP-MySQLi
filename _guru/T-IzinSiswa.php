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
        a.nama_siswa,
        a.nis,
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
            <span class="fa fa-plus-circle"></span> Input Izin Siswa
        </strong>
    </div>
    <div class="card-body">

        <form action="?page=act" method="POST">
            <div class="form-group">
                <label for="tanggal_izin">Tanggal Izin</label>
                <input type="date" name="tanggal_izin" id="tanggal_izin" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="id_siswa">Nama Siswa / NIS / Kelas</label>
                <select name="id_siswa" id="id_siswa" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php
                    while($dataSiswa = mysqli_fetch_array($querySiswa)) { ?>
                        <option value="<?=$dataSiswa['id_siswa']?>">
                            <?=$dataSiswa['nama_siswa']?> (<?=$dataSiswa['nis']?>) - <?=$dataSiswa['kelas']?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jenis_izin">Jenis Izin</label>
                <select name="jenis_izin" id="jenis_izin" class="form-control" required>
                    <option value="">-- Pilih Jenis Izin --</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin (Keperluan Keluarga/Penting)</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan / Alasan Izin</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required></textarea>
                <small class="form-text text-muted">Jelaskan alasan perizinan secara detail.</small>
            </div>

            <hr>

            <div class="form-group">
                <button type="submit" name="s_izin_siswa" class="btn btn-success">
                    <span class="fa fa-save"></span> Simpan & Ajukan
                </button>
                <button type="reset" class="btn btn-danger">
                    <span class="fa fa-refresh"></span> Reset
                </button>
                <a href="?page=v_izin_siswa" class="btn btn-warning">
                    <span class="fa fa-chevron-left"></span> Lihat Riwayat
                </a>
            </div>

        </form>

    </div>
</div>