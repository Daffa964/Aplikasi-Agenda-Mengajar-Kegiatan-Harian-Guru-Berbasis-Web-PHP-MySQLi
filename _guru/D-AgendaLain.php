<?php 
$idg= $_GET['idg'];
mysqli_query($con,"DELETE FROM tb_agendalain WHERE id_lain ='$idg' ");

echo "
<script>
alert('Data Berhasil Dihapus.');
window.location='?page=aglain';


</script> ";

 ?>