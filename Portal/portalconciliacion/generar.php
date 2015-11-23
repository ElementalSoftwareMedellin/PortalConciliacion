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
	   	<form method="post" enctype="multipart/form-data" id="form" name="form">
				<select name="listatipo" class="select1" id="listatipo" onclick="habilitar()">
					<option  value="0" >Seleccione</option>
					
	  					<option value="1">Factura</option>
	  					
					</select>

			
	 		<label for="archivo">Importacion EXCEL</label> 
	 		<input name="archivo" type="file" id="archivo" /> 
	 		<input name="boton" type="button" id="boton" value="Enviar" />
	 		
	 		</form>
	 		<script >
		$(document).on('ready',function()
		{
			$(".title").text("GENERAR DOCUMENTOS");
			$("#boton").attr("disabled", "disabled");
			$("#archivo").attr("disabled", "disabled");
			$("#cambiar").attr("disabled", "disabled");
			$("#boton").on('click',function()
			{
			    var actionform = $('#listatipo option:selected').html();
			    $("#form").attr("action", 'Excel'+actionform+'.php');
				$("#listatipo").removeAttr('disabled');
				$("#form").submit();
			});
		});
			
			function habilitar()
			{
					if ($("#listatipo").val() != 0 )
					{	  
			   		  $("#boton").removeAttr('disabled');
			   		  $("#archivo").removeAttr('disabled');
			   		  $("#cambiar").removeAttr('disabled');
			   		  $("#listatipo").attr("disabled", "disabled");
			   		}	   		

			}
			function habilitar2()
			{
				var sel = document.getElementById("listatipo");
				for(i=(sel.length-1); i>=0; i--)
				{

					if (sel.options[i].text == 'Seleccione' )
					{	
						
						 aBorrar = sel.options[i];
						 aBorrar.parentNode.removeChild(aBorrar);
					}
				}
					
				$("#boton").attr("disabled", "disabled");
				$("#archivo").attr("disabled", "disabled");
				$("#cambiar").attr("disabled", "disabled");		
				$("#listatipo").removeAttr('disabled');
			}
		</script>


