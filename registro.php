<?php include ('conexion.php')?>
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
   <script type="text/javascript">

window.onload = function () {

document.formularioContacto.nombre.focus();

document.formularioContacto.addEventListener('submit', validarFormulario);

}

 

function validarFormulario(evObject) {

evObject.preventDefault();

var todoCorrecto = true;

var formulario = document.formularioContacto;

for (var i=0; i<formulario.length; i++) {

                if((formulario[i].type =='text') || (formulario[i].type == 'number') || (formulario[i].type == 'option') || (formulario[i].type == 'file')) {

                               if (formulario[i].value == "0" || formulario[i].value == null || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){

                               alert (formulario[i].name+ ' no puede estar vacío o contener sólo espacios en blanco');

                               todoCorrecto=false;

                               }

                }

                }

if (todoCorrecto ==true) {formulario.submit();}

}

 

</script></head><!--/head-->

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
								<li><a href="login.php"><i class="fa fa-lock"></i> Ingresar a cuenta</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Ver Carrito</a></li>
                        <li><a href="consola.php"><i class="fa fa-barcode"></i> Consola</a></li>
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
				<form name="formularioContacto" action="inserta.php" target="_self" method="post">
               <table>
                  <tr>
                     <td>Nombre</td>
                     <td><input type="text" name="nombre" ></td>
                  </tr>
                  <tr>
                     <td>Descripción</td>
                     <td><input type="text" name="descripcion" ></td>
                  </tr>
                  <tr>
                     <td>Costo</td>
                     <td><input type="number" name="costo" ></td>
                  </tr>
                  <tr>
                     <td>Marca</td>
                     <td><input type="text" name="marca" ></td>
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
                     <td><input type="number" name="stock" ></td>
                  </tr>
               </table>
               <input type="submit" value="Agregar">
            </form>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
