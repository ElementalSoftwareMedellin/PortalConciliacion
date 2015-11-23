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

	<!-- Post -->
		<article class="box post post-excerpt">
			<header>
				<h2><a href="#">GESTIÓN DE DOCUMENTOS INSTITUCIONALES</a></h2>
				<p>Documentos</p>
			</header>
			<p>
					<div class="centro">
							<div id="DocsContainer" style="width: 100%;"></div>	
							<div id="SelectedRowList" style="width: 70%;"></div>
							<img src='images/eliminar.png' width='12px' alt='eliminar' title='eliminar'><button id="eliminardocumentos">Eliminar Documentos Seleccionados</button>
					</div>
			</p>
</div>
						<!-- Codigo para traer la informacion de la consulta-->								
						<Link rel="stylesheet" type="text/css" href="css/lightcolor/demo_page.css">
						<Link rel="stylesheet" type="text/css" href="css/lightcolor/demo_table.css">
						<script type="text/javascript" language="javascript" src="tablaconsulta/jquery.js"></script>
						<script type="text/javascript" language="javascript" src="tablaconsulta/jquery.dataTables.js"></script>
						<script type="text/javascript" language="javascript" src="tablaconsulta/jquery.dataTables.columnFilter.js"></script>
						<script language="JavaScript" type="text/javascript" src="tablaconsulta/delete.js"></script>
						
						<link href="css/lightcolor/gray/jtable.css" rel="stylesheet" type="text/css" />
						<script src="tablaconsulta/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
					    <script src="tablaconsulta/jquery.jtableAdmin.js" type="text/javascript"></script>
						<script type="text/javascript">
						var docs = new Array();
						var record;

						
							$(document).ready(function () {
								$(".title").text("DOCUMENTOS INSTITUCIONALES");
					        
								$('#eliminardocumentos').click(function() 
								{
									$('<div></div>').appendTo('body')
									  .html('<div><h7>Está seguro que desea Eliminar?<br>Al momento de eliminar se borrará el registro del documento!</h7></div>')
									  .dialog({
									      modal: true, title: 'Mensaje', zIndex: 10000, autoOpen: true,
									      width: 'auto', resizable: false,
									      buttons: {
									          SI: function () {
									              docs.length=0;
										    var $selectedRows = $('#DocsContainer').jtable('selectedRows');
							 				 $selectedRows.each(function ()  {
							                        record = $(this).data('record');
							                        docs.push(record.Nombre);				                        
							                    });
							 				 jsondocs =JSON.stringify(docs);
							 				 $.post('_eliminar.php',{docs: jsondocs}, function(data)
							 				 {
								 				 alert(data);
								 				 location.reload();
							 				 });
									              $(this).dialog("close");
									          },
									          No: function () {
									              $(this).dialog("close");
									          }
									      },
									      close: function (event, ui) {
									          $(this).remove();
											      }
											});
											
					 				 
								});

							    //Prepare jTable
								$('#DocsContainer').jtable({
									title: 'Documentos Pendientes',
									paging: true,
									pageSize: 10,
									sorting: true,
									defaultSorting: 'Name ASC',
					                selecting: true,
					                multiselect: true,
					                selectingCheckboxes: true,
					                selectOnRowClick: false,
									actions: {
										listAction: 'listarconsultainstitucional.php?action=list&jtSorting=Id%20DESC&jtStartIndex=0&jtPageSize=20',
										createAction: 'listarconsultainstitucional.php?action=create',
										updateAction: 'listarconsultainstitucional.php?action=update',
										deleteAction: 'listarconsultainstitucional.php?action=delete',
										slistAction: 'null'
									},
									fields: {
										Id: {
											key: true,
											create: false,
											edit: false,
											list: false
										},
										Nombre: {
											title: 'Nombre Documento',
											width: '60%'
										},
										Fecha: {
											title: 'Fecha:',
											width: '20%'
										},
										Tipo: {
											title: 'Tipo',
											width: '20%'
										}
									}
								
					            });

								//Load person list from server
								$('#DocsContainer').jtable('load');

								//reload list search
								$("#txtBuscar").keyup(function()
								{
									$('#DocsContainer').jtable('reload', {
					                actions: {
					                			slistAction: 'listarconsultainstitucional.php?action=list&jtSorting=Id%20DESC&jtStartIndex=0&jtPageSize=10&buscar=' + $(this).val(),
					                		}
					            	});
								});

						});
						</script>
<?php
	Include "pie.php";
?>			
