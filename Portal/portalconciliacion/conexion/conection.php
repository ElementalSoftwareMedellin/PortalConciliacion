<?php
$bdservidor = "localhost";
$bdunombre = "root";
$bdpass = "";//
$bdnombre = "portalconciliacion";
$connection=mysql_connect("$bdservidor","$bdunombre","$bdpass")
or die("Error conectando a la base de datos");
$db=mysql_select_db("$bdnombre",$connection)
or die ("Error seleccionando la base de datos");        
?>
