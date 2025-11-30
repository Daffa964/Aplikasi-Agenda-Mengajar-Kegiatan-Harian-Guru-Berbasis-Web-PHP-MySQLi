<div class="card">
	<div class="card-header">
		<strong class="card-title"> <span class="fa fa-users"></span> Data Guru</strong>
		<a href="?page=t_guru" class="btn btn-primary float-right btn-sm">
			<i class="fa fa-plus"></i> Tambah Guru
		</a>
		<a href="?page=import_guru" class="btn btn-info float-right btn-sm mr-2">
			<i class="fa fa-file-excel-o"></i> Import CSV
		</a>
	</div>
	<div class="card-body">
		<table id="bootstrap-data-table" class="table table-striped table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nip</th>
					<th>Nama</th>
					<th>Gender</th>
					<th>Agama</th>
					<th>Email</th>
					<th>Foto</th>
					<th>
						<center><span class="fa fa-gear"></span> Opsi</center>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				$queryGuru = mysqli_query($con, "SELECT * FROM tb_guru") or die(mysqli_error($con));
				while ($data = mysqli_fetch_array($queryGuru)) {

				?>
					<tr>
						<td><b> <?= $no++ ?>.</b> </td>
						<td><a style="color: red;" href="?page=l_guru&idg=<?php echo $data['id_guru']; ?> " title="Lihat Detail"><?= $data['nip'] ?></a> </td>
						<td><?= $data['nama_guru'] ?></td>
						<td><?= $data['kelamin'] ?></td>
						<td><?= $data['agama'] ?></td>
						<td><?= $data['email'] ?></td>
						<td> <img class="img-responsive" src="../images/<?= $data['photo'] ?>" style="border-radius: 100%; " width="50" height="50"> </td>
						<td>
							<a href="?page=l_guru&idg=<?php echo $data['id_guru']; ?> " class="btn btn-info"> <span class="fa fa-search"></span> </a>
							<a href="?page=e_guru&idg=<?php echo $data['id_guru']; ?> " class="btn btn-warning"> <span class="fa fa-edit"></span> </a>
							<a onclick="return confirm('Yakin !! Ingin Hapus Data !!')" href="?page=h_guru&idg=<?php echo $data['id_guru']; ?> " class="btn btn-danger"> <span class="fa fa-trash"></span> </a>
						</td>
					</tr>
				<?php
				}
				?>

			</tbody>
		</table>
		<hr>

		<a href="javascript:history.back()" class="btn btn-warning"> <span class="fa fa-chevron-left"></span> Kembali </a>
	</div>
</div>