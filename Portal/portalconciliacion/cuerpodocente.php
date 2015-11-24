<?php  
if (!isset($_SESSION["User_Active"] ) && !isset($_SESSION["User_Name"] )) //si no existen estas variables de sesion ... enviarà mensaje
{
	header("Location: index.php?error=No ha iniciado sesion");
}
if ($_SESSION["User_Type"] =='0' || $_SESSION["User_Type"] =='1') // validacion tipo de usuario
{} 
else
{
	die('No tiene permisos para accedera este lugar');
}

?>
<!DOCTYPE HTML>
<!--
	Striped by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>PORTAL DE DOCUMENTOS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!-- Fuentes de Google -->
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		
		<!-- Iconos -->
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/jquery-ui.css">
	</head>
	<body>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="js/main.js"></script>
		<!-- Sidebar -->
			<div id="sidebar">
				<section>
					<?php echo "<b>DOCENTE</b><br> ID: ".$_SESSION["User_Active"]." <br>USUARIO: ".$_SESSION["User_Name"]."<br><b><a href='logout.php'>SALIR</a></b>";?>
				</section>
				<!-- Logo -->
				<nav>
					<img src="images/Calasanz.png" style="width:150">
				</nav>
				<!-- Nav -->
					<nav>
						<ul id="accordion" class="accordion">
							<li>
								<div class="link"><i class="fa fa-inbox"></i>REPORTES<i class="fa fa-chevron-down"></i></div>
								<ul class="submenu">
									<li><a href="#">FACTURAS</a></li>
									<li><a href="#">INSTITUCIONALES</a></li>
								</ul>
							</li>
							<li>
								<div class="link"><i class="fa fa-folder"></i>CARTERA<i class="fa fa-chevron-down"></i></div>
								<ul class="submenu">
									<li><a href="conciliacion.php">CONCILIACION</a></li>
									<li><a href="#">GRUPOS</a></li>
									<li><a href="#">ESPECIFICOS</a></li>
								</ul>
							</li>
							<li>
								<div class="link"><i class="fa fa-clipboard"></i>CONSULTA<i class="fa fa-chevron-down"></i></div>
								<ul class="submenu">
									<li><a href="consultafactura.php">FACTURAS</a></li>
									<li><a href="consultaInstitucional.php">INSTITUCIONALES</a></li>
								</ul>
							</li>
							<li><div class="link"><i class="fa fa-cloud-upload"></i>DOCUMENTOS<i class="fa fa-chevron-down"></i></div>
								<ul class="submenu">
									<li><a href="generar.php">GENERAR</a></li>
									<li><a href="subir.php">SUBIR</a></li>
								</ul>
							</li>
						</ul>
					</nav>

				<!-- Search -->
					<section class="box search">
						<form method="post" action="#">
							<input type="text" class="text" name="search" placeholder="Search" />
						</form>
					</section>

				<!-- Text -->
					<section class="box text-style1">
						<div class="inner">
							<p>
								<strong>PORTAL CALASANZ</strong> Portal de consultas y pagos dirigido a los usuarios de la institución con el fin de optimizar los procesos de comunicación y pagos. <a href="http://n33.co/"></a> <a href="http://html5up.net/"></a>
							</p>
						</div>
					</section>

				<!-- Recent Posts -->
					<section class="box recent-posts">
						<header>
							<h2>ULTIMAS ACTIVIDADES</h2>
						</header>
						<ul>
							<li><a href="#">Facturas Enero 2015</a></li>
							<li><a href="#">Facturas Grupo 3A</a></li>
							<li><a href="#">Cartera Enero 2015 General</a></li>
							<li><a href="#">Cartera Especificos</a></li>
							<li><a href="#">Documentos</a></li>
						</ul>
					</section>

				<!-- Recent Comments -->
					<section class="box recent-comments">
						<header>
							<h2>EVENTOS RECIENTES</h2>
						</header>
						<ul>
							<li><a href="#">SALIDA RECREATIVA: PANACA</a></li>
							<li><a href="#">DIA DEL LIBRO</a></li>
							<li><a href="#">RETIRO</a></li>
						</ul>
					</section>

				<!-- Calendar -->
					<section class="box calendar">
						<div class="inner">
							<table>
								<caption>Mayo 2015</caption>
								<thead>
									<tr>
										<th scope="col" title="Lunes">L</th>
										<th scope="col" title="Martes">M</th>
										<th scope="col" title="Miercoles">M</th>
										<th scope="col" title="Jueves">J</th>
										<th scope="col" title="Viernes">V</th>
										<th scope="col" title="Sabado">S</th>
										<th scope="col" title="Domingo">D</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colspan="4" class="pad"><span>&nbsp;</span></td>
										<td><span>1</span></td>
										<td><span>2</span></td>
										<td><span>3</span></td>
									</tr>
									<tr>
										<td><span>4</span></td>
										<td><span>5</span></td>
										<td><a href="#">6</a></td>
										<td><span>7</span></td>
										<td><span>8</span></td>
										<td><span>9</span></td>
										<td><a href="#">10</a></td>
									</tr>
									<tr>
										<td><span>11</span></td>
										<td><span>12</span></td>
										<td><span>13</span></td>
										<td class="today"><a href="#">14</a></td>
										<td><span>15</span></td>
										<td><span>16</span></td>
										<td><span>17</span></td>
									</tr>
									<tr>
										<td><span>18</span></td>
										<td><span>19</span></td>
										<td><span>20</span></td>
										<td><span>21</span></td>
										<td><span>22</span></td>
										<td><a href="#">23</a></td>
										<td><span>24</span></td>
									</tr>
									<tr>
										<td><a href="#">25</a></td>
										<td><span>26</span></td>
										<td><span>27</span></td>
										<td><span>28</span></td>
										<td class="pad" colspan="3"><span>&nbsp;</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>

				<!-- Copyright -->
					<ul id="copyright">
						<li>&copy; Elemental Software </li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>

			</div>
			<!-- Content -->
			<div id="content">