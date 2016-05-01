<?php include ('conexion.php')
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
								<li><a href="index.php" class="active"><i class="fa fa-home"></i> Inicio</a></li>
								<li><a href="login.php"><i class="fa fa-lock"></i> Mi cuenta </a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Ver Carrito</a></li>
                        		<!--<li><a href="consola.php"><i class="fa fa-barcode"></i> Consola</a></li>-->
							</ul>
						</div>
					</div>
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
                     <form action="index.php" target="_self" method="post">
                        <h4>Seleccione tipo de búsqueda</h4>
                        <select name="buscar">
                           <option value="0">Todos</option>
                           <option value="Celular">Celulares</option>
                           <option value="Computadora">Computadoras</option>
                           <option value="Periferico">Perifericos</option>
                        </select>
                        <input type="submit" value="Buscar">
                     </form>
						   </div><!--/category-products-->
                     <div class="shipping text-center"><!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
						   </div><!--/shipping-->
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Productos</h2>
               <!--Inicia la tabla de la BD para mostrar el stock-->
               <?php
                  $consultar=mysql_query("SELECT * FROM productos");     //Si es la primera entrada, muestro todo el stock
                  if(isset($_POST['buscar'])){                          //Si existe una búsqueda...
                     $valor = $_POST['buscar'];                         //buscar->$valor
                     if($valor == '0'){                                 //Si se eligieron "Todos" los productos...
                        $consultar=mysql_query("SELECT * FROM productos");  //Muestra todos los productos
                     }else{                                             //Si no...
                        $consultar=mysql_query("SELECT * FROM productos WHERE tipo LIKE '%".$valor."%'"); //Muestra la categoría seleccionada
                     }
               }
               $cont = mysql_num_rows($consultar); //Contamos la cantidad de columnas existentes en la consulta.
//               print($cont);        //Prueba de impresión de la cantidad de columnas.
               if($cont > 0){        //Si existen más de 0 columnas...
                  while($prod=mysql_fetch_array($consultar)){  //Y mientras haya una columna por imprimir...
                     //Recuperamos los datos y los imprimimos
                     $id=$prod['id'];
                     $imagen=$prod['imagen'];
                     $nombre=$prod['nombre'];
                     $descripcion=$prod['descripcion'];
                     $costo=$prod['costo'];
               ?>
                  <div class="col-sm-4">
                     <div class="product-image-wrapper">
                        <div class="single-products">
                           <div class="productinfo text-center">
                              <img src="<?php echo $imagen ?>" />
                              <h2><?php print("$ "); echo $costo ?></h2>
                              <p><?php echo $nombre ?></p>
                              <p>Ver características</p>
                           </div>
                           <div class="product-overlay">
                              <div class="overlay-content">
                                 <h2><?php print("$ "); echo $costo ?></h2>
                                 <p><?php echo $descripcion ?></p>
                                 <form action="cart.php" method="post" name="comprar">
                                    <input name="id_" type="hidden" value="<?php echo $id ?>" />
                                    <input name="nombre" type="hidden" value="<?php echo $nombre ?>" />
                                    <input name="costo" type="hidden" value="<?php echo $costo ?>" />
                                    <input name="imagen" type="hidden" value="<?php echo $imagen ?>" />
                                    <input name="descripcion" type="hidden" value="<?php echo $descripcion ?>" />
                                    <a class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> <input name="Comprar" type="submit" value="Comprar"/></a>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
                  }
               }
               else{//Si no existen columnas en la consulta... Arrojamos un error.
                  print("<div style='text-align:center'>
                  <img src='images/404/404.png' width=40% height=40% />
                  <h1>Ooops!</h1>
                  <p>Actualmente no contamos con estos productos.</p>
                  </div>");
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
