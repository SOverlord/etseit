<?php
    if(!($driver=mysql_connect("localhost","root","qwerty"))){
        print("No hubo conexion con el servidor");
		exit();
    }
    mysql_set_charset('utf8', $driver);
	if( !  (mysql_select_db("etseitSystem",$driver))){
		print("No se encontro la base de datos");
		exit();
	}
?>