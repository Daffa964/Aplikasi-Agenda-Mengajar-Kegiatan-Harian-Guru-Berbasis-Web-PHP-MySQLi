<?php 
// Pastikan variabel koneksi database ($con) sudah tersedia

// --- 1. Ambil Tahun Ajaran Aktif ---
// Diperlukan untuk tampilan dan opsional untuk penyimpanan
$id_tajaran_aktif = 0;
$tahun_ajaran_aktif = 'T.A Tidak Aktif';
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif'") or die(mysqli_error($con));
if (mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}

// --- 2. Ambil Data Siswa dan Kelas untuk Dropdown ---
$querySiswa = mysqli_query($con, "
    SELECT 
        a.id_siswa, 
        a.nama_siswa, 
        b.kelas  -- Menggunakan kolom 'kelas' dari tb_kelas
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
            <span class="fa fa-pencil"></span> Form Input Data Keterlambatan Siswa
        </strong>
    </div>
    <div class="card-body">
        
        <form action="?page=act" method="POST"> 
            <div class="form-group">
                <label for="tanggal">Tanggal Terlambat</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="id_siswa">Nama Siswa / Kelas</label>
                <select name="id_siswa" id="id_siswa" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php 
                    // Loop data siswa dari database
                    while($dataSiswa = mysqli_fetch_array($querySiswa)) { ?>
                        <option value="<?=$dataSiswa['id_siswa']?>">
                            <?=$dataSiswa['nama_siswa']?> (<?=$dataSiswa['kelas']?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="waktu_masuk">Waktu Masuk</label>
                <input type="time" name="waktu_masuk" id="waktu_masuk" class="form-control" required>
                <small class="form-text text-muted">Contoh: 07:15. Waktu siswa tiba di sekolah.</small>
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                <small class="form-text text-muted">Catatan/alasan keterlambatan (Opsional).</small>
            </div>
            
            <hr>
            
            <div class="form-group">
                <button type="submit" name="keterlambatan_siswa" class="btn btn-info"> 
                    <span class="fa fa-save"></span> Simpan 
                </button>
                <button type="reset" class="btn btn-danger"> 
                    <span class="fa fa-refresh"></span> Reset 
                </button>
                <a href="javascript:history.back()" class="btn btn-warning"> 
                    <span class="fa fa-chevron-left"></span> Kembali 
                </a>
            </div>
            
        </form>
        
    </div>
</div>