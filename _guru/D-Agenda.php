<?php
$idg= $_GET['idg'];

// Get the id_mapel before deleting the record to redirect back properly
$sql = mysqli_query($con, "SELECT id_mapel FROM tb_agenda WHERE id_agenda = '$idg'");
$data = mysqli_fetch_array($sql);
$id_mapel = $data['id_mapel'];

mysqli_query($con,"DELETE FROM tb_agenda WHERE id_agenda='$idg' ") or die(mysqli_error($con)) ;
echo "
<script>
alert('Data Telah Terhapus !!');
window.location='?page=add-agenda&idg=$id_mapel';


</script> ";

?>