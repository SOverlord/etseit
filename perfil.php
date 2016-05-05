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
	<title>Compra en línea - Registrar producto</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/price-range.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estrellas.css">
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
								<li><a href="comprar.php"><i class="fa fa-home"></i> Comprar</a></li>
								<!--<li><a href="index.php"><i class="fa fa-lock"></i> Mi cuenta </a></li>-->
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Ver Carrito</a></li>
								<li><a href="perfil.php" class="active"><i class="fa fa-lock"></i> Mi Perfil </a></li>
								<!--<li><a href="consola.php"><i class="fa fa-barcode"></i> Consola</a></li>-->
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
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Categorías</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<form action="comprar.php" target="_self" method="post">
								<h4>Seleccione tipo de búsqueda</h4>
								<select name="buscar">
						   			<option value="Todos">Todos</option>
								   	<option value="Vuelos">Vuelos de Avión</option>
								   	<option value="Barcos">Barcos</option>
								   	<option value="Hoteles">Hoteles</option>
								   	<option value="Autos">Autos</option>
								</select>
								<input type="submit" value="Buscar">
						 	</form>
						</div><!--/category-products-->
					 	<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					</div>
				</div>
			   	<?php
				  	$ct=mysql_query("SELECT * FROM Servicios");     //Si es la primera entrada, muestro todo el stock
				 	if(isset($_POST['buscar'])){                          //Si existe una búsqueda...
						$valor = $_POST['buscar'];                         //buscar->$valor
						if($valor == 'Todos')	{	$ct=mysql_query("SELECT * FROM Servicios");									}
						if($valor == 'Autos')	{	$ct=mysql_query("SELECT * FROM Servicios WHERE TipoServicio='Automovil' ");	}
						if($valor == 'Vuelos')	{	$ct=mysql_query("SELECT * FROM Servicios WHERE TipoServicio='Vuelo' ");		}
						if($valor == 'Barcos')	{	$ct=mysql_query("SELECT * FROM Servicios WHERE TipoServicio='Barco' ");		}
						if($valor == 'Hoteles')	{	$ct=mysql_query("SELECT * FROM Servicios WHERE TipoServicio='Hotel' ");		}
			   		}
				?>
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">VER <?php if($valor) echo $valor; else{print("TODOS");} ?></h2>
			   				<!--Inicia la tabla de la BD para mostrar el stock-->
						<?php
			   				$cont = mysql_num_rows($ct); //Contamos la cantidad de columnas existentes en la consulta.
			   				if($cont > 0){        //Si existen más de 0 columnas...
				  				while($prod=mysql_fetch_array($ct)){  //Y mientras haya una columna por imprimir...
					 				//Recuperamos los datos y los imprimimos
					 				$idServicio=$prod['idServicio'];
									$tipoServicio=$prod['TipoServicio'];
									$nombreServicio=$prod['NombreServicio'];
									$gammaServicio=$prod['Gamma'];
									$precioServicio=$prod['Precio'];
									$disponibilidad=$prod['Disponibles'];
									switch ($tipoServicio) {
										case 'Automovil':
											$proveedor=mysql_query("SELECT * FROM AgenciaAuto WHERE fk_idServicio_AgenciaAuto='".$idServicio."' ");
											if(is_resource($proveedor) and mysql_num_rows($proveedor)>0){
												$datosProveedor=mysql_fetch_array($proveedor);
												$idProveedor=$datosProveedor['idAgenciaAuto'];
												$nombreProveedor=$datosProveedor['NombreAgenciaAuto'];
												$idCiudadProveedor=$datosProveedor['fk_idCiudad_AgenciaAuto'];
											}
											break;
										case 'Barco':
											$proveedor=mysql_query("SELECT * FROM Puerto WHERE fk_idServicio_Puerto='".$idServicio."' ");
											if(is_resource($proveedor) and mysql_num_rows($proveedor)>0){
												$datosProveedor=mysql_fetch_array($proveedor);
												$idProveedor=$datosProveedor['idPuerto'];
												$nombreProveedor=$datosProveedor['NombrePuerto'];
												$idCiudadProveedor=$datosProveedor['fk_idCiudad_Puerto'];
											}
											break;
										case 'Vuelo':
											$proveedor=mysql_query("SELECT * FROM Aeropuerto WHERE fk_idServicio_Aeropuerto='".$idServicio."' ");
											if(is_resource($proveedor) and mysql_num_rows($proveedor)>0){
												$datosProveedor=mysql_fetch_array($proveedor);
												$idProveedor=$datosProveedor['idAeropuerto'];
												$nombreProveedor=$datosProveedor['NombreAeropuerto'];
												$idCiudadProveedor=$datosProveedor['fk_idCiudad_Aeropuerto'];
											}
											break;
										case 'Hotel':
											$proveedor=mysql_query("SELECT * FROM Hotel WHERE fk_idServicio_Hotel='".$idServicio."' ");
											if(is_resource($proveedor) and mysql_num_rows($proveedor)>0){
												$datosProveedor=mysql_fetch_array($proveedor);
												$idProveedor=$datosProveedor['idHotel'];
												$nombreProveedor='';
												$idCiudadProveedor=$datosProveedor['fk_idCiudad_Hotel'];
											}
											break;
									}
									$ciudad=mysql_query("SELECT * FROM Ciudad WHERE idCiudad = '".$idCiudadProveedor."' ");
									if(is_resource($ciudad) and mysql_num_rows($ciudad)>0){
										$datosCiudad=mysql_fetch_array($ciudad);
										$nombreCiudadServicio=$datosCiudad['NombreCiudad'];
									}
						?>
				  		<div class="col-sm-4">
					 		<div class="product-image-wrapper">
								<div class="single-products">
						   			<div class="productinfo text-center">
						   				<br><br><br>
										<h2><?php echo $tipoServicio ?></h2>
										<h3><?php echo $nombreServicio ?></h3>
										<h3><?php echo $nombreProveedor ?></h3>
										<h3>Locación: <?php echo $nombreCiudadServicio ?></h3>
										<h3>Costo: $ <?php echo $precioServicio ?></h3>

										<!--Estrellas de calificación-->
										<form>
											<?php
												if($gammaServicio==1){ ?>
													<input id="radio1" name="estrellas" value="5" type="radio">	<label for="radio1">★</label>
													<input id="radio2" name="estrellas" value="4" type="radio" checked="">	<label for="radio2">★</label>
											    	<input id="radio3" name="estrellas" value="3" type="radio">	<label for="radio3">★</label>
											    	<input id="radio4" name="estrellas" value="2" type="radio">	<label for="radio4">★</label>
											    	<input id="radio5" name="estrellas" value="1" type="radio">	<label for="radio5">★</label>
												<?php
												}

												if($gammaServicio==2){ ?>
													<input id="radio1" name="estrellas" value="5" type="radio">	<label for="radio1">★</label>
													<input id="radio2" name="estrellas" value="4" type="radio">	<label for="radio2">★</label>
											    	<input id="radio3" name="estrellas" value="3" type="radio" checked="">	<label for="radio3">★</label>
											    	<input id="radio4" name="estrellas" value="2" type="radio">	<label for="radio4">★</label>
											    	<input id="radio5" name="estrellas" value="1" type="radio">	<label for="radio5">★</label>
												<?php
												}

												if($gammaServicio==3){ ?>
													<input id="radio1" name="estrellas" value="5" type="radio">	<label for="radio1">★</label>
													<input id="radio2" name="estrellas" value="4" type="radio">	<label for="radio2">★</label>
											    	<input id="radio3" name="estrellas" value="3" type="radio">	<label for="radio3">★</label>
											    	<input id="radio4" name="estrellas" value="2" type="radio" checked="">	<label for="radio4">★</label>
											    	<input id="radio5" name="estrellas" value="1" type="radio">	<label for="radio5">★</label>
												<?php
												}

												if($gammaServicio==4){ ?>
													<input id="radio1" name="estrellas" value="5" type="radio">	<label for="radio1">★</label>
													<input id="radio2" name="estrellas" value="4" type="radio">	<label for="radio2">★</label>
											    	<input id="radio3" name="estrellas" value="3" type="radio">	<label for="radio3">★</label>
											    	<input id="radio4" name="estrellas" value="2" type="radio">	<label for="radio4">★</label>
											    	<input id="radio5" name="estrellas" value="1" type="radio" checked="">	<label for="radio5">★</label>
												<?php
												}
												if($gammaServicio==5){ ?>
													<input id="radio1" name="estrellas" value="5" type="radio">	<label for="radio1">★</label>
													<input id="radio2" name="estrellas" value="4" type="radio">	<label for="radio2">★</label>
											    	<input id="radio3" name="estrellas" value="3" type="radio">	<label for="radio3">★</label>
											    	<input id="radio4" name="estrellas" value="2" type="radio">	<label for="radio4">★</label>
											    	<input id="radio5" name="estrellas" value="1" type="radio">	<label for="radio5">★</label>
												<?php
												}
											?>
										</form>
										<!-- /Estrellas de calificación-->
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h3><?php echo $nombreServicio ?></h3>
									 		<h2><?php print("$ "); echo $precioServicio ?></h2>
									 		<form action="addToCart.php" method="post" name="comprar">
									 			<input name="tipoServicio" type="hidden" value="<?php echo $tipoServicio ?>" />
												<input name="idProveedor" type="hidden" value="<?php echo $idProveedor ?>" />
												<input name="precioServicio" type="hidden" value="<?php echo $precioServicio ?>" />
												Inicio de Reserva: <input name="fechaInicio" type="date" required="" /><br>
												Fin de la Reserva:<input name="fechaFinal" type="date" required="" />
												<?php if($tipoServicio!='Automovil'){
													print("<br>Boletos: <input name='NumBoletos' type='number' min='1' max='5' required='' />  <br><br>");
													} ?>
												<a class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>
													<input name="Comprar" type="submit" value="Adquirir"/>
												</a>
									 		</form>
								  		</div>
							   		</div>
								</div>
					 		</div>
				  		</div>
			   			<?php
				  			}
			 			}else{//Si no existen columnas en la consulta... Arrojamos un error.
					  		print("	<div style='text-align:center'>
					  				<img src='images/404/404.png' width=40% height=40% />
									<h1>Ooops!</h1>
									<p>Actualmente no contamos con estos productos.</p>
									</div>"
							);
			   			}
			   			?>
				   		<!--Termina la tabla de la BD para mostrar el stock-->
				   	</div>
				</div>
			</div>
		</div>
	</section>
	
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
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
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
	<script src="js/price-range.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
