<?php 
// File: v-ajukanpengganti.php
// Menampilkan daftar jadwal piket guru yang sedang login dan form pengajuan pengganti.

// Pastikan $con (koneksi) dan $sesi (ID Guru) tersedia
$id_guru_sesi = $sesi ?? null; 

if (!isset($con) || !$id_guru_sesi) {
    echo "<div class='alert alert-danger'>Kesalahan: Koneksi database atau ID Guru (Sesi) tidak ditemukan!</div>";
    return;
}

// 1. Ambil Tahun Ajaran Aktif
$id_tajaran_aktif = 0;
$tahun_ajaran_aktif = 'T.A Tidak Aktif';
$sqlTa = mysqli_query($con, "SELECT id_tajaran, tahun_ajaran FROM tb_tajaran WHERE status='Aktif' OR status='Y' LIMIT 1");
if ($sqlTa && mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $id_tajaran_aktif = $dataTa['id_tajaran'];
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran'];
}

// 2. Query Guru untuk Dropdown di Modal (Guru yang BUKAN diri sendiri)
$sqlGuru = mysqli_query($con, "SELECT id_guru, nama_guru FROM tb_guru WHERE id_guru != '" . mysqli_real_escape_string($con, $id_guru_sesi) . "' ORDER BY nama_guru ASC");
?>

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong class="card-title"> 
                <span class="fa fa-user-plus"></span> Ajukan Guru Pengganti
            </strong>
        </div>
        <div class="card-body">
            
            <p class="text-secondary small">
                T.A. Aktif: **<?php echo htmlspecialchars($tahun_ajaran_aktif); ?>**
            </p>
            <hr>

            <h5>Jadwal Piket Anda yang Belum Memiliki Pengganti</h5>
            
            <?php 
            // 3. Query Jadwal yang Belum Disetujui ('Ya') dan Belum Lewat Hari Ini
            $sqlJadwal = mysqli_query($con, "
                SELECT 
                    id_jadwal,
                    tanggal_piket,
                    hari_piket,
                    status_pengganti
                FROM 
                    tb_jadwal_piket 
                WHERE 
                    id_guru = '" . mysqli_real_escape_string($con, $id_guru_sesi) . "'
                    AND status_pengganti != 'Ya'  
                    AND tanggal_piket >= CURDATE() 
                    " . ($id_tajaran_aktif ? "AND id_tajaran = '$id_tajaran_aktif'" : "") . "
                ORDER BY 
                    tanggal_piket ASC
            ") or die(mysqli_error($con)); 
            
            $ada_data_jadwal = (mysqli_num_rows($sqlJadwal) > 0);

            if ($ada_data_jadwal):
            ?>
            <div class="table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Tanggal & Hari Piket</th>
                            <th>Status Pengganti</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($data = mysqli_fetch_array($sqlJadwal)) {
                            $id_jadwal = htmlspecialchars($data['id_jadwal']); 
                            $tgl_piket = date('d/m/Y', strtotime($data['tanggal_piket']));
                            
                            $status = $data['status_pengganti'] ?: 'Belum Diajukan';
                            $badge_class = ($status == 'Tidak' ? 'badge-danger' : 'badge-warning');
                            ?>
                            <tr>
                                <td><center><?= $no++; ?>.</center></td>
                                <td>
                                    <strong><?= date('d F Y', strtotime($data['tanggal_piket'])); ?></strong>
                                    <br><small>(<?= htmlspecialchars($data['hari_piket']); ?>)</small>
                                </td>
                                <td>
                                    <span class="badge <?= $badge_class ?>">
                                        <?= htmlspecialchars($status); ?>
                                    </span>
                                </td>
                                <td>
                                    <button 
                                        class="btn btn-info btn-sm btn-ajukan-pengganti" 
                                        data-id="<?= $id_jadwal; ?>"
                                        data-tanggal="<?= $tgl_piket; ?>"
                                        data-toggle="modal" 
                                        data-target="#modalAjukanPengganti"
                                        title="Ajukan Pengganti untuk jadwal ini">
                                        <i class="fa fa-share-square-o"></i> Ajukan
                                    </button>
                                </td>
                            </tr>
                        <?php 
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <?php
            else:
            ?>
                <div class="alert alert-success text-center">
                    <span class="fa fa-check-circle"></span> Semua jadwal piket Anda sudah selesai atau telah memiliki status pengganti.
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAjukanPengganti" tabindex="-1" role="dialog" aria-labelledby="modalAjukanPenggantiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalAjukanPenggantiLabel">Form Pengajuan Guru Pengganti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="?page=act" method="post"> 
                <div class="modal-body">
                    <input type="hidden" name="id_jadwal" id="input_id_jadwal">
                    <p>Anda mengajukan pengganti untuk tanggal: <strong><span id="tgl_piket_display"></span></strong></p>

                    <div class="form-group">
                        <label for="id_guru_pengganti">Pilih Guru Pengganti <small class="text-danger">*</small></label>
                        <select name="id_guru_pengganti" id="id_guru_pengganti" class="form-control" required>
                            <option value="">-- Pilih Guru Lain --</option>
                            <?php 
                            if (mysqli_num_rows($sqlGuru) > 0) {
                                mysqli_data_seek($sqlGuru, 0); 
                                while ($g = mysqli_fetch_array($sqlGuru)) {
                                    echo "<option value='".$g['id_guru']."'>".$g['nama_guru']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="catatan_penggantian">Alasan / Catatan Penggantian <small class="text-danger">*</small></label>
                        <textarea name="catatan_penggantian" id="catatan_penggantian" class="form-control" rows="3" required></textarea>
                    </div>

                    <p class="text-warning">
                        <i class="fa fa-info-circle"></i> Catatan: Status akan menjadi **"Tidak"** sampai disetujui oleh Administrator.
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                    <button type="submit" name="ajukan_pengganti" class="btn btn-success"><i class="fa fa-check"></i> Ajukan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // ... (Kode JS yang sudah benar) ...
});
</script>
