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
		$sql="SELECT count(id_factura) RecordCount
		FROM documentoweb dw join alumno a on (dw.matricula_documentoWeb = a.matricula_alumno)
		join conciliacion c on (dw.numeroFactura_documentoWeb = c.numeroFactura_conciliacion)
		WHERE numeroFactura_documentoWeb like '%$buscar%' or
		CONCAT(a.nombre1_alumno,' ',a.nombre2_alumno,' ',a.apellido1_alumno) like %$buscar% or
		fecha_documentoWeb like '%$buscar%' or
		concepto_documentoWeb  like '%$buscar%' or
		valor_documentoWeb  like '%$buscar%'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		$sql="SELECT c.estado_conciliacion Estado,id_documentoWeb Id,
	    numeroFactura_documentoWeb Numero,
	    CONCAT(a.nombre1_alumno,' ',a.nombre2_alumno,' ',a.apellido1_alumno) Nombre,
	    fecha_documentoWeb Fecha,
	    concepto_documentoWeb Concepto,
	    valor_documentoWeb Valor
		FROM documentoweb dw join alumno a on (dw.matricula_documentoWeb = a.matricula_alumno)
		join conciliacion c on (dw.numeroFactura_documentoWeb = c.numeroFactura_conciliacion)
		WHERE numeroFactura_documentoWeb like '%$buscar%' or
		Nombre like %$buscar% or
		fecha_documentoWeb like '%$buscar%' or
		concepto_documentoWeb  like '%$buscar%' or
		valor_documentoWeb  like '%$buscar%'";
		$result = mysql_query($sql);
		}
		else
		{
		$sql="SELECT count(id_documentoWeb) RecordCount
			 FROM documentoweb dw join alumno a on 
			 (dw.matricula_documentoWeb = a.matricula_alumno)
			 join conciliacion c on (dw.numeroFactura_documentoWeb = c.numeroFactura_conciliacion)";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
			$sql="SELECT c.estado_conciliacion Estado,id_documentoWeb Id,
		    numeroFactura_documentoWeb Numero,
		    CONCAT(a.nombre1_alumno,' ',a.nombre2_alumno,' ',a.apellido1_alumno) Nombre,
		    fecha_documentoWeb Fecha,
		    concepto_documentoWeb Concepto,
		    valor_documentoWeb Valor
			FROM documentoweb dw join alumno a on (dw.matricula_documentoWeb = a.matricula_alumno)
			join conciliacion c on (dw.numeroFactura_documentoWeb = c.numeroFactura_conciliacion)";
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