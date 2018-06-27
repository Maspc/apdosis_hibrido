<?php
	require('mysql_table.php');
	
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	$limite = $_POST['limite'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];
			$limite = $_POST['limite'];
			$this->SetFont('Arial','',18);
			$titulo = 'Reporte de los '.$limite.' más vendidos del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	//Connect to database
	ob_start();
	include ('./clases/session.php');
	require_once('../modulos/imprimir_masvendidos.php');
	
	$resd = imprimir::select1($_SESSION['MM_iduser']);
	
	foreach($resd as $rowd){
		$username = $rowd->nombre;
	}
	
	
	$pdf=new PDF();
	$pdf->AddPage();
	//First table: put all columns automatically
	$pdf->AddCol('medicamento',150,'Producto', 'C');
	$pdf->AddCol('cantidad_total',30,'Cantidad Vendida','C');
	
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT a.medicamento, sum( a.cantidad - a.devolucion ) AS cantidad_total
	FROM factura_detalle a, factura b
	WHERE a.factura = b.factura
	AND date(b.fecha) between '$fecha1' and '$fecha2' 
	AND b.estado_factura = 'I'
	AND a.estado_producto = 'P'
	GROUP BY a.medicamento
	ORDER BY cantidad_total DESC
	LIMIT ".$limite, $prop3);
	
	$pdf->Ln(10);
	
	
	$pdf->Ln(10);
	$pdf->Write(5,'Realizada por: ');
	$hora_actual = date("Y-m-d H:i",time());
	$pdf->Ln(10);
	$pdf->Ln(10);
	$pdf->Write(5,'_______________________________________________');
	$pdf->Ln(10);
	$pdf->Write(5,$username);
	$pdf->Ln(10);
	$pdf->Write(5,'Hora de Proceso: '.$hora_actual);
	
	
	
	
	//$pdf -> Output($z.".pdf","F");
	//$output = shell_exec('lpr -P cargos1  /var/www/htdocs/apdosis/htdocs/apdosis/fact/'.$z.'.pdf | lpstat -t' );
	//echo "<pre>$output</pre>";
	//sleep(2);
	$pdf->Output();
?>