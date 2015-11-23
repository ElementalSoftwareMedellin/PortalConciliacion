<?php
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php'); 


class MYPDF extends TCPDF {

public function nuevapagina($y)
{
	if ($y == 0) 
	{
		$this->AddPage('P','letter');
	}
	
	// set cell padding
	$this->setCellPaddings(1, 1, 1, 1);
	// set cell margins
	$this->setCellMargins(0, 0, 0, 0);
	// set color for background
	$this->SetFillColor(999, 999, 999);
	//llamamos la plantilla
	$this->plantilla($y);
}

public function plantilla($y)
{
	//ocultar linea negra de PDF ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
		$this->MultiCell(205, 20, '', 0, 'C', 1, 1, 0, 0, true,0,false,true,40,'T', true);
	//↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

		$EstiloLineal= array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(9, 9, 9));
		$EstiloPuntos= array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => '0,0,5,2', 'phase' => 10, 'color' => array(0, 0, 0));
		$x=0;
		//$y=0;
	//IMAGENES DOCUMENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$LogoNormal='images/Calasanz.png';
		$MarcaDeAgua='images/CalasanzE.png';
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: IMAGENES DOCUMENTO
	//LINEAS CUPON ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$this->Line($x+90,$y+5,$x+90,$y+90,$EstiloLineal);//divide cupones
		$this->Line($x+5,$y+5,$x+5,$y+90,$EstiloLineal);//divide izquierda
		$this->Line($x+210,$y+5,$x+210,$y+90,$EstiloLineal);//divide derecha
		$this->Line($x+5,$y+5,$x+210,$y+5,$EstiloLineal);//linea arriba
		$this->Line($x+5,$y+22,$x+210,$y+22,$EstiloLineal);//linea despues encabezado
		$this->Line($x+90,$y+32,$x+210,$y+32,$EstiloLineal);//linea despues encabezado lado izq
		$this->Line($x+5,$y+90,$x+210,$y+90,$EstiloLineal);//linea abajo
		$this->Line($x+5,$y+92,$x+210,$y+92,$EstiloPuntos);//linea cortar
		$this->Line($x+5,$y+74,$x+90,$y+74,$EstiloLineal);//lineas horizontales total
		$this->Line($x+5,$y+80,$x+210,$y+80,$EstiloLineal);//lineas horizontales puntos de pago

	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: LINEAS CUPON
	//LLENAR CAMPOS INFORMATIVOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoNombre='COLEGIO CALASANZ FEMENINO - MEDELLIN';
		$InfoNit='NIT: 860.014.826-8';
		$InfoDireccion='CALLE 53 No. 76A - 130 - MEDELLIN';
		$InfoTelefonos='TELEFONOS: 234 2131 - 234 5550';
		$InfoPaginaWeb='wwww.calasanzfemeninomedellin.edu.co';
		$InfoTipo="RECIBO DE PAGO";
		//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: LLENAR CAMPOS INFORMATIVOS
	//LLENAR CAMPOS ESTUDIANTE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$EstudianteAlumna="Alumna:";
		$EstudianteCodigo="Código:";
		$EstudianteGrado="Grado:";
		$EstudianteAno="Año:";
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: LLENAR CAMPOS ESTUDIANTE
	//CUPON :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		//LOGO CUPON ..............................................................................................................
		$this->Image($LogoNormal,$x+8,$y+6,15,15,'PNG','','',true,150,'',false,false,0,false,false,false);
		$this->Image($LogoNormal,$x+92,$y+6,15,15,'PNG','','',true,150,'',false,false,0,false,false,false);
		//INFO ENCABEZADO CUPON IZQUIERDA .........................................................................................
		$this->SetFont('helveticaB', '',7);//Tamaño y tipo de Fuente 
		$this->MultiCell(100,10,$InfoNombre   ,0,'C',1,1,$x+7,$y+5,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoNit      ,0,'C',1,1,$x+7,$y+8,true,0,false,true,40,'T');
	$this->SetFont('helvetica', '',6);	//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$InfoDireccion,0,'C',1,1,$x+7,$y+12,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoTelefonos,0,'C',1,1,$x+7,$y+14,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoPaginaWeb,0,'C',1,1,$x+7,$y+16,true,0,false,true,40,'T');
		//INFO ESTUDIANTE .........................................................................................................
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$EstudianteAlumna,0,'L',1,1,$x+10,$y+22,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteCodigo,0,'L',1,1,$x+10,$y+26,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteGrado ,0,'L',1,1,$x+10,$y+30,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteAno   ,0,'L',1,1,$x+10,$y+34,true,0,false,true,40,'T');
		//INFO ENCABEZADO CUPON DERECHA ...........................................................................................
		$this->SetFont('helveticaB', '',7);//Tamaño y tipo de Fuente 
		$this->MultiCell(100,10,$InfoNombre   ,0,'C',1,1,$x+100,$y+5,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoNit      ,0,'C',1,1,$x+100,$y+8,true,0,false,true,40,'T');
	$this->SetFont('helvetica', '',6);	//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$InfoDireccion,0,'C',1,1,$x+100,$y+12,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoTelefonos,0,'C',1,1,$x+100,$y+14,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoPaginaWeb,0,'C',1,1,$x+100,$y+16,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$InfoTipo     ,0,'L',1,1,$x+182,$y+8,true,0,false,true,40,'T');
		//INFO ESTUDIANTE .........................................................................................................
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$EstudianteAlumna,0,'L',1,1,$x+90,$y+22,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteCodigo,0,'L',1,1,$x+90,$y+26,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteGrado ,0,'L',1,1,$x+185,$y+22,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteAno   ,0,'L',1,1,$x+185,$y+26,true,0,false,true,40,'T');
		//RELACION DE CHEQUES .....................................................................................................
				/*
				//lineas Horizontales Relacion de cheques
				$this->Line($x+11,$y+63,$x+85,$y+63,$EstiloLineal);
				$this->Line($x+11,$y+68.5,$x+85,$y+68.5,$EstiloLineal);
				$this->Line($x+11,$y+73,$x+85,$y+73,$EstiloLineal);
				$this->Line($x+11,$y+77,$x+85,$y+77,$EstiloLineal);
				$this->Line($x+11,$y+81,$x+85,$y+81,$EstiloLineal);
				$this->Line($x+11,$y+85,$x+85,$y+85,$EstiloLineal);
					//lineas verticales Relacion de cheques
				$this->Line($x+27,$y+68.5,$x+27,$y+81,$EstiloLineal);
				$this->Line($x+31,$y+77,$x+31,$y+81,$EstiloLineal);
				$this->Line($x+65,$y+68.5,$x+65,$y+85,$EstiloLineal);
					//informacion relacion cheques
				$InfoCuponRelacionCheques="RELACION DE CHEQUES";
				$InfoCuponCodigoBanco="CDO. BCO";
				$InfoCuponNumeroCheques="No. CHEQUES";
				$InfoCuponChequeNumero="CHEQUE No.";
				$InfoCuponTotalCheque="TOTAL CHEQUES";
				$InfoCuponTotalEfectivo="TOTAL EFECTIVO";
				$InfoCuponPagueUnicamenteChequeEfectivo="PAGUE UNICAMENTE EN CHEQUE O EFECTIVO";
				//...................................................................................................................
				$this->SetFillColor(200, 200, 200);
				$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente
					$this->MultiCell(74,3,$InfoCuponRelacionCheques,'','C',1,1,$x+11 ,$y+63,true,0,false,true,40,'T');
				$this->SetFillColor(255, 255, 255);
				$this->SetFont('helvetica', '',6);//Tamaño y tipo de Fuente 
					$this->MultiCell(74,3,$InfoCuponCodigoBanco,'','L',1,1,$x+11 ,$y+69,true,0,false,true,40,'T');
					$this->MultiCell(74,3,$InfoCuponNumeroCheques,'','L',1,1,$x+11 ,$y+77,true,0,false,true,40,'T');
					$this->MultiCell(54,3,$InfoCuponChequeNumero,'','R',1,1,$x+11 ,$y+69,true,0,false,true,40,'T');
				$this->SetFont('helveticaB', '',6);//Tamaño y tipo de Fuente 
					$this->MultiCell(54,3,$InfoCuponTotalCheque,'','R',1,1,$x+11 ,$y+77,true,0,false,true,40,'T');
					$this->MultiCell(54,3,$InfoCuponTotalEfectivo,'','R',1,1,$x+11 ,$y+81,true,0,false,true,40,'T');
				$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente 
					$this->MultiCell(74,3,$InfoCuponPagueUnicamenteChequeEfectivo,'','C',1,1,$x+11 ,$y+87,true,0,false,true,40,'T');
					*/
		//PUNTOS DE PAGO ..........................................................................................................
		$InfoPuntosPago= "Puntos de Pago";
		$InfoNombreBancoUno="BANCO CAJA SOCIAL BSC";
		$InfoCuentaBancoUno="CTA. AHO. 24505106827";
		$InfoNombreBancoDos="BANCO BOGOTA";
		$InfoCuentaBancoDos="CTA. CTE. 36200392-3";
		$this->SetFont('helveticaB', '',6);//Tamaño y tipo de Fuente 
		//info puntos de pago
		$this->MultiCell(74,3,$InfoPuntosPago,'','L',1,1,$x+100 ,$y+79,true,0,false,true,40,'T');
		$this->MultiCell(50,3,$InfoNombreBancoUno,'','L',1,1,$x+105 ,$y+82,true,0,false,true,40,'T');
		$this->MultiCell(49,3,$InfoCuentaBancoUno,'','R',1,1,$x+135 ,$y+82,true,0,false,true,40,'T');
		$this->MultiCell(50,3,$InfoNombreBancoDos,'','L',1,1,$x+105 ,$y+85,true,0,false,true,40,'T');
		$this->MultiCell(49,3,$InfoCuentaBancoDos,'','R',1,1,$x+135 ,$y+85,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente 
	//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CUPON
	//CAMPOS DE DETALLE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	$this->SetFont('helveticaB', '',7);//Tamaño y tipo de Fuente Encabezado 
	$this->SetFillColor(200, 200, 200);
		$DetalleCampo1='CONCEPTO DE PAGO';
		$DetalleCampo2='VALOR PAGAR';
		//.........................................................................................................................
		$this->MultiCell(60,4,$DetalleCampo1,'','C',1,1,$x+5  ,$y+40,true,0,false,true,40,'T');
		$this->MultiCell(25,4,$DetalleCampo2,'','C',1,1,$x+65,$y+40,true,0,false,true,40,'T'); 
	$this->SetFillColor(255, 255, 255);
	//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CAMPOS DE DETALLE
	
	//CAMPOS TOTALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoTotal='TOTAL A PAGAR';
		$InfoComentarios='COMENTARIOS:';
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente Encabezado 
	$this->SetFillColor(200, 200, 200);
		//.........................................................................................................................
		$this->MultiCell(60,4,$InfoTotal      ,'','C',1,1,$x+5 ,$y+74,true,0,false,true,40,'T');
	$this->SetFillColor(255, 255, 255);
		//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CAMPOS TOTALES
	
	//PIE DE CUPON ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoPieDePagina= "- BANCO -";
		$this->MultiCell(205 ,5,$InfoPieDePagina,'','R',1,1,$x,$y+85,true,0,false,true,40,'T'); 
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: PIE DE CUPON
	
}
public function pintarPdf($id)
{
// set document information
$seguridad = array('modify','copy');
$this->SetCreator(PDF_CREATOR);
$this->SetProtection($seguridad);
$this->SetAuthor('ELemental Software S.A.S.');
$this->SetTitle('Factura');
$this->SetSubject('COLEGIO CALASANZ FEMENINO');
$this->SetKeywords('ELEMENTAL, CCF, PDF');
// set default monospaced font
$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//set auto page breaks
$this->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
//set image scale factor
$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
// ---------------------------------------------------------
include 'conexion/conection.php';
$sql="SELECT id_documentoWeb Id,
    numeroFactura_documentoWeb Numero,
    CONCAT(a.nombre1_alumno,' ',a.nombre2_alumno,' ',a.apellido1_alumno) Nombre,
    fecha_documentoWeb Fecha,
    concepto_documentoWeb Concepto,
    matrIcula_documentoWeb Matricula,
    valor_documentoWeb Valor,
    a.grupo_alumno Grado,
    a.numeroDocumento_alumno NumeroDocumento
	FROM documentoweb dw join alumno a on (dw.matrIcula_documentoWeb = a.matricula_alumno)
	WHERE id_documentoWeb=$id";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$this->nuevapagina(0);
$this->nuevapagina(90);
$this->nuevapagina(180);
$Numero=$row['Numero'];
$Nombre=$row['Nombre'];
$Concepto=$row['Concepto'];
$Valor=$row['Valor'];
$Grado=$row['Grado'];
$Matricula=$row['Matricula'];
$NumeroIdentificacion=$row['NumeroDocumento']." - ".$Matricula;
$FechaOportuno=$row['Fecha'];
//$Fecha=date("Y/m/d",$Fecha);
$Ano='2015';
$FechaExtemporaneo="25/10/2015";
$FechaCodigoBarras1=substr($FechaOportuno, 6,4).substr($FechaOportuno, 3,2).substr($FechaOportuno, 0,2);
$FechaCodigoBarras2=substr($FechaExtemporaneo, 6,4).substr($FechaExtemporaneo, 3,2).substr($FechaExtemporaneo, 0,2);
$ValorCodigoBarras2=$Valor+10000;
$x=0;
$y=0;
for ($i=0; $i < 4 ; $i++) {
//LLENANDO CUPON ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//CUPON IZQUIERDA
	$this->SetFont('helveticaB', '',9);//Tamaño y tipo de Fuente
	$this->MultiCell(100,5,$NumeroIdentificacion,0,'L',1,1,$x+23,$y+26,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Grado,0,'L',1,1,$x+23,$y+30,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Ano,0,'L',1,1,$x+23,$y+34,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Nombre,0,'L',1,1,$x+23,$y+22,true,0,false,true,40,'T');
	//LLENADO DETALLES DE FACTURA ////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$this->SetFont('helvetica', '',11);//Tamaño y tipo de Fuente
	$this->MultiCell(60,4,$Concepto,'','L',1,1,$x+5,$y+45,true,0,false,true,40,'T');
	$this->MultiCell(25,4,number_format($Valor,0),'','R',1,1,$x+65,$y+45,true,0,false,true,40,'T');
	//LLENADO TOTALES DE FACTURA ////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$this->SetFont('helveticaB', '',11);//Tamaño y tipo de Fuente
	$this->MultiCell(25,4,number_format($Valor,0)      ,'','R',1,1,$x+65 ,$y+73.5,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',9);//Tamaño y tipo de Fuente
	//CUPON DERECHA
	$InfoCodigoBarrasUno="- Pago oportuno: $FechaOportuno - Valor a pagar: ".number_format($Valor,0);
	$InfoCodigoBarrasDos="- Pago extemporaneo: $FechaExtemporaneo - Valor a pagar: ".number_format($ValorCodigoBarras2,0);
	$this->MultiCell(100,5,$Nombre,0,'L',1,1,$x+105,$y+22,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$NumeroIdentificacion,0,'L',1,1,$x+105,$y+26,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Grado,0,'L',1,1,$x+195,$y+22,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Ano,0,'L',1,1,$x+195,$y+26,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$InfoCodigoBarrasUno,0,'L',1,1,$x+95,$y+32,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$InfoCodigoBarrasDos,0,'L',1,1,$x+95,$y+54,true,0,false,true,40,'T');
	$CodigoBarras1="http://localhost/portalconciliacion/barcodephp/html/image.php?filetype=PNG&dpi=300&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=%28415%297701234001001~F1%288020%29$Matricula~F1%28390y%29$Valor~F1%2896$FechaCodigoBarras1&thickness=45&start=C&code=BCGgs1128";
	$CodigoBarras2="http://localhost/portalconciliacion/barcodephp/html/image.php?filetype=PNG&dpi=300&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=%28415%297701234001001~F1%288020%29$Matricula~F1%28390y%29$ValorCodigoBarras2~F1%2896$FechaCodigoBarras2&thickness=45&start=C&code=BCGgs1128";
	$this->Image($CodigoBarras1, $x+'100', $y+'38', 0, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	$this->Image($CodigoBarras2, $x+'100', $y+'60', 0, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	$this->MultiCell(100,10,'No. '.$Numero   ,0,'C',1,1,$x+145,$y+11,true,0,false,true,40,'T');
	$this->MultiCell(205,10,'Referencia. '.$Matricula   ,0,'R',1,1,$x+5,$y+17,true,0,false,true,40,'T');
	$this->MultiCell(85,10,'Referencia. '.$Matricula   ,0,'R',1,1,$x+5,$y+82,true,0,false,true,40,'T');
	$y=$y + 90;

}
$this->Ln(4);
ob_clean();
$fecha = date("d-m-Y",time());
$this->Output("cupon.pdf", "I");
}
}
// create new PDF document
$id= $_GET["id"];
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->pintarPdf($id);
?>
