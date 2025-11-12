<?php
// Pastikan variabel koneksi database ($con) sudah tersedia

// Cek apakah ID kehadiran (idk) telah diterima dari URL
if (!isset($_GET['idk']) || empty($_GET['idk'])) {
    echo '<div class="alert alert-danger">ERROR: ID Kehadiran tidak ditemukan.</div>';
    exit;
}

$id_kehadiran_edit = mysqli_real_escape_string($con, $_GET['idk']);

// --- 1. Ambil Data Tahun Ajaran Aktif (Untuk ditampilkan) ---
$id_tajaran_aktif = 0;
$tahun_ajaran_aktif = 'Tidak Ditemukan';
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif' OR status='Y' LIMIT 1");
if ($sqlTa && mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}


// --- 2. Ambil Data Kehadiran yang akan Diedit ---
$sqlEdit = mysqli_query($con, "
    SELECT 
        kh.*, 
        g.nama_guru
    FROM tb_kehadiran_guru kh
    INNER JOIN tb_guru g ON kh.id_guru = g.id_guru
    WHERE kh.id_kehadiran = '$id_kehadiran_edit'
    LIMIT 1
") or die(mysqli_error($con));

if (mysqli_num_rows($sqlEdit) == 0) {
    echo '<div class="alert alert-warning">Data kehadiran dengan ID **' . $id_kehadiran_edit . '** tidak ditemukan.</div>';
    exit;
}
$dataEdit = mysqli_fetch_array($sqlEdit);


// --- 3. Ambil Semua Daftar Guru (Untuk dropdown, jika ada perubahan guru) ---
$daftarGuru = [];
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");
while ($g = mysqli_fetch_array($sqlGuru)) {
    $daftarGuru[] = $g;
}
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card" style="border-radius:10px;">
            <div class="card-header">
                <strong class="card-title"><span class="fa fa-edit"></span> Edit Presensi Kehadiran Guru</strong>
            </div>
            <div class="card-body">
                <form action="?page=act" method="post" accept-charset="utf-8" id="form-edit-kehadiran">
                    <input type="hidden" name="id_kehadiran" value="<?=$dataEdit['id_kehadiran'];?>">
                    <input type="hidden" name="id_tajaran" value="<?=$dataEdit['id_tajaran'];?>">

                    <p>T.A. Aktif: **<?=$tahun_ajaran_aktif;?>**</p>
                    
                    <div class="form-group">
                        <label for="tanggal_kehadiran">Tanggal Kehadiran:</label>
                        <input type="date" name="tanggal_kehadiran" id="tanggal_kehadiran" 
                            class="form-control" required 
                            value="<?= $dataEdit['tanggal_kehadiran']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="id_guru">Nama Guru:</label>
                        <select name="id_guru" id="id_guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>
                            <?php foreach ($daftarGuru as $guru) { 
                                $selected = ($guru['id_guru'] == $dataEdit['id_guru']) ? 'selected' : '';
                                echo '<option value="' . $guru['id_guru'] . '" ' . $selected . '>' . $guru['nama_guru'] . '</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status_kehadiran">Status Kehadiran:</label>
                        <select name="status_kehadiran" id="status_kehadiran_edit" class="form-control" required>
                            <?php 
                            $status_options = ['Hadir', 'Terlambat', 'Izin', 'Sakit', 'Alpa'];
                            foreach ($status_options as $option) {
                                $selected = ($option == $dataEdit['status_kehadiran']) ? 'selected' : '';
                                echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" id="waktu_group_edit">
                        <label for="waktu_masuk">Waktu Masuk (Jika Hadir/Terlambat):</label>
                        <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control" 
                            value="<?= $dataEdit['waktu_masuk'] ? date('H:i', strtotime($dataEdit['waktu_masuk'])) : ''; ?>">
                        <small class="form-text text-muted">Isi hanya jika status **Hadir** atau **Terlambat**.</small>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" 
                            placeholder="Contoh: Izin urusan keluarga, Sakit demam..."><?= $dataEdit['keterangan']; ?></textarea>
                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary" name="ukehadiranguru">
                        <i class="fa fa-save"></i> Perbarui Kehadiran
                    </button>
                    <a href="?page=v_kehadiran_guru" class="btn btn-secondary">
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
        var statusSelect = document.getElementById('status_kehadiran_edit');
        var waktuGroup = document.getElementById('waktu_group_edit');
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

        // Jalankan saat halaman dimuat
        toggleWaktuInput();

        // Tambahkan listener saat status berubah
        statusSelect.addEventListener('change', toggleWaktuInput);
    });
</script>