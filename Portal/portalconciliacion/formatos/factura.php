<?php
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php'); 


class MYPDF extends TCPDF {

public function nuevapagina()
{
	$this->AddPage('P','letter');
	// set cell padding
	$this->setCellPaddings(1, 1, 1, 1);
	// set cell margins
	$this->setCellMargins(0, 0, 0, 0);
	// set color for background
	$this->SetFillColor(999, 999, 999);
	//llamamos la plantilla
	$this->plantilla();
}

public function plantilla()
{
	//ocultar linea negra de PDF ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
		$this->MultiCell(205, 20, '', 0, 'C', 1, 1, 0, 0, true,0,false,true,40,'T', true);
	//↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		$EstiloLineal = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(9, 9, 9));
		$EstiloPuntos= array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => '0,0,5,2', 'phase' => 10, 'color' => array(0, 0, 0));
		$x=0;
		$y=0;
	//IMAGENES DOCUMENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$LogoNormal='images/Calasanz.png';
		$MarcaDeAgua='images/CalasanzE.png';
		$this->Image($LogoNormal,$x+10,$y+8,30,30,'PNG','','',true,150,'',false,false,0,false,false,false);
		$this->Image($MarcaDeAgua,$x+50,$y+65,110,90,'PNG','','',true,150,'',false,false,0,false,false,false);
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: IMAGENES DOCUMENTO
	//LINEAS DOCUMENTO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$this->Line(5  ,40 ,205,40 , $EstiloLineal);//Linea Arriba debajo logo
		$this->Line(5  ,59 ,205,59 , $EstiloLineal);//Linea Arriba debajo info estudiante
		$this->Line(5  ,65 ,205,65 , $EstiloLineal);//Linea Arriba debajo info detalle
		$this->Line(135,40 ,135,59 , $EstiloLineal);//Linea Media de info estudiante
		$this->Line(150,170 ,150,183, $EstiloLineal);//Linea Media de detalle
		$this->Line(5  ,170,205,170, $EstiloLineal);//Linea Abajo de detalle
		$this->Line(150,175.5,205,175.5,$EstiloLineal);//Linea Abajo de total
		$this->Line(5  ,183,205,183, $EstiloLineal);//Linea Abajo
		$this->Line(5  ,40 ,5  ,183, $EstiloLineal);//Linea Izquierda
		$this->Line(205,40 ,205,183, $EstiloLineal);//Linea  Derecha
		$this->Line(5  ,190,205,190, $EstiloPuntos);//Linea de puntiada mitad de facturatachado
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: LINEAS DOCUMENTO
	

	//LLENAR CAMPOS INFORMATIVOS ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoNombre='COLEGIO CALASANZ FEMENINO - MEDELLIN';
		$InfoNit='NIT: 860.014.826-8';
		$InfoDireccion='CALLE 53 No. 76A - 130 - MEDELLIN';
		$InfoTelefonos='TELEFONOS: 234 2131 - 234 5550';
		$InfoPaginaWeb='wwww.calasanzfemeninomedellin.edu.co';
		$InfoTipo="RECIBO DE PAGO";
		//$InfoNumero="No. 012345484548";
		//.........................................................................................................................
	$this->SetFont('helveticaB', '',10);//Tamaño y tipo de Fuente Encabezado 
		$this->MultiCell(100,10,$InfoNombre   ,0,'C',1,1,$x+55,$y+11,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoNit      ,0,'C',1,1,$x+55,$y+15,true,0,false,true,40,'T');
	$this->SetFont('helvetica', '',10);	//Tamaño y tipo de Fuente Encabezado 
		$this->MultiCell(100,10,$InfoDireccion,0,'C',1,1,$x+55,$y+21,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoTelefonos,0,'C',1,1,$x+55,$y+25,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoPaginaWeb,0,'C',1,1,$x+55,$y+29,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',12);//Tamaño y tipo de Fuente Encabezado 
		$this->MultiCell(100,10,$InfoTipo     ,0,'C',1,1,$x+130,$y+20,true,0,false,true,40,'T');
		//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: LLENAR CAMPOS INFORMATIVOS
	
	//LLENAR CAMPOS ESTUDIANTE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$EstudianteAlumna="Alumna:";
		$EstudianteCodigo="Código:";
		$EstudianteGrado="Grado:";
		$EstudianteAno="Año:";
		$EstudianteFechaSinRecargo="Fecha Sin Recargo:";
		$EstudianteFechaConRecargo="Fecha Con Recargo:";
		$EstudianteFechaInformativa="dd/mm/aaaa";
		//.........................................................................................................................
	$this->SetFont('helvetica', '',10);//Tamaño y tipo de Fuente Encabezado 
		$this->MultiCell(100,10,$EstudianteAlumna,0,'L',1,1,$x+7,$y+40,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteCodigo,0,'L',1,1,$x+7,$y+44,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteGrado ,0,'L',1,1,$x+7,$y+48,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteAno   ,0,'L',1,1,$x+7,$y+52,true,0,false,true,40,'T');

		$this->MultiCell(100,10,$EstudianteFechaSinRecargo ,0,'L',1,1,$x+137,$y+40,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteFechaConRecargo ,0,'L',1,1,$x+137,$y+48,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteFechaInformativa,0,'L',1,1,$x+175,$y+44,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteFechaInformativa,0,'L',1,1,$x+175,$y+52,true,0,false,true,40,'T');
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: LLENAR CAMPOS ESTUDIANTE
	
	//CAMPOS DE DETALLE :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente Encabezado 
	$this->SetFillColor(200, 200, 200);
		$DetalleCampo1='CONCEPTO DE PAGO';
		$DetalleCampo2='VALOR PAGAR';
		//.........................................................................................................................
		$this->MultiCell(145,4,$DetalleCampo1,'','C',1,1,$x+5  ,$y+59,true,0,false,true,40,'T');
		$this->MultiCell(55 ,4,$DetalleCampo2,'','C',1,1,$x+150,$y+59,true,0,false,true,40,'T'); 
	$this->SetFillColor(255, 255, 255);
	//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CAMPOS DE DETALLE
	//CAMPOS TOTALES ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoTotal='TOTAL A PAGAR';
		$InfoComentarios='COMENTARIOS:';
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente Encabezado 
	$this->SetFillColor(200, 200, 200);
		//.........................................................................................................................
		$this->MultiCell(55,4,$InfoTotal      ,'','C',1,1,$x+150 ,$y+170,true,0,false,true,40,'T');
	$this->SetFillColor(255, 255, 255);
		$this->MultiCell(55 ,4,$InfoComentarios,'','L',1,1,$x+7,$y+170,true,0,false,true,40,'T'); 
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CAMPOS TOTALES
	//PIE DE FACTURA ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoPieDePagina= "- ESTUDIANTE -";
		$this->MultiCell(210 ,5,$InfoPieDePagina,'','C',1,1,$x,$y+184,true,0,false,true,40,'T'); 
	//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: PIE DE FACTURA
	

	//CUPON :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		//LOGO CUPON ..............................................................................................................
		$this->Image($LogoNormal,$x+8,$y+195,20,20,'PNG','','',true,150,'',false,false,0,false,false,false);
		//INFO ENCABEZADO CUPON ...................................................................................................
		$this->SetFont('helveticaB', '',7);//Tamaño y tipo de Fuente 
		$this->MultiCell(100,10,$InfoNombre   ,0,'C',1,1,$x+7,$y+195,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoNit      ,0,'C',1,1,$x+7,$y+199,true,0,false,true,40,'T');
	$this->SetFont('helvetica', '',6);	//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$InfoDireccion,0,'C',1,1,$x+7,$y+203,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoTelefonos,0,'C',1,1,$x+7,$y+206,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$InfoPaginaWeb,0,'C',1,1,$x+7,$y+209,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$InfoTipo     ,0,'L',1,1,$x+10,$y+218,true,0,false,true,40,'T');
		//INFO ESTUDIANTE .........................................................................................................
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente
		$this->MultiCell(100,10,$EstudianteAlumna,0,'L',1,1,$x+10,$y+222,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteCodigo,0,'L',1,1,$x+10,$y+226,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteGrado ,0,'L',1,1,$x+10,$y+230,true,0,false,true,40,'T');
		$this->MultiCell(100,10,$EstudianteAno   ,0,'L',1,1,$x+10,$y+234,true,0,false,true,40,'T');
		//RELACION DE CHEQUES .....................................................................................................
			//lineas Horizontales Relacion de cheques
		$this->Line($x+11,$y+243,$x+85,$y+243,$EstiloLineal);
		$this->Line($x+11,$y+248.5,$x+85,$y+248.5,$EstiloLineal);
		$this->Line($x+11,$y+253,$x+85,$y+253,$EstiloLineal);
		$this->Line($x+11,$y+257,$x+85,$y+257,$EstiloLineal);
		$this->Line($x+11,$y+261,$x+85,$y+261,$EstiloLineal);
		$this->Line($x+11,$y+265,$x+85,$y+265,$EstiloLineal);
			//lineas verticales Relacion de cheques
		$this->Line($x+27,$y+248.5,$x+27,$y+261,$EstiloLineal);
		$this->Line($x+31,$y+257,$x+31,$y+261,$EstiloLineal);
		$this->Line($x+65,$y+248.5,$x+65,$y+265,$EstiloLineal);
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
		$this->MultiCell(74,3,$InfoCuponRelacionCheques,'','C',1,1,$x+11 ,$y+243,true,0,false,true,40,'T');
	$this->SetFillColor(255, 255, 255);
	$this->SetFont('helvetica', '',6);//Tamaño y tipo de Fuente 
		$this->MultiCell(74,3,$InfoCuponCodigoBanco,'','L',1,1,$x+11 ,$y+249,true,0,false,true,40,'T');
		$this->MultiCell(74,3,$InfoCuponNumeroCheques,'','L',1,1,$x+11 ,$y+257,true,0,false,true,40,'T');
		$this->MultiCell(54,3,$InfoCuponChequeNumero,'','R',1,1,$x+11 ,$y+249,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',6);//Tamaño y tipo de Fuente 
		$this->MultiCell(54,3,$InfoCuponTotalCheque,'','R',1,1,$x+11 ,$y+257,true,0,false,true,40,'T');
		$this->MultiCell(54,3,$InfoCuponTotalEfectivo,'','R',1,1,$x+11 ,$y+261,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente 
		$this->MultiCell(74,3,$InfoCuponPagueUnicamenteChequeEfectivo,'','C',1,1,$x+11 ,$y+267,true,0,false,true,40,'T');
		//PUNTOS DE PAGO ..........................................................................................................
		$InfoPuntosPago= "Puntos de Pago";
		$InfoNombreBancoUno="BANCO CAJA SOCIAL BSC";
		$InfoCuentaBancoUno="CTA. AHO. 24505106827";
		$InfoNombreBancoDos="BANCO BOGOTA";
		$InfoCuentaBancoDos="CTA. CTE. 36200392-3";
		$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente 
		//info puntos de pago
		$this->MultiCell(74,3,$InfoPuntosPago,'','L',1,1,$x+100 ,$y+247,true,0,false,true,40,'T');
		$this->MultiCell(50,3,$InfoNombreBancoUno,'','L',1,1,$x+105 ,$y+253,true,0,false,true,40,'T');
		$this->MultiCell(49,3,$InfoCuentaBancoUno,'','R',1,1,$x+155 ,$y+253,true,0,false,true,40,'T');
		$this->MultiCell(50,3,$InfoNombreBancoDos,'','L',1,1,$x+105 ,$y+258,true,0,false,true,40,'T');
		$this->MultiCell(49,3,$InfoCuentaBancoDos,'','R',1,1,$x+155 ,$y+258,true,0,false,true,40,'T');
		//lineas horizontales puntos de pago
		$this->Line($x+105,$y+252,$x+205,$y+252,$EstiloLineal);
		$this->Line($x+105,$y+265,$x+205,$y+265,$EstiloLineal);
		//lineas verticales puntos de pago
		$this->Line($x+105,$y+252,$x+105,$y+265,$EstiloLineal);
		$this->Line($x+205,$y+252,$x+205,$y+265,$EstiloLineal);

	$this->SetFont('helveticaB', '',8);//Tamaño y tipo de Fuente 

	//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: CUPON
	//PIE DE CUPON ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$InfoPieDePagina= "- BANCO -";
		$this->MultiCell(210 ,5,$InfoPieDePagina,'','C',1,1,$x,$y+272,true,0,false,true,40,'T'); 
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
//$this->setLanguageArray($l);
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
$this->nuevapagina();
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
//LLENADO ENCABEZADO DE FACTURA //////////////////////////////////////////////////////////////////////////////////////////////////////////
	$this->SetFont('helveticaB', '',10);//Tamaño y tipo de Fuente
	$this->MultiCell(100,10,'No. '.$Numero   ,0,'C',1,1,$x+130,$y+25,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Nombre,0,'L',1,1,$x+25,$y+40,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$NumeroIdentificacion,0,'L',1,1,$x+25,$y+44,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Grado,0,'L',1,1,$x+25,$y+48,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Ano,0,'L',1,1,$x+25,$y+52,true,0,false,true,40,'T');
	$this->SetFont('helveticaB', '',11);//Tamaño y tipo de Fuente
	$this->MultiCell(100,10,$FechaOportuno,0,'L',1,1,$x+175,$y+40,true,0,false,true,40,'T');
	$this->MultiCell(100,10,$FechaExtemporaneo,0,'L',1,1,$x+175,$y+48,true,0,false,true,40,'T');
//LLENADO DETALLES DE FACTURA ////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$this->SetFont('helvetica', '',11);//Tamaño y tipo de Fuente
	$this->MultiCell(145,4,$Concepto,'','L',1,1,$x+5  ,$y+65,true,0,false,true,40,'T');
	$this->MultiCell(55 ,4,number_format($Valor,0),'','R',1,1,$x+150,$y+65,true,0,false,true,40,'T');
//LLENADO TOTALES DE FACTURA ////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$this->SetFont('helveticaB', '',11);//Tamaño y tipo de Fuente
	$this->MultiCell(55,4,number_format($Valor,0)      ,'','R',1,1,$x+150 ,$y+175,true,0,false,true,40,'T');
//LLENANDO CUPON ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$this->SetFont('helveticaB', '',9);//Tamaño y tipo de Fuente
	$InfoCodigoBarrasUno="- Pago oportuno: $FechaOportuno - Valor a pagar: ".number_format($Valor,0);
	$InfoCodigoBarrasDos="- Pago extemporaneo: $FechaExtemporaneo - Valor a pagar: ".number_format($ValorCodigoBarras2,0);
	$this->MultiCell(100,5,$Nombre,0,'L',1,1,$x+23,$y+222,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$NumeroIdentificacion,0,'L',1,1,$x+23,$y+226,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Grado,0,'L',1,1,$x+23,$y+230,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$Ano,0,'L',1,1,$x+23,$y+234,true,0,false,true,40,'T');

	$this->MultiCell(100,5,$InfoCodigoBarrasUno,0,'L',1,1,$x+95,$y+193,true,0,false,true,40,'T');
	$this->MultiCell(100,5,$InfoCodigoBarrasDos,0,'L',1,1,$x+95,$y+220,true,0,false,true,40,'T');

	$CodigoBarras1="http://localhost/pgw/barcodephp/html/image.php?filetype=PNG&dpi=300&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=%28415%297701234001001~F1%288020%29$Matricula~F1%28390y%29$Valor~F1%2896$FechaCodigoBarras1&thickness=55&start=C&code=BCGgs1128";
	$CodigoBarras2="http://localhost/pgw/barcodephp/html/image.php?filetype=PNG&dpi=300&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=%28415%297701234001001~F1%288020%29$Matricula~F1%28390y%29$ValorCodigoBarras2~F1%2896$FechaCodigoBarras2&thickness=55&start=C&code=BCGgs1128";
	$this->Image($CodigoBarras1, '105', '200', 0, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	$this->Image($CodigoBarras2, '105', '227', 0, 0, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	$this->MultiCell(200,10,'Referencia. '.$Matricula   ,0,'R',1,1,$x+5,$y+35,true,0,false,true,40,'T');
	$this->MultiCell(82,10,'Referencia. '.$Matricula   ,0,'R',1,1,$x+5,$y+217.5,true,0,false,true,40,'T');
$this->Ln(4);
ob_clean();
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// ---------------------------------------------------------
//Close and output PDF document
$fecha = date("d-m-Y",time());
$this->Output("factura.pdf", "I");
}
}
// create new PDF document
$id= $_GET["id"];
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->pintarPdf($id);

