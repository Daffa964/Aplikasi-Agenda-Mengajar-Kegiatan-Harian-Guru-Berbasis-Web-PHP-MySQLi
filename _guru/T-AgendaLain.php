<?php
session_start();
include '../koneksi.php';

// Pastikan hanya user dengan sesi 'guru' yang bisa mengakses
if (!isset($_SESSION['guru'])) {
    header("Location: ../index.php"); // Arahkan ke index jika sesi tidak ada
    exit();
}
?>

<div class="col-md-12">
	<div class="card">
	<div class="card-header bg-dark">
	<strong class="card-title text-light"> <span class="fa fa-plus"></span> Tambah Agenda Lain </strong>
	</div>

     <form action="" method="post">
			<div class="card">
              <div class="card-header">
                <h3> <span class="fa fa-edit"></span>  Form Agenda </h3>
              </div>
              <div class="card-body card-block">

                  <div class="form-group">
                  	<label for="nf-email" name="" class=" form-control-label">Hari / Tanggal Kegiatan  </label>
                  	<input type="hidden" name="id_guru" value="<?php echo $_SESSION['guru']; ?>">
                  	<input type="date" id="nf-email" name="tgl" class="form-control" value="<?php echo date('Y-m-d'); ?>">

                  </div>
                   <div class="form-group">
                  	<label for="nf-email" class=" form-control-label"> Nama Kegiatan</label>
                  	<input type="text" id="nf-email" name="kegiatan" class="form-control">

                  </div>
                     <div class="form-group">
                  	<label for="nf-email" class=" form-control-label"> Isi Kegiatan / Acara</label>

                  	<textarea class="ckeditor" name="isi" id="ckedtor1"></textarea>

                  </div>
                  <div class="form-group">
                  	<label for="nf-password" class=" form-control-label">Keterangan</label>
                  	<textarea class="form-control" name="ket"></textarea>
                  </div>

              </div>
              <div class="card-footer">
                <button type="submit" name="save-agenda" class="btn btn-primary">
                  <i class="fa fa-save"></i> Simpan Agenda
                </button>
                <button type="reset" class="btn btn-danger">
                  <i class="fa fa-ban"></i> Reset
                </button>
                <a href="javascript:history.back()" class="btn btn-warning"> <span class="fa fa-chevron-left"></span> Kembali </a>
              </div>

            </div>
              </form>

              <?php

if (isset($_POST['save-agenda'])) {

$id_guru = $_POST['id_guru'];
$tgl     = $_POST['tgl'];
$judul   = $_POST['kegiatan'];
$isi     = $_POST['isi'];
$ket     = $_POST['ket'];

// simpan ke tb_agendalain
$result = mysqli_query($con, " INSERT INTO tb_agendalain (id_guru,tgl_kgt,kegiatan,isi,keterangan)
VALUES('$id_guru','$tgl','$judul','$isi','$ket') ") or die(mysqli_error($con)) ;

if($result) {
    echo "
    <script>
    alert('Data Berhasil Disimpan !!');
    window.location='?page=aglain';
    </script> ";
    exit();
} else {
    echo "
    <script>
    alert('Gagal menyimpan data !!');
    </script> ";
}
}

?>
		</div>
	</div>
</div>