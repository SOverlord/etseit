<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="refresh" content="1;url=consola.php">
	<title></title>
</head>
<body>


<?php
   $key = $_POST['k'];
   print($key);
	$nombre=$_POST["nombre"];
   $descripcion=$_POST["descripcion"];
   $costo=$_POST["costo"];
   $marca=$_POST["marca"];
   $tipo=$_POST["tipo"];
   $stock=$_POST["stock"];
   if($tipo == 'Celular'){
      $imagen="images/productos/celular.jpg";
   }
   if($tipo == 'Computadora'){
      $imagen="images/productos/computadora.jpg";
   }
   if($tipo == 'Periferico'){
      $imagen="images/productos/perifericos.jpg";
   }


	$sql = mysql_query("UPDATE productos SET 
      nombre='".$nombre."',
      costo= '".$costo."',
      cantidadStock = '".$stock."',
      tipo = '".$tipo."',
      marca= '".$marca."',
      descripcion = '".$descripcion."',
      imagen = '".$imagen."'
   WHERE id=".$key);

//	print("Tu registro se ha actualizado correctamente<br><br>");
	mysql_close($driver);
//   print("<a href='consola.php'><button>Regresar a la Consola</button></a>");

?>






</body>
</html>