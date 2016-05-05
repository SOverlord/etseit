<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="refresh" content="1;url=cart.php">
</head>
<body>
<?php
	$conexion=mysql_connect("localhost","root","qwerty",false);
	$bd = mysql_select_db("etseitSystem",$conexion);
   	$key = $_GET['comprar'];
   	$usr=mysql_query("SELECT NumViajes FROM Usuario WHERE idUsuario='".$key."'");
	if(is_resource($usr)){
		if(mysql_num_rows($usr)>0){
			$viajes=mysql_fetch_array($usr);
			$viajesRealizados=$viajes['NumViajes'];
			if($viajesRealizados){
				$nuevosViajesRealizados = $viajesRealizados+1;
	   			$sql2 = "UPDATE Usuario SET NumViajes=".$nuevosViajesRealizados." WHERE idUsuario=".$key." ";
	   			$result2 = mysql_query($sql2,$conexion);
	   			if($sql2){
				 	$sql=mysql_query("DELETE FROM ReservaAuto  WHERE fk_idUsuario_ReservaAuto='".$key."'");
					$sql=mysql_query("DELETE FROM ReservaHotel WHERE fk_idUsuario_ReservaHotel='".$key."'");
			   		$sql=mysql_query("DELETE FROM ReservaAvion WHERE fk_idUsuario_ReservaAvion='".$key."'");
			   		$sql=mysql_query("DELETE FROM ReservaBarco WHERE fk_idUsuario_ReservaBarco='".$key."'");
	   			}
			}
		}
	}

	//print("El registro se ha eliminado correctamente");
	//print("<a href='cart.php'>Regresar</a>");
?>

</body>
</html>