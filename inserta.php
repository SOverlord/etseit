<?php include ('conexion.php')?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
</head>  
<body>
<?php
   $nombre=$_POST["nombre"];
   $descripcion=$_POST["descripcion"];
   $costo=$_POST["costo"];
   $marca=$_POST["marca"];
   $tipo=$_POST["tipo"];
   $stock=$_POST["stock"];
   if($tipo == 'Celular'){
      $imagen="images/productos/celular.jpg";
   }
   if($tipo == 'Computadora'){
      $imagen="images/productos/computadora.jpg";
   }
   if($tipo == 'Periferico'){
      $imagen="images/productos/perifericos.jpg";
   }

$sql="INSERT INTO productos (nombre,costo,cantidadStock,tipo,marca,descripcion,imagen) VALUE('".$nombre."','".$costo."','".$stock."','".$tipo."','".$marca."','".$descripcion."', '".$imagen."' )  ";

    $res=mysql_query($sql,$driver);
    if($res){
       print("<strong>El registro se inserto correctamente</strong>");
       print("<a href='registro.php'><button>Regresar</button></a>");
    }else{
       print("<strong>El registro NO se inserto correctamente</strong>");
    }
?>