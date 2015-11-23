<?php
session_start();
if ($_SESSION["User_Type"] == 0) 
{
		Include "cuerpoadministrador.php";
}
else if ($_SESSION["User_Type"] == 1) 
{
		Include "cuerpodocente.php";
}
else if ($_SESSION["User_Type"] == "alumno") 
{
		Include "cuerpoalumno.php";
}
?>
<div class="inner">
	<article class="box post post-excerpt">
		<header>
			<h2><a href="#">SUBIR DOCUMENTOS</a></h2>
			<p>Seleccione el Tipo de Documento a Subir</p>
		</header>
		<p>
			<select class="select1" name="tipo" id="tipo">
				<option  value="0">Seleccione</option>
				<?php
					include 'conexion/conection.php';
					$DataTipo = mysql_query("SELECT * FROM  tipo_institucional ORDER BY  descripcion_tipo_institucional ASC ");  
					while ($dataSelect= mysql_fetch_assoc($DataTipo)) 
					{		
						 ?>
		  				<option  value="<?php echo $dataSelect['id_tipo_institucional'];?>"><?php echo $dataSelect['descripcion_tipo_institucional'];?></option>
		  				<?php
						}
				?>
			</select>
			<div id="divfileuploader">
			<div id="fileuploader">SUBIR</div></div>    	
		</p>
</div>		



<link href="multiupload/css/uploadfile.css" rel="stylesheet">
<script src="multiupload/js/jquery.min.js"></script>
<script src="multiupload/js/jquery.uploadfile.js"></script>
<script>
$(document).ready(function()
{

     $(".title").text("SUBIR DOCUMENTOS");

	 $("#divfileuploader").attr("style","display: none");

	 $('#tipo').change(function(){  

	  if ($(this).val() == 0 )
	  {
	  	 $("#divfileuploader").attr("style","display: none");
	  }
	  else
	  {
	  	$("#divfileuploader").removeAttr("style");
	  }

	  $.ajax({      type : "POST",
	                url  : "multiupload/php/upload.php",
	                cache : false,
	                data : {  idtipo: $(this).val() },
	                success : function(data){
	                    
	                }
	            });
	 });
	$("#fileuploader").uploadFile({
	url:"multiupload/php/upload.php",
	fileName:"myfile",
	allowedTypes:"pdf",
	showProgress:true,
	showAbort: false,
	dragDropStr: "<span><b>Arrastra aquì los archivos</b></span>",
	abortStr: "Abortar",
    cancelStr: "Cancelar",
    deletelStr: "Eliminar",
    doneStr: "Subido",
    multiDragErrorStr: "NO ESTA DISPONIBLE.",
    extErrorStr: "is not allowed. Allowed extensions: ",
    sizeErrorStr: "is not allowed. Allowed Max size: ",
    uploadErrorStr: "Upload is not allowed",
    maxFileSize: 2092965,
    maxFileCountErrorStr: " is not allowed. Maximum allowed files are:"


	});
});
</script>
<?php
	Include "pie.php";
?>		