<?php
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
<html>
  <head>
     <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <title>GrabThisCode Demo Login</title>
    <link media="all" href="http://www.grabthiscode.com/wp-content/themes/grabthiscode/css/style.css" type="text/css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700&v2">
    <link type="image/x-icon" href="http://www.grabthiscode.com/wp-content/uploads/2011/08/favicon.png" rel="shortcut icon">
    <script type="text/javascript" src="js/jquery-1.6.2.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
  </head>

  <body class="home blog layout-right">
     
      <br /><br />
        
      <a href="http://www.grabthiscode.com/"><img alt="Grab This Code" src="http://www.grabthiscode.com/wp-content/themes/grabthiscode/images/logos/logo-1.jpg" /></a>
       
          
      <br /><br /><br /><br /><br />
      <h1 class="entry-title">Has sido logueado correctamente.</h1>
      <br />
      <form name="login" method="post" action="">
          <div align="center"> 
          <table>
              
              <tr>
                  <td align="right"><input type="submit" name="salir" id="salir" value="Salir" /></td></tr>
          </table>
          
          <?php
            if ($error) {
                echo '<br/><strong>Usuario o clave incorrecta</strong>';
}
?></div>
</form>
      
      <br /><br />
      <div id="p1"></div>
      
      
     
      <br /><br />
      <div id="atras"> <a href="http://www.grabthiscode.com/programacion/como-hacer-un-registro-y-login-php-con-sesiones-y-cookies"><strong>Volver al post</strong></a></div>
      </body>
</html>