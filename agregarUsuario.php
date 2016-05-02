<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf8">
</head>
<body>
<?php
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
       print("<a href='index.php'><button>Comenzar a comprar</button></a>");
    }else{
      print("<strong>El registro NO se inserto correctamente</strong>");
    }
   }
?>