<?php

session_start();
//////validar que sea el tipo de usuario con permisos
if ($_SESSION["User_Type"] =='0') // validacion tipo de usuario
{} 
else
{
	echo "<meta HTTP-EQUIV='REFRESH' content='3; url=inicio.php'>";
	die('No tiene permisos para acceder a este lugar');
}
////////////////////////////////////////////////////

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
				<h2><a href="#">GESTIÓN DE USUARIOS</a></h2>
				<p></p>
			</header>
			<p>
					<div class="centro">
							<div id="PeopleTableContainer" style="width: 100%;"></div>
							<div id="SelectedRowList" style="width: 70%;"></div>
					</div>
			</p>
</div>
		<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
		<script src="scripts/jtable/jquery.jtableElemental.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function () {
				$(".title").text("GESTION DE USUARIO");
		    //Prepare jTable
			    $('#PeopleTableContainer').jtable({
				title: 'Usuarios',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'Name ASC',
                selecting: false,
                multiselect: false,
                selectingCheckboxes: false,
                selectOnRowClick: false,
				actions: {
					listAction: 'listarUsuario.php?action=list&jtSorting=id_usuario%20DESC&jtStartIndex=0&jtPageSize=20',
					createAction: 'listarUsuario.php?action=create',
					updateAction: 'listarUsuario.php?action=update',
					deleteAction: 'listarUsuario.php?action=delete',
					slistAction: 'null'
				},
				fields: {
					Id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					Nit: {
						title: 'Nit',
						edit: false,
						width: '20%'
					},
					Nombre: {
						title: 'Nombre',
						width: '20%'
					},
					Contrasena: {
						title: 'Contrasena',
						width: '33%',
						edit: true,
						list: false
					},
					Correo: {
						title: 'Correo:',
						width: '20%'
					},
					Tipo: {
						title: 'Tipo',
						width: '20%',
						edit: false,
						options: {"0":"ADMINISTRADOR","1":"DOCENTE"}
					},
					Estado: {
						title: 'Tipo',
						width: '20%',
						edit: false,
						options: {"0":"ACTIVO","1":"INACTIVO"}
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

			//reload list search
			$("#txtBuscar").keyup(function()
			{
				$('#PeopleTableContainer').jtable('reload', {
                actions: {
                			slistAction: 'listarUsuario.php?action=list&jtSorting=id_usuario%20DESC&jtStartIndex=0&jtPageSize=10&buscar=' + $(this).val(),
                		}
            	});
			});


			


	});
	</script>
 <?php
	Include "pie.php";
?>	
