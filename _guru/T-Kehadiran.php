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

// Ambil data guru dari database
$sqlGuru = mysqli_query($con, "SELECT * FROM tb_guru WHERE id_guru='$id_guru_login'");
$dataGuru = mysqli_fetch_array($sqlGuru);

// Ambil tahun ajaran aktif
$sqlTahunAjaran = mysqli_query($con, "SELECT * FROM tb_tajaran WHERE status='Y' OR status='Aktif' LIMIT 1");
$dataTahunAjaran = mysqli_fetch_array($sqlTahunAjaran);
$id_tajaran_aktif = $dataTahunAjaran['id_tajaran'];

?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card" style="border-radius:10px;">
            <div class="card-header">
                <strong class="card-title"><span class="fa fa-calendar-check"></span> Input Kehadiran Harian</strong>
            </div>
            <div class="card-body">
                <form action="?page=act" method="post" accept-charset="utf-8" id="form-kehadiran">
                    <input type="hidden" name="id_guru" value="<?= $id_guru_login; ?>">
                    <input type="hidden" name="id_tajaran" value="<?= $id_tajaran_aktif; ?>">

                    <div class="form-group">
                        <label>Nama Guru:</label>
                        <input type="text" class="form-control" value="<?= $dataGuru['nama_guru']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran:</label>
                        <input type="text" class="form-control" value="<?= $dataTahunAjaran['tahun_ajaran']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kehadiran">Tanggal Kehadiran:</label>
                        <input type="date" name="tanggal_kehadiran" id="tanggal_kehadiran" class="form-control" required value="<?= date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="status_kehadiran">Status Kehadiran:</label>
                        <select name="status_kehadiran" id="status_kehadiran" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Terlambat">Terlambat</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Alpa">Alpa</option>
                        </select>
                    </div>

                    <div class="form-group" id="waktu_group" style="display: none;">
                        <label for="waktu_masuk">Waktu Masuk (Jika Hadir/Terlambat):</label>
                        <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control">
                        <small class="form-text text-muted">Isi hanya jika status **Hadir** atau **Terlambat**.</small>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Contoh: Izin urusan keluarga, Sakit demam..."></textarea>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-success" name="save_kehadiran_guru">
                        <i class="fa fa-save"></i> Simpan Kehadiran
                    </button>
                    <a href="?page=dashboard" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Logika JavaScript untuk mengontrol visibility input Waktu Masuk
    $(document).ready(function() {
        var statusSelect = document.getElementById('status_kehadiran');
        var waktuGroup = document.getElementById('waktu_group');
        var waktuInput = document.getElementById('waktu_masuk');

        function toggleWaktuInput() {
            var status = statusSelect.value;
            // Tampilkan jika status adalah Hadir atau Terlambat
            if (status === 'Hadir' || status === 'Terlambat') {
                waktuGroup.style.display = 'block';
                // waktuInput.required = true; // Opsional: Jadikan required jika Hadir/Terlambat
            } else {
                waktuGroup.style.display = 'none';
                waktuInput.value = ''; // Kosongkan nilai
                // waktuInput.required = false;
            }
        }

        // Tambahkan listener saat status berubah
        statusSelect.addEventListener('change', toggleWaktuInput);
    });
</script>