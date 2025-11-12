<?php 
// Pastikan variabel koneksi database ($con) sudah tersedia
// Pastikan variabel $data['id_guru'] (ID Guru/Admin yang login) tersedia

$idi = $_GET['idi'] ?? ''; // Ambil ID Izin dari parameter URL

// --- Ambil Data Izin yang Akan Diedit ---
$queryEdit = mysqli_query($con, "
    SELECT 
        a.*,
        b.nis, 
        b.nama_siswa, 
        c.kelas  
    FROM 
        tb_izin_siswa a
    INNER JOIN 
        tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN 
        tb_kelas c ON b.idkelas = c.idkelas
    WHERE 
        a.id_izin = '$idi'
") or die(mysqli_error($con));

if (mysqli_num_rows($queryEdit) == 0) {
    echo "<script>alert('Data Izin Siswa tidak ditemukan!'); window.location='?page=v_izinsiswa';</script>";
    exit;
}

$dataEdit = mysqli_fetch_array($queryEdit);
?>

<div class="card">
    <div class="card-header">
        <strong class="card-title"> 
            <span class="fa fa-pencil"></span> Proses Persetujuan Izin Siswa
        </strong>
    </div>
    <div class="card-body">
        
        <table class="table table-bordered table-sm mb-4">
            <tr>
                <td width="30%">Nama Siswa (NIS)</td>
                <td>: <strong><?= $dataEdit['nama_siswa'] ?></strong> (<?= $dataEdit['nis'] ?>)</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: <?= $dataEdit['kelas'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Izin</td>
                <td>: <?= date('d F Y', strtotime($dataEdit['tanggal_izin'])) ?></td>
            </tr>
            <tr>
                <td>Jenis Izin</td>
                <td>: <span class="badge badge-primary"><?= $dataEdit['jenis_izin'] ?></span></td>
            </tr>
            <tr>
                <td>Alasan/Keterangan</td>
                <td>: <?= $dataEdit['keterangan'] ?></td>
            </tr>
        </table>

        <hr>

        <form action="?page=act" method="POST"> 
            <input type="hidden" name="id_izin" value="<?= $dataEdit['id_izin'] ?>">
            
            <h5 class="mb-3">Tindakan Persetujuan</h5>
            
            <div class="form-group">
                <label for="status_izin">Status Persetujuan</label>
                <select name="status_izin" id="status_izin" class="form-control" required>
                    <option value="Menunggu" <?= ($dataEdit['status_izin'] == 'Menunggu') ? 'selected' : '' ?>>Menunggu</option>
                    <option value="Disetujui" <?= ($dataEdit['status_izin'] == 'Disetujui') ? 'selected' : '' ?>>Disetujui</option>
                    <option value="Ditolak" <?= ($dataEdit['status_izin'] == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="catatan_proses">Catatan Guru Piket (Opsional)</label>
                <textarea name="catatan_proses" id="catatan_proses" class="form-control" rows="2"></textarea>
                <small class="form-text text-muted">Tambahkan catatan jika diperlukan saat memproses izin.</small>
            </div>
            
            <hr>
            
            <div class="form-group">
                <button type="submit" name="e_izin_siswa" class="btn btn-primary"> 
                    <span class="fa fa-check-circle"></span> Proses & Simpan
                </button>
                <a href="?page=v_izinsiswa" class="btn btn-warning"> 
                    <span class="fa fa-chevron-left"></span> Kembali
                </a>
            </div>
            
        </form>
        
    </div>
</div>