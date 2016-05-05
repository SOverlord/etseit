<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="refresh" content="1;url=cart.php">
</head>
<body>
<?php
   $key = $_GET['barco'];
   $sql=mysql_query("DELETE FROM ReservaBarco WHERE idReservaBarco='".$key."'");
	//print("El registro se ha eliminado correctamente");
	//print("<a href='cart.php'>Regresar</a>");
?>

</body>
</html>