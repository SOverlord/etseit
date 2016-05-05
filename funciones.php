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
        
        header("Location: cart.php");
        exit();
    }
    else if( isset($_COOKIE['identificado']))
    {     
        $cookie = limpiar($_COOKIE['identificado']);
        $idusuario = comprobarCookie($cookie);
        if(!$idusuario)
        {
            header("Location: cart.php");
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
    $conexion=mysql_connect("localhost","root","qwerty",false);
    $bd = mysql_select_db("login",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "select idUsuario from Usuario where Cookie='".mysql_escape_string($cookie)."' and Validez>'".date("Y-m-d h:i:s")."'";
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
function registrarUsuario($user,$pass, $name, $perfil)
{
    $user = mysql_escape_string($user);
    $pass = mysql_escape_string($pass);
    $name = mysql_escape_string($name);
    if(strlen($user)<4 || strlen($pass)<4) return -3;
    
    global $salt;
    $pass = sha1($salt.md5($pass));
    
    $conexion=mysql_connect("localhost","root","qwerty",false);
    $bd = mysql_select_db("etseitSystem",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    
    $sql1 = "select idUsuario from Usuario where UPPER(Alias)='".strtoupper($user)."'";
    $result1 = mysql_query($sql1,$conexion);
    if(mysql_affected_rows()>0) return -2; //user repetido
    
    $sql = "insert into Usuario (Alias, NombreCompleto, Password, Status, NumViajes, fk_idPerfil_Usuario) values ('".$user."','".$name."','".$pass."', 1, 0, '".$perfil."')";
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
    
    $conexion=mysql_connect("localhost","root","qwerty",false);
    $bd = mysql_select_db("etseitSystem",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "select idUsuario from Usuario where UPPER(Alias)='".strtoupper($user)."' and Password='".$pass."'";
    $result = mysql_query($sql,$conexion);
    if(mysql_affected_rows()<=0 || !$result) return -1; //user repetido
    
    $row = mysql_fetch_array($result);
    $idUsr = $row['idUsuario'];
    $_SESSION['usuario']=$idUsr;
    
    if($recordarme){
        global $saltCookie;

        $cookie = sha1($saltCookie.md5($idUsr.date("Y-d-m h:i:s")));

        $sql2 = "update Usuario set Cookie='".$cookie."',Validez=DATE_ADD(now(),INTERVAL 6 MINUTE) where idUsuario='".$idUsr."'";
        $result2 = mysql_query($sql2,$conexion);

        setCookie("identificado",$cookie,time()+360,'/'); //cookie 6min
    }
    $_SESSION['usuario']=$idUsr;
    echo $idUsr;
    return true;
}

function destruirCookie($cookie)
{
    if(!isset($_SESSION['usuario'])) return;
    else $idusuario = $_SESSION['usuario'];
    
    $conexion=mysql_connect("localhost","root","qwerty",false);
    $bd = mysql_select_db("etseitSystem",$conexion);
    mysql_query("SET NAMES 'utf8'");
    
    $sql = "update Usuario set Validez=DATE_SUB(now(),INTERVAL 6 MINUTE) where `idUsuario`='".$idusuario."'";
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