<?php
session_start();

$salt = "|#€7`¬23ads4ook12";
$saltCookie = "|@#57e+ç´|@#d";



/**
 * Comprueba que exista una sesion o una cookie en la página de login
 *
 * 
 */
function seguridadIndex()
{
    
    if (isset($_SESSION['usuario']))
    {
        
        header("Location: correcto.php");
        exit();
    }
    else if( isset($_COOKIE['identificado']))
    {     
        $cookie = limpiar($_COOKIE['identificado']);
        $idusuario = comprobarCookie($cookie);
        if(!$idusuario)
        {
            header("Location: correcto.php");
            exit();
        }
    }
}


/**
 * Comprueba que exista una sesion o una cookie, sino redirige al login
 *
 * @return int estado
 */
function seguridad(){

    if (isset($_SESSION['usuario']))
    {
        return;
    }
    else if( isset($_COOKIE['identificado']))
    {     
        $cookie = limpiar($_COOKIE['identificado']);
        $idusuario = comprobarCookie($cookie);
        if(!$idusuario)
        {
            echo "<script language='javascript'> document.location.href='index.php' </script>";
            exit();
        }
    }
    else
    {
        echo "<script language='javascript'> document.location.href='index.php' </script>";
        exit();
    }
       
}

/**
 * Comprueba que la cookie sea validad en nuestra BD
 *
 * @param string $cookie
 * @return int idUsuario
 */
function comprobarCookie($cookie)
{
    $conexion=mysql_connect("localhost","root","",false);
    $bd = mysql_select_db("login",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "select idUsuario from usuario where cookie='".mysql_escape_string($cookie)."' and validez>'".date("Y-m-d h:i:s")."'";
    $result = mysql_query($sql,$conexion);
    
    if(!$result || mysql_affected_rows()<1) return false;
    else
    {
        $row = mysql_fetch_array($result);
        $_SESSION['usuario']=$row['idUsuario'];
        return $row['idUsuario'];
    }
}


/**
 * Registra un usuario con seguridad
 *
 * @global string $salt
 * @param string $user
 * @param string $pass
 * @return int 
 */

/*
  header('Content-Type: text/html; charset=UTF-8');
   $usr= utf8_decode($_POST["usuario"]);
   $fn=utf8_decode($_POST["fullName"]);
   $pswd=utf8_decode($_POST["password"]);
   $profile=$_POST["perfil"];

   $checkUsers = "SELECT Usuario FROM  Usuarios WHERE UPPER(Usuario)='".strtoupper(utf8_encode($usr))."'";
   $resultCheckingUsers = mysql_query($checkUsers, $driver);
   if(mysql_affected_rows()>0){
    print("<strong>Usuario duplicado</strong>");
   }
   else{
    $sql="INSERT INTO Usuarios (Usuario,NombreCompleto,Contrasena,Status, Perfil) VALUES ('".utf8_encode($usr)."','".utf8_encode($fn)."','".utf8_encode($pswd)."',1,'".$profile."')";
    $res=mysql_query($sql,$driver);
    if($res){
       print("<strong>El registro se inserto correctamente</strong>");
       print("<a href='login.php'><button>Regresar</button></a>");
    }else{
      print("<strong>El registro NO se inserto correctamente</strong>");
    }
   }
*/
function registrarUsuario($user,$pass)
{
    $user = mysql_escape_string($user);
    $pass = mysql_escape_string($pass);
    if(strlen($user)<4 || strlen($pass)<4) return -3;
    
    global $salt;
    $pass = sha1($salt.md5($pass));
    
    $conexion=mysql_connect("localhost","root","",false);
    $bd = mysql_select_db("login",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    
    $sql1 = "select idUsuario from usuario where UPPER(login)='".strtoupper($user)."'";
    $result1 = mysql_query($sql1,$conexion);
    if(mysql_affected_rows()>0) return -2; //user repetido
    
    $sql = "insert into usuario (login,pass) values ('".$user."','".$pass."')";
    $result = mysql_query($sql,$conexion);
    
    if($result) return 1; //registro correcto
    else return -2; //error
}

/**
 * Comprueba y el user y pass son correcto. En caso de querer ser recordado en el pc, crea la cookie
 *
 * @global string $salt
 * @global string $saltCookie
 * @param string $user
 * @param string $pass
 * @param bool $recordarme
 * @return int estado 
 */
function login ($user,$pass,$recordarme)
{
    $user = mysql_escape_string($user);
    $pass = mysql_escape_string($pass);
    
    if(strlen($user)<4 || strlen($pass)<4) return -3;
    
    global $salt;
    $pass = sha1($salt.md5($pass));
    
    $conexion=mysql_connect("localhost","root","",false);
    $bd = mysql_select_db("login",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "select idUsuario from usuario where UPPER(login)='".strtoupper($user)."' and pass='".$pass."'";
    $result = mysql_query($sql,$conexion);
    if(mysql_affected_rows()<=0 || !$result) return -1; //user repetido
    
    $row = mysql_fetch_array($result);
    $idUsuario = $row['idUsuario'];
    $_SESSION['usuario']=$idUsuario;
    
    if($recordarme){
        global $saltCookie;

        $cookie = sha1($saltCookie.md5($idUsuario.date("Y-d-m h:i:s")));

        $sql2 = "update usuario set cookie='".$cookie."',validez=DATE_ADD(now(),INTERVAL 6 MINUTE) where `idUsuario`='".$idUsuario."'";
        $result2 = mysql_query($sql2,$conexion);

        setCookie("identificado",$cookie,time()+360,'/'); //cookie 6min
    }
    $_SESSION['usuario']=$idUsuario;
    
    return true;
}

function destruirCookie($cookie)
{
    if(!isset($_SESSION['usuario'])) return;
    else $idusuario = $_SESSION['usuario'];
    
    $conexion=mysql_connect("localhost","root","",false);
    $bd = mysql_select_db("login",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "update usuario set validez=DATE_SUB(now(),INTERVAL 6 MINUTE) where `idUsuario`='".$idusuario."'";
    $result = mysql_query($sql2,$conexion);
    if(mysql_affected_rows()>0) return true; //cookie puesta invalida
    else return false;
    
    
}

/**
 *
 * @param string $valor
 * @return string string limpiado de fallos de seguridad
 */
function limpiar($valor){
    $valor = strip_tags($valor);
    $valor = stripslashes($valor);
    $valor = htmlentities($valor);
    return $valor;
}

?>