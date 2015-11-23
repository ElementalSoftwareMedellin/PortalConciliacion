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
								<h2><a href="#">INFORMACIÓN ESTUDIANTIL SOBRE RECAUDO</a></h2>
								<p>Info</p>
							</header>
							<!--a href="#" class="image featured"><img src="images/2.jpg" alt="" /></a-->
							<p>
								
							</p>
						</article>

					<!-- Pagination 
						<div class="pagination">
							<a href="#" class="button previous">Previous Page</a>
							<div class="pages">
								<a href="#" class="active">1</a>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<span>&hellip;</span>
								<a href="#">20</a>
							</div>
							<a href="#" class="button next">Next Page</a>
						</div-->

				</div>
<?php
	Include "pie.php";
?>