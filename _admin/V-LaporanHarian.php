<?php 
// File: v-laporanharian.php

// Pastikan variabel koneksi database ($con) sudah tersedia sebelum file ini di-include

// 1. Ambil Tanggal yang Dicari atau Gunakan Tanggal Hari Ini
$tanggal_cari = isset($_POST['tanggal_laporan']) 
             ? mysqli_real_escape_string($con, $_POST['tanggal_laporan']) 
             : date('Y-m-d'); 

// 2. Ambil Tahun Ajaran Aktif (dari tb_tajaran)
$tahun_ajaran_aktif = 'T.A Tidak Aktif';
// Menambahkan error checking
$sqlTa = mysqli_query($con, "SELECT tahun_ajaran FROM tb_tajaran WHERE status='Aktif'") or die("Query Tahun Ajaran Gagal: " . mysqli_error($con));
if (mysqli_num_rows($sqlTa) > 0) {
    $dataTa = mysqli_fetch_array($sqlTa);
    $tahun_ajaran_aktif = $dataTa['tahun_ajaran']; 
}

// ----------------------------------------------------------------------
// --- 3. QUERIES UNTUK MENGAMBIL DATA LAPORAN ---
// ----------------------------------------------------------------------

// A. Query Keterlambatan Siswa - Disesuaikan dengan id_guru_piket (INT)
$queryKeterlambatan = mysqli_query($con, "
    SELECT 
        a.waktu_terlambat, a.keterangan, 
        b.nama_siswa, c.kelas,
        d.nama_guru AS guru_pencatat
    FROM tb_keterlambatan a
    INNER JOIN tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN tb_kelas c ON b.idkelas = c.idkelas
    LEFT JOIN tb_guru d ON a.id_guru_piket = d.id_guru -- JOIN menggunakan id_guru_piket
    WHERE a.tanggal = '$tanggal_cari'
    ORDER BY a.waktu_terlambat DESC
") or die("Query Keterlambatan Gagal: " . mysqli_error($con));


// B. Query Perizinan Siswa (Tabel Izin tidak dilampirkan, diasumsikan skema lama benar)
// **CATATAN:** Jika tb_izin_siswa memiliki kolom 'id_guru_piket' (INT), query ini harus disesuaikan.
$queryIzin = mysqli_query($con, "
    SELECT 
        a.jenis_izin, a.keterangan, a.status_izin,
        b.nama_siswa, c.kelas,
        d.nama_guru AS guru_pemroses
    FROM tb_izin_siswa a
    INNER JOIN tb_siswa b ON a.id_siswa = b.id_siswa
    INNER JOIN tb_kelas c ON b.idkelas = c.idkelas
    LEFT JOIN tb_guru d ON a.id_guru_piket = d.id_guru
    WHERE a.tanggal_izin = '$tanggal_cari' 
    ORDER BY a.status_izin ASC
") or die("Query Perizinan Gagal: " . mysqli_error($con));


// C. Query Agenda LAIN-LAIN Guru Piket (tb_agendalain) - Disesuaikan dengan tgl_kgt
$queryAgendaLain = mysqli_query($con, "
    SELECT 
        a.kegiatan, a.isi, a.keterangan,
        b.nama_guru AS guru_pencatat
    FROM tb_agendalain a
    LEFT JOIN tb_guru b ON a.id_guru = b.id_guru
    WHERE a.tgl_kgt = '$tanggal_cari' -- Menggunakan tgl_kgt sesuai skema
    ORDER BY a.id_lain ASC
") or die("Query Agenda Lain Gagal: " . mysqli_error($con));


// D. Query Agenda Mengajar (tb_agenda) 
// **CATATAN:** Query ini mengasumsikan tb_agenda memiliki kolom 'idkelas' yang terhubung ke tb_kelas.
$queryAgendaMengajar = mysqli_query($con, "
    SELECT 
        a.jam, a.materi, a.absen, a.ket, 
        b.nama_guru,
        c.kelas 
    FROM 
        tb_agenda a
    INNER JOIN tb_guru b ON a.id_guru = b.id_guru
    INNER JOIN tb_kelas c ON a.idkelas = c.idkelas 
    WHERE a.tgl = '$tanggal_cari'
    ORDER BY a.jam ASC
") or die("Query Agenda Mengajar Gagal: " . mysqli_error($con));

$total_agenda = mysqli_num_rows($queryAgendaLain) + mysqli_num_rows($queryAgendaMengajar);

// ----------------------------------------------------------------------
// --- 4. TAMPILAN LAPORAN (HTML/PHP) ---
// ----------------------------------------------------------------------
?>

<div class="card">
    <div class="card-header bg-info text-white">
        <strong class="card-title"> 
            <span class="fa fa-book"></span> Laporan Agenda Harian Sekolah
        </strong>
    </div>
    <div class="card-body">
        
        <form action="?page=act" method="POST" class="form-inline mb-4">
            <label for="tanggal_laporan" class="mr-2">Pilih Tanggal Laporan:</label>
            <input type="date" name="tanggal_laporan" id="tanggal_laporan" class="form-control mr-2" 
                    value="<?php echo $tanggal_cari; ?>">
            <button type="submit" class="btn btn-primary"> 
                <span class="fa fa-search"></span> Cari
            </button>
            
            <?php if (mysqli_num_rows($queryKeterlambatan) > 0 || mysqli_num_rows($queryIzin) > 0 || $total_agenda > 0): ?>
            <a href="cetak_laporan_harian.php?tanggal=<?php echo $tanggal_cari; ?>" target="_blank" class="btn btn-success ml-2"> 
                <span class="fa fa-print"></span> Cetak Laporan
            </a>
            <?php endif; ?>
        </form>

        <hr>
        
        <h4 class="mb-3 text-primary">
            Laporan Tanggal: **<?php echo date('d F Y', strtotime($tanggal_cari)); ?>** <small class="text-danger">(T.A. <?php echo $tahun_ajaran_aktif; ?>)</small>
        </h4>

        <h5 class="mt-4"><span class="fa fa-clock-o"></span> Ringkasan Keterlambatan Siswa (Total: <?= mysqli_num_rows($queryKeterlambatan); ?> Siswa)</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Siswa / Kelas</th>
                        <th>Lama Terlambat (Menit)</th>
                        <th>Keterangan</th>
                        <th>Guru Pencatat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($queryKeterlambatan) > 0):
                        $no = 1;
                        while ($dataKet = mysqli_fetch_array($queryKeterlambatan)):
                    ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= $dataKet['nama_siswa']; ?> (<?= $dataKet['kelas']; ?>)</td>
                            <td>**<?= $dataKet['waktu_terlambat']; ?> Menit**</td>
                            <td><?= $dataKet['keterangan']; ?></td>
                            <td><?= $dataKet['guru_pencatat'] ?? 'N/A'; ?></td>
                        </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                        <tr><td colspan="5" class="text-center text-muted">Tidak ada data keterlambatan pada tanggal ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        ---

        <h5 class="mt-4"><span class="fa fa-envelope-open-o"></span> Ringkasan Perizinan Siswa (Total: <?= mysqli_num_rows($queryIzin); ?> Pengajuan)</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Siswa / Kelas</th>
                        <th>Jenis Izin</th>
                        <th>Keterangan Awal</th>
                        <th>Status</th>
                        <th>Guru Pemroses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($queryIzin) > 0):
                        $no = 1;
                        while ($dataIzin = mysqli_fetch_array($queryIzin)):
                            $badge = ($dataIzin['status_izin'] == 'Disetujui') ? 'badge-success' : (($dataIzin['status_izin'] == 'Ditolak') ? 'badge-danger' : 'badge-warning');
                    ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= $dataIzin['nama_siswa']; ?> (<?= $dataIzin['kelas']; ?>)</td>
                            <td><?= $dataIzin['jenis_izin']; ?></td>
                            <td><?= substr($dataIzin['keterangan'], 0, 100) . '...'; ?></td>
                            <td><span class="badge <?= $badge; ?>"><?= $dataIzin['status_izin']; ?></span></td>
                            <td><?= $dataIzin['guru_pemroses'] ?? 'N/A'; ?></td>
                        </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                        <tr><td colspan="6" class="text-center text-muted">Tidak ada data perizinan siswa pada tanggal ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        ---
        
        <h5 class="mt-4"><span class="fa fa-tasks"></span> Catatan Kegiatan/Kejadian Penting (Total: <?= mysqli_num_rows($queryAgendaLain); ?> Catatan)</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Jenis Kegiatan</th>
                        <th>Isi / Detail Kejadian</th>
                        <th>Keterangan</th>
                        <th width="20%">Guru Pencatat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($queryAgendaLain) > 0):
                        $no = 1;
                        while ($dataLain = mysqli_fetch_array($queryAgendaLain)):
                    ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td>**<?= $dataLain['kegiatan']; ?>**</td>
                            <td><?= $dataLain['isi']; ?></td>
                            <td><?= $dataLain['keterangan']; ?></td>
                            <td><?= $dataLain['guru_pencatat'] ?? 'N/A'; ?></td>
                        </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                        <tr><td colspan="5" class="text-center text-muted">Tidak ada catatan kegiatan penting (agenda lain) pada tanggal ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        ---

        <h5 class="mt-4"><span class="fa fa-address-book"></span> Agenda Mengajar Guru (Total: <?= mysqli_num_rows($queryAgendaMengajar); ?> Jam Pelajaran)</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-sm table-striped">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Jam Ke-</th>
                        <th>Guru / Kelas</th>
                        <th>Materi Pembelajaran</th>
                        <th>Absensi Siswa</th>
                        <th>Ket. Guru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($queryAgendaMengajar) > 0):
                        $no = 1;
                        while ($dataAjar = mysqli_fetch_array($queryAgendaMengajar)):
                    ?>
                        <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= $dataAjar['jam']; ?></td>
                            <td>
                                <strong><?= $dataAjar['nama_guru']; ?></strong> <br>
                                <small class="text-muted"><?= $dataAjar['kelas']; ?></small>
                            </td>
                            <td><?= $dataAjar['materi']; ?></td>
                            <td><?= $dataAjar['absen']; ?></td>
                            <td><?= $dataAjar['ket']; ?></td>
                        </tr>
                    <?php 
                        endwhile; 
                    else:
                    ?>
                        <tr><td colspan="6" class="text-center text-muted">Tidak ada data agenda mengajar pada tanggal ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>
</div>