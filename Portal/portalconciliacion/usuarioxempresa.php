<?php
session_start();
include 'conexion/conection.php';
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

	<!-- Post -->
		<article class="box post post-excerpt">
			<header>
				<h2><a href="#">GESTIÓN DE ALUMNOS</a></h2>
				<p></p>
			</header>
			<p>
					<div class="centro">
							<div id="PeopleTableContainer" style="width: 100%;"></div>
							<div id="SelectedRowList" style="width: 70%;"></div>
					</div>
			</p>
</div>
  <body>  	 		
 	<h3>Usuarios</h3>
 	<p>
 	<table id="tableform">
 	<tr>
 		<td>

 	<label>Usuario : </label>
 	<select id="usuarios">
		<?php
			$sql= "SELECT id_usuario,nombre_usuario FROM usuario WHERE tipo_usuario = 1;";
		    $result = mysql_query($sql) or ("error al consultar usuario.");
			echo '<option value="0">Seleccione</option>';
			while($row = mysql_fetch_array($result))
		    {		
		 ?>
					<option  value="<?php echo $row['id_usuario'];?>"><?php echo ucwords($row['nombre_usuario']);?></option>
			<?php
				}								
	 	?>
	</select>

	<br>
	<label>Sucursal: </label>
	<select id="sucursal">
	<?php
		$sql= "SELECT id_empresa,nombre_empresa FROM empresa;";
	    $result = mysql_query($sql) or ("error al consultar empresa.");
		echo '<option value="0">Seleccione</option>';
		 while($row = mysql_fetch_array($result))
		{		
	 ?>
				<option  value="<?php echo $row['id_empresa'];?>"><?php echo ucwords($row['nombre_empresa']);?></option>
		<?php
			}								
 	?>
	</select>
	</td>
	<td>
		<input type='button' value='Guardar' id='guardar' />
		<div id="sucursales">
			
		</div>
	</td>
</tr>
</table>
<input type="button" value="Agregar" id="agregar" />


	<script type="text/javascript">


		$(document).ready(function () {
			$("#guardar").attr("style","display: none");

			$("#agregar").click(function(){

			var erroragregar = "NO";
			var nombre = $("#sucursal :selected").text(); 
			var sucursal = $("#sucursal :selected").val();
			var usuario = $("#usuarios :selected").val();
				if (sucursal != 0 && usuario != 0)
				{
					$('.ck').each(function()
						{
						   var checkbox = $(this);
						   if ($(checkbox).val() == sucursal)
						   {
						   		erroragregar = "Si";
						   		alert("Ya se agregó esta sucursal: "+nombre);
						   }
						});
				}
				else
				{
					erroragregar = "Si";
					alert("Debe seleccionar una Sucursal y/o el Usuario");
				}

				/*var nombre = $("#sucursal :selected").text(); 
				var sucursal = $("#sucursal :selected").val();*/
			if(erroragregar == "NO")
			{
				var html = "<br /><input type='checkbox' value="+sucursal+" class='ck' checked/>"+nombre;
				$("#sucursales").append(html);
			}

				var cont = 0;
				$('.ck').each(function()
				{
					cont = cont + 1;
				});
				if (cont == 1)
				{
					$("#guardar").removeAttr("style");
				}

			});

			$("#usuarios").change(function(){
				$("#sucursales").empty();
				var usuario = $("#usuarios :selected").val();
				var objguardar = {
								"action" : 'cargar',
								'usuario' : usuario
								};
							
				$.ajax({	async: true,	type: "POST",	dataType: "text",	contentType: "application/x-www-form-urlencoded; charset=UTF-8",	url: "listarusuarioxempresa.php",  
				data: objguardar,	  success: listarsucursales,	beforeSend: antesEnvio,	timeout: 4000,	error: errorEnvio	});
			});
			$("#guardar").click(function(){

				var sucursales = new Array();
				var i = 0;
				 $('.ck').each(function(){
								   var checkbox = $(this);
								   if (checkbox.is(':checked') == true)
								   {
										sucursales[i] = $(checkbox).val();
										i = i + 1;
								   }
							});
				var usuario = $("#usuarios :selected").val();
				var jsonsucursales = JSON.stringify(sucursales);
				var objguardar = {
								"action" : 'guardar',
								'usuario' : usuario,
								'sucursales':jsonsucursales
								};
							
				$.ajax({	async: true,	type: "POST",	dataType: "text",	contentType: "application/x-www-form-urlencoded; charset=UTF-8",	url: "listarusuarioxempresa.php",  
				data: objguardar,	  success: guardadoexitoso,	beforeSend: antesEnvio,	timeout: 4000,	error: errorEnvio	});
				

			});

		});
			
		function antesEnvio() {
		//alert("Se procesa la función 'antesEnvio()' antes de enviarse los datos...");
		}

		// En caso de error POST
		function errorEnvio() {
		//alert("Ha ocurrido un error!");
		}

		function guardadoexitoso (data)
		{
			alert(data);
			//location.reload();
		}

		function listarsucursales ( datos )
		{
			if (datos!= "")
			{
				$("#sucursales").append(datos);
				$("#guardar").removeAttr("style");

			}
			else
			{
				$("#guardar").attr("style","display: none");
				$("#sucursales").empty();
			}
		}

	</script>
 
  </body>
</html>
