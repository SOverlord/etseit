<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
	<title></title>
   <script>
   </script>
</head>
<body>
<?php
	$key = $_GET['k'];
	$sql=mysql_query("SELECT FROM productos WHERE id=".$key);
?>

<?php 

   $consulta=mysql_query("SELECT * FROM productos");
   while($filas=mysql_fetch_array($consulta))
	{
?>

<form action="actualiza.php" target="_self" method="post">
	  <table>
         <tr>
            <td>Nombre</td>
            <td><input type="text" name="nombre" value="<?php print($filas["nombre"]); ?>"></td>
         </tr>
         <tr>
            <td>Descripción</td>
            <td><input type="text" name="descripcion" value="<?php print($filas["descripcion"]); ?>" ></td>
         </tr>
         <tr>
            <td>Costo</td>
            <td><input type="number" name="costo"  value="<?php print($filas["costo"]); ?>"></td>
         </tr>
            <tr>
            <td>Marca</td>
         <td><input type="text" name="marca"  value="<?php print($filas["marca"]); ?>"></td>
         </tr>
            <tr>
            <td>Tipo</td>
         <td>
            <select name="tipo">
               <option value="0">--Seleccione--</option>
               <option value="Celular">Celulares</option>
               <option value="Computadora">Computadoras</option>
               <option value="Periferico">Perifericos</option>
            </select>
         </td>
         </tr>
         <tr>
            <td>Cantidad en Stock</td>
            <td><input type="number" name="stock" value="<?php print($filas["cantidadStock"]); ?>"></td>
         </tr>
      </table>
   <input type="hidden" value="<?php print($key); ?>" name="k">
   <input type="submit" value="Actualizar">
</form>


<?php

	}

?>






</body>
</html>