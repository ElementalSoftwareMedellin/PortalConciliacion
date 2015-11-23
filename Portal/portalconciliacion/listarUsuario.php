<?php
session_start();
try
{
include 'conexion/conection.php';
	if($_GET["action"] == "list")
	{
		if(!empty($_GET["buscar"]))
		{
			$buscar = $_GET["buscar"];
		}
		else
		{
			$buscar = '';
		}

		if($buscar != '')
		{
			$result = mysql_query(
				"SELECT count(id_usuario) RecordCount 
				 FROM usuario 
				 WHERE nit_usuario like '%$buscar%'
				 or nombre_usuario like '%$buscar%' 
				 or correo_usuario like '%$buscar%' 
				 or tipo_usuario like '%$buscar%' 
				 or estado_usuario like '%$buscar%'");
			$row = mysql_fetch_array($result);
			$recordCount = $row['RecordCount'];
			$result = mysql_query(
				"SELECT usuario.id_usuario Id,
				 usuario.nit_usuario Nit,
			     usuario.nombre_usuario Nombre,
			     usuario.contrasena_usuario Contrasena,
			     usuario.correo_usuario Correo,
			     usuario.tipo_usuario Tipo,
			     usuario.estado_usuario Estado
			     FROM usuario  
				 WHERE nit_usuario like '%buscar%'
				 or nombre_usuario like '%$buscar%' 
				 or correo_usuario like '%$buscar%' 
				 or tipo_usuario like '%$buscar%'  
				 or estado_usuario like '%$buscar%' 
				 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		}
		else
		{
			$result = mysql_query(
				"SELECT count(id_usuario)  RecordCount FROM usuario");
			$row = mysql_fetch_array($result);
			$recordCount = $row['RecordCount'];
			$sql="SELECT usuario.id_usuario Id,
				 usuario.nit_usuario Nit,
			     usuario.nombre_usuario Nombre,
			     usuario.contrasena_usuario Contrasena,
			     usuario.correo_usuario Correo,
			     usuario.tipo_usuario Tipo,
			     usuario.estado_usuario Estado
			     FROM usuario 
			    ORDER BY ".$_GET["jtSorting"]." LIMIT ".$_GET["jtStartIndex"].",".$_GET["jtPageSize"].";";
			//echo $sql;
			$result = mysql_query($sql);
		}
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}

	if($_GET["action"] == "create")
	{
		$nit=str_replace("'", "",$_POST["Nit"] );
		$nombre=str_replace("'", "",$_POST["Nombre"] );
		$contrasena=str_replace("'", "", $_POST["Contrasena"]);
		$correo=str_replace("'", "", $_POST["Correo"]);
		$tipo=str_replace("'", "", $_POST["Tipo"]);
		$estado=str_replace("'", "", $_POST["Estado"]);


		$result = mysql_query("SELECT count(id_usuario) numero FROM usuario WHERE nit_usuario = '" . $_POST["Nit"] . "';");
		$row = mysql_fetch_array($result);
		$numero = $row['numero'];//Numero para saber si hay mas en la base de datos con ese NIT

		if($numero >= 1)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "Ya existe un usuario con este Nit.";
				print json_encode($jTableResult);
				die();
		}
		else if(strlen($nombre) >= 100 || strlen($nombre) <= 10)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "El Nombre debe contener contener entre 10 y 80 caracteres";
				print json_encode($jTableResult);
				die();
		}
		else if (!is_numeric($nit) || strlen($nit) >= 15 || strlen($nit) <= 5)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "El Nit debe ser numero y Mayor a 5 caracteres y menor a 15.";
				print json_encode($jTableResult);
				die();
		}
		else if(strlen($contrasena) >= 100 || strlen($contrasena) <= 4)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "La contraseña debe contener contener entre 5 y 80 caracteres";
				print json_encode($jTableResult);
				die();
		}
		else
		{
				
		}


		if($correo != '')
		{
			if (!filter_var($correo, FILTER_VALIDATE_EMAIL))
			{
					$jTableResult['Result'] = "ERROR";
					$jTableResult['Message'] = "El Correo no es Valido";
					print json_encode($jTableResult);
					die();
			}
			
		}
		

		$sql="INSERT INTO usuario
		VALUES
		(NULL,
		'$nit',
		'$nombre',
		'$contrasena',
		'$correo',
		'$tipo',
		'$estado');";
		$result = mysql_query($sql) or die(mysql_error());
		$sql ="SELECT usuario.id_usuario Id,
			     usuario.nombre_usuario Nombre,
				 usuario.nit_usuario Nit,
			     usuario.contrasena_usuario Contrasena,
			     usuario.correo_usuario Correo,
			     usuario.tipo_usuario Tipo,
			     usuario.estado_usuario Estado
			     FROM usuario  
				WHERE nombre_usuario = '$nombre';";
		$result = mysql_query($sql) or ("xxxxx");
		$row = mysql_fetch_array($result);
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	if($_GET["action"] == "update")
	{
		//print_r($_POST);
		$id = str_replace("'", "",$_POST["Id"] );
		//$nit=str_replace("'", "",$_POST["Nit"] );
		$nombre=str_replace("'", "",$_POST["Nombre"] );
		$contrasena=str_replace("'", "", $_POST["Contrasena"]);
		$correo=str_replace("'", "", $_POST["Correo"]);
		/*$tipo=str_replace("'", "", $_POST["Tipo"]);
		$estado=str_replace("'", "", $_POST["Estado"]);*/

		if(strlen($nombre) >= 100 || strlen($nombre) <= 10)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "El Nombre debe contener contener entre 10 y 80 caracteres";
				print json_encode($jTableResult);
				die();
		}
		else if(strlen($contrasena) >= 100 || strlen($contrasena) <= 4)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "La contraseña debe contener contener entre 5 y 80 caracteres";
				print json_encode($jTableResult);
				die();
		}
		else
		{
				
		}


		if($correo != '')
		{
			if (!filter_var($correo, FILTER_VALIDATE_EMAIL))
			{
					$jTableResult['Result'] = "ERROR";
					$jTableResult['Message'] = "El Correo no es Valido";
					print json_encode($jTableResult);
					die();
			}
			
		}


		$sql="UPDATE usuario
		SET
		nombre_usuario = '$nombre',
		contrasena_usuario = '$contrasena',
		correo_usuario = '$correo'		
		WHERE id_usuario = '$id'";
		/*tipo_usuario = '$tipo',
		estado_usuario = '$estado'*/
		//echo $sql;
		$result = mysql_query($sql) or die(mysql_error());
		$sql ="SELECT usuario.id_usuario Id,
	     usuario.nombre_usuario Nombre,
		 usuario.nit_usuario Nit,
	     usuario.contrasena_usuario Contrasena,
	     usuario.correo_usuario Correo,
	     usuario.tipo_usuario Tipo,
	     usuario.estado_usuario Estado
	     FROM usuario  
		WHERE id_usuario = '$id';";
		$result = mysql_query($sql) or ("xxxxx");
		$row = mysql_fetch_array($result);
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);

	}

	//Close database connection
	//mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>