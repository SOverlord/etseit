<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="refresh" content="1;url=consola.php">
</head>
<body>
<?php
   $key = $_GET['k'];
   $sql=mysql_query("DELETE FROM productos WHERE id=".$key);
//	print("El registro se ha eliminado correctamente");
//   print("<a href='consola.php'>Regresar</a>");
?>

</body>
</html>