<?php
	include('./clases/session.php');
	require_once('../modulos/imprimir_codigo_precio_u.php');
	
	if (isset($_POST['medicamento_id'])) { 
	$medicamento_id=$_POST['medicamento_id'];}
	
	require_once('./ean13_min.php');
	
	$pdf=new PDF_EAN13('L','mm',array(23,23));
		
	$rows = icodigo::select1($medicamento_id);
	
	foreach($rows as $rs){
		$codigo = $rs->codigo_de_barra;
		$medicamento = $rs->nombre;
		$codigo = trim(str_pad($codigo,13,'0',STR_PAD_LEFT));
		$precio_unitario = $rs->precio_unitario;
		//echo "codigo: ".$codigo;
		$pdf->AddPage();
		$pdf->SetMargins(1,1,1);
		$pdf->SetAutoPageBreak(3);
		$pdf->SetY(5);
		$pdf->SetFont('Arial','',6.5);
		$pdf->Cell(20,0,$medicamento,0,0,'C');
		//$pdf->Write(10,$medicamento);
		$pdf->EAN13(1,7, $codigo);
		$pdf->SetFont('Arial','B',12);
		$pdf->Ln(12);
		$pdf->Cell(20,5,$precio_unitario,0,0,'C');
		}
		
	$pdf->Output();
?>

