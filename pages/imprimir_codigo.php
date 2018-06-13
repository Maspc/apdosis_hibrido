<?php
	
	require_once('../modulos/imprimir_codigo.php');
	
	if (isset($_POST['medicamento_id'])) { 
	$medicamento_id=$_POST['medicamento_id'];}
	
	require('ean13.php');
	
	$pdf=new PDF_EAN13('L','mm',array(90,29));
	
	
	$rows = icodigo::imp_codigo($medicamento_id);
	
	foreach($rows as $rw){
		$codigo = $rw->codigo_de_barra;
		$medicamento = $rw->nombre;
		$codigo = trim(str_pad($codigo,13,'0',STR_PAD_LEFT));
		//echo "codigo: ".$codigo;
		$pdf->AddPage();
		$pdf->SetMargins(2,2,2);
		$pdf->SetAutoPageBreak(3);
		$pdf->SetY(5);
		$pdf->SetFont('Arial','B',6);
		$pdf->Cell(20,0,$medicamento);
		//$pdf->Write(10,$medicamento);
		$pdf->EAN13(30,10, $codigo);
	}
	
	$pdf->Output();
	
?>

