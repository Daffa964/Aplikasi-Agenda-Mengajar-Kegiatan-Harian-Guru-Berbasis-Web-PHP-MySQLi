<?php 
$id= $_GET['id'];
mysqli_query($con,"DELETE FROM tb_mapel WHERE id_mapel='$id' ") or die(mysqli_error($con)) ;
echo "<script>
alert('Data Berhasil Dihapus.');
window.location='?page=mapel';
</script>";

 ?>