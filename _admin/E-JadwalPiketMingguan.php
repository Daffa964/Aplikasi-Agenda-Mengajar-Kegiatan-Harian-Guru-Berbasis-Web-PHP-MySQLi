<?php
// Pastikan sudah login sebagai admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

include '../koneksi.php';

// Ambil ID hari dari parameter URL
$id_mingguan = @$_GET['id'];

if (empty($id_mingguan)) {
    echo "<script>alert('ID Hari tidak ditemukan!'); window.location='?page=v_jadwal_piket_mingguan';</script>";
    exit;
}

// Ambil nama hari
$sqlHari = mysqli_query($con, "SELECT * FROM tb_piket_mingguan WHERE id_mingguan = '$id_mingguan'");
$hari = mysqli_fetch_array($sqlHari);

if (!$hari) {
    echo "<script>alert('Data hari tidak ditemukan!'); window.location='?page=v_jadwal_piket_mingguan';</script>";
    exit;
}

$nama_hari = $hari['hari'];

// Proses update jika form disubmit
if (isset($_POST['update'])) {
    // Hapus dulu semua guru yang terdaftar untuk hari ini
    mysqli_query($con, "DELETE FROM tb_piket_mingguan_guru WHERE id_mingguan = '$id_mingguan'");

    // Hapus juga semua tugas untuk hari ini
    mysqli_query($con, "DELETE FROM tb_piket_mingguan_tugas WHERE id_mingguan = '$id_mingguan'");

    // Masukkan kembali guru-guru yang dipilih
    if (isset($_POST['id_guru']) && is_array($_POST['id_guru'])) {
        foreach ($_POST['id_guru'] as $id_guru) {
            if (!empty($id_guru)) {
                mysqli_query($con, "INSERT INTO tb_piket_mingguan_guru (id_mingguan, id_guru) VALUES ('$id_mingguan', '$id_guru')");
            }
        }
    }

    // Masukkan tugas-tugas
    if (isset($_POST['tugas']) && is_array($_POST['tugas'])) {
        foreach ($_POST['tugas'] as $tugas) {
            if (!empty($tugas)) {
                mysqli_query($con, "INSERT INTO tb_piket_mingguan_tugas (id_mingguan, tugas) VALUES ('$id_mingguan', '$tugas')");
            }
        }
    }

    echo "<script>alert('Jadwal piket mingguan berhasil diperbarui!'); window.location='?page=v_jadwal_piket_mingguan';</script>";
}

// Ambil guru-guru yang sudah terdaftar untuk hari ini
$sqlGuruTerdaftar = mysqli_query($con, "
    SELECT p_guru.*, g.nama_guru, g.gelar
    FROM tb_piket_mingguan_guru p_guru
    LEFT JOIN tb_guru g ON p_guru.id_guru = g.id_guru
    WHERE p_guru.id_mingguan = '$id_mingguan'
    ORDER BY g.nama_guru ASC
");

// Ambil tugas-tugas yang sudah terdaftar untuk hari ini
$sqlTugasTerdaftar = mysqli_query($con, "
    SELECT * FROM tb_piket_mingguan_tugas
    WHERE id_mingguan = '$id_mingguan'
");
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title"> <span class="fa fa-edit"></span> Edit Jadwal Piket - <?php echo $nama_hari; ?></strong>
                <a href="?page=v_jadwal_piket_mingguan" class="btn btn-primary float-right btn-sm">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Edit jadwal guru piket untuk hari: <strong><?php echo $nama_hari; ?></strong>
                </div>

                <form method="post" action="">
                    <!-- Pemilihan Guru -->
                    <div class="form-group">
                        <label><strong><i class="fa fa-user"></i> Guru Bertugas:</strong></label>
                        <div id="guru-list">
                            <?php
                            $no_guru = 1;
                            $guru_terdaftar = array();
                            while ($guru = mysqli_fetch_array($sqlGuruTerdaftar)) {
                                $guru_terdaftar[] = $guru['id_guru'];
                                echo '<div class="form-row mb-2 guru-item">';
                                echo '<div class="col-md-12">';
                                echo '<div class="input-group mb-2">';
                                echo '<div class="input-group-prepend">';
                                echo '<span class="input-group-text">Guru ' . $no_guru . '</span>';
                                echo '</div>';
                                echo '<select name="id_guru[]" class="form-control">';
                                echo '<option value="">-- Pilih Guru --</option>';

                                // Ambil semua guru
                                $sqlAllGuru = mysqli_query($con, "SELECT *,
                                    CASE
                                        WHEN gelar IS NOT NULL AND gelar != '' THEN CONCAT(nama_guru, ', ', gelar)
                                        ELSE nama_guru
                                    END as nama_guru_dengan_gelar
                                    FROM tb_guru ORDER BY nama_guru ASC");
                                while ($allGuru = mysqli_fetch_array($sqlAllGuru)) {
                                    $selected = ($allGuru['id_guru'] == $guru['id_guru']) ? 'selected' : '';
                                    echo '<option value="'.$allGuru['id_guru'].'" '.$selected.'>'.$allGuru['nama_guru_dengan_gelar'].'</option>';
                                }
                                echo '</select>';
                                echo '<div class="input-group-append">';
                                echo '<button type="button" class="btn btn-danger remove-guru" title="Hapus Guru"><i class="fa fa-times"></i></button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                $no_guru++;
                            }
                            ?>
                        </div>
                        <button type="button" id="add-guru" class="btn btn-info btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Guru</button>
                    </div>

                    <!-- Tugas Hari -->
                    <div class="form-group">
                        <label><strong><i class="fa fa-tasks"></i> Tugas Pokok:</strong></label>
                        <div id="tugas-list">
                            <?php
                            $no_tugas = 1;
                            while ($tugas = mysqli_fetch_array($sqlTugasTerdaftar)) {
                                echo '<div class="form-row mb-2 tugas-item">';
                                echo '<div class="col-md-12">';
                                echo '<div class="input-group mb-2">';
                                echo '<div class="input-group-prepend">';
                                echo '<span class="input-group-text">Tugas ' . $no_tugas . '</span>';
                                echo '</div>';
                                echo '<textarea name="tugas[]" class="form-control" placeholder="Masukkan tugas pokok">'.$tugas['tugas'].'</textarea>';
                                echo '<div class="input-group-append">';
                                echo '<button type="button" class="btn btn-danger remove-tugas" title="Hapus Tugas"><i class="fa fa-times"></i></button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                $no_tugas++;
                            }

                            // Jika belum ada tugas, buat satu field kosong
                            if ($no_tugas == 1) {
                                echo '<div class="form-row mb-2 tugas-item">';
                                echo '<div class="col-md-12">';
                                echo '<div class="input-group mb-2">';
                                echo '<div class="input-group-prepend">';
                                echo '<span class="input-group-text">Tugas 1</span>';
                                echo '</div>';
                                echo '<textarea name="tugas[]" class="form-control" placeholder="Masukkan tugas pokok" rows="2"></textarea>';
                                echo '<div class="input-group-append">';
                                echo '<button type="button" class="btn btn-danger remove-tugas" title="Hapus Tugas"><i class="fa fa-times"></i></button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <button type="button" id="add-tugas" class="btn btn-info btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Tugas</button>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
                        <a href="?page=v_jadwal_piket_mingguan" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Tambah guru
document.getElementById('add-guru').addEventListener('click', function() {
    var guruList = document.getElementById('guru-list');
    var guruCount = document.querySelectorAll('.guru-item').length + 1;

    // Ambil daftar guru dari server melalui AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax_get_guru.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var guruOptions = xhr.responseText;

            var div = document.createElement('div');
            div.className = 'form-row mb-2 guru-item';
            div.innerHTML = `
                <div class="col-md-12">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Guru ` + guruCount + `</span>
                        </div>
                        <select name="id_guru[]" class="form-control">
                            <option value="">-- Pilih Guru --</option>
                            ` + guruOptions + `
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-guru" title="Hapus Guru"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
            `;
            guruList.appendChild(div);

            // Tambahkan event listener untuk tombol hapus yang baru
            div.querySelector('.remove-guru').addEventListener('click', function() {
                this.closest('.guru-item').remove();
            });
        }
    };
    xhr.send();
});

// Tambah tugas
document.getElementById('add-tugas').addEventListener('click', function() {
    var tugasList = document.getElementById('tugas-list');
    var tugasCount = document.querySelectorAll('.tugas-item').length + 1;

    var div = document.createElement('div');
    div.className = 'form-row mb-2 tugas-item';
    div.innerHTML = `
        <div class="col-md-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Tugas ` + tugasCount + `</span>
                </div>
                <textarea name="tugas[]" class="form-control" placeholder="Masukkan tugas pokok" rows="2"></textarea>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-tugas" title="Hapus Tugas"><i class="fa fa-times"></i></button>
                </div>
            </div>
        </div>
    `;
    tugasList.appendChild(div);

    // Tambahkan event listener untuk tombol hapus yang baru
    div.querySelector('.remove-tugas').addEventListener('click', function() {
        this.closest('.tugas-item').remove();
    });
});

// Hapus guru
document.querySelectorAll('.remove-guru').forEach(function(button) {
    button.addEventListener('click', function() {
        this.closest('.guru-item').remove();
    });
});

// Hapus tugas
document.querySelectorAll('.remove-tugas').forEach(function(button) {
    button.addEventListener('click', function() {
        this.closest('.tugas-item').remove();
    });
});

// Untuk elemen yang ditambahkan dinamis, gunakan event delegation
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-guru') || e.target.closest('.remove-guru')) {
        (e.target.classList.contains('remove-guru') ? e.target : e.target.closest('.remove-guru')).closest('.guru-item').remove();
    }
    if (e.target.classList.contains('remove-tugas') || e.target.closest('.remove-tugas')) {
        (e.target.classList.contains('remove-tugas') ? e.target : e.target.closest('.remove-tugas')).closest('.tugas-item').remove();
    }
});
</script>