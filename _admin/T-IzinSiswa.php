<?php 
// Pastikan variabel koneksi database ($con) sudah tersedia

// --- 1. Ambil Tahun Ajaran Aktif (untuk tampilan) ---
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
            <span class="fa fa-plus-circle"></span> Form Tambah Data Izin Siswa
        </strong>
    </div>
    <div class="card-body">
        
        <form action="?page=act" method="POST"> 
            <div class="form-group">
                <label for="tanggal_izin">Tanggal Izin</label>
                <input type="date" name="tanggal_izin" id="tanggal_izin" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="id_siswa">Nama Siswa / Kelas</label>
                <select name="id_siswa" id="id_siswa" class="form-control" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php 
                    while($dataSiswa = mysqli_fetch_array($querySiswa)) { ?>
                        <option value="<?=$dataSiswa['id_siswa']?>">
                            <?=$dataSiswa['nama_siswa']?> (<?=$dataSiswa['kelas']?>)
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
                <button type="submit" name="s_izin_siswa" class="btn btn-info"> 
                    <span class="fa fa-save"></span> Simpan & Ajukan 
                </button>
                <button type="reset" class="btn btn-danger"> 
                    <span class="fa fa-refresh"></span> Reset 
                </button>
                <a href="?page=v_izin_siswa" class="btn btn-warning"> 
                    <span class="fa fa-chevron-left"></span> Kembali 
                </a>
            </div>
            
        </form>
        
    </div>
</div>