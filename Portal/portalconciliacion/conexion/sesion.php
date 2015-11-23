<?php
include 'conection.php';
//print_r($_POST);
$campo1=$_POST["Campo1"];
$campo2=$_POST["Campo2"];
$tipo  =$_POST["Tipo"];
if($campo1 == "" && $campo2== "") //Usuario y Contraseña pasados por el post del formulario
{
	die("Debe llenar los campos");
}

if ($tipo== "A") 
{
	if ($campo1 != $campo2)
	{
		die("Campos de Matricula Diferentes");
	}

	$sql = "SELECT 
		 CONCAT(nombre_cliente,' ',apellido_cliente) Nombre,
		 codigo_cliente Matricula,
	     estado_cliente Estado
	     FROM cliente  
		 WHERE codigo_cliente='$campo1';";
		 //echo $sql;
	$result = mysql_query($sql) or ("xxxxx");
	$contar = mysql_num_rows($result);
	//echo "Contar:$contar";
	if ($contar == 0) {
		die("No existe ningun Alumno con este numero de matricula.");
	}
	else if ($contar > 1) {
		die("Existe un error de registro, por favor comunicarse con el administrador.");
	}

	$row = mysql_fetch_array($result);
	if ($row["Estado"] == 1) {
		die("Alumno desactivado");		
	}

	session_start();
	$_SESSION["User_Active"] = $row['Matricula'];
	$_SESSION["User_Name"] = $row['Nombre'];
	$_SESSION["User_Type"] = "alumno"; 
	echo "alumno";
}
else if ($tipo == "D")
{
	$sql = "SELECT 
		 usuario.nit_usuario Nit,
	     usuario.contrasena_usuario Contrasena,
	     usuario.nombre_usuario Nombre,
	     usuario.tipo_usuario Tipo,
	     usuario.estado_usuario Estado
	     FROM usuario  
		 WHERE nit_usuario = '$campo1' and contrasena_usuario = '$campo2';";

		$result = mysql_query($sql) or ("xxxxx");
		$contar = mysql_num_rows($result);
		//echo "Contar:$contar";
		if ($contar == 0) {
			die("Usuario y contraseña incorrecta");
		}
		else if ($contar > 1) {
			die("Existe un error de registro, por favor comunicarse con el administrador.");
		}

		$row = mysql_fetch_array($result);
		if ($row["Estado"] == 1) {
			die("Docente desactivado");		
		}

		session_start();		
		$_SESSION["User_Active"] = $row['Nit'];
		$_SESSION["User_Name"] = $row['Nombre'];
		$_SESSION["User_Type"] = $row['Tipo']; 
		
		if ($row["Tipo"] == 0) {
			echo "administrador";	
		}
		else
		{
			echo "docente";
		}
		
}

