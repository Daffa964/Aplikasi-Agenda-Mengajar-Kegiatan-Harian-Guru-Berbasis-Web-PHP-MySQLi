<?php include '../koneksi.php'; ?>
<?php
//otomatis muncul ketika laman di akses
echo "<script>window.print()</script>";
?>

<?php
session_start();
if (@$_SESSION['kepsek']) {
?>
	<?php
if (@$_SESSION['kepsek']) {
$sesi = @$_SESSION['kepsek'];
}

$sql = mysqli_query($con,"select * from tb_kepsek where id_kepsek = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>


<style type="text/css">
	.table{
		font-family: Arial, Helvetica, sans-serif;

	}
.tex{
	font-family: Arial, Helvetica, sans-serif;
</style>


<center>
	<img src="../images/logo.jpg" width="60">
	<h3 class="tex">LAPORAN KEGIATAN HARIAN SEKOLAH <br>
SMK NEGERI 4 PAYAKUMBUH</h3>
</center>
<hr>


	 <table class="table" cellpadding="4">
	 		<tr>
	 			<td>Nama Kepsek</td>
	 			<td>:</td>
	 			<td> <?php echo $data['nama']; ?> </td>
	 		</tr>




	 </table>
	  		<p class="tex">Tanggal :<?php echo $_GET['tgl1']." - ". $_GET['tgl2']; ?>
	</p>

	<!-- Statistik Harian -->
	<?php
	// Hitung statistik kehadiran siswa
	$sql_izin_count = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_izin_siswa WHERE tanggal_izin BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'") or die(mysqli_error($con));
	$izin_count = mysqli_fetch_array($sql_izin_count)['jumlah'];

	$sql_terlambat_count = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_keterlambatan WHERE tanggal BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'") or die(mysqli_error($con));
	$terlambat_count = mysqli_fetch_array($sql_terlambat_count)['jumlah'];

	// Hitung statistik kehadiran guru
	$sql_guru_hadir = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_kehadiran_guru WHERE tanggal_kehadiran BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' AND status_kehadiran = 'Hadir'") or die(mysqli_error($con));
	$guru_hadir = mysqli_fetch_array($sql_guru_hadir)['jumlah'];

	$sql_guru_izin = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_kehadiran_guru WHERE tanggal_kehadiran BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' AND status_kehadiran = 'Izin'") or die(mysqli_error($con));
	$guru_izin = mysqli_fetch_array($sql_guru_izin)['jumlah'];

	$sql_guru_sakit = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_kehadiran_guru WHERE tanggal_kehadiran BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' AND status_kehadiran = 'Sakit'") or die(mysqli_error($con));
	$guru_sakit = mysqli_fetch_array($sql_guru_sakit)['jumlah'];

	// Jumlah total siswa dan guru
	$sql_total_siswa = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_siswa") or die(mysqli_error($con));
	$total_siswa = mysqli_fetch_array($sql_total_siswa)['jumlah'];

	$sql_total_guru = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tb_guru") or die(mysqli_error($con));
	$total_guru = mysqli_fetch_array($sql_total_guru)['jumlah'];
	?>

	<div class="row">
		<div class="col-md-6">
			<table class="table table-bordered">
				<tr style="background-color:#E9FEBE;">
					<th colspan="2">Statistik Kehadiran Siswa</th>
				</tr>
				<tr>
					<td>Total Siswa</td>
					<td><?php echo $total_siswa; ?></td>
				</tr>
				<tr>
					<td>Siswa Izin</td>
					<td><?php echo $izin_count; ?></td>
				</tr>
				<tr>
					<td>Siswa Terlambat</td>
					<td><?php echo $terlambat_count; ?></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<table class="table table-bordered">
				<tr style="background-color:#E9FEBE;">
					<th colspan="2">Statistik Kehadiran Guru</th>
				</tr>
				<tr>
					<td>Total Guru</td>
					<td><?php echo $total_guru; ?></td>
				</tr>
				<tr>
					<td>Guru Hadir</td>
					<td><?php echo $guru_hadir; ?></td>
				</tr>
				<tr>
					<td>Guru Izin</td>
					<td><?php echo $guru_izin; ?></td>
				</tr>
				<tr>
					<td>Guru Sakit</td>
					<td><?php echo $guru_sakit; ?></td>
				</tr>
			</table>
		</div>
	</div>

	<h3 class="tex"><b>Kegiatan Teaching</b></h3>

		<table class="table" width="100%" border="2" style="border-collapse: collapse;" cellpadding="3" cellspacing="0">
		<thead>
		<tr style="height: 40px;background-color:#E9FEBE;">
		<th width="30">No.</th>
		<th>Tanggal</th>
		<th>Pukul</th>
		<th>Kegiatan</th>
		<th>Materi</th>
		<th>Kehadiran</th>
		<th>Keterangan</th>

		</tr>
		</thead>
		<tbody>
		<?php

		$no=1;

		$sql_Bayar = mysqli_query($con, "SELECT * FROM tb_agenda
			INNER JOIN tb_guru ON tb_agenda.id_guru = tb_guru.id_guru
			INNER JOIN tb_mapel ON tb_agenda.id_mapel=tb_mapel.id_mapel
		WHERE tb_agenda.tgl BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' ORDER BY tb_agenda.tgl, tb_agenda.jam ASC") or die(mysqli_error($con)) ;
		while ($d = mysqli_fetch_array($sql_Bayar)) {
		?>
		<tr>
		<td><?php echo $no++; ?>.</td>
		<td><?php echo $d['tgl']; ?> </td>
		<td><?php echo $d['jam']; ?> </td>
		<td>Mengajar <?php echo $d['nama_mapel']; ?> (<?php echo $d['nama_guru']; ?>)</td>
		<td><?php echo $d['materi']; ?> </td>
		<td><?php echo $d['absen']; ?> </td>
		<td><?php echo $d['ket']; ?> </td>

		</tr>
		<?php
		}
		?>

		</tbody>
		</table>
		<h3 class="tex"><b>Kegiatan Non Teaching</b></h3>

	<table class="table" width="100%" border="2" style="border-collapse: collapse;" cellpadding="3" cellspacing="0">
	<thead>
	<tr style="height: 40px;background-color:rgb(203,215,224);">
	<th width="30">No.</th>
	<th>Tanggal</th>
	<th>Kegiatan</th>
	<th>Isi Kegiatan</th>
	<th>Keterangan</th>

	</tr>
	</thead>
	<tbody>
	<?php

	$no=1;

	$sql_Bayar = mysqli_query($con, "SELECT * FROM tb_agendalain
	INNER JOIN tb_guru ON tb_agendalain.id_guru = tb_guru.id_guru
	WHERE tgl_kgt BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]' ORDER BY tgl_kgt ASC") or die(mysqli_error($con)) ;
	while ($d = mysqli_fetch_array($sql_Bayar)) {
	?>
	<tr>
	<td><?php echo $no++; ?>.</td>
	<td><?php echo $d['tgl_kgt']; ?> </td>
	<td><?php echo $d['kegiatan']; ?> (<?php echo $d['nama_guru']; ?>)</td>
	<td><?php echo $d['isi']; ?> </td>
	<td><?php echo $d['keterangan']; ?> </td>

	</tr>
	<?php
	}
	?>

	</tbody>
	</table>

	<!-- Tambahkan bagian kehadiran siswa -->
	<h3 class="tex"><b>Kehadiran Siswa (Izin)</b></h3>

	<table class="table" width="100%" border="2" style="border-collapse: collapse;" cellpadding="3" cellspacing="0">
		<thead>
			<tr style="height: 40px;background-color:#E9FEBE;">
				<th width="30">No.</th>
				<th>Tanggal</th>
				<th>NIS</th>
				<th>Nama Siswa</th>
				<th>Kelas</th>
				<th>Jenis Izin</th>
				<th>Keterangan</th>
				<th>Guru Pencatat</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_izin = mysqli_query($con, "SELECT i.*, s.nama_siswa, s.nis, k.kelas, g.nama_guru AS guru_pencatat
			FROM tb_izin_siswa i
			INNER JOIN tb_siswa s ON i.id_siswa = s.id_siswa
			INNER JOIN tb_kelas k ON s.idkelas = k.idkelas
			LEFT JOIN tb_guru g ON i.id_guru_piket = g.id_guru
			WHERE i.tanggal_izin BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
			ORDER BY i.tanggal_izin, s.nama_siswa") or die(mysqli_error($con));

		while ($d = mysqli_fetch_array($sql_izin)) {
		?>
			<tr>
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $d['tanggal_izin']; ?> </td>
				<td><?php echo $d['nis']; ?></td>
				<td><?php echo $d['nama_siswa']; ?></td>
				<td><?php echo $d['kelas']; ?></td>
				<td><?php echo $d['jenis_izin']; ?></td>
				<td><?php echo $d['keterangan']; ?></td>
				<td><?php echo $d['guru_pencatat'] ? $d['guru_pencatat'] : 'Admin'; ?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>

	<h3 class="tex"><b>Kehadiran Siswa (Keterlambatan)</b></h3>

	<table class="table" width="100%" border="2" style="border-collapse: collapse;" cellpadding="3" cellspacing="0">
		<thead>
			<tr style="height: 40px;background-color:rgb(203,215,224);">
				<th width="30">No.</th>
				<th>Tanggal</th>
				<th>NIS</th>
				<th>Nama Siswa</th>
				<th>Kelas</th>
				<th>Waktu Terlambat (menit)</th>
				<th>Keterangan</th>
				<th>Guru Pencatat</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_keterlambatan = mysqli_query($con, "SELECT k.*, s.nama_siswa, s.nis, kelas.kelas, g.nama_guru AS guru_pencatat
			FROM tb_keterlambatan k
			INNER JOIN tb_siswa s ON k.id_siswa = s.id_siswa
			INNER JOIN tb_kelas kelas ON s.idkelas = kelas.idkelas
			LEFT JOIN tb_guru g ON k.id_guru_piket = g.id_guru
			WHERE k.tanggal BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
			ORDER BY k.tanggal, s.nama_siswa") or die(mysqli_error($con));

		while ($d = mysqli_fetch_array($sql_keterlambatan)) {
		?>
			<tr>
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $d['tanggal']; ?> </td>
				<td><?php echo $d['nis']; ?></td>
				<td><?php echo $d['nama_siswa']; ?></td>
				<td><?php echo $d['kelas']; ?></td>
				<td><?php echo $d['waktu_terlambat']; ?> menit</td>
				<td><?php echo $d['keterangan']; ?></td>
				<td><?php echo $d['guru_pencatat'] ? $d['guru_pencatat'] : 'Admin'; ?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>

	<!-- Kehadiran Guru -->
	<h3 class="tex"><b>Kehadiran Guru</b></h3>

	<table class="table" width="100%" border="2" style="border-collapse: collapse;" cellpadding="3" cellspacing="0">
		<thead>
			<tr style="height: 40px;background-color:#f0f0f0;">
				<th width="30">No.</th>
				<th>Tanggal</th>
				<th>Nama Guru</th>
				<th>Status Kehadiran</th>
				<th>Waktu Masuk</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_kehadiran_guru = mysqli_query($con, "SELECT k.*, g.nama_guru
			FROM tb_kehadiran_guru k
			INNER JOIN tb_guru g ON k.id_guru = g.id_guru
			WHERE k.tanggal_kehadiran BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
			ORDER BY k.tanggal_kehadiran, g.nama_guru") or die(mysqli_error($con));

		while ($d = mysqli_fetch_array($sql_kehadiran_guru)) {
		?>
			<tr>
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $d['tanggal_kehadiran']; ?></td>
				<td><?php echo $d['nama_guru']; ?></td>
				<td>
					<?php
					$badge = '';
					switch($d['status_kehadiran']) {
						case 'Hadir': $badge = 'badge-success'; break;
						case 'Izin': $badge = 'badge-info'; break;
						case 'Sakit': $badge = 'badge-warning'; break;
						case 'Alpa': $badge = 'badge-danger'; break;
						default: $badge = 'badge-secondary'; break;
					}
					?>
					<span class="badge <?php echo $badge; ?>"><?php echo $d['status_kehadiran']; ?></span>
				</td>
				<td><?php echo $d['waktu_masuk'] ? $d['waktu_masuk'] : '-'; ?></td>
				<td><?php echo $d['keterangan'] ? $d['keterangan'] : '-'; ?></td>
			</tr>
		<?php
		}

		if(mysqli_num_rows($sql_kehadiran_guru) == 0) {
		?>
			<tr>
				<td colspan="6" class="text-center">Tidak ada data kehadiran guru pada periode ini.</td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>

	<!-- Kejadian Khusus/Insiden -->
	<h3 class="tex"><b>Kejadian Khusus/Insiden Harian</b></h3>

	<table class="table" width="100%" border="2" style="border-collapse: collapse;" cellpadding="3" cellspacing="0">
		<thead>
			<tr style="height: 40px;background-color:rgb(255,200,200);">
				<th width="30">No.</th>
				<th>Tanggal</th>
				<th>Jenis Kejadian</th>
				<th>Deskripsi</th>
				<th>Pelapor</th>
			</tr>
		</thead>
		<tbody>
		<?php
		// Untuk sementara, kita ambil dari agenda lain yang mungkin berisi kejadian khusus
		$no = 1;
		$sql_kejadian = mysqli_query($con, "SELECT a.*, g.nama_guru
			FROM tb_agendalain a
			LEFT JOIN tb_guru g ON a.id_guru = g.id_guru
			WHERE a.tgl_kgt BETWEEN '$_GET[tgl1]' AND '$_GET[tgl2]'
			ORDER BY a.tgl_kgt, a.kegiatan") or die(mysqli_error($con));

		$ada_kejadian = false;
		while ($d = mysqli_fetch_array($sql_kejadian)) {
			// Cek apakah agenda termasuk kejadian khusus
			if(stripos($d['kegiatan'], 'kecelakaan') !== false ||
				stripos($d['kegiatan'], 'insiden') !== false ||
				stripos($d['kegiatan'], 'kebakaran') !== false ||
				stripos($d['kegiatan'], 'keributan') !== false ||
				stripos($d['kegiatan'], 'cctv') !== false ||
				stripos($d['isi'], 'kecelakaan') !== false ||
				stripos($d['isi'], 'insiden') !== false ||
				stripos($d['isi'], 'kebakaran') !== false ||
				stripos($d['isi'], 'keributan') !== false) {
				$ada_kejadian = true;
		?>
			<tr>
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $d['tgl_kgt']; ?></td>
				<td><?php echo $d['kegiatan']; ?></td>
				<td><?php echo $d['isi']; ?></td>
				<td><?php echo $d['nama_guru'] ? $d['nama_guru'] : 'N/A'; ?></td>
			</tr>
		<?php
			}
		}

		if(!$ada_kejadian) {
		?>
			<tr>
				<td colspan="5" class="text-center">Tidak ada kejadian khusus/insiden pada periode ini.</td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>

	    <?php
    include '../koneksi.php';

  $sqlMapel= mysqli_query($con, "SELECT * FROM tb_kepsek ORDER BY id_kepsek DESC LIMIT 1
     ");
       $data= mysqli_fetch_array($sqlMapel);

   ?>
     <table width="100%" class="tex">
      <!--  <a href="#" class="no-print" onclick="window.print();"> <button style="height: 40px; width: 70px; background-color: dodgerblue;border:none; color: white; border-radius:7px;font-size: 17px; " type=""> Cetak</button> </a> -->
        <tr>
          <td align="right" colspan="6" rowspan="" headers="">
            <p>Payakumbuh, <?php echo date (" d F Y") ?>  <br> <br>
            Kepala Sekolah </p> <br> <br>
            <p> <?php echo $data['nama'] ?> <br>______________________</p>
          </td>
        </tr>
      </table>


		<?php
} else{

echo "<script>
window.location='../index.php';</script>";

}
