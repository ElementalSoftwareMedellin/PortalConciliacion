<?php
session_start();
include '../../conexion/conection.php';
$output_dir = "../../uploads/";

if(isset($_POST['idtipo'])){
	$FileTipo = $_POST['idtipo'];
	//print_r($FileTipo);
	$queryT= "INSERT into temp_tipo_institucional values (NULL,$FileTipo);" ;	
	mysql_query($queryT) or die('Error, query failed');  
	echo "exito"; 
}

if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
		$Type = mysql_query("SELECT id_tipo_institucional,id_temp_tipo_institucional FROM temp_tipo_institucional ORDER BY id_temp_tipo_institucional DESC");  
		$dataType = mysql_fetch_array($Type);
		if ($dataType[0] != 0) {		
				
		 	$fileName = $_FILES["myfile"]["name"];
			move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
			$ret[]= $fileName;

			$fileSize = $_FILES['myfile']['size'];
			$Fecha = date("d/m/Y"); 
		  	$query = "INSERT INTO documento_institucional VALUES (NULL, '$fileName', '$fileSize','$Fecha',$dataType[0],'1')";      
		     mysql_query($query); 
    	}
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  	$ret[]= $fileName;

	  }
	
	}
    echo json_encode($ret);
 }
 ?>
