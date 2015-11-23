<?php
/** Incluir la ruta **/
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');

/** Clases necesarias */
require_once('PHPExcel.php');
require_once('PHPExcel/Reader/Excel2007.php');


$VIEWDATA = array(
        'Numero' => 0,
        'Nombre' => 0,
        'Nit' => 0
);

        // Cargando la hoja de cálculo
        $objReader = new PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load("Factura.xlsx");
        
        // Asignar hoja de calculo activa
        $objPHPExcel->setActiveSheetIndex(0);
        $VIEWDATA['Numero'] = $objPHPExcel->getActiveSheet()->getCell('A2')->getCalculatedValue();
        $VIEWDATA['Nombre'] = $objPHPExcel->getActiveSheet()->getCell('B2')->getCalculatedValue();
        $VIEWDATA['Nit'] = $objPHPExcel->getActiveSheet()->getCell('C2')->getCalculatedValue();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<table width="200" border="1">
  <tr>
    <td> NOmbree: <?php echo $VIEWDATA['Nombre']?> </td>
    <td><?php echo $VIEWDATA['Numero']?></td>
  </tr>
  <tr>
    <td><?php echo $VIEWDATA['Nit']?></td>
    <td>&nbsp;</td>
  </tr>
</table>

<body>
</body>
</html>