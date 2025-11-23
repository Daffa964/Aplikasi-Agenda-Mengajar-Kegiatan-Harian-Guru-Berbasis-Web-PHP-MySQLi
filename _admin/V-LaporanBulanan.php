<?php include '../koneksi.php'; ?>

<div class="card">
    <div class="card-header">
        <strong class="card-title">
            <span class="fa fa-calendar"></span> Laporan Bulanan
        </strong>
    </div>
    <div class="card-body">
        <form action="" method="GET" class="form-inline mb-4">
            <input type="hidden" name="page" value="v_laporan_bulanan">
            <label for="bulan" class="mr-2">Pilih Bulan:</label>
            <select name="bulan" id="bulan" class="form-control mr-2">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $selected = (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? 'selected' : '';
                    echo '<option value="'.$i.'" '.$selected.'>'.date('F', mktime(0, 0, 0, $i, 1)).'</option>';
                }
                ?>
            </select>
            
            <label for="tahun" class="mr-2">Tahun:</label>
            <select name="tahun" id="tahun" class="form-control mr-2">
                <?php
                $current_year = date('Y');
                for ($i = $current_year - 5; $i <= $current_year + 1; $i++) {
                    $selected = (isset($_GET['tahun']) && $_GET['tahun'] == $i) ? 'selected' : '';
                    echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                }
                ?>
            </select>
            
            <button type="submit" class="btn btn-primary">
                <span class="fa fa-search"></span> Tampilkan
            </button>
        </form>

        <?php
        if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            
            // Format tanggal untuk query
            $tgl_awal = $tahun . '-' . sprintf('%02d', $bulan) . '-01';
            $tgl_akhir = $tahun . '-' . sprintf('%02d', $bulan) . '-31';
            
            // Hitung jumlah agenda mengajar
            $sql_agenda = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_agenda WHERE MONTH(tgl) = '$bulan' AND YEAR(tgl) = '$tahun'");
            $jml_agenda = mysqli_fetch_array($sql_agenda)['jumlah'];
            
            // Hitung jumlah agenda lain
            $sql_agenda_lain = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_agendalain WHERE MONTH(tgl_kgt) = '$bulan' AND YEAR(tgl_kgt) = '$tahun'");
            $jml_agenda_lain = mysqli_fetch_array($sql_agenda_lain)['jumlah'];
            
            // Hitung jumlah izin siswa
            $sql_izin = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_izin_siswa WHERE MONTH(tanggal_izin) = '$bulan' AND YEAR(tanggal_izin) = '$tahun'");
            $jml_izin = mysqli_fetch_array($sql_izin)['jumlah'];
            
            // Hitung jumlah keterlambatan siswa
            $sql_keterlambatan = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_keterlambatan WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'");
            $jml_keterlambatan = mysqli_fetch_array($sql_keterlambatan)['jumlah'];
            
            // Ambil data kehadiran guru
            $sql_kehadiran_guru = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_kehadiran_guru WHERE MONTH(tanggal_kehadiran) = '$bulan' AND YEAR(tanggal_kehadiran) = '$tahun'");
            $jml_kehadiran_guru = mysqli_fetch_array($sql_kehadiran_guru)['jumlah'];
        ?>
        
        <div class="row mb-4">
            <div class="col-md-2">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h4><?php echo $jml_agenda; ?></h4>
                        <p class="card-text">Agenda Mengajar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h4><?php echo $jml_agenda_lain; ?></h4>
                        <p class="card-text">Agenda Lain</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h4><?php echo $jml_izin; ?></h4>
                        <p class="card-text">Izin Siswa</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h4><?php echo $jml_keterlambatan; ?></h4>
                        <p class="card-text">Keterlambatan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <h4><?php echo $jml_kehadiran_guru; ?></h4>
                        <p class="card-text">Kehadiran Guru</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tampilkan detail data bulanan -->
        <h5 class="mt-4"><span class="fa fa-file-text"></span> Detail Agenda Mengajar Bulan <?php echo date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)); ?></h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Guru</th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th>Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_detail = mysqli_query($con, "
                        SELECT a.*, g.nama_guru, m.nama_mapel, k.kelas
                        FROM tb_agenda a
                        INNER JOIN tb_guru g ON a.id_guru = g.id_guru
                        INNER JOIN tb_mapel m ON a.id_mapel = m.id_mapel
                        INNER JOIN tb_kelas k ON a.idkelas = k.idkelas
                        WHERE MONTH(a.tgl) = '$bulan' AND YEAR(a.tgl) = '$tahun'
                        ORDER BY a.tgl, a.jam
                    ");
                    
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql_detail)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['tgl'])); ?></td>
                        <td><?php echo $row['nama_guru']; ?></td>
                        <td><?php echo $row['nama_mapel']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['absen']; ?></td>
                    </tr>
                    <?php
                    }
                    if(mysqli_num_rows($sql_detail) == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data agenda mengajar pada bulan ini</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Data Izin Siswa -->
        <h5 class="mt-4"><span class="fa fa-user-times"></span> Detail Izin Siswa Bulan <?php echo date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)); ?></h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jenis Izin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_izin_detail = mysqli_query($con, "
                        SELECT i.*, s.nama_siswa, k.kelas
                        FROM tb_izin_siswa i
                        INNER JOIN tb_siswa s ON i.id_siswa = s.id_siswa
                        INNER JOIN tb_kelas k ON s.idkelas = k.idkelas
                        WHERE MONTH(i.tanggal_izin) = '$bulan' AND YEAR(i.tanggal_izin) = '$tahun'
                        ORDER BY i.tanggal_izin
                    ");
                    
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql_izin_detail)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['tanggal_izin'])); ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['jenis_izin']; ?></td>
                        <td>
                            <?php 
                            $badge = ($row['status_izin'] == 'Disetujui') ? 'badge-success' : 
                                    (($row['status_izin'] == 'Ditolak') ? 'badge-danger' : 'badge-warning');
                            ?>
                            <span class="badge <?php echo $badge; ?>"><?php echo $row['status_izin']; ?></span>
                        </td>
                    </tr>
                    <?php
                    }
                    if(mysqli_num_rows($sql_izin_detail) == 0) {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data izin siswa pada bulan ini</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Data Keterlambatan Siswa -->
        <h5 class="mt-4"><span class="fa fa-clock-o"></span> Detail Keterlambatan Siswa Bulan <?php echo date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)); ?></h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Waktu Terlambat (menit)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_keterlambatan_detail = mysqli_query($con, "
                        SELECT k.*, s.nama_siswa, kelas.kelas
                        FROM tb_keterlambatan k
                        INNER JOIN tb_siswa s ON k.id_siswa = s.id_siswa
                        INNER JOIN tb_kelas kelas ON s.idkelas = kelas.idkelas
                        WHERE MONTH(k.tanggal) = '$bulan' AND YEAR(k.tanggal) = '$tahun'
                        ORDER BY k.tanggal
                    ");
                    
                    $no = 1;
                    while ($row = mysqli_fetch_array($sql_keterlambatan_detail)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                        <td><?php echo $row['nama_siswa']; ?></td>
                        <td><?php echo $row['kelas']; ?></td>
                        <td><?php echo $row['waktu_terlambat']; ?> menit</td>
                    </tr>
                    <?php
                    }
                    if(mysqli_num_rows($sql_keterlambatan_detail) == 0) {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data keterlambatan siswa pada bulan ini</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <?php
        } else {
            echo '<div class="alert alert-info">Silakan pilih bulan dan tahun untuk menampilkan laporan bulanan.</div>';
        }
        ?>
    </div>
</div>