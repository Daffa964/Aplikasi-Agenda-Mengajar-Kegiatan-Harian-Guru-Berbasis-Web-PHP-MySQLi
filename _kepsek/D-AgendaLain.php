	<?php 
	$idg = $_GET['idg'];
	$sqlMapel= mysqli_query($con, "SELECT * FROM tb_agenda_lain WHERE id_lain = '$idg'");
	     $data= mysqli_fetch_array($sqlMapel);

	 ?>

<?php 
$idg= $_GET['idg'];
mysqli_query($con,"DELETE FROM tb_agenda_lain WHERE id_lain ='$idg' ");

echo " 
<script>
alert('Data terhapus !!');
window.location='?page=v_aglain&idg=$data[id_guru] ';


</script> ";

 ?>