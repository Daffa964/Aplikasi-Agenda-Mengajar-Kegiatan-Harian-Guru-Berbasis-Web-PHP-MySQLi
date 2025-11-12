<?php 
// Pastikan variabel koneksi database ($con) sudah tersedia
// Pastikan $id_tajaran_aktif dan $tahun_ajaran_aktif sudah di-load (seperti di image_8fb086.png)

// --- 1. Ambil Data Keterlambatan ---

$queryKeterlambatan = mysqli_query($con, "
    SELECT 
        a.id_keterlambatan,
        a.tanggal, 
        a.waktu_terlambat, 
        a.keterangan, 
        b.nis, 
        b.nama_siswa, 
        c.kelas  -- Ambil nama kelas dari tabel tb_kelas
    FROM 
        tb_keterlambatan a
    INNER JOIN 
        tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN 
        tb_kelas c ON b.idkelas = c.idkelas -- Join ke tb_kelas menggunakan idkelas
    ORDER BY 
        a.tanggal DESC, a.waktu_terlambat DESC
") or die(mysqli_error($con));
?>

<div class="card">
    <div class="card-header">
        <strong class="card-title"> 
            <span class="fa fa-clock-o"></span> Riwayat Keterlambatan Siswa
        </strong>
    </div>
        <table id="bootstrap-data-table" class="table table-striped table-hover table-condensed table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Siswa / Kelas</th>
            <th>Lama Terlambat</th>
            <th>Keterangan</th>
            <th width="10%"><center><span class="fa fa-gear"></span> Opsi</center> </th>
          </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            while ($dataKeterlambatan = mysqli_fetch_array($queryKeterlambatan)) {   
              // Konversi waktu_terlambat (menit) ke format HH:MM atau tampilkan menit jika kurang dari 60
              $total_menit = (int)$dataKeterlambatan['waktu_terlambat'];
              
              if ($total_menit >= 60) {
                  $jam = floor($total_menit / 60);
                  $menit = $total_menit % 60;
                  $lama_terlambat_display = sprintf('%02d Jam %02d Menit', $jam, $menit);
              } else {
                  $lama_terlambat_display = $total_menit . ' Menit';
              }
            ?>
          <tr>
            <td><b> <?=$no++?>.</b> </td>
            <td><?= date('d/m/Y', strtotime($dataKeterlambatan['tanggal'])) ?></td>
            <td>
                <strong><?=$dataKeterlambatan['nama_siswa']?></strong> <br>
                <small class="text-muted"><?=$dataKeterlambatan['kelas']?></small> 
            </td>
            <td>
                <span class="badge badge-warning"><?=$lama_terlambat_display?></span>
            </td>
            <td><?=$dataKeterlambatan['keterangan']?></td>
            <td>
                <a 
                    onclick="return confirm('Yakin !! Ingin Hapus Data Keterlambatan ini?')" 
                    href="?page=d_keterlambatan_siswa&idk=<?php echo $dataKeterlambatan['id_keterlambatan']; ?>" 
                    class="btn btn-danger btn-sm"> 
                    <span class="fa fa-trash"></span> Hapus 
                </a>
            </td>
          </tr>
          <?php 
          }
            ?>
        </tbody>
        </table>
        <hr>
            
        <a href="javascript:history.back()" class="btn btn-warning"> <span class="fa fa-chevron-left"></span> Kembali </a>
        <a href="?page=t_keterlambatansiswa" class="btn btn-info"> <span class="fa fa-plus-circle"></span> Tambah Data </a>
    </div>
</div>