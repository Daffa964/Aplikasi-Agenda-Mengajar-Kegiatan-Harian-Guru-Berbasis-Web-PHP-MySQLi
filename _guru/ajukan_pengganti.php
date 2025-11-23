<?php
include '../koneksi.php';
include '../header.php';


if (!isset($_GET['id_jadwal'])) {
    echo "<script>alert('Data tidak valid'); window.location='index.php?page=ajukanpengganti';</script>";
    exit;
}

$id_jadwal = $_GET['id_jadwal'];
$tanggal   = $_GET['tanggal'];

// Ambil daftar guru
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru ORDER BY nama_guru ASC");
?>

<div class="col-lg-8 offset-lg-2">
    <div class="card mt-4">
        <div class="card-header bg-info text-white">
            <h4>Form Pengajuan Guru Pengganti</h4>
        </div>

        <form action="?page=act" method="post">
            <div class="card-body">
                
                <input type="hidden" name="id_jadwal" value="<?= $id_jadwal ?>">

                <div class="form-group mb-3">
                    <label>Tanggal Piket</label>
                    <input type="text" class="form-control" value="<?= date('d F Y', strtotime($tanggal)); ?>" readonly>
                </div>

                <div class="form-group mb-3">
                    <label>Pilih Guru Pengganti</label>
                    <select name="id_guru_pengganti" class="form-control" required>
                        <option value="">-- Pilih Guru Lain --</option>
                        <?php while ($g = mysqli_fetch_assoc($sqlGuru)): ?>
                            <option value="<?= $g['id_guru']; ?>">
                                <?= $g['nama_guru']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Alasan / Catatan</label>
                    <textarea name="catatan_penggantian" class="form-control" rows="3" required></textarea>
                </div>

                <p class="text-warning">
                    Status akan menjadi <b>"Tidak"</b> sampai disetujui Administrator.
                </p>

            </div>

            <div class="card-footer">
                <button type="submit" name="ajukan_pengganti" class="btn btn-success">
                    <i class="fa fa-check"></i> Ajukan
                </button>
                <a href="index.php?page=ajukanpengganti" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
