<?php
Include "cuerpo.php";
include 'conexion/conection.php';
/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
set_time_limit(0);
/** Clases necesarias */
require_once('EXCEL/Classes/PHPExcel.php');//libreria PHP excel GENERAR
require_once('EXCEL/Classes/PHPExcel/Reader/Excel2007.php');//libreria PHP excel LEER

$lista = $_POST['listatipo'];

$uploaddir = "uploads/"; //ruta de almacenamiento temporal
$uploadfilename = strtolower(str_replace(" ", "_",basename($_FILES['archivo']['name']))); //nombre archivo excel
$uploadfile = $uploaddir.$uploadfilename; // ruta y nombre archivo excel
$nombre = $uploadfilename;
$error = $_FILES['archivo']['error']; 
$subido = false;


if(isset($_POST['listatipo']) && $error==UPLOAD_ERR_OK) 
{ 

	if(substr($nombre,strlen($nombre)-5,5)!= ".xlsx" || $_FILES['archivo']['size'] > 1000000) //Si el archivo es diferente de ".xlsx" o el archivo pesa mas que 1M mostrará el error
	{ 
		$error = "Comprueba que el archivo sea un archivo XSLX y de tamano inferior a 1M."; 
		die("Se ha producido un error: ".$error);
	} 
	elseif(preg_match("/[^0-9a-zA-Z_.-]/",$uploadfilename)) //si tiene caracteres no validos mostrará error
	{ 
		$error = "El nombre del archivo contiene caracteres no válidos."; 
		die("Se ha producido un error: ".$error);
	} 

} 

$subido = copy($_FILES['archivo']['tmp_name'], $uploadfile); //copia el archivo a la ruta establecida

$objReader = new PHPExcel_Reader_Excel2007();

$objPHPExcel = $objReader->load("uploads/".$nombre);

$objPHPExcel->setActiveSheetIndex(0);

$t =1;//aumenta cada fila de excel
$f =0;//para finalizar el documento
$fin = 0;
$fechaPago="";
$matricula="";
$numeroFactura="";
$valor="";
$concepto="";
$apellido="";
$activo=1;
do
{
	$t = $t + 1;
	$matricula=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('A'.($t))->getCalculatedValue());
	$numero=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('B'.($t))->getCalculatedValue());
	$identificacion=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('C'.($t))->getCalculatedValue());
	$nombre=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('D'.($t))->getCalculatedValue());
	$apellido=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('E'.($t))->getCalculatedValue());
	$grupo=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('F'.($t))->getCalculatedValue());
	$fecha_factura=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('G'.($t))->getCalculatedValue());
	$fecha_pago_oportuno_factura=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('H'.($t))->getCalculatedValue());
	$fecha_pago_extemporaneo_factura=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('I'.($t))->getCalculatedValue());


	//detalles

              $vmatricula=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('J'.($t))->getCalculatedValue());
 			  $pension=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('K'.($t))->getCalculatedValue());
              $Alimentacion=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('L'.($t))->getCalculatedValue());
              $Transporte=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('M'.($t))->getCalculatedValue());
              $Otros=str_replace("'", "",$objPHPExcel->getActiveSheet()->getCell('N'.($t))->getCalculatedValue());






	//detalles
	
	if($nmatricula  == '' || $nombre  == '' || $grupo  == '' )
	{
		$f = 1;
		echo "Filas Recorridas $t" ;
	}
	else
	{	
		//CLIENTE
			$sql ="SELECT count(idcliente) matricula
				    FROM cliente 
					WHERE codigo_cliente = '$matricula';";//cuenta el numero de clientes que tienen el numero de matricula que está en el excel
			$result = mysql_query($sql) or die("$sql Error, query contador matricula");

			$row = mysql_fetch_array($result);
			if ($row['matricula'] > 0)//si existe el cliente
			{
				if($nombre != "" && $identificacion != "" && $grupo != "" )//si es diferente a vacio modifica
				{
					$sql="UPDATE cliente
					SET
					identificacion_cliente = '$identificacion'
					nombre_cliente = '$nombre',
					apellido_cliente = '$apellido',
					modulo_cliente = '$grupo',
                    estado_cliente = '1',
					
					WHERE codigo_cliente = '$matricula'";
				}
			}
			else //si no existía, inserta
			{
				$sql="INSERT INTO cliente VALUES('$identificacion','$nombre','$apellido','$matricula','$grupo','1','1');";
			}

		$result = mysql_query($sql) or die("$sql Error, query failed cliente nuevo o actualizado");//ejecuta el SQL de cliente
		

		$sql ="SELECT idcliente id
			    FROM cliente 
				WHERE codigo_cliente = '$matricula';";		
		$result = mysql_query($sql) or die("$sql Error, query failed cliente a factura");
		$row = mysql_fetch_array($result);
		$id_cliente = $row['id'];
		//-CLIENTE

		//FACTURA
		$sql="INSERT INTO factura
		VALUES ('$matricula','1','$id_cliente',1,'4','10/11/2015','$fecha_factura','$fecha_pago_oportuno_factura','$fecha_pago_extemporaneo_factura',
		NULL,NULL,NULL,NULL,NULL,$numero,'0',NULL);";
		
		echo $numero."<br>";
		mysql_query($sql) or die("$sql Error, query failed factura");  
		//-FACTURA

       // factura detalle
             

          


             
		//-factura detalle
	}		
}
while($f <> 1 )

?>
<meta HTTP-EQUIV="REFRESH" content="10; url=consultafactura.php">
<?php
	unlink("uploads/".$nombre);

?>