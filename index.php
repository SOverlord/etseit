<?php

require ("funciones.php");
session_start();
//echo $_SESSION['img_number']."  ";
seguridadIndex();
$error = 0;
$registrar=0;
if(isset($_POST['registrar']))
{    
    $registrar = 1;
    $error = registrarUsuario(limpiar($_POST['newUser']), $_POST['newPassword'], $_POST['fullName'], $_POST['perfil']);
   
}
else if(isset($_POST['login']))
{
    $recordarme=0;
    if(isset($_POST['recordarme']))$recordarme=1;
    if($_SESSION['img_number'] == $_POST['num']){
    	$error = login(limpiar($_POST['user']), $_POST['pass'],$recordarme);
    }
    else{
    	$error=-4;
    }
    if($error>0)
    {
        header("Location: cart.php");
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
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
	<!--header-->
		<header id="header">
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
		<!--Menús-->
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
										<!--<li><a href="comprar.php"><i class="fa fa-home"></i> Comprar</a></li>-->
										<li><a href="index.php" class="active"><i class="fa fa-lock"></i> Iniciar Sesión </a></li>
										<!--<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Ver Carrito</a></li>-->
			                    		<!--<li><a href="consola.php"><i class="fa fa-barcode"></i> Consola</a></li>-->
									</ul>
								</div>
							</div>
						</div>
					</div>
			</div><!--/header-bottom-->
		<!--/Menús-->
		</header>
	<!--/header-->

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Ingresa a tu cuenta</h2>
						<form name="login" action="" method="post">
							<input type="text" placeholder="Usuario" name="user" />
							<input type="password" placeholder="Contraseña" name="pass"/>
							<img alt="Numeros aleatorios" src="captcha.php" /> 
							<input class="label_form" type="text" name="num"/><br>
							<span>
								<input type="checkbox" class="checkbox"> 
								Mantener sesión iniciada
							</span>
							<button name="login" type="submit" class="btn btn-default">Ingresar</button>
							<?php
					            switch ($error) {
					                case -1://login
					                    echo '<br/><strong>Usuario o clave incorrecta</strong>';
					                    break;
					                case -2://registro
					                    echo '<br/><strong>Error al registrarse. Usuario ya existente.</strong>';
					                    break;
					                case -3://registro
					                    echo '<br/><strong>El usuario y la contraseña deben tener como mínimo 4 carácteres.</strong>';
					                    break;
					                case -4:
					                	echo '<br/><strong>Captcha incorrecto. Vuelva a intentar.</strong>';
					                    break;
					                default:
					                    if($registrar) echo '<br/><strong>Se ha registrado correctamente.</strong>';
					                    break;
					          	}
							?>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">- o -</h2>
				</div>

				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>¡Crea una nueva cuenta!</h2>
						<form action="" method="POST" name="registrar" accept-charset="utf-8">
							<input type="text" placeholder="Usuario" name="newUser" <?php if($registrar && $error>0) echo 'value="'.limpiar($_POST['user']).'"'; ?> required/>
							<input type="text" placeholder="Nombre Completo" name="fullName" required/>
							<input type="password" placeholder="Contraseña" name="newPassword" required/>
							<select name="perfil">
								<option value="1">Soy una Agencia de Viajes</option>
								<option value="2">Soy Particular</option>
							</select>
							<br><br><button name="registrar" type="submit" id="registrar" class="btn btn-default">Crear cuenta</button>
							<?php
					            switch ($error) {
					                case -1://login
					                    echo '<br/><strong>Usuario o clave incorrecta</strong>';
					                    break;
					                case -2://registro
					                    echo '<br/><strong>Error al registrarse. Usuario ya existente.</strong>';
					                    break;
					                case -3://registro
					                    echo '<br/><strong>El usuario y la contraseña deben tener como mínimo 4 carácteres.</strong>';
					                    break;
					                case -4:
					                	echo '<br/><strong>Captcha incorrecto. Vuelva a intentar.</strong>';
					                    break;
					                default:
					                    if($registrar) echo '<br/><strong>Se ha registrado correctamente.</strong>';
					                    break;
					                }
					          ?>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<!--Footer-->
		<footer id="footer">
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
		</footer>
	<!--/Footer-->
	
	<!--Scripts-->
	    <script src="js/jquery.js"></script>
		<script src="js/price-range.js"></script>
	    <script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	    <script src="js/jquery.prettyPhoto.js"></script>
	    <script src="js/main.js"></script>
	<!--/Scripts-->
</body>
</html>