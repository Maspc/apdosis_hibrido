<?php
	
	include('./clases/session.php');
	require_once('../modulos/ventas_narcoticos.php');
	require_once('./mysql_table.php');
	
	$fecha1 = $_POST['fecha1'];
	$fecha2 = $_POST['fecha2'];
	class PDF extends PDF_MySQL_Table
	{
		function Header()
		{
			//Title
			$fecha1 = $_POST['fecha1'];
			$fecha2 = $_POST['fecha2'];
			$this->SetFont('Arial','',18);
			$titulo = 'Reporte de Narcóticos del '.$fecha1. ' al '.$fecha2;
			$this->Cell(0,6,$titulo,0,1,'C');
			$this->Ln(10);
			//Ensure table header is output
			parent::Header();
		}
	}
	
	$username = vnarcoticos::usuario($_SESSION['MM_iduser']);
	$pdf=new PDF();
	$pdf->AddPage();
	
	//First table: put all columns automatically
	$pdf->AddCol('fecha',30,'Fecha','C');
	$pdf->AddCol('medicamento',60,'Medicamento','C');
	$pdf->AddCol('cantidad',20,'Cantidad','C');
	
	
	$prop3=array('HeaderColor'=>array(255,150,100),
	'color1'=>array(210,245,255),
	'color2'=>array(255,255,210),
	'padding'=>2);
	
	$pdf->Table("SELECT b.factura_fiscal, SUBSTR(a.medicamento,1,35) as medicamento,b.fecha, a.cantidad from factura_detalle a, factura b,registro c, medicamentos d where  a.factura = b.factura and date(b.fecha) between '$fecha1' and '$fecha2' and d.codigo_interno = a.medicamento_id and d.narcotico = 'S' and b.estado_factura = 'I' order by b.fecha", $prop3);
	
	$pdf->Ln(10);
	/*$pdf->AddCol('total',20,'Total', 'C');
		
		
		
		$prop3=array('HeaderColor'=>array(255,150,100),
		'color1'=>array(210,245,255),
		'color2'=>array(255,255,210),
		'padding'=>2);
	
	
	$pdf->Table("SELECT sum(round(a.total,2)) as total from factura a, registro b  where a.historia = b.historia and a.tratamiento =b.tratamiento and a.cargo = b.cargo and date(a.fecha) between '$fecha1' and '$fecha2' and a.estado_factura = 'I' order by a.factura_fiscal", $prop3);
	
	*/
	
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
		