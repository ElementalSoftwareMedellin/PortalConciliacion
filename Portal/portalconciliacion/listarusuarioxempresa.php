<?php
include 'conexion/conection.php';
	if(isset($_POST["action"]))
	{
		if($_POST["action"] == "guardar")
		{
			$usuario= $_POST["usuario"];
			$sucursales= json_decode($_POST["sucursales"]);

			$sql = "SELECT count(id_usuario_x_empresa) numero FROM usuario_x_empresa WHERE usuario_id_usuario='$usuario';";
			$result = mysql_query($sql) or ("Error de Query");
			$row = mysql_fetch_array($result);
			if ($row["numero"] != 0) 
			{
				$sql = "DELETE FROM usuario_x_empresa WHERE usuario_id_usuario =$usuario";
				mysql_query($sql) or die(" $sql No se pudo eliminar sucursales");
			}

			for ($i=0; $i < count($sucursales) ; $i++)
			{
				$result = mysql_query("INSERT INTO usuario_x_empresa VALUES(NULL,'$usuario','$sucursales[$i]');") or die ("error insertar detalle usuario x sucursal") ;
			}
			echo "Guardado Exitoso";

		}
		else if($_POST["action"] == "cargar")
		{
			$count = 0;
			$usuario= $_POST["usuario"];
			$options = "";	   
			$sql= "SELECT ue.empresa_id_empresa id_empresa,e.nombre_empresa nombre_empresa FROM usuario_x_empresa ue join empresa e on (e.id_empresa = ue.empresa_id_empresa)  WHERE ue.usuario_id_usuario = $usuario";
			//$sql= "SELECT id_empresa,nombre_empresa FROM empresa;";
			//echo $sql;
	  		$result = mysql_query($sql) or die("$sql error al consultar usuario x Empresa.");
			while($row = mysql_fetch_array($result))
			{
					$results[]='</br><input type="checkbox" value="'.$row["id_empresa"].'" class="ck" checked="">'.$row["nombre_empresa"];
					$count ++ ;
			}

			for ($i=0; $i < $count ; $i++) { 
				$options .= $results[$i];
			}
			echo $options;

		}

	}
?>