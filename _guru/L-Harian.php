<?php
include '../koneksi.php';
if (@$_SESSION['guru']) {
    $sesi = @$_SESSION['guru'];
} else {
    header("Location: ../index.php");
    exit();
}

// Fetch teacher data
$stmt = $con->prepare("SELECT * FROM tb_guru WHERE id_guru = ?");
$stmt->bind_param("i", $sesi);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Set default dates
$default_tgl1 = date('Y-m-d');
$default_tgl2 = date('Y-m-d');

// Check if dates are provided in GET
$tgl1 = isset($_GET['tgl1']) ? $_GET['tgl1'] : $default_tgl1;
$tgl2 = isset($_GET['tgl2']) ? $_GET['tgl2'] : $default_tgl2;

// Validate date format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl1) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl2)) {
    $tgl1 = $default_tgl1;
    $tgl2 = $default_tgl2;
}

// Fetch teaching activities
$stmt_teaching = $con->prepare("
    SELECT a.*, m.nama_mapel
    FROM tb_agenda a
    INNER JOIN tb_mapel m ON a.id_mapel = m.id_mapel
    WHERE a.id_guru = ? AND a.tgl BETWEEN ? AND ?
    ORDER BY a.tgl, a.jam
");
$stmt_teaching->bind_param("iss", $sesi, $tgl1, $tgl2);
$stmt_teaching->execute();
$teaching_activities = $stmt_teaching->get_result();

// Fetch non-teaching activities
$stmt_non_teaching = $con->prepare("
    SELECT * FROM tb_agendalain
    WHERE id_guru = ? AND tgl_kgt BETWEEN ? AND ?
    ORDER BY tgl_kgt, kegiatan
");
$stmt_non_teaching->bind_param("iss", $sesi, $tgl1, $tgl2);
$stmt_non_teaching->execute();
$non_teaching_activities = $stmt_non_teaching->get_result();

// Fetch student absence data (izin)
$stmt_izin = $con->prepare("
    SELECT i.*, s.nama_siswa, s.nis, k.kelas
    FROM tb_izin_siswa i
    INNER JOIN tb_siswa s ON i.id_siswa = s.id_siswa
    INNER JOIN tb_kelas k ON s.idkelas = k.idkelas
    WHERE i.id_guru_piket = ? AND i.tanggal_izin BETWEEN ? AND ?
    ORDER BY i.tanggal_izin, s.nama_siswa
");
$stmt_izin->bind_param("iss", $sesi, $tgl1, $tgl2);
$stmt_izin->execute();
$izin_activities = $stmt_izin->get_result();

// Fetch student tardiness data (keterlambatan)
$stmt_keterlambatan = $con->prepare("
    SELECT k.*, s.nama_siswa, s.nis, kelas.kelas
    FROM tb_keterlambatan k
    INNER JOIN tb_siswa s ON k.id_siswa = s.id_siswa
    INNER JOIN tb_kelas kelas ON s.idkelas = kelas.idkelas
    WHERE k.id_guru_piket = ? AND k.tanggal BETWEEN ? AND ?
    ORDER BY k.tanggal, s.nama_siswa
");
$stmt_keterlambatan->bind_param("iss", $sesi, $tgl1, $tgl2);
$stmt_keterlambatan->execute();
$keterlambatan_activities = $stmt_keterlambatan->get_result();

// Fetch school head data
$stmt_kepsek = $con->prepare("SELECT * FROM tb_kepsek ORDER BY id_kepsek DESC LIMIT 1");
$stmt_kepsek->execute();
$kepsek_result = $stmt_kepsek->get_result();
$kepsek_data = $kepsek_result->fetch_assoc();

?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <span class="fa fa-file-o"></span> Laporan Kegiatan Harian
        </h3>
    </div>
    
    <div class="card-body">
        <!-- Form for date range selection -->
        <form class="form-inline mb-4" method="GET" target="_blank" action="laporan_harian.php">
            <input type="hidden" name="page" value="lap-harian">
            <div class="form-group mb-2 mr-2">
                <label for="tgl1" class="mr-2">Mulai Tanggal</label>
                <input type="date" name="tgl1" class="form-control" id="tgl1" value="<?php echo $tgl1; ?>">
            </div>
            <div class="form-group mb-2 mr-2">
                <label for="tgl2" class="mr-2">Sampai Tanggal</label>
                <input type="date" name="tgl2" class="form-control" id="tgl2" value="<?php echo $tgl2; ?>">
            </div>
            <button type="submit" class="btn btn-danger mb-2">
                <i class="fa fa-print"></i> Cetak Laporan
            </button>
        </form>

        <hr>

        <!-- Teaching Activities Table -->
        <div class="table-responsive">
            <h4><i class="fa fa-book"></i> Kegiatan Mengajar (Teaching)</h4>
            <?php if ($teaching_activities->num_rows > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th width="10%">Jam</th>
                            <th>Mata Pelajaran</th>
                            <th>Materi</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = $teaching_activities->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tgl'])); ?></td>
                                <td><?php echo htmlspecialchars($row['jam']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_mapel']); ?></td>
                                <td><?php echo htmlspecialchars(strip_tags($row['materi'])); ?></td>
                                <td><?php echo htmlspecialchars($row['absen']); ?></td>
                                <td><?php echo htmlspecialchars($row['ket']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Belum ada kegiatan mengajar dalam periode yang dipilih.
                </div>
            <?php endif; ?>
        </div>

        <br>

        <!-- Non-Teaching Activities Table -->
        <div class="table-responsive">
            <h4><i class="fa fa-briefcase"></i> Kegiatan Non Mengajar (Non Teaching)</h4>
            <?php if ($non_teaching_activities->num_rows > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th>Kegiatan</th>
                            <th>Isi Kegiatan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $non_teaching_activities->data_seek(0); // Reset pointer
                        $no = 1; 
                        ?>
                        <?php while ($row = $non_teaching_activities->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tgl_kgt'])); ?></td>
                                <td><?php echo htmlspecialchars($row['kegiatan']); ?></td>
                                <td><?php echo htmlspecialchars(strip_tags($row['isi'])); ?></td>
                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Belum ada kegiatan non mengajar dalam periode yang dipilih.
                </div>
            <?php endif; ?>
        </div>

        <br>

        <!-- Student Absence (Izin) Table -->
        <div class="table-responsive">
            <h4><i class="fa fa-user-times"></i> Data Siswa Izin</h4>
            <?php if ($izin_activities->num_rows > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%">NIS</th>
                            <th>Nama Siswa</th>
                            <th width="12%">Kelas</th>
                            <th>Jenis Izin</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = $izin_activities->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal_izin'])); ?></td>
                                <td><?php echo htmlspecialchars($row['nis']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_siswa']); ?></td>
                                <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                <td><?php echo htmlspecialchars($row['jenis_izin']); ?></td>
                                <td><?php echo htmlspecialchars(strip_tags($row['keterangan'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Belum ada data siswa yang izin dalam periode yang dipilih.
                </div>
            <?php endif; ?>
        </div>

        <br>

        <!-- Student Tardiness (Keterlambatan) Table -->
        <div class="table-responsive">
            <h4><i class="fa fa-clock-o"></i> Data Siswa Terlambat</h4>
            <?php if ($keterlambatan_activities->num_rows > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Tanggal</th>
                            <th width="15%">NIS</th>
                            <th>Nama Siswa</th>
                            <th width="12%">Kelas</th>
                            <th width="10%">Waktu Terlambat (menit)</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = $keterlambatan_activities->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td><?php echo htmlspecialchars($row['nis']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_siswa']); ?></td>
                                <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                <td><?php echo htmlspecialchars($row['waktu_terlambat']); ?> menit</td>
                                <td><?php echo htmlspecialchars(strip_tags($row['keterangan'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Belum ada data siswa yang terlambat dalam periode yang dipilih.
                </div>
            <?php endif; ?>
        </div>

        <br>

        <!-- Quick Print Today's Activities -->
        <div class="text-right">
            <a target="_blank" href="cetak-kegiatan-hariini.php?idg=<?php echo $data['id_guru']; ?>" class="btn btn-success">
                <i class="fa fa-print"></i> Cetak Kegiatan Hari Ini
            </a>
        </div>
    </div>
</div>

<!-- Card for additional information or controls -->
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="fa fa-user"></i> Informasi Guru</h5>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td width="30%">Nama</td>
                        <td width="2%">:</td>
                        <td><?php echo htmlspecialchars($data['nama_guru']); ?></td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($data['nip']); ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5><i class="fa fa-calendar"></i> Periode Laporan</h5>
                <p>
                    <?php echo date('d F Y', strtotime($tgl1)); ?>
                    <?php if ($tgl1 !== $tgl2): ?>
                        s.d <?php echo date('d F Y', strtotime($tgl2)); ?>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>