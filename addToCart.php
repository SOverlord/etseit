<?php
include('conexion.php');
require ("funciones.php");
$error = 0;

seguridad(); //comprobamos que se esté logueado
$varSesionUser = $_SESSION['usuario'];

if(isset($_POST['salir']))
{    
	
	destruirCookie($_COOKIE['identificado']);
	
	$_SESSION = array();
 
	//guardar el nombre de la sessión para luego borrar las cookies
	$session_name = session_name();
 
	//Para destruir una variable en específico
	unset($_SESSION['usuario']);
 
	// Finalmente, destruye la sesión
	session_destroy();
 
	// Para borrar las cookies asociadas a la sesión
	// Es necesario hacer una petición http para que el navegador las elimine
	if ( isset( $_COOKIE[ $session_name ] ) ) {
		setcookie($session_name, '', time()-3600, '/');   
	}
	if(isset($_COOKIE['identificado'])){
		setcookie('identificado', '', time()-3600, '/'); 
	}
	header("Location: index.php");
	exit();
   
}
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf8">
   <meta http-equiv="refresh" content="1;url=cart.php">
</head>
<body>
<?php
  header('Content-Type: text/html; charset=UTF-8');
   $tipoServicio=$_POST["tipoServicio"];
   $idServicio=$_POST["idProveedor"];
   $fechaInicio=$_POST["fechaInicio"];
   $fechaFinal=$_POST["fechaFinal"];
   if($tipoServicio!='Automovil'){	$boletos=$_POST["NumBoletos"];   }

   switch ($tipoServicio) {
   	case 'Automovil':
   		echo "automovil";
   		$sql="INSERT INTO ReservaAuto(`FechaInicio`, `FechaFinal`, `PagoAnticipado`, `fk_idAgenciaAuto_ReservaAuto`, `fk_idUsuario_ReservaAuto`)
   				VALUES ('".$fechaInicio."', '".$fechaFinal."', NULL, '".$idServicio."', '".$varSesionUser."')";
   		break;
   	case 'Vuelo':
   		$sql="INSERT INTO ReservaAvion(`FechaInicio`, `FechaFinal`, `PagoAnticipado`, `fk_idAeropuerto_ReservaAvion`, `fk_idUsuario_ReservaAvion`, `BoletosReservados`)
   				VALUES ('".$fechaInicio."', '".$fechaFinal."', NULL, '".$idServicio."', '".$varSesionUser."', '".$boletos."')";
   		break;
   	case 'Barco':
   		$sql="INSERT INTO ReservaBarco(`FechaInicio`, `FechaFinal`, `PagoAnticipado`, `fk_idPuerto_ReservaBarco`, `fk_idUsuario_ReservaBarco`, `BoletosReservados`)
   				VALUES ('".$fechaInicio."', '".$fechaFinal."', NULL, '".$idServicio."', '".$varSesionUser."', '".$boletos."')";
   		break;
   	case 'Hotel':
   		$sql="INSERT INTO ReservaHotel(`FechaInicio`, `FechaFinal`, `PagoAnticipado`, `fk_idHotel_ReservaHotel`, `fk_idUsuario_ReservaHotel`, `BoletosReservados`)
   				VALUES ('".$fechaInicio."', '".$fechaFinal."', NULL, '".$idServicio."', '".$varSesionUser."', '".$boletos."')";
   		break;
   	}
   	$res=mysql_query($sql,$driver);
   	if($res){
   		header("Location: cart.php");
   	}else{
   		echo "Error";
   	}
?>
