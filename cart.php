<?php
include('conexion.php');
require ("funciones.php");
$error = 0;

 seguridad(); //comprobamos que se esté logueado

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
   <script languaje="javascript">
      function pasaValor(form){
         calcular.costoTotal.value = calcular.cantidad.value;
      }
   </script>
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
					<div class="col-sm-8" style="text-align:center">
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
								<li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
								<li><a href="login.php"><i class="fa fa-lock"></i> Mi cuenta </a></li>
								<li><a href="cart.php" class="active"><i class="fa fa-shopping-cart"></i> Ver Carrito</a></li>
								<li>
								<form name="login" method="post" action="">
                  						<input type="submit" name="salir" id="salir" value="Salir" />
          									<?php
            									if ($error) {
                									echo '<br/><strong>Usuario o clave incorrecta</strong>';
												}
											?>
								</form>
								</li>
								<li><?php echo $_SESSION['usuario'];	?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
					<h2 style="text-align: center;">Tus Reservas de Hotel</h2>
						<tr class="cart_menu" style="text-align: center;">
							<td><b>Nombre del Hotel</b></td>
							<td><b>Ciudad</b></td>
							<td><b>Inicio de Arrendamiento</b></td>
							<td><b>Fin de Arrendamiento</b></td>
							<td><b>Habitaciones reservadas</b></td>
							<td><b>Precio por noche</b></td>
							<td><b>Cancelación</b></td>
						</tr>
					</thead>
					<tbody style="text-align: center;">
					<?php
						$varSesionUser = $_SESSION['usuario'];
						$carritoHotel=mysql_query("SELECT * FROM ReservaHotel WHERE idUsuario='".$varSesionUser."'");
						if (!$carritoHotel) {
    						die('Query1 error: ' . mysql_error());
						}else{
							$consultaHotel=mysql_num_rows($carritoHotel);
							if (!$consultaHotel) {
	    						die('Query2 error: ' . mysql_error());
							}
							else{
								if($consultaHotel>0){
									while ($productoCarrito_Hotel=mysql_fetch_array($carritoHotel)) {
										if (!$productoCarrito_Hotel) {
		    								die('Query3 error: ' . mysql_error());
										}
										else{
											//Recuperamos todos los datos de la reserva
											$idReserva=$productoCarrito_Hotel['idReserva'];
											$idHotel=$productoCarrito_Hotel['Hotel_idHotel'];			//-->Con otra consulta recuperaremos el nombre del hotel, tasa y costo
											$fechaInicio=$productoCarrito_Hotel['FechaInicio'];
											$fechaFinal=$productoCarrito_Hotel['FechaFinal'];
											//$costo=$productoCarrito_Hotel['CosteAsociado'];
											$habitacionesReservadas=$productoCarrito_Hotel['NoHabitaciones'];

											$selectHotel=mysql_query("SELECT * FROM Hotel WHERE '".$idHotel."' = idHotel ");
											while($valHotel=mysql_fetch_array($selectHotel)){
												$nombreHotel=$valHotel['NombreHotel'];
												$costoHotel=$valHotel['Precio'];
											}
											
											$IDciudadHotel=mysql_query("SELECT * FROM CiudadHotel WHERE '".$idHotel."' = CiudadHotel_idHotel_fk ");
											while($ciudadHotel=mysql_fetch_array($IDciudadHotel)){
												$idCiudad=$ciudadHotel['CiudadHotel_idCiudad_fk'];
											}
											$nC=mysql_query("SELECT NombreCiudad FROM Ciudad WHERE '".$idCiudad."' = idCiudad ");
											while($nCiud=mysql_fetch_array($nC)){
												$nombreCiudad=$nCiud['NombreCiudad'];
											}

											if(!$idReserva) die('idReserva error: ' . mysql_error());
											if(!$idHotel) die('idHotel error: ' . mysql_error());
											if(!$fechaInicio) die('fechaInicio error: ' . mysql_error());
											if(!$fechaFinal) die('fechaFinal error: ' . mysql_error());
											if(!$habitacionesReservadas) die('habitacionesReservadas error: ' . mysql_error());
											if(!$nombreHotel) die('nombreHotel error: ' . mysql_error());
											if(!$costoHotel) die('costoHotel error: ' . mysql_error());
											if(!$IDciudadHotel) die('IDciudadHotel error: ' . mysql_error());
											if(!$idCiudad) die('idCiudad error: ' . mysql_error());
											if(!$nC) die('nC error: ' . mysql_error());
											if(!$nombreCiudad) die('nombreCiudad error: ' . mysql_error());
										}
									}
								}
							}
						}
					?>
						<tr>
							<td><?php echo $nombreHotel; 	?></td>
							<td><?php echo $nombreCiudad; 		?></td>
							<td><?php echo $fechaInicio; 	?></td>
							<td><?php echo $fechaFinal; 	?></td>
							<td><?php echo $habitacionesReservadas;	?></td>
							<td><?php echo $costoHotel; 	?></td>
							<td>CANCELAR</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>
 
	<section id="cart_items">
		<div class="container">
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu" style="text-align:center">
							<td class="image"><b>TIPO</b></td>
							<td class="description"><b>Descripción</b></td>
							<td class="price"><b>Precio</b></td>
							<td class="quantity"><b>Cantidad</b></td>
							<td class="total"><b>Total</b></td>
							<td class="total"><b>Eliminar</b></td>
						</tr>
					</thead>
					<tbody>
                  <?php
   					$consultar=mysql_query("SELECT * FROM carrito");
   					$cont=mysql_num_rows($consultar);
   					if($cont>0){
   						while($prodCarrito=mysql_fetch_array($consultar)){
   							$key=$prodCarrito['id'];
   							$id=$prodCarrito['id'];
   							$nombre=$prodCarrito['nombre'];$costo=$prodCarrito['costo'];

         $imagen=$prodCarrito['imagen'];
         $descripcion=$prodCarrito['descripcion'];
                  ?>
						<tr>
							<td class="cart_product">
								<img src="<?php echo $imagen ?>" width=80px height=80px alt="">
							</td>
							<td class="cart_description" width=50%>
								<h4><?php echo $descripcion ?></h4>
							</td>
                     
                     <form name="calcular" method="POST">
                        <td style="text-align:center">
                           <input type="text" name="costo" ReadOnly value="<?php echo $costo ?>" autocomplete="off" size="2">
                        </td>
                        <td width=11% style="text-align:center">
                           <input type="text" name="cantidad" autocomplete="off" size="2" onKeyUp="pasaValor(this.form)">
                        </td>
                        <td style="text-align:center" width=150px>
                           <input type="text" name="costoTotal" size="5%" ReadOnly>
                        </td>
                     </form>
							<td class="cart_delete" style="text-align:center">
								<form action="eliminaCarrito.php" mehtod="GET" target="_self">
                              <input name="k" type="hidden" value="<?php print($key); ?>">
                              <input type="submit" value="Eliminar">
                           </form>
							</td>
						</tr>
                  <?php
      }
   }else{
      print("<tr><h1>Usted aún no realiza ninguna compra</h1></tr>");
   }
                  ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Verifica tus datos</h3>
				<p>Comprueba que tu monto total de compra e ingresa los datos donde será realizado el envío.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_info">
							<li class="single_field">
								<label>País:</label>
								<select name="pais">
									<option value="mex">México</option>
									<option value="eua">Estados Unidos</option>
									<option value="uk">UK</option>
									<option value="can">Canadá</option>
									<option value="pak">Pakistan</option>
								</select>
							</li>
							<li class="single_field">
								<label>Ciudad</label>
								<input type="text" name="ciudad">
							</li>
							<li class="single_field">
								<label>Dirección</label>
								<input type="text" name="direccion">
							</li>
							<li class="single_field zip-field">
								<label>CP:</label>
								<input type="text" name="cp">
							</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Sub total <span>$59</span></li>
							<li>Impuestos <span>$2</span></li>
							<li>Costo de envío <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default check_out" href="">Realizar Compra</a>
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
