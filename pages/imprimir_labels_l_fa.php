<?php
	include ('../clases/session.php'); 
	require_once('../modulos/facturacion.php');
	
	if (isset($_GET['factura'])) { 
	$factura=$_GET['factura'];}
	
	if (isset($_GET['nombre_cliente'])) { 
	$nombre_cliente=$_GET['nombre_cliente'];}
	
	
	require ('TCPDF/tcpdf.php');
	//$pdf = new FPDF('L','mm',array(90,29));
	//require('ean13.php');
	
	$tamano = array(90,29);
	
	$pdf = new TCPDF('L', 'mm', $tamano, true, 'UTF-8', false);
	//require('ean13.php');
	
	//$pdf=new PDF_EAN13('L','mm',array(90,29));
	
	
	//echo "la linea ".$linea[$c]."el valor de imprimir es ".$imprimir[$c]." de la factura ".$factura[$c];
	
	$rows = factura::select8($factura);
	foreach($rows as $rws){
		
		//echo "cantidad ".$rws->cantidad;
		
		
		
		$medicamento = $rws->medicamento;
		$horas = $rws->horas;
		$dias = $rws->dias;
		$paciente = $nombre_cliente;
		$id_paciente = $rws->id_paciente;
		$cama = $rws->no_cama;
		$medico = $rws->nombre_medico;
		$fecha = date('Y-m-d H:i',time());
		$localidad = $rws->localidad_entrega;
		$dosis = $rws->dosis;
		$observacion = $rws->observacion;
		$codigo = $rws->codigo_de_barra;
		$codigo = str_pad($codigo,13,'0',STR_PAD_LEFT);
		
		if($horas == 0){
			$horas = '___';
		}
		
		if($dias == 0){
			$dias = '___';
		}
		
		/*
			$pdf->AddPage();
			$pdf->SetMargins(2,2,2);
			$pdf->SetAutoPageBreak(3);
			$pdf->SetY(5) ;
			$pdf->SetFont('Arial','B',8);
			$pdf->Write(4, "FARMACIA CENTRO MEDICO PAITILLA\n");
			$pdf->Ln(1);
			$pdf->SetFont('Arial','',10);
			$pdf->Write(4, $paciente."\n");
			//$pdf->Write(4, $firstname." ".$lastname); 
			//$pdf->Line(3, 10, 86, 10);
			$pdf->SetFont('Arial','',8);
			//$pdf->Text(5, 15, $address) ;
			$pdf->Write(4, $medicamento); 
			//$pdf->Write(4, "\n Obs.: ".$observacion);
			$pdf->Ln(3);
			$pdf->EAN13(55,16, $codigo);
			$data= date("dmy");  
		$fileD = $factura[$c]."_".$linea[$c].".pdf";*/
		
		$pdf->AddPage();
		$pdf->SetMargins(1,1,1);
		$pdf->SetAutoPageBreak(3);
		$pdf->SetY(1) ;
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		
		$style = array(
		'position' => '',
		'align' => 'C',
		'stretch' => false,
		'fitwidth' => true,
		'cellfitalign' => '',
		'border' => false,
		'hpadding' => 'auto',
		'vpadding' => 'auto',
		'fgcolor' => array(0,0,0),
		'bgcolor' => false, //array(255,255,255),
		'text' => true,
		'font' => 'helvetica',
		'fontsize' => 8,
		'stretchtext' => 4
		);
		
		
		
		$params = $pdf->serializeTCPDFtagParameters(array($codigo, 'EAN13', '', '', 30, 10, 0.4, array('position'=>'', 'border'=>false, 'padding'=>1, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>4, 'stretchtext'=>4), 'N'));
		
		$tbl = '<table border="0.5" cellpadding="0.5">
		<tr><td><b>FARMACIA CENTRO M&Eacute;DICO PAITILLA &nbsp;&nbsp;&nbsp;&nbsp;TEL: 269-0655</b></td></tr>	 
		<tr>
		<td>'.$nombre_cliente.'</td></tr>
		<tr>
		<td>'.$medicamento.'</td></tr>
		<tr><td style="text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<tcpdf method="write1DBarcode" params="'.$params.'" /></td> </tr> 
		</table>';
		
		
		$pdf->SetFont('helvetica','',8);
		
		$pdf->writeHTML($tbl, true, false, false, false, '');
		
		
		
	}
	
	
	
	
	
	$pdf -> Output();
	
?>