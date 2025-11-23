<?php include '../koneksi.php'; ?>
<?php
//otomatis muncul ketika laman di akses
echo "<script>window.print()</script>";
?>

<?php
session_start();
if (@$_SESSION['admin']) {
?>
	<?php
if (@$_SESSION['admin']) {
$sesi = @$_SESSION['admin'];
}

$sql = mysqli_query($con,"select * from tb_user where id_admin = '$sesi'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);

$tanggal_cari = $_GET['tanggal'] ?? date('Y-m-d');
?>


<style type="text/css">
	.table{
		font-family: Arial, Helvetica, sans-serif;
	}
.tex{
	font-family: Arial, Helvetica, sans-serif;
}
</style>


<center>
	<img src="../images/logo.jpg" width="60">
	<h3 class="tex">LAPORAN KEGIATAN HARIAN SEKOLAH <br>
SMK NEGERI 4 PAYAKUMBUH</h3>
</center>
<hr>


	 <table class="table" cellpadding="4">
	 		<tr>
	 			<td>Nama Admin</td>
	 			<td>:</td>
	 			<td> <?php echo $data['nama']; ?> </td>
	 		</tr>




	 </table>
	  		<p class="tex">Tanggal :<?php echo date('d F Y', strtotime($tanggal_cari)); ?>
	</p>

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
		WHERE tb_agenda.tgl = '$tanggal_cari' ORDER BY tb_agenda.jam ASC") or die(mysqli_error($con)) ;
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
	WHERE tgl_kgt = '$tanggal_cari' ORDER BY tgl_kgt ASC") or die(mysqli_error($con)) ;
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
				<th>Nama Siswa</th>
				<th>Kelas</th>
				<th>Jenis Izin</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_izin = mysqli_query($con, "SELECT i.*, s.nama_siswa, k.kelas
			FROM tb_izin_siswa i
			INNER JOIN tb_siswa s ON i.id_siswa = s.id_siswa
			INNER JOIN tb_kelas k ON s.idkelas = k.idkelas
			WHERE i.tanggal_izin = '$tanggal_cari'
			ORDER BY s.nama_siswa") or die(mysqli_error($con));

		while ($d = mysqli_fetch_array($sql_izin)) {
		?>
			<tr>
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $d['tanggal_izin']; ?> </td>
				<td><?php echo $d['nama_siswa']; ?></td>
				<td><?php echo $d['kelas']; ?></td>
				<td><?php echo $d['jenis_izin']; ?></td>
				<td><?php echo $d['keterangan']; ?></td>
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
				<th>Nama Siswa</th>
				<th>Kelas</th>
				<th>Waktu Terlambat (menit)</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_keterlambatan = mysqli_query($con, "SELECT k.*, s.nama_siswa, kelas.kelas
			FROM tb_keterlambatan k
			INNER JOIN tb_siswa s ON k.id_siswa = s.id_siswa
			INNER JOIN tb_kelas kelas ON s.idkelas = kelas.idkelas
			WHERE k.tanggal = '$tanggal_cari'
			ORDER BY s.nama_siswa") or die(mysqli_error($con));

		while ($d = mysqli_fetch_array($sql_keterlambatan)) {
		?>
			<tr>
				<td><?php echo $no++; ?>.</td>
				<td><?php echo $d['tanggal']; ?> </td>
				<td><?php echo $d['nama_siswa']; ?></td>
				<td><?php echo $d['kelas']; ?></td>
				<td><?php echo $d['waktu_terlambat']; ?> menit</td>
				<td><?php echo $d['keterangan']; ?></td>
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