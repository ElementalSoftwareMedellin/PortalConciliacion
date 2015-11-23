<?php
include 'conexion/conection.php';

try
{
	//Open database connection



	//Getting records (listAction)
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
		
		$sql=
		"SELECT count(d.id_documento) RecordCount 
		FROM documento_institucional d JOIN tipo_institucional td 
		ON ( td.id_tipo_institucional = d.id_tipo ) 
		where d.nombre_documento like '%$buscar%' 
		or d.fecha_documento like '%$buscar%' 
		or  td.descripcion_tipo_institucional like '%$buscar%'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		$sql=
		"SELECT id_documento Id,
		d.nombre_documento Nombre, 
		d.fecha_documento Fecha, 
		td.descripcion_tipo_institucional Tipo 
		FROM documento_institucional d JOIN tipo_institucional td 
		ON ( td.id_tipo_institucional = d.id_tipo ) 
		where d.nombre_documento like '%$buscar%' 
		or d.fecha_documento like '%$buscar%' 
		or  td.descripcion_tipo_institucional like '%$buscar%' 
		ORDER BY ".$_GET["jtSorting"]." LIMIT ".$_GET["jtStartIndex"].",".$_GET["jtPageSize"].";";
		$result = mysql_query($sql);
		}
		else
		{
		$sql="SELECT count(d.id_documento) RecordCount 
		FROM documento_institucional d JOIN tipo_institucional td 
		ON ( td.id_tipo_institucional = d.id_tipo )";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		$sql=
		"SELECT id_documento Id,
		d.nombre_documento Nombre,
		d.fecha_documento Fecha, 
		td.descripcion_tipo_institucional Tipo 
		FROM documento_institucional d JOIN tipo_institucional td 
		ON ( td.id_tipo_institucional = d.id_tipo )
		ORDER BY ".$_GET["jtSorting"]." LIMIT ".$_GET["jtStartIndex"].",".$_GET["jtPageSize"].";";
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