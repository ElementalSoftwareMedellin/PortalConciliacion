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
		<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
		<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
		<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
		<script src="scripts/jtable/jquery.jtableElemental.js" type="text/javascript"></script>
		<script type="text/javascript">
		<?php
			    $sql= "SELECT id_empresa,nombre_empresa FROM empresa;";
			    $result = mysql_query($sql) or ("error al consultar empresa.");
			    $empresas="";
			    while($row = mysql_fetch_array($result))
			    {
			      $empresas= $empresas."'".$row['id_empresa']."':'".$row['nombre_empresa']."',";
			    }
			    $empresas= substr($empresas, 0 ,strlen($empresas)-1);
			    $empresas = "{".$empresas."}";
	    ?>
		$(document).ready(function () {
				var jsonempresas="";
				$(".title").text("GESTION DE ALUMNOS");
			    $('#PeopleTableContainer').jtable({
				title: 'Alumnos',
				paging: true,
				pageSize: 10,
				sorting: true,
				defaultSorting: 'Name ASC',
                selecting: false,
                multiselect: false,
                selectingCheckboxes: false,
                selectOnRowClick: false,
				actions: {
					listAction: 'listarCliente.php?action=list&jtSorting=id_cliente%20DESC&jtStartIndex=0&jtPageSize=20',
					createAction: 'listarCliente.php?action=create',
					updateAction: 'listarCliente.php?action=update',
					deleteAction: 'listarCliente.php?action=delete',
					slistAction: 'null'
				},
				fields: {
					Id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					Identificacion: {
						title: 'Identificacion',
						width: '10%',
						edit: true
					},
					Nombre: {
						title: 'Nombre',
						width: '20%'
					},
					Apellido: {
						title: 'Apellido',
						width: '20%'
					},
					Codigo: {
						title: 'Matricudla',
						width: '10%'
					},
					Modulo: {
						title: 'Grupo',
						width: '10%',
						edit: true
					},

					Empresa: {
						title: 'Colegio',
						width: '20%',
						options: <?php echo $empresas; ?>,
						edit: true
					},
					Estado: {
						title: 'Estado',
						width: '10%',
						options: {0:"activo",1:"inactivo"},
						edit: true
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
                			slistAction: 'listarCliente.php?action=list&jtSorting=id_cliente%20DESC&jtStartIndex=0&jtPageSize=10&buscar=' + $(this).val(),
                		}
            	});
			});


			


	});
	</script>
 <?php
	Include "pie.php";
?>	
