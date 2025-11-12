<?php 
// Pastikan variabel koneksi database ($con) sudah tersedia
// Pastikan $tahun_ajaran_aktif sudah di-load

// --- 1. Ambil Data Izin Siswa ---

// Query JOIN: tb_izin_siswa (a) -> tb_siswa (b) -> tb_kelas (c) -> tb_guru (d)
$queryIzin = mysqli_query($con, "
    SELECT 
        a.id_izin,
        a.tanggal_izin, 
        a.jenis_izin, 
        a.keterangan,
        a.status_izin,
        b.nama_siswa, 
        c.kelas,  
        d.nama_guru AS guru_pemroses -- Nama guru yang memproses/mencatat izin
    FROM 
        tb_izin_siswa a
    INNER JOIN 
        tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN 
        tb_kelas c ON b.idkelas = c.idkelas 
    LEFT JOIN 
        tb_guru d ON a.id_guru_piket = d.id_guru -- LEFT JOIN karena id_guru_piket mungkin NULL
    ORDER BY 
        a.tanggal_izin DESC, a.status_izin ASC
") or die(mysqli_error($con));
?>

<div class="card">
    <div class="card-header">
        <strong class="card-title"> 
            <span class="fa fa-envelope-open-o"></span> Riwayat Perizinan Siswa
        </strong>
    </div>
        <table id="bootstrap-data-table" class="table table-striped table-hover table-condensed table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Izin</th>
            <th>Nama Siswa / Kelas</th>
            <th>Jenis Izin</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Guru Pemroses</th>
            <th width="10%"><center><span class="fa fa-gear"></span> Opsi</center> </th>
          </tr>
        </thead>
        <tbody>
            <?php 
            $no=1;
            while ($dataIzin = mysqli_fetch_array($queryIzin)) {   
                // Tentukan warna badge berdasarkan status
                $badge_class = 'badge-secondary';
                if ($dataIzin['status_izin'] == 'Disetujui') {
                    $badge_class = 'badge-success';
                } elseif ($dataIzin['status_izin'] == 'Ditolak') {
                    $badge_class = 'badge-danger';
                } elseif ($dataIzin['status_izin'] == 'Menunggu') {
                    $badge_class = 'badge-warning';
                }
            ?>
          <tr>
            <td><b> <?=$no++?>.</b> </td>
            <td><?= date('d/m/Y', strtotime($dataIzin['tanggal_izin'])) ?></td>
            <td>
                <strong><?=$dataIzin['nama_siswa']?></strong> <br>
                <small class="text-muted"><?=$dataIzin['kelas']?></small> 
            </td>
            <td><?=$dataIzin['jenis_izin']?></td>
            <td><?=$dataIzin['keterangan']?></td>
            <td>
                <span class="badge <?=$badge_class?>"><?=$dataIzin['status_izin']?></span>
            </td>
            <td><?= $dataIzin['guru_pemroses'] ?? 'N/A' ?></td>
            <td>
                <a href="?page=e_izin_siswa&idi=<?php echo $dataIzin['id_izin']; ?>" 
                    class="btn btn-primary btn-sm mb-1"> 
                    <span class="fa fa-pencil"></span> Proses 
                </a>
                <a 
                    onclick="return confirm('Yakin !! Ingin Hapus Data Izin ini?')" 
                    href="?page=d_izin_siswa&idi=<?php echo $dataIzin['id_izin']; ?>" 
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
        <a href="?page=t_izin_siswa" class="btn btn-info"> <span class="fa fa-plus-circle"></span> Tambah Izin Siswa </a>
    </div>
</div>