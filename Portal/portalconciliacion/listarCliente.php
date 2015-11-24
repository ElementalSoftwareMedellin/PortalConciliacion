<?php

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
			$sql="SELECT count(id_cliente) RecordCount 
				 FROM cliente c join empresa e on (c.id_empresa = e.id_empresa)
				 WHERE nombre_cliente like '%$buscar%' 
				 or apellido_cliente like '%$buscar%' 
				 or codigo_cliente like '%$buscar%' 
				 or modulo_cliente like '%$buscar%'  
				 or identificacion_cliente like '%$buscar%'
				 or estado_cliente like '%$buscar%'
				 or e.nombre_empresa like '%$buscar%'";
				// echo $sql;
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$recordCount = $row['RecordCount'];
			$sql= "SELECT c.id_cliente Id,
			    c.identificacion_cliente Identificacion,
			    c.nombre_cliente Nombre,
			    c.apellido_cliente Apellido,
			    c.codigo_cliente Codigo,
			    c.modulo_cliente Modulo,
			    c.estado_cliente Estado,
			    e.id_empresa Empresa
			     FROM cliente c join empresa e on (c.id_empresa = e.id_empresa)
				 WHERE nombre_cliente like '%$buscar%' 
				 or apellido_cliente like '%$buscar%' 
				 or codigo_cliente like '%$buscar%' 
				 or modulo_cliente like '%$buscar%'  
				 or identificacion_cliente like '%$buscar%'
				 or estado_cliente like '%$buscar%'
				 or e.nombre_empresa like '%$buscar%'  
				 ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";";
			$result = mysql_query($sql);
		}
		else
		{
			$result = mysql_query("SELECT count(id_cliente)  RecordCount FROM cliente");
			$row = mysql_fetch_array($result);
			$recordCount = $row['RecordCount'];
			$sql="SELECT c.id_cliente Id,
			    c.identificacion_cliente Identificacion,
			    c.nombre_cliente Nombre,
			    c.apellido_cliente Apellido,
			    c.codigo_cliente Codigo,
			    c.modulo_cliente Modulo,
			    c.estado_cliente Estado,
			    e.id_empresa Empresa
			     FROM cliente c join empresa e on (c.id_empresa = e.id_empresa) 
			    ORDER BY ".$_GET["jtSorting"]." LIMIT ".$_GET["jtStartIndex"].",".$_GET["jtPageSize"].";";
			//
			$result = mysql_query($sql);
		}
		//echo $sql;
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
		

		$Identificacion=str_replace("'", "", $_POST["Identificacion"]);
		$Nombre=str_replace("'", "",$_POST["Nombre"] );
		$Apellido=str_replace("'", "", $_POST["Apellido"]);
		$Codigo=str_replace("'", "", $_POST["Codigo"]);
		$Modulo=str_replace("'", "", $_POST["Modulo"]);
		$Estado=str_replace("'", "", $_POST["Estado"]);
		$Empresa=str_replace("'", "", $_POST["Empresa"]);

		$result = mysql_query("SELECT count(id_cliente) numero FROM cliente WHERE identificacion_cliente = '$Identificacion';");
		$row = mysql_fetch_array($result);
		$numero = $row['numero'];//Numero para saber si hay mas en la base de datos con ese NIT

		$result = mysql_query("SELECT count(id_cliente) numero2 FROM cliente c join empresa e on (c.id_empresa = e.id_empresa) WHERE e.id_empresa = '$Empresa' AND c.codigo_cliente = '$Codigo';");
		$row = mysql_fetch_array($result);
		$numero2 = $row['numero2'];//Numero para saber si hay mas en la base de datos con ese NIT

		
		if($numero >= 1)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "Ya existe un Alumno con esta Identificiacion.";
				print json_encode($jTableResult);
				die();
		}
		else if($numero2 >= 1)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "Ya existe un Alumno con esta matricula en este colegio.";
				print json_encode($jTableResult);
				die();
		}
		else if(strlen($Nombre) >= 100 || strlen($Nombre) <= 10)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "El Nombre debe contener contener entre 10 y 80 caracteres";
				print json_encode($jTableResult);
				die();
		}
		else if (!is_numeric($Identificacion) || strlen($Identificacion) >= 15 || strlen($Identificacion) <= 5)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "La Identificacion debe ser numero y Mayor a 5 caracteres y menor a 15.";
				print json_encode($jTableResult);
				die();
		}
		else if (!is_numeric($Codigo) || strlen($Codigo) >= 15 || strlen($Codigo) <= 5)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "La Matricula debeser numero y Mayor a 5 caracteres y menor a 15.";
				print json_encode($jTableResult);
				die();
		}
		else
		{
				
		}


		

		$sql="INSERT INTO cliente
		VALUES
		(NULL,
		NULL,
		'$Identificacion',
		'$Nombre',
		'$Apellido',
		'$Codigo',
		'$Modulo',
		'$Estado',
		'$Empresa');";
		$result = mysql_query($sql) or die(mysql_error());
		$sql ="SELECT c.id_cliente Id,
			    c.identificacion_cliente Identificacion,
			    c.nombre_cliente Nombre,
			    c.apellido_cliente Apellido,
			    c.codigo_cliente Codigo,
			    c.modulo_cliente Modulo,
			    c.estado_cliente Estado,
			    e.id_empresa Empresa
			     FROM cliente c join empresa e on (c.id_empresa = e.id_empresa) 
				WHERE identificacion_cliente = '$Identificacion';";
		$result = mysql_query($sql) or ("xxxxx");
		$row = mysql_fetch_array($result);
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	if($_GET["action"] == "update")
	{


		$id = str_replace("'", "",$_POST["Id"] );
		$Identificacion=str_replace("'", "", $_POST["Identificacion"]);
		$Nombre=str_replace("'", "",$_POST["Nombre"] );
		$Apellido=str_replace("'", "", $_POST["Apellido"]);
		$Codigo=str_replace("'", "", $_POST["Codigo"]);
		$Modulo=str_replace("'", "", $_POST["Modulo"]);
		$Estado=str_replace("'", "", $_POST["Estado"]);
		$Empresa=str_replace("'", "", $_POST["Empresa"]);

		$result = mysql_query("SELECT Identificacion_cliente,codigo_cliente,id_empresa FROM cliente WHERE id_cliente = '$id';");
		$row = mysql_fetch_array($result);
		$BDidentificacion = $row['Identificacion_cliente'];
		$BDcodigo = $row['codigo_cliente'];
		$BDempresa = $row['id_empresa'];

		if ($BDidentificacion != $Identificacion)
		{
			$result = mysql_query("SELECT count(id_cliente) numero FROM cliente WHERE identificacion_cliente = '$Identificacion';");
			$row = mysql_fetch_array($result);
			$numero = $row['numero'];//Numero para saber si hay mas en la base de datos con ese NIT
			if($numero >= 1)
			{
					$jTableResult['Result'] = "ERROR";
					$jTableResult['Message'] = "Ya existe un Alumno con esta Identificiacion.";
					print json_encode($jTableResult);
					die();
			}
		}
		if ($BDcodigo != $Codigo || $BDempresa != $Empresa) 
		{
			$result = mysql_query("SELECT count(id_cliente) numero2 FROM cliente c join empresa e on (c.id_empresa = e.id_empresa) WHERE e.id_empresa = '$Empresa' AND c.codigo_cliente = '$Codigo';");
			$row = mysql_fetch_array($result);
			$numero2 = $row['numero2'];//
			if($numero2 >= 1)
			{
					$jTableResult['Result'] = "ERROR";
					$jTableResult['Message'] = "Ya existe un Alumno con esta matricula en este colegio.";
					print json_encode($jTableResult);
					die();
			}
		}
		
		
		if(strlen($Nombre) >= 100 || strlen($Nombre) <= 10)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "El Nombre debe contener contener entre 10 y 80 caracteres";
				print json_encode($jTableResult);
				die();
		}
		else if (!is_numeric($Identificacion) || strlen($Identificacion) >= 15 || strlen($Identificacion) <= 5)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "La Identificacion debe ser numero y Mayor a 5 caracteres y menor a 15.";
				print json_encode($jTableResult);
				die();
		}
		else if (!is_numeric($Codigo) || strlen($Codigo) >= 15 || strlen($Codigo) <= 5)
		{
				$jTableResult['Result'] = "ERROR";
				$jTableResult['Message'] = "La Matricula debeser numero y Mayor a 5 caracteres y menor a 15.";
				print json_encode($jTableResult);
				die();
		}
		else
		{
				
		}


		$sql="UPDATE cliente
		SET
		nombre_cliente = '$Nombre',
		apellido_cliente = '$Apellido',
		codigo_cliente = '$Codigo',
		modulo_cliente = '$Modulo',
		identificacion_cliente = '$Identificacion',
		estado_cliente = '$Estado',
		id_empresa = '$Empresa'
		WHERE id_cliente = '$id'";
		$result = mysql_query($sql) or die(mysql_error());
		$sql ="SELECT c.id_cliente Id,
			    c.identificacion_cliente Identificacion,
			    c.nombre_cliente Nombre,
			    c.apellido_cliente Apellido,
			    c.codigo_cliente Codigo,
			    c.modulo_cliente Modulo,
			    c.estado_cliente Estado,
			    e.id_empresa Empresa
			     FROM cliente c join empresa e on (c.id_empresa = e.id_empresa) 
				WHERE id_cliente = '$id';";
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