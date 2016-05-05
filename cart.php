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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Compra en línea - Carrito de Compras</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet"> 
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8" style="text-align:center;">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="comprar.php"><i class="fa fa-home"></i> Comprar</a></li>
								<!--<li><a href="index.php"><i class="fa fa-lock"></i> Mi cuenta </a></li>-->
								<li><a href="cart.php" class="active"><i class="fa fa-shopping-cart"></i> Ver Carrito</a></li>
								<li><a href="perfil.php"><i class="fa fa-lock"></i> Mi Perfil </a></li>
							</ul>
						</div>
					</div>
					<?php 

					$datosUsuario=mysql_query("SELECT * FROM Usuario WHERE idUsuario = '".$_SESSION['usuario']."' ");
					if(is_resource($datosUsuario) and mysql_num_rows($datosUsuario)>0){
						$du=mysql_fetch_array($datosUsuario);
						$nombreUsuario=$du['Alias'];
					}
					?>
					<form name="login" method="post" action="" style="text-align:right;">
							<h2>Bienvenido, <?php echo $nombreUsuario; ?></h2>
      						<input type="submit" name="salir" id="salir" value="Cerrar Sesión" />
							<?php	if ($error) {	echo '<br/><strong>Usuario o clave incorrecta</strong>';	}	?>
					</form>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<!--Muestra carrito de Hotel-->
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
					<h1 style="text-align: center;">Tus Reservas de Hotel</h1>
						<tr class="cart_menu" style="text-align: center;">
							<td><b>Hotel</b></td>
							<td><b>Ciudad</b></td>
							<td><b>Check-In</b></td>
							<td><b>Check-Out</b></td>
							<td><b>Habitaciones reservadas</b></td>
							<td><b>Costo por noche individual</b></td>
							<td><b>A pagar</b></td>
							<td><b>Cancelación</b></td>
						</tr>
					</thead>
					<tbody style="text-align: center;">
						<?php
							$carritoHotel=mysql_query("SELECT * FROM ReservaHotel WHERE fk_idUsuario_ReservaHotel='".$varSesionUser."'");
							if ($carritoHotel) {
								$consultaHotel=mysql_num_rows($carritoHotel);
								if ($consultaHotel) {
									while ($productoCarrito_Hotel=mysql_fetch_array($carritoHotel)) {
										if ($productoCarrito_Hotel) {
											//Recuperamos todos los datos de la reserva
											$idReservaHotel=$productoCarrito_Hotel['idReservaHotel'];
											$fechaInicioHotel=$productoCarrito_Hotel['FechaInicio'];
											$fechaFinalHotel=$productoCarrito_Hotel['FechaFinal'];
											$idHot=$productoCarrito_Hotel['fk_idHotel_ReservaHotel'];
											$habitacionesReservadas=$productoCarrito_Hotel['BoletosReservados'];

											$hotel=mysql_query("SELECT * FROM Hotel WHERE idHotel ='".$idHot."' ");
											if($hotel){
												$recuperaHotel=mysql_num_rows($hotel);
												if($recuperaHotel){
													while($datosHotel=mysql_fetch_array($hotel)){
														if($datosHotel){
															$idCiudad=$datosHotel['fk_idCiudad_Hotel'];
															$idServicio=$datosHotel['fk_idServicio_Hotel'];
														}
													}
												}
											}

											$ciudad=mysql_query("SELECT NombreCiudad FROM Ciudad WHERE idCiudad = '".$idCiudad."' ");
											if(is_resource($ciudad) and mysql_num_rows($ciudad) > 0){
												$cd = mysql_fetch_array($ciudad);
												$nombreCiudad=$cd['NombreCiudad'];
											}
											$servicio=mysql_query("SELECT * FROM Servicios WHERE idServicio = '".$idServicio."' ");
											if(is_resource($servicio) and mysql_num_rows($servicio)>0){
												$datos=mysql_fetch_array($servicio);
												$nombreHotel=$datos['NombreServicio'];
												$costo=$datos['Precio'];
											}
											$segs=strtotime($fechaFinalHotel) - strtotime($fechaInicioHotel);
											$diferencia=intval($segs/60/60/24);
											$pagoTotalHotel = $costo*$diferencia*$habitacionesReservadas;

											?>
											
											<tr>
												<td><?php echo $nombreHotel; 	?></td>
												<td><?php echo $nombreCiudad; 	?></td>
												<td><?php echo $fechaInicioHotel; 	?></td>
												<td><?php echo $fechaFinalHotel; 	?></td>
												<td><?php echo $habitacionesReservadas;	?></td>
												<td>$ <?php echo $costo; 	?></td>
												<td>$ <?php echo $pagoTotalHotel;	?></td>
												<td class="cart_delete" style="text-align:center">
												<form action="eliminaCarritoHotel.php" mehtod="GET" target="_self">
					                            	<input name="hotel" type="hidden" value="<?php echo $idReservaHotel; ?>">
					                            	<input type="submit" value="Cancelar"> </td>
					                            </form>
											</tr> <?php
											if(!$idReservaHotel) die('idReservaHotel error: ' . mysql_error());
											if(!$idHot) die('idHotel error: ' . mysql_error());
											if(!$fechaInicioHotel) die('fechaInicio error: ' . mysql_error());
											if(!$fechaFinalHotel) die('fechaFinal error: ' . mysql_error());
											if(!$habitacionesReservadas) die('habitacionesReservadas error: ' . mysql_error());
											if(!$hotel) die('hotel error: ' . mysql_error());
											if(!$recuperaHotel) die('recuperaHotel error: ' . mysql_error());
											if(!$idCiudad) die('idCiudad error: ' . mysql_error());
											if(!$idServicio) die('idServicio error: ' . mysql_error());
										}else{	die('productoCarrito_Hotel error: ' . mysql_error());	}
									}
								}else{	?> <tr><th colspan="8" style="text-align: center;"><h3>Usted aún no realiza ninguna compra</h3><th></tr> <?php }
							}else{	die('carritoHotel error: ' . mysql_error());	}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>	

	<!--Muestra carrito de Barco-->
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
					<h1 style="text-align: center;">Tus Reservas de Barco</h1>
						<tr class="cart_menu" style="text-align: center;">
							<td><b>Barco</b></td>
							<td><b>Puerto de Zarpe</b></td>
							<td><b>Ciudad de Zarpe</b></td>
							<td><b>Zarpe</b></td>
							<td><b>Arribo</b></td>
							<td><b>Boletos reservados</b></td>
							<td><b>Costo por boleto</b></td>
							<td><b>A Pagar</b></td>
							<td><b>Cancelación</b></td>
						</tr>
						</thead>
						<tbody style="text-align: center;">
						<?php
							$carritoBarco=mysql_query("SELECT * FROM ReservaBarco WHERE fk_idUsuario_ReservaBarco='".$varSesionUser."'");
							if ($carritoBarco) {
								$consultaBarco=mysql_num_rows($carritoBarco);
								if ($consultaBarco) {
									while ($productoCarrito_Barco=mysql_fetch_array($carritoBarco)) {
										if ($productoCarrito_Barco) {
											//Recuperamos todos los datos de la reserva
											$idReservaBarco=$productoCarrito_Barco['idReservaBarco'];
											$fechaInicio=$productoCarrito_Barco['FechaInicio'];
											$fechaFinal=$productoCarrito_Barco['FechaFinal'];
											$idPuerto=$productoCarrito_Barco['fk_idPuerto_ReservaBarco'];
											$habitacionesReservadas=$productoCarrito_Barco['BoletosReservados'];

											$puerto=mysql_query("SELECT * FROM Puerto WHERE idPuerto ='".$idPuerto."' ");
											if($puerto){
												$recuperaPuerto=mysql_num_rows($puerto);
												if($recuperaPuerto){
													while($datosPuerto=mysql_fetch_array($puerto)){
														if($datosPuerto){
															$nombrePuerto=$datosPuerto['NombrePuerto'];
															$idCiudad=$datosPuerto['fk_idCiudad_Puerto'];
															$idServicio=$datosPuerto['fk_idServicio_Puerto'];
														}
													}
												}
											}

											$ciudad=mysql_query("SELECT NombreCiudad FROM Ciudad WHERE idCiudad = '".$idCiudad."' ");
											if(is_resource($ciudad) and mysql_num_rows($ciudad) > 0){
												$cd = mysql_fetch_array($ciudad);
												$nombreCiudad=$cd['NombreCiudad'];
											}
											$servicio=mysql_query("SELECT * FROM Servicios WHERE idServicio = '".$idServicio."' ");
											if(is_resource($servicio) and mysql_num_rows($servicio)>0){
												$datosServicio=mysql_fetch_array($servicio);
												$nombre=$datosServicio['NombreServicio'];
												$costoBarco=$datosServicio['Precio'];
											}
											$pagoTotalBarco=$costoBarco*$habitacionesReservadas;
											?>
											<tr>
												<td><?php echo $nombre; 	?></td>
												<td><?php echo $nombrePuerto; 	?></td>
												<td><?php echo $nombreCiudad; 	?></td>
												<td><?php echo $fechaInicio; 	?></td>
												<td><?php echo $fechaFinal; 	?></td>
												<td><?php echo $habitacionesReservadas;	?></td>
												<td>$ <?php echo $costoBarco; 	?></td>
												<td>$ <?php echo $pagoTotalBarco; 	?></td>
												<td class="cart_delete" style="text-align:center">
												<form action="eliminaCarritoBarco.php" mehtod="GET" target="_self">
					                            	<input name="barco" type="hidden" value="<?php echo $idReservaBarco; ?>">
					                            	<input type="submit" value="Cancelar"> </td>
					                            </form>
											</tr> <?php
											if(!$idReservaBarco) die('idReserva error: ' . mysql_error());
											if(!$fechaInicio) die('fechaInicio error: ' . mysql_error());
											if(!$fechaFinal) die('fechaFinal error: ' . mysql_error());
											if(!$habitacionesReservadas) die('habitacionesReservadas error: ' . mysql_error());
											if(!$idCiudad) die('idCiudad error: ' . mysql_error());
											if(!$idServicio) die('idServicio error: ' . mysql_error());
										}else{	die('productoCarrito_Barco error: ' . mysql_error());	}
									}
								}else{	?> <tr><th colspan="9" style="text-align: center;"><h3>Usted aún no realiza ninguna compra</h3><th></tr> <?php }
							}else{	die('carritoBarco error: ' . mysql_error());	}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>	

	<!--Muestra carrito de boletos de Avión-->
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
					<h1 style="text-align: center;">Tus Reservas de Boletos de Avión</h1>
						<tr class="cart_menu" style="text-align: center;">
							<td><b>Aerolínea</b></td>
							<td><b>Aeropuerto de Salida</b></td>
							<td><b>Ciudad de Salida</b></td>
							<td><b>Ida</b></td>
							<td><b>Regreso</b></td>
							<td><b>Boletos reservados</b></td>
							<td><b>Costo por boleto</b></td>
							<td><b>A Pagar</b></td>
							<td><b>Cancelación</b></td>
						</tr>
						</thead>
						<tbody style="text-align: center;">
						<?php
							$carritoAvion=mysql_query("SELECT * FROM ReservaAvion WHERE fk_idUsuario_ReservaAvion='".$varSesionUser."'");
							if ($carritoAvion) {
								$consultaAvion=mysql_num_rows($carritoAvion);
								if ($consultaAvion) {
									while ($productoCarrito_Avion=mysql_fetch_array($carritoAvion)) {
										if ($productoCarrito_Avion) {
											//Recuperamos todos los datos de la reserva
											$idReservaAvion=$productoCarrito_Avion['idReservaAvion'];
											$fechaSalida=$productoCarrito_Avion['FechaInicio'];
											$fechaRetorno=$productoCarrito_Avion['FechaFinal'];
											$idAeropuerto=$productoCarrito_Avion['fk_idAeropuerto_ReservaAvion'];
											$boletosReservados=$productoCarrito_Avion['BoletosReservados'];

											$aeropuerto=mysql_query("SELECT * FROM Aeropuerto WHERE idAeropuerto ='".$idAeropuerto."' ");
											if($aeropuerto){
												$recuperaAeropuerto=mysql_num_rows($aeropuerto);
												if($recuperaAeropuerto){
													while($datosAeropuerto=mysql_fetch_array($aeropuerto)){
														if($datosAeropuerto){
															$nombreAeropuerto=$datosAeropuerto['NombreAeropuerto'];
															$idCiudadAeropuerto=$datosAeropuerto['fk_idCiudad_Aeropuerto'];
															$idServicioAeropuerto=$datosAeropuerto['fk_idServicio_Aeropuerto'];
														}
													}
												}
											}

											$ciudad=mysql_query("SELECT NombreCiudad FROM Ciudad WHERE idCiudad = '".$idCiudadAeropuerto."' ");
											if(is_resource($ciudad) and mysql_num_rows($ciudad) > 0){
												$cd = mysql_fetch_array($ciudad);
												$nombreCiudad=$cd['NombreCiudad'];
											}
											$servicio=mysql_query("SELECT * FROM Servicios WHERE idServicio = '".$idServicioAeropuerto."' ");
											if(is_resource($servicio) and mysql_num_rows($servicio)>0){
												$datosServicio=mysql_fetch_array($servicio);
												$nombre=$datosServicio['NombreServicio'];
												$costoAvion=$datosServicio['Precio'];
											}
											$pagoTotalAvion=$costoAvion*$boletosReservados;
											?>
											<tr>
												<td><?php echo $nombre; 	?></td>
												<td><?php echo $nombreAeropuerto; 	?></td>
												<td><?php echo $nombreCiudad; 	?></td>
												<td><?php echo $fechaSalida; 	?></td>
												<td><?php echo $fechaRetorno; 	?></td>
												<td><?php echo $boletosReservados;	?></td>
												<td>$ <?php echo $costoAvion; 	?></td>
												<td>$ <?php echo $pagoTotalAvion; 	?></td>
												<td class="cart_delete" style="text-align:center">
												<form action="eliminaCarritoAvion.php" mehtod="GET" target="_self">
					                            	<input name="avion" type="hidden" value="<?php echo $idReservaAvion; ?>">
					                            	<input type="submit" value="Cancelar"> </td>
					                            </form>
											</tr> <?php
											if(!$idReservaAvion) die('idReservaAvion error: ' . mysql_error());
											if(!$fechaSalida) die('fechaSalida error: ' . mysql_error());
											if(!$fechaRetorno) die('fechaRetorno error: ' . mysql_error());
											if(!$boletosReservados) die('boletosReservados error: ' . mysql_error());
											if(!$idCiudadAeropuerto) die('idCiudadAeropuerto error: ' . mysql_error());
											if(!$idServicioAeropuerto) die('idServicioAeropuerto error: ' . mysql_error());
										}else{	die('productoCarrito_Avion error: ' . mysql_error());	}
									}
								}else{	?> <tr><th colspan="9" style="text-align: center;"><h3>Usted aún no realiza ninguna compra</h3><th></tr> <?php }
							}else{	die('carritoAvion error: ' . mysql_error());	}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<!--Muestra carrito de Vehículos-->
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
					<h1 style="text-align: center;">Tus Reservas de Boletos de Automóvil</h1>
						<tr class="cart_menu" style="text-align: center;">
							<td><b>Marca</b></td>
							<td><b>Agencia</b></td>
							<td><b>Ciudad</b></td>
							<td><b>Inicio de Arrendamiento</b></td>
							<td><b>Fin de Arrendamiento</b></td>
							<td><b>Costo Diario</b></td>
							<td><b>A Pagar</b></td>
							<td><b>Cancelación</b></td>
						</tr>
						</thead>
						<tbody style="text-align: center;">
						<?php
							$carritoAuto=mysql_query("SELECT * FROM ReservaAuto WHERE fk_idUsuario_ReservaAuto='".$varSesionUser."'");
							if ($carritoAuto) {
								$consultaAuto=mysql_num_rows($carritoAuto);
								if ($consultaAuto) {
									while ($productoCarrito_Auto=mysql_fetch_array($carritoAuto)) {
										if ($productoCarrito_Auto) {
											//Recuperamos todos los datos de la reserva
											$idReservaAuto=$productoCarrito_Auto['idReservaAuto'];
											$fechaInicio=$productoCarrito_Auto['FechaInicio'];
											$fechaFinal=$productoCarrito_Auto['FechaFinal'];
											$idAgenciaAuto=$productoCarrito_Auto['fk_idAgenciaAuto_ReservaAuto'];

											$agencia=mysql_query("SELECT * FROM AgenciaAuto WHERE idAgenciaAuto ='".$idAgenciaAuto."' ");
											if($agencia){
												$recuperaAgenciaAuto=mysql_num_rows($agencia);
												if($recuperaAgenciaAuto){
													while($datosAgenciaAuto=mysql_fetch_array($agencia)){
														if($datosAgenciaAuto){
															$nombreAgenciaAuto=$datosAgenciaAuto['NombreAgenciaAuto'];
															$idCiudadAgenciaAuto=$datosAgenciaAuto['fk_idCiudad_AgenciaAuto'];
															$idServicioAgenciaAuto=$datosAgenciaAuto['fk_idServicio_AgenciaAuto'];
														}
													}
												}
											}

											$ciudad=mysql_query("SELECT NombreCiudad FROM Ciudad WHERE idCiudad = '".$idCiudadAgenciaAuto."' ");
											if(is_resource($ciudad) and mysql_num_rows($ciudad) > 0){
												$cd = mysql_fetch_array($ciudad);
												$nombreCiudad=$cd['NombreCiudad'];
											}
											$servicio=mysql_query("SELECT * FROM Servicios WHERE idServicio = '".$idServicioAgenciaAuto."' ");
											if(is_resource($servicio) and mysql_num_rows($servicio)>0){
												$datosServicio=mysql_fetch_array($servicio);
												$nombre=$datosServicio['NombreServicio'];
												$costoAuto=$datosServicio['Precio'];
											}
											$segs=strtotime($fechaFinal) - strtotime($fechaInicio);
											$diasReserva=intval($segs/60/60/24);
											$pagoTotalAuto=$costoAuto*$diasReserva;
											?>
											<tr>
												<td><?php echo $nombre; 	?></td>
												<td><?php echo $nombreAgenciaAuto; 	?></td>
												<td><?php echo $nombreCiudad; 	?></td>
												<td><?php echo $fechaInicio; 	?></td>
												<td><?php echo $fechaFinal; 	?></td>
												<td>$ <?php echo $costoAuto; 	?></td>
												<td>$ <?php echo $pagoTotalAuto; 	?></td>
												<td class="cart_delete" style="text-align:center">
												<form action="eliminaCarritoAuto.php" mehtod="GET" target="_self">
					                            	<input name="auto" type="hidden" value="<?php echo $idReservaAuto; ?>">
					                            	<input type="submit" value="Cancelar"> </td>
					                            </form>
											</tr> <?php
											if(!$idReservaAuto) die('idReservaAuto error: ' . mysql_error());
											if(!$fechaInicio) die('fechaInicio error: ' . mysql_error());
											if(!$fechaFinal) die('fechaFinal error: ' . mysql_error());
											if(!$idCiudadAgenciaAuto) die('idCiudadAgenciaAuto error: ' . mysql_error());
											if(!$idServicioAgenciaAuto) die('idServicioAgenciaAuto error: ' . mysql_error());
										}else{	die('productoCarrito_Auto error: ' . mysql_error());	}
									}
								}else{	?> <tr><th colspan="9" style="text-align: center;"><h3>Usted aún no realiza ninguna compra</h3><th></tr> <?php }
							}else{	die('carritoAuto error: ' . mysql_error());	}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section>


	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h1>Verifica tus datos</h1>
				<p>Comprueba tu monto total de compra e ingresa los datos correspondientes.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_info">
							<h3>Datos de Tarjeta</h3>
							<li class="single_field">
								<input type="text" placeholder="Numero de tarjeta" required>
							</li>
							<li class="single_field">
								<input type="text" placeholder="Vencimiento" required>
							</li>
							<li class="single_field">
								<input type="text" placeholder="CVV" required>
							</li>
						</ul>
						<ul>
							<input type="checkbox"> Acepto los términos y condiciones</input><br>
							Viajes EITSET no almacena datos personales ni de su tarjeta de crédito o débito.
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					<?php
						$usr=mysql_query("SELECT NumViajes FROM Usuario WHERE idUsuario='".$varSesionUser."'");
						if(is_resource($usr)){
							if(mysql_num_rows($usr)>0){
								$viajes=mysql_fetch_array($usr);
								$viajesRealizados=$viajes['NumViajes'];
								$descuento = 0.0;
							}else{
								die('mysql_num_rows($usr) error: ' . mysql_error());
							}
						}else{
							die('is_resource($usr) error: ' . mysql_error());
						}
					?>
						<ul>
							<li>SUB TOTAL <span>$ <?php $pagoTotal=$pagoTotalHotel+$pagoTotalBarco+$pagoTotalAvion+$pagoTotalAuto; echo $pagoTotal; ?></span></li>
							<li>DESCUENTO <span>
							<?php
								if($viajesRealizados<=4){
									echo 'No aplicable hasta su quinto viaje';
								}
								elseif ($viajesRealizados<=9) {
									echo '5%';
									$descuento=0.05;
								}
								elseif ($viajesRealizados<=14) {
									echo '10%';
									$descuento=0.1;
								}
								elseif ($viajesRealizados>=15) {
									echo '15%';
									$descuento=0.15;
								}
							?>
							</span></li>
							<li>DESCUENTO APLICABLE <span> - $<?php echo ($pagoTotal*$descuento);?></span></li>
							<li>TOTAL A PAGAR <span>$ <?php $TotalaPagar=$pagoTotal*(1-$descuento); echo $TotalaPagar; ?></span></li>
						</ul>
							<form action="realizarCompra.php" mehtod="GET" target="_self">
								<input name="comprar" type="hidden" value="<?php echo $varSesionUser; ?>">
								<input type="submit" value="Realizar Compra"> </td>
							</form>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
